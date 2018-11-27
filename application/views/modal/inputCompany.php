
<!-- modal tambah data start-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Data Perusahaan</h4>
      </div>
      <div class="modal-body">
        <form method="post" action = "<?php echo site_url('dashboard/input_company'); ?>" enctype="multipart/form-data" accept-charset="utf-8">																		
          <div class="form-group">
            <label for="recipient-name" class="control-label">Nama Perusahaan:  
			</label>
			<input class="form-control" name="company_name" placeholder="Nama Perusahaan" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Merk Dagang:  
			</label>
			<input class="form-control" name="company_brand" placeholder="Nama Perusahaan" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">No Reg. Perusahaan:  
			</label>
			<input class="form-control" name="company_reg" placeholder="Alamat">
          </div>	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Alamat Perusahaan:  
			</label>
			<input class="form-control" name="company_addres" placeholder="Alamat">
          </div>																	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Kota:  
			</label>
			<input class="form-control" name="kota" placeholder="Kota">
          </div>																		
          <div class="form-group">
            <label for="recipient-name" class="control-label">Kode Pos:  
			</label>
			<input class="form-control" name="kode_pos" placeholder="Kode Pos">
          </div>																		
          <div class="form-group">
            <label for="recipient-name" class="control-label">No. Telp. Perusahaan:  
			</label>
			<input class="form-control" name="company_contact" placeholder="Kontak Perusahaan">
          </div>																			
          <div class="form-group">
            <label for="recipient-name" class="control-label">Fax Perusahaan:  
			</label>
			<input class="form-control" name="fax" placeholder="Kontak Perusahaan">
          </div>																			
          <div class="form-group">
            <label for="recipient-name" class="control-label">Email Perusahaan:  
			</label>
			<input class="form-control" name="company_email" placeholder="Kontak Perusahaan">
          </div>																			
          <div class="form-group">
            <label for="recipient-name" class="control-label">Website Perusahaan:  
			</label>
			<input class="form-control" name="company_web" placeholder="Website">
          </div>																	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Pin Siskohat:  
			</label>
			<input class="form-control" name="pin_siskohat" placeholder="SK Perusahaan">
          </div>																	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Pin Muassasah:  
			</label>
			<input class="form-control" name="pin_muassasah" placeholder="SK Perusahaan">
          </div>																	
          <div class="form-group">
            <label for="recipient-name" class="control-label">SK Umroh:  
			</label>
			<input class="form-control" name="sk_umroh" placeholder="SK Perusahaan">
          </div>																
          <div class="form-group">
            <label for="recipient-name" class="control-label">Tgl SK Umroh:  
			</label>
			<input class="form-control" name="tgl_sk_umroh" id='tgl_4' placeholder="Tgl SK Perusahaan">
          </div>															
          <div class="form-group">
            <label for="recipient-name" class="control-label">SK Haji:  
			</label>
			<input class="form-control" name="company_sk" placeholder="SK Perusahaan">
          </div>																
          <div class="form-group">
            <label for="recipient-name" class="control-label">Tgl SK Haji:  
			</label>
			<input class="form-control" name="tgl_sk" id='tgl_1' placeholder="Tgl SK Perusahaan">
          </div>															
          <div class="form-group">
            <label for="recipient-name" class="control-label">PIHK / PPIU:  
			</label>
			<select class="form-control" name="pihk_group">
			  <option value="0" >PIHK</option>
			  <option value="1" >PPIU</option>
			</select>
          </div>														
          <div class="form-group">
            <label for="recipient-name" class="control-label">Provider Visa:  
			</label>
			<select class="form-control" name="provider_visa">
			  <option value="0" >Tidak</option>
			  <option value="1" >Ya</option>
			</select>
          </div>														
          <div class="form-group">
            <label for="recipient-name" class="control-label">Nama Provider:  
			</label>
			<input class="form-control" name="nama_provider" placeholder="Nama Provider">
          </div>	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Logo Perusahaan:  
			</label>
			<input class="form-control" type="file" name="file_1" / >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Foto Kantor:  
			</label>
			<input class="form-control" type="file" name="file_2" / >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Stempel Perusahaan:  
			</label>
			<input class="form-control" type="file" name="file_3" / >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Ttd Perusahaan:  
			</label>
			<input class="form-control" type="file" name="file_4" / >
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit Data</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- modal tambah data end -->