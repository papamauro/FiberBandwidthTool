<?php

namespace Map;

use \Requests;
use \RequestsQuery;
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
 * This class defines the structure of the 'requests' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class RequestsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.RequestsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'requests';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Requests';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Requests';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the rid field
     */
    const COL_RID = 'requests.rid';

    /**
     * the column name for the completed field
     */
    const COL_COMPLETED = 'requests.completed';

    /**
     * the column name for the date field
     */
    const COL_DATE = 'requests.date';

    /**
     * the column name for the resultup field
     */
    const COL_RESULTUP = 'requests.resultup';

    /**
     * the column name for the resultdown field
     */
    const COL_RESULTDOWN = 'requests.resultdown';

    /**
     * the column name for the last_screen field
     */
    const COL_LAST_SCREEN = 'requests.last_screen';

    /**
     * the column name for the avg field
     */
    const COL_AVG = 'requests.avg';

    /**
     * the column name for the ext_uid field
     */
    const COL_EXT_UID = 'requests.ext_uid';

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
        self::TYPE_PHPNAME       => array('Rid', 'Completed', 'Date', 'Resultup', 'Resultdown', 'LastScreen', 'Avg', 'ExtUid', ),
        self::TYPE_CAMELNAME     => array('rid', 'completed', 'date', 'resultup', 'resultdown', 'lastScreen', 'avg', 'extUid', ),
        self::TYPE_COLNAME       => array(RequestsTableMap::COL_RID, RequestsTableMap::COL_COMPLETED, RequestsTableMap::COL_DATE, RequestsTableMap::COL_RESULTUP, RequestsTableMap::COL_RESULTDOWN, RequestsTableMap::COL_LAST_SCREEN, RequestsTableMap::COL_AVG, RequestsTableMap::COL_EXT_UID, ),
        self::TYPE_FIELDNAME     => array('rid', 'completed', 'date', 'resultup', 'resultdown', 'last_screen', 'avg', 'ext_uid', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Rid' => 0, 'Completed' => 1, 'Date' => 2, 'Resultup' => 3, 'Resultdown' => 4, 'LastScreen' => 5, 'Avg' => 6, 'ExtUid' => 7, ),
        self::TYPE_CAMELNAME     => array('rid' => 0, 'completed' => 1, 'date' => 2, 'resultup' => 3, 'resultdown' => 4, 'lastScreen' => 5, 'avg' => 6, 'extUid' => 7, ),
        self::TYPE_COLNAME       => array(RequestsTableMap::COL_RID => 0, RequestsTableMap::COL_COMPLETED => 1, RequestsTableMap::COL_DATE => 2, RequestsTableMap::COL_RESULTUP => 3, RequestsTableMap::COL_RESULTDOWN => 4, RequestsTableMap::COL_LAST_SCREEN => 5, RequestsTableMap::COL_AVG => 6, RequestsTableMap::COL_EXT_UID => 7, ),
        self::TYPE_FIELDNAME     => array('rid' => 0, 'completed' => 1, 'date' => 2, 'resultup' => 3, 'resultdown' => 4, 'last_screen' => 5, 'avg' => 6, 'ext_uid' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
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
        $this->setName('requests');
        $this->setPhpName('Requests');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Requests');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('rid', 'Rid', 'INTEGER', true, null, null);
        $this->addColumn('completed', 'Completed', 'BOOLEAN', false, 1, null);
        $this->addColumn('date', 'Date', 'TIMESTAMP', false, null, null);
        $this->addColumn('resultup', 'Resultup', 'INTEGER', false, null, null);
        $this->addColumn('resultdown', 'Resultdown', 'INTEGER', false, null, null);
        $this->addColumn('last_screen', 'LastScreen', 'INTEGER', false, null, null);
        $this->addColumn('avg', 'Avg', 'BOOLEAN', false, 1, null);
        $this->addForeignKey('ext_uid', 'ExtUid', 'INTEGER', 'user', 'uid', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', '\\User', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ext_uid',
    1 => ':uid',
  ),
), null, null, null, false);
        $this->addRelation('Web', '\\Web', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ext_rid',
    1 => ':rid',
  ),
), null, null, 'Webs', false);
        $this->addRelation('Video', '\\Video', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ext_rid',
    1 => ':rid',
  ),
), null, null, 'Videos', false);
        $this->addRelation('Generic', '\\Generic', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ext_rid',
    1 => ':rid',
  ),
), null, null, 'Generics', false);
        $this->addRelation('Voip', '\\Voip', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ext_rid',
    1 => ':rid',
  ),
), null, null, 'Voips', false);
        $this->addRelation('Security', '\\Security', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ext_rid',
    1 => ':rid',
  ),
), null, null, 'Securities', false);
        $this->addRelation('Remote', '\\Remote', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ext_rid',
    1 => ':rid',
  ),
), null, null, 'Remotes', false);
        $this->addRelation('Mail', '\\Mail', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ext_rid',
    1 => ':rid',
  ),
), null, null, 'Mails', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Rid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Rid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Rid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Rid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Rid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Rid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Rid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? RequestsTableMap::CLASS_DEFAULT : RequestsTableMap::OM_CLASS;
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
     * @return array           (Requests object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = RequestsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RequestsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RequestsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RequestsTableMap::OM_CLASS;
            /** @var Requests $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RequestsTableMap::addInstanceToPool($obj, $key);
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
            $key = RequestsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RequestsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Requests $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RequestsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(RequestsTableMap::COL_RID);
            $criteria->addSelectColumn(RequestsTableMap::COL_COMPLETED);
            $criteria->addSelectColumn(RequestsTableMap::COL_DATE);
            $criteria->addSelectColumn(RequestsTableMap::COL_RESULTUP);
            $criteria->addSelectColumn(RequestsTableMap::COL_RESULTDOWN);
            $criteria->addSelectColumn(RequestsTableMap::COL_LAST_SCREEN);
            $criteria->addSelectColumn(RequestsTableMap::COL_AVG);
            $criteria->addSelectColumn(RequestsTableMap::COL_EXT_UID);
        } else {
            $criteria->addSelectColumn($alias . '.rid');
            $criteria->addSelectColumn($alias . '.completed');
            $criteria->addSelectColumn($alias . '.date');
            $criteria->addSelectColumn($alias . '.resultup');
            $criteria->addSelectColumn($alias . '.resultdown');
            $criteria->addSelectColumn($alias . '.last_screen');
            $criteria->addSelectColumn($alias . '.avg');
            $criteria->addSelectColumn($alias . '.ext_uid');
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
        return Propel::getServiceContainer()->getDatabaseMap(RequestsTableMap::DATABASE_NAME)->getTable(RequestsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(RequestsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(RequestsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new RequestsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Requests or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Requests object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(RequestsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Requests) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RequestsTableMap::DATABASE_NAME);
            $criteria->add(RequestsTableMap::COL_RID, (array) $values, Criteria::IN);
        }

        $query = RequestsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RequestsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RequestsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the requests table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return RequestsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Requests or Criteria object.
     *
     * @param mixed               $criteria Criteria or Requests object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RequestsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Requests object
        }

        if ($criteria->containsKey(RequestsTableMap::COL_RID) && $criteria->keyContainsValue(RequestsTableMap::COL_RID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.RequestsTableMap::COL_RID.')');
        }


        // Set the correct dbName
        $query = RequestsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // RequestsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
RequestsTableMap::buildTableMap();
