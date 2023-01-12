<?php $this->_t = 'Shopytech Dashboard - Produits'; ?>

<div class="container my-4">
  
<div class="mt-3 mb-5 text-center bg-light p-4">
  <h1 class="mb-3">Tableau de bord</h1>
  <h4 class="mb-3">Stock des produits</h4>
  <div class="d-flex gap-3 justify-content-center">
    <a class="btn btn-primary" href="<?=ROOT?>/dashboard/orders" role="button">Commandes</a>
    <a class="btn btn-primary" href="<?=ROOT?>/dashboard/products" role="button">Stock des produits</a>
  </div>
</div>
<table class="table align-middle mb-0 bg-white">
    <thead class="bg-light">
        <tr>
          <th>ID</th>
          <th>Produits</th>
          <th class="text-center">État</th>
          <th class="text-center">Quantité</th>
          <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product):?>
    <tr>
      <td><?=$product->id()?></td>
      <td>
        <div class="d-flex align-items-center">
          <img
              src="<?= ROOT ?>/static/img/<?= $product->image()?>"
              alt="<?= $product->name()?>"
              style="width: 45px; height: 45px"
              class="rounded-circle"
              />
          <div class="ms-3">
            <p class="fw-bold mb-1"><?php echo $product->name() ;?></p>
            <p class="text-muted mb-0 text-wrap-dot"><?php echo $product->description();?></p>
          </div>
        </div>
      </td>
      <td>
        <?php if ($product->quantity()==0) : ?>
          <p class="text-danger mb-0 text-center">Rupture de stocks</p>
        <?php elseif ($product->quantity()<3) : ?>
          <p class="text-warning mb-0 text-center">Stocks faibles</p>
        <?php else : ?>
          <p class="text-success mb-0 text-center">OK</p>
        <?php endif; ?>
      </td>
      <td>
        <p class="fw-normal mb-1 text-center"><?= $product->quantity()?></p>
      </td>
      <td>
        <a href="<?=ROOT?>/dashboard/products/update?id=<?= $product->id()?>" type="button" class="btn btn-sm btn-primary btn-rounded">MODIFIER</a>
      </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>