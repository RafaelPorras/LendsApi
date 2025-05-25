<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Lend extends Model 
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    // The attributes that are mass assignable. 
    //This allows for mass assignment of these fields 
    //when creating or updating a Lend model.
    
    protected $fillable = [
        'user_id', 
        'copy_id', 
        'incident_id', 
        'lend_date', 
        'real_return_date', 
        'expected_return_date', 
        'status', 
        'notes'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [

    ];
}
