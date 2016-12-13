<?php

namespace Map;

use \Voip;
use \VoipQuery;
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
 * This class defines the structure of the 'voip' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class VoipTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.VoipTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'voip';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Voip';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Voip';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the void_id field
     */
    const COL_VOID_ID = 'voip.void_id';

    /**
     * the column name for the uso_voip field
     */
    const COL_USO_VOIP = 'voip.uso_voip';

    /**
     * the column name for the telefonate_contemporanee field
     */
    const COL_TELEFONATE_CONTEMPORANEE = 'voip.telefonate_contemporanee';

    /**
     * the column name for the codec field
     */
    const COL_CODEC = 'voip.codec';

    /**
     * the column name for the compressed_rtp field
     */
    const COL_COMPRESSED_RTP = 'voip.compressed_rtp';

    /**
     * the column name for the l2_protocol field
     */
    const COL_L2_PROTOCOL = 'voip.l2_protocol';

    /**
     * the column name for the up_bandwidth field
     */
    const COL_UP_BANDWIDTH = 'voip.up_bandwidth';

    /**
     * the column name for the down_bandwidth field
     */
    const COL_DOWN_BANDWIDTH = 'voip.down_bandwidth';

    /**
     * the column name for the ext_rid field
     */
    const COL_EXT_RID = 'voip.ext_rid';

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
        self::TYPE_PHPNAME       => array('VoidId', 'UsoVoip', 'TelefonateContemporanee', 'Codec', 'CompressedRtp', 'L2Protocol', 'UpBandwidth', 'DownBandwidth', 'ExtRid', ),
        self::TYPE_CAMELNAME     => array('voidId', 'usoVoip', 'telefonateContemporanee', 'codec', 'compressedRtp', 'l2Protocol', 'upBandwidth', 'downBandwidth', 'extRid', ),
        self::TYPE_COLNAME       => array(VoipTableMap::COL_VOID_ID, VoipTableMap::COL_USO_VOIP, VoipTableMap::COL_TELEFONATE_CONTEMPORANEE, VoipTableMap::COL_CODEC, VoipTableMap::COL_COMPRESSED_RTP, VoipTableMap::COL_L2_PROTOCOL, VoipTableMap::COL_UP_BANDWIDTH, VoipTableMap::COL_DOWN_BANDWIDTH, VoipTableMap::COL_EXT_RID, ),
        self::TYPE_FIELDNAME     => array('void_id', 'uso_voip', 'telefonate_contemporanee', 'codec', 'compressed_rtp', 'l2_protocol', 'up_bandwidth', 'down_bandwidth', 'ext_rid', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('VoidId' => 0, 'UsoVoip' => 1, 'TelefonateContemporanee' => 2, 'Codec' => 3, 'CompressedRtp' => 4, 'L2Protocol' => 5, 'UpBandwidth' => 6, 'DownBandwidth' => 7, 'ExtRid' => 8, ),
        self::TYPE_CAMELNAME     => array('voidId' => 0, 'usoVoip' => 1, 'telefonateContemporanee' => 2, 'codec' => 3, 'compressedRtp' => 4, 'l2Protocol' => 5, 'upBandwidth' => 6, 'downBandwidth' => 7, 'extRid' => 8, ),
        self::TYPE_COLNAME       => array(VoipTableMap::COL_VOID_ID => 0, VoipTableMap::COL_USO_VOIP => 1, VoipTableMap::COL_TELEFONATE_CONTEMPORANEE => 2, VoipTableMap::COL_CODEC => 3, VoipTableMap::COL_COMPRESSED_RTP => 4, VoipTableMap::COL_L2_PROTOCOL => 5, VoipTableMap::COL_UP_BANDWIDTH => 6, VoipTableMap::COL_DOWN_BANDWIDTH => 7, VoipTableMap::COL_EXT_RID => 8, ),
        self::TYPE_FIELDNAME     => array('void_id' => 0, 'uso_voip' => 1, 'telefonate_contemporanee' => 2, 'codec' => 3, 'compressed_rtp' => 4, 'l2_protocol' => 5, 'up_bandwidth' => 6, 'down_bandwidth' => 7, 'ext_rid' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
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
        $this->setName('voip');
        $this->setPhpName('Voip');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Voip');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('void_id', 'VoidId', 'INTEGER', true, null, null);
        $this->addColumn('uso_voip', 'UsoVoip', 'BOOLEAN', false, 1, null);
        $this->addColumn('telefonate_contemporanee', 'TelefonateContemporanee', 'INTEGER', false, null, null);
        $this->addColumn('codec', 'Codec', 'INTEGER', false, null, null);
        $this->addColumn('compressed_rtp', 'CompressedRtp', 'BOOLEAN', false, 1, null);
        $this->addColumn('l2_protocol', 'L2Protocol', 'VARCHAR', false, 11, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('VoidId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('VoidId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('VoidId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('VoidId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('VoidId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('VoidId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('VoidId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? VoipTableMap::CLASS_DEFAULT : VoipTableMap::OM_CLASS;
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
     * @return array           (Voip object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = VoipTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = VoipTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + VoipTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = VoipTableMap::OM_CLASS;
            /** @var Voip $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            VoipTableMap::addInstanceToPool($obj, $key);
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
            $key = VoipTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = VoipTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Voip $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                VoipTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(VoipTableMap::COL_VOID_ID);
            $criteria->addSelectColumn(VoipTableMap::COL_USO_VOIP);
            $criteria->addSelectColumn(VoipTableMap::COL_TELEFONATE_CONTEMPORANEE);
            $criteria->addSelectColumn(VoipTableMap::COL_CODEC);
            $criteria->addSelectColumn(VoipTableMap::COL_COMPRESSED_RTP);
            $criteria->addSelectColumn(VoipTableMap::COL_L2_PROTOCOL);
            $criteria->addSelectColumn(VoipTableMap::COL_UP_BANDWIDTH);
            $criteria->addSelectColumn(VoipTableMap::COL_DOWN_BANDWIDTH);
            $criteria->addSelectColumn(VoipTableMap::COL_EXT_RID);
        } else {
            $criteria->addSelectColumn($alias . '.void_id');
            $criteria->addSelectColumn($alias . '.uso_voip');
            $criteria->addSelectColumn($alias . '.telefonate_contemporanee');
            $criteria->addSelectColumn($alias . '.codec');
            $criteria->addSelectColumn($alias . '.compressed_rtp');
            $criteria->addSelectColumn($alias . '.l2_protocol');
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
        return Propel::getServiceContainer()->getDatabaseMap(VoipTableMap::DATABASE_NAME)->getTable(VoipTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(VoipTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(VoipTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new VoipTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Voip or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Voip object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(VoipTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Voip) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(VoipTableMap::DATABASE_NAME);
            $criteria->add(VoipTableMap::COL_VOID_ID, (array) $values, Criteria::IN);
        }

        $query = VoipQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            VoipTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                VoipTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the voip table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return VoipQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Voip or Criteria object.
     *
     * @param mixed               $criteria Criteria or Voip object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VoipTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Voip object
        }

        if ($criteria->containsKey(VoipTableMap::COL_VOID_ID) && $criteria->keyContainsValue(VoipTableMap::COL_VOID_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.VoipTableMap::COL_VOID_ID.')');
        }


        // Set the correct dbName
        $query = VoipQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // VoipTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
VoipTableMap::buildTableMap();
