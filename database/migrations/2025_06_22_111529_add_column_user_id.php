return new class extends Migration
{
    public function up(): void
    {
        // Tambah user_id ke tabel points (jika belum ada)
        Schema::table('points', function (Blueprint $table) {
            if (!Schema::hasColumn('points', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users');
            }
        });

        // Tambah user_id ke tabel polylines (jika belum ada)
        Schema::table('polylines', function (Blueprint $table) {
            if (!Schema::hasColumn('polylines', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users');
            }
        });

        // Tambah user_id ke tabel polygons (jika belum ada)
        Schema::table('polygons', function (Blueprint $table) {
            if (!Schema::hasColumn('polygons', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users');
            }
        });
    }

    public function down(): void
    {
        Schema::table('points', function (Blueprint $table) {
            if (Schema::hasColumn('points', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });

        Schema::table('polylines', function (Blueprint $table) {
            if (Schema::hasColumn('polylines', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });

        Schema::table('polygons', function (Blueprint $table) {
            if (Schema::hasColumn('polygons', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};
