<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;
class Hospital extends Model
{
    use HasFactory;
    protected $table = 'hospitals';
    protected $fillable = ['name','address','country_id','updated_at','created_at'];
    protected $hidden = ['updated_at','created_at'];
    public $timestamps = true;


    public function doctors(){

       return $this->hasMany('\App\Models\Doctor','hospitals-id','id'); 

    }
}
