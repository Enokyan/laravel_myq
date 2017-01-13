<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class HappyBirthday22 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a Happy birthday message to users via SMS';

    /**
     * Create a new command instance.
     *
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
     * @return mixed
     */
    public function handle()
    {
        User::whereBirthDate(date('m/d'))->get();

        foreach( $users as $user ) {
            if($user->has('cellphone')) {
                SMS::to($user->cellphone)
                    ->msg('Dear ' . $user->fname . ', I wish you a happy birthday!')
                    ->send();
            }
        }

        $this->info('The happy birthday messages were sent successfully!');
    }
}