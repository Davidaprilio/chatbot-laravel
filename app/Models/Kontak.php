<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Kontak extends Model
{
    use HasFactory;

    protected $table = 'kontaks';

    protected $guarded = ['id'];
    protected static $table_name = "zu*_kontaks";

    public function __construct($table_name = null)
    {
        parent::__construct();
        if ($table_name) {
            $this->table = $table_name;
        } else {
            $this->table = Auth::check() ? $this->init(Auth::id()) : 'kontaks';
        }
        $this->setConnection('mysql');
    }

    public static function init($id = false)
    {
        $tb = self::getTableName($id ?? Auth::id());
        $cektable = Schema::hasTable($tb);
        if (!$cektable) {
            DB::statement("create table " . $tb . " like kontaks");
        }
        return $tb;
    }

    public static function getTableName($user_id)
    {
        return str_replace('*', $user_id, self::$table_name);
    }

    public static function zu(int $user_id = 0, $auto_create = false)
    {
        if ($user_id === 0) {
            if (Auth::guest()) {
                throw new \Exception("zu() mengharapkan #1 argument yaitu user_id, saat berada pada user Guest", 1);
            }
            $user_id = Auth::id();
        }

        $tb = self::getTableName($user_id);
        if ($auto_create) {
            self::init($user_id);
        }
        return new self($tb);
    }
}
