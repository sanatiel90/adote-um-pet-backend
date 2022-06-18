<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index() {
        return Skill::with('persons')->get();
    }

    public function store(Request $request) {
        if ($request->id) {
            $skill = Skill::find($request->id);
            $skill->update($request->all());
            
            return $skill;
        } else {
            $skill = Skill::create($request->all());
            if($request->person_id) {
                $skill->persons()->attach($request->person_id);
                $skill->save();
                $skill->refresh();
            }            
            return $skill;
        }
        
    }
}
