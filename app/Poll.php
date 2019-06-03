<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PollOption;

class Poll extends Model
{
    protected $table = 'poll';

    public function pollOptions() {

        return $this->hasMany('App\PollOption', 'id_poll', 'id_poll');
    }

    public function votesOnPoll() {

        return $this->hasMany('App\VoteOnPoll', 'id_poll', 'id_poll');
    }
}
