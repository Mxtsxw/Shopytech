<?php $this->_t = 'Shopytech - Accueil'; ?>

<div class="row row-cols-1 row-cols-md-3 g-4">

    <?php foreach($articles as $article) : ?>
    <div class="col">
        <div class="card h-100">
            <img src="./static/img/<?= $article->image()?>" class="card-img-top" alt="Fissure in Sandstone"/>
            <div class="card-body">
                <h5 class="card-title"><?= $article->name()?></h5>
                <p class="card-text"><?= $article->description()?></p>
                <a href="#" class="btn btn-primary">Acheter</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

</div>