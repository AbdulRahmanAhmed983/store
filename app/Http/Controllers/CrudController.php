<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\offerTraits; 
use App\Models\Video;
use App\Events\VideoViewer;
define('PAGINATION_COUNT',3);



class CrudController extends Controller
{   
    use offerTraits;

    //Offer => model name
    public function getVideo(){
        $video  = Video::first();
        event(new VideoViewer($video)); //fire event
         return view('video',compact('video')); 
     }
     public function index(){
        // $offers= Offer::Select('id','name','price','photo')->get();
        // return view('offers.index',compact('offers'));
           ############################ paginate result #################
         $offers= Offer::Select('id','name','price','photo')->paginate(PAGINATION_COUNT);
        return view('offers.pagination',compact('offers'));
         ##################################################################
 
   }
    public function show($id){
        $offers = Offer::select('id','name','price','photo')->find($id);
        return view('offers.show',compact('offers'));
    }
   
    public function create(){
        return view('offers.create');
    }
    public function store(OfferRequest $req){
     
    //    $validate = validator::make($req->all(),$rules,$message);

        // if($validate -> fails()){
        //     return redirect()->back()->withErrors($validate)->withInputs($req->all());
        // }
        // when use getClientOriginalExtension()put in tag form this enctype="multipart/form-data"
       
        $file_name = $this->saveImage($req->photo,'images/offers');

        Offer::create([
            'photo' => $file_name,
            'name' =>$req->name ,
            'price' =>$req->price
        ]);
        return redirect()->back()->with(['sucess' => 'done Added Offer']);
    }
    public function edit($id){
         //3la4an when send id user cant write in url any id not contain in DB  
       // Offer::findOrFail($id);
       $offer = Offer::find($id);  //search in given table id only
       if(! $offer)
           return redirect()->back();
          $offer = Offer::select('id','name','price')->find($id);
          return view('offers.edit',compact('offer'));
    }

    public function update(OfferRequest $req ,$id){
        $offer = Offer::select('name','price')->find($id);
        $offer = Offer::find($id);  //search in given table id only
       if(! $offer)
       return redirect()->back();
       $offer->update($req->all());
       return redirect()->back()->with(['sucess' => 'updated done']);
    }

    public function delete($id){
        $offer = Offer::find($id);
        if(! $offer)
        return redirect()->back()->with(['error' => 'The Item Not Found']);
        $offer->delete();
        return redirect()->route('index',$id)->with(['sucess' => 'item deleted sucessfully']);
    }
   
}
