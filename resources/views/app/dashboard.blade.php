@extends('blades.app')

@section('title', 'Dashboard')

@section('css')
@endsection

@section('content')
<h5>Bienvenido {{ Auth::user()->fullname() }}
@endsection

@section('scripts')
@endsection