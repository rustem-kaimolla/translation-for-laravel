<?php
namespace KaimollaRustem\LaravelTranslation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Аудармалар моделі
 */
class Translation extends \Illuminate\Database\Eloquent\Model
{
    use HasFactory;

    protected $primaryKey = 'code';

    /**
     * @var string[]
     */
    protected $fillable = [
        'code',
        'translations',
    ];

    protected $casts = [
        'translations' => 'array',
    ];
}
