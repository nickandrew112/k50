<?php

class Controller
{
    public function generateAction()
    {
        $combinator = new Combinator(5,3);
        $combinator->genSet();
        var_dump($combinator->getSets());
    }
}


