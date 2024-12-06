<style>
body {
        text-shadow: 0 0.05rem 0.1rem rgba(0, 0, 0, 0.5);
    
    }
.hero-section {
            height: 500px; /* Adjust height as needed */
            background-image: url('../Images/index_background_img.jpg'); /* Adjust path to your image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

.btn-primary {
            background-color: #0078D7;
            border: none;
            font-weight: bold;
            text-transform: uppercase;
            padding: 10px 20px;
        }

</style>
<?php include('boilerplate.php'); ?>
<?php include('nav.php'); ?>
<div class="main-content">
    <!-- Carousel Section -->
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
                <div class="hero-section d-flex flex-column justify-content-start align-items-center text-center text-white">
                    <div class="container mt-5">
                        <h1 class="display-3 fw-bold text-shadow">SEARCH ALL OF OUR CARS</h1>
                        <p class="lead text-shadow">Find your next car and book a test drive online.</p>
                        <a href="../car/index.php?action=list_categories" class="btn btn-primary btn-lg mt-3">SHOP ALL</a>
                    </div>
                </div>
            </div>
        <div class="carousel-item" data-bs-interval="2000">
            <div class="hero-section d-flex flex-column justify-content-start align-items-center text-center text-white">
                <div class="container mt-5">
                    <h1 class="display-3 fw-bold text-shadow">Build Your Custom Car</h1>
                    <a href="#" class="btn btn-primary btn-lg mt-3">Start</a>
                </div>
            </div>
        </div>

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

    <!-- Browse Models Section -->
<div class="bg-body-secondary">
<div class="container text-center text-dark ">
    <h2>Browse By Models</h2>
  <div class="row align-items-center">
    
        <div class="col">
            <div class="model">
            <a href="#">
            <!-- <img src="car_1.jpg" style="max-width: 100px; height: auto;" alt="Cars Icon" class="img-fluid"> -->
            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-emoji-heart-eyes" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M11.315 10.014a.5.5 0 0 1 .548.736A4.498 4.498 0 0 1 7.965 13a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .548-.736h.005l.017.005.067.015.252.055c.215.046.515.108.857.169.693.124 1.522.242 2.152.242.63 0 1.46-.118 2.152-.242a26.58 26.58 0 0 0 1.109-.224l.067-.015.017-.004.005-.002zM4.756 4.566c.763-1.424 4.02-.12.952 3.434-4.496-1.596-2.35-4.298-.952-3.434zm6.488 0c1.398-.864 3.544 1.838-.952 3.434-3.067-3.554.19-4.858.952-3.434z"/></svg>           -->
            <img src="../Images/body-all-blue.svg" style="max-width: 120px; height: auto;" alt="Cars Icon" class="img-fluid">
                 <h4>All</h4>

            </a>
            </div>
        </div>
        <div class="col">
            <div class="model">
            <a href="../car/index.php?action=list_models&category_id=Sedan">
            <img src="../Images/body-car-blue.svg" style="max-width: 120px; height: auto;" alt="Cars Icon" class="img-fluid">
                    <h4>Cars</h4>

            </a>
            
            </div>
        </div>
        <div class="col">
            <div class="model">
            <a href="../car/index.php?action=list_models&category_id=SUV">
            <img src="../Images/body-suv-blue.svg" style="max-width: 120px; height: auto;" alt="Cars Icon" class="img-fluid">
              
                <h4>SUVS</h4>

            </a>
            </div>
        </div>
        <div class="col"> 
            <div class="model">
            <a href="../car/index.php?action=list_models&category_id=Electric">
            <img src="../Images/body-electrified-blue.svg" style="max-width: 120px; height: auto;" alt="Cars Icon" class="img-fluid">
          
                <h4>Electrified</h4>

            </a>
            </div>
        </div>
        <div class="col">
            <div class="model">
            <a href="#">
            <img src="../Images/body-truck-blue.svg" style="max-width: 120px; height: auto;" alt="Cars Icon" class="img-fluid">
                     <h4>Trucks</h4>

            </a>
            </div>
        </div>
        <div class="col">
            <div class="model">
            <a href="#">
            <img src="../Images/body-van-blue.svg" style="max-width: 120px; height: auto;" alt="Cars Icon" class="img-fluid">
                    <h4>Vans</h4>

            </a>
            
            </div>
        </div>
     </div>
    </div>
</div>

</div>
</div>

<?php include 'footer.php'; ?>

