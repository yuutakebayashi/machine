@extends("app")

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="text-left">
            <h2 style="font-size=40px;">商品一覧画面</h2>
        </div>
    </div>
    <table id = "search-table">
    <form action="{{ route("machines.index") }}" method="GET" id = "search-form">
    @csrf
    <tr>
        <td>
            <input type="search" style="width:300px;" placeholder="検索キーワード" name="keyword" value="@if (isset($keyword)) {{ $keyword }} @endif">
        </td>
        <td>
            <select name="maker" class="form-select">
                <option disabled selected >メーカー名</option>
                @foreach($makers as $maker)
                <option value="{{ $maker->id }}">{{ $maker->str }}</option>
                @endforeach
            </select>
        </td>
        <td>
        <input id= "search-btn" type="submit" value="検索">
        </td>
    </tr>
    <tr>
        <td>価格上限値</td>
        <td>
            <input placeholder="価格の上限値を入力" type="text" name="priceUpper">
        </td>
    </tr>
        <td>価格下限値</td>
        <td>
        <input placeholder="価格の下限値を入力" type="text" name="priceLower">
        </td>
    </tr>
    <tr>
        <td>在庫上限値</td>
        <td>
            <input placeholder="在庫の上限値を入力" type="text" name="countUpper">
        </td>
    </tr>
    <tr>
        <td>在庫下限値</td>
        <td>
        <input placeholder="在庫の下限値を入力" type="text" name="countLower">
        </td>
    </tr>
    </form>
    </table>
</div>

<table id= "machine-table" class="table table-bordered" style="text-align:center;">
    <thead>
    <tr>
        <th>ID</th>
        <th>商品画像</th>
        <th>商品名</th>
        <th>価格</th>
        <th>在庫数</th>
        <th>メーカー名</th>
        <th><a class ="btn btn-success" href="{{ route("machines.create") }}">新規登録</a></th>

    </tr>
    </thead>
    <tbody>
    @foreach($machines as $machine)
    <tr style="text-align:center;">
        <td>{{ $machine->id}}</td>
        <td><img src="{{ asset($machine->path) }}" alt="イメージ画像"></td>
        <td>{{ $machine->name }}</td>
        <td>¥{{ $machine->price }}</td>
        <td>{{ $machine->count }}</td>
        <td>{{ $machine->maker }}</td>
        <td>
            <a class="btn btn-primary" href="{{ route("machines.show",$machine->id) }}" style="display:inline-block;">詳細</a>
            <form action="{{ route("machines.destroy",$machine->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method("DELETE")
                <button type="submit" class="btn delete-btn btn-sm btn-danger" data-delete-id="{{ $machine->id}}"">削除</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
</table>
{{-- {!! $machines->links("pagination::bootstrap-5")  !!} --}}

@endsection
