<?php $title = 'Inscription'; ?>


<?php ob_start(); ?>

<h1>Inscription</h1>
<br />

<form action="index.php?action=register" method="POST">

    <div class="form-group">
        <label for="">Pseudo :</label>
        <input type="text" required name="pseudo" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Mot de passe :</label>
        <input type="password" required name="password" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Confirmez le mot de passe :</label>
        <input type="password" required name="password_confirm" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Email :</label>
        <input type="email" required name="email" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">M'inscrire</button>

</form>
<hr>

<?php $content = ob_get_clean(); ?>


<?php require('template.php'); ?>