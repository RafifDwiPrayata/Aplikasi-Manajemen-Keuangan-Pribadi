<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; 2022 - <a href="https://kurmamedia.com/"
                    class="text-decoration-none">Pejuang Digital</a>. All rights reserved.</div>
        </div>
    </div>
</footer>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<script src="<?php echo base_url(); ?>js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="<?php echo base_url(); ?>assets/demo/chart-area-demo.js"></script>
<script src="<?php echo base_url(); ?>assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="<?php echo base_url(); ?>assets/demo/datatables-demo.js"></script>
<script src="<?php echo base_url(); ?>assets/demo/chart-pie-demo.js"></script>

<script>
    // Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable-kategori').DataTable({
    order:[ 2,'asc' ]
  });
});

</script>

</body>

</html>