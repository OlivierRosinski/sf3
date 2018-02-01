<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Tiquette\Infrastructure\Repositories;

use Doctrine\DBAL\Connection;
use Tiquette\Domain\Ticket;
use Tiquette\Domain\TicketRepository;

class DbalTicketRepository implements TicketRepository
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function save(Ticket $ticket): void
    {
        $query = <<<SQL
INSERT INTO tickets
    (idTicket, event_name, event_description, event_date, bought_at_price, price_currency, idSeller, isAccepted)
VALUES
    (:idTicket, :event_name, :event_description, :event_date, :bought_at_price, :price_currency, :idSeller, :isAccepted)
;
SQL;


        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            'idTicket' => $ticket->getIdTicket(),
            'event_name' => $ticket->getEventName(),
            'event_description' => $ticket->getEventDescription(),
            'event_date' => $ticket->getEventDate()->format('Y-m-d\TH:i:00'),
            'bought_at_price' => $ticket->getBoughtAtPrice(),
            'price_currency' => 'EUR',
            'idSeller' => $ticket->getIdSeller(),
            'isAccepted' => 0
        ]);

    }

    public function getTicketById($idTicket){
        $query = 'SELECT * FROM tickets WHERE idTicket = "'.$idTicket.'"';
        return $this->connection->fetchAll($query);
    }

    public function findAll(): array
    {
        $query =<<<SQL
SELECT * FROM tickets;
SQL;

        $statement = $this->connection->prepare($query);
        $statement->execute();

        $tickets = [];

        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {

            $tickets[] = $this->hydrateFromRow($row);
        }

        return $tickets;
    }

    public function findAllInSell(): array
    {
        $query =<<<SQL
SELECT * FROM tickets WHERE isAccepted = 0 ;
SQL;

        $statement = $this->connection->prepare($query);
        $statement->execute();

        $tickets = [];

        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {

            $tickets[] = $this->hydrateFromRow($row);
        }

        return $tickets;
    }



    private function hydrateFromRow(array $row): Ticket
    {
        return Ticket::fromArray($row);
    }
}
