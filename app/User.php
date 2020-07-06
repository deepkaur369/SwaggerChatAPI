<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    const ROLE_ADMIN = 1;

    const ROLE_USER = 2;

    const STATE_ACTIVE = 1;

    const STATE_INACTIVE = 2;

    const STATE_DELETED = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'profile_file',
        'first_name',
        'last_name',
        'address',
        'phone_number',
        'access_token',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function generateAccessToken()
    {
        $this->access_token = Str::random(32);
    }

    public function asJson($value)
    {
        $json = [];
        $json['id'] = $this->id;
        $json['full_name'] = $this->first_name . ' ' . $this->last_name;
        $json['email'] = $this->email;
        $json['date_of_birth'] = '';
        $json['gender'] = '';
        if(!empty($this->profile_file)){
            $json['profile_file'] =  asset('public/uploads/'.$this->profile_file);
        }
        elseif (! empty($this->getProfileFile())) {
            $json['profile_file'] =  $this->getProfileFile();
        } else {
            $json['profile_file'] = '';
        }
        $json['role_id'] = $this->role_id;
        $json['state_id'] = $this->state_id;
        $json['last_message'] = '';
        $json['last_message_id'] = '';
        $json['is_online'] = '';
        $json['unread_message_count'] = '';
        
        return $json;
    }
    
    public function getProfileFile() {
        $file = Files::where('user_id',$this->id)->first();
        if(!empty($file->name)){
            return asset('public/uploads/'.$file->name);
        }
        return false;
    }
    
}
