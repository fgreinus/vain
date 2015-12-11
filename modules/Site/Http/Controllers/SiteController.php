<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Site\Entities\Page;

class SiteController extends Controller
{
    /**
     * @param Request $request
     * @param $slug
     *
     * @return $this
     */
    public function getPage(Request $request, $slug)
    {
        $page = Page::published()
            ->where('slug', $slug)
            ->first();

        if ($page === null) {
            app()->abort(404, 'page with slug \''.$slug.'\' not found');
        }

//        if (!empty($page->role) && !$request->user()->hasRole($page->role))
//        {
//            app()->abort(403, 'no permission to view page with slug \''. $slug .'\'');
//        }

        return view('site::page')->with('page', $page);
    }
}
