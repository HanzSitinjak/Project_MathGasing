<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScorePretest extends Model
{
    protected $primaryKey = 'id_ScorePreTest';
    protected $table = 'score_pretest';

    protected $fillable = [
        'id_user',
        'id_pretest',
        'id_unit',
        'score',
    ];

    public $timestamps = false;

}