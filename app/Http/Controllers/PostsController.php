<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// import storage class
use Illuminate\Support\Facades\Storage;
// import the Post model
use App\Post;
// import db helper class
use DB;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /* Added middleware authentication to block users that's not logged in.
           Added exception to views as array e.g. posts/blog index and show page
        */
        
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // using eloquent instead of sql query
        $posts = Post::all();

        //implement pagination and add links on the view
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);  // limit the number of record per page   

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // when validated true the return value is same as the request value
        $attributes = $this->validate($request, [
            'title' => ['required'],
            'body' => ['required'],
            'cover_image' => ['image', 'nullable', 'max:1999']  // 2mb limit apache upload
        ]);
    
        // add user id of the login user
        $attributes['user_id'] = auth()->id();

        // add cover_image
        $attributes['cover_image'] = $this->getFilenameToStore($request);  // store the filename only

        // or shorthand
        Post::create($attributes);
        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post =  Post::find($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        
        // Check for correct user of the post
        if(auth()->user()->id != $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        } 

        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => ['required'],
            'body' => ['required']
        ]);

        // create post object
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');    
        $post->body = $request->input('body'); 

        //check again if there is an image uploaded for update. no then do not update
        if($request->hasFile('cover_image')){

            // The image before is not noimage.jpg then delete the old photo (not noimage.jpg)
            if($post->cover_imge != 'noimage.jpg'){
                Storage::delete('public/cover_image/' . $post->cover_image);
            }

            $post->cover_image = $this->getFilenameToStore($request);   // handles image upload
        }
           
        $post->save();

        return redirect('/posts')->with([
            'success' => 'Post Updated'
            ]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        
        // Check for correct user
        if(auth()->user()->id != $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        if($post->cover_image != 'noimage.jpg'){
            // Delete Image in the storage
            Storage::delete('public/cover_images/' . $post->cover_image);
        }

        $post->delete();

        return redirect('/posts')->with([
            'success' => 'Post Removed'
            ]);
    }
    
    /** 
     * Handle file upload
     * @param request $request
     * @return filename to upload
    */
    public function getFilenameToStore($request){

        if($request->hasFile('cover_image')){
            // get the filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // get just the filename. extract filename with no extension
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // get just the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // filename to be store. concatinate with time stamp date to make it unique
            $fileNameToStore = $filename . '_' . time() . '.' . $extension; //(filename_timestamp.ext)
            // upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';   // default image to load when none selected
        }

        return $fileNameToStore;
    }

}
