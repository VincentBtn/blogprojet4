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


<form action="" method="POST" class="user-form">

    <div class="form-group">
        <label for="">Pseudo :</label>
        <input type="text" required name="pseudo" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Mot de passe :</label>
        <input type="password" required name="password" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Me connecter</button>

</form>
<hr>

<?php $content = ob_get_clean(); ?>


<?php require('template.php'); ?>