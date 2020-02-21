<?php declare(strict_types=1);

namespace Zablose\Navbar\Tests\Traits;

use Illuminate\Database\Connection;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\SQLiteGrammar;
use PDO;
use Zablose\Navbar\NavbarConfig;
use Zablose\Navbar\Tests\NavbarBuilder;
use Zablose\Navbar\Tests\NavbarRepo;
use Zablose\Navbar\Tests\Table;

trait DatabaseTrait
{
    private static ?PDO $pdo = null;
    private static ?Connection $db = null;

    public static function setUpBeforeClass(): void
    {
        self::setUpTable();
    }

    protected static function pdo(): PDO
    {
        if (! isset(self::$pdo)) {
            self::$pdo = new PDO('sqlite::memory:');
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$pdo;
    }

    protected static function db(): Connection
    {
        if (! self::$db) {
            self::$db = new Connection(self::pdo());
        }

        return self::$db;
    }

    protected static function setUpTable(): void
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

    protected function insert(array $data): bool
    {
        return (new Builder(self::db()))->from(Table::NAVBARS)->insert($data);
    }

    protected function render(array $filter = ['main']): string
    {
        return (new NavbarBuilder(new NavbarRepo(self::db()), new NavbarConfig()))->render($filter);
    }

    protected function builder(?NavbarConfig $config = null): NavbarBuilder
    {
        return (new NavbarBuilder(new NavbarRepo(self::db()), $config ?: new NavbarConfig()));
    }

    public function tearDown(): void
    {
        (new Builder(self::db()))->from(Table::NAVBARS)->delete();

        parent::tearDown();
    }
}
