<?php $this->_t = 'Shopytech - Confirmation'; ?>

<div class="container my-4">
  
<div class="row">
  <?php if(isset($_SESSION['update_message'])): ?>
    <div class="alert alert-success mt-4 text-center" role="alert"><?=$_SESSION['update_message']?></div>
    <?php unset($_SESSION['update_message']); ?>
  <?php endif; ?>

  <div class="col-md-8 mb-4">
    <div class="card mb-4">
        <div class="card-header py-3">
            <h5 class="mb-0">Méthodes de paiement</h5>
        </div>
        <div class="card-body">
            <form action="<?=ROOT?>/handlers/paymentMethodHandler.php" method="POST" class="row">
                <input type="hidden" name="total" value="<?= $total ?>" >
                <div class="col-12">
                    <label>
                        <input type="radio" name="method" value="cheque" checked class="card-input-element" />

                        <div class="card card-default card-input" style="min-height:80px;">
                            <div class="card-body">
                                <div class="row align-items-center">
                                <i class="fas fa-money-check-alt fa-2x col-2"></i>
                                    <span class="col-10">Chèque</span>
                                </div>
                            </div>
                        </div>

                    </label>
                </div>
                <div class="col-12">
                    <label>
                        <input type="radio" name="method" value="paypal" class="card-input-element" />

                        <div class="card card-default card-input" style="min-height:80px;">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <img src="https://www.paypalobjects.com/digitalassets/c/website/logo/full-text/pp_fc_hl.svg" alt="Paypal" class="col-2 h-100">
                                    <span class="col-10">Paypal</span>
                                </div>
                            </div>
                        </div>

                    </label>
                </div>

                <hr class="my-4">

                <button class="w-100 btn btn-primary btn-lg" type="submit" name="paymentMethod">Confirmer la commande</button>

                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?=$_SESSION['error_message']?>
                    </div>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>
            </form>
        </div>
    </div>
  </div>

  <!-- ---------------------- -->

  <div class="col-md-4 mb-4">
    <a href="<?= ROOT?>/cart" class="text-end">Retourner en arrière</a>
    <div class="card mb-4">
      <div class="card-header py-3">
        <h5 class="mb-0">Résumé</h5>
      </div>
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
            Produits
            <span><?=number_format($total, 2, ',', ' ')?>€</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center px-0">
            Livraison
            <span>Gratuit</span>
          </li>

          <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
            <div>
              <strong>Prix Total</strong>
              <strong>
                <p class="mb-0">(TVA incluse)</p>
              </strong>
            </div>
            <span><strong><?=number_format($totalTVA, 2, ',', ' ')?>€</strong></span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- ------------ -->

</div>