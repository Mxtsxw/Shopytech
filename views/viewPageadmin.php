<?php $this->_t = 'Shopytech - PageStocks' . $product->id(); ?>


<h1>Page des stocks du produit <?=$product->name()?></h1>
<table class="table align-middle mb-0 bg-white">
    <thead class="bg-light">
        <tr>
        <th>Produits</th>
        <th>Etat</th>
        <th>ID</th>
        <th>Quantité</th>
        <th>Actions</th>
        </tr>
    </thead>
    <tbody>
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
            <p><?php echo $product->name() ;?></p>
            <p class="text-muted mb-0 text-wrap-dot"><?php echo $product->description();?></p>
          </div>
        </div>
      </td>
      <td><?php 
        if ($product->quantity()==0){echo '<p class="text-danger mb-0">Plus de stocks</p>';}
        elseif ($product->quantity()<3){echo '<p class="text-danger mb-0">stocks faibles</p>';}
        else{echo '<p class="text-success mb-0">OK</p>';}
        ?>
      </td>
      <td><?=$product->id()?></td>
    
      
      <form action="<?=ROOT?>/handlers/adminHandler.php" method="POST" class="needs-validation" novalidate>
      <td>
        <div class="form-group">
          <input type="hidden" name="idProduct" class="form-control" value="<?= $product->id()?>" required/>
        </div>

        <div class="form-group">
          <input type="text" name="quantity" class="form-control" value="<?= $product->quantity()?>" required/>
          <?php if (isset($_SESSION['qprod-error'])){echo '<p class="text-danger">'.$_SESSION['qprod-error'].'</p>';}?>
        </div>
      </td>
      <td>
        <div class="text-end mt-3">
          <button type="submit" name="updateProfile" class="btn btn-sm btn-primary btn-rounded">Confirmer la modification</button>
        </div>
      </td>
      </form>      
    </tr>
    </tbody>
</table>
