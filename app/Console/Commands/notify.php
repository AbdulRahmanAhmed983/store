<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Mail\NotifyMail;

class notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notify for all users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //select from DB
        // $user = User::select('email')->get(); 

        // pluck => func to get column emil
        $emails = User::pluck('email')->toArray();
        $data = ['title' => 'programming' , 'body' => 'PHP'];
        foreach($emails as $email){
            //how to send email in laravel
            Mail::to($email)->send(new NotifyMail($data));
        }

    }
}
