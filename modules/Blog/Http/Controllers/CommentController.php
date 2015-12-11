<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Blog\Entities\Comment;
use Modules\Blog\Entities\Post;
use Modules\Blog\Http\Requests\CommentFormRequest;
use Vain\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:blog.post.create', ['only' => ['create', 'store']]);
    }

    public function store(CommentFormRequest $request, $postId)
    {
        $post = Post::findOrFail($postId);
        policy(Comment::class)->create($request->user(), $post);

        $comment = new Comment($request->all());
        $comment->user()->associate($request->user());
        $comment->post()->associate($post);
        $comment->save();

        return $this->createDefaultResponse($request);
    }

    public function destroy(Request $request, $commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $this->authorize($comment);

        $comment->delete();

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

        return redirect()->route('site.blog.index');
    }
}
