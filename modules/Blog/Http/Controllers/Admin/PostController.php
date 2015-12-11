<?php

namespace Modules\Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Post;
use Modules\Blog\Entities\PostContent;
use Modules\Blog\Http\Requests\PostFormRequest;
use Vain\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $this->authorize('index', Post::class);

        /** @var Post $posts */
        $posts = Post::with('user')->paginate();

        return view('blog::admin.posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        $this->authorize('create', Post::class);

        $locales = config('app.locales');
        $categories = array_pluck(Category::with('contents')->get(), 'content.name', 'id');

        return view('blog::admin.posts.create', ['locales' => $locales, 'categories' => $categories]);
    }

    public function store(PostFormRequest $request)
    {
        $this->authorize('create', Post::class);

        $post = new Post($request->all());

        $post->user()->associate($request->user());
        $post->save();

        foreach (config('app.locales') as $locale => $name) {
            $content = (new PostContent())
                ->fillTranslated($locale, $request->all());

            $content->post()->associate($post);
            $content->save();
        }

        return $this->createDefaultResponse($request);
    }

    public function edit($id)
    {
        /** @var Post $post */
        $post = Post::find($id);

        $this->authorize('edit', $post);

        $locales = config('app.locales');
        $categories = array_pluck(Category::with('contents')->get(), 'content.name', 'id');

        return view('blog::admin.posts.edit', ['post' => $post, 'locales' => $locales, 'categories' => $categories]);
    }

    public function update(PostFormRequest $request, $id)
    {
        /** @var Post $post */
        $post = Post::findOrFail($id);
        $this->authorize('edit', $post);

        $post->fill($request->all());
        $post->save();

        foreach (config('app.locales') as $locale => $name) {
            $content = $post->contents()
                ->localeOrNew($locale)
                ->fillTranslated($locale, $request->all());

            $content->post()->associate($post);
            $content->save();
        }

        return $this->createDefaultResponse($request);
    }

    public function destroy(Request $request, $id)
    {
        /** @var Post $post */
        $post = Post::findOrFail($id);
        $this->authorize('destroy', $post);

        $post->delete();

        return $this->createDefaultResponse($request);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    protected function createDefaultResponse($request)
    {
        if ($request->ajax()) {
            return response('', 200);
        }

        return redirect()->route('blog.admin.posts.index');
    }
}
