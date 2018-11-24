<script type="text/javascript">
	function disen(id){
		$.ajax ({
			type: 'post',
			url: "<?php echo base_url();?>ajax/update_flag_in",
			dataType: "json",
			data:"id="+id,
			success:function(data){	
				if(data.flag == 0){
					document.getElementById(id).className = "btn btn-success btn-sm";
					document.getElementById('icon'+id).className = "fa fa-download";
				}else{
					alert('Peserta Sudah Masuk');
				}
				if(data.status=="FAIL"){
					alert('Gagal input data');	
				}			
			},
			error: function(data){
				alert('Error input data');	
			}		
		})
	}

	function musy1(id){

		$.ajax ({
			type: 'post',
			url: "<?php echo base_url();?>ajax/update_flag_in_musy1/1",
			dataType: "json",
			data:"id="+id,
			success:function(data){	
				if(data.flag == 0){
					document.getElementById('1'+id).className = "btn btn-success btn-sm";
					document.getElementById('icon1'+id).className = "fa fa-download";
				}else if(data.flag == 2){
					alert('Peserta Sudah Masuk');
				}else{
					alert('Peserta Belum Melakukan Registrasi');
				}
				if(data.status=="FAIL"){
					alert('Gagal input data');	
				}			
			},
			error: function(data){
				alert('Error input data');	
			}		
		})
	}

	function musy2(id){
		$.ajax ({
			type: 'post',
			url: "<?php echo base_url();?>ajax/update_flag_in_musy1/2",
			dataType: "json",
			data:"id="+id,
			success:function(data){	
				if(data.flag == 0){
					document.getElementById('2'+id).className = "btn btn-success btn-sm";
					document.getElementById('icon2'+id).className = "fa fa-download";
				}else if(data.flag == 2){
					alert('Peserta Sudah Masuk');
				}else{
					alert('Peserta Belum Melakukan Registrasi');
				}
				if(data.status=="FAIL"){
					alert('Gagal input data');	
				}			
			},
			error: function(data){
				alert('Error input data');	
			}		
		})
	}

	function out(id){
		$.ajax ({
			type: 'post',
			url: "<?php echo base_url();?>ajax/cekout/",
			dataType: "json",
			data:"id="+id,
			success:function(data){	
				if(data.flag == 0){
					document.getElementById('ch'+id).className = "btn btn-success btn-sm";
					document.getElementById('icon3'+id).className = "fa fa-download";
				}else if(data.flag == 2){
					alert('Peserta Sudah Check Out');
				}else{
					alert('Peserta Belum Melakukan Registrasi');
				}
				if(data.status=="FAIL"){
					alert('Gagal input data');	
				}			
			},
			error: function(data){
				alert('Error input data');	
			}		
		})
	}
</script>