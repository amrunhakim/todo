<?php 
use Illuminate\Database\Eloquent\Model;

class Employee extends Model 
{
    protected $table = 'employee';

    protected $guarded = ['pegawai_id'];
}