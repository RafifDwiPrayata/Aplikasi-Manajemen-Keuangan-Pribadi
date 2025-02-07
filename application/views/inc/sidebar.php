<nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
    <a class="navbar-brand" href="<?php echo site_url(); ?>/dashboard">BukuSaldo</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#!">
        <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#!" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo site_url(); ?>/profil">Profil</a>
                <a class="dropdown-item" href="<?php echo site_url(); ?>/profil/ganti_password">Ganti Password</a>
                <a class="dropdown-item" href="<?php echo site_url(); ?>/auth/logout">Logout</a>
            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Menu</div>
                    <a class="nav-link" href="<?php echo site_url(); ?>/dashboard">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <div class="sb-sidenav-menu-heading">Transaksi</div>
                    <a class="nav-link" href="<?php echo site_url(); ?>/pemasukan">
                        <div class="sb-nav-link-icon"><i class="fas fa-download"></i></div>
                        Pemasukan
                    </a>
                    <a class="nav-link" href="<?php echo site_url(); ?>/pengeluaran">
                        <div class="sb-nav-link-icon"><i class="fas fa-upload"></i></div>
                        Pengeluaran
                    </a>
                    <a class="nav-link" href="<?php echo site_url(); ?>/kategori">
                        <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                        Kategori
                    </a>

                    <div class="sb-sidenav-menu-heading">Laporan</div>
                    <a class="nav-link" href="<?php echo site_url(); ?>/LaporanPemasukan">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
                        Laporan Pemasukan
                    </a>
                    <a class="nav-link" href="<?php echo site_url(); ?>/laporanpengeluaran">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-pie"></i></div>
                        Laporan Pengeluaran
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="medium">Logged in as:
                    <?php
                    $user = $this->ion_auth->user()->row();
                    echo $user->first_name;
                    ?>
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">