<?php

declare(strict_types=1);

namespace App\Models\Traits;

trait GenderCountable
{
    /**
     * Get the total count of males
     */
    public static function getMaleCount(): int
    {
        return static::where('gender', 'M')->count();
    }

    /**
     * Get the total count of females
     */
    public static function getFemaleCount(): int
    {
        return static::where('gender', 'F')->count();
    }

    /**
     * Get the total count of institution
     */
    public static function getInstitutionCount(): int
    {
        return static::where('gender', 'I')->count();
    }

    /**
     * Get the total count of community
     */
    public static function getCommunityCount(): int
    {
        return static::where('gender', 'C')->count();
    }

    /**
     * Get the total count of groups
     */
    public static function getGroupCount(): int
    {
        return static::where('gender', 'G')->count();
    }
}
