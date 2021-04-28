<?php namespace Virtuenetz\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateVirtuenetzPortfolio extends Migration
{
    public function up()
    {
        Schema::table('virtuenetz_portfolio_', function($table)
        {
            $table->increments('id')->unsigned()->change();
        });
    }
    
    public function down()
    {
        Schema::table('virtuenetz_portfolio_', function($table)
        {
            $table->integer('id')->unsigned(false)->change();
        });
    }
}
