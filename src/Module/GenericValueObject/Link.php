<?php
declare(strict_types=1);

namespace Project\Module\GenericValueObject;

use League\Uri\Schemes\Http;

class Link
{
    /** @var  Http $link */
    protected $link;

    /**
     * @param string $link
     * @return Link
     */
    public static function fromString(string $link): self
    {
        $link = Http::createFromString($link);

        return new self($link);
    }

    /**
     * Link constructor.
     * @param Http $link
     */
    protected function __construct(Http $link)
    {
        $this->link = $link;
    }

    /**
     * @return Http
     */
    public function getLink(): Http
    {
        return $this->link;
    }

    public function __toString(): string
    {
        return (string) $this->link;
    }

    public function toString(): string
    {
        return (string) $this->link;
    }


}