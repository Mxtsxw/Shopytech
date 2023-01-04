
<?php $this->_t = 'Shopytech - Login'; ?>

<!-- -------------------------------------------------------------------------- -->

<?php if (!(isset($varCo))): ?>
  <!--initialisation du cas (connexion ou inscription)-->  
  <?php $varCo=0 ?>
<?php endif?>
<?php if (isset($_GET["varCo"])): ?>
  <?php $varCo=$_GET["varCo"] ?>
<?php endif?>

<!-- -------------------------------------------------------------------------- -->


<div class="mt-5 shadow row w-75 m-auto">
  
  <!-- Illustration -->
  <div class="col-sm-6 px-0 d-none d-sm-block">
    <img src="<?=ROOT?>/static/img/bouleDeNeigeCoco.jpg" alt="coco" class=" w-100 h-100 fit-cover">
  </div>

  <!-- Formulaire de connexion -->
  <div class="custom-form col-sm-6 col-12 p-5">
    <form action="responseLogin.php" method="POST" class="p-3">
      <h2 class="text-center"> Connexion</h2>
      <div class="form-group mt-2">
        <input type="text" class="form-control" id="username" name="username" placeholder="Nom d'utilisteur" required>
      </div>
      <div class="form-group mt-2">
        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
      </div>

      <!-- Hidden inputs -->
      <input type="hidden" name="varCo" value="<?php $varCo?>">

      <!-- Submit button -->
      <button type="submit" class="btn btn-primary btn-block mt-4" id="submit">Connexion</button>
      
      <?php // Gestion des erreurs
        if(isset($_GET['erreur'])){
          $err = $_GET['erreur'];
          echo '<input type="hidden" name="erreur" value="'. $err . '">';
          if($err==1 || $err==2)
            echo "<p class='text-danger mt-3'>Utilisateur ou mot de passe incorrect</p>";
        }
      ?>
      <p class="text-center mt-3">Vous n'avez pas de compte? <a href="<?=ROOT?>/logins?varCo=<?php echo (1)?>" class="link-info">cliquez ici</a></p>
    </form>
  </div>
</div>