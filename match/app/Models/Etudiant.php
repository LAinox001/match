<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'filliere_id',
        'plat_id',
        'couleur_id',
        'animal_id',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('admin/etudiants/'.$this->getKey());
    }

    public function filliere(){
        return $this->belongsTo('App\Models\Filliere');
    }

    public function animal(){
        return $this->belongsTo('App\Models\Animal');
    }

    public function couleur(){
        return $this->belongsTo('App\Models\Couleur');
    }

    public function plat(){
        return $this->belongsTo('App\Models\Plat');
    }
}
