<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Request #{{ $serviceRequest->id }}</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white shadow p-6">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <p><strong>Requester:</strong> {{ $serviceRequest->requester_name }} ({{ $serviceRequest->requester_email }})</p>
        <p><strong>Item:</strong> {{ $serviceRequest->item_name }}</p>
        <p><strong>Quantity:</strong> {{ $serviceRequest->quantity }}</p>
        <p><strong>Purpose:</strong> {{ $serviceRequest->purpose }}</p>
        <p><strong>Status:</strong> {{ $serviceRequest->status }}</p>

        @can('updateStatus', $serviceRequest)
            <form method="POST" action="{{ route('requests.status.update', $serviceRequest) }}" class="mt-4">
                @csrf
                @method('PATCH')
                <select name="status" class="border rounded px-2 py-1">
                    @foreach (['pending', 'approved', 'rejected'] as $s)
                        <option value="{{ $s }}" @selected($serviceRequest->status === $s)>{{ $s }}</option>
                    @endforeach
                </select>
                @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                <button type="submit" class="px-3 py-1 bg-gray-800 text-white rounded">Update status</button>
            </form>
        @endcan

        <a href="{{ route('requests.index') }}" class="inline-block mt-4 underline">Back to list</a>
    </div>
</x-app-layout>