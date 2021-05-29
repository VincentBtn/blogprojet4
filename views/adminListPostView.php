<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Mes articles</h1>



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
            <?= nl2br(htmlspecialchars($data['content'])) ?>
            <br />
            
        </p>
    </div>
<?php
}

?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>