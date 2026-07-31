<table class="w-full text-left">
    <thead>
        <tr class="bg-gray-50/50">
            <th class="p-5 text-[10px] font-black uppercase text-gray-400 tracking-widest">Order ID</th>
            <th class="p-5 text-[10px] font-black uppercase text-gray-400 tracking-widest">Customer</th>
            <th class="p-5 text-[10px] font-black uppercase text-gray-400 tracking-widest">Status</th>
            <th class="p-5 text-[10px] font-black uppercase text-gray-400 tracking-widest">Total</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-50">
        @foreach($recentOrders as $order)
        <tr class="hover:bg-gray-50/50 transition">
            <td class="p-5 font-mono text-xs font-bold text-blue-600">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
            <td class="p-5">
                <div class="font-bold text-sm text-gray-800">{{ $order->user->name ?? 'Guest' }}</div>
                <div class="text-[10px] text-gray-400">{{ $order->created_at->diffForHumans() }}</div>
            </td>
            <td class="p-5">
                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $order->status === 'pending' ? 'bg-orange-100 text-orange-600' : 'bg-green-100 text-green-600' }}">
                    {{ $order->status }}
                </span>
            </td>
            <td class="p-5 font-black text-gray-900">${{ number_format($order->total_amount, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
