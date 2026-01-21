<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personnel extends Model
{
    use HasFactory, SoftDeletes;

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

    protected $casts = [
        'date_added' => 'datetime',
    ];

    /**
     * Get all unique departments.
     */
    public static function getDepartments()
    {
        return self::distinct('department')->pluck('department');
    }

    /**
     * Get personnel count by department.
     */
    public static function countByDepartment()
    {
        return self::selectRaw('department, count(*) as count')
                   ->groupBy('department')
                   ->get();
    }

    /**
     * Search personnel records.
     */
    public static function search($query)
    {
        return self::where('full_name', 'like', "%{$query}%")
                   ->orWhere('email', 'like', "%{$query}%")
                   ->orWhere('position', 'like', "%{$query}%")
                   ->orWhere('department', 'like', "%{$query}%")
                   ->orWhere('contact', 'like', "%{$query}%")
                   ->get();
    }
}
