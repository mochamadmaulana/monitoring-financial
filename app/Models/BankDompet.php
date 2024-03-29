<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDompet extends Model
{
    use HasFactory;
    protected $table = 'bank_dompet';
    protected $guarded = [];

    public function scopeSearch(Builder $query, string $filters = null) : void
    {
        $query->when($filters ?? false, fn($query, $search) =>
            $query->where('jenis','like','%'.$search.'%')
                ->orWhere('nama','like','%'.$search.'%')
                // ->orWhereHas('kantor',fn($query) =>
                //     $query->where('nama_kantor','like','%'.$search.'%')
                // )
        );
    }
}
