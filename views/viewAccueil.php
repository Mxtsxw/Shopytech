<?php $this->_t = 'Shopytech - Accueil'; ?>

<div class="row row-cols-1 row-cols-md-3 g-4">

    <?php foreach($articles as $article) : ?>
    <div class="col">
        <div class="card h-100" style="">
            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="./static/img/<?= $article->image()?>" class="img-fluid"/>
                <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= $article->name()?></h5>
                <p class="card-text"><?= $article->description()?></p>
                <p class="card-text"><?php echo number_format($article->price(), 2, ',', ' ');?>€</p>
                <a href="#" class="btn btn-primary">Acheter</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

</div>