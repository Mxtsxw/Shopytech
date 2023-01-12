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
          <select name="statusCommand">
              <option value=<?=$order->status()?>><?php if ($order->status()==2){echo '<p class="text-warning">En cours de validation</p>';}
        elseif($order->status()==10){echo '<p class="text-success">Validée</p>';}
        elseif($order->status()==127){echo '<p class="text-danger">refusée</p>';}
        elseif($order->status()==3){echo '<p class="text-warning">paiement paypal</p>';}?></option>
              <?php if ($order->status()!=10){echo '<option value=10>Validée</option>';}?>
              <?php if ($order->status()!=2){echo '<option value=2>En cours</option>';}?>
              <?php if ($order->status()!=3){echo '<option value=3>Paiment paypal</option>';}?>
              <?php if ($order->status()!=127){echo '<option value=127>Refusée</option>';}?>
          </select>
          <?php if (isset($_SESSION['erreur-modif-status-order'])){echo '<p class="text-danger">'.$_SESSION['erreur-modif-status-order'].'</p>';}?>
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
