<?php namespace Virtuenetz\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateVirtuenetzPortfolioCategory2 extends Migration
{
    public function up()
    {
        Schema::table('virtuenetz_portfolio_category', function($table)
        {
            $table->integer('sort_order')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('virtuenetz_portfolio_category', function($table)
        {
            $table->dropColumn('sort_order');
        });
    }
}
