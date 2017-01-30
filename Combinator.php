<?php

class Combinator
{

    protected $sets = [];

    protected $p = [];

    /**
     * TODO:Add your description
     *
     * @return array
     */
    public function getSets()
    {
        return $this->sets;
    }

    public function genSet($pos = 0, $maxUsed = 0)
    {
        if($pos == $this->m)
        {
            $this->sets[] = $this->p;

            return;
        }

        for ($i = $maxUsed + 1 ; $i <= $this->n ; $i++)
        {
                $this->p[$pos] = $i;
                $this->genSet($pos + 1, $i);
        }
    }



    public function __construct($n, $m)
    {
        $this->n = $n;
        $this->m = $m ;

    }
}


