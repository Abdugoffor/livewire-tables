<div>
    <!-- Button to open the sidebar -->
    <button wire:click="createProstoy" class="px-4 py-2 bg-blue-500 text-white rounded mb-4">
        Добавить
    </button>

    <!-- Sidebar -->
    @if ($prostoyForm)
        <div class="fixed inset-0 flex justify-end z-50">
            <!-- Background Overlay -->
            <div class="absolute inset-0 bg-gray-600 bg-opacity-50" wire:click="createProstoy"></div>

            <!-- Sidebar Form -->
            <div class="w-[45rem] bg-white shadow-lg z-50 max-h-screen overflow-y-auto"> <!-- Scrolling qo'shildi -->
                <div class="p-8"> <!-- Padding oshirildi -->
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

                        <!-- Client ID -->
                        <div class="mb-6">
                            <label for="client_id" class="block text-base font-medium text-gray-700">Client</label>
                            <select id="client_id" wire:model="client_id"
                                class="mt-2 block w-full border-gray-300 rounded shadow-sm">
                                <option value="">Client</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Carrier ID -->
                        <div class="mb-6">
                            <label for="carrier_id" class="block text-base font-medium text-gray-700">Carrier</label>
                            <select id="carrier_id" wire:model="carrier_id"
                                class="mt-2 block w-full border-gray-300 rounded shadow-sm">
                                <option value="">Carrier</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('carrier_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Sales ID -->
                        <div class="mb-6">
                            <label for="sales_id" class="block text-base font-medium text-gray-700">Sales</label>
                            <select id="sales_id" wire:model="sales_id"
                                class="mt-2 block w-full border-gray-300 rounded shadow-sm">
                                <option value="">Select Client</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('sales_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Operation ID -->
                        <div class="mb-6">
                            <label for="operation_id" class="block text-base font-medium text-gray-700">Operation</label>
                            <select id="operation_id" wire:model="operation_id"
                                class="mt-2 block w-full border-gray-300 rounded shadow-sm">
                                <option value="">Operation</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('operation_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="carrier_amount" class="block text-base font-medium text-gray-700">Carrier
                                Amount</label>
                            <div class="flex items-center">
                                <input type="number" id="carrier_amount" wire:model="carrier_amount" value="123"
                                    class="mt-2 block w-full border-gray-300 rounded shadow-sm mr-4">
                                <select wire:model="carrier_currency"
                                    class="mt-2 block border-gray-300 rounded shadow-sm">
                                    <option value="uzs">UZS</option>
                                    <option value="usd" selected>USD</option>
                                    <option value="eur">EUR</option>
                                    <option value="rub">RUB</option>
                                </select>
                            </div>
                            @error('carrier_amount')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Client Amount -->
                        <div class="mb-6">
                            <label for="client_amount" class="block text-base font-medium text-gray-700">Client
                                Amount</label>
                            <div class="flex items-center">
                                <input type="number" id="client_amount" wire:model="client_amount" value="123"
                                    class="mt-2 block w-full border-gray-300 rounded shadow-sm mr-4">
                                <select wire:model="client_currency"
                                    class="mt-2 block border-gray-300 rounded shadow-sm">
                                    <option value="uzs">UZS</option>
                                    <option value="usd" selected>USD</option>
                                    <option value="eur">EUR</option>
                                    <option value="rub">RUB</option>
                                </select>
                            </div>
                            @error('client_amount')
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
