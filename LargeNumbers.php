<?php
/**
 * Created by PhpStorm.
 * User: aalekseev
 * Date: 20.08.18
 * Time: 18:46
 */

class LargeNumbers
{
    public static function sum($first, $second)
    {
        if (!LargeNumbers::isNumber($first)) {
            throw new Exception('first is not a number');
        }

        if (!LargeNumbers::isNumber($second)) {
            throw new Exception('second is not a number');
        }

        $first = array_reverse(str_split($first));
        $second = array_reverse(str_split($second));

        $first_len = count($first);
        $second_len = count($second);

        $first_greater_than_second = $first_len > $second_len;
        $max = $first_greater_than_second ? $first : $second;
        $min = $first_greater_than_second ? $second : $first;
        $max_len = $first_greater_than_second ? $first_len : $second_len;
        $min_len = $first_greater_than_second ? $second_len : $first_len;

        $result = "";
        $add = 0; // если переполнение разряда - будем сохранять его тут
        for ($place = 0; $place < $max_len; $place++) {
            if ($place < $min_len) {
                // складываем пока у обоих чисел хватает разрядов
                $local_sum = (int)$max[$place] + (int)$min[$place] + $add;
            } elseif (!empty($add)) {
                // если осталось переполнение разряда а большее из чисел еще не кончилось
                $local_sum = (int)$max[$place] + $add;
            } else {
                // остались только старшие разряды большего числа
                $local_sum = (int)$max[$place];
            }

            if ($local_sum <= 9) {
                $add = 0;
                $result = "{$local_sum}" . $result;
            } else {
                $add = 1;
                $result = (string)($local_sum % 10) . $result;
            }
        }

        if (!empty($add)) {
            $result = "{$add}" . $result;
        }

        return $result;
    }

    private static function isNumber($number)
    {
        if (!is_string($number)) {
            return false;
        }

        $number = str_split($number);
        foreach ($number as $numeral) {
            if (!in_array($numeral, ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'])) {
                return false;
            }
        }

        return true;
    }
}