<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<form action="index.php?action=adminUpdatePost&id=<?= $post['id'] ?>" method="POST">
    <div class="mb-3">
    <label for="title" class="form-label">Titre de l'article</label>
    <input type="text" value="<?= $post['title'] ?>" class="form-control" name="title">
    </div>
    <div class="mb-3">
    <label for="content" class="form-label">Contenu de l'article</label>
    <textarea class="form-control tinymce" name="content" rows="3"><?= $post['content'] ?></textarea>
    </div>
    <button type="submit">Editer</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>