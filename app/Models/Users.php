<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';
    public $timestamps = false;

    public function admin()
    {
        return $this->hasMany(Admin::class,'u_id','u_id');
    }
}
