@section('footer')
        <div>
            <p>Footer {{isset($footer) ? $footer : 'TemplateFooter'}}</p>
        </div>
@yield('addJs')
    </body>
</html>

@endsection