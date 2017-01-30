<?php
/**
 * test_task_k50
 *
 * @category System
 * @package System
 * @author TurhishJoe
 *
 */
namespace System;

/**
 * Перехватчик ошибок
 *
 * @category System
 * @package System
 * @author TurhishJoe
 *
 */
final class ErrorHandler
{
    /**
     * Тип php ошибок, которые превращаются в исключения в ходе работы программы
     *
     * @var array
     */
    static $allowedErrors = [E_ERROR, E_PARSE, E_COMPILE_ERROR || E_CORE_ERROR];

    /**
     * Singleton instance
     *
     * @var null|$this
     */
    protected static $instance = null;

    /**
     * Объект Singleton instance
     *
     * @return void
     */
    public static function init()
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }
    }

    /**
     * Обработчик, который преобразуют любую php-ошибку в исключение(удобнее в обработке)
     *
     * @param int $errorType уровень ошибки
     * @param string $errorString сообщение об ошибке
     * @param string $file имя файла, в котором произошла ошибка
     * @param int $line номер строки, в которой произошла ошибка
     *
     * @throws \ErrorException
     */
    public function handlePhpError($errorType, $errorString, $file, $line)
    {
        throw new \ErrorException($errorString, 0, $errorType, $file, $line);
    }

    /**
     * Перехват фатальных ошибок php
     *
     * @return boolean
     */
    public function fatalErrorHandler()
    {
        $error = error_get_last();

        if (isset($error['type']) && in_array($error['type'], self::$allowedErrors)) {
            // запускаем обработчик ошибок
            $this->handlePhpError($error['type'], $error['message'], $error['file'], $error['line']);
        }

        return true;
    }

    /**
     * Application constructor.
     *
     */
    private function __construct()
    {
        set_error_handler([$this, 'handlePhpError'], E_ALL);

        register_shutdown_function([$this, 'fatalErrorHandler']);
    }


    /**
     * Запрещаем клонировать объект
     *
     * @return void
     */
    private function __clone()
    {
    }

}