<?php namespace Modules\Blog\Http\Controllers;

use Vain\Http\Controllers\Controller;
use Modules\Blog\Entities\Post;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller {

	public function index()
	{
        $this->authorize('blog.post.show');

        $posts = Post::with('user', 'category', 'comments')->published()->paginate(config('blog.posts_per_page'));

		return view('blog::index')->with('posts', $posts);
	}

    public function show($slug)
    {
        $post = Post::published()
            ->with('user', 'category')
            ->where('slug', $slug)
            ->first();

        if ($post === null) {
            throw new NotFoundHttpException('post with slug \'' . $slug . '\' not found');
        }

        $this->authorize($post);

        return view('blog::post')->with('post', $post);
    }

}