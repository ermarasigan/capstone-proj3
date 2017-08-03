<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Blog;
use App\Tag;
use Session;

class BlogController extends Controller
{
    function showBlogs(){
        // Get blogs to show two at a time
    	$title = 'Homepage (Ready to Gov)';
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(2);
    	$alltags = Tag::all();
    	$tags = Tag::has('blog')->get();

        // Show blog view
   	 	return view('blogs', compact('title','blogs','tags','alltags'));
    }

    public function removeTag(Request $request){
        // Check if post method
        if ($request->isMethod('post')){

            // Separate input by dash to blog ID and tag ID
            $blogtagID = $request->blogtagID;
            $blogtagID = explode("-", $blogtagID);

            // Find blog where tag will be removed
            $blogID = $blogtagID[0];
            $blog = Blog::find($blogID);

            // Find tag to be removed
            $tagID = $blogtagID[1];

            // Detach tag from blog
            $blog->tag()->detach($tagID);

            // Output response to send to ajax
            return response()->json(['response' => 'success']);
        } 
    }

    function deleteBlog(Request $request){
        // Find blog to be deleted
        $blogID = $request->blogID;

        // Delete blog
        $blog_tbd = Blog::find($blogID);
        $blog_tbd->delete();

        // Output response to send to ajax
        return response()->json(['response' => 'success']);
        return back();
    }

    function editBlog(Request $request){
        // Find blog to be edited
        $blogID = $request->blogID;

        // Update blog
        $blog_tbe = Blog::find($blogID);
        $blog_tbe->title = $request->editTitle;
        $blog_tbe->content = $request->editContent;
        $blog_tbe->save();

        // Save new blog ID to add image later
        $request->session()->flash('updateBlogID',$blog_tbe->id);

        // Output response to send to ajax
        return response()->json(['response' => 'success']);
        return back();
    }

    public function addTag(Request $request){

        $inputTag = $request->inputTag;
        $blogID = $request->blogID;

        if ($request->isMethod('post')){

            // Find the blog sent thru ajax
            $blog = Blog::find($blogID);

            //Check if tag already exists
            $tag = Tag::where('name','=',$inputTag)->first(['id','name']);
            $hasTag = Tag::where('name','=',$inputTag)->count();

            if($hasTag){
                // Check if tag is already associated to blog
                $hasBlogTag = $blog->tag()->where('tag_id', $tag->id)->exists();

                if($hasBlogTag){
                    
                    // // Output response to send to ajax
                    return response()->json(['response' => 'tag exists']);
                } else {
                    $blog->tag()->attach($tag->id);

                    // // Output response to send to ajax
                    return response()->json(['response' => 'success']);
                }
            } else {
                // Create new tag if none
                $new_tag = new Tag();
                $new_tag->name = $inputTag;
                $new_tag->save();

                // Find the new tag
                $new_tag = Tag::where('name','=',$inputTag)->first(['id']);

                // Insert record to pivot row to associate tag with blog
                $blog->tag()->attach($new_tag->id);

                // // Output response to send to ajax
                return response()->json(['response' => 'success']);
            }
        } 
        // Reload page in ajax instead
        // return redirect('/home');
    }

    function newBlog(Request $request){
        // Create new blog
        $new_blog = new Blog();
        $new_blog->title = $request->title;
        $new_blog->content = $request->content;
        $new_blog->image_url = 'img/uploads/ICTJUNE.png';
        $new_blog->save();

        // Save new blog ID to add image later
        $request->session()->flash('newBlogID',$new_blog->id);

        // Output response to send to ajax
        return response()->json(['response' => 'success']);
        // return redirect('home');
    }

    function fileUpload(Request $request)

    {
        $newBlogID = Session::get('newBlogID');
        $updateBlogID = Session::get('updateBlogID');

        if(isset($newBlogID)){
            $blogID = $newBlogID;
        } else {
            $blogID = $updateBlogID;
        }

        if ($request->isMethod('post')){

            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Upload image with timestamp as filename
            $image = $request->file('image');
            $input['imagename'] = time().'.'. $image->getClientOriginalExtension();
            // $destinationPath = public_path('img\uploads');
            $destinationPath = 'assets/images/';
            $image->move($destinationPath, $input['imagename']);

            // Update blog with the uploaded image
            // $filename = "img/uploads/" . $input['imagename'];
            $filename = 'assets/images/' . $input['imagename'];
            $blog_tbu = Blog::find($blogID);
            $blog_tbu->image_url = $filename;
            $blog_tbu->save();

            // return response()->json(['response' => 'success']);
            return back()->with('success','Image Upload successful');
        }
    }
}