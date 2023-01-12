<?php $this->_t = 'Shopytech Dashboard - Commandes'; ?>


<div class="mt-3 mb-5 text-center bg-light p-4">
  <h1 class="mb-3">Tableau de bord</h1>
  <h4 class="mb-3">Liste des commandes</h4>
  <div class="d-flex gap-3 justify-content-center">
    <a class="btn btn-primary" href="<?=ROOT?>/dashboard/orders" role="button">Commandes</a>
    <a class="btn btn-primary" href="<?=ROOT?>/dashboard/products" role="button">Stock des produits</a>
  </div>
</div>
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
    <?php foreach ($orders as $order):?>
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
        <td>
            <?php if ($order->status()==2): ?>
            <p class="text-warning">En attente de réception</p>
            <?php elseif($order->status()==10): ?>
            <p class="text-success">Validée</p>
            <?php elseif($order->status()==3): ?>
            <p class="text-warning">Paiement Paypal</p>
            <?php elseif($order->status()==-1): ?>
            <p class="text-danger">Refusée</p>
            <?php endif; ?>
        </td>
        <td>
            <a href="<?=ROOT?>/dashboard/orders/update?id=<?= $order->id()?>" class="btn btn-sm btn-primary btn-rounded">MODIFIER</a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>