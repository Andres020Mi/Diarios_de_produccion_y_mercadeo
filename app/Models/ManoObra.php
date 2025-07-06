<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManoObra extends Model
{
    protected $table = "mano_obras";

    protected $fillable = ["nombre","cedula","imagen"];
}
