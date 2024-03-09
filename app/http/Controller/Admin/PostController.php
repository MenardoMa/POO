<?php

namespace App\http\Controller\Admin;

use App\http\Model\Tag;
use App\http\Model\Post;
use App\http\Controller\Controller;

class PostController extends Controller
{

    public function index()
    {
        $post = (new Post($this->getBD()))->all();
        return $this->view("admin.post.index", compact("post"));
    }

    public function destroy(int $id)
    {
        $stmt = (new Post($this->getBD()));
        $result = $stmt->destroy($id);

        if($result){
            return header('location: /admin/posts');
        }
    }

    public function edit(int $id)
    {
        $post = (new Post($this->getBD()))->findById($id);
        $tags = (new Tag($this->getBD()))->all();

        return $this->view("admin.post.form", compact("post", "tags"));
    }

    public function create()
    {
        $tags = (new Tag($this->getBD()))->all();
        return $this->view("admin.post.form", compact("tags"));
    }

    public function createPost()
    {
        $post = new Post($this->getBD());
        
        $tags = array_pop($_POST);

        $result = $post->create($_POST, $tags);

        if($result){
            return header('location: /admin/posts');
        }
    }

    public function update(int $id)
    {
        $post = new Post($this->getBD());

        /**
         * array pop va extraire le dernier tableau 
         * et on va stocker sa dans une variable
         */

        $tags = array_pop($_POST);

        $result = $post->update($id, $_POST, $tags);

        if($result){
            return header('location: /admin/posts');
        }

    }
}