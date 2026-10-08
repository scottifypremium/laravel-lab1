<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ServiceRequestController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('viewAny', ServiceRequest::class);

        $query = ServiceRequest::query();

        // Students only see their own rows (ownership by user_id).
        if (! $request->user()->isAdmin()) {
            $query->where('user_id', $request->user()->id);
        }

        // The search is added after the ownership scope, so it can't widen it.
        if ($request->filled('q')) {
            $query->where('item_name', 'like', '%' . $request->string('q') . '%');
        }

        $requests = $query->orderBy('id')->paginate(10)->withQueryString();

        return view('requests.index', compact('requests'));
    }

    public function show(ServiceRequest $serviceRequest)
    {
        Gate::authorize('view', $serviceRequest);

        return view('requests.show', compact('serviceRequest'));
    }

    public function create()
    {
        Gate::authorize('create', ServiceRequest::class);

        return view('requests.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', ServiceRequest::class);

        $data = $request->validate([
            'item_name' => ['required', 'string', 'max:150'],
            'quantity'  => ['required', 'integer', 'min:1'],
            'purpose'   => ['required', 'string', 'max:2000'],
            // Students must never send these fields.
            'user_id'   => ['prohibited'],
            'status'    => ['prohibited'],
            'is_admin'  => ['prohibited'],
            'role'      => ['prohibited'],
        ]);

        $serviceRequest = new ServiceRequest([
            'item_name' => $data['item_name'],
            'quantity'  => $data['quantity'],
            'purpose'   => $data['purpose'],
        ]);

        // Trusted fields come from the signed-in account, not the form.
        $user = $request->user();
        $serviceRequest->user_id         = $user->id;
        $serviceRequest->requester_name  = $user->name;
        $serviceRequest->requester_email = $user->email;
        $serviceRequest->status          = 'pending';
        $serviceRequest->save();

        return redirect()->route('requests.show', $serviceRequest)
            ->with('success', 'Request submitted.');
    }

    public function updateStatus(Request $request, ServiceRequest $serviceRequest)
    {
        // Authorize BEFORE validating or writing anything.
        Gate::authorize('updateStatus', $serviceRequest);

        $data = $request->validate([
            'status' => ['required', 'in:pending,approved,rejected'],
        ]);

        $serviceRequest->status = $data['status']; // only status is changed
        $serviceRequest->save();

        return redirect()->route('requests.show', $serviceRequest)
            ->with('success', 'Status updated.');
    }

    
}