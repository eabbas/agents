<?php

namespace App\Listeners;

class ClearAgentIdFromSession
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        session()->forget('agent_id');
        session()->forget('user_role');
    }
}
