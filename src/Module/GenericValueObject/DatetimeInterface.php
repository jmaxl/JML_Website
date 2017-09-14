<?php
declare(strict_types=1);

namespace Project\Module\GenericValueObject;

interface DatetimeInterface extends DateInterface
{
    public function toString(): string;

    public function getDateString(): string;

    public function getDate(): string;

    public function getTimeString(): string;
}