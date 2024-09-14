<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Position;
use App\Models\Company;
use App\Models\Category;

// Make the views available
use Illuminate\Support\Facades\View;

// Authorization
use Illuminate\Support\Facades\Gate;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Show newest first, 20 per page
        $allPositions = Position::orderBy('updated_at', 'desc')->paginate(20);

        return View::make('positions.index')
            ->with('allPositions', $allPositions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Link policy
        Gate::authorize('create', Position::class);

        // Get all Categories to select one during creation process
        $categories = Category::all();

        return view('positions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePositionRequest $request)
    {
        // Validate request
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'salary' => 'required|integer',
            'category_id' => 'required|integer',
        ]);

        // Get the Company the user has created
        $userId = auth()->id();
        $company = Company::where('user_id', $userId)->first();

        // Create new Position
        Position::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'location' => $request->input('location'),
            'salary' => $request->input('salary'),
            'category_id' => $request->input('category_id'),
            'company_id' => $company->id,
            'user_id' => $userId,
        ]);

        return redirect()->route('positions.index')
            ->with('success', 'Jobanzeige erfolgreich erstellt!');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Eager loading of company to have in the view access to $position->company->name
        $position = Position::with('company', 'category')->find($id);

        return View::make('positions.show')
            ->with('position', $position);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $position = Position::find($id);
        // Check PositionPoicy for permission
        Gate::authorize('update', $position);

        return View::make('positions.edit')
            ->with('position', $position);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePositionRequest $request, Position $position)
    {
        $position->update($request->validated());

        return redirect()->route('positions.index')
            ->with('success', 'Jobanzeige erfolgreich aktualisiert!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        // Check PositionPoicy for permission
        Gate::authorize('delete', $position);

        $position->delete();

        return redirect()->route('positions.index')
            ->with('success', 'Jobanzeige erfolgreich gelöscht!');
    }
}
