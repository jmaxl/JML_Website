<?php
declare (strict_types=1);

namespace JML\Module\GenericValueObject;

/**
 * Interface DateInterface
 * @package JML\Module\GenericValueObject
 */
interface DateInterface
{
    /**
     * @return int
     */
    public function getWeekday(): int;
}