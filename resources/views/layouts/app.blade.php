<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title' ,'Katalog Buku')</title>
</head>
<body>
    <nav>
        <a href="{{ route('books.index') }}">Data Buku</a>
    </nav>
    <main>
        @yield('content')
    </main>
    @if (session('success'))
    <div class="alert success">
        {{ session('success') }}
    </div>
@endif

</body>
</html>