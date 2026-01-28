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
    public function index()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;

        $data['rows'] = Order::orderBy('created_at', 'desc')->get();

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
            'status' => 'required|in:pending,paid,completed,failed',
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        $acceptedStatuses = ['paid', 'completed'];
        $notAcceptedStatuses = ['pending', 'failed'];

        // If status changes FROM (Pending/Failed) TO (Paid/Completed) -> Reduce Stock
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

        return redirect()->back();
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
        $acceptedStatuses = ['paid', 'completed'];
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
}
