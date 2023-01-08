<div class="row">
   <?php if (isset($_SESSION['loginObject'])){
    echo '<div class="card mb-4">';
    echo '<div class="card-header py-3">';
    echo '<h5 class="mb-0">Information du compte</h5></div><div class="card-body">';
    echo '<ul class="list-inline">
    <li class="list-inline-item"><p>Vous allez procédez au paiement avec le compte </p></li>
    <li class="list-inline-item"><h6>'.unserialize($_SESSION['loginObject'])->username()."</h6></li></ul>"
    ;}?>
  <?php if (isset($_SESSION['compte_cree'])){if ($_SESSION['compte_cree']){echo "<p>Puisque votre compte viens d'être créé, voici votre mot de passe : </p>"; }}?>
  <?php if (isset($_SESSION['compte_cree'])){if ($_SESSION['compte_cree']){echo "<h5 class=text-danger>".unserialize($_SESSION['loginObject'])->password()."</h5>"; }}?>
  <?php if (isset($_SESSION['compte_cree'])){if ($_SESSION['compte_cree']){echo "<p>il est recommandé de changer ce dernier</p>";
  $_SESSION['compte_cree']=NULL; //on viens de créé le compte et d'afficher le mot de passe, on reset la valeur
  }}?>
  <?php if (isset($_SESSION['loginObject'])){
    echo '</div>';
    echo'</div>';
  }?>

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
            <span><strong><?=number_format($total, 2, ',', ' ')?>€</strong></span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- ------------ -->
