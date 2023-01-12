<?php $this->_t = 'Shopytech - Confirmation'; ?>

<div class="container my-4">
  
<!-- create a row to hold the left side card and the main content -->
<div class="row">
  <!-- create the left side card to display the user icon and name -->
  <div class="col-md-4">
    <div class="card mt-5">
      <div class="card-body text-center">
        <!-- use an img element to display the user icon -->
        <i class="fas fa-user-alt fa-10x my-5"></i>
        <!-- display the user's name -->
        <h4 class="card-title font-weight-bold mb-0"><?= $_SESSION['created_username'] ?></h4>
      </div>
    </div>
    <?php if(isset($_SESSION['update_message'])): ?>
      <p class="text-success mt-3 text-center"><?=$_SESSION['update_message']?></p>
      <?php unset($_SESSION['update_message']); ?>
    <?php endif; ?>
    
  </div>
  <!-- create the main content section to display the customer information -->
  <div class="col-md-8">
    <div class="card mt-5">
      <div class="card-body">
        <h2 class="card-title text-center font-weight-bold mb-4 h4">Informations</h2>
        <!-- use a form element to display the customer information -->
        <form action="<?=ROOT?>/handlers/profileHandler.php" method="POST" class="needs-validation" novalidate>
          <div class="form-group">
            <label for="firstname-input">Prénom</label>
            <input type="text" name="firstname" class="form-control" id="firstname-input" value="" required/>
          </div>

          <div class="form-group">
            <label for="lastname-input">Nom</label>
            <input type="text" name="lastname" class="form-control" id="lastname-input" value="" required/>
          </div>

          <div class="form-group">
            <label for="email-input">Email</label>
            <input type="email" name="email" class="form-control" id="email-input" value="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/>
            <div class="invalid-feedback">
              Email non valide
            </div>
          </div>

          <div class="form-group">
            <label for="phone-input">Phone</label>
            <input type="tel" name="phone" class="form-control" id="phone-input" value="" pattern="^[0-9]{10}$" required/>
          </div>

          <hr class="my-4">

          <h2 class="h4 text-center">Adresse</h2>
          <div class="form-group">
            <label for="add1-input">Adresse</label>
            <input type="text" name="add1" class="form-control" id="add1-input" value="" required/>
          </div>

          <div class="form-group">
            <label for="add2-input">Adresse complémentaire (optionnel)</label>
            <input type="text" name="add2" class="form-control" id="add2-input" value="" />
          </div>

          <div class="form-group">
            <label for="add3-input">Ville</label>
            <input type="text" name="add3" class="form-control" id="add3-input" value="" required/>
          </div>

          <div class="form-group">
            <label for="zip-input">Code postal</label>
            <input type="text" name="zip" class="form-control" id="zip-input" value="" pattern="(?:0[1-9]|[13-8][0-9]|2[ab1-9]|9[0-5])(?:[0-9]{3})?|9[78][1-9](?:[0-9]{2})?" required/>
          </div>

          <!-- Message d'erreur  -->
          <?php if (isset($_SESSION['error_message'])): ?>
            <p class='text-danger mt-3'>Utilisateur ou mot de passe incorrect</p>
            <?php unset($_SESSION['error_message']); ?>
          <?php endif; ?>

          <div class="text-end mt-3">
            <button type="submit" name="confirmCustomerInfo" class="btn btn-primary text-right">Confirmer les informations</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

</div>