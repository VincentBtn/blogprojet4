<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Derniers commentaires signalés</h1>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Auteur</th>
      <th scope="col">Contenu</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($comments as $data)
    {
    ?>
    <tr>
        <td>
            <?= $data['id'] ?>
        </td>
        <td>
            <?= htmlspecialchars($data['author']) ?>
        </td>
        <td>
            <?= htmlspecialchars($data['comment']) ?>
        </td>
        <td>
        <button type="button" class="btn btn-danger delete-comment" data-id="<?= $data['id'] ?>" data-bs-toggle="modal" data-bs-target="#modal">
            Supprimer
          </button>
            <a class='btn btn-success'>Valider</a>
            
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
        <h5 class="modal-title" id="modalLabel">Suppresion du commentaire</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Souhaitez-vous vraiment supprimer le commentaire ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a class="btn btn-primary confirm-delete" href="index.php?action=adminDeleteComment">Confirmer</a>
      </div>
    </div>
  </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

<script>
  document.querySelector(".delete-comment").addEventListener("click", (e) => {
    const id = e.target.getAttribute("data-id");
    const link = document.querySelector(".confirm-delete");
    let url = link.getAttribute("href");
    url += '&id=' + id;
    link.setAttribute("href", url);
  } )




</script>