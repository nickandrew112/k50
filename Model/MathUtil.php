<?php

class MathUtil
{
    public static function combinationsCount($n, $m)
    {
        if($m > $n)
        {
            throw new RuntimeException("Incorrect arguments n < m (" . $n  .'<' . $m . ')');
        }

        return bcdiv(static::factorial($n), bcmul(static::factorial($m), static::factorial($n-$m)) );
    }

    public static function factorial($n)
    {
        if($n < 2)
        {
            return 1;
        }

        return bcmul($n , static::factorial($n - 1));
    }
}


