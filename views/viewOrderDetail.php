<div class="row">
  <div class="col-md-8 mb-4">
    <div class="card mb-4">
      <div class="card-header py-3">
        <h5 class="mb-0">Détail de la commande</h5>
      </div>
      <div class="card-body">
      <form class="row g-3 needs-validation" novalidate>
        <div class="col-md-6">
          <label for="validationCustom01" class="form-label">Prénom</label>
          <input type="text" class="form-control" id="validationCustom01" value="" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
        <div class="col-md-6">
          <label for="validationCustom02" class="form-label">Nom</label>
          <input type="text" class="form-control" id="validationCustom02" value="" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>

        <div class="col-md-12">
          <label for="validationCustom01" class="form-label">Email</label>
          <input type="email" class="form-control" id="validationCustom01" value="" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
        
        <div class="col-md-6">
          <label for="validationCustom03" class="form-label">Ville</label>
          <input type="text" class="form-control" id="validationCustom03" required>
          <div class="invalid-feedback">
            Please provide a valid city.
          </div>
        </div>
        <div class="col-md-3">
          <label for="validationCustom04" class="form-label">Région</label>
          <select class="form-select" id="validationCustom04" required>
            <option selected disabled value="">Choose...</option>
            <option>...</option>
          </select>
          <div class="invalid-feedback">
            Please select a valid state.
          </div>
        </div>
        <div class="col-md-3">
          <label for="validationCustom05" class="form-label">Code postal</label>
          <input type="text" class="form-control" id="validationCustom05" required>
          <div class="invalid-feedback">
            Please provide a valid zip.
          </div>
        </div>
        <div class="col-12">
    </div>
    
          <hr class="my-4">
    
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="same-address" wfd-id="id8" checked>
            <label class="form-check-label" for="same-address">Utiliser l'adresse de livraison pour la facture</label>
          </div>
          
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="save-info" wfd-id="id9">
            <label class="form-check-label" for="save-info">Créer un compte</label>
          </div>
          
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
            <label class="form-check-label" for="invalidCheck">
              Accepter les conditions générales
            </label>
            <div class="invalid-feedback">
              You must agree before submitting.
            </div>
          </div>

          <button class="w-100 btn btn-primary btn-lg" type="submit">Procéder au paiement</button>
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


<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>