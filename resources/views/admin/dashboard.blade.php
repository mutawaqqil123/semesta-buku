<x-template>
    <x-slot:title>Admin Semesta Buku - Dashboard</x-slot:title>
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3> Selamat Datang</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">Welcome</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid default-page">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card profile-greeting">
                        <div class="card-body">
                            <div>
                                <h1>Welcome, {{ auth()->user()->name }}</h1>
                                <p> Selamat datang di Dasboard Semesta buku by PT. Semesta Infomedia Indonesia</p>
                                {{-- <a class="btn" href="{{ route('book.index') }}">Continue<i data-feather="arrow-right"></i></a> --}}
                            </div>
                            <div class="greeting-img">
                                <img class="img-fluid" src="{{ asset('') }}assets/images/dashboard/profile-greeting/bg.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-xl-7 col-lg-7">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Jumlah Buku</h5>
                                    <p class="card-text">{{ $jumlahBuku }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Jumlah User</h5>
                                    <p class="card-text">{{ $jumlahUser }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Jumlah Subscription Aktif</h5>
                                    <p class="card-text">{{ $subs->where('status', 'active')->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Jumlah Subscription</h5>
                                    <p class="card-text">{{ $subs->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            {{-- <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Buku Terbaru</h5>
                            <ul class="list-group">
                                @foreach($bukuTerbaru as $buku)
                                    <li class="list-group-item">{{ $buku->title }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <!-- Container-fluid Ends-->
    </div>
</x-template>
