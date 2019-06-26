@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <form action="{{route('games.export')}}">
                            <input type="hidden" class="form-control" name="date_from" placeholder="Дата от"
                                   value="{{\Request::get('date_from')}}">
                            <input type="hidden" class="form-control" name="date_to" placeholder="дата до"
                                   value="{{\Request::get('date_to')}}">
                            <input type="hidden" class="form-control" name="id" placeholder="id"
                                   value="{{\Request::get('id')}}">
                            <input type="hidden" class="form-control" name="name" placeholder="Название"
                                   value="{{\Request::get('name')}}">
                            <button type="submit" class="btn btn-warning">Экспорт в CSV</button>
                        </form>

                    </div>
                </div>
                <form action="{{route('home')}}" method="get">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="date" class="form-control" name="date_from" placeholder="Дата от"
                                       value="{{\Request::get('date_from')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="date" class="form-control" name="date_to" placeholder="дата до"
                                       value="{{\Request::get('date_to')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="id" placeholder="id"
                                       value="{{\Request::get('id')}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Название"
                                       value="{{\Request::get('name')}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success btn-block">Искать</button>
                        </div>
                    </div>
                </form>
                <div class="card">
                    <table class="table">
                        <tr>
                            <th>@sortablelink('id', '#')</th>
                            <th>@sortablelink('name', 'Название')</th>
                            <th>@sortablelink('provider.name', 'Провайдер')</th>
                            <th>@sortablelink('stats_count', 'Ставок')</th>
                            <th>@sortablelink('created_at', 'Дата создания')</th>
                        </tr>
                        @foreach($games->items() as $game)
                            <tr>
                                <td>{{$game->id}}</td>
                                <td>{{$game->name}}</td>
                                <td>{{$game->provider->name}}</td>
                                <td>{{$game->stats()->count()}}</td>
                                <td>{{$game->created_at->format('d.m.Y')}}</td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="col-md-12">
                        {{$games->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
