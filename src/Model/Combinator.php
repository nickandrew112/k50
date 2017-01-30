<?php

namespace Model;

/**
 * Класс, который генерирует все возможные сочетания и записывает результат в фаил
 *
 * @category Model
 * @package Model
 * @author TurhishJoe
 */
class Combinator
{
    /**
     * Число ячеек
     *
     * @var integer
     */
    protected $fieldsCount;

    /**
     * Число монет
     *
     * @var integer
     */
    protected $chipCount;

    /**
     * Текущий сет
     *
     * @var array
     */
    protected $set = [];

    /**
     * Ссылка на фаил
     *
     * @var resource
     */
    protected $fileHandler;

    /**
     * Метод генерующий все варианты сочетании монет по ячейкам и обрабатывающий входные аргументы
     *
     * @param string $fileName Имя выходного файла
     *
     * @return void
     *
     * @throws \RuntimeException Выбрасывается в случае если возникли проблемы при записи в выходной фаил
     */
    public function genSet($fileName)
    {
        if (!file_exists($fileName)) {
            throw new \RuntimeException("File not exists");
        } else if (!is_writable($fileName)) {
            throw new \RuntimeException("File Write:Permission denied");
        } else {
            $this->fileHandler = fopen($fileName, 'w');
        }

        $count = MathUtil::combinationsCount($this->fieldsCount, $this->chipCount);

        if (bccomp($count, 10) < 0) {
            fwrite($this->fileHandler, 'менее 10 вариантов');
        } else {
            fwrite($this->fileHandler, $count . PHP_EOL);
            $this->genSetWrapper();
        }

        fclose($this->fileHandler);
    }

    /**
     * Метод генерующий все варианты сочетании монет по ячейкам
     *
     * @param int $pos Параметр для рекурсивного алгоритма
     * @param int $maxUsed Параметр для рекурсивного алгоритма
     *
     * @return void
     */
    protected function genSetWrapper($pos = 0, $maxUsed = 0)
    {
        if ($pos == $this->chipCount) {
            $this->onGenerateRow();

            return;
        }

        for ($i = $maxUsed + 1; $i <= $this->fieldsCount; $i++) {
            $this->set[$pos] = $i;
            $this->genSetWrapper($pos + 1, $i);
        }
    }

    /**
     * Событие произошедшее при генерации строки
     *
     * @return void
     */
    protected function onGenerateRow()
    {
        fwrite($this->fileHandler, implode(' ', $this->set) . PHP_EOL);
    }

    /**
     * Combinator constructor.
     *
     * @param integer $fieldsCount Число ячеек
     * @param integer $chipCount Число монет
     *
     * @throws \InvalidArgumentException Выбрасывается в случае если аргументы не являются числом
     */
    public function __construct($fieldsCount, $chipCount)
    {
        if (!is_integer($fieldsCount) || !is_integer($chipCount)) {
            throw new \InvalidArgumentException("Bad Constructor fields and chip Args");
        }


        $this->fieldsCount = $fieldsCount;
        $this->chipCount = $chipCount;

    }
}


