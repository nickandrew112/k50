<?php

class MathUtil
{
    public static function getValue($n)
    {
        if($n < 2)
        {
            return 1;
        }

        return bcmul($n , static::getValue($n - 1));
    }
}


