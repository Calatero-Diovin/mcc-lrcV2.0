<?php
include('includes/header.php');
include('includes/navbar.php');
?>
<style>
        /* Common Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        /* Chat icon button */
        .chat-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: #007bff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 1000;
        }

        .chat-icon svg {
            width: 30px;
            height: 30px;
            fill: white;
        }

        /* Chatbox container (hidden by default) */
        .chatbox {
            position: fixed;
            bottom: 80px; /* Slightly above the chat icon */
            right: 20px;
            width: 300px;
            max-height: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            background-color: #fff;
            display: none; /* Initially hidden */
            flex-direction: column;
            font-family: Arial, sans-serif;
            z-index: 1000;
        }

        /* Chat header */
        .chatbox-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        /* Chat messages */
        .chatbox-messages {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            border-top: 1px solid #ddd;
        }

        /* Chat input */
        .chatbox-input {
            display: flex;
            border-top: 1px solid #ddd;
        }

        .chatbox-input input {
            flex: 1;
            border: none;
            padding: 10px;
            outline: none;
        }

        .chatbox-input button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        .chatbox-input button:hover {
            background-color: #0056b3;
        }
    </style>
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
    <!-- Chat icon -->
    <div class="chat-icon" onclick="toggleChatbox()">
        <!-- SVG Icon (Chat Bubble) -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M12 3C6.48 3 2 6.99 2 12c0 1.85.63 3.63 1.8 5.19l-1.4 3.74a1 1 0 0 0 1.37 1.26l3.9-1.56C9.09 21.84 10.51 22 12 22c5.52 0 10-3.99 10-9s-4.48-10-10-10zm0 2c4.41 0 8 3.13 8 7s-3.59 7-8 7c-1.16 0-2.3-.25-3.35-.72L6.16 20.1l.87-2.33C5.74 16.45 5 14.61 5 12c0-3.87 3.13-7 7-7zm0 2c-.55 0-1 .45-1 1v3H8c-.55 0-1 .45-1 1s.45 1 1 1h3v3c0 .55.45 1 1 1s1-.45 1-1v-3h3c.55 0 1-.45 1-1s-.45-1-1-1h-3V8c0-.55-.45-1-1-1z"></path>
        </svg>
    </div>

    <!-- Chatbox container -->
    <div class="chatbox" id="chatbox">
        <div class="chatbox-header" onclick="toggleChatbox()">Chat with us</div>
        <div class="chatbox-messages" id="chat-messages"></div>
        <div class="chatbox-input">
            <input type="text" id="chat-input" placeholder="Type a message..." />
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>

    <script>
        // Toggle chatbox visibility
        function toggleChatbox() {
            const chatbox = document.getElementById('chatbox');
            if (chatbox.style.display === 'none' || chatbox.style.display === '') {
                chatbox.style.display = 'flex'; // Show chatbox
            } else {
                chatbox.style.display = 'none'; // Hide chatbox
            }
        }

        // Send a message
        function sendMessage() {
            const input = document.getElementById('chat-input');
            const messages = document.getElementById('chat-messages');

            if (input.value.trim() !== '') {
                const message = document.createElement('div');
                message.textContent = input.value;
                message.style.marginBottom = '10px';
                message.style.padding = '10px';
                message.style.backgroundColor = '#f1f1f1';
                message.style.borderRadius = '5px';
                message.style.alignSelf = 'flex-end';
                message.style.textAlign = 'right';

                messages.appendChild(message);
                input.value = '';

                // Scroll to the bottom
                messages.scrollTop = messages.scrollHeight;

                // Optionally send the message to the server
                fetch('process_chat.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ message: message.textContent })
                });
            }
        }
    </script>
</div>
<!-- End of .container -->

<?php 
include('includes/script.php');
include('message.php'); 
?>
