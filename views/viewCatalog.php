<?php $this->_t = 'Shopytech - '; ?>

<div class="d-flex gap-3">
    
<div class="w-25">
    <div class="card bg-light mb-3" style="max-width: 18rem;">
        <div class="card-header">Catégories</div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><a href="<?= ROOT ?>/catalog?category">Tous nos produits</a></li>
            <?php foreach($categories as $category) : ?>
                <li class="list-group-item"><a href="<?= ROOT ?>/catalog?category=<?= $category->name()?>"><?= $category->name()?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<div class="w-100">
    <div class="d-flex justify-content-between mb-3">
        <h1><?= ucfirst($activeCategory) ?></h1>
        <p class="lead">Produits : <?=count($products)?></p>
    </div>
    <?php foreach($products as $product) : ?>
        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-2 ">
                    <img src="<?= ROOT ?>/static/img/<?= $product->image()?>" class="card-img fit-cover h-100" alt="Product Image">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?=$product->name()?></h5>
                        <p class="card-text"><?=$product->description()?></p>
                        <div class="d-flex gap-4">
                            <p class="card-text m-0"><small class="text-muted"><?php echo number_format($product->price(), 2, ',', ' ');?>€</small></p>
                            <a href="<?=ROOT?>/products?id=<?= $product->id()?>" class="btn btn-primary h-100 stretched-link">Voir le produit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</div>