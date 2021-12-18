<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Phone;
use App\Models\Hospital;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Patient;
use App\Models\Medical;
use App\Models\Country;





class RelationController extends Controller
{
    public function hasOneRelation(){
        // fetch all data where user id =1
        // $user = User::with('Phone')->find(1);
        $user = User::with(['Phone' => function($query){
            $query->select('code','number','user-id');
        }])->find(1);
        return  response()->json($user);
    }
    public function hasOneRelationReverse(){
      $phone = Phone::find(1);
       // Method makeHidden => for Hidd in fillable of model
      // Method makeVisible => for show in hidden of model
      $phone->makeVisible(['user-id']);
        return  $phone->user;
    }
        public function getUserhasPhone(){
            //return User::whereDoesntHave('Phone')->get();
            return User::whereHas('Phone')->get();

        }
        public function condation(){
            // where has with condation 
             return User::whereHas('Phone',function($q){
               $q->where('code','3');
            })->get();
        }
        ######################################################### One TO Many ################
        public function getHospitalDoctor(){
            // Hospital::first(); => frist row
            // Hospital::where('id','1'); => condation
             $hospital =  Hospital::find(1); 
            // $hospital -> doctors; => return hospital doctor
            $hospital::with('doctors')->find(1); //return hospital and doctor

            $Dr =  $hospital->doctors;
            foreach($Dr as $doc){
                echo "<table style='width: 200px;border:2px solid gray; text-align:center;'><tr>";
                
                echo "<td>$doc->name</td>";

                echo "</tr></table>";
            }
        }   
        public function Hospitals(){

            $hospital = Hospital::select('id','name','address')->get();
            return view('doctors.hospitals',compact('hospital'));
        }
        public function Doctors($hospital_id){
            $hospital = Hospital::find($hospital_id);
            $doctors = $hospital->doctors;
            return view('doctors.doctors',compact('doctors'));

        }
        public function HospitalsHasDoctor(){
             return  Hospital::whereHas('doctors')->get();
            //  return  Hospital::whereDoesntHave('doctors')->get(); => if not have doctors


        }
        public function HospitalsHasntMale(){
            return $hospitals = Hospital::with('doctors')->whereHas('doctors' , function($q){
                $q->where('gender','famel');
            })->get();
        }   
        public function deleteHospitals($hospital_id){
            $hospital =   Hospital::find($hospital_id);
            if(! $hospital)
            return abort(code:'404');
            // delete doctors
            $hospital->doctors()->delete();
            // delete hospital
            $hospital->delete();
            return redirect()->back();  
        }
        public function deleteDoctors($doctor_id){
            $doctor = Doctor::find($doctor_id);
            $doctor->delete();
            return redirect()->back();  
        }
        public function doctorService(){
            $doctor = Doctor::with('service')->find(5);
          //  return $doctor->name;
           return $doctor->Service;
        }
        public function serviceDoctor(){
            $service = Service::with(['doctor' => function($q){
                $q->select('doctors.id','name','title')->get();
            }])->find(1);
            return $service;
        }
        public function showService($doctor_id){

            $doctor = Doctor::find($doctor_id);
           $service =  $doctor->Service;
           $doctors = Doctor::select('id','name')->get();
           $services = Service::select('id','name')->get();

           return view('doctors.service',compact('service','services','doctors'));
        }
        public function SaveServices(Request $request){
           $doctor= Doctor::find($request->doctor_id);
           // attach => بتحفظ الحاجه واخترت نفس الحاجه بتتسجل مرتين
          // $doctor->Service()->attach($request->service_id); //Many To Many insert To database 
          // sync => بتسجل الجديد وتمسح القديم
          // $doctor->Service()->sync($request->service_id);
          // syncWithoutDetaching => de tmam
           $doctor->Service()->syncWithoutDetaching($request->service_id); 

           return redirect()->back()->with(['sucess' => 'Added services Done']);
        }
        public function getPatientDoctor(){
          $patient =  Patient::find(1);
          return $patient->doctor;
        }
        public function getCountryDoctor(){
            $country = Country::find(1);
            return $country->doctor;
        }
    }


