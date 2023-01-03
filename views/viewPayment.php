<div class="row">
  <div class="col-md-8 mb-4">
    <div class="card mb-4">
      <div class="card-header py-3">
        <h5 class="mb-0">Détail de la commande</h5>
      </div>
      <div class="card-body">
      <form class="needs-validation" novalidate="">
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">Prénom</label>
              <input type="text" class="form-control" id="firstName" placeholder="" value="" required="" wfd-id="id1">
              <div class="invalid-feedback">
              Veuillez entrer un prénom valide.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Nom</label>
              <input type="text" class="form-control" id="lastName" placeholder="" value="" required="" wfd-id="id2">
              <div class="invalid-feedback">
                Veuillez entrer un nom valide.
              </div>
            </div>

            <div class="col-12">
              <label for="email" class="form-label">Email <span class="text-muted"></span></label>
              <input type="email" class="form-control" id="email" placeholder="you@example.com" wfd-id="id4">
              <div class="invalid-feedback">
                Veuillez entrer un email valide.
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">Addresse</label>
              <input type="text" class="form-control" id="address" placeholder="15 Bd André Latarjet" required="" wfd-id="id5">
              <div class="invalid-feedback">
                Veuillez indiquer une adresse de livraison.
              </div>
            </div>

            <div class="col-12">
              <label for="address2" class="form-label">Addresse 2 <span class="text-muted">(facultatif)</span></label>
              <input type="text" class="form-control" id="address2" placeholder="N° Appartement" wfd-id="id6">
            </div>

            <div class="col-md-4">
              <label for="state" class="form-label">Département</label>
              <input type="text" class="form-control" id="address2" placeholder="Département" wfd-id="id6">
              <div class="invalid-feedback">
                Veuillez indique le département.
              </div>
            </div>

            <div class="col-md-3">
              <label for="zip" class="form-label">Code postal</label>
              <input type="text" class="form-control" id="zip" placeholder="" required="" wfd-id="id7">
              <div class="invalid-feedback">
                Vueillez indiquer le code postal.
              </div>
            </div>
          </div>

          <hr class="my-4">

          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="same-address" wfd-id="id8">
            <label class="form-check-label" for="same-address">Utiliser l'adresse de livraison pour la facture</label>
          </div>

          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="save-info" wfd-id="id9">
            <label class="form-check-label" for="save-info">Créer un compte</label>
          </div>

          <hr class="my-4">

          <h4 class="mb-3">Paiement</h4>

          <div class="my-3">
            <div class="form-check">
              <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked="" required="" wfd-id="id10">
              <label class="form-check-label" for="credit">Credit card</label>
            </div>
            <div class="form-check">
              <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required="" wfd-id="id12">
              <label class="form-check-label" for="paypal">PayPal</label>
            </div>
          </div>

          <div class="row gy-3">
            <div class="col-md-6">
              <label for="cc-name" class="form-label">Nom de la carte</label>
              <input type="text" class="form-control" id="cc-name" placeholder="" required="" wfd-id="id13">
              <small class="text-muted">Nom complet</small>
              <div class="invalid-feedback">
                Veillez indiquer le nom de la carte
              </div>
            </div>

            <div class="col-md-6">
              <label for="cc-number" class="form-label">Numéro de carte</label>
              <input type="text" class="form-control" id="cc-number" placeholder="" required="" wfd-id="id14">
              <div class="invalid-feedback">
                Le numéro de carte est requis
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Date d'expiration</label>
              <input type="text" class="form-control" id="cc-expiration" placeholder="" required="" wfd-id="id15">
              <div class="invalid-feedback">
                Veuillez indiquer la date d'expiration
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-cvv" class="form-label">CVV</label>
              <input type="text" class="form-control" id="cc-cvv" placeholder="" required="" wfd-id="id16">
              <div class="invalid-feedback">
                Veuillez indiquer le code de sécurité
              </div>
            </div>
          </div>

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Procéder au paiement</button>
        </form>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-4">
  <a href="<?= ROOT?>/cart" class="text-end">Retourner en arrière</a>
    <div class="card mb-4">
      <div class="card-header py-3">
        <h5 class="mb-0">Summary</h5>
      </div>
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
            Produits
            <span>53.98€</span>
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
            <span><strong>53.98€</strong></span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>