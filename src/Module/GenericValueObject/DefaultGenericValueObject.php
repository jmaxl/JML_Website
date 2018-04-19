<?php declare(strict_types=1);

namespace JML\Module\GenericValueObject;

class DefaultGenericValueObject implements \JsonSerializable
{
    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}