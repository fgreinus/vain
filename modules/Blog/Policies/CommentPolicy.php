<?php

namespace Modules\Blog\Policies;

use Modules\Blog\Entities\Comment;
use Modules\Blog\Entities\Post;
use Modules\User\Entities\User;
use Vain\Policies\Policy;

class CommentPolicy extends Policy
{
    /** @var PostPolicy */
    private $postPolicy;

    public function __construct(PostPolicy $postPolicy)
    {
        $this->postPolicy = $postPolicy;
    }

    /**
     * @param User $user
     * @param Post $post
     *
     * @return bool
     */
    public function create($user, $post)
    {
        return $this->postPolicy->create($user, $post)
            && $user->can('blog.comment.edit');
    }

    /**
     * @param User    $user
     * @param Comment $comment
     *
     * @return bool
     */
    public function edit($user, $comment)
    {
        return $this->postPolicy->show($user, $comment->post)
            || $user->owns($comment)
            || $user->can('blog.comment.edit');
    }

    /**
     * @param User    $user
     * @param Comment $comment
     *
     * @return bool
     */
    public function destroy($user, $comment)
    {
        return $this->postPolicy->show($user, $comment->post)
            || $user->owns($comment)
            || $user->can('blog.comment.destroy');
    }
}
