<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



///CARAI: o eloquent entende o nome da tabela como o plural em ingles do nome do model, e o plural de Person é PEOPLE, entao
//ele acha q a tabela no BD é PEOPLE (e não persons, como foi criado)
class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';

    protected $fillable = ['name'];

    public function skills() {
        return $this->belongsToMany(Skill::class, 'skills_of_person')->as('skills_of_person')->withPivot('playable');
    }
}
