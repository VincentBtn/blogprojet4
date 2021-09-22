<?php

session_start();


require('controllers/controller.php');

/*if (isset($_GET['action'])) {
    if ($_GET['action'] === 'listPosts') {
        listPosts();
    }
    elseif ($_GET['action'] === 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            post($_GET['id']);
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }
}
else {
    listPosts();
}*/




if (isset($_GET['action'])) {

    switch ($_GET['action']) {
        case 'listPosts':
            $page = 1;
            if (isset($_GET['page']) && $_GET['page'] > 0) {
                $page = $_GET['page'];
            }
            listPosts($page);
            break;
        case 'post':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post($_GET['id']);
               
            }
            else {
                echo 'Erreur : aucun identifiant de billet envoyé';
            }
            break;
        case 'postComment':
            checkConnected();
            if (!empty($_POST) && isset($_POST['comment'], $_GET['id'])) {
                addComment($_GET['id'], $_SESSION['pseudo'], $_POST['comment']);
                
            }
            break;
        case 'admin':
            checkAdmin();
            require('views/adminView.php');
            break;
        case 'adminCreatePost':
            checkAdmin();
            require('views/createPostView.php');
            if (empty($_POST) === false) {
                if(isset($_POST['title'], $_POST['content'])) {
                    newPost($_POST['title'], $_POST['content']);
                }
            }
            break;
        case 'adminUpdatePost':
            checkAdmin();
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                adminPost($_GET['id']);
               
            }
            else {
                echo 'Erreur : aucun identifiant de billet envoyé';
            }
           
            if (empty($_POST) === false) {
                if(isset($_POST['title'], $_POST['content'])) {
                    updatePost($_POST['title'], $_POST['content'], $_GET['id']);
                }
            }
            break;

        case 'adminListPosts':
            checkAdmin();
            adminListPosts();
            break;
        case 'adminListComments':
            checkAdmin();
            getReportedComments();
            break;
        case 'adminDeleteComment':
            checkAdmin();
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deleteCommentAction($_GET['id']);
            }
            break;
        case 'adminDeletePost':
            checkAdmin();
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deletePostAction($_GET['id']);
            }
            break;
        case 'reportComment':
            checkConnected();
            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['post_id']) && $_GET['post_id'] > 0) {
                reportComment($_GET['id'], $_GET['post_id']);
            }
            break;
        case 'validComment':
            checkAdmin();
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                validComment($_GET['id']);
            }
            break;
        case 'register':
            require('views/registerView.php');
            if (empty($_POST) === false) {
                if(isset($_POST['pseudo'], $_POST['password'], $_POST['email'])) { 
                    register($_POST);
                    header('Location: index', true, 301);
                }
            }
            break;
        case 'login':
            
            if (empty($_POST) === false) {
                if(isset($_POST['pseudo'], $_POST['password'])) { 
                    login($_POST);
                }
            } else { 
                require('views/loginView.php');
            }
            break;
        case 'logout':
            logout();
            break;
        default:
            listPosts();
            break; 
    }    
} else {
    listPosts();
}