<div class="sidebar" data-color="green" data-image="{{ URL::asset('bootstrap/assets/img/full-screen-image-3.jpg') }}">
    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    <div class="logo">
        <a href="http://www.creative-tim.com/" class="logo-text">
            KOPERASI BMT
        </a>
    </div>
    <div class="logo logo-mini">
        <a href="http://www.creative-tim.com/" class="logo-text">
            BMT
        </a>
    </div>

    <div class="sidebar-wrapper">
        <div class="content">
            <div class="container-fluid">
                <ul class="nav">
                    <li class="active">
                        <a href="{{route('dashboard')}}">
                            <i class="pe-7s-graph"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#nav_datamaster">
                            <i class="pe-7s-server"></i>
                            <p>Data master
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="nav_datamaster">
                            <ul class="nav">
                                <li><a href="{{route('data_anggota')}}">Data Anggota</a></li>
                                <li><a href="{{route('data_rekening')}}">Data Rekening</a></li>
                                <li><a href="{{route('data_simpanan')}}">Jenis Simpanan</a></li>
                                <li><a href="#">Jenis Deposito</a></li>
                                <li><a href="#">Jenis Pembiayaan</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#nav_simpanan">
                            <i class="pe-7s-wallet"></i>
                            <p>Simpanan
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="nav_simpanan">
                            <ul class="nav">
                                <li><a href="{{route('pengajuan_simpanan')}}">Daftar Pengajuan</a></li>
                                <li><a href="#">Jenis Tabungan</a></li>
                                <li><a href="#">Daftar Nasabah</a></li>
                                <li><a href="#">Pemasukan</a></li>
                                <li><a href="#">Pengeluaran</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#nav_deposito">
                            <i class="pe-7s-credit"></i>
                            <p>Deposito
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="nav_deposito">
                            <ul class="nav">
                                <li><a href="{{route('pengajuan_simpanan')}}">Daftar Pengajuan</a></li>
                                <li><a href="#">Jenis Tabungan</a></li>
                                <li><a href="#">Daftar Nasabah</a></li>
                                <li><a href="#">Pemasukan</a></li>
                                <li><a href="#">Pengeluaran</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#nav_pembiayaan">
                            <i class="pe-7s-cash"></i>
                            <p>Pembiayaan
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="nav_pembiayaan">
                            <ul class="nav">
                                <li><a href="{{route('pengajuan_simpanan')}}">Daftar Pengajuan</a></li>
                                <li><a href="#">Jenis Pembiayaan</a></li>
                                <li><a href="#">Daftar Nasabah</a></li>
                                <li><a href="#">Pemasukan</a></li>
                                <li><a href="#">Pengeluaran</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#nav_maal">
                            <i class="pe-7s-home"></i>
                            <p>Maal
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="nav_maal">
                            <ul class="nav">
                                <li><a href="#">Daftar Kegiatan</a></li>
                                <li><a href="#">Pemasukan</a></li>
                                <li><a href="#">Pengeluaran</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>

