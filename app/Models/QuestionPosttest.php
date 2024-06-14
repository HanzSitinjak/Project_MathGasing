<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionPosttest extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_question_posttest';
    protected $table = 'question_posttest';

    protected $fillable = [
        'id_posttest',
        'question',
        'posttest_option_1',
        'posttest_option_2',
        'posttest_option_3',
        'posttest_option_4',
        'posttest_correct_index'
    ];

    public $timestamps = false;
}
