<?php $this->_t = 'Shopytech - ADMIN'; ?>


<h1>Page d'admin en cours de développement</h1>
<table class="table align-middle mb-0 bg-white">
    <thead class="bg-light">
        <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Etat</th>
        <th>Quantité</th>
        <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product):?>
    <tr>
      <td>
        <div class="d-flex align-items-center">
          <img
              src="https://mdbootstrap.com/img/new/avatars/8.jpg"
              alt=""
              style="width: 45px; height: 45px"
              class="rounded-circle"
              />
          <div class="ms-3">
            <p class="fw-bold mb-1">product</p>
            <p class="text-muted mb-0">j'adore les petits poissons</p>
          </div>
        </div>
      </td>
      <td>
        <p class="fw-normal mb-1">3 pck j'ai envie</p>
        <p class="text-muted text-danger mb-0">attention need to restock</p>
      </td>
      <td>
        <span class="badge badge-success rounded-pill d-inline">En cours de livraison</span>
      </td>
      <td>Senior</td>
      <td>
        <button type="button" class="btn btn-link btn-sm btn-rounded">
          Edit
        </button>
      </td>
    </tr>
    <?php endforeach?>
    </tbody>
</table>