<?php $this->_t = 'Shopytech - Pagecommande'.$order->id();  ?>

<div class="container my-4">
  
<h1>Commande numéro <?=$order->id()?></h1>
<table class="table align-middle mb-0 bg-white">
    <thead class="bg-light">
        <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Date</th>
        <th class="text-center">ID Client</th>
        <th class="text-center">Mode de paiement</th>
        <th class="text-center">Total</th>
        <th class="text-center">Statut</th>
        <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr class="text-center">
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
        <form action="<?=ROOT?>/handlers/AdminOrdersHandler.php" method="POST" class="needs-validation" novalidate>
      <td>
        <div class="form-group">
          <input type="hidden" name="idOrder" class="form-control" value="<?= $order->id()?>" required/>
        </div>

        <div class="form-group">
        <?php if ($order->status()==2): ?>
            <p class="text-warning">En attente de réception</p>
            <?php elseif($order->status()==10): ?>
            <p class="text-success">Validée</p>
            <?php elseif($order->status()==3): ?>
            <p class="text-warning">Paiement Paypal</p>
            <?php elseif($order->status()==-1): ?>
            <p class="text-danger">Refusée</p>
            <?php endif; ?>
          <!-- Message d'erreur  -->
          <?php if (isset($_SESSION['error_message'])): ?>
            <p class='text-danger mt-3'><?= $_SESSION['error_message'] ?></p>
            <?php unset($_SESSION['error_message']); ?>
          <?php endif; ?>        
        </div>
      </td>
      <td>
        <div class="text-center mt-3">
          <button type="submit" name="RefuseOrderStatus" class="btn btn-sm btn-danger btn-rounded">Réfuser</button>
          <button type="submit" name="ValidOrderStatus" class="btn btn-sm btn-success btn-rounded">Valider</button>
        </div>
      </td>
      </form>   
    </tr>
    </tbody>
</table>

</div>