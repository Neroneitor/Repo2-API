<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Helicopter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'type', 'name', 'speed', 'color'
    ];

}
