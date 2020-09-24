<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Country;
use Auth;
use Session;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Exports\usersExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class UsersController extends Controller
{

    public function userLoginRegister(){
        $meta_title = "Registro/Inicio Sesion - Frutexco";
        return view('users.login_register')->with(compact('meta_title'));
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                $userStatus = User::where('email',$data['email'])->first();
                if($userStatus->status == 0){
                    return redirect()->back()->with('flash_message_error','Tu cuenta no esta activada por favor confirma tu cuenta en el correo electronico.');
                }
                Session::put('frontSession',$data['email']);

                if(!empty(Session::get('session_id'))){
                    $session_id = Session::get('session_id');
                    DB::table('cart')->where('session_id',$session_id)->update(['user_email' => $data['email']]);
                }

                return redirect('/');
            }else{
                return redirect()->back()->with('flash_message_error','Usuario O Contraseña incorrectos!');

            }

        }

    }

    public function register(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
    		// Comprueba si el usuario existe
    		$usersCount = User::where('email',$data['email'])->count();
    		if($usersCount>0){
    			return redirect()->back()->with('flash_message_error','El correo ya existe!');
    		}else{

    			$user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                date_default_timezone_set('America/Bogota');
                $user->created_at = date("Y-m-d H:i:s");
                $user->updated_at = date("Y-m-d H:i:s");
                $user->save();

                /*// Manda un registro al Email
                $email = $data['email'];
                $messageData = ['email'=>$data['email'],'name'=>$data['name']];
                Mail::send('emails.register',$messageData,function($message) use($email){
                    $message->to($email)->subject('Registration with E-com Website');
                });*/

                // Manda un Email de confirmacion
                $email = $data['email'];
                $messageData = ['email'=>$data['email'],'name'=>$data['name'],'code'=>base64_encode($data['email'])];
                Mail::send('emails.confirmation',$messageData,function($message) use($email){
                    $message->to($email)->subject('Confirmacion cuenta Frutexco');
                });

                return redirect()->back()->with('flash_message_success','Por favor confirma en el correo para poder activar la cuenta!');

                if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                    Session::put('frontSession',$data['email']);

                    if(!empty(Session::get('session_id'))){
                        $session_id = Session::get('session_id');
                        DB::table('cart')->where('session_id',$session_id)->update(['user_email' => $data['email']]);
                    }

                    return redirect('/cart');
                }
    		}
    	}
    }

    public function forgotPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            $userCount = User::where('email',$data['email'])->count();
            if($userCount == 0){
                return redirect()->back()->with('flash_message_error','El correo electronico no existe!');
            }

            //Obtiene los detalles del usuario
            $userDetails = User::where('email',$data['email'])->first();

            //Genera una contraseña aleatoria
            $random_password = str_random(8);

            //Contraseña segura por script
            $new_password = bcrypt($random_password);

            //Actualiza contraseña
            User::where('email',$data['email'])->update(['password'=>$new_password]);

            //Manda un Email de cambio de contraseña
            $email = $data['email'];
            $name = $userDetails->name;
            $messageData = [
                'email'=>$email,
                'name'=>$name,
                'password'=>$random_password
            ];
            Mail::send('emails.forgotpassword',$messageData,function($message)use($email){
                $message->to($email)->subject('Nueva Contraseña - Frutexco');
            });

            return redirect('login-register')->with('flash_message_success','Por favor revisa tu correo donde te enviamos la nueva contraseña!');

        }
        return view('users.forgot_password');
    }

    public function confirmAccount($email){
        $email = base64_decode($email);
        $userCount = User::where('email',$email)->count();
        if($userCount > 0){
            $userDetails = User::where('email',$email)->first();
            if($userDetails->status == 1){
                return redirect('login-register')->with('flash_message_success','Tu cuenta de correo ya esta activada. Ya puedes iniciar sesion.');
            }else{
                User::where('email',$email)->update(['status'=>1]);

                // Envia email de bienvenida
                $messageData = ['email'=>$email,'name'=>$userDetails->name];
                Mail::send('emails.welcome',$messageData,function($message) use($email){
                    $message->to($email)->subject('Bienvenido A Frutexco');
                });

                return redirect('login-register')->with('flash_message_success','Tu correo electronico fue activado. Ya puedes iniciar sesion.');
            }
        }else{
            abort(404);
        }
    }

    public function account(Request $request){
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        $countries = Country::get();

        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/

            if(empty($data['name'])){
                return redirect()->back()->with('flash_message_error','Por favor ingresa tu nombre para actualizar los datos!');
            }

            if(empty($data['address'])){
                $data['address'] = '';
            }

            if(empty($data['city'])){
                $data['city'] = '';
            }

            if(empty($data['state'])){
                $data['state'] = '';
            }

            if(empty($data['country'])){
                $data['country'] = '';
            }

            if(empty($data['pincode'])){
                $data['pincode'] = '';
            }

            if(empty($data['mobile'])){
                $data['mobile'] = '';
            }

            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->pincode = $data['pincode'];
            $user->mobile = $data['mobile'];
            $user->save();
            return redirect()->back()->with('flash_message_success','Tus detalles de cuenta han sido modificados correctamente!');
        }

        return view('users.account')->with(compact('countries','userDetails'));
    }

    public function chkUserPassword(Request $request){
        $data = $request->all();
        /*echo "<pre>"; print_r($data); die;*/
        $current_password = $data['current_pwd'];
        $user_id = Auth::User()->id;
        $check_password = User::where('id',$user_id)->first();
        if(Hash::check($current_password,$check_password->password)){
            echo "true"; die;
        }else{
            echo "false"; die;
        }
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            $old_pwd = User::where('id',Auth::User()->id)->first();
            $current_pwd = $data['current_pwd'];
            if(Hash::check($current_pwd,$old_pwd->password)){
                // Actualizar contraseña
                $new_pwd = bcrypt($data['new_pwd']);
                User::where('id',Auth::User()->id)->update(['password'=>$new_pwd]);
                return redirect()->back()->with('flash_message_success',' Contraseña actualizada correctamente!');
            }else{
                return redirect()->back()->with('flash_message_error','La contraseña actual es incorrecta!');
            }
        }
    }

    public function logout(){
        Auth::logout();
        Session::forget('frontSession');
        Session::forget('session_id');
        return redirect('/');
    }

    public function checkEmail(Request $request){
    	// Verifica si el usuario existe
    	$data = $request->all();
		$usersCount = User::where('email',$data['email'])->count();
		if($usersCount>0){
			echo "false";
		}else{
			echo "true"; die;
		}
    }

    public function viewUsers(){
        if(Session::get('adminDetails')['users_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','No tienes acceso ha este modulo');
        }
        $users = User::get();
        return view('admin.users.view_users')->with(compact('users'));
    }

    public function deleteUsers($id = null){
  if(!empty($id)){
     user::where(['id'=>$id])->delete();
     return redirect()->back()->with('flash_message_success','Usuario eliminado correctamente');
  }
    }

    public function exportUsers(){
        return Excel::download(new usersExport,'Usuarios.xlsx');
    }

    public function viewUsersCharts(){
        $current_month_users = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        $last_month_users = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
        $last_to_last_month_users = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
        return view('admin.users.view_users_charts')->with(compact('current_month_users','last_month_users','last_to_last_month_users'));
    }


    public function viewUsersChartsDashboard(){
        $current_month_users = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        $last_month_users = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
        $last_to_last_month_users = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
        return view('admin.users.view_users_charts_dashboard')->with(compact('current_month_users','last_month_users','last_to_last_month_users'));
    }

    public function viewUsersCountriesCharts(){
        $getUserCountries = User::select('country',DB::raw('count(country) as count'))->groupBy('country')->get();
        $getUserCountries = json_decode(json_encode($getUserCountries),true);
        //echo $getUserCountries[0]['country']; die;
        /*echo "<pre>"; print_r($getUserCountries); die;*/
        return view('admin.users.view_users_countries_charts')->with(compact('getUserCountries'));
    }
    public function viewUpdateClient(){

        if(Session::get('adminDetails')['users_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','No tienes acceso ha este modulo');
        }
        $users = user::get();
        return view('admin.users.view_client_table')->with(compact('users'));

    }

    public function UpdateClient(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['Cliente'])){
                $data['Cliente'] = "";
            }

            User::where('id',$id)->update(['Cliente'=>$data['Cliente']]);
            return redirect()->back()->with('flash_message_success','Usuario actualizado correctamente!');
        }
        $users = User::where('id',$id)->first();
        return view('admin.users.view_update_client')->with(compact('users'));
    }

    public function statusUsers(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['status'])){
                $data['status'] = "";
            }
            User::where('id',$id)->update(['status'=>$data['status']]);
            return redirect()->back()->with('flash_message_success','Estado actualizado correctamente!');

        }
        $users = User::where('id',$id)->first();
        return view('admin.users.view_update_status')->with(compact('users'));
    }



}
