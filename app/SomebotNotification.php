<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SomebotNotification extends Model
{
    const UPDATED_AT = 'updatedAt';
    protected $connection = 'somebot';
    protected $table = 'notifications';
    protected $fillable = [
        'group_id', 'project_id', 'createdAt', 'updatedAt'
    ];

    public function detailGroup()
    {
        return $this->hasOne(\App\SomebotGroups::class, 'id', 'group_id');
    }

    public function detailProjects()
    {
        return $this->hasOne(\App\SomebotProjects::class, 'id', 'project_id');
    }
}
