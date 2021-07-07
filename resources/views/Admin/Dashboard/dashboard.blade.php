@extends('Admin::layouts.layout')

@section('header')
    @include('Admin::layouts.includes.header')
@endsection

@section('navigation')
    {!! $sidebar !!}
@endsection

@section('content')
     {!! $content !!}
@endsection

@section('footer')
    @include('Admin::layouts.includes.footer')
@endsection
