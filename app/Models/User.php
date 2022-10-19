<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'gender',
        'image',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

      /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function manager(){
        return $this->hasOne(Manager::class);
    }

    public function admin(){
        return $this->hasOne(Admin::class);
    }

    public static function existingEmailPhone($data, $id){
        $dd = (object)$data;
        if(User::where('email', $dd->email)->where('id', '!=', $id)->exists()){
            return (object)["status"=>true, "response"=>"Email already in use by another user"];
        }
        else if(User::where('phone', $dd->phone)->where('id', '!=', $id)->exists()){
            return (object)["status"=>true, "response"=>"Phone number already in use by another user"];
        }
        else{
            return (object)["status"=>false];
        }
    }

    public static function createUser($data){
        $user = (object)$data;
        $newUser = new User();
        $newUser->name = $user->name;
        $newUser->email = $user->email;
        $newUser->phone = $user->phone;
        $newUser->password = bcrypt("password");
        $newUser->gender = $user->gender;
        $newUser->image = $user->image;
        $newUser->save();
        
        if($newUser){
            return $newUser;
        }else{
            return false;
        }
    }

    public static function updateUser($data, $user_id){
        $user = (object)$data;
        $newUser = User::where('id', $user_id)->first();
        $newUser->name = $user->name;
        $newUser->email = $user->email;
        $newUser->phone = $user->phone;
        $newUser->gender = $user->gender;
        $newUser->image = $user->image;
        $newUser->save();
        
        if($newUser){
            return $newUser;
        }else{
            return false;
        }
    }
}
