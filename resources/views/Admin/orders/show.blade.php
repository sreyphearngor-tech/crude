@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Order Details #{{ $order->id }}</h2>
        <a href="{{ route('admin.orders.index') }}" class="text-gray-600 hover:underline">← Back to List</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- ព័ត៌មានអតិថិជន និងការដឹកជញ្ជូន -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="font-bold border-b pb-2 mb-4">Shipping Information</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <p><span class="text-gray-500">Name:</span> {{ $order->first_name }}</p>
                    <p><span class="text-gray-500">Phone:</span> {{ $order->phone }}</p>
                    <p><span class="text-gray-500">Email:</span> {{ $order->email }}</p>
                    <p><span class="text-gray-500">City:</span> {{ $order->city }}</p>
                    <p class="col-span-2"><span class="text-gray-500">Address:</span> {{ $order->address }}, {{ $order->apartment }}</p>
                </div>
            </div>

            <!-- បញ្ជីទំនិញក្នុង Order -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="font-bold border-b pb-2 mb-4">Items Ordered</h3>
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-xs uppercase text-gray-400 border-b">
                            <th class="py-2">Product</th>
                            <th class="py-2">Price</th>
                            <th class="py-2 text-center">Qty</th>
                            <th class="py-2 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                        <tr class="border-b last:border-none text-sm">
                            <td class="py-4 flex items-center gap-3">
                                <img src="{{ asset($item->product->image) }}" class="w-10 h-10 object-contain">
                                <span>{{ $item->product->name }}</span>
                            </td>
                            <td class="py-4">${{ number_format($item->price, 2) }}</td>
                            <td class="py-4 text-center">{{ $item->quantity }}</td>
                            <td class="py-4 text-right font-medium">${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ស្ថានភាព និងការទូទាត់ -->
        <div class="space-y-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="font-bold border-b pb-2 mb-4">Order Summary</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between"><span>Payment Method:</span> <span class="uppercase">{{ $order->payment_method }}</span></div>
                    <div class="flex justify-between font-bold text-lg border-t pt-3">
                        <span>Total Amount:</span>
                        <span class="text-exclusive-red">${{ number_format($order->total_price, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Form ប្តូរ Status -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="font-bold border-b pb-2 mb-4">Update Status</h3>
                <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="w-full border rounded p-2 mb-4">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="w-full bg-black text-white py-2 rounded hover:bg-gray-800 transition">Update Status</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
