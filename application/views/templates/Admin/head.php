<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Bootstrap -->
  <link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="assets/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- JQVMap -->
  <link href="assets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
  <!-- jQuery custom content scroller -->
  <link href="assets/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet" />
  <!-- bootstrap-daterangepicker -->
  <link href="assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

  <title><?= $judul ?></title>

  <!-- Custom Theme Style -->
  <link href="assets/build/css/custom.min.css" rel="stylesheet">

  <!--peta-->
  <script src="<?= base_url('assets/leaflet/leaflet.js') ?>"></script>
  <link href="<?= base_url('assets/leaflet/leaflet.css') ?>" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
  <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.44.2/mapbox-gl.js'></script>
  <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.44.2/mapbox-gl.css' rel='stylesheet' />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
  <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
  <link rel="stylesheet" href="assets/routing/dist/leaflet-routing-machine.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" />
  <link rel="stylesheet" href="assets/search/src/leaflet-search.css" />
  <script src="assets/search/src/leaflet-search.js"></script>
  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
  <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.45.0/mapbox-gl.js'></script>
  <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.45.0/mapbox-gl.css' rel='stylesheet' />
  <!-- google mutant-->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaG3FmJKAG_T5VCEJvKNrD9Y8p-_vSEAQ" async defer></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="assets/googlemutant/Leaflet/dist/leaflet.css" />
  <script type="text/javascript" src="assets/googlemutant/Leaflet/dist/leaflet-src.js"></script>
  <script type="text/javascript" src="assets/googlemutant/dist/Leaflet.GoogleMutant.js"></script>
</head>

<body class="nav-md">