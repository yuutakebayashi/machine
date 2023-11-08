<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class sale extends Model
{
    use HasFactory;
    protected $fillable =["machine_id"];

    public function decStock($id){
        DB::table("machines")
        ->where("id", "=", $id)
        ->decrement("count");

    $afterBuy = DB::table("machines")
        ->select("id","name","count")
        ->where("id", "=", $id)
        ->first();

        return $afterBuy;
    }


    public function registSale($id){
        DB::table("sales")
            ->insert([
                "machine_id" => $id,
                "created_at" => now(),
                "updated_at" => now()
            ]);
    }
}
