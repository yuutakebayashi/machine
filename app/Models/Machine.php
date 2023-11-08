<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Machine extends Model
{
    use HasFactory;

    public function getMachineById($id)
{
    return $this->where('id', $id)->first();
}
}
