
<?php $this->_t = 'Shopytech - Login'; ?>

<?php if (!(isset($varCo))): ?>
  <!--initialisation du cas (connexion ou inscription)-->  
  <?php $varCo=0 ?>
<?php endif?>
<?php if (isset($_GET["varCo"])): ?>
  <?php $varCo=$_GET["varCo"] ?>
<?php endif?>
<div>
<section class="vh-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 text-black">
        <div class="px-5 ms-xl-4">
          <br>
          <br>
        </div>
        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

          <?php if ($varCo==0): ?>
            <!-- pour les connexions -->
            <form action="responseLogin.php" method="post" style="width: 23rem;">
            <h1>Connexion</h1>

            <div class="form-outline mb-4">
              <label><b>Nom d'utilisateur</b></label>
              <input type="text" class="form-control bg-secondary" placeholder="Identifiant" name="username" required>
            </div>

            <div class="form-outline mb-4">
            <label><b>Mot de passe</b></label>
            <input type="password" class="form-control bg-secondary" placeholder="Mot de passe" name="password" required>
            </div>

            <div class="pt-1 mb-4">
            <button class="btn btn-info btn-lg btn-block" type="submit" id="submit">Connexion</button>
            </div>

            <!-- pour envoyer l'information si connexion ou inscription -->
            <input type="hidden" name="varCo" value="<?php $varCo?>">

            <!-- gestion des erreurs -->
            <?php
              if(isset($_GET['erreur'])){
              $err = $_GET['erreur'];
              echo '<input type="hidden" name="erreur" value="'. $err . '">';
              if($err==1 || $err==2)
              echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
              }
            ?>

            <p>Vous n'avez pas de compte? <a href="<?=ROOT?>/logins?varCo=<?php echo (1)?>" class="link-info">cliquez ici</a></p>
          <?php elseif ($varCo=="burger"): ?>
            <!-- easter egg -->
            <ul>
              <li><h1>Burgers? nous ne vendons pas de burger ici monsieur!</h1></li>
              <li><img src="./static/img/burger.PNG" alt="Non-burger" style="object-fit: cover; object-position: left;"></li>
              <li><p>Vous ne voulez plus de burgers? <a href="<?=ROOT?>/logins?varCo=<?php echo (0)?>" class="link-info">cliquez ici</a></p></li>
            </ul>
          <?php else: ?>
            <!-- pour les inscriptions -->
            <form action="responseLogin.php" method="post" style="width: 23rem;">
            <h1>Inscription</h1>

            <div class="form-outline mb-4">
              <label><b>Nom d'utilisateur</b></label>
              <input type="text" class="form-control bg-secondary" placeholder="Identifiant" name="username" required>
            </div>

            <div class="form-outline mb-4">
            <label><b>Mot de passe</b></label>
            <input type="password" class="form-control bg-secondary" placeholder="Mot de passe" name="password" required>
            </div>

            <div class="pt-1 mb-4">
            <button class="btn btn-info btn-lg btn-block" type="submit" id="submit">Connexion</button>
            </div>

            <!-- pour envoyer l'information si connexion ou inscription -->
            <input type="hidden" name="varCo" value="<?php $varCo?>">

            <p>Vous possédez déjà un compte? <a href="<?=ROOT?>/logins?varCo=<?php echo (0)?>" class="link-info">cliquez ici</a></p>
            
          <?php endif ?>
          </form>

        </div>
      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
      <img src="./static/img/bouleDeNeigeCoco.jpg" alt="coco" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
      </div>
    </div>
  </div>
</section>
</div>