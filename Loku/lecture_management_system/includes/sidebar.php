<!-- Sidebar -->
<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 250px; height: 100vh; position: fixed;">
    <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <img src="/assets/img/logo.png" alt="LMS Logo" style="width: 40px; height: 40px;" class="me-2">
        <span class="fs-4">Lecture Management</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link active" aria-current="page">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="lectures.php" class="nav-link link-dark">
                <i class="bi bi-book"></i> Lectures
            </a>
        </li>
        <li class="nav-item">
            <a href="timetable.php" class="nav-link link-dark">
                <i class="bi bi-calendar"></i> Timetable
            </a>
        </li>
        <li class="nav-item">
            <a href="students.php" class="nav-link link-dark">
                <i class="bi bi-people"></i> Students
            </a>
        </li>
        <li class="nav-item">
            <a href="settings.php" class="nav-link link-dark">
                <i class="bi bi-gear"></i> Settings
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="/assets/img/user.png" alt="User" width="32" height="32" class="rounded-circle me-2">
            <strong>Admin</strong>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </ul>
    </div>
</div>
<!-- End Sidebar -->
