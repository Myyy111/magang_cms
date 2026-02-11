<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
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
    public function index()
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;

        // Get unique schedules from orders
        $data['rows'] = Order::whereNotNull('dismantel_schedule')
                            ->select('dismantel_schedule')
                            ->distinct()
                            ->get();

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
    public function edit(Request $request)
    {
        $schedule = $request->schedule;
        $data['title'] = 'Edit ' . $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['schedule'] = $schedule;

        $data['orders'] = Order::with('items.product')
                               ->where('dismantel_schedule', $schedule)
                               ->orderBy('created_at', 'desc')
                               ->get();

        return view($this->view.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $schedule)
    {
        // For individual schedule updates if needed
        $request->validate([
            'dismantel_schedule' => 'required|string|max:255',
        ]);

        Order::where('dismantel_schedule', $schedule)->update([
            'dismantel_schedule' => $request->dismantel_schedule
        ]);

        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        return redirect()->route($this->route.'.index');
    }
}
