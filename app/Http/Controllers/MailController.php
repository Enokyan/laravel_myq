<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use Mail;
use DB;
use Auth;
use PDF;
use Illuminate\Support\Facades\Response;
class MailController extends BaseController
{
    public function sendChatMessage(Request $request){
        $result_all=$request->all();
        $friend_id=$result_all['friend_id'];
        $chat_users = DB::table('twochat')
            ->select('*')
            ->where([['user_id',Auth::user()->id],['user_id_new',$friend_id]])
            ->orWhere([['user_id',$friend_id],['user_id_new',Auth::user()->id]])
            ->orderBy('created_at')
            ->get()
            ->toArray();
        $data = array('datas'=>$chat_users);
        $pdf = PDF::loadview('pdf.chatpdf',$data);
        $pdf_chat = $pdf->download('pdf.chatpdf');
        $user_email = DB::table('users')->select('*')->where('id',$friend_id)->first();
        $user_mail=$user_email->email;
        Mail::send(['html' =>'pdf.chatpdf'], $data, function($message) use($pdf_chat, $user_mail){
            $message->from(Auth::user()->email);
            $message->attachData($pdf_chat,'chat.pdf');
            $message->to($user_mail)->subject('Mail From My Profile');

        });

    }
}
