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
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
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
      <div class="dropdown">
        <a
          class="link-secondary me-3 dropdown-toggle hidden-arrow"
          href="./Logins"
          id="navbarDropdownMenuLink"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
          <i class="fas fa-user-alt icon-link"></i>
          <?= $_SESSION["username"] ?? NULL ?>
        </a>
        <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdownMenuLink"
        >
          <li>
            <a class="dropdown-item" href="#">Tous nos produits</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Biscuits</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Fruits secs</a>
          </li>
        </ul>
      </div>
      <!-- Avatar -->
      <div class="dropdown">
        <a
          class="dropdown-toggle d-flex align-items-center hidden-arrow"
          href="#"
          id="navbarDropdownMenuAvatar"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
        </a>
        <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdownMenuAvatar"
        >
          <li>
            <a class="dropdown-item" href="#">My profile</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Settings</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Logout</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->