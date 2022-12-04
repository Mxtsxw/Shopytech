<?php
$this->_t = 'Shopytech - Accueil';
foreach($articles as $article) : ?>
<h2><?= $article->name()?></h2>
<?php endforeach; ?>