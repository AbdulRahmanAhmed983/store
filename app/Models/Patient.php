<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;


class Patient extends Model
{
    use HasFactory;
    protected $table = "patients";
    protected $fillable = ['name','age'];
    public $timestamps = false;

    public function doctor(){
        // hasOneThrough relation
        return $this->hasOneThrough('\App\Models\Doctor',through:'\App\Models\Medical'
    ,firstKey:'patient_id',secondKey:'medical_id',localKey:'id');
    }
}
