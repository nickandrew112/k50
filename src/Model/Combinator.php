<?php

namespace Model;

class Combinator
{

    protected  $fieldsCount;

    protected $chipCount;

    protected $set = [];


    public function genSet($pos = 0, $maxUsed = 0)
    {
        if($pos == $this->chipCount)
        {
            //TODO:Add action
            return;
        }

        for ($i = $maxUsed + 1 ; $i <= $this->fieldsCount ; $i++)
        {
                $this->set[$pos] = $i;
                $this->genSet($pos + 1, $i);
        }
    }



    public function __construct($fieldsCount, $chipCount)
    {
        if(!is_integer($fieldsCount) || !is_integer($chipCount))
        {
            throw new \RuntimeException( "Bad Constructor Args");
        }

        $this->n = $fieldsCount;
        $this->m = $chipCount ;

    }
}


