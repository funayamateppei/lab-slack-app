<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_id',
        'user_id',
        'content'
    ];

    protected $dateFormat = 'Y-m-d H:i:s.v';

    // 多対１
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 多対多
    public function attachments()
    {
        return $this->belongsToMany(Attachment::class);
    }

    // 多対１
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
