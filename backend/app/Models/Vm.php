<?php namespace App\Models;

use Server;
use Website;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vm extends Model
{
    use SoftDeletes;

    protected $table = 'vms';

    protected $dates = [
        'backup_last_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'server_id',
        'revers',
        'ip',
        'ssh_port',
        'cpu',
        'ram',
        'swap',
        'storage',
        'type',
        'backup_last_date',
        'notes',
    ];

    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    public function websites()
    {
        return $this->hasMany(Website::class, 'vm_id');
    }

    public function GetNameAttribute()
    {
        return $this->revers . ' (' . $this->ip . ')';
    }

}
