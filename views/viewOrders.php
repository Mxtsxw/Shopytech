<?php $this->_t = 'Shopytech - Commandes'; ?>

<div class="container my-4">
  
<div class="row mt-4">
  <div class="col-md-4">
    <div class="card mt-5">
      <div class="card-body text-center">
        <i class="fas fa-user-alt fa-10x my-5"></i>
        <h4 class="card-title font-weight-bold mb-0"><?= $_SESSION['username'] ?></h4>
      </div>
    </div>
    <?php if(isset($_SESSION['update_message'])): ?>
      <p class="text-success mt-3 text-center"><?=$_SESSION['update_message']?></p>
      <?php unset($_SESSION['update_message']); ?>
    <?php endif; ?>

    <div class="mt-5">
    <div class="card" style="width: 18rem;">
      <div class="card-header">
        Comptes
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><a href="<?=ROOT?>/orders">Commandes</a></li>
          <li class="list-group-item"><a href="<?=ROOT?>/profile">Adresses</a></li>
          <li class="list-group-item"><a href="<?=ROOT?>/profile/pwd">Modifier le mot de passe</a></li>
        </ul>
    </div>
    </div>
  </div>
  <div class="col-md-8 mt-4">
    
    <?php if (!isset($orders) || empty($orders)) : ?>
      <div class="alert alert-info" role="alert">
        Vous n'avez aucune commande.
      </div>
    <?php else: ?>

    <div class="d-flex justify-content-between mb-3">
      <h1>Vos commandes</h1>
        <p class="lead">Commandes : <?= count($orders)?></p>
    </div>


    <!-- Accordion -->

      <?php foreach($orders as $order): ?>

        <div class="accordion" id="accordionExample">     
          <div class="accordion-item my-2">
            <h2 class="accordion-header" id="headingOrder<?=$order->id()?>">
              <button
                class="accordion-button collapsed"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#order<?=$order->id()?>"
                aria-expanded="false"
                aria-controls="order<?=$order->id()?>"
              >
                <div class="d-flex gap-5">
                  <p><?= date('d/m/Y', strtotime($order->date())) ?></p>
                  <p> • </p>
                  <?php if ($order->status()==2): ?>
                  <p class="text-warning">Chèque en attente de réception</p>
                  <?php elseif($order->status()==10): ?>
                  <p class="text-success">Validée</p>
                  <?php elseif($order->status()==3): ?>
                  <p class="text-warning">Paiement Paypal</p>
                  <?php elseif($order->status()==-1): ?>
                  <p class="text-danger">Refusée</p>
                  <?php endif; ?>
                </div>
              </button>
            </h2>
            <div id="order<?=$order->id()?>" class="accordion-collapse collapse" aria-labelledby="headingOrder<?=$order->id()?>" data-mdb-parent="#accordionExample">
              
            <div class="accordion-body">
                <?php 
                  $productsManager = new ProductsManager();
                  $orderItemsManager = new OrderItemsManager();
                  $orderItems = $orderItemsManager->getOrderItemsByOrderId($order->id());
                ?>
                <?php foreach ($orderItems as $orderItem) : ?>
                  <?php $product = $productsManager->getProductById($orderItem->productId()) ?>
                  <div class="d-flex justify-content-between">
                    <p><?= $product->name() ?></p>
                    <p><?= $orderItem->quantity() ?> x <?= $product->price() ?>€</p>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>

      <?php endforeach; ?>
    

    <?php endif; ?>
  </div>
</div>
</div>