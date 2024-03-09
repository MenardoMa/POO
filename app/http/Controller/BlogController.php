<?php

namespace App\http\Controller;

use App\http\Model\Tag;
use App\http\Model\Post;

class BlogController extends Controller
{
    public function index()
    {
        return $this->view("blog.index");
    }

    public function post()
    {
        $post = (new Post($this->getBD()))->all();
        return $this->view("blog.post", compact("post"));
    }

    public function show(int $id)
    {
        $post = (new Post($this->getBD()))->findById($id);
        return $this->view("blog.show", compact("post"));
    }

    public function tag($id)
    {
        $tag = (new Tag($this->getBD()))->findById($id);
        return $this->view("blog.tag", compact("tag"));
    }
}