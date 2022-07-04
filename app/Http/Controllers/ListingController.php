<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{


        //show all listings

    public function index() {
      // dd(Listing::latest()->filter(request(['tag' , 'search']))->paginate(6));
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag' , 'search']))->paginate(6)

        ]);

    }

        //show single listing

    public function show(Listing $listing){
        return view('listings.show', [
      
            'listing' => $listing
    
        ]);
    }

    //show create form

    public function create () {
        return view('listings.create');
    }

    // store listing data

    // validation made super simple with lavarel!!

    public function store(Request $request) {

            $formFields = $request->validate([
                'title' => 'required',
                'company' => ['required', Rule::unique('listings', 'company')],
                'location' => 'required',
                'website' => 'required',
                'email' => ['required', 'email'],
                'tags' => 'required',
                'description' => 'required'
             ]);        
            
                if($request->hasFile('logo')){
                    $formFields['logo'] = $request->file('logo')->store('logos' , 'public' );
                }

                $formFields['user_id'] = auth()->id();

                Listing::create($formFields);

              ////////flash message, once listing is created send messsage that is stored in memory for 1 page 
              //  Session::flash('message' , 'Listing Created');

             return redirect('/')->with('message','Listing created successfully!');

    }

            /// showing edit form

            public function edit(Listing $listing){

                ///dd($listing->tite);
                
                return view('listings.edit', ['listing' => $listing]);
            }
            //update lsiting data
            public function update(Request $request, Listing $listing) {

                $formFields = $request->validate([
                    'title' => 'required',
                    'company' => ['required'],
                    'location' => 'required',
                    'website' => 'required',
                    'email' => ['required', 'email'],
                    'tags' => 'required',
                    'description' => 'required'
                 ]);        
                    if($request->hasFile('logo')){
                        $formFields['logo'] = $request->file('logo')->store('logos' , 'public' );
                    }
                    $listing->update($formFields);

                 return back()->with('message','Listing edit successful!');
    
        }

    // Delete Listing
    public function destroy(Listing $listing) {
        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }

    // Manage Listings
    public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }

}


