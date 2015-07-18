@extends('layouts.master')

@section('app','cv')
@section('body-classes','background-gradient')

@section('header')
    @parent
    @include('headers.admin')
@stop

@section('content')
    @parent
@stop

@section('footer')
    @parent
@stop
