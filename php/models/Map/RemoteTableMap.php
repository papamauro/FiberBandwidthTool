<?php

namespace Map;

use \Remote;
use \RemoteQuery;
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
 * This class defines the structure of the 'remote' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class RemoteTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.RemoteTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'remote';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Remote';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Remote';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the remote_id field
     */
    const COL_REMOTE_ID = 'remote.remote_id';

    /**
     * the column name for the remote_used field
     */
    const COL_REMOTE_USED = 'remote.remote_used';

    /**
     * the column name for the concurrent_access field
     */
    const COL_CONCURRENT_ACCESS = 'remote.concurrent_access';

    /**
     * the column name for the remote_service field
     */
    const COL_REMOTE_SERVICE = 'remote.remote_service';

    /**
     * the column name for the citrix_br field
     */
    const COL_CITRIX_BR = 'remote.citrix_br';

    /**
     * the column name for the office_band field
     */
    const COL_OFFICE_BAND = 'remote.office_band';

    /**
     * the column name for the internet_band field
     */
    const COL_INTERNET_BAND = 'remote.internet_band';

    /**
     * the column name for the printing_band field
     */
    const COL_PRINTING_BAND = 'remote.printing_band';

    /**
     * the column name for the sd_video_band field
     */
    const COL_SD_VIDEO_BAND = 'remote.sd_video_band';

    /**
     * the column name for the hd_video_band field
     */
    const COL_HD_VIDEO_BAND = 'remote.hd_video_band';

    /**
     * the column name for the up_bandwidth field
     */
    const COL_UP_BANDWIDTH = 'remote.up_bandwidth';

    /**
     * the column name for the down_bandwidth field
     */
    const COL_DOWN_BANDWIDTH = 'remote.down_bandwidth';

    /**
     * the column name for the ext_rid field
     */
    const COL_EXT_RID = 'remote.ext_rid';

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
        self::TYPE_PHPNAME       => array('RemoteId', 'RemoteUsed', 'ConcurrentAccess', 'RemoteService', 'CitrixBr', 'OfficeBand', 'InternetBand', 'PrintingBand', 'SdVideoBand', 'HdVideoBand', 'UpBandwidth', 'DownBandwidth', 'ExtRid', ),
        self::TYPE_CAMELNAME     => array('remoteId', 'remoteUsed', 'concurrentAccess', 'remoteService', 'citrixBr', 'officeBand', 'internetBand', 'printingBand', 'sdVideoBand', 'hdVideoBand', 'upBandwidth', 'downBandwidth', 'extRid', ),
        self::TYPE_COLNAME       => array(RemoteTableMap::COL_REMOTE_ID, RemoteTableMap::COL_REMOTE_USED, RemoteTableMap::COL_CONCURRENT_ACCESS, RemoteTableMap::COL_REMOTE_SERVICE, RemoteTableMap::COL_CITRIX_BR, RemoteTableMap::COL_OFFICE_BAND, RemoteTableMap::COL_INTERNET_BAND, RemoteTableMap::COL_PRINTING_BAND, RemoteTableMap::COL_SD_VIDEO_BAND, RemoteTableMap::COL_HD_VIDEO_BAND, RemoteTableMap::COL_UP_BANDWIDTH, RemoteTableMap::COL_DOWN_BANDWIDTH, RemoteTableMap::COL_EXT_RID, ),
        self::TYPE_FIELDNAME     => array('remote_id', 'remote_used', 'concurrent_access', 'remote_service', 'citrix_br', 'office_band', 'internet_band', 'printing_band', 'sd_video_band', 'hd_video_band', 'up_bandwidth', 'down_bandwidth', 'ext_rid', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('RemoteId' => 0, 'RemoteUsed' => 1, 'ConcurrentAccess' => 2, 'RemoteService' => 3, 'CitrixBr' => 4, 'OfficeBand' => 5, 'InternetBand' => 6, 'PrintingBand' => 7, 'SdVideoBand' => 8, 'HdVideoBand' => 9, 'UpBandwidth' => 10, 'DownBandwidth' => 11, 'ExtRid' => 12, ),
        self::TYPE_CAMELNAME     => array('remoteId' => 0, 'remoteUsed' => 1, 'concurrentAccess' => 2, 'remoteService' => 3, 'citrixBr' => 4, 'officeBand' => 5, 'internetBand' => 6, 'printingBand' => 7, 'sdVideoBand' => 8, 'hdVideoBand' => 9, 'upBandwidth' => 10, 'downBandwidth' => 11, 'extRid' => 12, ),
        self::TYPE_COLNAME       => array(RemoteTableMap::COL_REMOTE_ID => 0, RemoteTableMap::COL_REMOTE_USED => 1, RemoteTableMap::COL_CONCURRENT_ACCESS => 2, RemoteTableMap::COL_REMOTE_SERVICE => 3, RemoteTableMap::COL_CITRIX_BR => 4, RemoteTableMap::COL_OFFICE_BAND => 5, RemoteTableMap::COL_INTERNET_BAND => 6, RemoteTableMap::COL_PRINTING_BAND => 7, RemoteTableMap::COL_SD_VIDEO_BAND => 8, RemoteTableMap::COL_HD_VIDEO_BAND => 9, RemoteTableMap::COL_UP_BANDWIDTH => 10, RemoteTableMap::COL_DOWN_BANDWIDTH => 11, RemoteTableMap::COL_EXT_RID => 12, ),
        self::TYPE_FIELDNAME     => array('remote_id' => 0, 'remote_used' => 1, 'concurrent_access' => 2, 'remote_service' => 3, 'citrix_br' => 4, 'office_band' => 5, 'internet_band' => 6, 'printing_band' => 7, 'sd_video_band' => 8, 'hd_video_band' => 9, 'up_bandwidth' => 10, 'down_bandwidth' => 11, 'ext_rid' => 12, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
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
        $this->setName('remote');
        $this->setPhpName('Remote');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Remote');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('remote_id', 'RemoteId', 'INTEGER', true, null, null);
        $this->addColumn('remote_used', 'RemoteUsed', 'BOOLEAN', false, 1, null);
        $this->addColumn('concurrent_access', 'ConcurrentAccess', 'INTEGER', false, null, null);
        $this->addColumn('remote_service', 'RemoteService', 'VARCHAR', false, 11, null);
        $this->addColumn('citrix_br', 'CitrixBr', 'BOOLEAN', false, 1, null);
        $this->addColumn('office_band', 'OfficeBand', 'INTEGER', false, null, null);
        $this->addColumn('internet_band', 'InternetBand', 'INTEGER', false, null, null);
        $this->addColumn('printing_band', 'PrintingBand', 'INTEGER', false, null, null);
        $this->addColumn('sd_video_band', 'SdVideoBand', 'INTEGER', false, null, null);
        $this->addColumn('hd_video_band', 'HdVideoBand', 'INTEGER', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RemoteId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RemoteId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RemoteId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RemoteId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RemoteId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RemoteId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('RemoteId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? RemoteTableMap::CLASS_DEFAULT : RemoteTableMap::OM_CLASS;
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
     * @return array           (Remote object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = RemoteTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RemoteTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RemoteTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RemoteTableMap::OM_CLASS;
            /** @var Remote $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RemoteTableMap::addInstanceToPool($obj, $key);
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
            $key = RemoteTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RemoteTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Remote $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RemoteTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(RemoteTableMap::COL_REMOTE_ID);
            $criteria->addSelectColumn(RemoteTableMap::COL_REMOTE_USED);
            $criteria->addSelectColumn(RemoteTableMap::COL_CONCURRENT_ACCESS);
            $criteria->addSelectColumn(RemoteTableMap::COL_REMOTE_SERVICE);
            $criteria->addSelectColumn(RemoteTableMap::COL_CITRIX_BR);
            $criteria->addSelectColumn(RemoteTableMap::COL_OFFICE_BAND);
            $criteria->addSelectColumn(RemoteTableMap::COL_INTERNET_BAND);
            $criteria->addSelectColumn(RemoteTableMap::COL_PRINTING_BAND);
            $criteria->addSelectColumn(RemoteTableMap::COL_SD_VIDEO_BAND);
            $criteria->addSelectColumn(RemoteTableMap::COL_HD_VIDEO_BAND);
            $criteria->addSelectColumn(RemoteTableMap::COL_UP_BANDWIDTH);
            $criteria->addSelectColumn(RemoteTableMap::COL_DOWN_BANDWIDTH);
            $criteria->addSelectColumn(RemoteTableMap::COL_EXT_RID);
        } else {
            $criteria->addSelectColumn($alias . '.remote_id');
            $criteria->addSelectColumn($alias . '.remote_used');
            $criteria->addSelectColumn($alias . '.concurrent_access');
            $criteria->addSelectColumn($alias . '.remote_service');
            $criteria->addSelectColumn($alias . '.citrix_br');
            $criteria->addSelectColumn($alias . '.office_band');
            $criteria->addSelectColumn($alias . '.internet_band');
            $criteria->addSelectColumn($alias . '.printing_band');
            $criteria->addSelectColumn($alias . '.sd_video_band');
            $criteria->addSelectColumn($alias . '.hd_video_band');
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
        return Propel::getServiceContainer()->getDatabaseMap(RemoteTableMap::DATABASE_NAME)->getTable(RemoteTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(RemoteTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(RemoteTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new RemoteTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Remote or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Remote object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(RemoteTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Remote) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RemoteTableMap::DATABASE_NAME);
            $criteria->add(RemoteTableMap::COL_REMOTE_ID, (array) $values, Criteria::IN);
        }

        $query = RemoteQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RemoteTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RemoteTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the remote table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return RemoteQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Remote or Criteria object.
     *
     * @param mixed               $criteria Criteria or Remote object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RemoteTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Remote object
        }

        if ($criteria->containsKey(RemoteTableMap::COL_REMOTE_ID) && $criteria->keyContainsValue(RemoteTableMap::COL_REMOTE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.RemoteTableMap::COL_REMOTE_ID.')');
        }


        // Set the correct dbName
        $query = RemoteQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // RemoteTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
RemoteTableMap::buildTableMap();
