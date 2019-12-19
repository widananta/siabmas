<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\pengampu;
class matkul extends Model
{
    public $incrementing = false;
    protected $fillable = [
        'id', 'nama_matkul', 'sks',
    ];
    public function pengampu()
    {
        return $this->hasMany(pengampu::class);
    }
}
