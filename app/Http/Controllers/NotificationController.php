<?php

namespace App\Http\Controllers;

use App\Notifications\UserOrder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class NotificationController extends Controller
{
    public static function notifyNewBillOrder($bill_id){
        $user = User::find(8);
        $data = [
            'title' => 'New Bill Order',
            'content' => 'Bill ordered by '. Auth::user()->name,
            'bill_id' => $bill_id,
            'type' => 'admin'
        ];
        $user->notify(new UserOrder($data));
        $data['id'] = $user->notifications->first()->id;
        $data['numberOfReadNotification'] = self::getNumberofUnReadNotification($user->id);
        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $pusher->trigger('Notify','send-message',$data);
    }

    public static function configPusher(){
        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true,
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options,
        );
        return $pusher;
    }

    public function markAsRead($id, $type)
    {
        $user = User::find(Auth::user()->id);
        $notification = $user->notifications->where('id', $id)->first();
        $notification->markAsRead();
        $html="";
        if($type){
            $html .= "
            <a class=\"nav-link\" id=\"#noti{$notification->id}\"
            href=\"http://127.0.0.1:8000/admin/orders\" >
                <span>{$notification->data['title']}</span><br>
                <small>{$notification->data['content']}</small>
            </a>
            <hr>";
        } else {
            $html .= "
            <a class=\"dropdown-item\" id=\"#noti{$notification->id}\"
            href=\"http://127.0.0.1:8000/admin/orders\" >
                <span>{$notification->data['title']}</span><br>
                <small>{$notification->data['content']}</small>
            </a>
            <hr>";
        }
        return $html;
    }

    public function markAllAsRead($type)
    {
        $user = User::find(Auth::user()->id);
        $user->unreadNotifications->markAsRead();
        $html="";
        if($type){
            foreach($user->notifications as $notification){
                $html .= "
                <a class=\"nav-link\" id=\"#noti{$notification->id}\"
                href=\"http://127.0.0.1:8000/admin/orders\" >
                    <span>{$notification->data['title']}</span><br>
                    <small>{$notification->data['content']}</small>
                </a>
                <hr>";
            }
        } else {
            foreach($user->notifications as $notification){
                $html .= "
                <div id=\"noti{{$notification->id}}\">
                    <a class=\"dropdown-item\" id=\"#noti{$notification->id}\"
                    href=\"http://127.0.0.1:8000/admin/orders\">
                        <span>{$notification->data['title']}</span><br>
                        <small>{$notification->data['content']}</small>
                    </a>
                    <hr>
                </div>";
            }
        }
        return $html;
    }
    public static function getNumberofUnReadNotification($user_id){
        $unReadNotification = DB::table('notifications')->where('notifiable_id', $user_id)->where('read_at',NULL)->get();
        $numberOfUnReadNotification = count($unReadNotification);
        return $numberOfUnReadNotification;
    }
}