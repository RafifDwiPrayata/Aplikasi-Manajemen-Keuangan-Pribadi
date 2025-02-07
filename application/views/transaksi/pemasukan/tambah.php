<main>
    <div class="container-fluid">
        <h1 class="mt-4">Tambah Data Pemasukan</h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-plus mr-1"></i>
                Form Tambah Pemasukan
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

                <form action="<?php echo site_url('Pemasukan/simpan'); ?>" method="POST">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" 
                               value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="id_kategori">Kategori</label>
                        <select class="form-control" id="id_kategori" name="id_kategori" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach($kategori as $k): ?>
                            <option value="<?php echo $k->id; ?>"><?php echo $k->nama_kategori; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" 
                                 rows="3" placeholder="Masukkan keterangan Pemasukan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" 
                                   min="0" step="1" placeholder="Masukkan jumlah Pemasukan" required 
                                   oninvalid="this.setCustomValidity('Jumlah tidak boleh kurang dari 0')"
                                   oninput="this.setCustomValidity('')">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i>Simpan
                    </button>
                    <a href="<?php echo site_url('Pemasukan'); ?>" class="btn btn-danger">
                        <i class="fas fa-times mr-1"></i>Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</main>