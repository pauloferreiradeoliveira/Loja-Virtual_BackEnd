<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    protected $table = 'permissoes';
    protected $hidden = [
        'created_at', 'updated_at','id'
    ];
}
