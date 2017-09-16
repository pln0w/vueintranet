<?php namespace App\Models;

use User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $table = 'events';

    protected $dates = [
        'start',
        'end',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'title',
        'description',
        'start',
        'end',
        'all_day',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
