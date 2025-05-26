<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Requests\PostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    public function __construct()
    {

    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return PostResource::collection(
            Post::repository()
                ->all()
        );
    }

    /**
     * @param Post $uuid
     * @return AnonymousResourceCollection
     */
    public function show(Post $uuid): AnonymousResourceCollection
    {
        return PostResource::collection([$uuid]);
    }

    public function store(PostRequest $request)
    {

    }
}
