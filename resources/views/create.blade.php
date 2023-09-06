@extends("app")

@section("content")
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="fontsize:1rem;">商品新規登録画面</h2>
        </div>
    </div>
</div>


<form action="{{ route("machines.store") }}" method="POST" enctype="multipart/form-data">
@csrf
{{-- <div class="row">
    <div class="col-12 mb-2 mt-2" style="display:flex;">
    <div  lass="form-group" style="display:flex;">
        <label for="name">商品名</label>
            <input type="text" name="name" id="name" class="form-control">
            @error("name")
            <span style="color:red;">商品名を20文字以内で入力してください</span>
            @enderror
        </div>
    </div>
    <div class="col-12 mb-2 mt-2"  style="display:flex;">
        <div class="form-group"  style="display:flex;">
            <label for="name">メーカー名</label>
            <select name="maker" class="form-select">

                <option id="name">メーカー名を選択してください</option>
                @foreach($makers as $maker)
                    <option value="{{ $maker->id }}">{{ $maker->str }}</option>
                @endforeach
            </select>
            @error("maker")
            <span style="color:red;">メーカー名を選択してください</span>
            @enderror
        </div>
    </div>
    <div class="col-12 mb-2 mt-2" style="display:flex;">
        <div class="form-group" style="display:flex;">
            <label for="proce">価格</label>
            <input type="text" name="price" id="price" class="form-control">
            @error("price")
            <span style="color:red;">価格を数値で入力してください</span>
            @enderror
        </div>
    </div>
    <div class="col-12 mb-2 mt-2" style="display:flex;">
        <div class="form-group" style="display:flex;">
            <label for="count">個数</label>
            <input type="text" name="count" id="count" class="form-control">
            @error("count")
            <span style="color:red;">個数を数値で入力してください</span>
            @enderror
        </div>
    </div>
    <div class="col-12 mb-2 mt-2" style="display:flex;">
        <div class="form-group" style="display:flex;">
            <label for="comment">コメント</label>
            <textarea name="comment" id="comment" class="form-control"></textarea>
            @error("comment")
            <span style="color:red;">コメントを200文字以内で入力してください</span>
            @enderror
        </div>
    </div>
    <div class="col-12 mb-2 mt-2" style="display:flex;">
        <div class="form-group style="display:flex;">
            <form method="POST" action="/machines" enctype="multipart/form-data">
                @csrf
                <input type="file" name="image">
            </form>
            @error("image")
            <span style="color:red;">画像を入れてください</span>
            @enderror


        </div>
    </div>
    <div class="col-12 mb-2 mt-2" style="display:flex;">
        <button type="submit" class="btn btn-primary w-10">新規登録</button>
        <a class="btn btn-success" href="{{url("/machines")}}">戻る</a>

    </div>
</div> --}}

<div style="border:2px solid black;">
    <table style="text-align:center;font-size:24px;margin:20px 20px 0;">
        <tr><td style="font-weight:bold;padding:20px 300px 20px 20px;">商品名</td><td>
            <input type="text" name="name" class="form-control">
            @error("name")
            <span style="color:red;">商品名を20文字以内で入力してください</span>
            @enderror</td>
            </td>
        </tr>

        <tr><td style="font-weight:bold;padding:20px 300px 20px 20px;">メーカー</td>
            <td>
                <select name="maker" class="form-select">
                <option>メーカー名を選択してください</option>
                @foreach($makers as $maker)
                <option value="{{ $maker->id }}">{{ $maker->str }}</option>
                @endforeach
                </select>
            @error("maker")
            <span style="color:red;">メーカー名を選択してください</span>
            @enderror
            </td>
        </tr>

        <tr><td style="font-weight:bold;padding:20px 300px 20px 20px;">価格</td><td>
            <input type="text" name="price" class="form-control">
            @error("price")
            <span style="color:red;">価格を数値で入力してください</span>
            @enderror
            </td>
        </tr>

        <tr><td style="font-weight:bold;padding:20px 300px 20px 20px;">在庫数</td><td>
            <input type="text" name="count" class="form-control">
            @error("count")
            <span style="color:red;">個数を数値で入力してください</span>
            @enderror
            </td>
        </tr>

        <tr><td style="font-weight:bold;padding:20px 300px 0 20px;">コメント</td><td>
            <textarea name="comment" class="form-control"></textarea>
            @error("comment")
            <span style="color:red;">コメントを200文字以内で入力してください</span>
            @enderror
            </td>
        </tr>

        <tr><td style="font-weight:bold;padding:20px 300px 20px 20px;">商品画像</td>
            <td>
                <form method="POST" action="/machines" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image">
                </form>
                @error("image")
                <span style="color:red;">画像を入れてください</span>
                @enderror
            </td>
        </tr>
    </table>
        <button type="submit" style="margin:30px 30px;background-color:orange;" class="btn" >新規登録</button>
        <a class="btn" style="background-color:rgb(40, 183, 235);" href="{{url("/machines")}}">戻る</a>
    </div>
</form>
@endsection
