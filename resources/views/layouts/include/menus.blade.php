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
                <li class="{{ set_active(['freelance.*','customer.*']) }}">
                    <a href="#datamaster">
                        <i class="iconsminds-digital-drawing"></i>
                        <span>Data Master</span>
                    </a>
                </li>
                @endif
                @if (auth()->user()->role_id == 2)
                <li class="{{ set_active(['transaction.ready']) }}">
                    <a href="{{ route('transaction.ready') }}">
                        <i class="iconsminds-digital-drawing"></i>
                        <span>Ambil Pekerjaan</span>
                    </a>
                </li>
                @endif
                <li class="{{ Auth::user()->role_id==1?set_active(['transaction.*']):set_active(['transaction.progress','transaction.finish','transaction.index']) }}">
                    <a href="#datatransaksi">
                        <i class="simple-icon-credit-card"></i>
                        <span>Transactions</span>
                    </a>
                </li>

                <li class="{{ set_active(['profile']) }}">
                    <a href="{{ route('profile') }}">
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
                <li class="{{ set_active(['freelance.*']) }}">
                    <a href="{{ route('freelance.index') }}">
                        <i class="iconsminds-user"></i>
                        <span>Data Freelance</span>
                    </a>
                </li>
                <li class="{{ set_active(['customer.*']) }}">
                    <a href="{{ route('customer.index') }}">
                        <i class="iconsminds-user"></i>
                        <span>Data Customer</span>
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled" data-link="datatransaksi">
                @if (Auth::user()->role_id==1)
                <li class="{{ set_active(['transaction.create']) }}">
                    <a href="{{ route('transaction.create') }}">
                        <i class="iconsminds-user"></i>
                        <span>New Transaction</span>
                    </a>
                </li>
                <li class="{{ set_active(['transaction.pending']) }}">
                    <a href="{{ route('transaction.pending') }}">
                        <i class="iconsminds-user"></i>
                        <span>Transaksi Pending</span>
                    </a>
                </li>
                <li class="{{ set_active(['transaction.ready']) }}">
                    <a href="{{ route('transaction.ready') }}">
                        <i class="iconsminds-user"></i>
                        <span>Transaksi Ready</span>
                    </a>
                </li>
                @endif
                <li class="{{ set_active(['transaction.progress']) }}">
                    <a href="{{ route('transaction.progress') }}">
                        <i class="iconsminds-user"></i>
                        <span>Transaksi On Progress</span>
                    </a>
                </li>
                <li class="{{ set_active(['transaction.finish']) }}">
                    <a href="{{ route('transaction.finish') }}">
                        <i class="iconsminds-user"></i>
                        <span>Transaksi Success</span>
                    </a>
                </li>
                <li class="{{ set_active(['transaction.index']) }}">
                    <a href="{{ route('transaction.index') }}">
                        <i class="iconsminds-user"></i>
                        <span>Transaksi All</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
