<?php $title = 'Inscription'; ?>


<?php ob_start(); ?>

<h1>Inscription</h1>
<br />

<form action="index.php?action=register" method="POST" class="user-form">

    <div class="form-group">
        <label for="pseudo">Pseudo :</label>
        <input id="pseudo" type="text" required name="pseudo" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input id="password" type="password" required name="password" class="form-control">
    </div>

    <div class="form-group">
        <label for="password_confirm">Confirmez le mot de passe :</label>
        <input id="password_confirm" type="password" required name="password_confirm" class="form-control">
    </div>

    <div class="form-group">
        <label for="email">Email :</label>
        <input id="email" type="email" required name="email" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">M'inscrire</button>

</form>
<hr>

<?php $content = ob_get_clean(); ?>


<?php require('template.php'); ?>