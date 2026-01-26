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

        // If status changes to 'failed' from a non-failed status, restore stock
        if ($newStatus == 'failed' && $oldStatus != 'failed') {
            foreach ($order->items as $item) {
                // Restore main product stock
                Product::where('id', $item->product_id)->increment('stock', $item->quantity);
                
                // Restore variant stock
                if ($item->variant_ids) {
                    foreach ($item->variant_ids as $vid) {
                        \App\Models\ProductVariant::where('id', $vid)->increment('stock', $item->quantity);
                    }
                }
            }
        }
        
        // If status changes FROM 'failed' to something else, reduce stock again (if possible)
        if ($oldStatus == 'failed' && $newStatus != 'failed') {
            // Check if stock is available first? 
            // For simplicity in admin, we just decrement. Admin should decide.
            foreach ($order->items as $item) {
                Product::where('id', $item->product_id)->decrement('stock', $item->quantity);
                if ($item->variant_ids) {
                    foreach ($item->variant_ids as $vid) {
                        \App\Models\ProductVariant::where('id', $vid)->decrement('stock', $item->quantity);
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
        
        // Restore stock if it wasn't already failed (stock restored then)
        if ($order->status != 'failed') {
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

        return redirect()->back();
    }
}
