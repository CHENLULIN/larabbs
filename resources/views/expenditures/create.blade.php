@extends('layouts.app')
@section('title', Auth::user()->name . '消费中心')

@section('content')
    <div class="container">
        <div class="col-md-8 offset-md-2">

            <div class="card">
                <div class="card-header">
                    <h4>
                        <i class="glyphicon glyphicon-edit"></i> 添加消费
                    </h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('expenditures.store') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{--<input type="hidden" name="_method" value="PUT">--}}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @include('shared._error')

                        <div class="form-group">
                            <label for="title-field">标题</label>
                            <input class="form-control" type="text" name="title" id="title-field" value="{{ old('title') }}" />
                        </div>
                        <div class="form-group">
                            <label for="description-field">说明</label>
                            <input class="form-control" type="text" name="description" id="description-field" value="{{ old('description') }}" />
                        </div>

                        <div class="form-group">
                            <label for="expenditure_money-field">消费金额</label>
                            <input class="form-control" type="text" name="expenditure_money" id="expenditure_money-field" value="{{ old('expenditure_money') }}" />
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">支付方式</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect01" name="pay_type">
                                <option value="1">支付宝</option>
                                <option value="2">微信</option>
                                <option value="3">现金</option>
                                <option value="4">刷卡</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cart-field">卡号尾号</label>
                            <input class="form-control" type="text" name="cart" id="pay_type-field" value="{{ old('cart') }}" />
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">图片</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" name="pic" class="custom-file-input" id="inputGroupFile01">
                                <label class="custom-file-label" for="inputGroupFile01">上传图片</label>
                            </div>
                        </div>
                        <div class="well well-sm">
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop