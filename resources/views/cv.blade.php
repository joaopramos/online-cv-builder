@extends('layouts.master')

@section('app','cv')
@section('body-classes','background-gradient')

@section('head')
    <script> angular.module('cv').constant('$baseUrl', '{{ URL::to('/') }}/'); </script>
    <script> angular.module('cv').constant('$cvId', {{ $cv->id }}); </script>
    <script> angular.module('cv').constant('$currentUser', null); </script>
@stop

@section('header')
    @parent
    @include('headers.published')
@stop

@section('content')
    @parent
    <ui-view></ui-view>
@stop

