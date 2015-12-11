<?php

namespace Modules\Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\CategoryContent;
use Modules\Blog\Http\Requests\CategoryFormRequest;
use Vain\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $this->authorize('index', Category::class);

        /** @var Category $categories */
        $categories = Category::with('posts')->paginate();

        return view('blog::admin.categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        $this->authorize('create', Category::class);

        $locales = config('app.locales');

        return view('blog::admin.categories.create', ['locales' => $locales]);
    }

    public function store(CategoryFormRequest $request)
    {
        $this->authorize('create', Category::class);

        /** @var Category $category */
        $category = Category::create($request->all());

        foreach (config('app.locales') as $locale => $name) {
            $content = (new CategoryContent())
                ->fillTranslated($locale, $request->all());

            $content->category()->associate($category);
            $content->save();
        }

        return $this->createDefaultResponse($request);
    }

    public function edit($id)
    {
        /** @var Category $category */
        $category = Category::findOrFail($id);
        $this->authorize('edit', $category);

        $locales = config('app.locales');

        return view('blog::admin.categories.edit', ['category' => $category, 'locales' => $locales]);
    }

    public function update(CategoryFormRequest $request, $id)
    {
        /** @var Category $category */
        $category = Category::findOrFail($id);
        $this->authorize('edit', $category);

        $category->fill($request->all());
        $category->save();

        foreach (config('app.locales') as $locale => $name) {
            $content = $category->contents()
                ->localeOrNew($locale)
                ->fillTranslated($locale, $request->all());

            $content->category()->associate($category);
            $content->save();
        }

        return $this->createDefaultResponse($request);
    }

    public function destroy(Request $request, $id)
    {
        /** @var Category $category */
        $category = Category::findOrFail($id);
        $this->authorize('destroy', $category);
        $category->delete();

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

        return redirect()->route('blog.admin.categories.index');
    }
}
