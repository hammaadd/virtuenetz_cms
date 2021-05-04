<?php namespace Virtuenetz\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateVirtuenetzPortfolio3 extends Migration
{
    public function up()
    {
        Schema::table('virtuenetz_portfolio_', function($table)
        {
            $table->string('slug', 191)->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('virtuenetz_portfolio_', function($table)
        {
            $table->dropColumn('slug');
        });
    }
}
