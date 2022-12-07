<?php $this->_t = 'Shopytech - Accueil'; ?>

<div class="row row-cols-1 row-cols-md-3 g-4">

    <?php foreach($products as $product) : ?>
    <div class="col">
        <div class="card h-100" style="">
            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="./static/img/<?= $product->image()?>" class="img-fluid"/>
                <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= $product->name()?></h5>
                <p class="card-text"><?= $product->description()?></p>
                <p class="card-text"><?php echo number_format($product->price(), 2, ',', ' ');?>€</p>
                <a href="#" class="btn btn-primary">Acheter</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

</div>