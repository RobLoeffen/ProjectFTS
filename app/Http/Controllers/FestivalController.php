<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class FestivalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Festivals = Festival::paginate(10);
        return view('Festivals.index', compact('Festivals'));
    }

    public function paginate(): View
    {
        return view('list', [
            'Festivals' => DB::table('festivals')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all available buses that aren't assigned to a festival yet
        $availableBuses = Bus::whereNull('festival_id')->get();
        return view('Festivals.create', compact('availableBuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|max:1000',
            'buses' => 'nullable|array',
            'buses.*' => 'exists:buses,id',
        ]);

        $festival = Festival::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        // Assign selected buses to the festival
        if ($request->has('buses')) {
            foreach ($request->buses as $busId) {
                $bus = Bus::find($busId);
                if ($bus) {
                    $bus->festival_id = $festival->id;
                    $bus->save();
                }
            }
        }

        return redirect()->route('Festivals.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Festival $Festival): View
    {
        $Festival = Festival::with('buses')->findOrFail($Festival->id);

        return view('festival-detail', compact('Festival'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Festival $Festival)
    {
        // Get buses already assigned to this festival
        $assignedBuses = $Festival->buses;

        // Get all available buses that aren't assigned to any festival
        $availableBuses = Bus::whereNull('festival_id')->get();

        return view('Festivals.edit', compact('Festival', 'assignedBuses', 'availableBuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Festival $Festival)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|max:1000',
            'buses' => 'nullable|array',
            'buses.*' => 'exists:buses,id',
        ]);

        $Festival->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        // Handle bus assignments
        // First, unassign all buses currently assigned to this festival
        Bus::where('festival_id', $Festival->id)->update(['festival_id' => null]);

        // Then assign the selected buses to this festival
        if ($request->has('buses')) {
            foreach ($request->buses as $busId) {
                $bus = Bus::find($busId);
                if ($bus) {
                    $bus->festival_id = $Festival->id;
                    $bus->save();
                }
            }
        }

        return redirect()->route('Festivals.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Festival $Festival)
    {
        // Unassign all buses from this festival before deleting
        Bus::where('festival_id', $Festival->id)->update(['festival_id' => null]);

        $Festival->delete();

        return redirect()->route('Festivals.index');
    }
}
