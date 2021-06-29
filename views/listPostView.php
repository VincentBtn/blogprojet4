<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p>Derniers billets du blog :</p>


<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item <?= $page <= 1 ? 'disabled' : ''?>">
      <a class="page-link" href="index.php?action=listPosts&amp;page=<?= $page - 1 ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <?php
    for ($i = 1; $i <= $pages; $i++) {

    ?>
    <li class="page-item <?= $page == $i ? 'active' : ''?>"><a class="page-link" href="index.php?action=listPosts&amp;page=<?= $i ?>"><?= $i ?></a></li>
    <?php
    }
    ?>
    
    <li class="page-item <?= $page >= $pages ? 'disabled' : ''?>">
      <a class="page-link" href="index.php?action=listPosts&amp;page=<?= $page + 1 ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>

<?php

foreach ($posts as $data)
{
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>
        
        <p>
            <?= ($data['content']) ?>
            <br />
            <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
        </p>
    </div>
<?php
}

?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>