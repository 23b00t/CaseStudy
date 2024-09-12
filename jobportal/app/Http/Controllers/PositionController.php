<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Position;
// Make the views available
use Illuminate\Support\Facades\View;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allPositions = Position::all();

        return View::make('positions.index')
            ->with('allPositions', $allPositions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View::make('positions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePositionRequest $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'salary' => 'required|integer',
        ]);

        Position::create($request->all());

        return redirect()->route('positions.index')
            ->with('success', 'Jobanzeige erfolgreich erstellt!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Eager loading of company to have in the view access to $position->company->name
        $position = Position::with('company')->find($id);
        return View::make('positions.show')
            ->with('position', $position);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $id)
    {
        $position = Position::find($id);

        return View::make(positions.edit)
            ->with('position', $position);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePositionRequest $request, Position $position)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'salary' => 'required|integer',
        ]);

        $position->update($request->all());

        return redirect()->route('positions.index')
            ->with('success', 'Jobanzeige erfolgreich aktualisiert!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $id)
    {
        $position = Position::find($id);
        $position->delete();

        return redirect()->route('positions.index')
            ->with('success', 'Jobanzeige erfolgreich gelöscht!');
    }
}
