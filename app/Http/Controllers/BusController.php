<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BusController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Bus $bus)
    {
        return view('book-ride', compact('bus'));
    }

    public function link(Request $request, Bus $bus)
    {
        $user = Auth::user();
        $ticketCount = $request->input('ticketCount');
        $earnedtickets = $ticketCount * 10;

        if ($request->has('usePoints')) {
            if ($user->points >= 100) {
                $user->points -= 100;
            }
        }

        $user->points += $earnedtickets;
        $user->save();
        $user->buses()->attach($bus->id);

        return redirect()->route('festivals');
    }
}
