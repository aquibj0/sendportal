<?php

namespace App\Models\Sendportal\Custom;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagSubscriber extends Model
{
    use HasFactory;

    protected $table = 'sendportal_tag_subscriber';
    public $primarykey = 'id';
    public $timestamp = true;
    protected $fillable = [
        'tag_id',
        'subscriber_id',
    ];
}
