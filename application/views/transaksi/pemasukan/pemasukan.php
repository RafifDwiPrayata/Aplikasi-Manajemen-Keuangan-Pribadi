<main>
    <div class="container-fluid">
        <h1 class="mt-4">Data Pemasukan</h1>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $this->session->flashdata('error'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <!-- Form Filter -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="get" action="<?php echo site_url('pemasukan'); ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bulan">Bulan</label>
                                <select class="form-control" id="bulan" name="bulan">
                                    <?php foreach ($daftar_bulan as $value => $label): ?>
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
                                    <option value="">-- Semua Tahun --</option>
                                    <?php
                                    $tahun_sekarang = date('Y');
                                    for ($tahun = $tahun_sekarang; $tahun >= $tahun_sekarang - 4; $tahun--):
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
                                    <?php foreach ($kategori as $k): ?>
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
                    <a href="<?php echo site_url('pemasukan'); ?>" class="btn btn-secondary">
                        <i class="fas fa-sync-alt mr-1"></i>Reset
                    </a>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Data Pemasukan
                <a href="<?php echo site_url('pemasukan/tambah'); ?>" class="btn btn-primary float-right">
                    <i class="fas fa-plus"></i> Tambah Pemasukan
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($pemasukan as $row): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($row->tanggal)); ?></td>
                                    <td><?php echo $row->nama_kategori; ?></td>
                                    <td><?php echo $row->keterangan; ?></td>
                                    <td class="text-right">Rp <?php echo number_format($row->jumlah, 0, ',', '.'); ?></td>
                                    <td>
                                        <a href="<?php echo site_url('pemasukan/edit/' . $row->id); ?>"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="<?php echo site_url('pemasukan/hapus/' . $row->id); ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>