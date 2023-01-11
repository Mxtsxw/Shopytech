<?php $this->_t = 'Shopytech - Pagecommande'.$order->id();  ?>

<h1>Commande numéro <?=$order->id()?></h1>
<table class="table align-middle mb-0 bg-white">
    <thead class="bg-light">
        <tr>
        <th>iD</th>
        <th>date</th>
        <th>customer_id</th>
        <th>payment_type</th>
        <th>total</th>
        <th>status</th>
        <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <td><p><?=$order->id()?></p>
        </td>
        <td><p> <?=$order->date()?></p>
        </td>
        <td><p><?=$order->customerId()?></p>
        </td>
        <td><?=$order->paymentType()?></td>
        </td>
        <td><p><?=$order->total()?></p>
        </td>
        <form action="<?=ROOT?>/handlers/commandHandler.php" method="POST" class="needs-validation" novalidate>
      <td>
        <div class="form-group">
          <input type="hidden" name="idOrder" class="form-control" value="<?= $order->id()?>" required/>
        </div>

        <div class="form-group">
          <input type="text" name="statusCommand" class="form-control" value="<?= $order->status()?>" required/>
          <?php if (isset($_SESSION['qprod-error'])){echo '<p class="text-danger">'.$_SESSION['qprod-error'].'</p>';}?>
        </div>
      </td>
      <td>
        <div class="text-end mt-3">
          <button type="submit" name="updateOrder" class="btn btn-sm btn-primary btn-rounded">Confirmer la modification</button>
        </div>
      </td>
      </form>   
    </tr>
    </tbody>
</table>
<br>
<br>
<h5>Informations sur les valeurs du status</h5>
<table class="table align-middle mb-0 bg-white">
  <thead class="bg-light">
    <tr>
      <th scope="col">Valeurs</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <tr><td><p>10</p></td><td><p class="text-success">Validée</p></td></tr>
    <tr><td><p>2</p></td><td><p class="text-warning">En cours de validation</p></td></tr>
    <tr><td><p>3</p></td><td><p class="text-warning">paiement paypal</p></td></tr>  
    <tr><td><p>404</p></td><td><p class="text-danger">refusée</p></td></tr> 
  </tbody>
</table>
