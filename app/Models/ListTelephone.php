<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListTelephone extends Model
{
    use HasFactory;
    protected $table = 'list_telephone';
    protected $fillable = ['id_tele_provider', 'phone', 'is_odd'];

    public function provider()
    {
        return $this->belongsTo(TeleProvider::class, 'id_tele_provider');
    }
}
