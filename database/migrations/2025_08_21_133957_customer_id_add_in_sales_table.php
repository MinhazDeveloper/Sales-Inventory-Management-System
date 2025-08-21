use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            // যদি customer_id na thake, add hobe
            if (!Schema::hasColumn('sales', 'customer_id')) {
                $table->unsignedBigInteger('customer_id')->after('id');

                $table->foreign('customer_id')
                      ->references('id')
                      ->on('customers')
                      ->cascadeOnUpdate()
                      ->restrictOnDelete();
            }

            
        });
    }

    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            if (Schema::hasColumn('sales', 'customer_id')) {
                $table->dropForeign(['customer_id']);
                $table->dropColumn('customer_id');
            }

        });
    }
};
