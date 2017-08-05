<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doc;
use App\User;
use Auth;

class DocController extends Controller
{
    // Function for requirement checkbox
    public function toggleCheck(Request $request){
        // Check if post method
        if ($request->isMethod('post')){

            // Separate input by dash to doc ID and reqID ID
            $docreqID = $request->docreqID;
            $docreqID = explode("-", $docreqID);
            $doc_ID = $docreqID[1];
            $req_ID = $docreqID[2];

            if(Auth::user()) {
            	// Check if logged user has doc reqt
            	$logged = User::find(Auth::user()->id);
            	$hasReq = $logged->doc()->where('doc_id', $req_ID)->exists();

            	// Toggle association of user to doc
            	if($hasReq){
            		$logged->doc()->detach($req_ID);
            	} else {
            		$logged->doc()->attach($req_ID);
            	}

            	$logged = Auth::user()->id;
            	$attached = User::find($logged)->doc()->pluck('doc_id')->toArray();

            	return response()->json(['response' => 'success','attached'=> $attached]);

	        } else {
	            return response()->json(['response' => 'notlogged']);
	        }
        } 
    }

    // Function for primary document claim
    public function toggleClaimDoc(Request $request){
        // Check if post method
        if ($request->isMethod('post')){

            // Separate input by dash to doc ID and reqID ID
            $docClaimID = $request->docClaimID;
            $action = $request->action;
            $claimed = 'no';

            if(Auth::user()) {
                // Check if logged user has doc reqt
                $logged = User::find(Auth::user()->id);
                $hasDoc = $logged->doc()->where('doc_id', $docClaimID)->exists();

                // Toggle association of user to doc
                if($hasDoc){
                    if($action=='Incomplete'){
                        $logged->doc()->detach($docClaimID);
                    }
                } else {
                    if($action=='Claim document'){
                        $logged->doc()->attach($docClaimID);
                        $claimed = 'yes';
                    }
                }

                $logged = Auth::user()->id;
                $attached = User::find($logged)->doc()->pluck('doc_id')->toArray();

                return response()->json(['response' => 'success','attached'=> $attached,'claimed' => $claimed]);

            } else {
                return response()->json(['response' => 'notlogged']);
            }
        } 
    }
}
