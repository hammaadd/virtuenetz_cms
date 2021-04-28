<?php namespace Virtuenetz\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateVirtuenetzPortfolioCategory extends Migration
{
    public function up()
    {
        Schema::table('virtuenetz_portfolio_category', function($table)
        {
            $table->string('slug', 255)->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('virtuenetz_portfolio_category', function($table)
        {
            $table->string('slug', 255)->nullable(false)->change();
        });
    }
}
