<?php

namespace App\Controller;

class BlogController extends Controller
{

    public function index()
    {
        $comments = $this->getDb();
        return $this->views('blog.index', compact('comments'));
    }

    public function show()
    {
       return $this->views('blog.show');
    }

    public function read(string $slug, int $id)
    {
        return $this->views('blog.posts', compact('id', 'slug'));
    }

}