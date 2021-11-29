<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li class="{{ set_active('home') }}">
                    <a href="{{ route('home') }}">
                        <i class="iconsminds-shop-4"></i>
                        <span>Dashboards</span>
                    </a>
                </li>
                @if (auth()->user()->role_id == 1)
                <li class="{{ set_active(['guru.index','guru.create','guru.show','siswa.index','siswa.create','siswa.show','kelas.index','kelas.show','semester.index','mapel.index','mapel.edit']) }}">
                    <a href="#datamaster">
                        <i class="iconsminds-digital-drawing"></i>
                        <span>Data Master</span>
                    </a>
                </li>
                @endif
                <li class="{{ set_active(['registrasi.siswa']) }}">
                    <a href="">
                        <i class="simple-icon-credit-card"></i>
                        <span>Transactions</span>
                    </a>
                </li>

                <li class="{{ set_active(['modul.index','modul.create','modul.show','modul.edit']) }}">
                    <a href="">
                        <i class="simple-icon-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="sub-menu">
        <div class="scroll">
            <ul class="list-unstyled" data-link="datamaster">
                <li>
                    <a href="">
                        <i class="iconsminds-user"></i>
                        <span>Data Freelance</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
