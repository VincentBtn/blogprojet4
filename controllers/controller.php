<?php

// require('./models/model.php');
require_once './models/PostManager.php';
require_once './models/CommentManager.php';
require_once './models/UserManager.php';

function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->list();

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


function adminListPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->list();

    require('./views/adminListPostView.php');
}

function register($user) 
{
    
    $userManager = new UserManager();
    $password = password_hash($user['password'], PASSWORD_DEFAULT);
    $userManager->create($user['pseudo'], $password, $user['email']);


}

function login($params)
{
    $userManager = new UserManager();
    $user = $userManager->getByPseudo($params['pseudo']);
    if ($user) {
        if (password_verify($params['password'], $user['password'])) {
            var_dump('Mot de passe valide !');
            $_SESSION['connected'] = true;
            $_SESSION['pseudo'] = $user['pseudo'];
            if ($user['role'] === UserManager::ROLE_ADMIN) {
                $_SESSION['admin'] = true;
                header('Location: index.php?action=admin');

            }
        
        
        } else {
            var_dump('Mot de passe invalide');
        }
    
        
    } else {
        var_dump('Utilisateur inexistant');
    }

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

    header('Location: index.php');

}



function removePost($id) {
	
    $postManager = new PostManager();

	$deletedPost = $postManager->delete($id);

	header('Location: index.php');

}

function addComment($postId, $author, $comment) {
    
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception("Impossible d'ajouter le commentaire !");
    }
    
    header('Location: index.php?action=post&id=' . $postId . '#commentsFrame');
    
}

function reportComment($id, $postId) {

    $commentManager = new CommentManager();
    
    $alertedComment = $commentManager->report($id);

    header('Location: index.php?action=post&id=' . $postId );
    

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