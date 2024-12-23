{{-- @php
    use Illuminate\Support\Str;
@endphp --}}
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                <li class="menu-title">
                    <span>Main Menu</span>
                </li>
                <li class="">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="feather-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @can('adminAccess')
                    <li class="">
                        <a href="{{ route('barang.index') }}">
                            <i class="fas fa-shield-alt"></i>
                            <span> Barang</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('merek.index') }}">
                            <i class="fas fa-arrow-right"></i>
                            <span>Merek</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('type.index') }}">
                            <i class="fa fa-arrow-left"></i>
                            <span>Type</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('distributor.index') }}">
                            <i class="fa fa-arrow-left"></i>
                            <span>Distributor</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-arrow-left"></i>
                            <span>User</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="">
                            <i class="fa fa-list"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                @endcan

                @can('karyawanAccess')
                    <li class="">
                        <a href="{{ route('barangmasuk.index') }}">
                            <i class="fa fa-arrow-left"></i>
                            <span>Barang Masuk</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="{{ route('barangkeluar.index') }}">
                            <i class="fa fa-arrow-left"></i>
                            <span>Barang Keluar</span>
                        </a>
                    </li>
                @endcan

            </ul>
        </div>
    </div>
</div>
