<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Laporan Beli</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="backend/assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="backend/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="backend/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="backend/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="backend/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="backend/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="backend/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="backend/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="backend/assets/css/style.css" rel="stylesheet">
  

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <i class="bi bi-list toggle-sidebar-btn"></i>
      <a href="index.html" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">Rushbin</span>
      </a>
      
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <!-- Notification Dropdown Items -->
          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <!-- Messages Dropdown Items -->
          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        @include('test.components.dropdown')

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  @include('test.components.sidebar')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Pickup</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Pickup</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <div class="card text-center">
                <div class="card-header">
                <form action="{{ route('pickup') }}" method="GET" class="mt-3">
                          <div class="row justify-content-end">
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>&nbsp;</label>
                                      <div class="input-group">
                                          <input type="text" name="keyword" class="form-control" placeholder="Cari..." value="{{ $keyword ?? '' }}">
                                          <div class="input-group-append">
                                              <button type="submit" class="btn btn-primary">Cari</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </form>
                    <ul class="nav nav-pills card-header-pills">
                    </ul>
                    <h5 class="card-title"></h5>
                {{-- data Pickup --}}
                <div class="table-responsive">
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Id Pengantaran</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>Tanggal</th>
                        <th>order</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($pickup->orderBy('status')->get() as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->id_pengantaran }}</td>
                            <td>{{ $p->nama_lengkap }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td>{{ $p->tanggal }}</td>
                            <td>
                            <!-- <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editModal-{{ $p->id_pengantaran }}">
                                        Detail
                                    </button> -->
                            {{-- <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal-{{ $p->id_pengantaran }}" onclick="redirectToDetail('{{ route('pickup.getBlobImage', ['id_pengantaran' => $p->id_pengantaran]) }}')">
    Detail
</button> --}}
                                @if ($p->status == 1)
                                    <form action="{{ route('pickup.pengantaran.selesai', $p->id_pengantaran) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">Selesai</button>
                                    </form>
                                @elseif ($p->status == 2)
                                    <form action="{{ route('pickup.pengantaran.batal', $p->id_pengantaran) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-danger">Batalkan</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @include('test.components.modalpickup')
                    @endforeach
                </tbody>
            </table>

                </div>
            </div>
        </div>
    </section>

    <section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-8">
        <div class="row">
            <!-- Left side content -->
        </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
        <!-- Right side content -->
        </div><!-- End Right side columns -->

    </div>
    </section>

</main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="backend/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="backend/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="backend/assets/vendor/echarts/echarts.min.js"></script>
  <script src="backend/assets/vendor/quill/quill.min.js"></script>
  <script src="backend/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="backend/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="backend/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <!-- <script src="backend/assets/js/main.js"></script>
  <script>
    function redirectToDetail(route) {
        window.location.href = route;
    }
</script> -->
  

</body>

</html>