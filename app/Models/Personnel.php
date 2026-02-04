<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personnel extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'position',
        'department',
        'contact',
        'email',
        'address',
        'employee_id',
        'date_added',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_added' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope to search personnel records.
     */
    public function scopeSearch($query, $term)
    {
        return $query->where('full_name', 'like', "%{$term}%")
                     ->orWhere('email', 'like', "%{$term}%")
                     ->orWhere('contact', 'like', "%{$term}%")
                     ->orWhere('department', 'like', "%{$term}%")
                     ->orWhere('position', 'like', "%{$term}%");
    }
}
