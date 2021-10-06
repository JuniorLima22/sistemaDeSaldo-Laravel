@extends('adminlte::page')

@section('title', 'Histórico de Movimentações')

@section('content_header')
    <h1>Histórico de Movimentações</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Histórico</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
          <h3 class="box-title">Histórico</h3>

            <div class="box-tools">
                <form method="POST" action="{{ route('historic.search') }}" class="form form-inline">
                    {!! csrf_field() !!}
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <select name="type" class="form-control pull-right">
                            <option value="">Selecione o Tipo</option>
                            @foreach ($types as $key => $type)
                                <option value="{{ $key }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="date" name="date" class="form-control pull-right">
                    </div>

                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="id" class="form-control pull-right" placeholder="ID">
                        
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Valor</th>
                        <th>Total Antes</th>
                        <th>Total Depois</th>
                        <th>Tipo</th>
                        <th>Data</th>
                        <th>Transferência</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($historics as $historic)
                        <tr>
                            <td>{{ $historic->id }}</td>
                            <td>{{ number_format($historic->amount, 2, ',', '.') }}</td>
                            <td>{{ number_format($historic->total_before, 2, ',', '.') }}</td>
                            <td>{{ number_format($historic->total_after, 2, ',', '.') }}</td>
                            <td class="text-uppercase">
                                @if ($historic->type == 'I')
                                    @if ($historic->user_id_transaction != null)
                                        <span class="label label-warning">Recebido</span>
                                    @else
                                        <span class="label label-success">Recarga</span>
                                    @endif
                                @elseif ($historic->type == 'O')
                                    <span class="label label-danger">Saque</span>
                                @elseif ($historic->type == 'T')
                                    <span class="label label-info">Transferência</span>
                                @endif
                                {{-- {{ $historic->type($historic->type) }} --}}
                            </td>
                            <td>{{ $historic->date }}</td>
                            <td>
                                @if ($historic->user_id_transaction)
                                    {{ $historic->userSender->name }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Nenhuma movimentação encontrada</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="box-footer clearfix">
            <div class="pull-right">
                @if (isset($dataForm))
                    {!! $historics->appends($dataForm)->links() !!}
                @else
                    {!! $historics->links() !!}
                @endif
            </div>
        </div>
        
    </div>
@stop