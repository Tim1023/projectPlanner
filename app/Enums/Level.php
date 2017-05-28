<?php
namespace ProgramPlanner\Enums;

use MyCLabs\Enum\Enum;

class Level extends Enum
{
    const FOUR = 4;
    const FIVE = 5;
    const SIX = 6;
    const SEVEN = 7;
    const EIGHT = 8;
    const NINE = 9;
    const TEN = 10;

     /**
     * Returns all possible values as an array which can be used in a select box
     *
     * @return array Constant name in key, constant value in value
     */
    public static function toList()
    {
        $keys = array();
        foreach (static::toArray() as $key => $value) {
            $keys[$value] = ucfirst(strtolower($key));
        }
        return $keys;
    }

    /**
     * Returns an array of values of the all the enums
     * @return array
     */
    public static function valuesToArray()
    {
        $values = array();
        foreach (static::toArray() as $key => $value) {
            array_push($values,$value);
        }
        return $values;
    }
}