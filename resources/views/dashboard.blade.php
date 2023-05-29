<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
      <h1>Daftar Sampah</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Daftar Sampah</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#basicModal">
                                Tambah Data
                            </button>
                        </li>
                    </ul>

                    @include('test.components.modaltambah')

                    <h5 class="card-title">Daftar Sampah</h5>
                {{-- data Daftar Sampah --}}
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Sampah</th>
                                <th>Jenis Sampah</th>
                                <th>Jumlah Sampah</th>
                                <th>Point Per KG</th>
                                <th>Harga Per KG</th>
                                <th>Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftar_sampah as $ds)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ds->nama_sampah }}</td>
                                <td>{{ $ds->jenis_sampah }}</td>
                                <td>{{ $ds->jumlah_sampah }}</td>
                                <td>{{ $ds->point }}</td>
                                <td>{{ $ds->harga_jual }}</td>
                                
                                <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editModal-{{ $ds->id_sampah }}">
                                        Edit
                                    </button>
                                    <form action="{{ route('daftarsampah.destroy', $ds->id_sampah) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>

                            @include('test.components.modaledit')

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
  <script src="backend/assets/js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    // Toast ketika berhasil melakukan tambah banner
    toastr.options.progressBar = true;
    @if (Session::has('berhasilLogin'))
        toastr.success("{{ Session::get('berhasilLogin') }}");
    @endif
</script>

</body>

</html>

