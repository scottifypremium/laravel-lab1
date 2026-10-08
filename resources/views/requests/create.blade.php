<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">New request</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white shadow p-6">
        <form method="POST" action="{{ route('requests.store') }}">
            @csrf

            <label class="block mt-2">Item name</label>
            <input type="text" name="item_name" value="{{ old('item_name') }}" class="border rounded w-full px-2 py-1">
            @error('item_name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

            <label class="block mt-2">Quantity</label>
            <input type="number" name="quantity" value="{{ old('quantity') }}" min="1" class="border rounded w-full px-2 py-1">
            @error('quantity') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

            <label class="block mt-2">Purpose</label>
            <textarea name="purpose" rows="4" class="border rounded w-full px-2 py-1">{{ old('purpose') }}</textarea>
            @error('purpose') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

            <button type="submit" class="mt-4 px-4 py-2 bg-gray-800 text-white rounded">Submit</button>
        </form>
    </div>
</x-app-layout>