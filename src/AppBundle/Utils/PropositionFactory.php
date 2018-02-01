<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace AppBundle\Utils;

use AppBundle\Forms\PropositionSubmission;
use Tiquette\Domain\Ticket;
use Tiquette\Domain\TicketProposition;

class PropositionFactory
{
    public function fromPropositionSubmission(PropositionSubmission $propositionSubmission,$idBuyer,$idTicket): TicketProposition
    {
        return TicketProposition::submit(
            $idTicket,
            $idBuyer,
            $propositionSubmission->comment,
            $propositionSubmission->price
        );
    }
}
