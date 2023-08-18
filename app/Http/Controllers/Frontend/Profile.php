<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Profile extends Controller
{
   public function index(){
    return view('frontend.user.index');
   }
   public function updateuserdetails(Request $request){
        $request->validate([
            'name'=>'required|string|max:200',
            'phone'=>'required|string|min:10|max:10',
            'pincode'=>'required|string|min:6|max:6',
            'address'=>'required|string|max:500'
        ]);
        $user=User::FindOrFail(Auth::user()->id);
        $user->update([
            'name'=>$request->name
        ]);
        $user->UserDetail()->updateOrCreate(
            [],
            ['user_id'=>$user->id,
            'phone'=>$request->phone,
            'pincode'=>$request->pincode,
            'address'=>$request->address
            ]
        );
        return redirect()->back()->with('message','User profile updated');
   }

   public function passwordChange(){
    return view('frontend.user.change_password');
   }
   public function passwordUpdate(Request $request)
        {
            $request->validate([
                'current_password' => ['required','string','min:8'],
                'password' => ['required', 'string', 'min:8', 'confirmed']
            ]);
            $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
            if($currentPasswordStatus){
    
                User::findOrFail(Auth::user()->id)->update([
                    'password' => Hash::make($request->password),
                ]);
    
                return redirect()->back()->with('message','Password Updated Successfully');
    
            }else{
    
                return redirect()->back()->with('message','Current Password does not match with Old Password');
            }
    
        }
}
