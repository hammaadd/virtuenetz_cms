<?php namespace Virtuenetz\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateVirtuenetzPortfolioCat extends Migration
{
    public function up()
    {
        Schema::create('virtuenetz_portfolio_cat', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('category_id');
            $table->integer('portfolio_id');
            $table->primary(['category_id','portfolio_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('virtuenetz_portfolio_cat');
    }
}
