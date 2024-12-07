<div>
    <h1>123</h1>
    <!-- Create Button -->
    <button wire:click="openSidebar()" class="bg-green-500 text-white px-4 py-2 rounded mb-4">Add New Prostoy</button>

    <!-- Filters -->
    <div class="flex space-x-4 mb-4">
        <input wire:model="filters.title" type="text" placeholder="Filter by Title" class="border rounded p-2">
        <input wire:model="filters.description" type="text" placeholder="Filter by Description"
            class="border rounded p-2">
    </div>

    <!-- Table -->
    <table class="min-w-full border">
        <thead class="bg-gray-50">
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Client</th>
                <th class="border px-4 py-2">Amount</th>
                <th class="border px-4 py-2">Carrier Amount</th>
                <th class="border px-4 py-2">Currency</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td class="border px-4 py-2">{{ $post->id }}</td>
                    <td class="border px-4 py-2">{{ $post->client_id }}</td>
                    <td class="border px-4 py-2">{{ $post->client_amount }}</td>
                    <td class="border px-4 py-2">{{ $post->carrier_amount }}</td>
                    <td class="border px-4 py-2">{{ $post->carrier_currency }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="openSidebar({{ $post->id }})" class="text-blue-500">Edit</button>
                        <button wire:click="delete({{ $post->id }})" class="text-red-500">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
