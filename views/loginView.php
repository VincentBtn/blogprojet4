<?php $title = 'Connexion'; ?>


<?php ob_start(); ?>

<h1>Connexion</h1>
<br />
<?php
if (isset($error) && $error !== null) {

?>
<div class="alert alert-danger" role="alert">
    <?= $error ?>
</div>
<?php
}
?>


<form method="POST" class="user-form">

    <div class="form-group">
        <label for="pseudo">Pseudo :</label>
        <input id="pseudo" type="text" required name="pseudo" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input id="password" type="password" required name="password" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Me connecter</button>

</form>
<hr>

<?php $content = ob_get_clean(); ?>


<?php require('template.php'); ?>