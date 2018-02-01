<?php
/**
 * Created by PhpStorm.
 * User: metinet
 * Date: 1/31/18
 * Time: 7:17 AM
 */

namespace Tiquette\Domain;


class TicketProposition
{

    private $idTicket;
    private $idBuyer;
    private $price;
    private $comment;

    public static function submit(string $idTicket, string $idBuyer, string $comment, int $price): self
    {
        return new self($idTicket, $idBuyer, $comment, $price);
    }

    /**
     * TicketProposition constructor.
     * @param $idTicket
     * @param $idBuyer
     * @param $price
     */
    public function __construct(string $idTicket, string $idBuyer, int $price, string $comment)
    {
        $this->idTicket = $idTicket;
        $this->idBuyer = $idBuyer;
        $this->price = $price;
        $this->comment = $comment;
    }

    public function getIdTicket(): string
    {
        return $this->idTicket;
    }

    public function getIdBuyer(): string
    {
        return $this->idBuyer;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getComment(): int
    {
        return $this->comment;
    }


}