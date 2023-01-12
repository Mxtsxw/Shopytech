<?php $this->_t = 'Shopytech - COMMAND'; ?>


<h1>Page des Commandes</h1>
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
    <?php foreach ($orders as $order):?>
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
        <td><?php if ($order->status()==2){echo '<p class="text-warning">En cours de validation</p>';}
        elseif($order->status()==10){echo '<p class="text-success">Validée</p>';}
        elseif($order->status()==127){echo '<p class="text-danger">refusée</p>';}
        elseif($order->status()==3){echo '<p class="text-warning">paiement paypal</p>';}?>
        </td>
        <td>
            <a href="<?=ROOT?>/pagecommande?id=<?= $order->id()?>" class="btn btn-sm btn-primary btn-rounded"> EDIT</a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>