@extends("app")

@section("content")
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="fontsize:1rem;margin:50px 0;">商品情報編集画面</h2>
        </div>
    </div>
</div>

{{-- <div style="text-align:right;"> --}}
<form action="{{ route("machines.update",$machine->id) }}" method="POST" enctype="multipart/form-data">
@method("PUT")
@csrf

<div style="border:2px solid black;">
    <table style="text-align:center;font-size:24px;margin:20px 20px 0;">
        <tr><td style="font-weight:bold;padding:20px 300px 20px 20px;">ID</td><td>{{ $machine->id }}</td>
        </tr>
        <tr><td style="font-weight:bold;padding:20px 300px 20px 20px;">商品名</td><td>
            <input type="text" name="name" value="{{ $machine->name }}" class="form-control">
            @if($errors->has('name'))
                    <p>{{ $errors->first('name') }}</p>
                @endif
            </td>
        </tr>

        <tr><td style="font-weight:bold;padding:20px 300px 20px 20px;">メーカー</td>
            <td>
                <select name="maker" class="form-select">
                <option>メーカー名を選択してください</option>
                @foreach($makers as $maker)
                <option value="{{ $maker->id }}" @if($maker->id==$machine->maker) selected @endif>{{ $maker->str }}</option>
                @endforeach
                </select>
                @if($errors->has('maker'))
                    <p>{{ $errors->first('maker') }}</p>
                @endif
            </td>
        </tr>

        <tr><td style="font-weight:bold;padding:20px 300px 20px 20px;">価格</td><td>
            <input type="text" name="price" value="{{ $machine->price }}" class="form-control">
            @if($errors->has('price'))
                <p>{{ $errors->first('price') }}</p>
            @endif
            </td>
        </tr>

        <tr><td style="font-weight:bold;padding:20px 300px 20px 20px;">在庫数</td><td>
            <input type="text" name="count" value="{{ $machine->count }}" class="form-control">
            @if($errors->has('count'))
                <p>{{ $errors->first('count') }}</p>
            @endif
            </td>
        </tr>

        <tr><td style="font-weight:bold;padding:20px 300px 0 20px;">コメント</td><td>
            <textarea name="comment" value="{{ $machine->comment }}" class="form-control"></textarea>
            @if($errors->has('comment'))
                <p>{{ $errors->first('comment') }}</p>
            @endif
            </td>
        </tr>

        <tr><td style="font-weight:bold;padding:20px 300px 20px 20px;">商品画像</td>
            <td>
                <form method="POST" action="/machines" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image">
                </form>
            </td>
        </tr>


    </table>
    <button type="submit" style="background-color:orange;margin:30px 30px;" class="btn">更新</button>
        <a class="btn" style="background-color:rgb(40, 183, 235);" href="{{ route("machines.show",$machine->id) }}">戻る</a>

    </div>
</form>
@endsection
