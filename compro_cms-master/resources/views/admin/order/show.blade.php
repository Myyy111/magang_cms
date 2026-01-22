@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="container-fluid">
    
    <!-- start page title -->
    <!-- Include page breadcrumb -->
    @include('admin.inc.breadcrumb')
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <a href="{{ route($route.'.index') }}" class="btn btn-info">{{ __('dashboard.back') }}</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Order Details: #{{ $row->order_number }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Customer Info</h5>
                            <p><strong>Name:</strong> {{ $row->customer_name }}</p>
                            <p><strong>Contact:</strong> {{ $row->customer_contact }}</p>
                            <p><strong>ID Number:</strong> {{ $row->customer_id_num }}</p>
                            <p><strong>Unit/Division:</strong> {{ $row->customer_unit }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Shipping Info</h5>
                            <p><strong>Address:</strong><br> {{ $row->shipping_address ?: '-' }}</p>
                            <p><strong>Order Date:</strong><br> {{ $row->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    <hr>

                    <h5>Order Items</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($row->items as $item)
                                <tr>
                                    <td>
                                        @if($item->product)
                                        {{ $item->product->title }}
                                        @else
                                        <span class="text-danger">Product Deleted</span>
                                        @endif
                                    </td>
                                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">Grand Total</th>
                                    <th>Rp {{ number_format($row->total_amount, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Update Status</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route($route.'.update', $row->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="status">Order Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="pending" {{ $row->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $row->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="completed" {{ $row->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="failed" {{ $row->status == 'failed' ? 'selected' : '' }}>Failed</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div> <!-- container -->
<!-- End Content-->

@endsection
