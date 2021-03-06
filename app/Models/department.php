<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    protected $table = 'department';
    protected $fillable = [
        'name','slug','created_by','updated_by',
    ];
    protected $dates = ['deleted_at'];
}
