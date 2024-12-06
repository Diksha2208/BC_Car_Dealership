<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="../Views/index.php">
            <span class="logo-primary" style="color: #0078D7; font-weight: bold;">BC &nbsp</span>
            <span class="logo-secondary" style="color: #333; font-weight: bold;">Car &nbsp</span>
            <span class="logo-group" style="color: #999; font-weight: bold;">Dealership</span>
        </a>

        <!-- Navbar Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                
                <li class="nav-item">
                    <a class="nav-link text-uppercase fw-bold" href="../car/index.php?action=list_categories">Shop Cars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase fw-bold" href="../car/index.php?action=view_build_car">Build Your Car</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase fw-bold" href="../User/Contact_us.php">Contact</a>
                </li>
            </ul>
        </div>
    <!-- Login Option -->
    <div class="d-flex align-items-center">
   
   <?php if (isset($_SESSION['user'])) : ?>
    <a href="../car/index.php?action=view_cart" class="nav-link text-dark fw-bold"><i class="bi bi-cart"></i> My Garage &nbsp</a>
    <a href="../car/index.php?action=view_past_orders" class="nav-link text-dark fw-bold"><i class="bi bi-basket"></i> Past Orders &nbsp</a>
    <a href="../User/logout.php" class="nav-link text-dark fw-bold"><i class="bi bi-person"></i> Logout</a>
    <?php else : ?>
    <a href="../User/login.php" class="nav-link text-dark fw-bold"><i class="bi bi-person"></i> Login</a>
    <?php endif; ?>



  </div>
        
    </div>

</nav>

