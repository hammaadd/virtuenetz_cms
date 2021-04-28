<?php namespace Virtuenetz\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateVirtuenetzPortfolioCategory extends Migration
{
    public function up()
    {
        Schema::create('virtuenetz_portfolio_category', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('category_title')->nullable();
            $table->string('slug');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('virtuenetz_portfolio_category');
    }
}
