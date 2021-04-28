<?php namespace Virtuenetz\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateVirtuenetzPortfolio2 extends Migration
{
    public function up()
    {
        Schema::table('virtuenetz_portfolio_', function($table)
        {
            $table->smallInteger('favourite')->nullable()->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('virtuenetz_portfolio_', function($table)
        {
            $table->dropColumn('favourite');
        });
    }
}
