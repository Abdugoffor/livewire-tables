<div class="flex space-x-2">
    <button wire:click="$emit('edit', {{ $row->id }})" class="px-2 py-1 bg-blue-500 text-white rounded">Edit</button>
    <button wire:click="$emit('delete', {{ $row->id }})"
        class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
</div>
