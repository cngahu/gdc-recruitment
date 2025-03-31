<?php

namespace App\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PanelVerificationService
{
    /**
     * Check if the panel for a specific vacancy is ready for filtering.
     *
     * @param  int  $vacancyId  The vacancy ID to check panelists for
     * @return bool
     */
//    public static function isPanelReadyForFiltering($vacancyId)
//    {
//        // Fetch the panelists for the given vacancy
//        $panelists = User::where('vacancy_id', $vacancyId)
//            ->where('role', 'panelist')  // Filter users with role "panelist"
//            ->get();
//
//        // Check if we have a chair, secretary, and at least one member in the panel
//        $hasChair = $panelists->firstWhere('panel_role', 'chair');
//        $hasMemberOrSecretary = $panelists->firstWhere(function ($user) {
//            return in_array($user->panel_role, ['member', 'secretary']);
//        });
//
//        // Check if we have at least 2 logged-in panelists (chair + member/secretary)
//        if (!$hasChair || !$hasMemberOrSecretary) {
//            return false;  // If missing chair or member/secretary, return false
//        }
//
//        // Check if **all** panelists for the vacancy are logged in (i.e., active and logged in)
//        $allPanelistsLoggedIn = $panelists->every(function ($user) {
//            return $user->id === Auth::id();
//        });
//
//        // The panel is ready for filtering if all conditions are met:
//        return $hasChair && $hasMemberOrSecretary && $allPanelistsLoggedIn;
//    }

    public static function verifyPanelConstitution($vacancyId)
    {
        // Fetch all panelists (users with role 'panel' and the specific vacancy_id)
        $panelists = User::where('role', 'panelist')
            ->where('vacancy_id', $vacancyId)
            ->get();

        // Check if there's at least one chair, and at least one member or secretary
        $hasChair = $panelists->where('panel_role', 'Chair')->isNotEmpty();
        $hasSecretaryOrMember = $panelists->whereIn('panel_role', ['Secretary', 'Member'])->isNotEmpty();

        if (!$hasChair) {
            return ['status' => false, 'message' => 'The panel does not have a chairperson.'];
        }

        if (!$hasSecretaryOrMember) {
            return ['status' => false, 'message' => 'The panel must have at least one member or secretary.'];
        }

        return ['status' => true];
    }

    /**
     * Check if all panel members are logged in.
     *
     * @param  int  $vacancyId
     * @return array
     */
    public static function areAllPanelMembersLoggedIn($vacancyId)
    {
        // Fetch the users (panelists) who are part of the panel for this vacancy
        $panelists = User::where('role', 'panelist')
            ->where('vacancy_id', $vacancyId)
            ->whereIn('panel_role', ['Chair', 'Secretary', 'Member']) // Only relevant panel roles
            ->get();

        // Check if any panelist is not logged in
        $notLoggedIn = $panelists->filter(function ($panelist) {
            return !Auth::check() || Auth::id() != $panelist->id;  // Check if the panelist is logged in
        });

        if ($notLoggedIn->isNotEmpty()) {
            return ['status' => false, 'message' => 'Not all panel members are logged in.'];
        }

        return ['status' => true];
    }

    /**
     * Combined check for panel constitution and logged-in status
     *
     * @param  int  $vacancyId
     * @return array
     */
    public static function isPanelReadyForFiltering($vacancyId)
    {
        // First, check if the panel is properly constituted
        $constitutionCheck = self::verifyPanelConstitution($vacancyId);
        if (!$constitutionCheck['status']) {
            return $constitutionCheck; // Return constitution failure message
        }

        // Then check if all panel members are logged in
        return self::areAllPanelMembersLoggedIn($vacancyId);
    }
}
