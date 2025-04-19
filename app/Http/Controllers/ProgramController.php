<?php

namespace App\Http\Controllers;

use App\Models\Program;
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
        return view('programs.create')->with('programs', Program::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProgramRequest $request)
    {
        $program = Program::create($request->validated());
        // $program -> instructor() -> attach($request -> instructor);
        return redirect()->route('programs.index')
            ->with('message', 'Program has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        return view('programs.edit', [
            'program' => $program,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgramRequest $request, Program $program)
    {
        $program -> update($request -> validated());
        return redirect() -> route('programs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        // ddd($program); dump die debug
        Program::destroy($program->id);
        return redirect()->route('programs.index')
            ->with('message', 'Program has been deleted!');
        
    }
}
