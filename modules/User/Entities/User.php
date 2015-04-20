<?php namespace Modules\User\Entities;

use Carbon\Carbon;
use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword, EntrustUserTrait, LocalizedEloquentTrait, Messagable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birthday_at',
        'locale',
        'gender',
        'city',
        'profession',
        'hobbies',
        'homepage',
        'skype',
        'facebook',
        'twitter',
        'main_character',
        'main_guild',
        'favorite_race',
        'favorite_class',
        'favorite_spec',
        'favorite_instance',
        'favorite_battleground'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * created static pages
     */
    public function sites()
    {
        return $this->hasMany('Modules\Site\Entities\Page');
    }

    public function posts()
    {
        return $this->hasMany('Modules\Blog\Entities\Post');
    }

    public function comments()
    {
        return $this->hasMany('Modules\Blog\Entities\Comment');
    }

    public function chartrans()
    {
        return $this->hasOne('Modules\Chartrans\Entities\Request');
    }

    /**
     * queries all possible online users
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function scopeOnline($query)
    {
        $expiryDate = Carbon::now()
            ->subMinutes(config('session.lifetime'));

        return $query->where('last_active_at', '>', $expiryDate)
            ->andWhere('logged_out', false);
    }

    /**
     * accessor for current online state
     *
     * @param $value
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getOnlineAttribute($value)
    {
        $expiryDate = Carbon::now()
            ->subMinutes(config('session.lifetime'));

        return ( ! $this->logged_out)
            && $expiryDate->lt($this->last_active_at);
    }

    /**
     * accessor for the users avatar
     *
     * @param $value
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getAvatarAttribute($value)
    {
        return $this->getAvatar();
    }

    /**
     * Save the inputted roles.
     *
     * @param mixed $inputRoles
     *
     * @return void
     */
    public function saveRoles($inputRoles)
    {
        if (!empty($inputRoles)) {
            $this->roles()->sync($inputRoles);
        } else {
            $this->roles()->detach();
        }
    }

    /**
     * @return String
     */
    public function getAvatar()
    {
        // TODO user option for gravatar && check and maybe provide own avatar engine

        return app('Modules\User\Services\Gravatar')
            ->getGravatar($this->email);
    }
}
