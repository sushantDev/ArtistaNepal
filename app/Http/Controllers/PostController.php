<?php

namespace App\Http\Controllers;

use DB;
use App\Tag;
use App\Post;
use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;
use Illuminate\Support\Facades\Auth;
use Vmorozov\FileUploads\Uploader;

class PostController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->latest()->get([ 'slug', 'title', 'is_published' ]);

        return view('backend.post.index', compact('posts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $allTags = Tag::pluck('tag')->all();

        $tags = [];

        return view('backend.post.create', compact('allTags', 'tags'));
    }

    /**
     * @param StorePost $request
     * @return mixed
     */
    public function store(StorePost $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->data();

            $post = Post::create($data);

            $post->syncTags($data['tags']);

            $this->uploadRequestImage($request, $post);

            if ($request->hasFile('file')) {
                file_upload($request->file('file'), $post, true, 'slug');
            }
        });

        return redirect()->route('backend.post.index')->withSuccess(trans('messages.create_success', [ 'entity' => 'Post' ]));
    }

    /**
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        return view('backend.post.show', compact('post'));
    }

    /**
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        $allTags = Tag::pluck('tag')->all();

        $tags = $post->tags()->pluck('tag')->all();

        return view('backend.post.edit', compact('post', 'allTags', 'tags'));
    }

    /**
     * @param UpdatePost $request
     * @param Post $post
     * @return mixed
     */
    public function update(UpdatePost $request, Post $post)
    {
        DB::transaction(function () use ($request, $post) {
            $data = $request->data();

            $post->update($data);

            $post->syncTags($data['tags']);

            $this->uploadRequestImage($request, $post);
        });

        return back()->withSuccess(trans('messages.update_success', [ 'entity' => 'Post' ]));
    }

    /**
     * @param Post $post
     * @return mixed
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return back()->withSuccess(trans('message.delete_success', [ 'entity' => 'Post' ]));
    }
}
