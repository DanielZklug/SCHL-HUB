<?php

namespace App\Controllers\Admin;

use App\Models\Post;
use App\Controllers\Controller;

class PostController extends Controller{
    
    public function index(){
        $post = (new Post($this->getDB()))->all();
    }
}