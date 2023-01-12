<?php $this->_t = 'Shopytech - Modifier mot de passe'; ?>

<!-- create a row to hold the left side card and the main content -->
<div class="row">
  <!-- create the left side card to display the user icon and name -->
  <div class="col-md-4">
    <div class="card mt-5">
      <div class="card-body text-center">
        <!-- use an img element to display the user icon -->
        <i class="fas fa-user-alt fa-10x my-5"></i>
        <!-- display the user's name -->
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
          <li class="list-group-item"><a href="">Adresses</a></li>
          <li class="list-group-item"><a href="">Modifier le mot de passe</a></li>
        </ul>
    </div>
    </div>
  </div>
  <!-- create the main content section to display the customer information -->
  <div class="col-md-8">
    <div class="card mt-5">
      <div class="card-body">
        <h2 class="card-title text-center font-weight-bold mb-4 h4">Modifier votre mot de passe</h2>
        <form action="<?=ROOT?>/handlers/profileHandler.php" method="POST" class="needs-validation" novalidate>

        <div class="form-group">
            <label for="current-password-input">Mot de passe actuel</label>
            <input type="password" name="current-password" class="form-control" id="current-password-input" value="" pattern="^[^<>%$]*$" required/>
        </div>

        <div class="form-group">
            <label for="new-password-input">Nouveau mot de passe</label>
            <input type="password" name="new-password" class="form-control" id="new-password-input" value="" pattern="^[^<>%$]*$" required/>
        </div>

        <div class="form-group">
            <label for="password-confirm-input">Confirmer le mot de passe</label>
            <input type="password" name="password-confirm" class="form-control" id="password-confirm-input" value="" pattern="^[^<>%$]*$" required/>
        </div>

        <!-- Message d'erreur  -->
        <?php if (isset($_SESSION['error_message'])): ?>
            <p class='text-danger mt-3'><?=$_SESSION['error_message']?></p>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <div class="text-end mt-3">
            <button type="submit" name="updatePassword" class="btn btn-primary text-right">Modifier le mot de passe</button>
        </div>

        
        </form>
      </div>
    </div>
  </div>
</div>
