<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SomebotGroups extends Model
{
    const UPDATED_AT = 'updatedAt';
    protected $connection = 'somebot';
    protected $table = 'groups';
    protected $fillable = [
        'group_id', 'name', 'createdAt', 'updatedAt'
    ];

    public function detail()
    {
        return $this->hasMany(\App\SomebotNotification::class, 'group_id', 'id');
    }
}
