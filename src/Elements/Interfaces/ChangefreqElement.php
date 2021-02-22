<?php

namespace Rohos\RsSitemap\Elements\Interfaces;

/**
 * Interface ChangefreqElement
 * Вероятная частота изменения этой страницы. Это значение предоставляет общую информацию для поисковых систем
 * и может не соответствовать точно частоте сканирования этой страницы
 * @package Rohos\RsSitemap\Elements\Interfaces
 */
interface ChangefreqElement
{
    /**
     * @var string "всегда" - для описания документов, которые изменяются при каждом доступе к этим документам
     */
    const ALWAYS = 'always';

    /**
     * @var string "ежечасно"
     */
    const HOURLY = 'hourly';

    /**
     * @var string "ежедневно"
     */
    const DAILY = 'daily';

    /**
     * @var string "еженедельно"
     */
    const WEEKLY = 'weekly';

    /**
     * @var string "ежемесячно"
     */
    const MONTHLY = 'monthly';

    /**
     * @var string "ежегодно"
     */
    const YEARLY = 'yearly';

    /**
     * @var string "никогда"
     */
    const NEVER = 'never';
}
