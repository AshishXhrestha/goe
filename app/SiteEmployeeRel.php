<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteEmployeeRel extends Model
{
    //
    protected  $table = 'siteemployeerel';
    protected $fillable= array(
        'siteId',
        'empId',
        'workDate',
        'advance',
        'day',
        'ot',
        'amount'
    );
}
