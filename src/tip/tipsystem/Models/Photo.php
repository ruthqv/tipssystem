<?php

namespace tip\tipsystem\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    protected $connection = 'mongodb';

    protected $fillable = [
        'name',
        'original_name',
        'photostable_id',
        'photostable_type',
        'default',
    ];


}
