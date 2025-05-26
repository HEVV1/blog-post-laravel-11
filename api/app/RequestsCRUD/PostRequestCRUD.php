<?php

namespace App\RequestsCRUD;

use App\Models\Post;
use App\Requests\PostRequest;

class PostRequestCRUD
{
    /**
     * @param PostRequest $request
     */
    public function createPost(PostRequest $request)
    {
        $post = new Post();
        $post->fill([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        $post->save();
    }
}