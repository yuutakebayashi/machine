<?php

namespace App\Http\Controllers;

use App\Models\machine;
use App\Models\Maker;
use Illuminate\Http\Request;
use App\Http\Requests\MachineRequest;
use Illuminate\Support\Facades\DB;


class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Machine::query();
        $keyword = $request->input("keyword");
        $makerKeyword = $request->maker;
        $priceUpper = $request->input("priceUpper");
        $priceLower = $request->input("priceLower");
        $countUpper = $request->input("countUpper");
        $countLower = $request->input("countLower");

        $machines=$query->select([
            "b.id",
            "b.image",
            "b.path",
            "b.name",
            "b.maker",
            "b.price",
            "b.count",
            "r.str as maker",
            "b.comment",
        ])
        ->from("machines as b")
        ->join("makers as r", function($join){
            $join->on("b.maker", "=", "r.id");
        });

        // キーワードから検索処理
        if(!empty($keyword)) {
            $query->where("name", "like", "%{$keyword}%");
        }

        if(!empty($makerKeyword)){
                $machines->where('maker', $makerKeyword);
                };

        // 価格最大値から検索処理
        if(!empty($priceUpper)) {
                $machines->where('price', '<=',$priceUpper);
        }

        //  価格最小値から検索処理
        if(!empty($priceLower)) {
                $machines->where('price', '>=',$priceLower);
        }

        // 在庫最大値から検索処理
        if(!empty($countUpper)) {
            $machines->where('count', '<=',$countUpper);
                }

                //  在庫最小値から検索処理
        if(!empty($countLower)) {
            $query->where('count', '>=',$countLower);
        }
        // $query->orderByAsc("b.id")
        // ->paginate(5);

        $machines = $query->get();
        $makers= Maker::all();
        return view("index",compact("machines", "keyword" , "makerKeyword", "makers"))
        ->with("page_id",request()->page)
        ->with("keyword",$keyword)
        ->with("makerKeyword",$makerKeyword)
        ->with("makers",$makers)
        ->with("i",(request()->input("page",1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $makers= Maker::all();
        return view("create")
            ->with("makers",$makers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MachineRequest $request, machine $machine)
    {
        $dir = "sample";
        $file = $request->file("image");
        if(!is_null($file)) {
        $file_name=$request->file("image")->getClientOriginalName();
        $request->file("image")->storeAs("public/" . $dir, $file_name);

        }

        DB::beginTransaction();

        try {
            $machine->name = $request->input(["name"]);
            $machine->maker = $request->input(["maker"]);
            $machine->price = $request->input(["price"]);
            $machine->count = $request->input(["count"]);
            $machine->comment = $request->input(["comment"]);
            if(!is_null($file)){
                $machine->image = $file_name;
                $machine->path = "storage/" . $dir . "/" . $file_name;}
            $machine->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }

        return redirect()->route("machines.index");
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function show(machine $machine)
    {
        $makers = Maker::all();
        return view("show",compact("machine"))
            ->with("page_id",request()->page_id)
            ->with("makers",$makers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function edit(machine $machine)
    {
        $makers = Maker::all();
        return view("edit",compact("machine"))
            ->with("makers",$makers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function update(MachineRequest $request, machine $machine)
    {
        $dir = "sample";
        $file = $request->file("image");
        if(!is_null($file)) {
        $file_name=$request->file("image")->getClientOriginalName();
        $request->file("image")->storeAs("public/" . $dir, $file_name);

        }

        DB::beginTransaction();

        try {

            $machine->name = $request->input(["name"]);
            $machine->maker = $request->input(["maker"]);
            $machine->price = $request->input(["price"]);
            $machine->count = $request->input(["count"]);
            $machine->comment = $request->input(["comment"]);
            if(!is_null($file)){
                $machine->image = $file_name;
                $machine->path = "storage/" . $dir . "/" . $file_name;}
            $machine->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }

        return redirect()->route("machines.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function destroy(machine $machine)
    {
        $machine->delete();
        return redirect()->route("machines.index");
    }
}
