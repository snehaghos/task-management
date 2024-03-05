<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'description',
        'start_time',
        'image',
        'end_time',
        'status'


    ];
}
