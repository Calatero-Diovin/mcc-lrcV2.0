<?php // include('authentication.php'); ?>
<header id="header" class="header fixed-top d-flex align-items-center">
    <!-- Logo -->
    <div class="d-flex align-items-center">
        <a href="." class="logo d-flex align-items-center">
            <img src="assets/img/mcc-logo.png" alt="logo" class="mx-2" />
            <span class="d-none d-lg-block mx-2">MCC <span class="text-info d-block fs-6">Learning Resource Center</span></span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <?php 
    if (isset($_SESSION['auth_admin']['admin_id'])) {
        $id_session = $_SESSION['auth_admin']['admin_id'];
    }
    ?>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown me-3">
                <a class="nav-link nav-icon fs-4" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <?php
                    $query = "SELECT COUNT(DISTINCT CONCAT(h.user_id, '-', h.faculty_id)) AS total_borrowers
                    FROM holds h
                    WHERE h.hold_status = 'Hold'";
                    $query_run = mysqli_query($con, $query);
                    $total_borrowers = $query_run ? mysqli_fetch_assoc($query_run)['total_borrowers'] : 0;

                    // Get the pending count
                    $user_sql = "SELECT COUNT(*) AS pending_count FROM user WHERE status = 'pending'";
                    $faculty_sql = "SELECT COUNT(*) AS pending_count FROM faculty WHERE status = 'pending'";

                    $user_result = mysqli_query($con, $user_sql);
                    $faculty_result = mysqli_query($con, $faculty_sql);

                    $user_row = mysqli_fetch_assoc($user_result);
                    $faculty_row = mysqli_fetch_assoc($faculty_result);

                    $pendingCount = $user_row['pending_count'] + $faculty_row['pending_count'];

                    echo '<span class="badge bg-danger badge-number">'.($total_borrowers + $pendingCount).'</span>';
                    ?>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications scrollable-dropdown">
                    <li class="dropdown-header">
                        You have <?= ($total_borrowers + $pendingCount) ?> notifications
                    </li>

                    <?php 
                    // Notifications for holds
                    $query_notif = "SELECT 
                                        u.user_id, u.firstname AS user_firstname, u.lastname AS user_lastname, 
                                        f.faculty_id, f.firstname AS faculty_firstname, f.lastname AS faculty_lastname,
                                        COUNT(h.hold_id) AS num_hold_books
                                    FROM holds h
                                    LEFT JOIN user u ON u.user_id = h.user_id
                                    LEFT JOIN faculty f ON f.faculty_id = h.faculty_id
                                    WHERE h.hold_status = 'Hold'
                                    GROUP BY u.user_id, f.faculty_id
                                    ORDER BY h.hold_id DESC LIMIT 3";
                    $query_run = mysqli_query($con, $query_notif);

                    if (mysqli_num_rows($query_run) > 0) {
                        while ($holdlist = mysqli_fetch_assoc($query_run)) {
                            $name = $holdlist['user_id'] ? $holdlist['user_firstname'].' '.$holdlist['user_lastname'] : $holdlist['faculty_firstname'].' '.$holdlist['faculty_lastname'];
                            $id = $holdlist['user_id'] ? $holdlist['user_id'] : $holdlist['faculty_id'];
                    ?>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li class="notification-item">
                        <div>
                            <h4><?=$name;?></h4>
                            <p>hold <span><?=$holdlist['num_hold_books'];?></span> book(s).</p>
                        </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <?php
                        }
                    }
                    ?>

                    <!-- Notifications for pending users and faculty -->
                    <?php if ($pendingCount > 0): ?>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <?php while ($user = mysqli_fetch_assoc($pending_users_result)): ?>
                            <li class="notification-item">
                                <a href="user_student_approval" style="text-decoration:none;font-size:13px;margin-left:10px;">
                                    <div>
                                        <img src="<?= $user['profile_image'] ? '../uploads/profile_images/'.$user['profile_image'] : 'assets/img/image.png'; ?>" alt="" width="30px" height="30px" class="rounded-circle">
                                        <h4><?= $user['firstname'].' '.$user['lastname']; ?></h4>
                                        <p>Pending Approval</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                        <?php endwhile; ?>
                        <?php while ($faculty = mysqli_fetch_assoc($pending_faculty_result)): ?>
                            <li class="notification-item">
                                <a href="user_student_approval" style="text-decoration:none;font-size:13px;margin-left:10px;">
                                    <div>
                                        <img src="<?= $faculty['profile_image'] ? '../uploads/profile_images/'.$faculty['profile_image'] : 'assets/img/image.png'; ?>" alt="" width="30px" height="30px" class="rounded-circle">
                                        <h4><?= $faculty['firstname'].' '.$faculty['lastname']; ?></h4>
                                        <p>Pending Approval</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                        <?php endwhile; ?>
                    <?php endif; ?>

                    <li style="border-top: 1px solid skyblue;">
                        <center>
                            <a href="all_notification" style="text-decoration:underline;font-size:13px;margin-left:10px;">Show all notifications</a>
                        </center>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown pe-3">
                <?php
                $query = "SELECT * FROM admin WHERE admin_id = '$id_session'";
                $query_run = mysqli_query($con, $query);
                $row = mysqli_fetch_array($query_run);
                ?>
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="javascript:;" data-bs-toggle="dropdown">
                    <img src="<?= $row['admin_image'] ? '../uploads/admin_profile/'.$row['admin_image'] : 'assets/img/admin.png'; ?>" alt="" width="30px" height="30px" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['auth_admin']['admin_name']; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?= $_SESSION['auth_admin']['admin_name'];?></h6>
                    </li>
                    <li><hr class="dropdown-divider" /></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="admin_profile">
                            <i class="bi bi-person"></i> <span>My Profile</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider" /></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="account_settings">
                            <i class="bi bi-gear"></i> <span>Account Settings</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider" /></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="admin">
                            <i class="bi bi-person-workspace"></i><span>Admin</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider" /></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="circulation_settings">
                            <i class="bi bi-journal-album"></i><span>Circulation Settings</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider" /></li>
                    <li>
                        <form action="allcode.php" method="POST">
                            <button class="dropdown-item d-flex align-items-center" name="logout_btn" type="submit">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Log Out</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>

<style>
.scrollable-dropdown {
    max-height: 300px; /* Set your desired max-height */
    overflow-y: auto;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const badge = document.querySelector('.badge-number'); // Select the badge element
    const checkNotifications = () => {
        fetch('notification_count.php') // Call the PHP endpoint
            .then(response => response.json())
            .then(data => {
                if (badge) {
                    badge.textContent = data.count; // Update badge with new count
                }
            })
            .catch(error => console.error('Error fetching notification count:', error));
    };

    // Initial check
    checkNotifications();

    // Check every 30 seconds
    setInterval(checkNotifications, 30000); // Adjust the interval as needed
});
</script>
