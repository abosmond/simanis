<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Halaman Administrator</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="<?=base_url()?>styles/a_common.css"    rel="stylesheet" type="text/css" title="Default" />
		<link href="<?=base_url()?>styles/common.css"      rel="stylesheet" type="text/css" title="Default" />
		<link href="<?=base_url()?>styles/subcontent.css"  rel="stylesheet" type="text/css" title="Default" />
		<link href="<?=base_url()?>styles/sidebar.css"     rel="stylesheet" type="text/css" title="Default" />
		<link href="<?=base_url()?>styles/table.css"       rel="stylesheet" type="text/css" title="Default" />
		<link href="<?=base_url()?>styles/forms.css"       rel="stylesheet" type="text/css" title="Default" />		
		<link href="<?=base_url()?>styles/jquery.autocomplete.css"       rel="stylesheet" type="text/css" title="Default" />	
		<link href="<?=base_url()?>styles/flexigrid.css"       rel="stylesheet" type="text/css" title="Default" />	
		<link href="<?=base_url()?>styles/humanity.datepick.css"       rel="stylesheet" type="text/css" title="Default" />
		<link href="<?=base_url()?>styles/test.css"       rel="stylesheet" type="text/css" title="Default" />
		<script type="text/javascript" src="<?=base_url()?>library/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>library/jquery/jquery.datepick.js"></script>
		<script type="text/javascript" src="<?=base_url()?>library/jquery/jquery.datepick-id.js"></script>
		<script type="text/javascript" src="<?=base_url()?>library/jquery/flexigrid.pack.js"></script>
		<script type="text/javascript" src="<?=base_url()?>library/jquery/settings.js"></script>
		<script type="text/javascript" src="<?=base_url()?>library/jquery/ajaxupload.3.5.js"></script>	
		<script type="text/javascript" src="<?=base_url()?>library/jquery/jquery.autocomplete.js"></script>
		<script type="text/javascript" src="<?=base_url()?>library/jquery/menu.js"></script>
	</head>
	<body>

<!-- Header -->
<div id="header" style="padding: 0px">
	<div id="header-image">
	</div>

	<div id="header-filler">
	</div>
</div>
<!-- End of Header -->

<!-- Navigation -->
<div id="navigation">
	<div class="navigation-infobar">
	<?php
	$a = $this->db->get_where('tahunajaran', array('statusnya' => 'aktif'));
	$ta = $a->row();
	
	$b = $this->db->get_where('semester', array('status_semester' => 'aktif'));		
	$sem = $b->row();
	?>
		TA <?=@$ta->tahun?> Semester <?=@$sem->nama_semester?>
	</div>

	<ul>
		<b><a href="<?=base_url();?>home" class="barmenu">Halaman Depan</a></b>
		<b><a href="<?=base_url();?>logout" class="barmenu">Logout</a></b>
	</ul>
</div>
<!-- End of Navigation -->

<!--Contents-->
<table id=content class="layout">
	<tr>
		<td align="left" valign="top" width="185" class="layout" style="height:600px;width:185px;overflow:visible">

			<div id="content">
				<div id="sidebar">
					<!-- Sidebar -->
					<div class="sidebarContents">
						<br />
						<table width="180" border="0">
							<tr>
								<td width="33" height="34" valign="top">
									<img src="<?=base_url()?>images/user.gif" alt="Login By : " />
								</td>
								<td width="147" align="left" valign="top">
									<font size="3pt" face="Tahoma, Arial, sans-serif" color="#003300">
										<strong><?=$this->session->userdata('nama')?></strong>
										<br />
									</font>
								</td>
							</tr>
						</table>

						<div class="pageBar">
						</div>
						<h3><b>Setting Akademik & Siswa</b></h3>
						<ul>
							<li>
								<a href="<?=base_url();?>profileakademik">Profile Akademik</a>
							</li>
							<li>
								<a href="<?=base_url();?>tahunajaran">Tahun Ajaran</a>
							</li>
							<li>
								<a href="<?=base_url();?>semester">Semester Aktif</a>
							</li>
							<li>
								<a href="<?=base_url();?>refkelas">Wali Kelas</a>
							</li>
							<li>
								<a href="<?=base_url();?>pengampu">Pengampu Mata Pelajaran</a>
							</li>
							<li>
								<a href="<?=base_url();?>kelas">Kelas Siswa</a>
							</li>		
							<li>
								<a href="<?=base_url();?>kenaikankelas">Kenaikan Kelas</a>
							</li>
							<li>
								<a href="<?=base_url();?>tinggalkelas">Tinggal Kelas</a>
							</li>
						</ul>
						
						<h3><strong>Setting SMS</strong></h3>
						<ul>
							<li>
								<a href="<?=base_url();?>potongpulsa">Potongan Pulsa</a>
							</li>
							<!-- <li>
								<a href="<?=base_url();?>broadcastsms">Broadcast SMS</a>
							</li> -->
							<li>
								<a href="<?=base_url();?>broadcastsms/perkelas">Broadcast SMS Per Kelas</a>
							</li>
							<li>
								<a href="<?=base_url();?>broadcastsms/pertingkat">Broadcast SMS Per Tingkat</a>
							</li>
							<!-- <li>
								<a href="<?=base_url();?>templatesms">Template SMS</a>
							</li> -->
						</ul>
						
						<h3><b>DATA POKOK</b></h3>
						<ul>
							<li>
								<a href="<?=base_url();?>guru">Data Guru</a>
							</li>
							<li>
								<a href="<?=base_url();?>mapel">Mata Pelajaran</a>
							</li>
							<li>
								<a href="<?=base_url();?>siswa">Siswa</a>
							</li>
							<li>
								<a href="<?=base_url();?>sms">SMS</a>
							</li>
							<li>
								<a href="<?=base_url();?>voucher">Voucher</a>
							</li>
							
						</ul>
						
						<h3><b>DATA SISWA & AKTIFITAS</b></h3>
						<ul>						
							
							<li>
								<a href="<?=base_url();?>absensi">Absensi</a>
							</li>
							<li>
								<a href="<?=base_url();?>ujian">Ujian</a>
							</li>
							<li>
								<a href="<?=base_url();?>nilai">Nilai</a>
							</li>
							<li>
								<a href="<?=base_url();?>kasus">Kasus</a>
							</li>
							<li>
								<a href="<?=base_url();?>spp">SPP</a>
							</li>
						</ul>					
					</div>
					<!-- End of Sidebar -->

				</div>
			</div>
		</td>
		<td align="left" valign="top" class="layout">
			<div id="subcontent">
				<div class="subcontent-element">	
					<div id="self_loading" style="display:none">Loading...., please wait!<br /><img src="<?=base_url()."images/ajax-loader.gif";?>" /></div>
					<br/><br/><br/><br/><br/>
					<?=$this->load->view($view);?>
				</div>
			</div>
		</td>
	</tr>
</table>
<!-- end of content -->

<!-- Footer -->
<div id="footer">
	<div id="footerElement">

		<table>
			<tr>
				<td></td>
			</tr>
		</table>
	</div>
</div>
<!-- End of Footer -->

	</body>
</html>