<?php session_start(); 
include('admin/config/dbcon.php');
?>

<style>
     .sidebar {
    position: fixed;
    top: 0;
    left: -250px; /* Start hidden */
    height: 100%;
    width: 250px;
    background-color: #007bff; /* Customize as needed */
    transition: left 0.3s ease;
    z-index: 1000;
}

.sidebar.active {
    left: 0; /* Show sidebar */
}

</style>

<nav class="navbar navbar-expand-lg" style="background: #0096FF;">
    <button id="menu-toggle" class="toggle square ms-3" type="button" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <img src="assets/img/mcc-logo.png" alt="logo" class="mx-2" height="40px" width="40px" />
        <a class="navbar-brand text-white fw-bold fs-5" href="#">MCC-LRC</a>
</nav>

<!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <ul class="navbar-nav">
        <?php if (isset($_SESSION['auth_stud'])) : ?>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == 'index' || $page == 'book_details' ? 'active' : '' ?> fw-semibold" href="index">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == 'ebook' ? 'active' : '' ?> fw-semibold" href="ebook">Ebooks</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == 'notification' ? 'active' : '' ?> fw-semibold" href="notification">Notification</a>
            </li>
        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == '.' ? 'active' : '' ?> fw-semibold" href=".">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == 'about' ? 'active' : '' ?> fw-semibold" href="about">About</a>
            </li>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['auth_stud'])) : ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span><?= $_SESSION['auth_stud']['stud_name']; ?></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="myprofile"><i class="bi bi-person"></i> My Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="hold"><i class="bi bi-book"></i> Hold Books</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="allcode" method="POST">
                            <button type="submit" name="logout_btn" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        <?php else : ?>
            <li class="nav-item">
                <a href="login" class="nav-link text-white fw-semibold">Login</a>
            </li>
            <li class="nav-item">
                <a href="ms_verify" class="nav-link text-white bg-info px-3 fw-semibold rounded-pill">Signup</a>
            </li>
        <?php endif; ?>
    </ul>
</div>

<script>
document.getElementById('menu-toggle').addEventListener('click', function() {
    var sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('active');
});
</script>
