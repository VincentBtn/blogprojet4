<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>


<h1 style="text-align: center;">Blog de Jean-Forteroche</h1>
<p style="text-align: center;">Derniers billets du blog :</p>


<nav aria-label="Page navigation example" style="display: flex; justify-content: center;">
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
    <div class="card" style="width: 18rem; text-align: center; margin: 0 auto;">
      <div class="card-body">
        <h3 class="card-title">
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>
        
        <div class="card-text">
            <?= ($data['content']) ?>
            <br />
            <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
        </div>
      </div>
    </div>
<?php
}

?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>