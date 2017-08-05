<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Doc;
use App\User;
use Auth;

class TagController extends Controller
{
    function showBlogs($id){
    	$title = 'Tagged Blogs (Ready to Gov)';

        // Get blogs to show two at a time
    	$tag = Tag::find($id);
        $blogs = $tag->blog()->orderBy('created_at', 'desc')->paginate(2);

    	$tags = Tag::get()->where('id','=',$id);
    	$alltags = Tag::all();

         // Get doc details
        $alldocs = Doc::all();

        // Save doc reqts to an array
        $docreqs = [];
        $primary = $alldocs->where('icon','!=',null)->pluck('id')->toArray();
        foreach ($primary as $key) {
            $reqs = Doc::find($key)->reqt->pluck('id')->toArray();
            $docreqs[$key] = $reqs;
        }

        // Save docs the user has
        if(Auth::user()) {
            $logged = Auth::user()->id;
            $userdocs = User::find($logged)->doc()->pluck('doc_id')->toArray();
        } else {
            $userdocs = [];
        }

        // Show blog view
   	 	return view('blogs', compact('title','blogs','tags','alltags','alldocs','userdocs','primary','docreqs'));
    }
}
