@extends('adminlte::page')

@section('title', 'Meu Perfil')

@section('content_header')
    <h1>Perfil</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-widget widget-user">
          
            <div class="widget-user-header bg-aqua-active">
                <h3 class="widget-user-username">{{ auth()->user()->name }}</h3>
                <h5 class="widget-user-desc">{{ auth()->user()->email }}</h5>
            </div>
            <div class="widget-user-image">
                @if (auth()->user()->image)
                    <img class="img-circle" src="{{ asset('storage/users/'.auth()->user()->image) }}" alt="{{ auth()->user()->name }}}}" style="max-width: 800px">
                @else
                    <img class="img-circle" src="{{ asset('img/user-default.webp') }}" alt="User Avatar">
                @endif
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">3,200</h5>
                            <span class="description-text">Recarga</span>
                        </div>

                    </div>

                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">13,000</h5>
                            <span class="description-text">Saque</span>
                        </div>
                        
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header">35</h5>
                            <span class="description-text">Tranferência</span>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
        </div>
        
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Perfil</h3>
            </div>
            <div class="box-body">
                
                @include('admin.includes.alerts')

                <form method="POST" action="{{ route('profile.update') }}" class="form-horizontal" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Nome</label>

                        <div class="col-sm-10">
                            <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control" id="name" placeholder="Nome">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">E-mail</label>

                        <div class="col-sm-10">
                            <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control" id="email" placeholder="E-mail">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">Senha</label>

                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Senha">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-sm-2 control-label">Imagem</label>
                        <div class="col-sm-10">
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Atualizar Perfil</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
