<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SomebotProjects extends Model
{
    const UPDATED_AT = 'updatedAt';
    protected $connection = 'somebot';
    protected $table = 'projects';
    protected $fillable = [
        'project_id','ref','token', 'createdAt', 'updatedAt'
    ];

    public function detail()
    {
        return $this->hasMany(\App\SomebotNotification::class, 'project_id', 'id');
    }
}
