<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p>Création d'un article :</p>

<form action="index.php?action=adminCreatePost" method="POST">
    <div class="mb-3">
    <label for="title" class="form-label">Titre de l'article</label>
    <input type="text" class="form-control" name="title">
    </div>
    <div class="mb-3">
    <label for="content" class="form-label">Contenu de l'article</label>
    <textarea class="form-control tinymce" name="content" rows="3"></textarea>
    </div>
    <button type="submit">Créer</button>
</form>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>