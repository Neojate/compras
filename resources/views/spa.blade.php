@extends('layouts.app')

@section('content')
    <div id="app">
        <App user="{{ \Auth::user()->name }}"></App>
    </div>
@endsection

@section('footer')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
