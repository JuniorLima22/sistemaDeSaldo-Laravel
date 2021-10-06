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
            <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Pesquisar">

              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
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
                        <th>Transferência (Recebedor)</th>
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
                {!! $historics->links() !!}
            </div>
        </div>
        
    </div>
@stop