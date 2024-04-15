<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function condition(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Condition::class);
    }

    public function format(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Format::class);
    }

    public function publisher(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function language(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function genres(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function authors(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }
}
