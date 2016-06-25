<?php

namespace We7Mp\We7;

class AccountWechats extends BaseModel
{
    public function scopeMpid($query, $mpid)
    {
        return $query->where('original', $mpid);
    }
}
