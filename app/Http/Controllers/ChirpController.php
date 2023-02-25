<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Responsable
    {
        return Inertia::render('Chrips/Index', [
            'chirps' => Chirp::with('user:id,name')->latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|min:1|max:255'
        ]);

        $request->user()->chirps()->create($validated);

        return redirect()->route('chirps.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp): RedirectResponse
    {
        $this->authorize('update', $chirp);

        $validated = $request->validate([
            'message' => 'required|string|min:1|max:255'
        ]);

        $chirp->update($validated);

        return redirect()->route('chirps.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
        $this->authorize('delete', $chirp);

        $chirp->delete();

        return redirect()->route('chirps.index');
    }
}
