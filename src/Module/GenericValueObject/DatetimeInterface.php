<?php
declare(strict_types=1);

namespace JML\Module\GenericValueObject;

interface DatetimeInterface extends DateInterface
{
    public function toString(): string;

    public function getDateString(): string;

    public function getDate(): string;

    public function getTimeString(): string;
}