<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $table = "employee";
    protected $fillable = array(
        'name',
        'designation',
        'status',
        'wage',
        'joinedDate'
    );
}
