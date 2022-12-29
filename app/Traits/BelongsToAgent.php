<?php


namespace App\Traits;

use App\Models\Scopes\AgentScope;
use App\Models\User;

trait BelongsToAgent
{
    protected static function booted()
    {
        static::addGlobalScope(new AgentScope());

        static::creating(function($model) {
            if( session()->get('user_role') ==='agent' && session()->has('agent_id') ) {
                $model->agent_id = session()->get('agent_id');
            }
        });
    }

    public function agent()
    {
        return $this->belongsTo(User::class);
    }
}
