<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TeamTitle;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamTitlePolicy
{
    use HandlesAuthorization;

    /**
     * LA CLÉ MAGIQUE POUR LE TITRE
     */
    public function before(User $user, $ability)
    {
        if ($user->hasRole('super_admin')) {
            return true;
        }
    }

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_team_title');
    }

    public function view(User $user, TeamTitle $teamTitle): bool
    {
        return $user->can('view_team_title');
    }

    public function create(User $user): bool
    {
        return $user->can('create_team_title');
    }

    public function update(User $user, TeamTitle $teamTitle): bool
    {
        return $user->can('update_team_title');
    }

    public function delete(User $user, TeamTitle $teamTitle): bool
    {
        return $user->can('delete_team_title');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_team_title');
    }

    public function forceDelete(User $user, TeamTitle $teamTitle): bool
    {
        return $user->can('force_delete_team_title');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_team_title');
    }

    public function restore(User $user, TeamTitle $teamTitle): bool
    {
        return $user->can('restore_team_title');
    }

    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_team_title');
    }

    public function replicate(User $user, TeamTitle $teamTitle): bool
    {
        return $user->can('replicate_team_title');
    }

    public function reorder(User $user): bool
    {
        return $user->can('reorder_team_title');
    }
}