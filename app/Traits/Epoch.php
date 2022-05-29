<?php

namespace App\Traits;

use Carbon\Carbon;

trait Epoch
{
    public function getCreatedAtAttribute($value)
    {
        try {
            return Carbon::createFromFormat('Y-m-d H:i:s', $value, 'UTC')->timestamp * 1000;
        } catch (\Exception $exception) {
            return $value;
        }
    }

    public function getUpdatedAtAttribute($value)
    {
        try {
            return Carbon::createFromFormat('Y-m-d H:i:s', $value, 'UTC')->timestamp * 1000;
        } catch (\Exception $exception) {
            return $value;
        }
    }
}
