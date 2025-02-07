<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?php echo isset($kategori) ? 'Edit' : 'Tambah'; ?> Kategori</h1>
            <div class="card mb-4">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="nama_kategori">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" 
                                   value="<?php echo isset($kategori) ? $kategori->nama_kategori : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tipe_kategori">Tipe Kategori</label>
                            <select class="form-control" id="tipe_kategori" name="tipe_kategori" required>
                                <option value="">Pilih Tipe</option>
                                <option value="pemasukan" <?php echo (isset($kategori) && $kategori->tipe_kategori == 'pemasukan') ? 'selected' : ''; ?>>Pemasukan</option>
                                <option value="pengeluaran" <?php echo (isset($kategori) && $kategori->tipe_kategori == 'pengeluaran') ? 'selected' : ''; ?>>Pengeluaran</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?php echo site_url('kategori'); ?>" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>