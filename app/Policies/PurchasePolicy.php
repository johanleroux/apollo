<?php

namespace App\Policies;

use Bouncer;
use App\Models\User;
use App\Models\Purchase;
use Illuminate\Auth\Access\HandlesAuthorization;

class PurchasePolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if($user->isAn('admin'))
            return true;
    }

    /**
     * Determine whether the user can view the purchase.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Purchase  $purchase
     * @return mixed
     */
    public function view(User $user, Purchase $purchase)
    {
        return Bouncer::allows('view-purchase');
    }

    /**
     * Determine whether the user can create purchases.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return Bouncer::allows('create-purchase');
    }

    /**
     * Determine whether the user can update the purchase.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Purchase  $purchase
     * @return mixed
     */
    public function update(User $user, Purchase $purchase)
    {
        return Bouncer::allows('update-purchase');
    }

    /**
     * Determine whether the user can delete the purchase.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Purchase  $purchase
     * @return mixed
     */
    public function delete(User $user, Purchase $purchase)
    {
        return Bouncer::allows('delete-purchase');
    }
}
