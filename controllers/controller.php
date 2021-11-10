<?php


require_once './models/PostManager.php';
require_once './models/CommentManager.php';
require_once './models/UserManager.php';

function listPosts($page = 1)
{
    $postManager = new PostManager();
    $total = $postManager->count();
    $pages = ceil($total/PostManager::SIZE);
    $offset = ($page * PostManager::SIZE) - PostManager::SIZE;
    $posts = $postManager->list(true, $offset);

    require('./views/listPostView.php');
}



function post(string $id)
{
    $postManager = new PostManager();
    $post = $postManager->get($id);
    if ($post === null) {
        throw new Exception('Article inexistant');
    }
    $commentManager = new CommentManager();
    $comments = $commentManager->listFromPostId($id);
    

    require('./views/postView.php');
}


function adminPost(string $id)
{
    $postManager = new PostManager();
    $post = $postManager->get($id);
    if ($post === null) {
        throw new Exception('Article inexistant');
    }

    require('views/updatePostView.php');
}


function adminListPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->list(false);

    require('./views/adminListPostView.php');
}

function getReportedComments() 
{
    $commentManager = new CommentManager();

    $comments = $commentManager->getReported();

    require('./views/adminListCommentsView.php');

}

function register($user) 
{
    
    $userManager = new UserManager();
    $pseudo = strip_tags($user['pseudo']);
    $email = strip_tags($user['email']);
    $password = password_hash($user['password'], PASSWORD_DEFAULT);
    $userManager->create($pseudo, $password, $email);
    $_SESSION['connected'] = true;
    $_SESSION['pseudo'] = $pseudo;
   

    header('Location: index.php');


}

function login($params)
{
    $userManager = new UserManager();
    $pseudo = strip_tags($params['pseudo']);
    $user = $userManager->getByPseudo($pseudo);
    $error = null;
    if ($user) {
        if (password_verify($params['password'], $user['password'])) {
            $_SESSION['connected'] = true;
            $_SESSION['pseudo'] = $pseudo;
            if ($user['role'] === UserManager::ROLE_ADMIN) {
                $_SESSION['admin'] = true;
                header('Location: index.php?action=admin');

            }
            
            header('Location: index.php');
        
        } else {
            $error = 'Mot de passe invalide';
        }
    
        
    } else {
        $error = 'Utilisateur inexistant';
    }

    require('./views/loginView.php');

}

function logout() {
	$_SESSION = [];
	session_destroy();
    header('Location: index.php');

}

function newPost($title, $content) {
	
    $postManager = new PostManager();
    
    $postManager->create($title, $content);

	header('Location: index.php');
}

function updatePost($title, $content, $id) {

    $postManager = new PostManager();

    $updated = $postManager->update($title, $content, $id);

    header('Location: index.php?action=adminListPosts');

}



function addComment($postId, $author, $comment) {
    
    $commentManager = new CommentManager();
    $comment = strip_tags($comment);
    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception("Impossible d'ajouter le commentaire !");
    }
    
    
    
}

function reportComment($id, $postId) {

    $commentManager = new CommentManager();
    
    $alertedComment = $commentManager->report($id);

    header('Location: index.php?action=post&id=' . $postId );
    

}

function validComment($id) {

    $commentManager = new CommentManager();

    $commentManager->valid($id);

    header('Location: index.php?action=adminListComments&id=' . $id );


}

function deleteCommentAction($id) {

    $commentManager = new CommentManager();

    $deletedComment = $commentManager->deleteComment($id);

    


}

function deletePostAction($id) {
    

    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $deletedPost = $postManager->delete($id);
    $commentManager->deleteRelated($id);

    header('Location: index.php?action=adminListPosts');

}

function checkAdmin() {

    if (!empty($_SESSION['admin']) && $_SESSION['admin'] === true) {
        return;
    }
    header('Location: index.php');
}

function checkConnected() {
    if (!empty($_SESSION['connected']) && $_SESSION['connected'] === true) {
        return;
    }
    header('Location: index.php?action=login');

}