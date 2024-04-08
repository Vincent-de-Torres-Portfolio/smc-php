<?php

namespace Utility;

use Classes\Cart;
use Classes\Member;
use Classes\Ticket\Ticket;
use Classes\Movie;

class CartUtility
{
    /**
     * Get the count of tickets in the cart.
     *
     * @param Cart $cart The cart to count tickets from.
     * @return int The number of tickets in the cart.
     */
    public static function countTicketsInCart(Cart $cart)
    {
        return count($cart->getTickets());
    }
    /**
     * Add a ticket to the cart.
     *
     * @param Cart $cart The cart to add the ticket to.
     * @param Ticket $ticket The ticket to add.
     */
    public static function addTicketToCart(Cart $cart, Ticket $ticket)
    {
        $cart->addTicket($ticket);
    }

    /**
     * Remove a ticket from the cart.
     *
     * @param Cart $cart The cart to remove the ticket from.
     * @param Ticket $ticket The ticket to remove.
     */
    public static function removeTicketFromCart(Cart $cart, Ticket $ticket)
    {
        $cart->removeTicket($ticket);
    }

    /**
     * Purchase all tickets in the cart.
     *
     * @param Cart $cart The cart to purchase tickets from.
     */
    public static function purchaseTickets(Cart $cart, Member $member)
    {
        $tickets = $cart->getTickets();
        if (count($tickets) > 0) {
            $amount = $cart->getSubtotal();
            $purchase = $member->purchase($amount);
            if ($purchase !== false) {
                foreach ($tickets as $ticket) {
                    $member->addTicket($ticket);
                }
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

