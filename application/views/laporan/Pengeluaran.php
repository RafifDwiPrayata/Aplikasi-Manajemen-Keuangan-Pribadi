<main>
    <div class="container-fluid">
        <h1 class="mt-4">Laporan Pengeluaran</h1>
        
        <!-- Form Filter -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="get" action="<?php echo site_url('laporanpengeluaran'); ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bulan">Bulan</label>
                                <select class="form-control" id="bulan" name="bulan">
                                    <option value="">-- Semua Bulan --</option>
                                    <?php foreach($daftar_bulan as $value => $label): ?>
                                    <option value="<?php echo $value; ?>" <?php echo ($bulan_terpilih == $value) ? 'selected' : ''; ?>>
                                        <?php echo $label; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <select class="form-control" id="tahun" name="tahun">
                                    <?php 
                                    $tahun_sekarang = date('Y');
                                    for($tahun = $tahun_sekarang; $tahun >= $tahun_sekarang - 4; $tahun--): 
                                    ?>
                                    <option value="<?php echo $tahun; ?>" <?php echo ($tahun_terpilih == $tahun) ? 'selected' : ''; ?>>
                                        <?php echo $tahun; ?>
                                    </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select class="form-control" id="kategori" name="kategori">
                                    <option value="">-- Semua Kategori --</option>
                                    <?php foreach($kategori as $k): ?>
                                    <option value="<?php echo $k->id; ?>" <?php echo ($kategori_terpilih == $k->id) ? 'selected' : ''; ?>>
                                        <?php echo $k->nama_kategori; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search mr-1"></i>Tampilkan
                    </button>
                    <a href="<?php echo site_url('laporanpengeluaran'); ?>" class="btn btn-secondary">
                        <i class="fas fa-sync-alt mr-1"></i>Reset
                    </a>
                </form>
            </div>
        </div>

        <!-- Tabel Laporan -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Ringkasan Pengeluaran per Bulan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bulan</th>
                                <th>Kategori</th>
                                <th>Jumlah Transaksi</th>
                                <th>Total Pengeluaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $total_transaksi = 0;
                            $total_pengeluaran = 0;
                            foreach($laporan as $row): 
                                $bulan = date('F Y', strtotime($row->bulan.'-01'));
                                $total_transaksi += $row->jumlah_transaksi;
                                $total_pengeluaran += $row->total_pengeluaran;
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $bulan; ?></td>
                                <td><?php echo $row->kategori; ?></td>
                                <td class="text-center"><?php echo $row->jumlah_transaksi; ?></td>
                                <td class="text-right">Rp <?php echo number_format($row->total_pengeluaran, 0, ',', '.'); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-right">Total</th>
                                <th class="text-center"><?php echo $total_transaksi; ?></th>
                                <th class="text-right">Rp <?php echo number_format($total_pengeluaran, 0, ',', '.'); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>