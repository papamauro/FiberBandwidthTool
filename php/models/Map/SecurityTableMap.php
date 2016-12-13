<?php

namespace Map;

use \Security;
use \SecurityQuery;
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
 * This class defines the structure of the 'security' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SecurityTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SecurityTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'security';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Security';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Security';

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
     * the column name for the security_id field
     */
    const COL_SECURITY_ID = 'security.security_id';

    /**
     * the column name for the use_security field
     */
    const COL_USE_SECURITY = 'security.use_security';

    /**
     * the column name for the external_mediaserver field
     */
    const COL_EXTERNAL_MEDIASERVER = 'security.external_mediaserver';

    /**
     * the column name for the remote_access field
     */
    const COL_REMOTE_ACCESS = 'security.remote_access';

    /**
     * the column name for the number_camera field
     */
    const COL_NUMBER_CAMERA = 'security.number_camera';

    /**
     * the column name for the fps field
     */
    const COL_FPS = 'security.fps';

    /**
     * the column name for the resolution field
     */
    const COL_RESOLUTION = 'security.resolution';

    /**
     * the column name for the h264_profile field
     */
    const COL_H264_PROFILE = 'security.h264_profile';

    /**
     * the column name for the number_camera_viewed field
     */
    const COL_NUMBER_CAMERA_VIEWED = 'security.number_camera_viewed';

    /**
     * the column name for the up_bandwidth field
     */
    const COL_UP_BANDWIDTH = 'security.up_bandwidth';

    /**
     * the column name for the down_bandwidth field
     */
    const COL_DOWN_BANDWIDTH = 'security.down_bandwidth';

    /**
     * the column name for the view_resolution field
     */
    const COL_VIEW_RESOLUTION = 'security.view_resolution';

    /**
     * the column name for the ext_rid field
     */
    const COL_EXT_RID = 'security.ext_rid';

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
        self::TYPE_PHPNAME       => array('SecurityId', 'UseSecurity', 'ExternalMediaserver', 'RemoteAccess', 'NumberCamera', 'Fps', 'Resolution', 'H264Profile', 'NumberCameraViewed', 'UpBandwidth', 'DownBandwidth', 'ViewResolution', 'ExtRid', ),
        self::TYPE_CAMELNAME     => array('securityId', 'useSecurity', 'externalMediaserver', 'remoteAccess', 'numberCamera', 'fps', 'resolution', 'h264Profile', 'numberCameraViewed', 'upBandwidth', 'downBandwidth', 'viewResolution', 'extRid', ),
        self::TYPE_COLNAME       => array(SecurityTableMap::COL_SECURITY_ID, SecurityTableMap::COL_USE_SECURITY, SecurityTableMap::COL_EXTERNAL_MEDIASERVER, SecurityTableMap::COL_REMOTE_ACCESS, SecurityTableMap::COL_NUMBER_CAMERA, SecurityTableMap::COL_FPS, SecurityTableMap::COL_RESOLUTION, SecurityTableMap::COL_H264_PROFILE, SecurityTableMap::COL_NUMBER_CAMERA_VIEWED, SecurityTableMap::COL_UP_BANDWIDTH, SecurityTableMap::COL_DOWN_BANDWIDTH, SecurityTableMap::COL_VIEW_RESOLUTION, SecurityTableMap::COL_EXT_RID, ),
        self::TYPE_FIELDNAME     => array('security_id', 'use_security', 'external_mediaserver', 'remote_access', 'number_camera', 'fps', 'resolution', 'h264_profile', 'number_camera_viewed', 'up_bandwidth', 'down_bandwidth', 'view_resolution', 'ext_rid', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('SecurityId' => 0, 'UseSecurity' => 1, 'ExternalMediaserver' => 2, 'RemoteAccess' => 3, 'NumberCamera' => 4, 'Fps' => 5, 'Resolution' => 6, 'H264Profile' => 7, 'NumberCameraViewed' => 8, 'UpBandwidth' => 9, 'DownBandwidth' => 10, 'ViewResolution' => 11, 'ExtRid' => 12, ),
        self::TYPE_CAMELNAME     => array('securityId' => 0, 'useSecurity' => 1, 'externalMediaserver' => 2, 'remoteAccess' => 3, 'numberCamera' => 4, 'fps' => 5, 'resolution' => 6, 'h264Profile' => 7, 'numberCameraViewed' => 8, 'upBandwidth' => 9, 'downBandwidth' => 10, 'viewResolution' => 11, 'extRid' => 12, ),
        self::TYPE_COLNAME       => array(SecurityTableMap::COL_SECURITY_ID => 0, SecurityTableMap::COL_USE_SECURITY => 1, SecurityTableMap::COL_EXTERNAL_MEDIASERVER => 2, SecurityTableMap::COL_REMOTE_ACCESS => 3, SecurityTableMap::COL_NUMBER_CAMERA => 4, SecurityTableMap::COL_FPS => 5, SecurityTableMap::COL_RESOLUTION => 6, SecurityTableMap::COL_H264_PROFILE => 7, SecurityTableMap::COL_NUMBER_CAMERA_VIEWED => 8, SecurityTableMap::COL_UP_BANDWIDTH => 9, SecurityTableMap::COL_DOWN_BANDWIDTH => 10, SecurityTableMap::COL_VIEW_RESOLUTION => 11, SecurityTableMap::COL_EXT_RID => 12, ),
        self::TYPE_FIELDNAME     => array('security_id' => 0, 'use_security' => 1, 'external_mediaserver' => 2, 'remote_access' => 3, 'number_camera' => 4, 'fps' => 5, 'resolution' => 6, 'h264_profile' => 7, 'number_camera_viewed' => 8, 'up_bandwidth' => 9, 'down_bandwidth' => 10, 'view_resolution' => 11, 'ext_rid' => 12, ),
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
        $this->setName('security');
        $this->setPhpName('Security');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Security');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('security_id', 'SecurityId', 'INTEGER', true, null, null);
        $this->addColumn('use_security', 'UseSecurity', 'BOOLEAN', false, 1, null);
        $this->addColumn('external_mediaserver', 'ExternalMediaserver', 'BOOLEAN', false, 1, null);
        $this->addColumn('remote_access', 'RemoteAccess', 'BOOLEAN', false, 1, null);
        $this->addColumn('number_camera', 'NumberCamera', 'INTEGER', false, null, null);
        $this->addColumn('fps', 'Fps', 'INTEGER', false, null, null);
        $this->addColumn('resolution', 'Resolution', 'VARCHAR', false, 11, null);
        $this->addColumn('h264_profile', 'H264Profile', 'INTEGER', false, null, null);
        $this->addColumn('number_camera_viewed', 'NumberCameraViewed', 'INTEGER', false, null, null);
        $this->addColumn('up_bandwidth', 'UpBandwidth', 'INTEGER', false, null, null);
        $this->addColumn('down_bandwidth', 'DownBandwidth', 'INTEGER', false, null, null);
        $this->addColumn('view_resolution', 'ViewResolution', 'VARCHAR', false, 11, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SecurityId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SecurityId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SecurityId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SecurityId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SecurityId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SecurityId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('SecurityId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SecurityTableMap::CLASS_DEFAULT : SecurityTableMap::OM_CLASS;
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
     * @return array           (Security object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SecurityTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SecurityTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SecurityTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SecurityTableMap::OM_CLASS;
            /** @var Security $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SecurityTableMap::addInstanceToPool($obj, $key);
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
            $key = SecurityTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SecurityTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Security $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SecurityTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SecurityTableMap::COL_SECURITY_ID);
            $criteria->addSelectColumn(SecurityTableMap::COL_USE_SECURITY);
            $criteria->addSelectColumn(SecurityTableMap::COL_EXTERNAL_MEDIASERVER);
            $criteria->addSelectColumn(SecurityTableMap::COL_REMOTE_ACCESS);
            $criteria->addSelectColumn(SecurityTableMap::COL_NUMBER_CAMERA);
            $criteria->addSelectColumn(SecurityTableMap::COL_FPS);
            $criteria->addSelectColumn(SecurityTableMap::COL_RESOLUTION);
            $criteria->addSelectColumn(SecurityTableMap::COL_H264_PROFILE);
            $criteria->addSelectColumn(SecurityTableMap::COL_NUMBER_CAMERA_VIEWED);
            $criteria->addSelectColumn(SecurityTableMap::COL_UP_BANDWIDTH);
            $criteria->addSelectColumn(SecurityTableMap::COL_DOWN_BANDWIDTH);
            $criteria->addSelectColumn(SecurityTableMap::COL_VIEW_RESOLUTION);
            $criteria->addSelectColumn(SecurityTableMap::COL_EXT_RID);
        } else {
            $criteria->addSelectColumn($alias . '.security_id');
            $criteria->addSelectColumn($alias . '.use_security');
            $criteria->addSelectColumn($alias . '.external_mediaserver');
            $criteria->addSelectColumn($alias . '.remote_access');
            $criteria->addSelectColumn($alias . '.number_camera');
            $criteria->addSelectColumn($alias . '.fps');
            $criteria->addSelectColumn($alias . '.resolution');
            $criteria->addSelectColumn($alias . '.h264_profile');
            $criteria->addSelectColumn($alias . '.number_camera_viewed');
            $criteria->addSelectColumn($alias . '.up_bandwidth');
            $criteria->addSelectColumn($alias . '.down_bandwidth');
            $criteria->addSelectColumn($alias . '.view_resolution');
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
        return Propel::getServiceContainer()->getDatabaseMap(SecurityTableMap::DATABASE_NAME)->getTable(SecurityTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SecurityTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SecurityTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SecurityTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Security or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Security object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SecurityTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Security) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SecurityTableMap::DATABASE_NAME);
            $criteria->add(SecurityTableMap::COL_SECURITY_ID, (array) $values, Criteria::IN);
        }

        $query = SecurityQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SecurityTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SecurityTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the security table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SecurityQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Security or Criteria object.
     *
     * @param mixed               $criteria Criteria or Security object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SecurityTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Security object
        }

        if ($criteria->containsKey(SecurityTableMap::COL_SECURITY_ID) && $criteria->keyContainsValue(SecurityTableMap::COL_SECURITY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SecurityTableMap::COL_SECURITY_ID.')');
        }


        // Set the correct dbName
        $query = SecurityQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SecurityTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SecurityTableMap::buildTableMap();
