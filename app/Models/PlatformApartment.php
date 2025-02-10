<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformApartment extends Model
{
    use HasFactory;

    protected $table = 'platform_apartment'; // ✅ DEFINIR EL NOMBRE EXPLÍCITAMENTE

    protected $fillable = ['register_date', 'premium', 'apartment_id', 'platform_id'];
}