<div class="container-fluid">
	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
	<!--form-->
	<div class="col-md-4 col-sm-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title"><span class="fa fa-map-marker"></span> Form Paket</h2>
			</div>
			<div class="panel-body">
				<?= $this->session->flashdata('message'); ?>
				<form action="<?php echo site_url('admin/tambah') ?>" method="POST">
					<div class="form-group">
						<label for="kode_paket">No. Resi</label>
						<br><input type="text" name="kode_paket" class="form-control" id="kode_paket" required>
						<?= form_error('kode_paket', '<small class="text-danger">', '</small>'); ?>
					</div>

					<div class="form-group">
						<label for="nama_penerima">Nama Penerima</label>
						<br><input type="text" name="nama_penerima" class="form-control" id="nama_penerima" required>
						<?= form_error('nama_penerima', '<small class="text-danger">', '</small>'); ?>
					</div>

					<div class="form-group">
						<label for="alamat">Alamat</label>
						<br>
						<textarea name="alamat" id="alamat" cols="5" rows="5" class="form-control" required></textarea>
						<?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
					</div>

					<div class="form-group">
						<label for="jenis">Jenis Paket</label>
						<select name="jenis" class="form-control" id="jenis" required>
							<option value="">Jenis Paket
							<option value="Express">Express</option>
							<option value="Reguler">Reguler</option>
							</option>
						</select>
					</div>

					<div class="form-group">
						<label for="tanggal">Tanggal Paket</label>
						<input class="date-picker form-control" name="tanggal" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
						<script>
							function timeFunctionLong(input) {
								setTimeout(function() {
									input.type = 'text';
								}, 60000);
							}
						</script>
					</div>

					<div class="form-group">
						<label for="latitude">Latitude</label>
						<br><input type="text" name="latitude" class="form-control" id="latitude" required>
					</div>

					<div class="form-group">
						<label for="longitude">Longitude</label>
						<br><input type="text" name="longitude" class="form-control" id="longitude" required>
					</div>

					<div class="form-group">
						<label for="wilayah">Wilayah Paket</label>
						<select name="wilayah" class="form-control" id="wilayah" required>
							<option value="">Pilih Wilayah
							<option value="Wilayah 1">Wilayah 1</option>
							<option value="Wilayah 2">Wilayah 2</option>
							<option value="Wilayah 3">Wilayah 3</option>
							<option value="Wilayah 4">Wilayah 4</option>
							</option>
						</select>
					</div>

					<div class="form-group">
						<br><input type="submit" id="simpanpaket" value="Simpan" class="btn btn-primary">

				</form>
				<button class="btn btn-warning"><a href="<?php echo site_url('admin/daftar') ?>">Lihat daftar paket</a></button>
			</div>
		</div>
	</div>
</div>
<!--peta-->
<div class="col-md-8 col-sm-8">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2 class="panel-title"><span class="fa fa-globe"></span> Peta</h2>
		</div>
		<br>
		<div class="panel-body">
			<div id="mapid" class="col-md-12 col-sm-12" style="width:100%; height:670px;">
			</div>
		</div>
		<br>
		<!--<div class="form-group">
			<button type="button" class="btn btn-danger" id="resetmarkerpaket" name="resetmarkerpaket">Reset Marker</button>
		</div>-->
	</div>
</div>
<!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;key=AIzaSyBaG3FmJKAG_T5VCEJvKNrD9Y8p-_vSEAQ">
	var map;
	var markers = [];

	function initialize() {
		var mapOptions = {
			zoom: 15,
			// Center di kantor Jnt samata
			center: new google.maps.LatLng(-5.200274, 119.4893095)
		};

		map = new google.maps.Map(document.getElementById('mapid'), mapOptions);

		// Add a listener for the click event
		google.maps.event.addListener(map, 'rightclick', addLatLng);
		google.maps.event.addListener(map, "rightclick", function(event) {
			var lat = event.latLng.lat();
			var lng = event.latLng.lng();
			$('#latitude').val(lat);
			$('#longitude').val(lng);
			//alert(lat +" dan "+lng);
		});
	}

	function addLatLng(event) {
		var marker = new google.maps.Marker({
			position: event.latLng,
			title: 'Paket',
			map: map
		});
		markers.push(marker);
	}

	// Menampilkan marker lokasi paket
	function addMarker(nama, location) {
		var marker = new google.maps.Marker({
			position: location,
			map: map,
			title: nama
		});
		markers.push(marker);
	}
	//membersihkan peta dari marker
	function clearmap() {
		//e.preventDefault();
		$('#latitude').val('');
		$('#longitude').val('');
		setMapOnAll(null);
	}
	//buat hapus marker
	function setMapOnAll(map) {
		for (var i = 0; i < markers.length; i++) {
			markers[i].setMap(map);
		}
		markers = [];
	}

	google.maps.event.addDomListener(window, 'load', initialize);

	$(document).on('click', '#clearmap', clearmap)
		.on('click', '#resetmarkerpaket', resetmarkerpaket);

	function resetmarkerpaket() {
		$('#latitude').val('');
		$('#longitude').val('');
		clearmap();
	}
</script>-->
<script type="text/javascript">
	var curlocation = [0, 0];
	if (curlocation[0] == 0 && curlocation[1] == 0) {
		curlocation = [-5.199984456918315, 119.48899535927924];
	}
	//peta	
	var map = L.map('mapid').setView([-5.199984456918315, 119.48899535927924], 14);
	var hybridMutant = L.gridLayer.googleMutant({
			maxZoom: 24,
			type: "hybrid",
		})
		.addTo(map);
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
</script>