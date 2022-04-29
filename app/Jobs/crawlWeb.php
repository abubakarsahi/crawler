<?php

namespace App\Jobs;

use App\Models\ShortLink;
use App\Services\Scrapper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class crawlWeb implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $short_code = '';
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($short_code)
    {
        $this->short_code = $short_code;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $scrapper = new Scrapper();
        $short_link = ShortLink::where('short_code',$this->short_code)->first();
        $title = $scrapper->getResponse($short_link->link);
        $short_link->title = substr($title,0,20);
        $short_link->save();
    }
}
//imartinez@bluecoding.com