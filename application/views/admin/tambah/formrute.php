<div class="container-fluid">
	<!--tabel paket-->
	<div class="col-md-8 col-sm-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">Pilih Paket Tujuan</h2>
			</div>
			<?php if ($sukses = $this->session->flashdata('msg')) { ?>
				<div class="alert alert-success" id="msg">
					<a class="close" data-dismiss="alert">&times;</a>
					<strong>Sukses</strong> <?php echo $sukses; ?>
				</div>
			<?php } ?>
			<div class="title_right">
				<div class="col-md form-group pull-right top_search">
					<form action="<?= site_url('admin/rute'); ?>" method="POST">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search keyword..." name="keyword" autocomplete="off" autofocus>
							<div class="input-group-append">
								<input class="btn btn-primary" type="submit" name="submit">
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="panel-body">
				<form action="<?php echo site_url('admin/tambahin') ?>" method="POST">
					<div class="form-group">
						<br><br><br><br><button type="submit" name="submit" class="btn btn-danger">Tambahkan Tujuan</button>
					</div>
					<div class="table-responsive">
						<h6>Result : <?= $total_rows; ?></h6>
						<table class="table table-striped jambo_table bulk_action">
							<thead>
								<?php if ($itempaket->num_rows()) { ?>
									<tr class="headings">
										<th>#</th>
										<th class="column-title">Wilayah</th>
										<th class="column-title">No. Resi</th>
										<th class="column-title">Nama Penerima </th>
										<th class="column-title">Alamat </th>
										<th class="column-title">Jenis Paket </th>
										<th class="column-title">Tanggal </th>
									</tr>
								<?php } ?>
							</thead>
							<tbody>
								<?php if (empty($itempaket->result())) : ?>
									<tr>
										<td colspan="12">
											<div class="alert alert-danger" role="alert">
												Data tidak ditemukan! Masukkan keyword berdasarkan No. Resi, Nama Penerima, atau Alamat Paket.
											</div>
										</td>
									</tr>
								<?php endif; ?>
								<?php $i = 1;
								foreach ($itempaket->result() as $paket) { ?>
									<tr>
									<tr class="even pointer">
										<td class="a-center ">
											<input type="checkbox" name="id_paket[]" class="flat" value="<?php echo $paket->id_paket; ?>" <?php if ($paket->id_paket == $paket->tujuan) {
																																				echo 'cheked disabled';
																																			} ?>>
										</td>
										<td><?php echo $paket->wilayah; ?></td>
										<td><?php echo $paket->kode_paket; ?></td>
										<td><?php echo $paket->nama_penerima; ?></td>
										<td><?php echo $paket->alamat; ?></td>
										<td><?php echo $paket->jenis; ?></td>
										<td><?php echo $paket->tanggal; ?></td>
									</tr>
									</tr>
								<?php $i++;
								} ?>
							</tbody>
						</table>
					</div>
					<?= $this->pagination->create_links(); ?>
				</form>
			</div>
		</div>
	</div>
</div>
<br><br><br><br><br><br>
<div class="col-md-4 col-sm-4">
	<!--form-->
	<?php if ($sukses = $this->session->flashdata('hapus')) { ?>
		<div class="alert alert-success" id="msg">
			<a class="close" data-dismiss="alert">&times;</a>
			<?php echo $sukses; ?>
		</div>
	<?php } ?>
	<?php if ($sukses = $this->session->flashdata('jrk')) { ?>
		<div class="alert alert-success" id="msg">
			<a class="close" data-dismiss="alert">&times;</a>
			<?php echo $sukses; ?>
		</div>
	<?php } ?>
	<?php if ($sukses = $this->session->flashdata('ggl')) { ?>
		<div class="alert alert-danger" id="msg">
			<a class="close" data-dismiss="alert">&times;</a>
			<?php echo $sukses; ?>
		</div>
	<?php } ?>
	<?php if ($sukses = $this->session->flashdata('gagal')) { ?>
		<div class="alert alert-danger" id="msg">
			<a class="close" data-dismiss="alert">&times;</a>
			<?php echo $sukses; ?>
		</div>
	<?php } ?>
	<?php if ($sukses = $this->session->flashdata('matriks')) { ?>
		<div class="alert alert-danger" id="msg">
			<a class="close" data-dismiss="alert">&times;</a>
			<?php echo $sukses; ?>
		</div>
	<?php } ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2 class="panel-title">Pencarian Rute</h2>
		</div>
		<br>
		<div class="form-group">
			<label for="lokasi_awal">Tujuan yang dipilih</label>
		</div>
		<?php echo form_open('admin/hapuscek'); ?>
		<input type="submit" value="Delete" onclick="return confirm('Anda yakin ingin menghapus data yang diceklis?')">
		<table class="table table-striped jambo_table bulk_action">
			<thead>
				<?php if ($itemtujuan->num_rows() != null) {
					echo "<table class='table table-bordered'>";
					echo "<th>#</th>";
					echo "<th>No.</th>";
					echo "<th>No. Resi</th>";
					echo "<th>Jenis</th>";
					echo "<th>Tanggal</th>";
				} ?>
			</thead>
			<tbody>
				<?php $i = 1;
				foreach ($itemtujuan->result() as $tujuan) { ?>
					<tr>
					<tr class="even pointer">
						<td class="a-center ">
							<input type="checkbox" name="id_tujuan[]" class="flat" value="<?php echo $tujuan->id_tujuan ?>">
						</td>
						<td><?php echo $i++; ?></td>
						<td><?php echo $tujuan->kode_paket; ?></td>
						<td><?php echo $tujuan->jenis; ?></td>
						<td><?php echo $tujuan->tanggal; ?></td>
					</tr>
					</tr>
				<?php
				} ?>
			</tbody>
		</table>

		<?php echo form_close() ?>
		<div class="form-group">
			<br><a href="<?= site_url('admin/pecahjarak'); ?>" id="carirute" class="btn btn-warning">Buat Matriks Tujuan</a>
			<a href="<?= site_url('admin/hasil'); ?>" id="carirute" class="btn btn-primary">Cari Rute</a>
		</div>
	</div>
</div>


<!--peta-->
<div class="col-md-12 col-sm-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2 class="panel-title"><span class="fa fa-globe"></span> Peta</h2>
			<br>
			<div class="panel-body">
				<div class="col-md-12 col-sm-20" style="height:480px;" id="mapid">
				</div>
			</div>
		</div>
	</div>
</div>



<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

<script type="text/javascript">
	mapboxgl.accessToken = 'pk.eyJ1IjoiZmF0aW1haHRpbXMiLCJhIjoiY2tpczdudGY5MDhuMTJycm9pYzlxajgyNSJ9.aEUba4upWig3GI4VRt6o0A';
	var map = L.map('mapid').setView([-5.200274, 119.4893095], 14);
	L.gridLayer.googleMutant({
			maxZoom: 24,
			type: "hybrid",
		})
		.addTo(map);

	L.polygon([
		[-5.191239903276673, 119.49208974838258],
		[-5.189402110012546, 119.49530839920045],
		[-5.1982704815461425, 119.50644493103029],
		[-5.200898914669675, 119.50238943099977],
		[-5.200321942484995, 119.48887109756471],
		[-5.190235528551671, 119.4782066345215],
		[-5.185683767734094, 119.4807815551758],
		[-5.18690184778982, 119.48657512664796],
		[-5.188547320623563, 119.48668241500856]
	]).addTo(map).bindPopup("<h6>Wilayah 1</h6> Jl. Karaeng Makkawari <br>Jl. Veteran Bakung<br> Jl. Sungai Dg. Ngemba<br> Perumahan Griya Antang<br> Royal Spring");

	L.polygon([
		[-5.201005761312503, 119.50236797332764],
		[-5.202693935861899, 119.51266765594484],
		[-5.204339367456544, 119.5159935951233],
		[-5.214746088311632, 119.51524257659914],
		[-5.212416878287687, 119.4862747192383],
		[-5.206454916039473, 119.47934389114381],
		[-5.198591022758404, 119.48601722717287],
		[-5.200535635948382, 119.48876380920412]
	]).addTo(map).bindPopup("<h6>Wilayah 2</h6> Jl. Mustafa Daeng Bunga <br>Jl. Macanda <br>Jl. Sultan Alauddin <br>Kampus II Uin Alauddin Makasar");

	L.polygon([
		[-5.198569653349324, 119.48588848114015],
		[-5.206305332030051, 119.47917222976686],
		[-5.200321942484995, 119.46859359741212],
		[-5.195086429980184, 119.46850776672363],
		[-5.182542392535188, 119.47477340698244],
		[-5.185705137579889, 119.48060989379884],
		[-5.190385116378039, 119.47803497314455]
	]).addTo(map).bindPopup("<h6>Wilayah 3</h6> Jl. Tun abdul Razak<br> Jl. Abdul Mutalib Dg. Narang<br> Paccinongan");

	L.polygon([
		[-5.194788, 119.468418],
		[-5.194765886984751, 119.46177005767824],
		[-5.177947836053143, 119.46365833282472],
		[-5.179422371773014, 119.47078227996828],
		[-5.18244622774181, 119.47469830513002]
	]).addTo(map).bindPopup("<h6>Wilayah 4</h6> Pao-Pao <br>Jalan Karaeng Sero");


	<?php foreach ($marker as $key => $value) { ?>
		L.marker([<?= $value->latitude ?>, <?= $value->longitude ?>])
			.bindPopup("Nama Penerima: <?= $value->nama_penerima ?><br>Alamat: <?= $value->alamat ?>")
			.bindTooltip("No. Resi: <?= $value->kode_paket ?>", {
				permanent: true,
				direction: top
			}).addTo(map);
	<?php } ?>
</script>