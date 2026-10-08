<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Requests</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        @can('create', App\Models\ServiceRequest::class)
            <a href="{{ route('requests.create') }}" class="inline-block mb-4 px-4 py-2 bg-gray-800 text-white rounded">New request</a>
        @endcan

        <form method="GET" action="{{ route('requests.index') }}" class="mb-4">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search item" class="border rounded px-2 py-1">
            <button type="submit" class="px-3 py-1 border rounded">Search</button>
        </form>

        <table class="w-full bg-white shadow text-sm">
            <thead>
                <tr class="text-left border-b">
                    <th class="p-2">ID</th><th class="p-2">Requester</th><th class="p-2">Item</th>
                    <th class="p-2">Qty</th><th class="p-2">Status</th><th class="p-2"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($requests as $r)
                    <tr class="border-b">
                        <td class="p-2">{{ $r->id }}</td>
                        <td class="p-2">{{ $r->requester_name }}</td>
                        <td class="p-2">{{ $r->item_name }}</td>
                        <td class="p-2">{{ $r->quantity }}</td>
                        <td class="p-2">{{ $r->status }}</td>
                        <td class="p-2"><a class="underline" href="{{ route('requests.show', $r) }}">View</a></td>
                    </tr>
                @empty
                    <tr><td class="p-2" colspan="6">No requests found.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $requests->links() }}</div>
    </div>
</x-app-layout>