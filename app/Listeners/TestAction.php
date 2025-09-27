<?php

namespace App\Listeners;

use App\Events\PodcastProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;

class TestAction
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PodcastProcessed $event): void
    {
        //
    }


     public function test($string)
    {
          echo ('<div class="fw-bold">HOOOOOOOOKKKK</div>');
    }
}
