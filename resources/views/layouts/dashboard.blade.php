<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.include.head')
</head>

<body id="app-container" class="menu-sub-hidden right-menu ltr rounded">

    @include('layouts.include.navbar')

    @include('layouts.include.menus')

    <main>
        {{-- Error Respons --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Success Respons --}}
        @if (session('success'))
            <div class="alert alert-success">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif

        {{-- Content --}}
        @yield('content')
    </main>

    @include('layouts.include.footer')

    @include('layouts.include.script')
    @yield('script')
</body>

</html>
