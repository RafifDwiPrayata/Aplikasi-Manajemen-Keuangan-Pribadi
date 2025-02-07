<main>
    <div class="container-fluid">
        <h1 class="mt-4">Edit Data Pemasukan</h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-edit mr-1"></i>
                Form Edit Pemasukan
            </div>
            <div class="card-body">
                <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $this->session->flashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php endif; ?>

                <form action="<?php echo site_url('pemasukan/update'); ?>" method="POST">
                    <input type="hidden" name="id" value="<?php echo $pemasukan->id; ?>">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" 
                               value="<?php echo $pemasukan->tanggal; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="id_kategori">Kategori</label>
                        <select class="form-control" id="id_kategori" name="id_kategori" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach($kategori as $k): ?>
                            <option value="<?php echo $k->id; ?>" <?php echo ($k->id == $pemasukan->id_kategori) ? 'selected' : ''; ?>>
                                <?php echo $k->nama_kategori; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" 
                                 rows="3"><?php echo $pemasukan->keterangan; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" 
                                   value="<?php echo $pemasukan->jumlah; ?>" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i>Simpan
                    </button>
                    <a href="<?php echo site_url('pemasukan'); ?>" class="btn btn-danger">
                        <i class="fas fa-times mr-1"></i>Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</main>