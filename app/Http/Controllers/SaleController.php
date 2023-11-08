<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\sale;
use App\Models\Machine;


class SaleController extends Controller
{
    public function buy(Request $request){
        $machine_model = new machine();
        $sale_model = new sale();

        $id = $request->input("machine_id");
        $machine = $machine_model->getMachineById($id);


        if(!$machine){
            return response()->json("商品無し");
        }

        if($machine->count <= 0){
            return response()->json("在庫無し");
        }

        try{
            DB::beginTransaction();
            $buy = $sale_model->decStock($id);
            $sale_model->registSale($id);

            DB::commit();
        }catch(Throwable $e){
            DB::rollback();
        }

        return response()->json($buy);
    }
}
