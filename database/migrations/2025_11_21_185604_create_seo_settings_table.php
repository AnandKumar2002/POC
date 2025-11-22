<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('page_type', 50)
                ->comment('root segment: users, roles, auth, dashboard');

            $table->string('url_pattern')->unique()
                ->comment('Exact or dynamic like users/{id}/edit');
                
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            $table->string('canonical_url')->nullable();

            // OpenGraph
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();

            // Twitter
            $table->string('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_image')->nullable();

            $table->tinyInteger('status')
                ->default(1)
                ->comment('1 = active, 0 = inactive');

            $table->timestamps();

            // Indexes
            $table->index('page_type');
            $table->index('page_id');
            $table->index(['page_type', 'page_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_settings');
    }
};
