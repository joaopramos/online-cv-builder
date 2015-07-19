<!-- resources/views/auth/reset.blade.php -->

@extends('layouts.other')

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
                <form class="form-horizontal" role="form" method="POST" action="/password/reset">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label class="col-md-4 control-label">E-mail</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">New password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Password Confirmation</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Change password
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
