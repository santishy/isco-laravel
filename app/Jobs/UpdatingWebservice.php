<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Soap;

class UpdatingWebservice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $items;
    public function __construct($items)
    {
        $this->items = collect($items);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Soap::updating($this->items);
    }
}
