<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use App\Traits\HasFormattedTimestamps;

class User extends Authenticatable
{
    use LaratrustUserTrait, HasFormattedTimestamps;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $guarded = ['id'];

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
    public const BULK_ACTIVATION = 1;
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const PREFIX = "USR";

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
    public function getAvatarAttribute($value)
    {
        $avatar = !is_null($value) ? asset('storage/backend/users/'.$value) :
        'https://ui-avatars.com/api/?name='.$this->first_name.'&background=19B5FE&color=ffffff&v=19B5FE';
        // dd($avatar);
        if (\Str::contains(request()->url(), '/api/vi')) {
            return asset($avatar);
        }
        return $avatar;
    }
    public const STATUSES = [
        "0" => ['label' =>'Inactive','color' => 'danger'],
        "1" => ['label' =>'Active','color' => 'success'],
    ];
    protected $appends = [
        'full_name' , 'name'
      ];
    protected function statusParsed(): Attribute
    {
        return  Attribute::make(
            get: fn ($value) =>  (object)self::STATUSES[$this->status],
        );
    }
    public function ekyStatus()
    {
        return $this->belongsTo(UserKyc::class, 'status');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    public function payouts()
    {
        return $this->hasMany(Payout::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function walletLogs()
    {
        return $this->hasMany(WalletLog::class);
    }
    public function pendingWalletRequest()
    {
        return $this->hasMany(WalletLog::class)->whereStatus(0);
    }
    public function payoutDetails()
    {
        return $this->hasMany(PayoutDetail::class, 'user_id', 'id');
    }
    public function supportTickets()
    {
        return $this->hasMany(SupportTicket::class);
    }
    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class, 'user_subscriptions');
    }
    public function userSubscriptions()
    {
        return $this->hasMany(UserSubscription::class);
    }
    public function wishlists()
    {
        return $this->hasMany(MyWishlist::class);
    }
    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }
    public function kycs()
    {
        return $this->hasMany(UserKyc::class);
    }
    public function logs()
    {
        return $this->hasMany(UserLog::class);
    }
    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
    public function userNotes()
    {
        return $this->hasMany(UserNote::class, 'type_id');
    }
    public function contacts()
    {
        return $this->hasMany(Contact::class, 'type_id')->whereType('User');
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
    public function getRoleNameAttribute()
    {
        if (!empty($this->roles)) {
            return $this->roles[0]->display_name;
        } else {
            return "No Role" ;
        }
    }
    public function getFullNameAttribute()
    {
        return ucwords($this->first_name.' '.$this->last_name);
    }
    public function getNameAttribute()
    {
        return ucwords($this->first_name.' '.$this->last_name);
    }

    public function getPrefix()
    {
        return "#USR".str_replace('_1', '', '_'.(100000 +$this->id));
    }

    public function scopeWhereRoleIsNot($query, $role = '', $team = null)
    {
        return $query->whereHas(
            'roles',
            function ($roleQuery) use ($role, $team) {
                $roleQuery->whereNotIn('name', $role);
                if (!is_null($team)) {
                    $roleQuery->whereNotIn('team_id', $team->id);
                }
            }
        );
    }
    /**
     * Ecrypt the user's google_2fa secret.
     *
     * @param  string $value
     * @return string
     */
    public function setGoogle2faSecretAttribute($value)
    {
         $this->attributes['google2fa_secret'] = encrypt($value);
    }

    /**
     * Decrypt the user's google_2fa secret.
     *
     * @param  string $value
     * @return string
     */
    public function getGoogle2faSecretAttribute($value)
    {
        if ($value == null) {
            return null;
        }
        return decrypt($value);
    }
}
