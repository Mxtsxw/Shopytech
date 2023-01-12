<?php $this->_t = 'Shopytech Dashboard - ' . $product->name(); ?>


<h1>Page des stocks du produit <?=$product->name()?></h1>
<table class="table align-middle mb-0 bg-white">
    <thead class="bg-light">
        <tr>
          <th>ID</th>
          <th>Produits</th>
          <th class="text-center">État</th>
          <th class="text-center">Quantité</th>
          <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
    <tr>
    <td><?=$product->id()?></td>

      <td>
        <div class="d-flex align-items-center">
        
        <img
              src="<?= ROOT ?>/static/img/<?= $product->image()?>"
              alt="<?= $product->name()?>"
              style="width: 45px; height: 45px"
              class="rounded-circle"
              />
          <div class="ms-3">
            <p><?php echo $product->name() ;?></p>
            <p class="text-muted mb-0 text-wrap-dot"><?php echo $product->description();?></p>
          </div>
        </div>
      </td>
      <td class="text-center">
        <?php if ($product->quantity()==0): ?>
        <p class="text-danger mb-0">Plus de stocks</p>
        <?php elseif ($product->quantity()<3): ?>
        <p class="text-warning mb-0">stocks faibles</p>
        <?php else: ?>
        <p class="text-success mb-0">OK</p>
        <?php endif; ?>
      </td>
    
      
      <form action="<?=ROOT?>/handlers/AdminProductsHandler.php" method="POST" class="needs-validation" novalidate>
      <td class="text-center">
        <div class="form-group">
          <input type="hidden" name="idProduct" class="form-control" value="<?= $product->id()?>" required/>
        </div>

        <div class="form-group">
          <input type="number" min=0 name="quantityProduct" class="form-control" value="<?= $product->quantity()?>" required/>
          <!-- Message d'erreur  -->
          <?php if (isset($_SESSION['error_message'])): ?>
            <p class='text-danger mt-3'><?= $_SESSION['error_message'] ?></p>
            <?php unset($_SESSION['error_message']); ?>
          <?php endif; ?>
        </div>
      </td>
      <td>
        <div class="text-end mt-3">
          <button type="submit" name="updateQuantity" class="btn btn-sm btn-primary btn-rounded">Confirmer la modification</button>
        </div>
      </td>
      </form>      
    </tr>
    </tbody>
</table>
