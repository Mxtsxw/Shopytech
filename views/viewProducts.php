<?php $this->_t = 'Shopytech - ' . $product->name(); ?>

<!-- Product section-->
<section class="">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0 fit-cover h-100"
                    src="<?= ROOT ?>/static/img/<?= $product->image() ?>" class="card-img-top"
                    alt="<?= $product->name() ?>">
            </div>
            <div class="col-md-6">
                <div class="small mb-1">
                    <?= $category ?>
                </div>
                <h1 class="display-5 fw-bolder"><?= $product->name() ?></h1>
                <div class="fs-5 mb-5">
                    <span>
                        <?php echo number_format($product->price(), 2, ',', ' '); ?>€
                    </span>
                </div>
                <p class="lead"><?= $product->description() ?></p>

                <!-- Vérification des stocks -->
                <?php if ($product->quantity() > 0): ?>
                    <p class="text-secondary"> Stock : <?= $product->quantity() ?></p>
                    <form action="<?= ROOT ?>/handlers/cartHandler.php" method="POST" class="d-flex">
                        <input type="hidden" name="productId" value="<?= $product->id() ?>">
                        <input class="form-control text-center me-3" type="number" name="productQuantity"
                            value="<?= $_SESSION['cart'][$product->id()] ?? "1" ?>" min=1 max="<?= $product->quantity() ?>"
                            style="max-width: 4rem" />
                        <button class="btn btn-outline-dark flex-shrink-0" type="submit" name="add">
                            <i class="bi-cart-fill me-1"></i>
                            Ajouter au panier
                        </button>
                    </form>
                <?php else: ?>
                    <p class="text-danger">Ce produit n'est plus disponible.</p>
                <?php endif; ?>
                <?php if (isset($_SESSION['cart'][$product->id()])): ?>
                    <p class="text-success mt-4">Ce produit est déjà dans votre panier.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="container mt-5">
    <div class="">
        <h2 class="text-center my-3">Commentaires</h2>
    </div>
    <div class="row justify-content-md-center gap-3">
    

    <?php foreach ($reviews as $review): ?>
        <div class="card hover-shadow" style="width: 26rem;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img
                        src="<?=ROOT?>/static/img/<?= $review->photoUser() ?>"
                        alt="Trendy Pants and Shoes"
                        class="img-fluid rounded-circle mt-3"
                    />
                </div>
                <div class="card-body col-md-8">
                    <h5 class="card-title"><?= $review->title() ?></h5>
                    <p class="card-text"><?= $review->description() ?></p>
                    <div>
                        Note : <span> 
                            <?php for ($i = 0; $i < $review->stars(); $i++): ?>
                            <i class="fas fa-star text-warning"></i>
                            <?php endfor; ?>
                            </span>
                    </div>
                    <p class="card-text">- <?= $review->nameUser() ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    </div>
</section>