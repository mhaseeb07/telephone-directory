<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\department;

class ContactInfo extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    protected $table = 'contact_info';
    protected $fillable = [
        'name','slug','designation','company','dpt_id','city','business_phone','factory_phone','home_phone','fax_no','mobile_no','address','email','website','created_by','updated_by',
    ];
    protected $dates = ['deleted_at'];

    public function Dpt_id()
    {
        return $this->belongsTo(department::class, 'dpt_id');
    }
}
