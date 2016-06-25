<?php
namespace We7Mp\We7;

class CoreCache extends BaseModel
{
    protected $table = 'core_cache';
    protected $primaryKey = 'key';

    public function scopeAccessToken($query, $acid)
    {
        return $query->where('key', 'accesstoken:' . $acid);
    }
}
