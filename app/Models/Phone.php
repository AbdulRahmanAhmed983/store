<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    protected $table = "phone";
    protected $fillable = ['code','number','user-id'];
    protected $hidden = ['user-id'];
    public $timestamps = false;

       ############### Start Relations #########################

       public function user(){
        //has foreign key =>belongsTo
        return $this->belongsTo('App\Models\User',foreignKey:'user-id');
    }
     ############## End Relations #########################
}
