<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Auth;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Spatie\Sluggable\SlugOptions;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        return view('backend.pages.index', [
            'pages' => Page::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('backend.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request): RedirectResponse|Redirector
    {
        $request->validate([
            'title' => 'required|min:1|string',
        ]);

        Page::create([
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

        return redirect(route('pages'))->with('success', 'Strona została utworzona!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Page  $page
     * @return View
     */
    public function edit(Page $page): View
    {

        return view('backend.pages.edit', compact('page'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return RedirectResponse
     */
    public function update(Request $request, Page $page): RedirectResponse
    {
        $page  = Page::findOrFail($page->id);
        $input = $request->all();
        $input['seo_noindex'] = $request->has('seo_noindex');
        $input['seo_nofollow'] = $request->has('seo_nofollow');
        $input['comment'] = $request->has('comment');
        $page->fill($input)->save();

        return back()->with("status", "Strona została zaktualizowana!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $id
     * @return JsonResponse
     */
    public function destroy(Page $id): JsonResponse
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
