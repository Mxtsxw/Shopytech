<?php $this->_t = 'Shopytech Dashboard'; ?>


<h1>Page des stocks disponibles</h1>
<table class="table align-middle mb-0 bg-white">
    <thead class="bg-light">
        <tr>
        <th>Produits</th>
        <th>Quantité</th>
        <th>Etat</th>
        <th>ID</th>
        <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product):?>
    <tr>
      <td>
        <div class="d-flex align-items-center">
          <img
              src="<?= ROOT ?>/static/img/<?= $product->image()?>"
              alt="<?= $product->name()?>"
              style="width: 45px; height: 45px"
              class="rounded-circle"
              />
          <div class="ms-3">
            <p class="fw-bold mb-1"><?php echo $product->name() ;?></p>
            <p class="text-muted mb-0 text-wrap-dot"><?php echo $product->description();?></p>
          </div>
        </div>
      </td>
      <td>
        <p class="fw-normal mb-1"><?= $product->quantity()?></p>

      </td>
      <td>
        <?php 
        if ($product->quantity()==0){echo '<p class="text-danger mb-0">Plus de stocks</p>';}
        elseif ($product->quantity()<3){echo '<p class="text-danger mb-0">stocks faibles</p>';}
        else{echo '<p class="text-success mb-0">OK</p>';}
        ?>
      </td>
      <td><?=$product->id()?></td>
      <td>
        <a href="<?=ROOT?>/pageadmin?id=<?= $product->id()?>" type="button" class="btn btn-sm btn-primary btn-rounded">EDIT</a>

      </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>