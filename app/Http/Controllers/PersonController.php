<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index() {
        return Person::with('skills')->get();
    }

    public function show($id) {
        $person = Person::with('skills')->find($id); //with('skills')->
                
        //usando foreach
        /*foreach($person->skills as $skill) {
            echo $skill->skills_of_person;
        }*/

        //acessando diretamente, precisa colocar o indice zero (já que esta buscando um unico registro)
        echo $person->skills[0]->skills_of_person->playable;
    }

    public function store(Request $request) {          
        $person = Person::create($request->all());        
    }

    public function update(Request $request, $id) {          
        $person = Person::find($id);
        $person->skills()->attach($request->skill_id);
        return $person->save();
    }
}
