@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-6">Customer Orders</h2>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    <th class="px-5 py-3 border-b-2">Order ID</th>
                    <th class="px-5 py-3 border-b-2">Customer</th>
                    <th class="px-5 py-3 border-b-2">Total Price</th>
                    <th class="px-5 py-3 border-b-2">Status</th>
                    <th class="px-5 py-3 border-b-2">Date</th>
                    <th class="px-5 py-3 border-b-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">#{{ $order->id }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $order->first_name }}</p>
                        <p class="text-gray-600 whitespace-no-wrap text-xs">{{ $order->email }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">${{ number_format($order->total_price, 2) }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <span class="relative inline-block px-3 py-1 font-semibold leading-tight
                            {{ $order->status == 'delivered' ? 'text-green-900' : ($order->status == 'cancelled' ? 'text-red-900' : 'text-orange-900') }}">
                            <span class="absolute inset-0 {{ $order->status == 'delivered' ? 'bg-green-200' : ($order->status == 'cancelled' ? 'bg-red-200' : 'bg-orange-200') }} opacity-50 rounded-full"></span>
                            <span class="relative text-xs uppercase">{{ $order->status }}</span>
                        </span>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">{{ $order->created_at->format('M d, Y') }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-900 font-medium">View Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-5 py-5 bg-white border-t">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
