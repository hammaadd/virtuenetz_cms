<?php namespace Virtuenetz\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateVirtuenetzPortfolio extends Migration
{
    public function up()
    {
        Schema::create('virtuenetz_portfolio_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->text('image')->nullable();
            $table->string('client', 191)->nullable();
            $table->string('project_name', 191);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->primary(['id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('virtuenetz_portfolio_');
    }
}
