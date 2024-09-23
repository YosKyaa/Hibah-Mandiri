<?php

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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');//Created User

            $table->unsignedBigInteger('research_types_id');
            $table->foreign('research_types_id')->references('id')->on('research_types');

            $table->unsignedBigInteger('research_topics_id');
            $table->foreign('research_topics_id')->references('id')->on('research_topics');

            $table->string('research_title');

            $table->unsignedBigInteger('tkt_types_id');
            $table->foreign('tkt_types_id')->references('id')->on('tkt_types');

            $table->unsignedBigInteger('main_research_targets_id');
            $table->foreign('main_research_targets_id')->references('id')->on('main_research_targets');

            // $table->decimal('total_fund', 10, 2)->nullable();

            $table->decimal('total_fund', 15, 2); // 15 digits, 2 decimal places

            $table->unsignedBigInteger('reviewer_id')->nullable();
            $table->foreign('reviewer_id')->references('id')->on('users');

            $table->text('notes')->nullable();

            $table->uuid('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('statuses')->nullable();

            $table->boolean('approval_reviewer')->default(false);

            $table->boolean('mark_as_revised_1')->default(false);

            $table->boolean('mark_as_revised_2')->default(false);

            $table->text('review_notes')->nullable();

            $table->text('review_notes_2')->nullable();

            $table->unsignedBigInteger('bank_id')->nullable();
            $table->foreign('bank_id')->references('id')->on('banks')->nullable();

            $table->string('bank_account_number')->nullable();

            $table->string('bank_account_name')->nullable();

            $table->date('review_date_start')->nullable();

            $table->date('review_date_end')->nullable();

            $table->date('presentation_date')->nullable();

            $table->boolean('mark_as_reviewed')->default(false);

            $table->boolean('mark_as_presented')->nullable();

            $table->boolean('approval_vice_rector_1')->default(false);

            $table->boolean('approval_vice_rector_2')->default(false);

            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');





            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
