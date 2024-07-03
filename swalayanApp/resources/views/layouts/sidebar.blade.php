<link rel="stylesheet" href="path-to/node_modules/mdi/css/materialdesignicons.min.css" />

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        {{-- dashboard --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        {{-- customer   --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ url('pengguna') }}">
                <i class="ti-id-badge menu-icon"></i>
                <span class="menu-title">Pengguna</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#transaksi-dropdown" aria-expanded="false"
                aria-controls="transaksi-dropdown">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Transaksi</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="transaksi-dropdown">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('transaksi') }}">Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('detail-transaksi') }}">Detail Transaksi</a>
                    </li>
                </ul>
            </div>
        </li>


        {{-- kategori produk --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('kategori-produk.index') }}">
                <i class="icon-box menu-icon"></i>
                <span class="menu-title">Kategori Produk</span>
            </a>
        </li>

        {{-- produk --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ url('produk') }}">
                <i class="icon-tag menu-icon"></i>
                <span class="menu-title">Produk</span></a>

        </li>

        {{-- kategori pembayaran --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ url('kategori-pembayaran') }}">
                <i class="ti-wallet menu-icon"></i>
                <span class="menu-title">Kategori Pembayaran</span>
            </a>
        </li>

        {{-- status pengiriman --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ url('pengiriman') }}">
                <i class="ti-truck menu-icon"></i>
                <span class="menu-title">Status Pengiriman</span>
            </a>
        </li>

        {{-- pembayaran --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ url('pembayaran') }}">
                <i class="ti-credit-card menu-icon"></i>
                <span class="menu-title">Pembayaran</span>
            </a>
        </li>

        {{-- ulasan --}}
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ url('ulasan') }}">
                <i class="icon-heart menu-icon"></i>
                <span class="menu-title">Ulasan</span>
            </a>
        </li> --}}


        <li class="nav-item">
            <a class="nav-link" href="{{ url('pegawai') }}">
                <i class="icon-briefcase menu-icon"></i>
                <span class="menu-title">Pegawai</span>
            </a>
        </li>



    </ul>
</nav>
