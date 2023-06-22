<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body'
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    // public function setTitleAttribute($value)
    // {
    //     $this->attributes['title'] = $value;
    //     $this->attributes['slug'] = Str::slug($value);
    
    // }

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => [
                'title' => $value,
                'slug'  => Str::slug($value)
            ]
        );
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // protected function url(): Attribute 
    // {
    //     return Attribute::make(
    //         get: fn (string $value) => $value
    //     );
    // }


    // protected function createdDate(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (string $value) => $this->created_at->diffForHumans($value)
    //     );
    // }

}
