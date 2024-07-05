<?php

namespace App\Http\Controllers\Api\Posts;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Service\Post\PostService;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    public function __construct(PostService $service)
    {
        parent::__construct($service);
        $this->middleware('post.owner')->only(['update','destroy']);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->service->getDummyPosts(Post::paginate(10));

        return response()->json([
            'status' => 'success',
            'data' => $posts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $response = $this->service->store($data);
        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();
        $response = $this->service->update($data, $post);
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $response = $this->service->destroy($post);

        return response()->json($response);
    }
}
