<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\matkul;
use App\mahasiswa;
use App\absent;
class pengampu extends Model
{
    public $incrementing = false;
    protected $fillable = [
        'id', 'user_id', 'matkul_id','tahun',
    ];
    public function user()
    {
        return $this->belongsTo(user::class, 'user_id', 'id');
    }
    public function matkul()
    {
        return $this->belongsTo(matkul::class, 'matkul_id', 'id');
    }
    public function mahasiswa()
    {
        return $this->belongsToMany(mahasiswa::class)->withPivot('status')->withTimestamps();
    }
    public function absent()
    {
        return $this->hasMany(absent::class);
    }
}
