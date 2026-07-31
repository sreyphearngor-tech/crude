<div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">

    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table class="min-w-full text-left">

            {{-- HEADER --}}
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-4">User</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Joined</th>
                    <th class="px-6 py-4 text-right">Action</th>
                </tr>
            </thead>

            {{-- BODY --}}
            <tbody class="divide-y divide-gray-100">

                @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition">

                        {{-- USER --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">

                                @if($user->image)
                                    <img src="{{ asset('storage/'.$user->image) }}"
                                         class="w-10 h-10 rounded-full object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center font-bold text-blue-600">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif

                                <div class="font-semibold">
                                    {{ $user->name }}
                                </div>

                            </div>
                        </td>

                        {{-- EMAIL --}}
                        <td class="px-6 py-4 text-gray-600">
                            {{ $user->email }}
                        </td>

                        {{-- ROLE --}}
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs rounded-lg font-semibold
                                {{ $user->role === 'admin'
                                    ? 'bg-purple-100 text-purple-700'
                                    : 'bg-green-100 text-green-700' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>

                        {{-- DATE --}}
                        <td class="px-6 py-4 text-gray-500">
                            {{ $user->created_at->format('d M Y') }}
                        </td>

                        {{-- ACTION --}}
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="text-blue-600 hover:underline">
                                Edit
                            </a>
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-gray-500">
                            No users found
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</div>

{{-- PAGINATION (IMPORTANT: must stay inside AJAX container) --}}
<div class="mt-5 ajax-pagination">
    {{ $users->appends(request()->only('search'))->links() }}
</div>
