<?php namespace App\Models;

use Vm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Server extends Model
{
    use SoftDeletes;

    protected $table = 'servers';

    protected $dates = [
        'payment_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'name',
        'revers',
        'ip',
        'ssh_port',
        'provider',
        'cpu',
        'ram',
        'swap',
        'storage',
        'payment_date',
        'notes',
    ];

    public function vms()
    {
        return $this->hasMany(Vm::class);
    }

}
