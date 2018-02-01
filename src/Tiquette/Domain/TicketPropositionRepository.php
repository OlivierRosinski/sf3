<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Tiquette\Domain;

interface TicketPropositionRepository
{
    public function save(TicketProposition $ticketProposition): void;

}
