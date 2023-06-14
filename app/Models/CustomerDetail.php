<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class CustomerDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    public function __construct(string $table_name = "customer_details")
    {
        parent::__construct();
        $this->setTable($table_name);
        $this->setConnection("mysql");
    }

    public static function init(int $user_id)
    {
        $table_name = self::get_table_name($user_id);
        if (!self::is_initiated($user_id)) {
            Schema::create($table_name, function ($table) {
                $table->id();
                $table->unsignedBigInteger('customer_id');
            });
        }
    }

    public static function is_initiated(int $user_id)
    {
        $table_name = self::get_table_name($user_id);
        return Schema::hasTable($table_name);
    }

    public static function user(int $user_id)
    {
        return new CustomerDetail(self::get_table_name($user_id));
    }

    public function addColumn(array $column_name)
    {
        $table_name = $this->getTable();
        Schema::table($table_name, function ($table) use ($column_name) {
            foreach ($column_name as $column) {
                $table->string($column)->nullable();
            }
        });

        return $this;
    }

    public function removeColumn(array $column_name)
    {
        $table_name = $this->getTable();
        Schema::table($table_name, function ($table) use ($column_name) {
            $table->dropColumn($column_name);
        });

        return $this;
    }

    public function renameColumn(string $old_name, string $new_name)
    {
        $table_name = $this->getTable();
        Schema::table($table_name, function ($table) use ($old_name, $new_name) {
            $table->renameColumn($old_name, $new_name);
        });

        return $this;
    }

    public function getColumn()
    {
        $table_name = $this->getTable();
        $columns = Schema::getColumnListing($table_name);
        return array_filter($columns, function ($column) {
            return !in_array($column, ['id', 'customer_id']);
        });
    }

    public static function get_table_name(int $user_id)
    {
        return "zuser_{$user_id}_customer_details";
    }
}
