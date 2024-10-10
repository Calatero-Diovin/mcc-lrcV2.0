<?php
include('includes/header.php');
include('includes/navbar.php');
?>
<div class="jumbotron h-50" style="background-color: #0D4C92">
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000">
            <img src="assets/img/mccfront.jpg" class="d-block w-100 h-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="assets/img/slide2.jpg" class="d-block w-100 h-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="assets/img/slide3.jpg" class="d-block w-100 h-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


    <!-- Services -->
    <div class="container bg-white mt-3">
        <h3 class="fs-3"><a href="services.php" class="text-black text-decoration-none">Services</a></h3>
        <h4 class="text-center fs-2">MCCLRC OPENING DAY AND TIME</h4>
        <div class="row">
            <div class="col-md-6 p-5">
                <h4 class="fs-1">Monday - Saturdays:</h4>
                <h4 class="fs-3">8:00 AM 5:00 PM (No Noon Break)</h4>
            </div>
            <div class="col-md-6">
                <img src="assets/img/A.gif" class="img-fluid" alt="Responsive GIF">
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="jumbotron">
    <footer class="text-center text-lg-start text-white" style="background-color: #0D4C92">
        <!-- Grid container -->
        <div class="jumbotron p-4 pb-0">

            <hr class="my-3">

            <section class="p-3 pt-0">
                <div class="row d-flex align-items-center">
                    <!-- Grid column -->
                    <div class="col-md-7 col-lg-8 text-center text-md-start">
                        <div class="p-3">
                            Madridejos Community College 2.0 <span title="DIOVIN CALATERO">(Developer)</span>
                        </div>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-5 col-lg-4 ml-lg-0 text-center text-md-end">
                        <a href="https://www.facebook.com/madridejoscommunitycollege" class="btn btn-outline-light btn-floating m-1" role="button"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.youtube.com/watch?v=bIzChSbj0OU" class="btn btn-outline-light btn-floating m-1" role="button"><i class="bi bi-youtube"></i></a>
                    </div>
                    <!-- Grid column -->
                </div>
            </section>
        </div>
        <!-- Grid container -->
    </footer>
</div>
<!-- End of .container -->

<?php 
include('includes/script.php');
include('message.php'); 
?>
