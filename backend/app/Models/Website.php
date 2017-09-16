<?php namespace App\Models;

use Project;
use Vm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends Model
{

    use SoftDeletes;

    protected $table = 'websites';

    protected $dates = [
        'backup_last_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'vm_id',
        'project_id',
        'domain',
        'type',
        'backup_last_date',
        'notes',
    ];

    public function vm()
    {
        return $this->belongsTo(Vm::class, 'vm_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
