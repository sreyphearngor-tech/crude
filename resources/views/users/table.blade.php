<table class="w-full text-left">
    <thead>
        <tr class="bg-gray-50 border-b">
            <th class="px-6 py-4 text-gray-600 font-semibold">User Info</th>
            <th class="px-6 py-4 text-gray-600 font-semibold">Role</th>
            <th class="px-6 py-4 text-gray-600 font-semibold">Joined Date</th>
            <th class="px-6 py-4 text-gray-600 font-semibold text-right">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr class="border-b hover:bg-gray-50 transition">
            <td class="px-6 py-4">
                <div class="font-bold text-gray-800">{{ $user->name }}</div>
                <div class="text-sm text-gray-500">{{ $user->email }}</div>
            </td>
            <td class="px-6 py-4">
                @if($user->role === 'admin')
                    <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                        Admin
                    </span>
                @else
                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                        Client
                    </span>
                @endif
            </td>
            <td class="px-6 py-4 text-gray-600 text-sm">
                {{ $user->created_at->format('d M, Y') }}
            </td>
            <td class="px-6 py-4 text-right">
                <div class="flex justify-end gap-3">
                    <a href="{{ route('user.edit', $user->id) }}" class="text-blue-500 hover:underline">Edit</a>

                    @if(auth()->id() !== $user->id)
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('តើអ្នកពិតជាចង់លុបអ្នកប្រើប្រាស់នេះមែនទេ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-4">
    {{ $users->links() }}
</div>
