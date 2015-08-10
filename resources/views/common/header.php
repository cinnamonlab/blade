@section('header')
<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>{{ isset($title) ? $title : 'Hello' }}</title>
        @yield('addCss')
    </head>
    <body>
@endsection