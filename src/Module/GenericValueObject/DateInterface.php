<?php
declare(strict_types = 1);

namespace Project\Module\GenericValueObject;

interface DateInterface
{
    /**
     * @return int
     */
    public function getWeekday(): int;
}