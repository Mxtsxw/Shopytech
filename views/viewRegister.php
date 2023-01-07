
<?php $this->_t = 'Shopytech - Inscription'; ?>

<!-- --- --- --- -- -->


<div class="mt-5 shadow row w-75 m-auto">
  
  <!-- Illustration -->
  <div class="col-sm-6 px-0 d-none d-sm-block">
    <img src="<?=ROOT?>/static/img/bouleDeNeigeCoco.jpg" alt="coco" class=" w-100 h-100 fit-cover">
  </div>

  <!-- Formulaire de connexion -->
  <div class="custom-form col-sm-6 col-12 p-5">
    <form action="<?=ROOT?>/handlers/registerHandler.php" method="POST" class="p-3">
      <h2 class="text-center">Inscription</h2>
      <div class="form-group mt-2">
        <input type="text" class="form-control" id="username" name="username" placeholder="Nom d'utilisteur" required>
      </div>
      <div class="form-group mt-2">
        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
      </div>

      <!-- Submit button -->
      <button type="submit" class="btn btn-primary btn-block mt-4" id="submit">Créer un compte</button>
      
      <p class="text-center mt-3">Vous avez déjà un compte ?
        <a href="<?=ROOT?>/login" class="link-info">cliquez ici</a>
      </p>
    </form>
  </div>
</div>
