<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'recipient_id','recipient_type','sender_id','body'
    ];


   
    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id');
    }

    public function recipient()
    {
        return $this->morphTo();
    }


}
