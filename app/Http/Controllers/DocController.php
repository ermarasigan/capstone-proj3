<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doc;
use App\User;
use Auth;

class DocController extends Controller
{
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

            	return response()->json(['response' => 'success']);

	        } else {
	            return response()->json(['response' => 'notlogged']);
	        }
        } 
    }
}
