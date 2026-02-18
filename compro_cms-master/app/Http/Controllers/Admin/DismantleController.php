<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\DismantleSchedule;
use Toastr;

class DismantleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = 'Jadwal Dismantle';
        $this->route = 'admin.dismantle';
        $this->view = 'admin.dismantle';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;


        // Build Query
        $query = DismantleSchedule::query();

        // 5️⃣ Default: Show only future schedules (unless explicitly showing all)
        if (!$request->has('show_all')) {
            if (!$request->has('tanggal') || $request->tanggal == '') {
                $query->whereDate('tanggal', '>=', now()->toDateString());
            }
        }

        // Filters
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('tanggal', $request->tanggal);
        }
        if ($request->has('kode_cabang') && $request->kode_cabang != '') {
            $query->where('kode_cabang', 'like', '%' . $request->kode_cabang . '%');
        }
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Sorting (5️⃣ Default: tanggal ascending)
        $sort = $request->get('sort', 'tanggal');
        $order = $request->get('order', 'asc');
        $query->orderBy($sort, $order);

        $data['rows'] = $query->paginate(10);

        // Summary Data
        $data['total_jadwal'] = DismantleSchedule::count();
        $data['slot_open'] = DismantleSchedule::where('status', 'open')->count();
        $data['slot_full'] = DismantleSchedule::where('status', 'full')->count();
        $data['slot_today'] = DismantleSchedule::whereDate('tanggal', \Carbon\Carbon::today())->count(); // Use today's date

        return view($this->view.'.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;

        // Get orders that are paid but not yet scheduled for dismantle
        $data['orders'] = Order::where(function($query) {
                                    $query->whereNull('dismantel_schedule')
                                          ->orWhere('dismantel_schedule', '');
                                })
                                ->whereIn('status', ['paid', 'processing'])
                                ->orderBy('created_at', 'desc')
                                ->get();

        return view($this->view.'.create', $data);
    }

    /**
     * Handle bulk update of dismantle schedules.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'order_ids' => 'required|array',
            'order_ids.*' => 'exists:orders,id',
            'dismantel_schedule' => 'required|string|max:255',
        ]);

        $orderIds = $request->order_ids;
        $schedule = $request->dismantel_schedule;

        Order::whereIn('id', $orderIds)->update([
            'dismantel_schedule' => $schedule
        ]);

        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        return redirect()->route($this->route.'.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Edit ' . $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['row'] = DismantleSchedule::findOrFail($id);

        return view($this->view.'.edit', $data);
    }

    public function show($id)
    {
        $data['title'] = 'Detail ' . $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        
        $schedule = DismantleSchedule::findOrFail($id);
        $data['row'] = $schedule;

        // 6️⃣ + 🟡 Issue #2: Use Eloquent relationship (no N+1, clean query)
        $data['orders'] = $schedule->orders()
                               ->latest()
                               ->paginate(20);

        return view($this->view.'.show', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_wilayah' => 'required',
            'kode_cabang' => 'required',
            'tanggal' => 'required|date',
            'kapasitas' => 'required|integer|min:0',
            'status' => 'required|in:open,full,closed',
        ]);

        $row = DismantleSchedule::findOrFail($id);
        
        // 🔒 8️⃣ Proteksi Edit: Jika ada order, tidak boleh ubah tanggal/wilayah/cabang
        if ($row->terpakai > 0) {
            if ($request->tanggal != $row->tanggal || 
                $request->kode_wilayah != $row->kode_wilayah || 
                $request->kode_cabang != $row->kode_cabang) {
                Toastr::error('Tidak dapat mengubah Tanggal/Wilayah/Cabang karena sudah ada ' . $row->terpakai . ' order terkait. Hanya status dan kapasitas yang dapat diubah.', 'Error');
                return redirect()->back()->withInput();
            }
        }
        
        // Prevent update if capacity < used
        if ($request->kapasitas < $row->terpakai) {
             Toastr::error('Kapasitas tidak boleh lebih kecil dari jumlah terpakai (' . $row->terpakai . ')', 'Error');
             return redirect()->back()->withInput();
        }

        $row->update($request->all());

        // 1️⃣ Auto close if capacity = 0
        if ($row->kapasitas == 0) {
            $row->status = 'closed';
        }
        // Auto update status to full if terpakai >= kapasitas
        elseif ($row->terpakai >= $row->kapasitas && $row->status == 'open') {
            $row->status = 'full';
        }
        
        $row->save();

        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        return redirect()->route($this->route.'.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_wilayah' => 'required',
            'kode_cabang' => 'required',
            'tanggal' => 'required|date',
            'kapasitas' => 'nullable|integer|min:0',
        ]);

        // 1️⃣ Warning jika kapasitas = 0
        $status = 'open';
        if ($request->kapasitas == 0) {
            $status = 'closed';
            Toastr::warning('Jadwal dibuat dengan kapasitas 0 dan status CLOSED. Tidak dapat digunakan untuk booking.', 'Peringatan');
        }

        DismantleSchedule::create(array_merge($request->all(), ['status' => $status]));

        Toastr::success(__('dashboard.created_successfully'), __('dashboard.success'));

        return redirect()->route($this->route.'.index');
    }

    public function destroy($id)
    {
        $row = DismantleSchedule::findOrFail($id);
        
        // Check for related orders
        $relatedOrdersCount = Order::where('kdkr', $row->kode_wilayah)
                                   ->where('kdkc', $row->kode_cabang)
                                   ->whereDate('dismantel_schedule', $row->tanggal)
                                   ->count();

        if ($relatedOrdersCount > 0) {
            Toastr::error('Tidak dapat menghapus jadwal ini karena terdapat ' . $relatedOrdersCount . ' order yang terkait.', 'Gagal');
            return redirect()->back();
        }

        $row->delete();

        Toastr::success(__('dashboard.deleted_successfully'), __('dashboard.success'));

        return redirect()->route($this->route.'.index');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file = $request->file('file');
        
        if ($file) {
            $handle = fopen($file->getRealPath(), "r");
            
            // Skip header if it exists
            $header = fgetcsv($handle, 1000, ",");
            
            $count = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (count($data) >= 3) {
                    DismantleSchedule::create([
                        'kode_wilayah' => $data[0],
                        'kode_cabang'  => $data[1],
                        'tanggal'      => $this->parseDate($data[2]),
                        'keterangan'   => $data[3] ?? null,
                        'kapasitas'    => isset($data[4]) ? (int)$data[4] : 0,
                    ]);
                    $count++;
                }
            }
            fclose($handle);
            
            Toastr::success($count . ' data berhasil diimport', __('dashboard.success'));
        }

        return redirect()->back();
    }

    private function parseDate($dateString)
    {
        try {
            return \Carbon\Carbon::parse($dateString)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
