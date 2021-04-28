<?php namespace Virtuenetz\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteVirtuenetzPortfolioPortfolioCategory extends Migration
{
    public function up()
    {
        Schema::dropIfExists('virtuenetz_portfolio_portfolio_category');
    }
    
    public function down()
    {
        Schema::create('virtuenetz_portfolio_portfolio_category', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('category_id');
            $table->integer('portfolio_id');
        });
    }
}
