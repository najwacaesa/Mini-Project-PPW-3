<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px; height:100vh; position:sticky; top:0">
    <a href="../admin/dashboard.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Dashboard</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="../admin/dashboard.php" class="nav-link <?= end(explode('/', $_SERVER['REQUEST_URI'])) == 'dashboard.php' ? 'active' : ''; ?> text-white" aria-current="page">
                <i class="bi bi-house-door-fill me-2"></i>
                Home
            </a>
        </li>
        <li class="nav-item">
            <a href="../admin/barang.php" class="nav-link <?= end(explode('/', $_SERVER['REQUEST_URI'])) == 'barang.php' ? 'active' : ''; ?> text-white" aria-current="page">
                <i class="bi bi-box-seam-fill me-2"></i>
                Barang
            </a>
        </li>
        <?php if ($_SESSION['user']['peran'] === 'Super') : ?>
            <hr>
            <li>
                <a href="../admin/account.php" class="nav-link <?= end(explode('/', $_SERVER['REQUEST_URI'])) == 'account.php' ? 'active' : ''; ?> text-white">
                    <i class="bi bi-people-fill me-2"></i>
                    User Account
                </a>
            </li>
        <?php endif; ?>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle mx-2"></i>
            <strong><?= $_SESSION['user']['username']; ?></strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="../../index.php">Glowy Store</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" onclick="alert('apakah anda yakin ?')" href="../../logout.php">Sign out</a></li>
        </ul>
    </div>
</div>