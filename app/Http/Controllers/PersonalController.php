<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function index()
    {
        $personal = Personal::all();
        $education = Education::all();
        $experience = Experience::all();
        return view('personal.index', compact('personal', 'education', 'experience'));
    }

    public function create()
    {
        return view('personal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add validation for image files
        ]);

        $personal = Personal::create([
            'deskripsi' => $request->deskripsi,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'telephone_number' => $request->telephone_number,
            'link_profile' => $request->link_profile,
            'foto' => $request->foto,
        ]);

        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotopersonal/', $request->file('foto')->getClientOriginalName());
            $personal->foto = $request->file('foto')->getClientOriginalName();
            $personal->save();
        }

        if ($request->has('education') && is_array($request->input('education'))) {
            foreach ($request->input('education') as $eduData) {
                $personal->education()->create([
                    'Edu_institution' => $eduData['Edu_institution'],
                    'Loc_edu' => $eduData['Loc_edu'],
                    'Start_date_edu' => $eduData['Start_date_edu'],
                    'End_date_edu' => $eduData['End_date_edu'],
                    'Achievment' => $eduData['Achievment'],
                    'Education_level' => $eduData['Education_level'],
                ]);
            }
        }

        if ($request->has('experience') && is_array($request->input('experience'))) {
            foreach ($request->input('experience') as $expData) {
                $personal->experience()->create([
                    'Company_name' => $expData['Company_name'],
                    'Loc_org' => $expData['Loc_org'],
                    'Start_date_org' => $expData['Start_date_org'],
                    'End_date_org' => $expData['End_date_org'],
                    'Job_desc' => $expData['Job_desc'],
                    'Job_title' => $expData['Job_title'],
                ]);
            }
        }

        return redirect('personal')->with('message', 'Personal Added');
    }

    public function edit(Personal $personal)
    {
        return view('personal.edit', compact('personal'));
    }

    public function update(Personal $personal, Request $request)
    {
        $request->validate([
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add validation for image files
        ]);

        $personal->update([
            'deskripsi' => $request->deskripsi,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'telephone_number' => $request->telephone_number,
            'link_profile' => $request->link_profile,
        ]);

        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotopersonal/', $request->file('foto')->getClientOriginalName());
            $personal->foto = $request->file('foto')->getClientOriginalName();
            $personal->save();
        }

        foreach (($request->input('education') ?? []) as $key => $eduData) {
            if (isset($personal->education[$key])) {
                $personal->education[$key]->update([
                    'Edu_institution' => $eduData['Edu_institution'],
                    'Loc_edu' => $eduData['Loc_edu'],
                    'Start_date_edu' => $eduData['Start_date_edu'],
                    'End_date_edu' => $eduData['End_date_edu'],
                    'Achievment' => $eduData['Achievment'],
                    'Education_level' => $eduData['Education_level'],
                ]);
            }
        }

        foreach (($request->input('experience') ?? []) as $key => $expData) {
            if (isset($personal->experience[$key])) {
                $personal->experience[$key]->update([
                    'Company_name' => $expData['Company_name'],
                    'Loc_org' => $expData['Loc_org'],
                    'Start_date_org' => $expData['Start_date_org'],
                    'End_date_org' => $expData['End_date_org'],
                    'Job_desc' => $expData['Job_desc'],
                    'Job_title' => $expData['Job_title'],
                ]);
            }
        }

        return redirect('personal')->with('message', 'Data successfully updated!');
    }

    public function destroy(Personal $personal)
    {
        $personal->delete();
        return redirect('personal')->with('message', 'Data successfully deleted!');
    }
    public function ats(Personal $personal)
    {
        $personal->load('education', 'experience');
        return view('cvtemplates.ATS', compact('personal'));
    }

    public function cvats(Personal $personal)
    {
        $personal->load('education', 'experience');
        return view('cvats', compact('personal'));
    }

}