<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Program;
use App\Http\Requests\StoreInstructorRequest;
use App\Http\Requests\UpdateInstructorRequest;

class InstructorController extends Controller
{
    public function index()
    {
        return view('instructors.index', [
            'instructors' => Instructor::all(),
        ]);
    }

    public function create()
    {
        return view('instructors.create')->with('programs', Program::all());
    }

    public function store(StoreInstructorRequest $request)
    {
        $instructor = Instructor::create($request->validated());
        $instructor->programs()->attach($request->input('programs'));
        return redirect()->route('instructors.index')
            ->with('message', 'Instructor created successfully');
    }

    public function show(Instructor $instructor)
    {
        $instructor->load('programs');
        return view('instructors.show', compact('instructor'));
    }

    public function edit(Instructor $instructor)
    {
        return view('instructors.edit', compact('instructor'))
            ->with('programs', Program::all());
    }

    public function update(UpdateInstructorRequest $request, Instructor $instructor)
    {
        $instructor->update($request->validated());
        $instructor->programs()->sync($request->input('programs'));
        return redirect()->route('instructors.index')
            ->with('message', 'Instructor updated successfully');
    }

    public function destroy(Instructor $instructor)
    {
        Instructor::destroy($instructor->id);
        return redirect()->route('instructors.index')
            ->with('message', 'Instructor deleted successfully');
    }
}
