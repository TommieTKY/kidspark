<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Instructor;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;

class ProgramController extends Controller
{
    public function index()
    {
        return view('programs.index', [
            'programs' => Program::all(),
        ]);
    }

    public function create()
    {
        return view('programs.create')->with('instructors', Instructor::all());
    }

    public function store(StoreProgramRequest $request)
    {
        $program = Program::create($request->validated());
        $program->instructors()->attach($request->input('instructors'));
        return redirect()->route('programs.index')
            ->with('message', 'Program has been added!');
    }

    public function show(Program $program)
    {
        $program->load('instructors');
        return view('programs.show', compact('program'));
    }

    public function edit(Program $program)
    {
        return view('programs.edit', compact('program'))
            ->with('instructors', Instructor::all());
    }

    public function update(UpdateProgramRequest $request, Program $program)
    {
        $program -> update($request -> validated());
        $program->instructors()->sync($request->input('instructors'));
        return redirect() -> route('programs.index')
            ->with('message', 'Program has been updated!');
    }

    public function destroy(Program $program)
    {
        // ddd($program); dump die debug
        Program::destroy($program->id);
        return redirect()->route('programs.index')
            ->with('message', 'Program has been deleted!');
        
    }
}
