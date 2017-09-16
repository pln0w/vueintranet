<?php namespace App\Models;

use User;
use Website;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $table = 'projects';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'project_manager_id',
        'name',
        'type',
        'php_version',
        'database',
        'git_ssh',
        'git_http',
        'vagrant_ip',
        'description',
        'notes',
    ];

    public function websites()
    {
        return $this->hasMany(Website::class);
    }

    public function project_manager()
    {
        return $this->belongsTo(User::class);
    }

}