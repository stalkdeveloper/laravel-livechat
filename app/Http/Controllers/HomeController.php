<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChMessage;
use App\Models\User;
use Auth;
use File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->usertype == 'admin') {
            $userData = User::orderBy('id', 'desc')->paginate(10);

            $messages = ChMessage::orderBy('id', 'desc')->get();
            
            foreach($messages as $val){
                $fromname = User::where('id', $val->from_id)->first();
                $toname = User::where('id', $val->to_id)->first();
                $val->fromName = $fromname->name;
                $val->toName = $toname->name;
            }

            $logFilePath = storage_path('logs/chat.log');
            if (File::exists($logFilePath)) {
                File::put($logFilePath, ''); // Clear the file contents
            }

            \Log::channel('chat')->info('Chat Log', ['messages' => $messages]);

            $logContent = File::get(storage_path('logs/chat.log'));
        
            return view('home', compact('userData', 'logContent'));
        }else{
            return redirect()->to('/chatify');
        }
    }

    public function getUser($id){
        try {
            $user = User::find($id);

            if ($user) {
                $messages = ChMessage::where('from_id', $user->id)
                    ->orderBy('id', 'desc')
                    ->get();
                    foreach($messages as $val){
                        $fromname = User::where('id', $val->from_id)->first();
                        $toname = User::where('id', $val->to_id)->first();
                        $val->fromName = $fromname->name;
                        $val->toName = $toname->name;
                    }

                return view('userchat.user-chat', compact('messages'));
            } else {
                return "User not found";
            }
        } catch (\Throwable $th) {
            \Log::info($th);
        }
    }

    // public function showLogs()
    // {
       
      
    //     $logFilePath = storage_path('logs/chat.log');

    //     if (File::exists($logFilePath)) {
    //         $logContent = File::get($logFilePath);
    //     } else {
    //         $logContent = 'Log file not found.';
    //     }
    //     return view('home', compact('logContent'));
    // }
}
