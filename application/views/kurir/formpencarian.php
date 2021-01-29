<div class="container-fluid">
    <div class="col-md-6 col-sm-6">
        <!--form-->
        <?php if ($sukses = $this->session->flashdata('gagal')) { ?>
            <div class="alert alert-danger" id="msg">
                <a class="close" data-dismiss="alert">&times;</a>
                <?php echo $sukses; ?>
            </div>
        <?php } ?>
        <?php if ($sukses = $this->session->flashdata('konfirmasi')) { ?>
            <div class="alert alert-success" id="msg">
                <a class="close" data-dismiss="alert">&times;</a>
                <?php echo $sukses; ?>
            </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Pencarian Rute</h2>
            </div>
            <div class="form-group">
                <div class="panel-body">
                    <label for="lokasi_awal">Tujuan yang dipilih</label>
                    <?php if ($itemtujuan->num_rows() != null) {
                        $no = 1; ?>
                        <br><br>
                        <table class="table table-bordered">
                            <th>No</th>
                            <th>No. Resi</th>
                            <th>Nama Penerima</th>
                            <th>Alamat</th>
                            <th>Jenis Paket</th>
                            <th>Wilayah</th>
                        <?php } ?>
                        <?php foreach ($itemtujuan->result() as $tujuan) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $tujuan->kode_paket ?></td>
                                <td><?= $tujuan->nama ?></td>
                                <td><?= $tujuan->alamat ?></td>
                                <td><?= $tujuan->jenis ?></td>
                                <td><?= $tujuan->wilayah ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </table>
                        <div class="form-group">
                            <br><a href="<?= site_url('kurir/hasil') ?>" id="carirute" class="btn btn-primary">Cari Rute</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!--peta-->
    <div class="col-md-6 col-sm-6">
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


    <?php foreach ($itemrute as $key => $value) { ?>
        L.marker([<?= $value->latitude ?>, <?= $value->longitude ?>])
            .bindPopup("<h5><b>No. Resi: <?= $value->kode_paket ?> </b></h5> <h6>Nama Penerima: <?= $value->nama_penerima ?>")
            .bindTooltip("No. Resi: <?= $value->kode_paket ?>", {
                permanent: true,
                direction: top
            }).addTo(map);
    <?php } ?>
</script>