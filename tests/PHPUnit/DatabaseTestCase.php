<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
use Piwik\Config;
use Piwik\DataAccess\ArchiveTableCreator;
use Piwik\DataTable\Manager;
use Piwik\Db;
use Piwik\DbHelper;
use Piwik\Option;
use Piwik\Plugins\ScheduledReports\API;
use Piwik\Site;
use Piwik\Tracker\Cache;
use Piwik\Piwik;

/**
 * Tests extending DatabaseTestCase are much slower to run: the setUp will
 * create all Piwik tables in a freshly empty test database.
 *
 * This allows each test method to start from a clean DB and setup initial state to
 * then test it.
 *
 */
class DatabaseTestCase extends PHPUnit_Framework_TestCase
{
    protected $fixture = null;

    /**
     * Setup the database and create the base tables for all tests
     */
    public function setUp()
    {
        parent::setUp();

        $this->fixture = new Fixture();
        $this->fixture->loadTranslations = false;
        $this->fixture->createSuperUser = false;
        $this->fixture->performSetUp();
    }

    /**
     * Resets all caches and drops the database
     */
    public function tearDown()
    {
        parent::tearDown();
        $this->fixture->performTearDown();
    }
}
