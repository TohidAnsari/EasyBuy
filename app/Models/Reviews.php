<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $table ="reviews";

    /**
     * Get the orderItem that owns the Reviews
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderItems()
    {
        return $this->belongsTo(OrderItem::class);
    }
}
