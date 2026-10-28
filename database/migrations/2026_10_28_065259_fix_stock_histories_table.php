
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stock_histories', function (Blueprint $table) {
            if (!Schema::hasColumn('stock_histories', 'type')) {
                $table->string('type', 10)->default('in');
            }

            if (!Schema::hasColumn('stock_histories', 'qty')) {
                $table->unsignedInteger('qty')->default(0);
            }

            if (!Schema::hasColumn('stock_histories', 'note')) {
                $table->text('note')->nullable();
            }

            if (!Schema::hasColumn('stock_histories', 'created_at')) {
                $table->timestamp('created_at')->nullable();
            }

            if (!Schema::hasColumn('stock_histories', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        $columns = [];

        foreach ([
            'type',
            'qty',
            'note',
            'created_at',
            'updated_at',
        ] as $column) {
            if (Schema::hasColumn('stock_histories', $column)) {
                $columns[] = $column;
            }
        }

        if (!empty($columns)) {
            Schema::table('stock_histories', function (Blueprint $table) use ($columns) {
                $table->dropColumn($columns);
            });
        }
    }
};
