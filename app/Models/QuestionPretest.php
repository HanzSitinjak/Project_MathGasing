<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionPretest extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_question_pretest';
    protected $table = 'question_pretest';

    protected $fillable = [
        'id_pretest',
        'question',
        'pretest_option_1',
        'pretest_option_2',
        'pretest_option_3',
        'pretest_option_4',
        'pretest_correct_index'
    ];

    public $timestamps = false;
}
