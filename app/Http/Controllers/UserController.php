<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use Hash;
class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	} 
	public function changePassword(Request $request){
		$user=User::findOrFail(auth()->user()->id);

		if(Hash::check($request->old_password, $user['password']) && $request->password==$request->password_confirmation){
			$user->password=bcrypt($request->password);
			$user->update();
			$successOrFail='success';
			$data = "Password Changed Successfully!";
			return array($data,$successOrFail);
		}
		else{

			$successOrFail='fail';
			$data = "Password does not matched";
			return array($data,$successOrFail);
		}
	}

}
