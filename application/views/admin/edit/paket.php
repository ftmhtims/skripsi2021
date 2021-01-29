<div class="container-fluid">
	<div class="col-md-4 col-sm-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">Form Paket</h2>
				<br>
			</div>
			<div class="panel-body">
				<form action="<?php echo site_url('admin/update') ?>" method="POST">
					<?php
					if ($itempaket->num_rows() != null) {
						foreach ($itempaket->result() as $paket) {
							echo '<div class="form-group">';
							echo '<label for="kode_paket">No. Resi</label>';
							echo '<input type="text" name="kode_paket" value="' . $paket->kode_paket . '" class="form-control" readonly>';
							echo '</div>';
							echo '<div class="form-group">';
							echo '<label for="nama_penerima">Nama Penerima</label>';
							echo '<input type="text" name="nama_penerima" value="' . $paket->nama_penerima . '" class="form-control" required>';
							echo '</div>';
							echo '<div class="form-group">';
							echo '<label for="alamat">Alamat</label>';
							echo '<input type="text" name="alamat" value="' . $paket->alamat . '" class="form-control" required>';
							echo '</div>';
							echo '<div class="form-group">';
							echo '<label for="jenis">Jenis Paket</label>';
							echo '<select name="jenis" class="form-control" value="" required>';
							if ($paket->jenis == 'Express') {
								echo "<option value='Express' selected>Express</option>
								<option value='Reguler'>Reguler</option>";
							} else {
								echo "<option value='Express' >Express</option>
								<option value='Reguler' selected>Reguler</option>";
							}
							echo "</select>";
							echo '</div>';
						}
					} ?>
					<div class="form-group">
						<label for="tanggal">Tanggal Paket</label>
						<input class="date-picker form-control" name="tanggal" value="<?= $paket->tanggal  ?>" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
						<script>
							function timeFunctionLong(input) {
								setTimeout(function() {
									input.type = 'text';
								}, 60000);
							}
						</script>
					</div>
					<?php {
						echo '<div class="form-group">';
						echo '<label for="latitude">Latitude</label>';
						echo '<input type="text" name="latitude" id="latitude" value="' . $paket->latitude . '" class="form-control" required>';
						echo '</div>';
						echo '<div class="form-group">';
						echo '<label for="longitude">Longitude</label>';
						echo '<input type="text" name="longitude" id="longitude" value="' . $paket->longitude . '" class="form-control" required>';
						echo '</div>';
						echo '<div class="form-group">';
						echo '<label for="wilayah">Wilayah Paket</label>';
						echo '<select name="wilayah" class="form-control" value="" required>';
						if ($paket->wilayah == 'Wilayah 1') {
							echo "<option value='Wilayah 1' selected>Wilayah 1</option>
							<option value='Wilayah 2'>Wilayah 2</option>
							<option value='Wilayah 3'>Wilayah 3</option>
							<option value='Wilayah 4'>Wilayah 4</option>";
						} elseif ($paket->wilayah == 'Wilayah 2') {
							echo "<option value='Wilayah 1'>Wilayah 1</option>
							<option value='Wilayah 2' selected>Wilayah </option>
							<option value='Wilayah 3'>Wilayah 3</option>
							<option value='Wilayah 4'>Wilayah 4</option>";
						} elseif ($paket->wilayah == 'Wilayah 3') {
							echo "<option value='Wilayah 1'>Wilayah 1</option>
							<option value='Wilayah 2'>Wilayah 2</option>
							<option value='Wilayah 3' selected>Wilayah 3</option>
							<option value='Wilayah 4'>Wilayah 4</option>";
						} else {
							echo "<option value='Wilayah 1'>Wilayah 1</option>
							<option value='Wilayah 2'>Wilayah 2</option>
							<option value='Wilayah 3'>Wilayah 3</option>
							<option value='Wilayah 4' selected>Wilayah 4</option>";
						}
						echo '</select>';
						echo '</div>';
					} ?>
					<br>

					<?php {
						echo '<div class="form-group">';
						echo '<input type="submit" value="update" class="btn btn-primary">';
					} ?>
					<a href="<?php echo site_url('admin/daftar') ?>"><button type="button" class="btn btn-danger">Batal</button></a>
					<?php {
						echo '</div>';
					} ?>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="col-md-7 col-sm-7">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2 class="panel-title"><span class="fa fa-globe"></span> Peta</h2>
			<br>
			<div class="panel-body">
				<div class="col-md-12 col-sm-20" style="width:100%; height:580px;" id="mapid">
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<script type="text/javascript">
	var curlocation = [0, 0];
	if (curlocation[0] == 0 && curlocation[1] == 0) {
		<?php foreach ($itempaket->result() as $paket) : ?>
			curlocation = [<?= $paket->latitude ?>, <?= $paket->longitude ?>];
		<?php endforeach; ?>
	}
	//peta	
	var map = L.map('mapid').setView([-5.199984456918315, 119.48899535927924], 14);
	var hybridMutant = L.gridLayer.googleMutant({
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

	map.attributionControl.setPrefix(false);

	var marker = new L.marker(curlocation, {
		draggable: 'true'
	});

	marker.on('dragend', function(event) {
		var position = marker.getLatLng();
		marker.setLatLng(position, {
			draggable: 'true'
		}).bindPopup(position).update();
		$("#latitude").val(position.lat);
		$("#longitude").val(position.lng).keyup();
	});

	$("#latitude,#longitude").change(function() {
		var position = [parseInt($("#latitude").val()), parseInt($("#longitude").val())];
		marker.setLatlng(position, {
			draggable: 'true'
		}).bindPopup(position).update();
		map.panTo(position);
	});
	map.addLayer(marker);
</script>