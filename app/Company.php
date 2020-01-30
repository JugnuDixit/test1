<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
    'name','address'
  ];

  public function users()
  {
    return $this->belongsToMany(User::class)
      ->with('roles', 'companies');
  }
}
