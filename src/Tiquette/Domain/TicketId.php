<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Tiquette\Domain;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class TicketId
{
    private $idTicket;

    public static function fromString(string $idTicket): self
    {
        return new self(Uuid::fromString($idTicket));
    }

    public static function generate(): self
    {
        return new self(Uuid::uuid4());
    }

    public function __toString()
    {
        return $this->idTicket->toString();
    }

    public function __construct(UuidInterface $idTicket)
    {
        $this->idTicket = $idTicket;
    }
}
