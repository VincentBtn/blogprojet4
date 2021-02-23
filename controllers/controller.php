<?php

require('model.php');

function listPosts()
{
    $posts = getPosts();

    require('listPostView.php');
}

function post(string $id)
{
    $post = getPost($id);
    $comments = getComments($id);

    require('postView.php');
}