<?php

namespace App\http\Model;

use PDO;
use DateTime;

class Post extends Model
{

    protected $table = "posts";

    public function title()
    {
        return $this->title;
    }

    public function troContent()
    {
        return substr($this->content, 0, 150) . "...";
    }

    public function getCreate_at()
    {
        return (new DateTime($this->create_at))->format("d M Y à H:i");
    }

    public function Elemnt()
    {
        return <<<HTML
        <a href="/posts/{$this->id}">lire l'article</a>
HTML;
    }

    public function getTags()
    { 
        return $this->query(
           "SELECT t.* FROM tags t
            INNER JOIN post_tag pt ON pt.tag_id = t.id
            WHERE pt.post_id = ?", [$this->id]
        );
    }

    public function create(array $data, $relation = null)
    {
        parent::create($data);

        $id = $this->db->lastInsertId();

        foreach ($relation as  $tagId) {
            $stmt = $this->db->prepare("INSERT INTO post_tag(post_id, tag_id) VALUES(?,?)");
            $stmt->execute([ $id, $tagId]);
        }

        return true;

    }

    public function update(int $id, array $data, ?array $relation = null)
    {
        parent::update($id, $data);

        $stmt = $this->db->prepare("DELETE FROM post_tag WHERE post_id = ?");
        $result = $stmt->execute([ $id ]);

        foreach ($relation as  $tagId) {
            $stmt = $this->db->prepare("INSERT INTO post_tag(post_id, tag_id) VALUES(?,?)");
            $stmt->execute([ $id, $tagId]);
        }

        if($result){
            return true;
        }

    }

}