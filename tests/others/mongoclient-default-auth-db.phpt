--TEST--
Test for PHP-498: Check default database for authentication
--SKIPIF--
<?php require_once dirname(__FILE__) . "/skipif.inc"; ?>
--FILE--
<?php
require_once dirname(__FILE__) . "/../debug.inc";
require_once dirname(__FILE__) . "/../utils.inc";

$dsns = array(
	"mongodb://admin:admin@whisky",
	"mongodb://foo:bar@localhost/?replicaSet=seta",
	"mongodb://foo:bar@primary,secondary/?replicaSet=seta",
	"mongodb://foo:bar@primary:14000/database?replicaSet=seta",
	"mongodb://foo:bar@primary:14000/database/?replicaSet=seta",
);

foreach ($dsns as $dsn) {
	echo $dsn, "\n";
	$m = new Mongo($dsn, array('connect' => false));
	echo "\n";
}
?>
--EXPECTF--
mongodb://admin:admin@whisky
PARSE   INFO: Parsing mongodb://admin:admin@whisky
PARSE   INFO: - Found user 'admin' and a password
PARSE   INFO: - Found node: whisky:27017
PARSE   INFO: - Connection type: STANDALONE
PARSE   INFO: - No database name found for an authenticated connection. Using 'admin' as default database
PARSE   WARN: - Found unknown connection string option 'connect' with value ''

mongodb://foo:bar@localhost/?replicaSet=seta
PARSE   INFO: Parsing mongodb://foo:bar@localhost/?replicaSet=seta
PARSE   INFO: - Found user 'foo' and a password
PARSE   INFO: - Found node: localhost:27017
PARSE   INFO: - Connection type: STANDALONE
PARSE   INFO: - Found option 'replicaSet': 'seta'
PARSE   INFO: - Switching connection type: REPLSET
PARSE   INFO: - No database name found for an authenticated connection. Using 'admin' as default database
PARSE   WARN: - Found unknown connection string option 'connect' with value ''

mongodb://foo:bar@primary,secondary/?replicaSet=seta
PARSE   INFO: Parsing mongodb://foo:bar@primary,secondary/?replicaSet=seta
PARSE   INFO: - Found user 'foo' and a password
PARSE   INFO: - Found node: primary:27017
PARSE   INFO: - Found node: secondary:27017
PARSE   INFO: - Connection type: MULTIPLE
PARSE   INFO: - Found option 'replicaSet': 'seta'
PARSE   INFO: - Switching connection type: REPLSET
PARSE   INFO: - No database name found for an authenticated connection. Using 'admin' as default database
PARSE   WARN: - Found unknown connection string option 'connect' with value ''

mongodb://foo:bar@primary:14000/database?replicaSet=seta
PARSE   INFO: Parsing mongodb://foo:bar@primary:14000/database?replicaSet=seta
PARSE   INFO: - Found user 'foo' and a password
PARSE   INFO: - Found node: primary:14000
PARSE   INFO: - Connection type: STANDALONE
PARSE   INFO: - Found option 'replicaSet': 'seta'
PARSE   INFO: - Switching connection type: REPLSET
PARSE   INFO: - Found database name 'database'
PARSE   WARN: - Found unknown connection string option 'connect' with value ''

mongodb://foo:bar@primary:14000/database/?replicaSet=seta
PARSE   INFO: Parsing mongodb://foo:bar@primary:14000/database/?replicaSet=seta
PARSE   INFO: - Found user 'foo' and a password
PARSE   INFO: - Found node: primary:14000
PARSE   INFO: - Connection type: STANDALONE
PARSE   INFO: - Found option 'replicaSet': 'seta'
PARSE   INFO: - Switching connection type: REPLSET
PARSE   INFO: - Found database name 'database/'
PARSE   WARN: - Found unknown connection string option 'connect' with value ''
