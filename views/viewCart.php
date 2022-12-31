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
                        <p class="card-text">
                        <small class="text-muted"><?= $item->getQuantity() ?></small>
                        </p>
                    </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>