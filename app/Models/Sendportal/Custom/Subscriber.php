<?php

namespace App\Models\Sendportal\Custom;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $table = 'sendportal_subscribers';
    public $primarykey = 'id';
    public $timestamp = true;
    protected $fillable = [
        'workspace_id',
        'hash',
        'email',
        'first_name',
        'last_name',
        'meta',
        'unsubscribed_at',
        'unsubscribe_event_id',
    ];
}
