<?php

namespace App\Models\Helpers;

use App\Models\Girinka;
use App\Models\Goat;
use App\Models\Individual;
use App\Models\Scholarship;
use App\Models\Tank;
use App\Models\Vsla;

class TotalNumbers
{
    /**
     * Get the total count of cows
     */
    public static function getCows(): int
    {
        return Girinka::count();
    }

    /**
     * Get the total count of goats
     */
    public static function getGoats(): int
    {
        return Goat::count();
    }

    /**
     * Get the total count of water tanks
     */
    public static function getWaterTanks(): int
    {
        return Tank::count();
    }

    /**
     * Get the total count of scholarships
     */
    public static function getScholarships(): int
    {
        return Scholarship::count();
    }

    /**
     * Get the total count of individual microcredits
     */
    public static function getIndividualMicrocredits(): int
    {
        return Individual::count();
    }

    /**
     * Get the total count of VSLAs (Village Savings and Loan Associations)
     */
    public static function getVslas(): int
    {
        return Vsla::count();
    }

    /**
     * Get all counts as an associative array
     */
    public static function getAllCounts(): int
    {
        return self::getCows() + self::getGoats() + self::getWaterTanks() + self::getScholarships() + self::getIndividualMicrocredits() + self::getVslas();
    }

    public static function femaleBeneficiaries(): int
    {
        return Girinka::where('gender', '=', 'F')->count() +
            Goat::where('gender', '=', 'F')->count() +
            Tank::where('gender', '=', 'F')->count() +
            Vsla::where('gender', '=', 'F')->count() +
            Scholarship::where('gender', '=', 'F')->count() +
            Individual::where('gender', '=', 'F')->count();
    }
}
