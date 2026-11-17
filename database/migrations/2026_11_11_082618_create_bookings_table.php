
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Relasi pengguna dan lapangan
            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignId('field_id')
                ->constrained('fields')
                ->restrictOnDelete();

            // Jadwal booking
            $table->date('booking_date');
            $table->time('start_time');
            $table->unsignedTinyInteger('duration');
            $table->time('end_time');

            // Informasi pembayaran
            $table->unsignedBigInteger('total_price');

            // Status booking
            $table->string('status')->default('pending');

            $table->timestamps();

            // Index untuk pencarian booking
            $table->index(['field_id', 'booking_date']);
            $table->index(['user_id', 'booking_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
