<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Tiquette\Domain;

class Ticket
{

    private $idTicket;
    private $eventName;
    private $eventDate;
    private $eventDescription;
    private $boughtAtPrice;
    private $idSeller;
    private $isAccepted;

    public static function submit(string $eventName, \DateTimeImmutable $eventDate, string $eventDescription,
        int $boughtAtPrice, string $idSeller): self
    {
        return new self(TicketId::generate(),$eventName, $eventDate, $eventDescription, $boughtAtPrice, $idSeller);
    }

    public function getIdTicket() : string
    {
        return $this->idTicket;
    }

    public function getEventName(): string
    {
        return $this->eventName;
    }

    public function getEventDate(): \DateTimeImmutable
    {
        return $this->eventDate;
    }

    public function getEventDescription(): string
    {
        return $this->eventDescription;
    }

    public function getBoughtAtPrice(): int
    {
        return $this->boughtAtPrice;
    }

    public function getIdSeller()
    {
        return $this->idSeller;
    }

    public function isAccepted(): bool
    {
        return $this->isAccepted;
    }

    private function __construct(TicketId $idTicket, string $eventName, \DateTimeImmutable $eventDate, string $eventDescription, int $boughtAtPrice, string $idSeller, bool $isAccepted)
    {
        $this->idTicket = $idTicket;
        $this->eventName = $eventName;
        $this->eventDate = $eventDate;
        $this->eventDescription = $eventDescription;
        $this->boughtAtPrice = $boughtAtPrice;
        $this->idSeller = $idSeller;
        $this->isAccepted = $isAccepted;
    }

    /**
     * This method should be used only to hydrate object from a persistent storage
     * and never to create / sign up a Member.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            TicketId::fromString($data['idTicket']),
            $data['event_name'],
            \DateTimeImmutable::createFromFormat('Y-m-d H:i:00', $data['event_date']),
            $data['event_description'],
            0,
            $data['idSeller'],
            0
        );
    }
}
