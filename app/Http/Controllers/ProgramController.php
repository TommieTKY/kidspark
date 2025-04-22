<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Instructor;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use Illuminate\Support\Facades\Storage;

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
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('programs', 'public');
        }

        $program = Program::create($data); 
        $program->instructors()->attach($request->input('instructors'));
        return redirect()->route('programs.index')
            ->with('message', 'Program created successfully');
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
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($program->image) {
                Storage::disk('public')->delete($program->image);
            }
            $data['image'] = $request->file('image')->store('programs', 'public');
        }

        $program->update($data); 
        $program->instructors()->sync($request->input('instructors'));
        return redirect()->route('programs.show', $program->id)
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
