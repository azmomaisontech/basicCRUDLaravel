<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->user = $this->guard()->user();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->user->posts->all();
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $post            = new Post();
        $post->title     = $request->title;
        $post->content      = $request->content;

        if ($this->user->posts()->save($post)) {
            return response()->json(['post'   => $post]);
        } else {
            return response()->json(['message' => 'Could not save post']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
    } //end show()


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Post         $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title'     => 'string',
                'content'      => 'string',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'errors' => $validator->errors(),
                ],
                400
            );
        }

        // $post->title     = $request->title;
        // $post->content      = $request->body;

        if ($this->user->posts()->update($request->all())) {
            return response()->json(
                [
                    'message'   => 'Post updated successfully',
                ]
            );
        } else {
            return response()->json(
                [
                    'message' => 'Count not update table.',
                ]
            );
        }
    } //end update()


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->delete()) {
            return response()->json(
                [
                    'message' => 'Deleted successfully'
                ]
            );
        } else {
            return response()->json(
                [
                    'message' => 'Could not delete post',
                ]
            );
        }
    } //end destroy()


    protected function guard()
    {
        return Auth::guard();
    }
}
