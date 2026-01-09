<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait GeneratesDateBasedId
{
    /**
     * Boot the trait and automatically generate date-based ID
     */
    protected static function bootGeneratesDateBasedId()
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = static::generateDateBasedId();
            }
        });
    }

    /**
     * Generate unique date-based ID with format: YYYYMM0001
     * Example: 2025080001, 2025080002, etc.
     *
     * @return int
     */
    public static function generateDateBasedId(): int
    {
        $table = (new static)->getTable();
        $keyName = (new static)->getKeyName();

        // Get current year and month
        $prefix = date('Ym'); // YYYYMM format (e.g., 202508)

        // Find the last ID with the same prefix
        $lastRecord = DB::table($table)
            ->where($keyName, 'LIKE', $prefix . '%')
            ->orderBy($keyName, 'desc')
            ->first();

        if ($lastRecord) {
            // Extract the last 4 digits (sequence number) and increment
            $lastId = (string) $lastRecord->{$keyName};
            $sequence = (int) substr($lastId, -4);
            $newSequence = $sequence + 1;
        } else {
            // First record of the month
            $newSequence = 1;
        }

        // Format: YYYYMM + 4-digit sequence number (padded with zeros)
        return (int) ($prefix . str_pad($newSequence, 4, '0', STR_PAD_LEFT));
    }

    /**
     * Indicate that IDs are NOT auto-incrementing
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Set the key type to integer
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'int';
    }
}
