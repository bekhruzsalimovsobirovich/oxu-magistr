<?php

use App\Domain\Specialities\Models\Speciality;
use App\Domain\Subjects\Models\Subject;
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
        Schema::create('speciality_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Speciality::class)
                ->index()
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Subject::class)
                ->index()
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speciality_subjects');
    }
};
