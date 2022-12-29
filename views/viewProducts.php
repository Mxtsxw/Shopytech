<?php $this->_t = 'Shopytech - Achat'; ?>

<!-- Product section-->
<section class="">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6">
                        <img class="card-img-top mb-5 mb-md-0" src="./static/img/<?= $product->image()?>" class="card-img-top" alt="<?= $product->name()?>">
                     </div>
                     <div class="col-md-6">
                        <div class="small mb-1">Catégorie</div>
                        <h1 class="display-5 fw-bolder"><?= $product->name()?></h1>
                        <div class="fs-5 mb-5">
                            <span><?php echo number_format($product->price(), 2, ',', ' ');?>€</span>
                        </div>
                        <p class="lead"><?= $product->description()?></p>
                        <p class="text-secondary"> Stock : <?= $product->quantity()?></p>
                        <div class="d-flex">
                            <input class="form-control text-center me-3" id="inputQuantity" type="number" value="1" min=0 max="<?= $product->quantity()?>" style="max-width: 4rem" />
                            <button class="btn btn-outline-dark flex-shrink-0" type="button">
                                <i class="bi-cart-fill me-1"></i>
                                Ajouter au panier
                            </button>
                        </div>
                     </div>
                </div>
            </div>
        </section>