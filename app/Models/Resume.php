<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'desired_position',
        'education',
        'observations',
        'resume_file',
        'ip',
    ];

    /**
     * Retorna o caminho completo do arquivo do currículo.
     *
     * @return string
     */
    public function getResumeFilePathAttribute()
    {
        return storage_path('app/' . $this->resume_file);
    }
}
