<div class="row">
  <div class="col-md-8 mb-4">
    <div class="card mb-4">
      <div class="card-header py-3">
        <h5 class="mb-0">Détail de la commande</h5>
    </div>
      <div class="card-body">
        
        <form class="row g-3 needs-validation" action="<?=ROOT?>/handlers/orderInformationHandler.php" method="POST" novalidate>

          <div class="col-md-6">
            <label for="input-firstname" class="form-label">Prénom</label>
            <input type="text" name="firstname" class="form-control" id="input-firstname" value="<?= isset($_SESSION['customerObject']) ? unserialize($_SESSION['customerObject'])->forename() : "" ?>" required>
          </div>

          <div class="col-md-6">
            <label for="input-lastname" class="form-label">Nom</label>
            <input type="text" name="lastname" class="form-control" id="input-lastname" value="<?= isset($_SESSION['customerObject']) ? unserialize($_SESSION['customerObject'])->surname() : "" ?>" required>
          </div>

          <div class="col-md-12">
            <label for="input-email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="input-email" value="<?= isset($_SESSION['customerObject']) ? unserialize($_SESSION['customerObject'])->email() : "" ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
            <div class="invalid-feedback">
              Email non valide
            </div>
          </div>

          <div class="col-md-12">
            <label for="input-add1" class="form-label">Adresse</label>
            <input type="text" name="add1" class="form-control" id="input-add1" value="<?= isset($_SESSION['customerObject']) ? unserialize($_SESSION['customerObject'])->add1() : "" ?>" required>
            <div class="invalid-feedback">
              Veuillez indiquer une adresse
            </div>
          </div>

          <div class="col-md-12">
            <label for="input-add2" class="form-label">Complément d'adresse <span class="muted">(facultatif)</span></label>
            <input type="text"name="add2" class="form-control" id="input-add2" value="<?= isset($_SESSION['customerObject']) ? unserialize($_SESSION['customerObject'])->add2() : "" ?>">
          </div>
          
          <div class="col-md-6">
            <label for="input-city" class="form-label">Ville</label>
            <input type="text" name="city" class="form-control" id="input-city" value="<?= isset($_SESSION['customerObject']) ? unserialize($_SESSION['customerObject'])->add3() : "" ?>" required>
          </div>
          
          <div class="col-md-3">
            <label for="input-zip" class="form-label">Code postal</label>
            <input type="text" name="zip" class="form-control" id="input-zip" value="<?= isset($_SESSION['customerObject']) ? unserialize($_SESSION['customerObject'])->postcode() : "" ?>" pattern="(?:0[1-9]|[13-8][0-9]|2[ab1-9]|9[0-5])(?:[0-9]{3})?|9[78][1-9](?:[0-9]{2})?" required>
          </div>

          <div class="col-md-3">
            <label for="input-phone" class="form-label">Téléphone</label>
            <input type="tel" name="phone" class="form-control" id="input-phone" value="<?= isset($_SESSION['customerObject']) ? unserialize($_SESSION['customerObject'])->phone() : "" ?>" pattern="^[0-9]{10}$" required>
          </div>
          
          <hr class="my-4">
    
          <div class="form-check">
            <input type="checkbox" name="same-adress" class="form-check-input" id="same-address" wfd-id="id8" checked>
            <label class="form-check-label" for="same-address">Utiliser l'adresse de livraison pour la facture</label>
          </div>


          <!-- <?php if (!(isset($_SESSION['username']))) : ?>
          <div class="form-check">
            <input type="checkbox" name="create-account" class="form-check-input" id="create-account" wfd-id="id9">
            <label class="form-check-label" for="create-account">Créer un compte</label>
          </div>
          <?php endif; ?> -->
          
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
            <label class="form-check-label" for="invalidCheck">
              Accepter les conditions générales
            </label>
          </div>

          <button class="w-100 btn btn-primary btn-lg" type="submit">Procéder au paiement</button>
          
          <!-- Message d'erreur -->
          <?php if(isset($_SESSION['error_message'])): ?>
            <p class="text-danger mt-3"><?=$_SESSION['error_message']?></p>
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