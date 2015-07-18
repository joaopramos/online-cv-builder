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
        <div class="box col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">
            <div class="box-header text-center"> User account </div>
            <div class="box-body">

                @include('errors.list')
                <form class="form-horizontal" role="form" method="POST" action="{!! URL::to('/profile/update') !!}">
                    <h3>Account information</h3>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="col-md-4 control-label">E-mail</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name" value="{{  Auth::user()->name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password" value="" >
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-8">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
                <hr/>
                <form class="form-horizontal" role="form" method="POST" action="{!! URL::to('/profile/publish') !!}">
                    <h3>Publish cv</h3>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="col-md-4 control-label">slug</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="slug" value="{{ Auth::user()->cv->slug }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary"> Publish </button>
                        </div>
                    </div>
                    <div class="form-group">
                    </div>
                </form>
                <form class="form-horizontal" role="form" method="POST" action="{!! URL::to('/profile/unpublish') !!}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="col-md-8 text-right">
                            <div ng-show="{{ Auth::user()->cv->published }}">
                                CV available at <a href="{{ $cvurl = url('/').'/'.Auth::user()->cv->slug }}"> {{ $cvurl }} </a>
                            </div>
                        </div>
                        <div class="col-md-2" ng-show="{{ Auth::user()->cv->published }}">
                            <button type="submit" class="btn btn-default"> Unpublish </button>
                        </div>
                    </div>
                </form>
                <hr/>
                <form class="form-horizontal" role="form" method="POST" action="{!! URL::to('/profile/destroy') !!}">
                    <h3>Delete Account Permanently</h3>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-8">
                            <button type="submit" class="btn btn-danger">
                               Delete account
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
