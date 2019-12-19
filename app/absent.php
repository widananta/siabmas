<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\mahasiswa;
use App\pengampu;
use App\mahasiswa_absent;
class absent extends Model
{
    public $incrementing = false;
    protected $fillable = [
        'id', 'pertemuan_ke', 'starts', 'ends', 'pengampu_id', 'kode',
    ];
    public function pengampu()
    {
        return $this->belongsTo(pengampu::class, 'pengampu_id', 'id');
    }
    public function mahasiswa()
    {
        return $this->belongsToMany(mahasiswa::class)->withPivot()->withTimestamps();
    }
    public function mahasiswa_absent()
    {
        return $this->hasMany('App\mahasiswa_absent');
    }
}
