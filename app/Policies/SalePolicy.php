<?php

namespace App\Policies;

use Bouncer;
use App\Models\User;
use App\Models\Sale;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if($user->isAn('admin'))
            return true;
    }

    /**
     * Determine whether the user can view the sale.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Sale  $sale
     * @return mixed
     */
    public function view(User $user, Sale $sale)
    {
        return Bouncer::allows('view-sale');
    }

    /**
     * Determine whether the user can create sales.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return Bouncer::allows('create-sale');
    }

    /**
     * Determine whether the user can update the sale.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Sale  $sale
     * @return mixed
     */
    public function update(User $user, Sale $sale)
    {
        return Bouncer::allows('update-sale');
    }

    /**
     * Determine whether the user can delete the sale.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Sale  $sale
     * @return mixed
     */
    public function delete(User $user, Sale $sale)
    {
        return Bouncer::allows('delete-sale');
    }
}
