@extends("layouts.app")

@section('content')
    <div class="content">
        <div class="title m-b-md">
            Larabrave
        </div>

        @if(isset($creator))
            <p>By {{ $creator }}</p>
            <br><br>
        @else
            <p>Open Source</p>
             <br><br>
        @endif

        <div class="links">
            
            @foreach($links as $link => $text)
                <a href="{{ $link }}" target="blank">{{ $text }}</a>
            @endforeach

            <a href="{{ url('/about') }}">Acerca de nosotros</a>
        </div>
    </div>
@endsection
