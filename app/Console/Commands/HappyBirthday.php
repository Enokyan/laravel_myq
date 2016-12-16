<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use DB;
use DateTime;

class HappyBirthday extends Command
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
//        $users = User::where(date('m/d'))->get();
        $newdate = new DateTime();
        $date = $newdate->format('Y-m-d');
        $tests = DB::table('users')->select('*')->where('date', '!=', null)->get();


        foreach( $tests as $user ) {
           if( $user->date == $date) {
               $users_new = DB::table('users')->select('*')->where('date', '!=', null)->where('id', '!=', $user->id)->get();
               foreach($users_new as $send_happy) {
                   DB::table('twochat')->insert(['msg' => 'shnorhavorum em dzer cnndyan kapakcutyamb', 'img' => '', 'chack' => '0', 'user_id' => $send_happy->id, 'status' => '0', 'notification' => '0', 'user_id_new' => $user->id]);
               }
           }
        }


        $this->info('The happy birthday messages were sent successfully!');
    }
}
