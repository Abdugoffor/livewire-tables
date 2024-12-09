<div>
    <!-- Button to open the sidebar -->
    <button wire:click="createExpense" class="px-4 py-2 bg-blue-500 text-white rounded mb-4">
        Добавить
    </button>

    <!-- Sidebar -->
    @if ($activeForm)
        <div class="fixed inset-0 flex justify-end z-50">
            <!-- Background Overlay -->
            <div class="absolute inset-0 bg-gray-600 bg-opacity-50" wire:click="createExpense"></div>

            <!-- Sidebar Form -->
            <div class="w-[45rem] bg-white shadow-lg z-50 max-h-screen overflow-y-auto">
                <div class="p-8">
                    <h2 class="text-2xl font-bold mb-6">{{ $id ? 'Редактировать Простой' : 'Создать Простой' }}</h2>
                    <form wire:submit.prevent="save">
                        <!-- Order ID -->
                        <div class="mb-6">
                            <label for="order_id" class="block text-base font-medium text-gray-700">Order ID</label>
                            <input type="number" id="order_id" wire:model="order_id" value="123"
                                class="mt-2 block w-full border-gray-300 rounded shadow-sm">
                            @error('order_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Supplier ID -->
                        <div class="mb-6">
                            <label for="supplier_id" class="block text-base font-medium text-gray-700">Supplier</label>
                            <select id="supplier_id" wire:model="supplier_id"
                                class="mt-2 block w-full border-gray-300 rounded shadow-sm">
                                <option value="">Select Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Reason ID -->
                        <div class="mb-6">
                            <label for="reason_id" class="block text-base font-medium text-gray-700">Reason</label>
                            <select id="reason_id" wire:model="reason_id"
                                class="mt-2 block w-full border-gray-300 rounded shadow-sm">
                                <option value="">Select Reason</option>
                                @foreach ($reasons as $reason)
                                    <option value="{{ $reason->id }}">{{ $reason->name }}</option>
                                @endforeach
                            </select>
                            @error('reason_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Currency -->
                        <div class="mb-6">
                            <label for="currency" class="block text-base font-medium text-gray-700">Currency</label>
                            <select id="currency" wire:model="currency"
                                class="mt-2 block w-full border-gray-300 rounded shadow-sm">
                                <option value="uzs">UZS</option>
                                <option value="usd">USD</option>
                                <option value="eur">EUR</option>
                                <option value="rub">RUB</option>
                            </select>
                            @error('currency')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Amount -->
                        <div class="mb-6">
                            <label for="amount" class="block text-base font-medium text-gray-700">Amount</label>
                            <input type="number" id="amount" wire:model="amount" value="123"
                                class="mt-2 block w-full border-gray-300 rounded shadow-sm">
                            @error('amount')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end">
                            <button type="button" wire:click="resetForm"
                                class="px-6 py-3 bg-gray-500 text-white rounded mr-4">
                                Отмена
                            </button>
                            <button type="submit" class="px-6 py-3 bg-blue-500 text-white rounded">
                                Сохранить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
