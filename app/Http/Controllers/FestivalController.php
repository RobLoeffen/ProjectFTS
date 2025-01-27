<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Festival;
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
        return view('Festivals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|max:1000',
        ]);

        $festival= Festival::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        $numerOfBuses = rand(1,3);

        for ($i = 0; $i < $numerOfBuses; $i++) {
            Bus::factory()->create([
                'festival_id' => $festival->id,
            ]);
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
        return view('Festivals.edit', compact('Festival'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Festival $Festival)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|max:1000',
        ]);

        $Festival->update([
           'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('Festivals.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Festival $Festival)
    {
        $Festival->delete();

        return redirect()->route('Festivals.index');
    }
}
