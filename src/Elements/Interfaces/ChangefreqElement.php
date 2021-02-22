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
    const CHANGEFREQ_ALWAYS = 'always';

    /**
     * @var string "ежечасно"
     */
    const CHANGEFREQ_HOURLY = 'hourly';

    /**
     * @var string "ежедневно"
     */
    const CHANGEFREQ_DAILY = 'daily';

    /**
     * @var string "еженедельно"
     */
    const CHANGEFREQ_WEEKLY = 'weekly';

    /**
     * @var string "ежемесячно"
     */
    const CHANGEFREQ_MONTHLY = 'monthly';

    /**
     * @var string "ежегодно"
     */
    const CHANGEFREQ_YEARLY = 'yearly';

    /**
     * @var string "никогда"
     */
    const CHANGEFREQ_NEVER = 'never';
}
