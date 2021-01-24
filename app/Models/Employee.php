<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model 
{
    protected $table = 'employee';

    protected $fillable = ['pegawai_nama', 'pegawai_jabatan', 'pegawai_umur', 'pegawai_alamat'];
    //protected $guarded = ['pegawai_id'];
}