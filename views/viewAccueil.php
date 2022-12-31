<?php $this->_t = 'Shopytech - Accueil'; ?>

<div class="container mt-5">
  <h1>Tous nos produits</h1>
  <div class="row mt-4">
    <?php foreach ($products as $product): ?>
      <div class="col-md-3 mb-3">
        <div class="card">
            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="<?= ROOT ?>/static/img/<?= $product->image()?>" class="card-img-top card-img-showcase" alt="<?= $product->name()?>">
                <a href="<?=ROOT?>/products?id=<?= $product->id()?>">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= $product->name()?></h5>
                <p class="card-text description"><?= $product->description()?></p>
                <p class="card-text"><?php echo number_format($product->price(), 2, ',', ' ');?>€</p>
                <a href="<?=ROOT?>/products?id=<?= $product->id()?>" class="btn btn-primary">Voir le produit</a>
            </div>  
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>