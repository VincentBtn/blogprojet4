<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Mes articles</h1>


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Titre</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($posts as $data)
    {
    ?>
    <tr>
        <td>
            <?= $data['id'] ?>
        </td>
        <td>
            <?= htmlspecialchars($data['title']) ?>
        </td>
        <td>
        <a href="index.php?action=adminUpdatePost&id=<?= $data['id'] ?>" class="btn btn-light">
            Editer
        </a>
        <button type="button" class="btn btn-danger delete-post" data-id="<?= $data['id'] ?>" data-bs-toggle="modal" data-bs-target="#modal">
            Supprimer
        </button>
        
            
            
        </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Suppresion de l'article</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Souhaitez-vous vraiment supprimer l'article ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a class="btn btn-primary confirm-delete" href="">Confirmer</a>
      </div>
    </div>
  </div>
</div>



<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

<script>
  const href = "index.php?action=adminDeletePost";
  [...document.querySelectorAll(".delete-post")].forEach(item => {
      item.addEventListener("click", (e) => {
        const id = e.target.getAttribute("data-id");
        const link = document.querySelector(".confirm-delete");
        const url = href + '&id=' + id;
        link.setAttribute("href", url);
      } )
  })




</script>