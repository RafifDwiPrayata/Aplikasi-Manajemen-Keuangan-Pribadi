<main>
    <div class="container-fluid">
        <h1 class="mt-4">Data Kategori</h1>
        <div class="card mb-4">
        <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Data Kategori
                <a href="<?php echo site_url('kategori/tambah'); ?>" class="btn btn-primary float-right">
                    <i class="fas fa-plus"></i> Tambah Kategori
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable-kategori" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Tipe</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kategori as $row): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row->nama_kategori; ?></td>
                                    <td>
                                        <span
                                            class="badge badge-<?php echo ($row->tipe_kategori == 'pemasukan') ? 'success' : 'danger'; ?>">
                                            <?php echo ucfirst($row->tipe_kategori); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?php echo site_url('kategori/edit/' . $row->id); ?>"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="<?php echo site_url('kategori/hapus/' . $row->id); ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
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