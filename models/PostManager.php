<?php

require_once 'Manager.php'; 


class PostManager extends Manager {

    public const SIZE = 2;

    public function list($paginate = true, $offset = 0)
    {  
        $query = 'SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC';
        if ($paginate) {
            $query .= ' LIMIT '.$offset.', '.self::SIZE.'';
        }
        $req = $this->db->query($query);
        $posts = $req->fetchAll();
        $req->closeCursor();

        return $posts;
    }
    
    public function count()
    {
        $req = $this->db->query('SELECT COUNT(*) FROM posts');
        $count = $req->fetchColumn();
        $req->closeCursor();
        
        return $count;

    }

    public function get($id)
    {
        $req = $this->db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute([$id]);
        $post = $req->fetch();
        if ($post === false) {
            $post = null;
        }
    
        return $post;
    }

    public function create($title, $content) {
        $req = $this->db->prepare('INSERT INTO posts (title, content, creation_date) VALUES (:title, :content, NOW())');
        
        $req->bindParam(':title', $title);
        $req->bindParam(':content', $content);
        $req->execute();
        $req->closeCursor();
       
    }

    public function update($title, $content, $id) {
        
        $req =  $this->db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
        $updated = $req->execute([$title, $content, $id]);
        
        return $updated;
    }

    public function delete($id) {
        
        $req = $this->db->prepare('DELETE FROM posts WHERE id = ?');
        $deletedPost = $req->execute([$id]);

        return $deletedPost;
    }

}