<?php

namespace App\Http\Service\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PostService
{
    public function getDummyPost($id)
    {
//        $response = Http::get('https://dummyjson.com/posts/'.$id);
        $response = Http::get('https://dummyjson.com/posts/1');

        return $response->object();
    }

    public function getDummyPosts($posts)
    {
        $posts->getCollection()->transform(function ($post) {
            $dummyPost = $this->getDummyPost($post->dummy_post_id);

            return [
                'id' => $post->id,
                'title' => $dummyPost->title,
                'author' => $post->user->name,
                'body' => Str::limit($dummyPost->body, 128),
            ];
        });

        return $posts;
    }


    public function store($data)
    {
        $data['userId'] = auth()->id();

        $response = Http::post('https://dummyjson.com/posts/add',$data);

        $postData['dummy_post_id'] = $response->object()->id;
        $postData['user_id'] = $response->object()->userId;

        $post = Post::create($postData);

        return ['status' => 'success',
            'data' => $post];
    }


    public function update($data, Post $post)
    {
//        $response = Http::put('https://dummyjson.com/posts/'.$post->dummy_post_id,$data);
        $response = Http::put('https://dummyjson.com/posts/1',$data);

        $postData['dummy_post_id'] = $response->object()->id;

        $post = $post->update($postData);

        return ['status' => 'success',
            'data' => $post];
    }

    public function destroy(Post $post)
    {
        $response = Http::delete('https://dummyjson.com/posts/'.$post->dummy_post_id);
//        $response = Http::delete('https://dummyjson.com/posts/1');

        $post->delete();

        return ['status' => 'success',
            'data' => $post];
    }
}
