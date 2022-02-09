<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeleProvider extends Model
{
    use HasFactory;
    protected $table = 'tele_provider';
    protected $fillable = ['name'];
}
