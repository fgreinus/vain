<?php

namespace Modules\Blog\Policies;

use Modules\Blog\Entities\Post;
use Modules\User\Entities\User;
use Vain\Policies\Policy;

class PostPolicy extends Policy
{
    /**
     * @param User $user
     *
     * @return bool
     */
    public function index($user)
    {
        return $user->can('blog.post.show');
    }

    /**
     * @param User $user
     * @param Post $post
     *
     * @return bool
     */
    public function show($user, $post)
    {
        return $user->owns($post)
            || $this->index($user);
    }

    /**
     * @param User $user
     * @param Post $post
     *
     * @return bool
     */
    public function edit($user, $post)
    {
        return $user->owns($post)
            || $user->can('blog.post.edit');
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function create($user)
    {
        return $user->can('blog.post.create');
    }

    /**
     * @param User $user
     * @param Post $post
     *
     * @return bool
     */
    public function destroy($user, $post)
    {
        return $user->owns($post)
            || $user->can('blog.post.destroy');
    }
}
