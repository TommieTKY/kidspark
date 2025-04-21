<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Http\Requests\StoreInstructorRequest;
use App\Http\Requests\UpdateInstructorRequest;
use Illuminate\Support\Facades\Storage;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('instructors.index', [
            'instructors' => Instructor::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('instructors.create')->with('instructors', Instructor::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreInstructorRequest $request)
    // {
    //     if ($request->hasFile('icon')) {
    //         $data['icon'] = $request->file('icon')->store('instructors', 'public');
    //     }

    //     $instructor = Instructor::create($request->validated());
    //     return redirect()->route('instructors.index')
    //         ->with('message', 'Instructor created successfully');
    // }
    public function store(StoreInstructorRequest $request)
    {
        $validatedData = $request->validated();
        $data = $validatedData; 

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('instructors', 'public');
        }

        $instructor = Instructor::create($data); 
        return redirect()->route('instructors.index')
            ->with('message', 'Instructor created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Instructor $instructor)
    {
        return view('instructors.show', compact('instructor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instructor $instructor)
    {
        return view('instructors.edit', compact('instructor'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateInstructorRequest $request, Instructor $instructor)
    // {
    //     if ($request->hasFile('icon')) {
    //         // delete old file
    //         if ($instructor->icon) {
    //             Storage::disk('public')->delete($instructor->icon);
    //         }
    //         // save new file
    //         $data['icon'] = $request->file('icon')->store('instructors', 'public');
    //     }

    //     $instructor->update($request->validated());
    //     return redirect()->route('instructors.index')
    //         ->with('message', 'Instructor updated successfully');
    // }
    public function update(UpdateInstructorRequest $request, Instructor $instructor)
    {
        $validatedData = $request->validated();
        $data = $validatedData; 

        if ($request->hasFile('icon')) {
            if ($instructor->icon) {
                Storage::disk('public')->delete($instructor->icon);
            }
            $data['icon'] = $request->file('icon')->store('instructors', 'public');
        }

        $instructor->update($data); 
        return redirect()->route('instructors.index')
            ->with('message', 'Instructor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor $instructor)
    {
        Instructor::destroy($instructor->id);
        return redirect()->route('instructors.index')
            ->with('message', 'Instructor deleted successfully');
    }
}
