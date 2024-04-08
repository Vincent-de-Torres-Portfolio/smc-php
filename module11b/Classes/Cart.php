<?php

namespace Classes;

use Classes\Member;
use Classes\Ticket\Ticket;
use Classes\Ticket\ChildTicket;
use Classes\Ticket\StudentTicket;
use Classes\Ticket\SeniorTicket;
use Classes\Ticket\GeneralTicket;

class Cart
{
    private $cartId;
    private $member;
    private $tickets;
    private $subtotal;

    private $ticket_count;

    public function __construct(string $cartId, Member $member)
    {
        $this->cartId = $cartId;
        $this->member = $member;
        $this->tickets =[];
        $this->subtotal = 0;

    }

    public function addTicket(Ticket $ticket)
    {
        // Add ticket to cart
        $this->tickets[] = $ticket;
        $this->subtotal += $ticket->getPrice();

        // Update ticket count after adding ticket
        $this->ticket_count = count($this->tickets);
    }

    public function removeTicket(int $ticketIndex)
    {
        // Remove ticket from cart
        if (isset($this->tickets[$ticketIndex])) {
            $this->subtotal -= $this->tickets[$ticketIndex]->getPrice();
            unset($this->tickets[$ticketIndex]);
            $this->tickets = array_values($this->tickets); // Re-index the array

            // Update ticket count after removing ticket
            $this->ticket_count = count($this->tickets);

            return true;
        }
        return false;
    }

    public function getCartSummary(): string
    {
        $summaryHTML = '<div class="cart-summary">';
        $summaryHTML .= '<h2 class="title-small-text">Cart Summary</h2><hr>';
        // Initialize $totalPrice
        $totalPrice = 0;

        // Check if there are tickets in the cart
        if (!empty($this->tickets)) {
            $summaryHTML .= '<div class="cart-items">';

            // Loop through tickets in the cart and create summary for each
            foreach ($this->tickets as $ticket) {
                $summaryHTML .= '<div class="cart-item">';
                $summaryHTML .= '<p class="title-small-text"> ' . $ticket->getMovieName() . '</p>';
                $summaryHTML .= '<p class="caption-text"> ID: ' . $ticket->getId() . '</p>';
                $summaryHTML .= '<p class="caption-text">Ticket Type: ' . $ticket->getType() . '</p>';
                $summaryHTML .= '<p class="caption-text"> $' . number_format($ticket->getPrice(), 2) . '</p>';
                $summaryHTML .= '</div>';
                $totalPrice += $ticket->getPrice();
            }

            $summaryHTML .= '</div>'; // Close cart-items div
            $summaryHTML .= '<p class="body-small-text"><strong>Subtotal:</strong> $' . number_format($totalPrice, 2) . '</p>';
        } else {
            $summaryHTML .= '<p class="body-small-text">Your cart is empty.</p>';
        }

        $summaryHTML .= '</div>'; // Close cart-summary div
        return $summaryHTML;
    }


    public function getTicketCount()
    {
        return $this->ticket_count;
    }


    public function purchase()
    {
        // Calculate the total purchase amount
        $totalAmount = $this->subtotal;

        // Check if member's balance is enough for the total purchase amount
        $purchaseResult = $this->member->purchase(-$totalAmount);

        if ($purchaseResult !== false) {
            // Generate random receipt ID
            $receiptId = uniqid('RECEIPT_');

            // Breakdown of tickets
            $ticketDetails = [];
            foreach ($this->tickets as $ticket) {
                $ticketDetails[] = [
                    'Ticket ID' => $ticket->getId(),
                    'Type' => $ticket->getType(),
                    'Price' => $ticket->getPrice()
                ];
            }

            // Append tickets to member's ticket history
            // $this->member->addTicketHistory($ticketDetails);

            // Clear the cart
            $this->tickets = [];
            $this->subtotal = 0;

            // Return receipt ID
            return $receiptId;
        } else {
            return false; // Insufficient balance
        }
    }

    public function getCartId(): string
    {
        return $this->cartId;
    }

    public function getMemberId(): string
    {
        return $this->member->getMemberId();
    }

    public function getMember(): Member
    {
        return $this->member;
    }

    public function getTickets(): array
    {
        return $this->tickets;
    }

    public function getSubtotal(): float
    {
        return $this->subtotal;
    }

    public function getHtmlDetails(): string
    {
        $details = "<div class='cart-details'>";
        $details .= "<h2>Cart Details</h2>";
        $details .= "<p>Member: {$this->member->getName()}</p>";
        $details .= "<p>Member ID: {$this->member->getMemberId()}</p>";
        $details .= "<p>Cart ID: {$this->cartId}</p>";
        $details .= "<p>Subtotal : {$this->subtotal}</p>";

        // Loop through tickets in the cart and get HTML details
        foreach ($this->tickets as $ticket) {
            $details .= $ticket->getHtmlDetails();
        }

        $details .= "</div>";
        return $details;
    }
}
