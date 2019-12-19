<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\mahasiswa;
use App\absent;
class mahasiswa_absent extends Model
{
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = [
        'absent_id', 'mahasiswa_id'
    ];
    public function absent()
    {
        return $this->belongsTo('App\absent');
    }
    public function mahasiswa()
    {
        return $this->belongsTo('App\mahasiswa');
    }
}
