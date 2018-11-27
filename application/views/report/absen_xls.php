
		<h3><i class="fa fa-list"></i> Kehadiran <?php if($event){ echo $event[0]['event_name']; }?></h3>
							<div><b><?php echo count($data_grid); ?> Peserta Hadir Dari 224</b></div>
<table width="200" border="1" >
					<thead>
						<tr class="warning">
							<th style ='background:orange; color:white'>#</th>
							<th style ='background:orange; color:white'>Nama</th>
							<th style ='background:orange; color:white'>Jabatan</th>
							<th style ='background:orange; color:white'>Nama Perusahaan</th>
							<th style ='background:orange; color:white'>Masuk</th>
							<th style ='background:orange; color:white'>Musyawarah 1</th>
							<th style ='background:orange; color:white'>Musyawarah 2</th>
							<th style ='background:orange; color:white'>Keluar</th>
							<th style ='background:orange; color:white'>Telat</th>
						</tr>
					</thead>
					<tbody>
				   <?php
					$no = 1;
					
					if($data_grid){
						foreach($data_grid as $row){
							if($row->update_date == '0000-00-00 00:00:00'){
								$keluar = '-';
							}else{
								$keluar = $row->absen_keluar;
							}
							$jam1 = new DateTime($event[0]['event_start']);
							$jam2 = new DateTime(substr($row->absen_masuk,-8));
							$beda = $jam1->diff($jam2);
							// debug($beda);
							if($beda->format('%R') == '+'){
								$color = 'red';
							}else{
								$color = 'green';
							}
					?>
						<tr style='color:<?php echo $color; ?>'>
							<th><?php echo $no;$no++;?></th>
							<th><?php echo $row->pegawai_name; ?></th>
							<th> <?php echo $row->pegawai_jabatan; ?></th>
							<th> <?php echo $row->company_name; ?></th>
							<th> <?php echo $row->absen_masuk; ?></th>
							<th> <?php if($row->musy_1) { echo $row->musy_1; }else{ echo '-'; } ?></th>
							<th> <?php if($row->musy_2) { echo $row->musy_2; }else{ echo '-'; }  ?></th>
							<th> <?php echo $keluar; ?></th>
							<th> <?php echo  $beda->format('%R %H Jam %i menit'); ?></th>
						</tr>
					<?php
						}
					}else{
					?>
						<tr>
							<th colspan='6'>tidak ditemukan</th>
						</tr>
					<?php
					}
				   ?>
					</tbody>
				</table>