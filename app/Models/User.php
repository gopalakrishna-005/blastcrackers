<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    


    const ROLE_SUPER_ADMIN = 'SUPERADMIN';

    const ROLE_ADMIN = 'ADMIN';


    const ROLES = [

        self::ROLE_SUPER_ADMIN => 'superadmin',
        self::ROLE_ADMIN => 'admin',

    ];



    /**
     * Determine if the user can access the Filament admin panel.
     *
     * @param \Filament\Panel $panel
     *
     * @return bool
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isSuperAdmin() || $this->isAdmin();
    }

    public function isSuperAdmin(){
        return $this->hasRole(self::ROLES[self::ROLE_SUPER_ADMIN]);

    }

    public function isAdmin(){

        return $this->hasRole(self::ROLES[self::ROLE_ADMIN]);
        
    }
}
