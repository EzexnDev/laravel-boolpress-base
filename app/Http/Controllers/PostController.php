<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Category;
use App\PostInformation;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        //  $posts->each(function ($post){
        //  $info = $post->info;
        //  dd($info);
        // //     $category = $post->hasCategory;
        //       });

        return view ('post', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tags = Tag::all();
        $categories = Category::all();
        return view("create", compact("tags", "categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        $validated = $request->validate([
            'title' => 'required|string|min:3',
            'author' => 'required|string|min:3',
        ]);

        $newPost = Post::create([
            "title" => $validated["title"],
            "author" => $validated["author"],
            "category_id" => $data["categories"]
        ]);


        $newPost->save();

        $postInfo = PostInformation::create([
            "post_id" => $newPost->id,
            "description" => $data["description"],
            "slug" => "prova_slug"
        ]);

        $postInfo->save();

        foreach ($data["tags"] as $tag) {
            $newPost->tags()->attach($tag);
        }


        return redirect()->route('post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);
        $tags = $post->tags;
        $detail = $post->hasInfo;
        $category = $post->hasCategory;
        return view("details", compact("detail", "post", "category", "tags"));
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
        $post = Post::find($id);
        $tags = Tag::all();
        $categories = Category::all();

        return view("edit", compact("post", "tags", "categories"));
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
        $post = Post::find($id);
        $data = $request->all();
        $post->tags()->detach();
        $post->update($data);

        $post->hasInfo->update($data);
        foreach ($data["tags"] as $tag) {
            $post->tags()->attach($tag);
        }

        return redirect()->route('post');
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
        $post = Post::find($id);
        $post->hasInfo->delete();

        foreach ($post->tags as $tag) {

            $post->tags()->detach($tag->id);
        }
        $post->delete();


        return redirect()->back();
    }
}
