
</section>
    <!-- Footer -->

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('asset/dash/js/bootstrap.min.js')?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url('asset/dash/js/plugins/metisMenu/metisMenu.min.js')?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('asset/dash/js/sb-admin-2.js')?>"></script>
	
    <script src="<?php echo base_url('asset/dash/js/plugins/dataTables/jquery.dataTables.js')?>"></script>
    <script src="<?php echo base_url('asset/dash/js/plugins/dataTables/dataTables.bootstrap.js')?>"></script>
	
	<script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
        $('#dataTables-example1').dataTable();
        $('#dataTables-example2').dataTable();
        $('#dataTables-example3').dataTable();
        $('#dataTables-example4').dataTable();
    });
	
	function confirmation(){
		var a = confirm("Anda Yakin akan Menghapus ?");
		if(a == true){
			return true;
		}else{
			return false;
		}
	}
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Scrolls to the selected menu item on the page
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
	$(function() {
		$( "#tgl_1" ).datepicker({dateFormat: 'yy-mm-dd'});
		$( "#tgl_2" ).datepicker({dateFormat: 'yy-mm-dd'});
		$( "#tgl_3" ).datepicker({dateFormat: 'yy-mm-dd'});
		$( "#tgl_4" ).datepicker({dateFormat: 'yy-mm-dd'});
		$( "#tgl_5" ).datepicker({dateFormat: 'yy-mm-dd'});
	});
    </script>

</body>

</html>
