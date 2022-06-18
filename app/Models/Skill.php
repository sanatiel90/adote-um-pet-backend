<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['desc'];

    public function persons() {
        return $this->belongsToMany(Person::class, 'skills_of_person')->as('skills_of_person')->withPivot('playable');
    }
}
