<?php namespace Virtuenetz\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateVirtuenetzPortfolioCategory3 extends Migration
{
    public function up()
    {
        Schema::table('virtuenetz_portfolio_category', function($table)
        {
            $table->string('slug', 191)->change();
        });
    }
    
    public function down()
    {
        Schema::table('virtuenetz_portfolio_category', function($table)
        {
            $table->string('slug', 255)->change();
        });
    }
}
