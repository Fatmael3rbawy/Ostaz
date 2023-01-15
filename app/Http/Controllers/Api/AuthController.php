<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ForgetPasswordRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RefreshTokenRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\AreaRepositoryInterface;
use App\Interfaces\DeviceTokenRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\DeviceToken;
use App\Models\User;
use App\Notifications\OtpMail;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiTraits;
    private $UserRepository, $areaRepository, $deviceTokenRepository;
    public function __construct(UserRepositoryInterface $UserRepository, AreaRepositoryInterface $areaRepository, DeviceTokenRepositoryInterface $deviceTokenRepository)
    {
        $this->UserRepository = $UserRepository;
        $this->areaRepository = $areaRepository;
        $this->deviceTokenRepository = $deviceTokenRepository;
    }

    public function login(LoginRequest $request)
    {
        $loginCheck = $this->UserRepository->login($request);
        if($loginCheck){
            $user = $this->UserRepository->checkUserType($request->email , 'type', [User::TYPE_PARENT, User::TYPE_INSTRUCTOR, User::TYPE_STUDENT]);
            if ($user) {
                $apiToke  = $user->createToken('auth_token');
                $user->api_token = $apiToke->plainTextToken;

                $check = $this->deviceTokenRepository->checkifExist($request->device_token, $user->id);
                if(!$check){
                    $device_type = DeviceToken::ANDROID_TYPE;
                    if($request->device_type == 'ios'){
                        $device_type = DeviceToken::IOS_TYPE;
                    }
                    $check = $this->deviceTokenRepository->create([
                        'device_token' =>  $request->device_token,
                        'user_id' => $user->id,
                        'device_type' => $device_type,
                    ]);  
                }

                return $this->responseJson(new UserResource($user), 'Login Successfully');
            } else {
                return $this->responseJsonFailed('This user has no access to login');
            }
        }else{
            return $this->responseJsonFailed('The selected email or password is incorect');
        }
    }

    public function register(RegisterRequest $request)
    {

        $old_user = $this->UserRepository->findBy($request, 'email', $request->email);
        if($old_user){
            return $this->responseJsonFailed('this email alerady taken');
        }
        
        $request->merge(['type' => User::TYPE_STUDENT]);
        $this->UserRepository->create($request->all());
        return $this->responseJsonWithoutData();
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $user = $this->UserRepository->checkUserType($request->email , 'type', [User::TYPE_PARENT, User::TYPE_INSTRUCTOR, User::TYPE_STUDENT]);
        if ($user) {
            $otp = random_int(1000, 9999);
            $this->UserRepository->update(['otp' => $otp], $user->id, $request);
            $user = $this->UserRepository->find($user->id, $request);
            try{
                $user->notify(new OtpMail($user));
            } catch (\Throwable $th) {
                return $this->responseJsonFailed('Email not send try again');
            }
            return $this->responseJson(['otp code' => $otp],'reset code send to mail');
        } 
        return $this->responseJsonFailed('This email has no access to this app or not found');
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $user = $this->UserRepository->findBy($request, 'otp', $request->otp);
        if(!$user){
            return $this->responseJsonFailed('wrong code');
        }
        $this->UserRepository->update([
            'otp' => null,
            'password' => $request->password,
        ], $user->id, $request);
        return $this->responseJsonWithoutData();
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->responseJsonWithoutData();
    }

    public function logoutAllDevices(Request $request)
    {   
        Auth::user()->tokens->each(function($token) {
            $token->delete();
        });
        return $this->responseJsonWithoutData();
    }

    public function refreshToken(RefreshTokenRequest $request){
        $token = $this->UserRepository->checkUserToken($request->token);
        if($token){
            $user = $token->tokenable;
            $apiToke  = $user->createToken('auth_token');
            $user->api_token = $apiToke->plainTextToken;
            $token->delete();
            return $this->responseJson(new UserResource($user));
        }
        return $this->responseJsonFailed('invalid token');
    }
}
