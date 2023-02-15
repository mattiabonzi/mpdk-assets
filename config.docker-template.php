<?php  // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();

$compose_name = getenv('COMPOSE_PROJECT_NAME');
$CFG->dbtype    = getenv('MOODLE_DOCKER_DBTYPE');
$CFG->dblibrary = 'native';
$CFG->dbhost    = $compose_name.'-db-1';
$CFG->dbname    = getenv('MOODLE_DOCKER_DBNAME');
$CFG->dbuser    = getenv('MOODLE_DOCKER_DBUSER');
$CFG->dbpass    = getenv('MOODLE_DOCKER_DBPASS');
$CFG->prefix    = 'm_';
$CFG->dboptions = ['dbcollation' => getenv('MOODLE_DOCKER_DBCOLLATION')];

$host = 'localhost';
if (!empty(getenv('MOODLE_DOCKER_WEB_HOST'))) {
    $host = getenv('MOODLE_DOCKER_WEB_HOST');
    #$CFG->reverseproxy = true;
}
$CFG->wwwroot   = "http://{$host}";
$port = getenv('MOODLE_DOCKER_WEB_PORT');
if (!empty($port)) {
    // Extract port in case the format is bind_ip:port.
    $parts = explode(':', $port);
    $port = end($parts);
    if ((string)(int)$port === (string)$port) { // Only if it's int value.
        $CFG->wwwroot .= ":{$port}";
    }
}
$CFG->dataroot  = '/var/www/moodledata';
$CFG->admin     = 'admin';
$CFG->directorypermissions = 0777;
$CFG->smtphosts = "$compose_name-mailhog-1:1025";
$CFG->noreplyaddress = 'noreply@example.com';

// Debug options - possible to be controlled by flag in future..
$CFG->debug = (E_ALL | E_STRICT); // DEBUG_DEVELOPER
$CFG->debugdisplay = 1;
$CFG->debugstringids = 1; // Add strings=1 to url to get string ids.
$CFG->perfdebug = 15;
$CFG->debugpageinfo = 1;
$CFG->allowthemechangeonurl = 1;
$CFG->passwordpolicy = 0;
$CFG->cronclionly = 0;
$CFG->pathtophp = '/usr/local/bin/php';

$CFG->phpunit_dataroot  = '/var/www/phpunitdata';
$CFG->phpunit_prefix = 't_';
define('TEST_EXTERNAL_FILES_HTTP_URL', "http://$compose_name-exttests-1:9000");
define('TEST_EXTERNAL_FILES_HTTPS_URL', "http://$compose_name-exttests-1:9000");

$CFG->behat_wwwroot   = "http://$compose_name-webserver-1";
$CFG->behat_dataroot  = '/var/www/behatdata';
$CFG->behat_prefix = 'b_';
$CFG->behat_profiles = array(
    'default' => array(
        'browser' => getenv('MOODLE_DOCKER_BROWSER'),
        'wd_host' => "http://$compose_name-selenium-1:4444/wd/hub",
    ),
);
$CFG->behat_faildump_path = '/var/www/behatfaildumps';

define('PHPUNIT_LONGTEST', true);

if (getenv('MOODLE_DOCKER_APP')) {
    $appport = getenv('MOODLE_DOCKER_APP_PORT') ?: 8100;

    $CFG->behat_ionic_wwwroot = "http://$compose_name-moodleapp-1:$appport";
}

if (getenv('MOODLE_DOCKER_PHPUNIT_EXTRAS')) {
    define('TEST_SEARCH_SOLR_HOSTNAME', "$compose_name-solr-1");
    define('TEST_SEARCH_SOLR_INDEXNAME', 'test');
    define('TEST_SEARCH_SOLR_PORT', 8983);

    define('TEST_SESSION_REDIS_HOST', "$compose_name-redis-1");
    define('TEST_CACHESTORE_REDIS_TESTSERVERS', "$compose_name-redis-1");

    define('TEST_CACHESTORE_MONGODB_TESTSERVER', "mongodb://$compose_name-mongo-1:27017");

    define('TEST_CACHESTORE_MEMCACHED_TESTSERVERS', "$compose_name-memcached0:11211\n$compose_name-memcached1:11211");
    define('TEST_CACHESTORE_MEMCACHE_TESTSERVERS', "$compose_name-memcached0:11211\n$compose_name-memcached1:11211");

    define('TEST_LDAPLIB_HOST_URL', "ldap://$compose_name-ldap-1");
    define('TEST_LDAPLIB_BIND_DN', 'cn=admin,dc=openstack,dc=org');
    define('TEST_LDAPLIB_BIND_PW', 'password');
    define('TEST_LDAPLIB_DOMAIN', 'ou=Users,dc=openstack,dc=org');

    define('TEST_AUTH_LDAP_HOST_URL', "ldap://$compose_name-ldap-1");
    define('TEST_AUTH_LDAP_BIND_DN', 'cn=admin,dc=openstack,dc=org');
    define('TEST_AUTH_LDAP_BIND_PW', 'password');
    define('TEST_AUTH_LDAP_DOMAIN', 'ou=Users,dc=openstack,dc=org');

    define('TEST_ENROL_LDAP_HOST_URL', "ldap://$compose_name-ldap-1");
    define('TEST_ENROL_LDAP_BIND_DN', 'cn=admin,dc=openstack,dc=org');
    define('TEST_ENROL_LDAP_BIND_PW', 'password');
    define('TEST_ENROL_LDAP_DOMAIN', 'ou=Users,dc=openstack,dc=org');
}


require_once(__DIR__ . '/lib/setup.php');
