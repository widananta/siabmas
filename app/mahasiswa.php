<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\pengampu;
use App\absent;
class mahasiswa extends Model
{
    public $incrementing = false;
    protected $fillable = [
        'id', 'nim', 'nama',  'kelas',  'jenis_kelamin',  'foto',  'alamat',  'no_telp', 
    ];
    public function pengampu()
    {
        return $this->belongsToMany(pengampu::class)->withPivot('status')->withTimestamps();
    }
    public function absent()
    {
        return $this->belongsToMany(absent::class)->withPivot('status')->withTimestamps();
    }
}
