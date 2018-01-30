<?php

namespace App\Policies;

use Basket;
use App\User;
use App\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return bool;
     */
    public function show(User $user, Order $order)
    {
        return $user->isAdmin() || $user->id==$order->user_id;
    }
}
