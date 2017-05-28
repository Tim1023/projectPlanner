<?php
namespace ProgramPlanner\Enums;

use MyCLabs\Enum\Enum;

class Credit extends Enum
{
    const ZERO = 0;
    const FIFTEEN = 15;
    const THIRTY = 30;
    const FORTY_FIVE = 45;
    const SIXTY = 60;
    const SEVENTY_FIVE = 75;
    const NINETY = 90;
    const ONE_ZERO_FIVE = 105;
    const ONE_TWENTY = 120;
    const ONE_THIRTY_FIVE = 135;
    const ONE_FIFTY = 150;
    const ONE_SIXTY_FIVE = 165;
    const ONE_EIGHTY = 180;
    const ONE_NINETY_FIVE = 195;
    const TWO_TEN = 210;
    const TWO_TWENTY_FIVE = 225;
    const TWO_FORTY = 240;
    const TWO_FIFTY_FIVE = 255;
    const TWO_SEVENTY = 270;
    const TWO_EIGHTY_FIVE = 285;
    const THREE_HUNDRED = 300;
    const THREE_FIFTEEN = 315;
    const THREE_THIRTY = 330;
    const THREE_FORTY_FIVE = 345;
    const THREE_SIXTY = 360;

     /**
     * Returns all possible values as an array which can be used in a select box
     *
     * @return array Constant name in key, constant value in value
     */
    public static function toList()
    {
        $keys = array();
        foreach (static::toArray() as $key => $value) {
            $keys[$value] = $value;
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