@extends('layouts.master')

@section('app','cv')
@section('body-classes','background-gradient')
@section('head')
    @parent
@stop

@section('header')
    @parent
    @include('headers.published')
@stop

@section('content')
    @parent
    <ui-view></ui-view>
@stop

