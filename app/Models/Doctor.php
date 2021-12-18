<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hospital;
use App\Models\Service;


class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctors';
    protected $fillable = ['name','title','gender','hospitals-id','medical_id','updated_at','created_at'];
    protected $hidden = ['updated_at','created_at','pivot'];
    public $timestamps = true;

    public function hospitals(){
        return $this->belongsTo('\App\Models\Hospital','hospitals-id');
    }

    //belongsToMany => Many To Many
    public function Service(){
        return  $this->belongsToMany('\App\Models\Service',table:'doctor_service',foreignPivotKey:'doctor_id',
        relatedPivotKey:'service_id',parentKey:'id',relatedKey:'id');
    }
    
}
