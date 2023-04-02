<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // fetch all posts
        $posts = Post::all();

        // return posts
        return response()->json($posts, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // create new post from the request data
        $response = Post::create($request->all());

        // check the response in case of fail and return corresponding message
        if ($response) {
            return response()->json(["message" => "New Post Added Successfully."], 201);
        } else {
            return response()->json(["message" => "Unable to Process Your Request."], 406);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        // fetch the request post
        $result = Post::findOrFail($id);

        // return the response
        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     */
    public
    function update(Request $request, $id)
    {
        // find the wanted post
        $result = Post::findOrFail($id);

        // update it by the given data
        $result->update($request->all());

        // return a response
        return response()->json(['message' => "Post Updated Successfully."], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy($id)
    {
        // find the post
        $post = Post::findOrFail($id);

        // process delete action
        $post->delete();

        // return a response
        return response()->json(['message' => 'Post Deleted!'], 200);
    }
}
