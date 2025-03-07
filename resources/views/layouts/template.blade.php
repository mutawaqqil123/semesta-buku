<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Semesta Buku adalah perpustakaan digital dan online yang dikelola oleh Semesta Infomedia Indonesia, menyediakan berbagai koleksi buku digital untuk masyarakat Indonesia.">
  <meta name="keywords"
    content="turbo main, semesta buku, semesta infomedia indonesia, perpustakaan, perpustakaan digital, perpustakaan online, perpustakaan digital indonesia, perpustakaan online indonesia, perpustakaan digital semesta buku, perpustakaan online semesta buku, perpustakaan digital indonesia semesta buku, perpustakaan online indonesia semesta buku">
  <meta name="author" content="Abd. Rahman Siddik">
  <link rel="icon" href="{{ asset('Logo-Semesta-Buku.webp') }}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ asset('Logo-Semesta-Buku.webp') }}" type="image/x-icon">
  <title>{{ $title }}</title>
  <!-- Google font-->
  <x-template.style></x-template.style>
</head>

<body>
  <!-- tap on top starts-->
  <div class="tap-top"><i data-feather="chevrons-up"></i></div>
  <!-- tap on tap ends-->
  <!-- Loader starts-->
  <div class="loader-wrapper">
    <div class="loader"></div>
  </div>
  <!-- Loader ends-->
  <!-- page-wrapper Start-->
  <div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    <x-template.header></x-template.header>
    <!-- Page Header Ends                              -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
      <!-- Page Sidebar Start-->
      <x-template.sidebar></x-template.sidebar>
      <!-- Page Sidebar Ends-->
      {{ $slot }}
      <!-- footer start-->
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-10 p-0 footer-left">
              <p class="mb-0">Copyright 2022 © by <a href="https://turbo-main.com">Turbo Main</a></p>
            </div>
            <div class="col-2 p-0 footer-right"> <i class="fa fa-heart font-danger"> </i></div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <x-template.script></x-template.script>
  <x-template.alert></x-template.alert>
</body>

</html>
