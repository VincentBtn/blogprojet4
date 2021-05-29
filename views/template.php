<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link href="public/css/clean-blog.min.css" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/22f31df12b.js" crossorigin="anonymous"></script>
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>tinymce.init({selector:'.tinymce'});</script>
    </head>
        
    <body>
    
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="index.html">Blog Jean Forteroche</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Accueil</a>
          </li>
          <?php
          if (empty($_SESSION['connected'])) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?action=register">Inscription</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?action=login">Connexion</a>
          </li>

          <?php
          }
          if (!empty($_SESSION['connected']) && $_SESSION['connected'] === true) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?action=logout">Déconnexion</a>
          </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>

  <header class="masthead" style="background-image: url('public/img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Blog</h1>
            <span class="subheading">Voyage en Alaska par Jean-Forteroche</span>
          </div>
        </div>
      </div>
    </div>
  </header>
        
        
        
        
        
        <?= $content ?>
    

 



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </body>
</html>