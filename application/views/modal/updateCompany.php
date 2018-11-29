
<div class="modal fade" id="myModalManual" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Send Manual Email</h4>
		  </div>
		  <div class="modal-body">
			<form method="post" action = "<?php echo site_url('dashboard/update_company'); ?>" enctype="multipart/form-data" accept-charset="utf-8">
			  																	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Nama Perusahaan:  
			</label>
			<input class="form-control" name="company_name" id="company_name" placeholder="Nama Perusahaan" required>
			<input type="hidden"name="id_com" id="id_com" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Merk Dagang:  
			</label>
			<input class="form-control" name="company_brand" id="company_brand" placeholder="Nama Perusahaan" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">No Reg. Perusahaan:  
			</label>
			<input class="form-control" name="company_reg" id="company_reg" placeholder="Alamat">
          </div>	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Alamat Perusahaan:  
			</label>
			<input class="form-control" name="company_addres" id="company_addres" placeholder="Alamat">
          </div>																	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Kota:  
			</label>
			<input class="form-control" name="kota" id="kota" placeholder="Kota">
          </div>																		
          <div class="form-group">
            <label for="recipient-name" class="control-label">Kode Pos:  
			</label>
			<input class="form-control" name="kode_pos" id="kode_pos" placeholder="Kode Pos">
          </div>																		
          <div class="form-group">
            <label for="recipient-name" class="control-label">No. Telp. Perusahaan:  
			</label>
			<input class="form-control" name="company_contact" id="company_contact" placeholder="Kontak Perusahaan">
          </div>																			
          <div class="form-group">
            <label for="recipient-name" class="control-label">Fax Perusahaan:  
			</label>
			<input class="form-control" name="fax" id="fax" placeholder="Kontak Perusahaan">
          </div>																			
          <div class="form-group">
            <label for="recipient-name" class="control-label">Email Perusahaan:  
			</label>
			<input class="form-control" name="company_email" id="company_email" placeholder="Kontak Perusahaan">
          </div>																			
          <div class="form-group">
            <label for="recipient-name" class="control-label">Website Perusahaan:  
			</label>
			<input class="form-control" name="company_web" id="company_web" placeholder="Website">
          </div>																
          <div class="form-group">
            <label for="recipient-name" class="control-label">Pin Siskohat:  
			</label>
			<input class="form-control" name="pin_siskohat" id="pin_siskohat" placeholder="SK Perusahaan">
          </div>																	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Pin Muassasah:  
			</label>
			<input class="form-control" name="pin_muassasah" id="pin_muassasah" placeholder="SK Perusahaan">
          </div>																	
          <div class="form-group">
            <label for="recipient-name" class="control-label">SK Umroh:  
			</label>
			<input class="form-control" name="sk_umroh" id="sk_umroh" placeholder="SK Perusahaan">
          </div>																
          <div class="form-group">
            <label for="recipient-name" class="control-label">Tgl SK Umroh:  
			</label>
			<input class="form-control" name="tgl_sk_umroh" id='tgl_2' placeholder="Tgl SK Perusahaan">
          </div>															
          <div class="form-group">
            <label for="recipient-name" class="control-label">SK Haji:  
			</label>
			<input class="form-control" name="company_sk" id="company_sk" placeholder="SK Perusahaan">
          </div>																
          <div class="form-group">
            <label for="recipient-name" class="control-label">Tgl SK Haji:  
			</label>
			<input class="form-control" name="tgl_sk" id='tgl_3' placeholder="Tgl SK Perusahaan">
          </div>															
          <div class="form-group">
            <label for="recipient-name" class="control-label">PIHK / PPIU:  
			</label>
			<select class="form-control" name="pihk_group" id="pihk_group" >
			  <option value="0" >PIHK</option>
			  <option value="1" >PPIU</option>
			</select>
          </div>													
          <div class="form-group">
            <label for="recipient-name" class="control-label">Provider Visa:  
			</label>
			<select class="form-control" name="provider_visa" id="provider_visa">
			  <option value="0" >Tidak</option>
			  <option value="1" >Ya</option>
			</select>
          </div>														
          <div class="form-group">
            <label for="recipient-name" class="control-label">Nama Provider:  
			</label>
			<input class="form-control" name="nama_provider" id="nama_provider" placeholder="Nama Provider">
          </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp;Update Data</button>
		  </div>
			</form>
		</div>
	  </div>
	</div>
</div>