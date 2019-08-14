<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Expenditure;

class ExpenditurePolicy
{
    use HandlesAuthorization;
    
    public function destroy(User $currentUser, Expenditure $expenditure)
    {
    	return $currentUser->id === $expenditure->user_id;
    }
}
