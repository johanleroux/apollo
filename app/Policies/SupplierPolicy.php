<?php

namespace App\Policies;

use Bouncer;
use App\Models\User;
use App\Models\Supplier;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupplierPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if($user->isAn('admin'))
            return true;
    }

    /**
     * Determine whether the user can view the supplier.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Supplier  $supplier
     * @return mixed
     */
    public function view(User $user, Supplier $supplier)
    {
        return Bouncer::allows('view-supplier');
    }

    /**
     * Determine whether the user can create suppliers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return Bouncer::allows('create-supplier');
    }

    /**
     * Determine whether the user can update the supplier.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Supplier  $supplier
     * @return mixed
     */
    public function update(User $user, Supplier $supplier)
    {
        return Bouncer::allows('update-supplier');
    }

    /**
     * Determine whether the user can delete the supplier.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Supplier  $supplier
     * @return mixed
     */
    public function delete(User $user, Supplier $supplier)
    {
        return Bouncer::allows('delete-supplier');
    }
}
