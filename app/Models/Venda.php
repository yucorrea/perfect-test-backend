<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Venda extends Model
{
    
    protected $fillable = [
        'data_venda' ,
        "id_produto",
        "id_cliente",
        'quantidade_produto',
        'desconto',
        'status_venda'
    ];

    public function setDataVendaAttribute($value)
    {
       $this->attributes['data_venda'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getDataVendaAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    public function getStatusVendaAttribute($value)
    {
       switch($value) 
       {
           case 'a': {
               return 'Aprovados';
           }
           case 'c': {
            return 'Cancelados';
           }

           case 'd': {
            return 'Devoluções';
           }
       }
    }

    public function produto() 
    {
        return $this->belongsTo(produto::class, 'id_produto', 'id');
    }

    public function cliente() 
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id');
    }
}
