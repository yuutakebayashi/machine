@extends("app")

@section("content")
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="fontsize:1rem;margin:50px 0;">商品情報詳細画面</h2>
        </div>
    </div>
</div>

<div style="border:2px solid black;">
<table style="text-align:center;font-size:24px;margin:20px 20px 0;">
    <tr><td style="font-weight:bold;padding:20px 20px;">ID</td><td style="padding:0 40px 0 200px;">{{ $machine->id}}</td></tr>
    <tr><td style="font-weight:bold;padding:20px 20px;">商品画像</td>
        <td style="padding:0 40px 0 200px;"><img src="{{ asset($machine->path) }}" alt="イメージ画像"></td>
    </tr>
    <tr><td style="font-weight:bold;padding:20px 20px;">商品名</td><td style="padding:0 40px 0 200px;">{{ $machine->name}}</td></tr>
    <tr><td style="font-weight:bold;padding:20px 20px;">メーカー</td>
        <td style="padding:0 40 0 200px;">
            @foreach($makers as $maker)
            @if($maker->id==$machine->maker) {{ $maker->str }} @endif
            @endforeach
        </td>
    </tr>
    <tr><td style="font-weight:bold;padding:20px 20px;">価格</td><td style="padding:0 40 0 200px;">{{ $machine->price}}</td></tr>
    <tr><td style="font-weight:bold;padding:20px 20px;">在庫数</td><td style="padding:0 40 0 200px;">{{ $machine->count}}</td></tr>
    <tr><td style="font-weight:bold;padding:20px 20px;">コメント</td><td style="padding:0 40 0 200px;">{{ $machine->comment}}</td></tr>
</table>
<a class="btn" style="margin:30px 30px;background-color:orange;" href="{{ route("machines.edit",$machine->id) }}">編集</a>
    <a class="btn" style="background-color:rgb(40, 183, 235);" href="{{url("/machines")}}?page={{ $page_id }}">戻る</a>
</div>






{{-- <div style="text-align:left;">
<div class="row">
    <div class="col-12 mb-2 mt-2">
        <div class="form-group">
            <label>id</label>
            {{ $machine->id}}
        </div>
    </div>
    <div class="col-12 mb-2 mt-2">
        <div class="form-group">
            <label>商品画像</label>
            {{ $machine->image}}
        </div>
    </div>
    <div class="col-12 mb-2 mt-2">
        <div class="form-group">
            <label>商品名</label>
            {{ $machine->name }}
        </div>
    </div>
    <div class="col-12 mb-2 mt-2">
        <div class="form-group">
            <label>メーカー名</label>
                @foreach($makers as $maker)
                @if($maker->id==$machine->maker) {{ $maker->str }} @endif
                @endforeach
        </div>
    </div>
    <div class="col-12 mb-2 mt-2">
        <div class="form-group">
            <label>価格</label>
            {{ $machine->price }}
        </div>
    </div>
    <div class="col-12 mb-2 mt-2">
        <div class="form-group">
            <label>個数</label>
            {{ $machine->count }}
        </div>
    </div>
    <div class="col-12 mb-2 mt-2">
        <div class="form-group">
            <label>コメント</label>
            {{ $machine->comment}}
        </div>
    </div>
</div> --}}
