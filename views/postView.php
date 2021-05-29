<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </h3>
    
    <p>
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </p>
</div>

<h2>Commentaires</h2>

<?php
foreach ($comments as $comment)
{
?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    <a class="btn btn-danger" href="index.php?action=reportComment&amp;post_id=<?= $post['id'] ?>&amp;id=<?= $comment['id'] ?>" role="button">Signaler</a>
<?php
}
if (!empty($_SESSION['connected']) && $_SESSION['connected'] === true) {
?>

<form method="post" action="index.php?action=postComment&amp;id=<?= $post['id'] ?>">
    <div class="mb-3">
    <label for="comment" class="form-label">Votre commentaire</label>
    <textarea class="form-control" name="comment" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Commenter</button>
</form>
<?php
} else {
?>
<p><a href="index.php?action=login">Pour rajouter un commentaire, veuillez vous connecter.</a></p>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>