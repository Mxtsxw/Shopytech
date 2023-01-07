<ul class="list-unstyled">
            <?php
              if(isset($_SESSION["username"])){
              $username = $_GET['username'];
              echo '<li><h1>Connexion Réussie</h1></li>' ;
              echo '<li><p>Bienvenue, '.$username.'</p></li>';}
              else{ 
                echo '<li><h1>Erreur</h1></li>';
                echo "<p style='color:red'>oups, une erreur s'est produite</p>";
                echo "<li><p>Pour réessayer <a href=\"./login\" class=\"link-info\">cliquez ici</a></p></li>";
              }
            ?>
            </ul>