<?php
$this->_t = 'Biscuicui';
foreach($products as $article) : ?>
<h2><?= $article->title()?></h2>
<time><?= $article->date() ?> </time>
<?php endforeach; ?>