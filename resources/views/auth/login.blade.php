@extends('layouts.master')

@section('app','cv')
@section('body-classes','background-gradient')

@section('header')
    @parent
    @include('headers.master')
@stop

@section('content')
    @parent
    <div class="row">
        <div class="box col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1" >

            <div class="box-header text-center"> Login </div>
            <div class="box-body">
                @include('errors.list')
                <form class="form-horizontal" role="form" method="POST" action="{!! URL::to('/auth/login') !!}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="col-md-4 control-label">E-mail</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
                <div class="text-center">
                    <a href="#" ng-click="showPasswordReset=true"> Forgot your password? </a>
                </div>
                <form class="form-horizontal" role="form" method="POST"
                    ng-show="showPasswordReset" action="{!! URL::to('/password/email') !!}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="col-md-4 control-label">E-mail</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Reset Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('footer')
    @parent
@stop
