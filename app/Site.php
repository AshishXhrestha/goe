<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    //
    protected $table = "site";
    protected $fillable = array(
        'name',
        'location',
        'owner',
        'startedDate',
        'finishDate'
    );
}
