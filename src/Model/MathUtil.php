<?php

namespace Model;

/**
 * Вспомогательный класс для расчетов
 *
 * @category Model
 * @package Model
 * @author TurhishJoe
 *
 */
class MathUtil
{
    /**
     * Метод возвращает число сочетаний без повтороений из n по m
     *
     * @param integer $n - Параметр n
     * @param integer $m - Параметр m
     *
     * @return string Результат функции(Строка используется для больших чисел)
     *
     * @throws \InvalidArgumentException Выбрасывается в случае некорректных аргументов
     */
    public static function combinationsCount($n, $m)
    {
        if (!is_integer($n) || !is_integer($m)) {
            throw new \InvalidArgumentException("Input parametrs are not a number");
        }

        if ($m > $n) {
            throw new \InvalidArgumentException("Incorrect arguments n < m (" . $n . '<' . $m . ')');
        }

        return bcdiv(static::factorialWrapper($n), bcmul(static::factorialWrapper($m), static::factorialWrapper($n - $m), 0));
    }

    /**
     * Вычисляет факториал числа
     *
     * @param integer $n Число
     *
     * @return int|string
     */
    protected static function factorialWrapper($n)
    {
        if ($n < 2) {
            return 1;
        }

        return bcmul($n, static::factorialWrapper($n - 1));
    }
}


