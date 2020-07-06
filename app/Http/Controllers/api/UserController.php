<?php
namespace App\Http\Controllers\api;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Files;

class UserController extends Controller
{

    public $successStatus = 200;
    
    

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $rules = array(
            'email' => 'required|email',
            'password' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 401);
        } else {
            $user = User::where('email', $request->input('email'))->first();

            if (! empty($user)) {
                if ($user->state_id == User::STATE_ACTIVE) {
                    $credentials = $request->only('email', 'password');
                    if (Auth::attempt($credentials)) {
                        $user->generateAccessToken();
                        if ($user->save()) {
                            $user = Auth::user();
                            $success['token'] = $user->access_token;
                            $success['message'] = "User login successfully";

                            return response()->json([
                                'success' => $success
                            ], $this->successStatus);
                        }
                    } else {
                        return response()->json([
                            'error' => "Email or Password is incorrect"
                        ], 401);
                    }
                } else {
                    return response()->json([
                        'error' => "User is not active"
                    ], 401);
                }
            } else {
                return response()->json([
                    'error' => "Email does not exist"
                ], 401);
            }
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'profile_file[]' => 'image|mimes:jpeg,png,jpg'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 401);
        }
        DB::beginTransaction();
        try {
            $user = new User();
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->role_id = User::ROLE_USER;
            $user->state_id = User::STATE_ACTIVE;
            $user->phone_number = $request->input('phone_number');
            if ($user->save()) {
                if ($request->hasFile('profile_file')) {
                    foreach ($request->file('profile_file') as $file) {
                        $fileModel = new Files();
                        $name = time() . $file->getClientOriginalName();
                        $file->move(public_path('uploads'), $name);
                        $fileModel->name = $name;
                        $fileModel->type = $file->getClientMimeType();
                        $fileModel->user_id = $user->id;
                        if (! $fileModel->save()) {
                            DB::rollback();
                            return response()->json([
                                'error' => "Some error occured. Please try again later"
                            ], 401);
                        }
                    }
                }
                DB::commit();
            }
            $success['detail'] = $user;
            return response()->json([
                'success' => $success
            ], $this->successStatus);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'error' => $e->getMessage()
            ], 401);
        }
    }

    public function update(Request $request)
    {
        if (! empty($request->input('user_id'))) {
            $user = User::where('id', $request->input('user_id'))->first();
            if (! empty($user)) {
                $rules = array(
                    'first_name' => 'max:20',
                    'last_name' => 'max:20',
                    'phone_number' => 'max:15',
                    'address' => 'max:200',
                    'profile_file[]' => 'image|mimes:jpeg,png,jpg'
                );
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return response()->json([
                        'error' => $validator->errors()
                    ], 401);
                } else {
                    DB::beginTransaction();
                    try {
                        if (! empty($request->input('first_name'))) {
                            $user->first_name = $request->input('first_name');
                        }
                        if (! empty($request->input('last_name'))) {
                            $user->last_name = $request->input('last_name');
                        }
                        if (! empty($request->input('phone_number'))) {
                            $user->phone_number = $request->input('phone_number');
                        }
                        $user->address = $request->input('address');

                        if ($user->save()) {
                            if ($request->hasFile('profile_file')) {
                                foreach ($request->file('profile_file') as $file) {
                                    $fileModel = new Files();
                                    $name = time() . $file->getClientOriginalName();
                                    $file->move(public_path('uploads'), $name);
                                    $fileModel->name = $name;
                                    $fileModel->type = $file->getClientMimeType();
                                    $fileModel->user_id = $user->id;
                                    if (! $fileModel->save()) {
                                        DB::rollback();
                                        return response()->json([
                                            'error' => "Some error occured. Please try again later"
                                        ], 401);
                                    }
                                }
                            }
                            DB::commit();
                            $success['message'] = "User updated succesfully";
                            $success['detail'] = $user;

                            return response()->json([
                                'success' => $success
                            ], $this->successStatus);
                        } else {

                            return response()->json([
                                'error' => "Some error occured. Please try again later"
                            ], 401);
                        }
                    } catch (\Exception $e) {
                        DB::rollback();
                        return response()->json([
                            'error' => $e->getMessage()
                        ], 401);
                    }
                }
            }
        } else {
            return response()->json([
                'error' => "Some error occured. Please try again later"
            ], 401);
        }
    }
}