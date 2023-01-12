<?php $this->_t = 'Shopytech - Créer un compte'; ?>

<div class="container my-4">
  
<form action="<?=ROOT?>/handlers/RegisterHandler.php" method="POST" class="m-auto mt-4 card p-5" style="width:25rem;">
    <div>
        <h1 class="text-center my-4 h2">
        Inscription
        </h1>
        <p class="text-center" >Veuillez entrer un nom d'utilisateur et un mot de passe</p>
    </div>
  <div class="form-outline mb-4">
    <input type="text" id="username-input" name="username" class="form-control" pattern="^[^<>%$]*$" required/>
    <label class="form-label" for="username-input">Nom d'utilisateur</label>
  </div>

  <div class="form-outline mb-4">
    <input type="password" id="password-input" name="password" class="form-control" pattern="^[^<>%$]*$" required/>
    <label class="form-label" for="password-input">Mot de passe</label>
  </div>

  <div class="form-outline mb-4">
    <input type="password" id="password-confirm-input" name="passwordConfirm" class="form-control" pattern="^[^<>%$]*$" required/>
    <label class="form-label" for="password-confirm-input">Confirmer mot de passe</label>
  </div>

  <?php if (isset($_SESSION['error_message'])): ?>
    <p class='text-danger mt-3'><?=$_SESSION['error_message']?></p>
    <?php unset($_SESSION['error_message']); ?>
  <?php endif; ?>
  <button type="submit" name="create-account-on-order" class="btn btn-primary">Valider</button>

</form>
</div>