@extends('adminlte::page')

@section('title', 'Home Saldo')

@section('content_header')
    <h1>Saldo</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <a href="{{ route('balance.deposit') }}" class="btn btn-primary"><i class="fas fa-cart-plus"></i> Recarregar</a>
            @if ($amount > 0)
                <a href="{{ route('balance.withdraw') }}" class="btn btn-danger"><i class="fas fa-cart-arrow-down"></i> Sacar</a>
            @endif
        </div>
        <div class="box-body">

            @include('admin.includes.alerts')

            <div class="col-lg-6 col-xs-12">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><sup style="font-size: 20px">R$</sup> {{ number_format($amount, 2, ',','.') }}</h3>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                    <a href="#" class="small-box-footer">Histórico <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
@stop