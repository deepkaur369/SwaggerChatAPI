<?php
namespace App;


use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    
    const STATE_ACTIVE = 1;
    
    const STATE_INACTIVE = 2;
    
    const STATE_DELETED = 3;
    
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'size',
        'user_id'
    ];

   
}
