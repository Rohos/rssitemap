<?php

namespace Rohos\RsSitemap\Elements;

use Rohos\RsSitemap\Elements\Interfaces\Element;
use Rohos\RsSitemap\Validators\PriorityValidator;
use Rohos\RsSitemap\Validators\ChangefreqValidator;
use Rohos\RsSitemap\Exceptions\NotSetRequiredValueException;
use Rohos\RsSitemap\Exceptions\IncorrectElementValueException;

/**
 * Class Url
 * Родительский тег для каждой записи URL-адреса
 * @package Rohos\RsSitemap\Elements
 */
class Url implements Element
{
    /** @var string */
    const TAG_LOC = 'loc';

    /** @var string */
    const TAG_LASTMOD = 'lastmod';

    /** @var string */
    const TAG_CHANGEFREQ = 'changefreq';

    /** @var string */
    const TAG_PRIORITY = 'priority';

    /** @var array */
    protected $data = [];

    /** @var string */
    private $newLine;

    /**
     * Url constructor.
     * @param string $newLine
     */
    public function __construct(string $newLine = '')
    {
        $this->newLine = $newLine;
    }

    /**
     * @inheritDoc
     */
    public function tag(): string
    {
        return 'url';
    }

    /**
     * @inheritDoc
     */
    public function beginTag(): string
    {
        return ElementBuilder::i()->buildBeginTag($this->tag());
    }

    /**
     * @inheritDoc
     */
    public function endTag(): string
    {
        return ElementBuilder::i()->buildEndTag($this->tag());
    }

    /**
     * URL-адрес страницы [обязательный]
     * @TODO Add validator
     * @param string $val
     * @return $this
     */
    public function setLoc(string $val): self
    {
        $this->data[self::TAG_LOC] = $val;
        return $this;
    }

    /**
     * Дата последнего изменения файла [необязательно]
     * Эта дата должна быть в формате W3C Datetime
     * Этот формат позволяет при необходимости опустить сегмент времени и использовать формат ГГГГ-ММ-ДД
     * @see https://www.w3.org/TR/NOTE-datetime
     * @TODO Add validator
     * @param string $val
     * @return $this
     */
    public function setLastmod(string $val): self
    {
        $this->data[self::TAG_LASTMOD] = $val;
        return $this;
    }

    /**
     * Вероятная частота изменения этой страницы [необязательно]
     * Значения - ChangefreqElement::CHANGEFREQ_*
     * @param string $val
     * @return $this
     * @throws IncorrectElementValueException
     */
    public function setChangefreq(string $val): self
    {
        ChangefreqValidator::i()->check($val);

        $this->data[self::TAG_CHANGEFREQ] = $val;
        return $this;
    }

    /**
     * Приоритетность URL относительно других URL на Вашем сайте. Допустимый диапазон значений — от 0.0 до 1.0
     * @param float|int|string $val
     * @return $this
     * @throws IncorrectElementValueException
     */
    public function setPriority($val): self
    {
        PriorityValidator::i()->check($val);

        $this->data[self::TAG_PRIORITY] = $val;
        return $this;
    }

    /**
     * @return string
     * @throws NotSetRequiredValueException
     */
    public function buildXml(): string
    {
        if (empty($this->data[self::TAG_LOC])) {
            throw new NotSetRequiredValueException('Not set value for: '. self::TAG_LOC);
        }

        $element = $this->beginTag() . $this->newLine;

        foreach ($this->data as $tag => $val) {
            $element .= ElementBuilder::i()->build($tag, $val, $this->newLine);
        }

        $xml = $element . $this->endTag() . $this->newLine;

        $this->clearData();

        return $xml;
    }

    protected function clearData()
    {
        $this->data = [];
    }
}
