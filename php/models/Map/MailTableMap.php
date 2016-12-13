<?php

namespace Map;

use \Mail;
use \MailQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'mail' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class MailTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.MailTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'mail';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Mail';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Mail';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the mail_id field
     */
    const COL_MAIL_ID = 'mail.mail_id';

    /**
     * the column name for the internal_mail_server field
     */
    const COL_INTERNAL_MAIL_SERVER = 'mail.internal_mail_server';

    /**
     * the column name for the mail_count field
     */
    const COL_MAIL_COUNT = 'mail.mail_count';

    /**
     * the column name for the send_mail_latency field
     */
    const COL_SEND_MAIL_LATENCY = 'mail.send_mail_latency';

    /**
     * the column name for the receive_mail_latency field
     */
    const COL_RECEIVE_MAIL_LATENCY = 'mail.receive_mail_latency';

    /**
     * the column name for the average_received_mail field
     */
    const COL_AVERAGE_RECEIVED_MAIL = 'mail.average_received_mail';

    /**
     * the column name for the average_sended_mail field
     */
    const COL_AVERAGE_SENDED_MAIL = 'mail.average_sended_mail';

    /**
     * the column name for the mail_size field
     */
    const COL_MAIL_SIZE = 'mail.mail_size';

    /**
     * the column name for the up_bandwidth field
     */
    const COL_UP_BANDWIDTH = 'mail.up_bandwidth';

    /**
     * the column name for the down_bandwidth field
     */
    const COL_DOWN_BANDWIDTH = 'mail.down_bandwidth';

    /**
     * the column name for the ext_rid field
     */
    const COL_EXT_RID = 'mail.ext_rid';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('MailId', 'InternalMailServer', 'MailCount', 'SendMailLatency', 'ReceiveMailLatency', 'AverageReceivedMail', 'AverageSendedMail', 'MailSize', 'UpBandwidth', 'DownBandwidth', 'ExtRid', ),
        self::TYPE_CAMELNAME     => array('mailId', 'internalMailServer', 'mailCount', 'sendMailLatency', 'receiveMailLatency', 'averageReceivedMail', 'averageSendedMail', 'mailSize', 'upBandwidth', 'downBandwidth', 'extRid', ),
        self::TYPE_COLNAME       => array(MailTableMap::COL_MAIL_ID, MailTableMap::COL_INTERNAL_MAIL_SERVER, MailTableMap::COL_MAIL_COUNT, MailTableMap::COL_SEND_MAIL_LATENCY, MailTableMap::COL_RECEIVE_MAIL_LATENCY, MailTableMap::COL_AVERAGE_RECEIVED_MAIL, MailTableMap::COL_AVERAGE_SENDED_MAIL, MailTableMap::COL_MAIL_SIZE, MailTableMap::COL_UP_BANDWIDTH, MailTableMap::COL_DOWN_BANDWIDTH, MailTableMap::COL_EXT_RID, ),
        self::TYPE_FIELDNAME     => array('mail_id', 'internal_mail_server', 'mail_count', 'send_mail_latency', 'receive_mail_latency', 'average_received_mail', 'average_sended_mail', 'mail_size', 'up_bandwidth', 'down_bandwidth', 'ext_rid', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('MailId' => 0, 'InternalMailServer' => 1, 'MailCount' => 2, 'SendMailLatency' => 3, 'ReceiveMailLatency' => 4, 'AverageReceivedMail' => 5, 'AverageSendedMail' => 6, 'MailSize' => 7, 'UpBandwidth' => 8, 'DownBandwidth' => 9, 'ExtRid' => 10, ),
        self::TYPE_CAMELNAME     => array('mailId' => 0, 'internalMailServer' => 1, 'mailCount' => 2, 'sendMailLatency' => 3, 'receiveMailLatency' => 4, 'averageReceivedMail' => 5, 'averageSendedMail' => 6, 'mailSize' => 7, 'upBandwidth' => 8, 'downBandwidth' => 9, 'extRid' => 10, ),
        self::TYPE_COLNAME       => array(MailTableMap::COL_MAIL_ID => 0, MailTableMap::COL_INTERNAL_MAIL_SERVER => 1, MailTableMap::COL_MAIL_COUNT => 2, MailTableMap::COL_SEND_MAIL_LATENCY => 3, MailTableMap::COL_RECEIVE_MAIL_LATENCY => 4, MailTableMap::COL_AVERAGE_RECEIVED_MAIL => 5, MailTableMap::COL_AVERAGE_SENDED_MAIL => 6, MailTableMap::COL_MAIL_SIZE => 7, MailTableMap::COL_UP_BANDWIDTH => 8, MailTableMap::COL_DOWN_BANDWIDTH => 9, MailTableMap::COL_EXT_RID => 10, ),
        self::TYPE_FIELDNAME     => array('mail_id' => 0, 'internal_mail_server' => 1, 'mail_count' => 2, 'send_mail_latency' => 3, 'receive_mail_latency' => 4, 'average_received_mail' => 5, 'average_sended_mail' => 6, 'mail_size' => 7, 'up_bandwidth' => 8, 'down_bandwidth' => 9, 'ext_rid' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('mail');
        $this->setPhpName('Mail');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Mail');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('mail_id', 'MailId', 'INTEGER', true, null, null);
        $this->addColumn('internal_mail_server', 'InternalMailServer', 'BOOLEAN', false, 1, null);
        $this->addColumn('mail_count', 'MailCount', 'INTEGER', false, null, null);
        $this->addColumn('send_mail_latency', 'SendMailLatency', 'INTEGER', false, null, null);
        $this->addColumn('receive_mail_latency', 'ReceiveMailLatency', 'INTEGER', false, null, null);
        $this->addColumn('average_received_mail', 'AverageReceivedMail', 'INTEGER', false, null, null);
        $this->addColumn('average_sended_mail', 'AverageSendedMail', 'INTEGER', false, null, null);
        $this->addColumn('mail_size', 'MailSize', 'INTEGER', false, null, null);
        $this->addColumn('up_bandwidth', 'UpBandwidth', 'INTEGER', false, null, null);
        $this->addColumn('down_bandwidth', 'DownBandwidth', 'INTEGER', false, null, null);
        $this->addForeignKey('ext_rid', 'ExtRid', 'INTEGER', 'requests', 'rid', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Requests', '\\Requests', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ext_rid',
    1 => ':rid',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MailId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MailId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MailId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MailId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MailId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MailId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('MailId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? MailTableMap::CLASS_DEFAULT : MailTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Mail object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = MailTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MailTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MailTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MailTableMap::OM_CLASS;
            /** @var Mail $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MailTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = MailTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MailTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Mail $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MailTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(MailTableMap::COL_MAIL_ID);
            $criteria->addSelectColumn(MailTableMap::COL_INTERNAL_MAIL_SERVER);
            $criteria->addSelectColumn(MailTableMap::COL_MAIL_COUNT);
            $criteria->addSelectColumn(MailTableMap::COL_SEND_MAIL_LATENCY);
            $criteria->addSelectColumn(MailTableMap::COL_RECEIVE_MAIL_LATENCY);
            $criteria->addSelectColumn(MailTableMap::COL_AVERAGE_RECEIVED_MAIL);
            $criteria->addSelectColumn(MailTableMap::COL_AVERAGE_SENDED_MAIL);
            $criteria->addSelectColumn(MailTableMap::COL_MAIL_SIZE);
            $criteria->addSelectColumn(MailTableMap::COL_UP_BANDWIDTH);
            $criteria->addSelectColumn(MailTableMap::COL_DOWN_BANDWIDTH);
            $criteria->addSelectColumn(MailTableMap::COL_EXT_RID);
        } else {
            $criteria->addSelectColumn($alias . '.mail_id');
            $criteria->addSelectColumn($alias . '.internal_mail_server');
            $criteria->addSelectColumn($alias . '.mail_count');
            $criteria->addSelectColumn($alias . '.send_mail_latency');
            $criteria->addSelectColumn($alias . '.receive_mail_latency');
            $criteria->addSelectColumn($alias . '.average_received_mail');
            $criteria->addSelectColumn($alias . '.average_sended_mail');
            $criteria->addSelectColumn($alias . '.mail_size');
            $criteria->addSelectColumn($alias . '.up_bandwidth');
            $criteria->addSelectColumn($alias . '.down_bandwidth');
            $criteria->addSelectColumn($alias . '.ext_rid');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(MailTableMap::DATABASE_NAME)->getTable(MailTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(MailTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(MailTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new MailTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Mail or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Mail object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MailTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Mail) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MailTableMap::DATABASE_NAME);
            $criteria->add(MailTableMap::COL_MAIL_ID, (array) $values, Criteria::IN);
        }

        $query = MailQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MailTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MailTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the mail table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return MailQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Mail or Criteria object.
     *
     * @param mixed               $criteria Criteria or Mail object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MailTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Mail object
        }

        if ($criteria->containsKey(MailTableMap::COL_MAIL_ID) && $criteria->keyContainsValue(MailTableMap::COL_MAIL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.MailTableMap::COL_MAIL_ID.')');
        }


        // Set the correct dbName
        $query = MailQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // MailTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
MailTableMap::buildTableMap();
