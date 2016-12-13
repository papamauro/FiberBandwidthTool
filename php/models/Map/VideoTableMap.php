<?php

namespace Map;

use \Video;
use \VideoQuery;
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
 * This class defines the structure of the 'video' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class VideoTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.VideoTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'video';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Video';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Video';

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
     * the column name for the video_id field
     */
    const COL_VIDEO_ID = 'video.video_id';

    /**
     * the column name for the uso_video field
     */
    const COL_USO_VIDEO = 'video.uso_video';

    /**
     * the column name for the numero_partecipanti_entrata field
     */
    const COL_NUMERO_PARTECIPANTI_ENTRATA = 'video.numero_partecipanti_entrata';

    /**
     * the column name for the numero_partecipanti_uscita field
     */
    const COL_NUMERO_PARTECIPANTI_USCITA = 'video.numero_partecipanti_uscita';

    /**
     * the column name for the risoluzione field
     */
    const COL_RISOLUZIONE = 'video.risoluzione';

    /**
     * the column name for the dinamicita_immagine field
     */
    const COL_DINAMICITA_IMMAGINE = 'video.dinamicita_immagine';

    /**
     * the column name for the fps field
     */
    const COL_FPS = 'video.fps';

    /**
     * the column name for the sessioni_contemporanee field
     */
    const COL_SESSIONI_CONTEMPORANEE = 'video.sessioni_contemporanee';

    /**
     * the column name for the ext_rid field
     */
    const COL_EXT_RID = 'video.ext_rid';

    /**
     * the column name for the up_bandwidth field
     */
    const COL_UP_BANDWIDTH = 'video.up_bandwidth';

    /**
     * the column name for the down_bandwidth field
     */
    const COL_DOWN_BANDWIDTH = 'video.down_bandwidth';

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
        self::TYPE_PHPNAME       => array('VideoId', 'UsoVideo', 'NumeroPartecipantiEntrata', 'NumeroPartecipantiUscita', 'Risoluzione', 'DinamicitaImmagine', 'Fps', 'SessioniContemporanee', 'ExtRid', 'UpBandwidth', 'DownBandwidth', ),
        self::TYPE_CAMELNAME     => array('videoId', 'usoVideo', 'numeroPartecipantiEntrata', 'numeroPartecipantiUscita', 'risoluzione', 'dinamicitaImmagine', 'fps', 'sessioniContemporanee', 'extRid', 'upBandwidth', 'downBandwidth', ),
        self::TYPE_COLNAME       => array(VideoTableMap::COL_VIDEO_ID, VideoTableMap::COL_USO_VIDEO, VideoTableMap::COL_NUMERO_PARTECIPANTI_ENTRATA, VideoTableMap::COL_NUMERO_PARTECIPANTI_USCITA, VideoTableMap::COL_RISOLUZIONE, VideoTableMap::COL_DINAMICITA_IMMAGINE, VideoTableMap::COL_FPS, VideoTableMap::COL_SESSIONI_CONTEMPORANEE, VideoTableMap::COL_EXT_RID, VideoTableMap::COL_UP_BANDWIDTH, VideoTableMap::COL_DOWN_BANDWIDTH, ),
        self::TYPE_FIELDNAME     => array('video_id', 'uso_video', 'numero_partecipanti_entrata', 'numero_partecipanti_uscita', 'risoluzione', 'dinamicita_immagine', 'fps', 'sessioni_contemporanee', 'ext_rid', 'up_bandwidth', 'down_bandwidth', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('VideoId' => 0, 'UsoVideo' => 1, 'NumeroPartecipantiEntrata' => 2, 'NumeroPartecipantiUscita' => 3, 'Risoluzione' => 4, 'DinamicitaImmagine' => 5, 'Fps' => 6, 'SessioniContemporanee' => 7, 'ExtRid' => 8, 'UpBandwidth' => 9, 'DownBandwidth' => 10, ),
        self::TYPE_CAMELNAME     => array('videoId' => 0, 'usoVideo' => 1, 'numeroPartecipantiEntrata' => 2, 'numeroPartecipantiUscita' => 3, 'risoluzione' => 4, 'dinamicitaImmagine' => 5, 'fps' => 6, 'sessioniContemporanee' => 7, 'extRid' => 8, 'upBandwidth' => 9, 'downBandwidth' => 10, ),
        self::TYPE_COLNAME       => array(VideoTableMap::COL_VIDEO_ID => 0, VideoTableMap::COL_USO_VIDEO => 1, VideoTableMap::COL_NUMERO_PARTECIPANTI_ENTRATA => 2, VideoTableMap::COL_NUMERO_PARTECIPANTI_USCITA => 3, VideoTableMap::COL_RISOLUZIONE => 4, VideoTableMap::COL_DINAMICITA_IMMAGINE => 5, VideoTableMap::COL_FPS => 6, VideoTableMap::COL_SESSIONI_CONTEMPORANEE => 7, VideoTableMap::COL_EXT_RID => 8, VideoTableMap::COL_UP_BANDWIDTH => 9, VideoTableMap::COL_DOWN_BANDWIDTH => 10, ),
        self::TYPE_FIELDNAME     => array('video_id' => 0, 'uso_video' => 1, 'numero_partecipanti_entrata' => 2, 'numero_partecipanti_uscita' => 3, 'risoluzione' => 4, 'dinamicita_immagine' => 5, 'fps' => 6, 'sessioni_contemporanee' => 7, 'ext_rid' => 8, 'up_bandwidth' => 9, 'down_bandwidth' => 10, ),
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
        $this->setName('video');
        $this->setPhpName('Video');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Video');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('video_id', 'VideoId', 'INTEGER', true, null, null);
        $this->addColumn('uso_video', 'UsoVideo', 'BOOLEAN', false, 1, null);
        $this->addColumn('numero_partecipanti_entrata', 'NumeroPartecipantiEntrata', 'INTEGER', false, null, null);
        $this->addColumn('numero_partecipanti_uscita', 'NumeroPartecipantiUscita', 'INTEGER', false, null, null);
        $this->addColumn('risoluzione', 'Risoluzione', 'VARCHAR', false, 11, null);
        $this->addColumn('dinamicita_immagine', 'DinamicitaImmagine', 'INTEGER', false, null, null);
        $this->addColumn('fps', 'Fps', 'INTEGER', false, null, null);
        $this->addColumn('sessioni_contemporanee', 'SessioniContemporanee', 'INTEGER', false, null, null);
        $this->addForeignKey('ext_rid', 'ExtRid', 'INTEGER', 'requests', 'rid', false, null, null);
        $this->addColumn('up_bandwidth', 'UpBandwidth', 'INTEGER', false, null, null);
        $this->addColumn('down_bandwidth', 'DownBandwidth', 'INTEGER', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('VideoId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('VideoId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('VideoId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('VideoId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('VideoId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('VideoId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('VideoId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? VideoTableMap::CLASS_DEFAULT : VideoTableMap::OM_CLASS;
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
     * @return array           (Video object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = VideoTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = VideoTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + VideoTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = VideoTableMap::OM_CLASS;
            /** @var Video $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            VideoTableMap::addInstanceToPool($obj, $key);
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
            $key = VideoTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = VideoTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Video $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                VideoTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(VideoTableMap::COL_VIDEO_ID);
            $criteria->addSelectColumn(VideoTableMap::COL_USO_VIDEO);
            $criteria->addSelectColumn(VideoTableMap::COL_NUMERO_PARTECIPANTI_ENTRATA);
            $criteria->addSelectColumn(VideoTableMap::COL_NUMERO_PARTECIPANTI_USCITA);
            $criteria->addSelectColumn(VideoTableMap::COL_RISOLUZIONE);
            $criteria->addSelectColumn(VideoTableMap::COL_DINAMICITA_IMMAGINE);
            $criteria->addSelectColumn(VideoTableMap::COL_FPS);
            $criteria->addSelectColumn(VideoTableMap::COL_SESSIONI_CONTEMPORANEE);
            $criteria->addSelectColumn(VideoTableMap::COL_EXT_RID);
            $criteria->addSelectColumn(VideoTableMap::COL_UP_BANDWIDTH);
            $criteria->addSelectColumn(VideoTableMap::COL_DOWN_BANDWIDTH);
        } else {
            $criteria->addSelectColumn($alias . '.video_id');
            $criteria->addSelectColumn($alias . '.uso_video');
            $criteria->addSelectColumn($alias . '.numero_partecipanti_entrata');
            $criteria->addSelectColumn($alias . '.numero_partecipanti_uscita');
            $criteria->addSelectColumn($alias . '.risoluzione');
            $criteria->addSelectColumn($alias . '.dinamicita_immagine');
            $criteria->addSelectColumn($alias . '.fps');
            $criteria->addSelectColumn($alias . '.sessioni_contemporanee');
            $criteria->addSelectColumn($alias . '.ext_rid');
            $criteria->addSelectColumn($alias . '.up_bandwidth');
            $criteria->addSelectColumn($alias . '.down_bandwidth');
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
        return Propel::getServiceContainer()->getDatabaseMap(VideoTableMap::DATABASE_NAME)->getTable(VideoTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(VideoTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(VideoTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new VideoTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Video or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Video object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(VideoTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Video) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(VideoTableMap::DATABASE_NAME);
            $criteria->add(VideoTableMap::COL_VIDEO_ID, (array) $values, Criteria::IN);
        }

        $query = VideoQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            VideoTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                VideoTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the video table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return VideoQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Video or Criteria object.
     *
     * @param mixed               $criteria Criteria or Video object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VideoTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Video object
        }

        if ($criteria->containsKey(VideoTableMap::COL_VIDEO_ID) && $criteria->keyContainsValue(VideoTableMap::COL_VIDEO_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.VideoTableMap::COL_VIDEO_ID.')');
        }


        // Set the correct dbName
        $query = VideoQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // VideoTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
VideoTableMap::buildTableMap();
