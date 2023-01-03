<div class="d-flex gap-3 justify-content-around">
    <?php if (empty($items)): ?>
    <div class="d-flex align-items-center justify-content-center">
        <div class="text-center mt-5">
            <i class="fas fa-shopping-cart fa-5x"></i>
            <p class="lead mt-3">
            Votre panier est vide.
            </p>
            <hr>
            <p>
            Vous n'avez pas encore ajouté de d'article dans votre panier. Parcourez le site pour trouver des produits extroardinaires !
            </p>
            <div>
                <a href="<?= ROOT ?>" class="btn btn-primary mt-5">Découvrir nos produits</a>
            </div>
        </div>
    </div>
    <?php else: ?>
        <div>
            <h2 class="my-2">Panier</h2>
        <?php foreach ($items as $item): ?>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img
                            src="<?= ROOT ?>/static/img/<?= $item->getProduct()->image() ?>"
                            alt="Image"
                            class="img-fluid rounded-start fit-cover h-100"
                        />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $item->getProduct()->name() ?></h5>
                            <p class="card-text">
                            <?= $item->getProduct()->description() ?>
                            </p>
                            <form action="<?=ROOT?>/handlers/cartHandler.php" method="POST" class="row row-cols-lg-auto g-3 align-items-center">
                                <input type="hidden" name="productId" value="<?= $item->getProduct()->id()?>">
                                <div class="col-12">
                                    <div class="input-group gap-5">
                                        <label for="qte">Quantité : <?= $item->getProduct()->quantity() ?></label>
                                        <button type="submit" name="delete" class="btn btn-danger rounded" data-mdb-toggle="modal" data-mdb-target="#modal<?= $item->getProduct()->id() ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>                            
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="col-md-4 mb-4">
    <div class="card mb-4">
      <div class="card-header py-3">
        <h5 class="mb-0">Résumé</h5>
      </div>
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
            Produits
            <span>$53.98</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center px-0">
            Livraison
            <span>Gratuit</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
            <div>
              <strong>Prix Total</strong>
              <strong>
                <p class="mb-0">(TVA incluse)</p>
              </strong>
            </div>
            <span><strong>$53.98</strong></span>
          </li>
        </ul>

        <a href="<?= ROOT ?>/payment" class="btn btn-primary btn-lg btn-block">
         Procéder au Paiement
        </a>
      </div>
    </div>
  </div>
</div>