<?php $this->_t = 'Shopytech - '; ?>

<div class="d-flex gap-3">
    
<div class="w-25">
    <div class="card bg-light mb-3" style="max-width: 18rem;">
        <div class="card-header">Catégories</div>
        <ul class="list-group list-group-flush">
            <?php foreach($categories as $category) : ?>
                <li class="list-group-item"><a href="<?= ROOT ?>/catalog/<?= $category->name()?>"><?= $category->name()?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<div class="w-100">
    <?php foreach($products as $product) : ?>
        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-2">
                <img src="<?= ROOT ?>/static/img/<?= $product->image()?>" class="card-img fit-cover" alt="Product Image">
                </div>
                <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?=$product->name()?></h5>
                    <p class="card-text"><?=$product->description()?></p>
                    <p class="card-text"><small class="text-muted"><?php echo number_format($product->price(), 2, ',', ' ');?>€</small></p>
                </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</div>