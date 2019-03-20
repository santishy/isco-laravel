<?php

namespace App\Listeners;

use App\Events\ClickArticle;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Click;
use App\Ip;
use Carbon\Carbon;
class StoreClick
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
     * @param  ClickArticle  $event
     * @return void
     */
    public function handle(ClickArticle $event)
    {
        $article=$event->article;
        $click=Click::where('ip',$event->ip)->where('id_articulo',$article->id_articulo);
        if(!$click->exists())
        {
            $click=Click::create(['ip'=>$event->ip,'id_articulo'=>$article->id_articulo,'qty'=>1]);
            $article->visits+=1;
        }
        $now=Carbon::now();
        $diff=$now->diffInHours($click->first()->updated_at);
        if($diff==1){
            $click->qty+=1;
            $click->save();
            $article->visits+=1;
        }
        $article->save();
        return $click;
    }
}
