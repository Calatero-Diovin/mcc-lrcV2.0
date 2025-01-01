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
                            Madridejos Community College 2.0
                        </div>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-5 col-lg-4 ml-lg-0 text-center text-md-end">
                        <a href="https://www.facebook.com/MCCLRC" class="btn btn-outline-light btn-floating m-1" role="button"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.youtube.com/watch?v=bIzChSbj0OU" class="btn btn-outline-light btn-floating m-1" role="button"><i class="bi bi-youtube"></i></a>
                    </div>
                    <!-- Grid column -->
                </div>
            </section>
        </div>
        <!-- Grid container -->
    </footer>
</div>

<!-- Chatbox Icon -->
<div id="chat-icon" style="position: fixed; bottom: 20px; right: 20px; cursor: pointer;">
    <img src="assets/img/chat-icon.png" alt="Chat Icon" style="width: 60px; height: 60px;">
</div>

<!-- Chatbox Modal -->
<div id="chatbox-modal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chatbox</h5>
                <span id="user-email" class="ms-auto text-muted"></span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="login-section">
                    <button id="google-signin" class="btn btn-primary w-100">Sign in with Google</button>
                </div>
                <div id="chat-section" style="display: none;">
                    <p>Welcome to the chatbox!</p>
                    <!-- Add chat functionality here -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Open chatbox
document.getElementById('chat-icon').addEventListener('click', function () {
    const email = localStorage.getItem('userEmail');
    if (email) {
        document.getElementById('user-email').textContent = email;
        document.getElementById('login-section').style.display = 'none';
        document.getElementById('chat-section').style.display = 'block';
    } else {
        document.getElementById('login-section').style.display = 'block';
        document.getElementById('chat-section').style.display = 'none';
    }
    new bootstrap.Modal(document.getElementById('chatbox-modal')).show();
});

// Simulate Google Sign-In
document.getElementById('google-signin').addEventListener('click', function () {
    // Replace with actual Google API sign-in logic
    const simulatedEmail = prompt('Enter your email for Google Sign-In simulation:', 'user@example.com');
    if (simulatedEmail) {
        localStorage.setItem('userEmail', simulatedEmail);
        document.getElementById('user-email').textContent = simulatedEmail;
        document.getElementById('login-section').style.display = 'none';
        document.getElementById('chat-section').style.display = 'block';
    }
});
</script>

<?php 
include('includes/script.php');
include('message.php'); 
?>
