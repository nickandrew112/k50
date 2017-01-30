<?php

namespace Controller;

use Model\Combinator;

class Controller
{
    const BAD_REQUEST_CODE = 400;

    const INVALID_FIELDS_COUNT = 1;

    const INVALID_CHIP_COUNT = 2;

    public function generateAction()
    {
        $errorCode = 0;

        if(empty($_POST['fields_count']))
        {
            $errorCode = static::INVALID_FIELDS_COUNT;
        }
        else if(empty($_POST['chip_count']))
        {
            $errorCode = static::INVALID_CHIP_COUNT;
        }

        if(0 !== $errorCode)
        {
            http_response_code(static::BAD_REQUEST_CODE);

            return $errorCode;
        }

        $fieldsCount = intval($_POST['fields_count']);
        $chipCount = intval($_POST['chip_count']);

        $combinator = new Combinator($fieldsCount,$chipCount);
        $combinator->genSet();
        return '';
    }
}


