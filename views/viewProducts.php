<?php $this->_t = 'Shopytech - Achat'; ?>

<?php
// Check if page is request with post
if (isset($_POST['submit'])) {

    // Vérifie que les variables existent
    if (isset($_POST['productId']) && isset($_POST['productQuantity']))
    {
        // Check if the product is already in the cart
        if (isset($_SESSION['cart'][$_POST['productId']])) {
            // If the product is already in the cart, add the quantity
            $_SESSION['cart'][$_POST['productId']] += $_POST['productQuantity'];
        } else {
            // If the product is not in the cart, add it
            $_SESSION['cart'][$_POST['productId']] = $_POST['productQuantity'];
        }
    }
}
?>

<!-- Product section-->
<section class="">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0" src="<?= ROOT ?>/static/img/<?= $product->image()?>" class="card-img-top" alt="<?= $product->name()?>">
                </div>
                <div class="col-md-6">
                <div class="small mb-1">Catégorie</div>
                <h1 class="display-5 fw-bolder"><?= $product->name()?></h1>
                <div class="fs-5 mb-5">
                    <span><?php echo number_format($product->price(), 2, ',', ' ');?>€</span>
                </div>
                <p class="lead"><?= $product->description()?></p>

                <!-- Vérification des stocks -->
                <?php if ($product->quantity() > 0): ?>
                <p class="text-secondary"> Stock : <?= $product->quantity()?></p>
                <form action method="POST" class="d-flex">
                    <input type="hidden" name="productId" value="<?= $product->id()?>">
                    <input class="form-control text-center me-3" type="number" name="productQuantity" value="1" min=1 max="<?= $product->quantity()?>" style="max-width: 4rem" />
                    <button class="btn btn-outline-dark flex-shrink-0" type="submit" name="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Ajouter au panier
                    </button>
                </form>
                <?php else: ?>
                    <p class="text-danger">Ce produit n'est plus en stock</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>