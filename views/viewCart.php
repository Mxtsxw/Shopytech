<div>
    <?php if (empty($items)): ?>
    <div class="d-flex align-items-center justify-content-center">
        <div class="text-center">
            Vous n'avez aucun produit dans votre panier
        </div>
    <?php else: ?>
        <?php foreach ($items as $item): ?>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                    <img
                        src="<?= ROOT ?>/static/img/<?= $item->getProduct()->image() ?>"
                        alt="Image"
                        class="img-fluid rounded-start"
                    />
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $item->getProduct()->name() ?></h5>
                        <p class="card-text">
                        <?= $item->getProduct()->description() ?>
                        </p>
                        <form action="/" class="row row-cols-lg-auto g-3 align-items-center">
                        <div class="col-12">
                            <div class="input-group">
                            <label for="qte">Quantité : <?= $item->getProduct()->quantity() ?></label>
                            <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#modal<?= $item->getProduct()->id() ?>">
                                Modifier
                            </button>
                            </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>