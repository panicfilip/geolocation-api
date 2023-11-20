<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class GeolocationProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'success_rate',
    ];

    public static function getOrderedBySuccessRate(): Collection
    {
        return self::orderBy('success_rate', 'desc')->get();
    }

    public static function incrementSuccessRateForProvider(string $name): int
    {
        return self::where('name', $name)->increment('success_rate');
    }
}
