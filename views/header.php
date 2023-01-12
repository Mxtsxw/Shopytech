<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>
      <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse justify-content-center text-center" id="navbarSupportedContent">
      <!-- Left links -->
      <ul class="navbar-nav mb-2 mb-lg-0 gap-3">
      <li class="nav-item">
          <a class="nav-link <?= $activeTab=="Accueil" ? "active" : "" ?>" href="<?= ROOT?>/">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=ROOT?>/catalog">Catalogue</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#footer">Contact</a>
        </li>
      </ul>
      <!-- Left links -->
    </div> 
    <!-- Collapsible wrapper -->

    <!-- Right elements -->
    <div class="d-flex align-items-center">
      <!-- Icon -->
      <a class="link-secondary me-3" href="<?= ROOT ?>/cart">
        <i class="fas fa-shopping-cart icon-link"></i>
      <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <span class="badge rounded-pill badge-notification bg-danger"><?= count($_SESSION['cart']) ?></span>
      <?php endif; ?>
      </a>

      <!-- User -->
      <?php if (isset($_SESSION['username'])) : ?>
      <div class="dropdown">
        <a
          class="link-secondary me-3 dropdown-toggle hidden-arrow"
          href="#"
          id="navbarDropdownMenuLink"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
          <i class="fas fa-user-alt icon-link"></i>
          <?= $_SESSION["username"] ?? NULL; ?>
        </a>
          <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdownMenuLink"
        >
          
            <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
              <li>
                <a class="dropdown-item" href="<?=ROOT?>/command">Commandes</a>
              </li>
              <li>
                  <a class="dropdown-item" href="<?=ROOT?>/admin">Stocks</a>
              </li>
            <?php else : ?>
              <li>
                <a class="dropdown-item" href="<?=ROOT?>/profile">Profile</a>
              </li>
            <?php endif; ?>
          <li>
            <a class="dropdown-item" href="<?= ROOT ?>/handlers/logout.php">Déconnexion</a>
          </li>
        </ul>
      </div>
      <?php else : ?>
        <div class="dropdown">
        <a
          class="link-secondary me-3 hidden-arrow"
          href="<?=ROOT?>/login"
          role="button"
          aria-expanded="false"
        >
          <i class="fas fa-user-alt icon-link"></i>
        </a>
      </div>
      <?php endif; ?>
    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->