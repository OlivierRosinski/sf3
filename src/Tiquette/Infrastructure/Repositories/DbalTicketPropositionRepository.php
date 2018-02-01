<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Tiquette\Infrastructure\Repositories;

use Doctrine\DBAL\Connection;
use Tiquette\Domain\TicketProposition;
use Tiquette\Domain\TicketPropositionRepository;

class DbalTicketPropositionRepository implements TicketPropositionRepository
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function save(TicketProposition $ticketProposition): void
    {
        $query = <<<SQL
INSERT INTO tickets
    (idTicket, idBuyer, comment, price)
VALUES
    (:idTicket, :idBuyer, :comment, :price)
;
SQL;


        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            'idTicket' => $ticketProposition->getIdTicket(),
            'idBuyer' => $ticketProposition->getIdBuyer(),
            'comment' => $ticketProposition->getComment(),
            'price' => $ticketProposition->getPrice()
        ]);

    }

}
