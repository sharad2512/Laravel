<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_Demo extends Model
{
    use HasFactory;
    protected $table = 'employee_demo';
    protected $fillable = ['empID','firstName','lastName','email','city'];
}
