<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkAreaRequest;
use App\Models\WorkArea;
use Illuminate\Http\Request;

class WorkAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = WorkArea::with(['creator', 'updater']);

        // Filter berdasarkan wilayah kerja
        if ($request->filled('wilayah_kerja')) {
            $query->byWilayahKerja($request->wilayah_kerja);
        }

        // Filter berdasarkan kab/kota
        if ($request->filled('kab_kota')) {
            $query->byKabKota($request->kab_kota);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kab_kota', 'like', "%{$search}%")
                  ->orWhere('kantor_cabang', 'like', "%{$search}%")
                  ->orWhere('deputi_direktorat', 'like', "%{$search}%")
                  ->orWhere('kdkr', 'like', "%{$search}%")
                  ->orWhere('nama_kw', 'like', "%{$search}%")
                  ->orWhere('kdkc', 'like', "%{$search}%")
                  ->orWhere('nmkc', 'like', "%{$search}%");
            });
        }

        $allWorkAreas = $query->latest()->get();
        
        $kantorWilayah = $allWorkAreas->where('wilayah_kerja', WorkArea::KANTOR_WILAYAH);
        $kantorCabang = $allWorkAreas->where('wilayah_kerja', WorkArea::KANTOR_CABANG);
        $kantorPusat = $allWorkAreas->where('wilayah_kerja', WorkArea::KANTOR_PUSAT);

        $title = 'Wilayah & Unit Kerja';
        $route = 'admin.work-area';

        return view('admin.work-area.index', compact('kantorWilayah', 'kantorCabang', 'kantorPusat', 'title', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Wilayah & Unit Kerja';
        $route = 'admin.work-area';
        return view('admin.work-area.create', compact('title', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkAreaRequest $request)
    {
        try {
            $kdkc = $request->wilayah_kerja === 'kantor_cabang' ? $request->kdkc : null;
            $nmkc = $request->wilayah_kerja === 'kantor_cabang' ? $request->nmkc : null;

            $workArea = WorkArea::create([
                'wilayah_kerja' => $request->wilayah_kerja,
                'kdkr' => $request->kdkr,
                'nama_kw' => $request->nama_kw,
                'kdkc' => $kdkc,
                'nmkc' => $nmkc,
                'kab_kota' => $request->kab_kota,
                'kantor_cabang' => $request->kantor_cabang,
                'deputi_direktorat' => $request->deputi_direktorat,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id()
            ]);

            $notification = [
                'message' => 'Data wilayah kerja berhasil disimpan',
                'alert-type' => 'success'
            ];

            return redirect()
                ->route('admin.work-area.index')
                ->with($notification);

        } catch (\Exception $e) {
            $notification = [
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()
                ->back()
                ->withInput()
                ->with($notification);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkArea $workArea)
    {
        $workArea->load(['creator', 'updater']);
        $title = 'Detail Wilayah & Unit Kerja';
        return view('admin.work-area.show', compact('workArea', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkArea $workArea)
    {
        $title = 'Edit Wilayah & Unit Kerja';
        $route = 'admin.work-area';
        return view('admin.work-area.edit', compact('workArea', 'title', 'route'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreWorkAreaRequest $request, WorkArea $workArea)
    {
        try {
            $kdkc = $request->wilayah_kerja === 'kantor_cabang' ? $request->kdkc : null;
            $nmkc = $request->wilayah_kerja === 'kantor_cabang' ? $request->nmkc : null;

            $workArea->update([
                'wilayah_kerja' => $request->wilayah_kerja,
                'kdkr' => $request->kdkr,
                'nama_kw' => $request->nama_kw,
                'kdkc' => $kdkc,
                'nmkc' => $nmkc,
                'kab_kota' => $request->kab_kota,
                'kantor_cabang' => $request->kantor_cabang,
                'deputi_direktorat' => $request->deputi_direktorat,
                'updated_by' => auth()->id()
            ]);

            $notification = [
                'message' => 'Data wilayah kerja berhasil diperbarui',
                'alert-type' => 'success'
            ];

            return redirect()
                ->route('admin.work-area.index')
                ->with($notification);

        } catch (\Exception $e) {
            $notification = [
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()
                ->back()
                ->withInput()
                ->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkArea $workArea)
    {
        try {
            $workArea->delete();

            $notification = [
                'message' => 'Data wilayah kerja berhasil dihapus',
                'alert-type' => 'success'
            ];

            return redirect()
                ->route('admin.work-area.index')
                ->with($notification);

        } catch (\Exception $e) {
            $notification = [
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()
                ->back()
                ->with($notification);
        }
    }

    /**
     * Get statistics for dashboard
     */
    public function statistics()
    {
        $stats = [
            'total' => WorkArea::count(),
            'kantor_pusat' => WorkArea::kantorPusat()->count(),
            'kantor_wilayah' => WorkArea::kantorWilayah()->count(),
            'kantor_cabang' => WorkArea::kantorCabang()->count(),
            'by_city' => WorkArea::select('kab_kota')
                ->selectRaw('count(*) as total')
                ->groupBy('kab_kota')
                ->orderByDesc('total')
                ->limit(10)
                ->get()
        ];

        return response()->json($stats);
    }
}
