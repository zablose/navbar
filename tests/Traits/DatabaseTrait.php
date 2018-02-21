<?php

namespace Zablose\Navbar\Tests\Traits;

use Illuminate\Database\Connection;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\SQLiteGrammar;
use PDO;
use Zablose\Navbar\NavbarConfig;
use Zablose\Navbar\Tests\NavbarBuilder;
use Zablose\Navbar\Tests\NavbarEntity;
use Zablose\Navbar\Tests\NavbarRepo;
use Zablose\Navbar\Tests\Table;

trait DatabaseTrait
{

    /** @var PDO */
    private static $pdo;

    /** @var Connection */
    private static $db;

    public static function setUpBeforeClass()
    {
        self::setUpTable();
    }

    /** @return PDO */
    protected static function pdo()
    {
        if (! self::$pdo)
        {
            self::$pdo = new PDO('sqlite::memory:');
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$pdo;
    }

    /** @return Connection */
    protected static function db()
    {
        if (! self::$db)
        {
            self::$db = new Connection(self::pdo());
        }

        return self::$db;
    }

    protected static function setUpTable()
    {
        $table = new Blueprint(Table::NAVBARS);
        $table->create();

        $table->charset   = 'utf8';
        $table->collation = 'utf8_unicode_ci';

        $table->increments('id');

        $table->integer('pid')->unsigned()->default(0);
        $table->string('filter', 32)->nullable();
        $table->string('type', 32)->default('bootstrap_link');
        $table->boolean('group')->default(false);
        $table->string('body', 64)->nullable();
        $table->string('title')->nullable();
        $table->string('href', 2000)->nullable();
        $table->boolean('external')->default(false);
        $table->string('class')->nullable();
        $table->string('icon')->nullable();
        $table->text('attrs')->nullable();
        $table->string('role')->nullable();
        $table->string('permission')->nullable();
        $table->integer('position')->unsigned()->default(0);

        $table->dateTime('created_at')->default(self::db()->raw('CURRENT_TIMESTAMP'));
        $table->dateTime('updated_at')->default(self::db()->raw('CURRENT_TIMESTAMP'));

        $table->build(self::db(), new SQLiteGrammar());
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    protected function insert($data)
    {
        return (new Builder(self::db()))->from(Table::NAVBARS)->insert($data);
    }

    /**
     * @param string $filter
     *
     * @return string
     */
    protected function render($filter = 'main')
    {
        return (new NavbarBuilder(new NavbarRepo(self::db()), new NavbarConfig()))->render($filter);
    }

    /**
     * @param NavbarConfig $config
     *
     * @return NavbarBuilder
     */
    protected function builder($config = null)
    {
        return (new NavbarBuilder(new NavbarRepo(self::db()), $config ?: new NavbarConfig()));
    }

    public function tearDown()
    {
        (new Builder(self::db()))->from(Table::NAVBARS)->delete();
        NavbarEntity::resetNextId();
    }

}
