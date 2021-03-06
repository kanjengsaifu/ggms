<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Account;

class MembershipControl extends Model
{
    public function membership_slot()
    {
    	return $this->belongsTo('App\MembershipSlot');
    }

    public function posted_by_account()
    {
    	return $this->belongsTo('App\Account', 'posted_by_account_id');
    }

    public function current_account()
    {
    	return $this->belongsTo('App\Account', 'current_account_id');
    }

    /**
     * Uses the membership control table to determine who owns an account
     */
    public static function latest_slot_of_account($account_id)
    {
        $latest_control = MembershipControl::where('current_account_id', $account_id)->orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->first();

        if (!$latest_control) return FALSE;

        if ($latest_control->membership_slot_id)
            return MembershipSlot::find($latest_control->membership_slot_id);

        return FALSE;
    }


    /**
     * Uses the membership control table to determine who owns an account
     */
    public static function get_current_account_of($slot_id)
    {
        $latest_control = MembershipControl::latest_control_of_slot($slot_id);

        if (!$latest_control) return FALSE;

        
        
        if ($latest_control->current_account_id)
            return Account::find($latest_control->current_account->id);

        echo 'e';
        die(4);

        return Account::find($latest_control->$latest_control->posted_by_account_id);
    }

    /**
     * Acquires the latest control entry for a certain membership slot
     */
    public static function latest_control_of_slot($slot_id)
    {
        return MembershipControl::where('membership_slot_id', $slot_id)->orderBy('created_at', 'desc')->limit(1)->first();
    }
}
