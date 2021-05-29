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
            listPosts();
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
        case 'adminListPosts':
            checkAdmin();
            adminListPosts();
            break;
        case 'reportComment':
            checkConnected();
            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['post_id']) && $_GET['post_id'] > 0) {
                reportComment($_GET['id'], $_GET['post_id']);
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
            require('views/loginView.php');
            if (empty($_POST) === false) {
                if(isset($_POST['pseudo'], $_POST['password'])) { 
                    login($_POST);
                }
            }
            break;
        case 'logout':
            logout();
            break;
        /* default:
            listPosts();
            break; */
    }    
} else {
    listPosts();
}