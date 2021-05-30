<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Traits\UploadImageTrait;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    use UploadImageTrait;
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $user =$this->user->findOrFail(Auth::user()->id);
        return view('customers.profile.index',compact('user'));
    }

    public function updateAvatar(Request $request)
    {
        $data = $this->storageTraitUpload($request,'avatar','profile');
        $this->user->find(Auth::user()->id)->update([
            'avatar' => $data['file_path'],
            'name'=>$request->name_user
        ]);
        return redirect()->back()->with('success_change','Change info success');
    }

    public function updatePassword(PasswordRequest $request)
    {
        $old_pass = $request->old_password;
        $current_pass = Auth::user()->password;
        if(Hash::check($old_pass,$current_pass)){
            $this->user->find(Auth::user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
        }else{
            Session::flash('error_pass', 'Password Old Wrong');
            return redirect()->back();
        }
        return redirect()->back()->with('success_change_pass','Change pass success');

    }
}