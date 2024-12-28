<?php
  session_start();
  include 'includes/header.php';
?>

<!-- section starts -->
<section class="hero-section space bg-white">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 d-flex align-items-center">
        <div class="hero-left__wrapper pe-5">
          <h1 class="hero-title">Find, book and rent a car Easily</h1>
          <p>Get a car wherever and whenever you need it with your IOS and Android device.</p>
          <a href="cars/cars.php" class="btn btn-primary mt-2">
            Book Now
          </a>
        </div>
      </div>
      <div class="col-md-7">
        <div class="hero-right__wrapper text-end">
          <img class="img-fluid" src="./assets/images/car-hero.png" alt="Hero Banner">
        </div>
      </div>
    </div>
    <div class="row justify-content-center pt-5">
      <div class="col-md-8">
        <form class="row g-3 justify-content-center p-2 filter-form">
          <div class="col-md-5">
            <label for="staticLocation" class="form-label">Location</label>
            <input type="text" class="form-control" id="staticLocation" placeholder="Enter a location...">
          </div>
          <div class="col-md-5">
            <label for="inputpickupDate" class="form-label">Pickup Date</label>
            <input type="date" class="form-control" id="inputpickupDate">
          </div>
          <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary px-4">Search</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<section class="how-it-works space bg-inverse">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="section--title text-center mb-5">
          <span class="section-subtitle">How it works</span>
          <h2 class="section-title">Rent with following 3 working steps</h2>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-3">
        <div class="card p-3 text-center">
          <img src="assets/images/choose-location.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Choose location</h5>
            <p class="card-text">Choose your and find your best car</p>
            <a href="cars/cars.php" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3 text-center">
          <img src="assets/images/choose-date.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Pick-up date</h5>
            <p class="card-text">Select your pick up date and time to book your car</p>
            <a href="cars/cars.php" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3 text-center">
          <img src="assets/images/book-car.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Book your car</h5>
            <p class="card-text">Book your car and we will deliver it directly to you</p>
            <a href="cars/cars.php" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
