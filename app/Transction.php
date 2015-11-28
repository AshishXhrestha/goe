<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transction extends Model
{
    //
    protected $table = "siteemployeerel";
    protected $fillable = array(
        'empId',
        'siteId',
        'workDate',
        'day',
        'ot',
        'advance',
        'amount'
    );
}
