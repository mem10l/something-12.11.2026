<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'description',
    ];

    public function increaseQuantity(int $amount = 1): bool
    {
        if ($amount < 1) {
            return false;
        }

        $this->increment('quantity', $amount);
        $this->refresh();

        return true;
    }

    public function decreaseQuantity(int $amount = 1): bool
    {
        $decreased = static::query()->whereKey($this->getKey())->where('quantity', '>=', $amount)->decrement('quantity', $amount);
        $this->refresh();
        return $decreased > 0;
    }
}
