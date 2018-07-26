<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //
    public function register()
    {
        return view('user.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'                  => 'required',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        $data = [
            'avatar'       => 'images/default-avatar.png',
            'confirm_code' => str_random(48)
        ];
        $user = User::create(array_merge($request->all(), $data));

        $view = 'email.register';
        $subject = '验证邮箱';
        $this->sendTo($view, $subject, $user, $data);

        return redirect('/');
    }

    /**
     * 验证邮件
     * @param $confirm_code
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmEmail($confirm_code)
    {
        $user = User::where('confirm_code', $confirm_code)->first();
        if (is_null($user)) {
            return redirect('/');
        }

        $user->is_confirmed = 1;
        $user->confirm_code = str_random(48);
        $user->save();
        return redirect('user/login');

    }

    /**
     * 发送邮件
     * @param $view
     * @param $subject
     * @param $user
     * @param array $data
     */
    public function sendTo($view, $subject, $user, $data = [])
    {
        Mail::send($view, $data, function ($message) use ($user, $subject) {
            $message->to($user->email)->subject($subject);
        });
    }
}
