<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<div class="adminPanel">
<h1>Administration</h1>
<a href="index.php?action=adminListPosts"> Listes des articles</a></br>
<a href="index.php?action=adminListComments"> Listes des commentaires signalés</a></br>
<a href="index.php?action=adminCreatePost"> Créer un article</a>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>