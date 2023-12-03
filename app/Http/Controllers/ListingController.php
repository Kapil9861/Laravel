<?php

namespace App\Http\Controllers;

use \App\Models\listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //All listings
    //The commented part is same to the present type in existence which uses the 
    //REQUEST helper
        // public function index(Request $request){
        //     dd($request);
        public function index(){
            //The dd() function's tag is now used to filter the listings using scope filter
            //in the listing model
           //dd(request('jobTag'));//we can just get tag by various ways other is 
            //(request()->jobTag)

            //Now we can filter the listings with the filter called the
            //  :Scope Filter
            //dd(request()->ip()); //Getting ip address of the host
        return view('Listing.index',[
            'heading'=>"Listings",
            'Name'=>"Kapil Aryal",
            "Address"=>"Madhyapur Thimi, Gatthaghar",
            //Lists can be also be passed in lists like this from database to frontend
            //The filter can be added as it has just been defined in the listing Model
            //for multiple requests to handle just pass it inside the request(['jobTag','search'])
            "listings"=>Listing::latest()->filter(request(['jobTag','search']))
            //========      ->get()      ====// this will return the latest entry |
            //| instead of the get we can use paginate to get the datas in multiple pages
            ->simplePaginate(5)   // takes the parameter to show quantity of data in the fixed page
            //If just want the simple pages like next and previous its done by
            //->simplePaginate(Parameter)
    ]);
    }
    
    //Show create form 
    public function create(){
        return view('Listing.create');
    }

    //Store the listings data
    public function store(Request $request){
        //For validation and submit data dd($request->file('logo')-store())
        //This will store the file in the storage->app
        // dd($request->file('logo'));

        $formFields=$request->validate([
            'title'=>'required',
            //This Rule's syntax=> Rule::unique('table_name','Name of fileld to be unique for')
            'company'=>['required', Rule::unique('listings','company')],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email',Rule::unique('listings','email')],
            'tags'=>'required',
            'description'=>'required'
        ]);
        if($request->hasfile('logo')){
            $formFields['logo']=$request->file('logo')->store('logos','public');
        }
        //This is to pass the user's data to the database from real time
        $formFields['user_id']=auth()->id();//this tells that the formField user_id 
        //should take the id of the user that has logged in right now

        //Ran into data not inserting problem as the formFields was mispelled as the formfield
        Listing::create($formFields);
        
        // Flash Message (like the session alerts or something like that)
        // As stored in memory and is only one page load so its called the flash message
        //Session::flash('message','Job Listing created');

        //OR
        return redirect('/')->with('message','Job Listing Created');
    }

    //Show edit form
    public function edit(Listing $listing){
        return view('Listing.edit',[
            'listing'=>$listing
        ]);
    }

    //Submit the edited gig/Update gig
    public function update(Request $request, Listing $listing){

        //Make sure that the logged in user is the owner and only owner of the post 
        //should be able to manage the posts
        if($listing->user_id != auth()->id()){
            abort(403,"Warning!!! : Unauthorized Access");
        }

        $formFields=$request->validate([
            'title'=>'required',
            'company'=>['required'],//  Rule::unique('listings','company')], As it will not let the company name be same
            //As the same company name will already be in the data base also the email in below
            'location'=>'required', 
            'website'=>'required',
            'email'=>['required','email'],//Rule::unique('listings','email')],
            'tags'=>'required',
            'description'=>'required'
        ]);
        if($request->hasfile('logo')){
            $formFields['logo']=$request->file('logo')->store('logos','public');
        }
        $listing->update($formFields);

        return back()->with('message','Job Listing Updated successfully');
    }
    
    //Single listing
    public function show(Listing $listing){
        //EVEN WE DONT NEED THIS 
    // $listing=Listing::find($id);
        return view('Listing.show',
    [
        'listing'=>$listing
    ]);
    }

    public function manage(){
        return view('Listing/manage',[
            //Passing the users listing auth()->user() gives us the logged in user
            //auth()->user()->listing()->get() gives all the listings of the logged in user
            'listing'=>auth()->user()->listing()->get()
        ]);
    }

    public function destroy(Listing $listing){
        //Same as of the edit unauthorized action controlling
        if($listing->user_id != auth()->id()){
            abort(403,"Warning!!! : Unauthorized Access");
        }

        $listing->delete();
        return redirect('/')->with('message',"Listing deleted successfully");
    }

// //DIRECTLY FROM THE ROUTE
//Single Listings
// Route::get('/listing/{id}',function($id){
    // Either This OR
    //===================
    // $listing=Listing::find($id);
    // if(!empty($listing)){
    //     return view('listing',
    // [
    //     'listing'=>$listing
    // ]);
    // }else{
    //     abort('404');
    // }
//});
        
}