<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'name', 'Price','task_date', 'status', 'bio', 'photo', 'type'
    ];
}