<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    use HasFactory;
    protected $fillable = [
        'questions_id',
        'answer_text',
        'is_correct',
    ];
    public function Questions()
    {
        return $this->belongsTo(Questions::class);
    }
}
