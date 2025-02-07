<main>
    <div class="container-fluid">
        <h1 class="mt-4">Data Kategori Pengeluaran</h1>

        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="<?php echo site_url(); ?>/kategori/pemasukan">Kategori Pemasukan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="<?php echo site_url(); ?>/kategori/pengeluaran">Kategori Pengeluaran</a>
            </li>
        </ul>

        <!-- Form Kategori Pengeluaran -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-plus-circle mr-1"></i>
                Form Kategori Pengeluaran
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="nama_kategori_pengeluaran">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori_pengeluaran"
                            placeholder="Masukkan nama kategori" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>

        <!-- Data Kategori Pengeluaran -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Data Kategori Pengeluaran
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Tagihan</td>
                                <td>
                                    <button class="btn btn-sm btn-warning">Edit</button>
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Belanja</td>
                                <td>
                                    <button class="btn btn-sm btn-warning">Edit</button>
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Transportasi</td>
                                <td>
                                    <button class="btn btn-sm btn-warning">Edit</button>
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</main>