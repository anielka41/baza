<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileManagerController;
use App\Models\Category;
use App\Models\Post;
use Auth;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        return view('backend.posts.index', [
            'posts' => Post::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {

        $categories = Category::all();

        return view('backend.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request): RedirectResponse|Redirector
    {

        $request->validate([
            'title' => 'required|min:1|string',
        ]);

        $post = Post::create([
            'hero' => $request['hero'],
            'title' => $request['title'],
            'slug' => $request['slug'],
            'user_id' => Auth::user()->id,
            'content' => $request['content'],
            'seo_title' => $request['seo_title'],
            'seo_desc' => $request['seo_desc'],
            'seo_noindex' => $request->has('seo_noindex'),
            'seo_nofollow' => $request->has('seo_nofollow'),
            'status' => $request['status'],
            'comment' => $request->has('comment'),
        ]);

        foreach ((array) $request->category as $value) {
            $post->categories()->attach($value);
        }

        $post->save();

        return redirect(route('posts.edit', $post->id))->with('success', 'Wpis został utworzona!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return View
     */
    public function edit(Post $post): View
    {

        $categories = Category::all();

        return view('backend.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Post  $post
     * @return RedirectResponse
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        $post  = Post::findOrFail($post->id);
        $input = $request->all();
        $input['seo_noindex'] = $request->has('seo_noindex');
        $input['seo_nofollow'] = $request->has('seo_nofollow');
        $input['comment'] = $request->has('comment');

        $post->fill($input)->save();

        foreach ((array) $request->category as $value) {
            $values[] = $value;
        }
        $post->categories()->sync($values);

        return back()->with("status", "Wpis został zaktualizowana!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $id
     * @return JsonResponse
     */
    public function destroy(Post $id): JsonResponse
    {
        try {
//            throw new Exception();
            $id->delete();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wystąpił błąd!'
            ])->setStatusCode(500);
        }
    }
}
