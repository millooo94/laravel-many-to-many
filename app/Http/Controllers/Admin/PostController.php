<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private $validations = [
        'slug' => [
            'required',
            'string',
            'max:100',
        ],
        'category_id' => 'required:integer|exists:categories,id',
        'title'=>'required|string|max:100',
        'image'=>'string|max:100',
        'uploaded_img'=>'image|max:1024',
        'content'=>'string',
        'excerpt'=>'string',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);

        return view('admin.posts.index', [
            'posts'=> $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all('id', 'name');

       return view('admin.posts.create', [
        'categories' => $categories,
       ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validations['slug'][] = 'unique:posts';
        $request->validate($this->validations);


        $data = $request->all();

        $img_path = isset($data['uploaded_img']) ? Storage::put('uploads', $data['uploaded_img']) : null;

        $post = new Post;
        $post->slug           = $data['slug'];
        $post->title          = $data['title'];
        $post->image          = $data['image'];
        $post->uploaded_img   = $img_path;
        $post->content        = $data['content'];
        $post->excerpt        = $data['excerpt'];
        $post->save();

        return redirect()->route('admin.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $this->validations['slug'][] = Rule::unique('posts')->ignore($post);
        $request->validate($this->validations);

        $data = $request->all();

        $img_path = Storage::put('uploads', $data['uploaded_img']);

        Storage::delete($post->uploaded_img);

        $post->slug           = $data['slug'];
        $post->title          = $data['title'];
        $post->image          = $data['image'];
        $post->uploaded_img   = $img_path;
        $post->content        = $data['content'];
        $post->excerpt        = $data['excerpt'];
        $post->update();

        return redirect()->route('admin.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
       return redirect()->route('admin.posts.index', ['post' => $post])->with('success_delete', $post);

    }
}
