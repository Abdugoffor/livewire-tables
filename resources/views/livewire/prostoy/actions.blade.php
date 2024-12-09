<div class="flex space-x-2">
    <button wire:click="sendToChild({{ $row->id }})" class="px-2 py-1 bg-blue-500 text-white rounded">
        изменить
    </button>

    <button wire:click="delete({{ $row->id }})" class="px-2 py-1 bg-red-500 text-white rounded">
        удалить
    </button>
</div>
