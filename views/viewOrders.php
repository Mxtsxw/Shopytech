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

    <div>
      <h1>Vos commandes</h1>
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
                <?= $order->date() ?>
              </button>
            </h2>
            <div id="order<?=$order->id()?>" class="accordion-collapse collapse" aria-labelledby="headingOrder<?=$order->id()?>" data-mdb-parent="#accordionExample">
              <div class="accordion-body">
                Commande en cours
              </div>
            </div>
          </div>
        </div>

      <?php endforeach; ?>
    

    <?php endif; ?>
  </div>
</div>