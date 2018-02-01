<?php

namespace AppBundle\Controller;

use AppBundle\Forms\MemberSignUp;
use AppBundle\Forms\TicketSubmission;
use AppBundle\Forms\PropositionSubmission;
use AppBundle\Forms\Types\TicketSubmissionType;
use AppBundle\Forms\Types\PropositionSubmissionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolation;
use Tiquette\Domain\Ticket;

class SalesController extends Controller
{
    public function submitTicketAction(Request $request): Response
    {
        $ticketSubmission = new TicketSubmission();

        $ticketSubmissionForm = $this->createForm(TicketSubmissionType::class, $ticketSubmission);

        if ($request->isMethod('POST')) {
            $ticketSubmissionForm->handleRequest($request);
            if ($ticketSubmissionForm->isSubmitted() && $ticketSubmissionForm->isValid()) {


                $ticket = $this->get('ticket_factory')->fromTicketSubmission($ticketSubmission,'bc7e8bae-581c-4813-aa69-d4d0ff9a9484');
                $this->get('repositories.ticket')->save($ticket);

                return $this->redirectToRoute('ticket_submission_successful');
            }
        }

        return $this->render('@App/Sales/submit_ticket.html.twig', ['ticketSubmissionForm' => $ticketSubmissionForm->createView()]);
    }

    public function ticketSubmissionSuccessfulAction(Request $request): Response
    {
        return $this->render('@App/Sales/ticket_submission_successful.html.twig');
    }

    public function listAllTicketsAction(Request $request): Response
    {
        $tickets = $this->get('repositories.ticket')->findAllInSell();

        return $this->render('@App/Sales/tickets_in_sell.html.twig', ['tickets' => $tickets]);
    }

    public function showTicketAction($idTicket, Request $request) : Response{
        $ticket =  $this->get('repositories.ticket')->getTicketById($idTicket);

        $propositionSubmission = new PropositionSubmission();
        $propositionSubmissionForm = $this->createForm(PropositionSubmissionType::class,$propositionSubmission);

        if ($request->isMethod('POST')) {
            $propositionSubmissionForm->handleRequest($request);
            if ($propositionSubmissionForm->isSubmitted() && $propositionSubmissionForm->isValid()) {


                $ticketProposition = $this->get('proposition_factory')->fromPropositionSubmission($propositionSubmission,'bc7e8bae-581c-4813-aa69-d4d0ff9a9484',$ticket);
                $this->get('repositories.ticket_proposition')->save($ticketProposition);

                return $this->redirectToRoute('proposition_submission_successful');
            }
        }

        return $this->render('@App/Sales/ticket_page.html.twig', ['arrayTicket' => $ticket, 'propositionSubmissionForm' => $propositionSubmissionForm->createView()]);
    }
}
