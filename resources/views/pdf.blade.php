@extends('layouts.pdf')

@section('app','cv')

@section('head')
    @parent
@stop

@section('content')
    @parent
    <ui-view></ui-view>
@stop


