@extends('layouts.app')
@section('title', Auth::user()->name . '消费中心')

@section('content')
    <div class="container">

        <div>
            <div class="card">
                <div class="card-header">

                    <a href="{{ route('expenditures.create') }}" type="button" class="btn btn-primary btn-sm" style="float:right;">添加消费</a>
                </div>
            </div>

            <div class="card-body">
                <ul class="list-group">
                    @foreach ($lists as $item)
                    <li class="list-group-item">
                        金额：{{ $item->expenditure_money }}<br>
                        标题：{{ $item->title }}<br>
                        消费时间：{{ $item->expenditure_time }}<br>
                        图片：<img src="{{ $item->pic }}" class="img-responsive img-circle" width="30px" height="30px"><br>
                        {{--@can('destroy', $item)--}}
                            <form action="{{ route('expenditures.destroy', $item->id) }}" method="post" class="float-right">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button>
                            </form>
                        {{--@endcan--}}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@stop