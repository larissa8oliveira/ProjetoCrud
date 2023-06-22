<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nome', 'email', 'cpf', 'perfil_id'];

    public function perfil()
    {
        return $this->belongsTo(Profile::class, 'perfil_id');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}

