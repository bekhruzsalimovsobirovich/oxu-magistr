<?php

use App\Domain\Buildings\Models\Building;
use App\Domain\Specialities\Models\Speciality;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('speciality_buildings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Speciality::class)
                ->index()
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Building::class)
                ->index()
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speciality_buildings');
    }
};
