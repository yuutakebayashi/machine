<?php

namespace App\Http\Controllers;

use App\Models\machine;
use App\Models\Maker;
use Illuminate\Http\Request;
use App\Http\Requests\MachineRequest;
use App\Http\Requests\ExeptImageRequest;
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

        if(!empty($keyword)) {
            $query->where("name", "like", "%{$keyword}%");
        }

        if(!empty($makerKeyword)){
                $query->where('maker', $makerKeyword);
                };


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
    public function store(MachineRequest $request)
    {

        $dir = "sample";
        $file_name=$request->file("image")->getClientOriginalName();
        $request->file("image")->storeAs("public/" . $dir, $file_name);


        $machine = new Machine;
        $machine->name = $request->input(["name"]);
        $machine->maker = $request->input(["maker"]);
        $machine->price = $request->input(["price"]);
        $machine->count = $request->input(["count"]);
        $machine->comment = $request->input(["comment"]);
        $machine->image = $file_name;
        $machine->path= "storage/" . $dir . "/" . $file_name;

        $machine->save();

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
    public function update(ExeptImageRequest $request, machine $machine)
    {
        $dir = "sample";
        $file = $request->file("image");
        if(!is_null($file)) {
        $file_name=$request->file("image")->getClientOriginalName();
        $request->file("image")->storeAs("public/" . $dir, $file_name);
        $machine->image = $file_name;
        $machine->path = "storage/" . $dir . "/" . $file_name;
        }

        $machine->name = $request->input(["name"]);
        $machine->maker = $request->input(["maker"]);
        $machine->price = $request->input(["price"]);
        $machine->count = $request->input(["count"]);
        $machine->comment = $request->input(["comment"]);

        $machine->save();

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

    public function Submit(MachineRequest $request) {

        DB::beginTransaction();

        try {
            $model = new Machine();
            $model->store($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        return redirect()->route("machines.index");
    }

    public function EditSubmit(ExeptImageRequest $request) {

        DB::beginTransaction();

        try {
            $model = new Machine();
            $model->update($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        return redirect()->route("machines.index");
    }
}
