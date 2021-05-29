<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Administration</h1>
<a href="index.php?action=adminListPosts"> Listes des articles</a>
<a href="index.php?action=adminListComments"> Listes des commentaires</a>
<a href="index.php?action=adminCreatePost"> Créer un article</a>



<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>