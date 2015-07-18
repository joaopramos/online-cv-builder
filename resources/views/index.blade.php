@extends('layouts.master')

@section('app','cv')
@section('body-classes','background-gradient')

@section('head')
    @parent
@stop

@section('header')
    @parent
    @include('headers.master')
@stop

@section('content')
    @parent
    <ui-view></ui-view>
@stop

@section('footer')
    @parent
    <div class="min-height100"> </div>
    <div class="footer text-center">
        <h3 style="color:#ddd"> This is the demo for
            <a href="http://github.com/joaopramos/online-cv-builder">
                online-cv-builder
            </a>
        </h3>
    </div>
    <toast></toast>
@stop
