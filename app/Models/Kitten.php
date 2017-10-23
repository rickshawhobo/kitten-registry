<?php

namespace App\Models;

use Carbon\Carbon;

class Kitten extends Model
{

    /**
     * Given an age range, find date of birth with that date range
     * If no max age is given then the range is 1 year
     *
     * @param $query
     * @param $minAge
     * @param null $maxAge
     * @return mixed
     */
    public function scopeAge($query, $minAge, $maxAge = null)
    {

        $maxAge = $maxAge ?? $minAge;
        return $query->where('dob', '>', Carbon::now()->subYear($minAge + 1))->where('dob', '<', Carbon::now()->subYear($maxAge));
    }

    /**
     * Given a string, find all records with first name that start with that string
     * @param $query
     * @param $firstName
     * @return mixed
     */
    public function scopeFirstNameLike($query, $firstName)
    {
        return $query->where('firstName', 'like', "$firstName%");
    }

    /**
     * Given a string, find all records with last name that start with that string
     * @param $query
     * @param $lastName
     * @return mixed
     */
    public function scopeLastNameLike($query, $lastName)
    {
        return $query->where('lastName', 'like', "$lastName%");
    }

    /**
     * Given a color find all records that match that color
     *
     * @param $query
     * @param $color
     * @return mixed
     */
    public function scopeColor($query, $color) {
        return $query->where('color', $color);
    }
}