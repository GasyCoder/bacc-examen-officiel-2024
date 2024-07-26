<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidat extends Model
{
    /*
     * Recherche résultats du bacc Mahajanga, 2024
    */
    use HasFactory, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'uuid', 'matricule', 'fname', 'lname', 'serie', 'mention', 'center', 'admis'
    ];

    protected $casts = [
        'admis' => 'boolean',
    ];
}
