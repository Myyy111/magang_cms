<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Toastr;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = 'Orders';
        $this->route = 'admin.order';
        $this->view = 'admin.order';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;

        $rows = Order::orderBy('created_at', 'desc');

        // Filter by Status
        if (!empty($request->status)) {
            $rows->where('status', $request->status);
        }

        // Filter by Wilayah Kerja
        if (!empty($request->wilayah)) {
            $rows->where('wilayah_kerja', $request->wilayah);
        }

        // Filter by Payment Mechanism
        if (!empty($request->payment)) {
            $rows->where('payment_mechanism', $request->payment);
        }

        $data['rows'] = $rows->get();

        return view($this->view.'.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        $data['title'] = 'Order Detail';
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['row'] = $order;

        return view($this->view.'.show', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::with('items')->findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,paid,processing,completed,failed',
            'dismantel_schedule' => 'nullable|string',
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        $acceptedStatuses = ['paid', 'processing', 'completed'];
        $notAcceptedStatuses = ['pending', 'failed'];

        // Update dismantel schedule
        if ($request->has('dismantel_schedule')) {
            $order->dismantel_schedule = $request->dismantel_schedule;
        }

        // If status changes FROM (Pending/Failed) TO (Paid/Processing/Completed) -> Reduce Stock
        if (in_array($oldStatus, $notAcceptedStatuses) && in_array($newStatus, $acceptedStatuses)) {
            foreach ($order->items as $item) {
                // Decrement main product
                Product::where('id', $item->product_id)->decrement('stock', $item->quantity);
                
                // Decrement variants
                if ($item->variant_ids) {
                    foreach ($item->variant_ids as $vid) {
                        \App\Models\ProductVariant::where('id', $vid)->decrement('stock', $item->quantity);
                    }
                }
            }
        }
        
        // If status changes FROM (Paid/Completed) TO (Pending/Failed) -> Restore Stock
        if (in_array($oldStatus, $acceptedStatuses) && in_array($newStatus, $notAcceptedStatuses)) {
            foreach ($order->items as $item) {
                // Increment main product
                Product::where('id', $item->product_id)->increment('stock', $item->quantity);
                
                // Increment variants
                if ($item->variant_ids) {
                    foreach ($item->variant_ids as $vid) {
                        \App\Models\ProductVariant::where('id', $vid)->increment('stock', $item->quantity);
                    }
                }
            }
        }

        $order->status = $newStatus;
        $order->save();

        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        return redirect()->route($this->route.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::with('items')->findOrFail($id);
        
        // Restore stock if it was already accepted (stock was reduced then)
        $acceptedStatuses = ['paid', 'processing', 'completed'];
        if (in_array($order->status, $acceptedStatuses)) {
            foreach ($order->items as $item) {
                Product::where('id', $item->product_id)->increment('stock', $item->quantity);
                if ($item->variant_ids) {
                    foreach ($item->variant_ids as $vid) {
                        \App\Models\ProductVariant::where('id', $vid)->increment('stock', $item->quantity);
                    }
                }
            }
        }

        $order->items()->delete(); // Delete related items first
        $order->delete();

        Toastr::success(__('dashboard.deleted_successfully'), __('dashboard.success'));

        return redirect()->route($this->route.'.index');
    }
    /**
     * Handle bulk update of order statuses.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'order_ids' => 'required|array',
            'order_ids.*' => 'exists:orders,id',
            'status' => 'required|in:pending,paid,processing,completed,failed',
        ]);

        $orderIds = $request->order_ids;
        $newStatus = $request->status;
        $acceptedStatuses = ['paid', 'processing', 'completed'];
        $notAcceptedStatuses = ['pending', 'failed'];

        foreach ($orderIds as $id) {
            $order = Order::with('items')->find($id);
            if (!$order) continue;

            $oldStatus = $order->status;

            // If status changes FROM (Pending/Failed) TO (Paid/Processing/Completed) -> Reduce Stock
            if (in_array($oldStatus, $notAcceptedStatuses) && in_array($newStatus, $acceptedStatuses)) {
                foreach ($order->items as $item) {
                    Product::where('id', $item->product_id)->decrement('stock', $item->quantity);
                    if ($item->variant_ids) {
                        foreach ($item->variant_ids as $vid) {
                            \App\Models\ProductVariant::where('id', $vid)->decrement('stock', $item->quantity);
                        }
                    }
                }
            }
            
            // If status changes FROM (Paid/Processing/Completed) TO (Pending/Failed) -> Restore Stock
            if (in_array($oldStatus, $acceptedStatuses) && in_array($newStatus, $notAcceptedStatuses)) {
                foreach ($order->items as $item) {
                    Product::where('id', $item->product_id)->increment('stock', $item->quantity);
                    if ($item->variant_ids) {
                        foreach ($item->variant_ids as $vid) {
                            \App\Models\ProductVariant::where('id', $vid)->increment('stock', $item->quantity);
                        }
                    }
                }
            }

            $order->status = $newStatus;
            $order->save();
        }

        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        return redirect()->back();
    }

    /**
     * Export Orders to CSV
     */
    public function exportCsv(Request $request)
    {
        $rows = Order::orderBy('created_at', 'desc');

        if (!empty($request->status)) $rows->where('status', $request->status);
        if (!empty($request->wilayah)) $rows->where('wilayah_kerja', $request->wilayah);
        if (!empty($request->payment)) $rows->where('payment_mechanism', $request->payment);

        $orders = $rows->get();

        $filename = "recap_orders_" . date('Y-m-d_H-i-s') . ".csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use($orders) {
            $file = fopen('php://output', 'w');
            // BOM UTF-8 agar Excel tidak salah encoding
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, ['Order #', 'Tanggal', 'Nama Pelanggan', 'NPP', 'No. WhatsApp', 'Wilayah', 'Kab/Kota', 'Cabang/As.Dep', 'Deputi/Bld/Wil', 'Total Bayar (Rp)', 'Mekanisme Bayar', 'Status']);

            foreach ($orders as $order) {
                $unit = json_decode($order->unit_kerja_detail, true) ?: [];
                // Prefix dengan tanda kutip agar Excel perlakukan sebagai teks, bukan angka
                $npp     = '="' . ($order->npp ?: ($order->customer_id_num ?: '-')) . '"';
                $contact = '="' . ($order->customer_contact ?: '-') . '"';
                fputcsv($file, [
                    $order->order_number,
                    $order->created_at->format('d/m/Y H:i'),
                    $order->customer_name,
                    $npp,
                    $contact,
                    strtoupper($order->wilayah_kerja),
                    $unit['kab_kota'] ?? '-',
                    $unit['cabang'] ?? '-',
                    $unit['deputi'] ?? '-',
                    number_format($order->total_amount, 0, ',', '.'),
                    $order->payment_mechanism == 'transfer' ? 'VA Transfer' : 'Potong Gaji',
                    strtoupper($order->status)
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export Orders to PDF (Print View)
     */
    public function exportPdf(Request $request)
    {
        $rows = Order::orderBy('created_at', 'desc');

        if (!empty($request->status)) $rows->where('status', $request->status);
        if (!empty($request->wilayah)) $rows->where('wilayah_kerja', $request->wilayah);
        if (!empty($request->payment)) $rows->where('payment_mechanism', $request->payment);

        $data['rows'] = $rows->get();
        $data['title'] = "Recap Orders";
        $data['filter'] = [
            'status' => $request->status,
            'wilayah' => $request->wilayah,
            'payment' => $request->payment
        ];

        return view($this->view.'.recap_pdf', $data);
    }
}
