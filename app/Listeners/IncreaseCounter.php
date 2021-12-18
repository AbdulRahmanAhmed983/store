<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\VideoViewer;

class IncreaseCounter
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
     * @param  object  $event
     * @return void
     */
    public function handle(VideoViewer $event)
    { // remember use EventServiceProvider.php in provider folder 
         //this video de from public video in vdeoViewer
            if(! Session()->has('videoIsVisited')){
                $this->updateViewer($event->video);
            }
            else{
                return false;
            }

    }
    public function updateViewer($video){

        $video->viewer+=1;
         $video->save();
        Session()->put('videoIsVisited',$video->id);
    }
}
