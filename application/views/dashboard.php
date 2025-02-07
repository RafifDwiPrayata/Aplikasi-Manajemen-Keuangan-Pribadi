<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>

        <!-- Cards -->
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <h6>Saldo Masuk</h6>
                        <h4>Rp. <?php echo number_format($total_pemasukan, 0, ',', '.'); ?></h4>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="small text-muted">Total Pemasukan</div>
                        <div><i class="fas fa-download text-success"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <h6>Saldo Keluar</h6>
                        <h4>Rp. <?php echo number_format($total_pengeluaran, 0, ',', '.'); ?></h4>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="small text-muted">Total Pengeluaran</div>
                        <div><i class="fas fa-upload text-danger"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <h6>Saldo Saat Ini</h6>
                        <h4>Rp. <?php echo number_format(($total_pemasukan - $total_pengeluaran), 0, ',', '.'); ?></h4>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="small text-muted">Total Saldo</div>
                        <div><i class="fas fa-wallet <?php echo ($total_pemasukan - $total_pengeluaran) >= 0 ? 'text-success' : 'text-danger'; ?>"></i></div>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Tabel Data -->
        <div class="row">
            <!-- Tabel Pemasukan -->
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Data Pemasukan Terbaru
                        <a href="<?php echo site_url('pemasukan'); ?>" class="btn btn-primary btn-sm float-right">
                            Lihat Semua
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pemasukan as $row): ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y', strtotime($row->tanggal)); ?></td>
                                            <td><?php echo $row->keterangan; ?></td>
                                            <td class="text-right">Rp
                                                <?php echo number_format($row->jumlah, 0, ',', '.'); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Pengeluaran -->
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Data Pengeluaran Terbaru
                        <a href="<?php echo site_url('pengeluaran'); ?>" class="btn btn-primary btn-sm float-right">
                            Lihat Semua
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pengeluaran as $row): ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y', strtotime($row->tanggal)); ?></td>
                                            <td><?php echo $row->keterangan; ?></td>
                                            <td class="text-right">Rp
                                                <?php echo number_format($row->jumlah, 0, ',', '.'); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>