<?php

namespace App\Http\Controllers\Api\Posts;

use App\Http\Controllers\Controller;
use App\Http\Service\Post\PostService;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public $service;
    public function __construct(PostService $service)
    {
        $this->service = $service;
    }
}
