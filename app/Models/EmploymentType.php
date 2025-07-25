<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmploymentType extends Model
{
    protected $fillable = ['name'];

    public function persons()
    {
        return $this->hasMany(Person::class);
    }
}
