<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::get();
        if($posts->count() > 0){
            return PostResource::collection($posts);
        }else{
         return response()->json(['message'=>'No record avaliable'],200);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $validator=Validator::make(
             $request->all(),[
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'discription' => 'required|string|max:255 ',
        ]);
       if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->messages(),
            ], 422);
        }else{
        $post= Post::create([
             'name' => $request->name,
             'title' => $request->title,
             'discription' => $request->discription,
         ]);
        }
        
        // Create the post
       return response()->json([
        'message' => 'post created successfully',
        'data'=>new PostResource($post),
        ], 200); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
      return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validator=Validator::make(
             $request->all(),[
           'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'discription' => 'required|string|max:255 ',
        ]);
       if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->messages(),
            ], 422);
        }else{
        $post->update([
             'name' => $request->name,
             'title' => $request->title,
             'discription' => $request->discription,
         ]);
        }
        
        // Create the post
       return response()->json([
        'message' => 'post updated successfully',
        'data'=>new PostResource($post),
        ], 200); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            'message' => 'post deleted successfully',
        ], 200);
    }
}
