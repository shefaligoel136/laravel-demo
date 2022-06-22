<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Notifications\Notifiable;

class Skillbuilder extends Model
{
    use HasFactory;
    use Uuid , Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $fillable = [
        'title',
        'description',
        'awards',
        'points',
        'effortTime',
        'reviewerId',
        'creatorId',
        'isPublished'
    ];

    protected $casts = ['isPublished' => 'boolean'];

    public function creators(){
        return $this->hasMany('App\Models\User','id','creatorId'); 
    }

    public function reviewers(){
        return $this->hasMany('App\Models\User','id','reviewerId'); 
    }

}
