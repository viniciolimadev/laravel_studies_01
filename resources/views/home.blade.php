@extends('layouts.main_layout')
@section('content')

<p class="display-6 text-secondary text-center py-5">CONTENT</p>

{{-- apresentar myName --}}

@if (!@empty($myName))
    <p>{{$myName}}</p>
    <br>
@endif

@endsection