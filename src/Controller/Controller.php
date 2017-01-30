<?php

namespace Controller;

use Model\Combinator;

/**
 * Контроллер
 *
 * @category Controller
 * @package Controller
 * @author TurhishJoe
 */
class Controller
{
    /**
     * HTTP возвращаемый при некорректных параметрах
     */
    const BAD_REQUEST_CODE = 400;

    /**
     * HTTP возвращаемый при ошибке сервера
     */
    const SERVER_ERROR_CODE = 500;


    /**
     * Действие генерации
     *
     * @return string
     */
    public function generateAction()
    {
        if(empty($_POST['fields_count']) || empty($_POST['chip_count']))
        {
            http_response_code(static::BAD_REQUEST_CODE);

        }

        $fieldsCount = intval($_POST['fields_count']);
        $chipCount = intval($_POST['chip_count']);

        try {
            $combinator = new Combinator($fieldsCount, $chipCount);
            $combinator->genSet();
        }
        catch (\InvalidArgumentException $e)
        {
            http_response_code(static::BAD_REQUEST_CODE);
        }
        catch (\Exception $e)
        {
            http_response_code(static::SERVER_ERROR_CODE);

            return '';
        }

        return '';
    }
}


