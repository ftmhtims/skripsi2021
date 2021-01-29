<?php error_reporting(0);
?>
<div class="container-fluid">
    <div class="col-md-5 col-sm-5">
        <div class="panel-heading">
            <h2 class="panel-title">Hasil Pencarian Rute</h2>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <?php
                $hasil = "";
                $awal = "1";
                $start = $awal;
                $a = $awal;
                ?>
                <th>Rute</th>
                <th>Tujuan yang dipilih</th>
                <?php
                $j = 0;
                foreach ($algo as $i) {
                    echo '<tr>';
                    $hasil = $hasil . "-" . $i['b'];
                    echo '<td>'  . $i['b'] .  '</td>';
                    echo '<td>'  . $a .  '</td>';
                    echo '</tr>';
                    $a = $a . "-" . $i['b'];
                    $j++;
                }
                $hasil = $start . $hasil ?>
            </table>
            <table class="table table-bordered">
                <th>Rute yang dihasilkan</th>
                <tr>
                    <td> <?= $hasil; ?> </td>
                </tr>
            </table>
            <div class="form-group">
                <br><a href="<?= site_url('kurir/konfirmasi') ?>" onclick="return confirm('Perhatian!!! Rute sudah tidak tersedia jika konfirmasi berhasil. Tetap lanjutkan konfirmasi?')" id="carirute" class="btn btn-primary">Konfirmasi</a>
                <br><i>*klik tombol 'konfirmasi' untuk memberitahu admin bahwa anda telah melihat rute.</i>
            </div>
        </div>
    </div>
    <div class="col-md-7 col-sm-7">
        <div class="panel-heading">
            <h2 class="panel-title">Tabel Informasi Tujuan</h2>
        </div>
        <div class="panel-body">
            <?php if ($titiktujuan->num_rows() != null) {
            ?>
                <table class="table table-bordered">
                    <th>ID Rute</th>
                    <th>No. Resi</th>
                    <th>Nama Penerima</th>
                    <th>Alamat</th>
                <?php } ?>
                <?php foreach ($titiktujuan->result() as $tujuan) : ?>
                    <tr>
                        <td><?= $tujuan->id_paket ?></td>
                        <td><?= $tujuan->kode_paket ?></td>
                        <td><?= $tujuan->nama_penerima ?></td>
                        <td><?= $tujuan->alamat ?></td>
                    </tr>
                <?php endforeach; ?>
                </table>
        </div>
    </div>

    <!--peta-->
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><span class="fa fa-globe"></span> Peta</h2>
                <br>
                <div class="panel-body">
                    <div class="col-md-12 col-sm-20" style="height:800px;" id="mapid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/routing/examples/Control.Geocoder.js"></script>
<script>
    //data paket tujuan
    var data = [
        <?php foreach ($marker as $key => $value) : ?>

            {
                "lokasi": [<?= $value->latitude ?>, <?= $value->longitude ?>],
                "idpaket": "<?= $value->kode_paket ?>"
            },

        <?php endforeach; ?>

    ];
    //peta
    var map = L.map('mapid').setView([-5.200274, 119.4893095], 14);
    L.gridLayer.googleMutant({
            maxZoom: 24,
            type: "hybrid",
        })
        .addTo(map);

    var tileLayer_Mapbox_OSM = L.tileLayer(
        'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZmF0aW1haHRpbXMiLCJhIjoiY2tpczdudGY5MDhuMTJycm9pYzlxajgyNSJ9.aEUba4upWig3GI4VRt6o0A', {
            maxZoom: 18,
            minZoom: 14,
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="http://mapbox.com">Mapbox</a>',
            id: 'mapbox.light'
        });

    var tileLayer_OSM = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',

    });
    var baseMaps = {
        "Satelit": tileLayer_Mapbox_OSM,
        "Street": tileLayer_OSM
    };
    L.control.layers(baseMaps).addTo(map);

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

    <?php foreach ($marker as $key => $value) { ?>
        L.marker([<?= $value->latitude ?>, <?= $value->longitude ?>])
            .bindPopup("<h6>No. Resi: <?= $value->kode_paket ?></h6>" +
                "<h7>Nama Penerima: <?= $value->nama_penerima ?></h7>" +
                "<br><br><button class='btn btn-info' onclick='return kesini(<?= $value->latitude ?>,<?= $value->longitude ?>)'>Ke Sini</button>")

            .bindTooltip("ID Rute: <?= $value->id_paket ?>", {
                permanent: true,
                direction: top
            }).addTo(map);

    <?php } ?>

    //kontrol panel
    var control = L.Routing.control({
        waypoints: [
            L.latLng(-5.199561549268475, 119.48919177051724)
        ],

        geocoder: L.Control.Geocoder.nominatim(),
        routeWhileDragging: true,
        reverseWaypoints: true,
        showAlternatives: true,
        altLineOptions: {
            styles: [{
                    color: 'black',
                    opacity: 0.15,
                    weight: 9
                },
                {
                    color: 'white',
                    opacity: 0.8,
                    weight: 6
                },
                {
                    color: 'blue',
                    opacity: 0.5,
                    weight: 2
                }
            ]
        }
    })
    control.addTo(map);
    //kontrol button
    function kesini(latitude, longitude) {
        var latlng = L.latLng(latitude, longitude);
        control.spliceWaypoints(control.getWaypoints().length - 1, 1, latlng);
    }
</script>