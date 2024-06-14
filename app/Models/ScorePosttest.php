<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScorePosttest extends Model
{
    protected $primaryKey = 'id_ScorePostTest';
    protected $table = 'score_posttest';

    protected $fillable = [
        'id_user',
        'id_pretest',
        'id_unit',
        'score',
    ];

    public $timestamps = false;

}