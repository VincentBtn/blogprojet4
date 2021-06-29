<?php

require_once 'Manager.php';

class CommentManager extends Manager {

    public function listFromPostId(string $postId) 
    {

        $req = $this->db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $req->execute([$postId]);
        $comments = $req->fetchAll();
        $req->closeCursor();

        return $comments;
            
    }

    public function postComment($postId, $author, $comment)
    {

        $comments = $this->db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'); 
        $affectedLines = $comments->execute([$postId, $author, $comment]);

        return $affectedLines;
    }

    public function deleteComment($id) 
    {

        $req =  $this->db->prepare('DELETE FROM comments WHERE id = ?');
        $deletedComment = $req->execute([$id]);

        return $deletedComment;
    }


    public function report($id)
    {
        $req = $this->db->prepare('UPDATE comments SET report = 1 WHERE id = ?');
        $alertedComment = $req->execute([$id]);
    
        return $alertedComment;
    }

    public function getReported()
    {
        
        $req = $this->db->query('SELECT id, post_id, author, comment, report, DATE_FORMAT(comment_date, \'le %d/%m/%Y à %Hh%i\') AS comment_date_fr FROM comments WHERE report = 1');
        $req->execute();
        $comments = $req->fetchAll();
        $req->closeCursor();
        
        return $comments;
       
    }

}