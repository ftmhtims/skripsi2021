<form action="<?php echo site_url('kurir/daftar') ?>" method="POST">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><span class="fa fa-map-marker"></span> Daftar Paket</h2>
            </div><br>

            <div class="col-md-5">
                <form action="<?= base_url('kurir/daftar'); ?>" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search keyword..." name="keyword" autocomplete="off" autofocus>
                        <input class="btn btn-primary" type="submit" name="submit">
                    </div>
                </form>
            </div>

            <div class="panel-body">
                <h6> Result : <?= $total_rows; ?> </h6>
                <?php if ($itempaket->num_rows()) {
                    echo "<table class='table table-bordered'>";
                    echo "<th>No</th>";
                    echo "<th>No. Resi</th>";
                    echo "<th>Nama Penerima</th>";
                    echo "<th>Alamat Penerima</th>";
                    echo "<th>Jenis Paket</th>";
                    echo "<th>Tanggal</th>";
                    echo "<th>Wilayah</th>";
                } ?>
                <tbody id="daftarpaket">
                    <?php foreach ($itempaket->result() as $paket) : ?>
                        <tr>
                            <td><?= ++$start ?></td>
                            <td><?= $paket->kode_paket ?></td>
                            <td><?= $paket->nama_penerima ?></td>
                            <td><?= $paket->alamat ?></td>
                            <td><?= $paket->jenis ?></td>
                            <td><?= $paket->tanggal ?></td>
                            <td><?= $paket->wilayah ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <?php echo "</table>"; ?>
            </div>
            <?php if (empty($itempaket->result())) : ?>
                <tr>
                    <td colspan="12">
                        <div class="alert alert-danger" role="alert">
                            Data tidak ditemukan! Masukkan keyword berdasarkan No. Resi, Jenis Paket, atau Tanggal Paket.
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            <div class="container-fluid">
                <?= $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</form>
<!--peta-->
<div class="col-md-12 col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title"><span class="fa fa-globe"></span> Peta</h2>
        </div>
        <br>
        <div class="panel-body">
            <iv class="row">
                <div class="col-md-12 col-sm-12" style="width:100%; height:600px;" id="mapid">
                </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript">
    //peta	
    var map = L.map('mapid').setView([-5.200274, 119.4893095], 14);
    L.gridLayer.googleMutant({
            maxZoom: 24,
            type: "hybrid",
        })
        .addTo(map);

    var data = [
        <?php foreach ($itemdaftar as $key => $value) : ?>

            {
                "lokasi": [<?= $value->latitude ?>, <?= $value->longitude ?>],
                "idpaket": "<?= $value->kode_paket ?>"
            },

        <?php endforeach; ?>

    ];
    //search paket tujuan
    var markersLayer = new L.LayerGroup(); //layer contain searched elements

    map.addLayer(markersLayer);

    var controlSearch = new L.Control.Search({
        position: 'topleft',
        layer: markersLayer,
        initial: false,
        zoom: 16,
        marker: false
    });
    map.addControl(new L.Control.Search({
        layer: markersLayer,
        initial: false,
        collapsed: true,
    }));
    //inizialize search control

    //menampilkan data pada pencarian
    for (i in data) {
        var idpaket = data[i].idpaket, //value searched
            lokasi = data[i].lokasi, //position found
            marker = new L.Marker(new L.latLng(lokasi), {
                title: idpaket
            }); //se property searched
        marker.bindPopup('No. Resi: ' + idpaket);
        markersLayer.addLayer(marker);
    }
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
    <?php foreach ($itemdaftar as $key => $value) { ?>
        L.marker([<?= $value->latitude ?>, <?= $value->longitude ?>])
            .bindPopup("<h5><b>No. Resi: <?= $value->kode_paket ?> </b></h5> <h6>Nama Penerima: <?= $value->nama_penerima ?> <br>Alamat Paket: <?= $value->alamat ?>")
            .addTo(map);
    <?php } ?>
</script>