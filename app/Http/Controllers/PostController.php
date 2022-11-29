<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', \App\Models\Post::where('is_op', true)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $board = \App\Models\Board::findOrFail($request->id);
        return view('posts.create')->with('board', $board);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'board_id' => 'required|exists:boards,id',
            'user_id' => 'required|exists:users,id',
            'post_id' => 'nullable|exists:posts,id',
            'title' => 'required|string|max:240',
            'content' => 'required|min:8|max:1023',
            'images' => 'nullable|array',
            'images.*' => 'image',
            'is_op' => 'nullable|boolean',
        ]);

        $post = \App\Models\Post::create($validator);

        // if images in request, then create Media model for each image
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $media = new \App\Models\Media();
                $media->post_id = $post->id;
                $media->path = $image->store('images', 'public');
                $media->save();
            }
        }
        

        session()->flash('success', 'Post created successfully.');
        if ($post->is_op) {
            return redirect()->route('posts.show', $post->id);
        } else {
            return redirect()->route('posts.show', $post->post_id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.show')->with('post', \App\Models\Post::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
