<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use HasFactory, SoftDeletes;

    public const SLUG_PREFIX = '_';

    protected $fillable = [
        'url',
        'user_id',
    ];

    protected static function booted(): void
    {
        static::creating(static function (Link $link) {
            if (empty($link->slug)) {
                $link->slug = self::generateSlug();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shortUrl(): Attribute
    {
        return Attribute::get(function () {
            return rtrim(config('app.url'), '/').'/'.Link::SLUG_PREFIX.$this->slug;
        });
    }

    public function visit(): void
    {
        $this->hits++;
        $this->save();
    }

    public static function generateSlug(): string
    {
        // @todo validate uniqueness
        return \Str::random(6);
    }
}
