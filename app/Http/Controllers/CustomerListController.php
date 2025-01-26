<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class CustomerListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $CustomerLists = User::with('buses')->paginate(10);
        return view('CustomerList.index', compact('CustomerLists'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('CustomerList.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:customer,employee',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'points' => 0
        ]);

        return redirect()->route('CustomerList.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $CustomerList): View
    {
        return view('CustomerList.show', compact('CustomerList'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $CustomerList)
    {
        return view('CustomerList.edit', compact('CustomerList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $CustomerList)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|in:customer,employee',
            'points' => 'required|integer|min:0',
        ]);

        $CustomerList->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'points' => $validated['points'],
        ]);

        return redirect()->route('CustomerList.index')
            ->with('success', 'Customer updated successfully');
    }

    public function detachBus(User $customer, Bus $bus)
    {
        $customer->buses()->detach($bus->id);
        return redirect()->route('CustomerList.index')->with('success', 'Ride cancelled successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $CustomerList)
    {
        $CustomerList->delete();

        return redirect()->route('CustomerList.index');
    }
}
