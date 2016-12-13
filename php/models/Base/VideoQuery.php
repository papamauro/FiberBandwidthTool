<?php

namespace Base;

use \Video as ChildVideo;
use \VideoQuery as ChildVideoQuery;
use \Exception;
use \PDO;
use Map\VideoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'video' table.
 *
 *
 *
 * @method     ChildVideoQuery orderByVideoId($order = Criteria::ASC) Order by the video_id column
 * @method     ChildVideoQuery orderByUsoVideo($order = Criteria::ASC) Order by the uso_video column
 * @method     ChildVideoQuery orderByNumeroPartecipantiEntrata($order = Criteria::ASC) Order by the numero_partecipanti_entrata column
 * @method     ChildVideoQuery orderByNumeroPartecipantiUscita($order = Criteria::ASC) Order by the numero_partecipanti_uscita column
 * @method     ChildVideoQuery orderByRisoluzione($order = Criteria::ASC) Order by the risoluzione column
 * @method     ChildVideoQuery orderByDinamicitaImmagine($order = Criteria::ASC) Order by the dinamicita_immagine column
 * @method     ChildVideoQuery orderByFps($order = Criteria::ASC) Order by the fps column
 * @method     ChildVideoQuery orderBySessioniContemporanee($order = Criteria::ASC) Order by the sessioni_contemporanee column
 * @method     ChildVideoQuery orderByExtRid($order = Criteria::ASC) Order by the ext_rid column
 * @method     ChildVideoQuery orderByUpBandwidth($order = Criteria::ASC) Order by the up_bandwidth column
 * @method     ChildVideoQuery orderByDownBandwidth($order = Criteria::ASC) Order by the down_bandwidth column
 *
 * @method     ChildVideoQuery groupByVideoId() Group by the video_id column
 * @method     ChildVideoQuery groupByUsoVideo() Group by the uso_video column
 * @method     ChildVideoQuery groupByNumeroPartecipantiEntrata() Group by the numero_partecipanti_entrata column
 * @method     ChildVideoQuery groupByNumeroPartecipantiUscita() Group by the numero_partecipanti_uscita column
 * @method     ChildVideoQuery groupByRisoluzione() Group by the risoluzione column
 * @method     ChildVideoQuery groupByDinamicitaImmagine() Group by the dinamicita_immagine column
 * @method     ChildVideoQuery groupByFps() Group by the fps column
 * @method     ChildVideoQuery groupBySessioniContemporanee() Group by the sessioni_contemporanee column
 * @method     ChildVideoQuery groupByExtRid() Group by the ext_rid column
 * @method     ChildVideoQuery groupByUpBandwidth() Group by the up_bandwidth column
 * @method     ChildVideoQuery groupByDownBandwidth() Group by the down_bandwidth column
 *
 * @method     ChildVideoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVideoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVideoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVideoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVideoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVideoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVideoQuery leftJoinRequests($relationAlias = null) Adds a LEFT JOIN clause to the query using the Requests relation
 * @method     ChildVideoQuery rightJoinRequests($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Requests relation
 * @method     ChildVideoQuery innerJoinRequests($relationAlias = null) Adds a INNER JOIN clause to the query using the Requests relation
 *
 * @method     ChildVideoQuery joinWithRequests($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Requests relation
 *
 * @method     ChildVideoQuery leftJoinWithRequests() Adds a LEFT JOIN clause and with to the query using the Requests relation
 * @method     ChildVideoQuery rightJoinWithRequests() Adds a RIGHT JOIN clause and with to the query using the Requests relation
 * @method     ChildVideoQuery innerJoinWithRequests() Adds a INNER JOIN clause and with to the query using the Requests relation
 *
 * @method     \RequestsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVideo findOne(ConnectionInterface $con = null) Return the first ChildVideo matching the query
 * @method     ChildVideo findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVideo matching the query, or a new ChildVideo object populated from the query conditions when no match is found
 *
 * @method     ChildVideo findOneByVideoId(int $video_id) Return the first ChildVideo filtered by the video_id column
 * @method     ChildVideo findOneByUsoVideo(boolean $uso_video) Return the first ChildVideo filtered by the uso_video column
 * @method     ChildVideo findOneByNumeroPartecipantiEntrata(int $numero_partecipanti_entrata) Return the first ChildVideo filtered by the numero_partecipanti_entrata column
 * @method     ChildVideo findOneByNumeroPartecipantiUscita(int $numero_partecipanti_uscita) Return the first ChildVideo filtered by the numero_partecipanti_uscita column
 * @method     ChildVideo findOneByRisoluzione(string $risoluzione) Return the first ChildVideo filtered by the risoluzione column
 * @method     ChildVideo findOneByDinamicitaImmagine(int $dinamicita_immagine) Return the first ChildVideo filtered by the dinamicita_immagine column
 * @method     ChildVideo findOneByFps(int $fps) Return the first ChildVideo filtered by the fps column
 * @method     ChildVideo findOneBySessioniContemporanee(int $sessioni_contemporanee) Return the first ChildVideo filtered by the sessioni_contemporanee column
 * @method     ChildVideo findOneByExtRid(int $ext_rid) Return the first ChildVideo filtered by the ext_rid column
 * @method     ChildVideo findOneByUpBandwidth(int $up_bandwidth) Return the first ChildVideo filtered by the up_bandwidth column
 * @method     ChildVideo findOneByDownBandwidth(int $down_bandwidth) Return the first ChildVideo filtered by the down_bandwidth column *

 * @method     ChildVideo requirePk($key, ConnectionInterface $con = null) Return the ChildVideo by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideo requireOne(ConnectionInterface $con = null) Return the first ChildVideo matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVideo requireOneByVideoId(int $video_id) Return the first ChildVideo filtered by the video_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideo requireOneByUsoVideo(boolean $uso_video) Return the first ChildVideo filtered by the uso_video column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideo requireOneByNumeroPartecipantiEntrata(int $numero_partecipanti_entrata) Return the first ChildVideo filtered by the numero_partecipanti_entrata column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideo requireOneByNumeroPartecipantiUscita(int $numero_partecipanti_uscita) Return the first ChildVideo filtered by the numero_partecipanti_uscita column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideo requireOneByRisoluzione(string $risoluzione) Return the first ChildVideo filtered by the risoluzione column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideo requireOneByDinamicitaImmagine(int $dinamicita_immagine) Return the first ChildVideo filtered by the dinamicita_immagine column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideo requireOneByFps(int $fps) Return the first ChildVideo filtered by the fps column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideo requireOneBySessioniContemporanee(int $sessioni_contemporanee) Return the first ChildVideo filtered by the sessioni_contemporanee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideo requireOneByExtRid(int $ext_rid) Return the first ChildVideo filtered by the ext_rid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideo requireOneByUpBandwidth(int $up_bandwidth) Return the first ChildVideo filtered by the up_bandwidth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideo requireOneByDownBandwidth(int $down_bandwidth) Return the first ChildVideo filtered by the down_bandwidth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVideo[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVideo objects based on current ModelCriteria
 * @method     ChildVideo[]|ObjectCollection findByVideoId(int $video_id) Return ChildVideo objects filtered by the video_id column
 * @method     ChildVideo[]|ObjectCollection findByUsoVideo(boolean $uso_video) Return ChildVideo objects filtered by the uso_video column
 * @method     ChildVideo[]|ObjectCollection findByNumeroPartecipantiEntrata(int $numero_partecipanti_entrata) Return ChildVideo objects filtered by the numero_partecipanti_entrata column
 * @method     ChildVideo[]|ObjectCollection findByNumeroPartecipantiUscita(int $numero_partecipanti_uscita) Return ChildVideo objects filtered by the numero_partecipanti_uscita column
 * @method     ChildVideo[]|ObjectCollection findByRisoluzione(string $risoluzione) Return ChildVideo objects filtered by the risoluzione column
 * @method     ChildVideo[]|ObjectCollection findByDinamicitaImmagine(int $dinamicita_immagine) Return ChildVideo objects filtered by the dinamicita_immagine column
 * @method     ChildVideo[]|ObjectCollection findByFps(int $fps) Return ChildVideo objects filtered by the fps column
 * @method     ChildVideo[]|ObjectCollection findBySessioniContemporanee(int $sessioni_contemporanee) Return ChildVideo objects filtered by the sessioni_contemporanee column
 * @method     ChildVideo[]|ObjectCollection findByExtRid(int $ext_rid) Return ChildVideo objects filtered by the ext_rid column
 * @method     ChildVideo[]|ObjectCollection findByUpBandwidth(int $up_bandwidth) Return ChildVideo objects filtered by the up_bandwidth column
 * @method     ChildVideo[]|ObjectCollection findByDownBandwidth(int $down_bandwidth) Return ChildVideo objects filtered by the down_bandwidth column
 * @method     ChildVideo[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VideoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\VideoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Video', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVideoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVideoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVideoQuery) {
            return $criteria;
        }
        $query = new ChildVideoQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildVideo|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VideoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VideoTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVideo A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT video_id, uso_video, numero_partecipanti_entrata, numero_partecipanti_uscita, risoluzione, dinamicita_immagine, fps, sessioni_contemporanee, ext_rid, up_bandwidth, down_bandwidth FROM video WHERE video_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildVideo $obj */
            $obj = new ChildVideo();
            $obj->hydrate($row);
            VideoTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildVideo|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VideoTableMap::COL_VIDEO_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VideoTableMap::COL_VIDEO_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the video_id column
     *
     * Example usage:
     * <code>
     * $query->filterByVideoId(1234); // WHERE video_id = 1234
     * $query->filterByVideoId(array(12, 34)); // WHERE video_id IN (12, 34)
     * $query->filterByVideoId(array('min' => 12)); // WHERE video_id > 12
     * </code>
     *
     * @param     mixed $videoId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByVideoId($videoId = null, $comparison = null)
    {
        if (is_array($videoId)) {
            $useMinMax = false;
            if (isset($videoId['min'])) {
                $this->addUsingAlias(VideoTableMap::COL_VIDEO_ID, $videoId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($videoId['max'])) {
                $this->addUsingAlias(VideoTableMap::COL_VIDEO_ID, $videoId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_VIDEO_ID, $videoId, $comparison);
    }

    /**
     * Filter the query on the uso_video column
     *
     * Example usage:
     * <code>
     * $query->filterByUsoVideo(true); // WHERE uso_video = true
     * $query->filterByUsoVideo('yes'); // WHERE uso_video = true
     * </code>
     *
     * @param     boolean|string $usoVideo The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByUsoVideo($usoVideo = null, $comparison = null)
    {
        if (is_string($usoVideo)) {
            $usoVideo = in_array(strtolower($usoVideo), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(VideoTableMap::COL_USO_VIDEO, $usoVideo, $comparison);
    }

    /**
     * Filter the query on the numero_partecipanti_entrata column
     *
     * Example usage:
     * <code>
     * $query->filterByNumeroPartecipantiEntrata(1234); // WHERE numero_partecipanti_entrata = 1234
     * $query->filterByNumeroPartecipantiEntrata(array(12, 34)); // WHERE numero_partecipanti_entrata IN (12, 34)
     * $query->filterByNumeroPartecipantiEntrata(array('min' => 12)); // WHERE numero_partecipanti_entrata > 12
     * </code>
     *
     * @param     mixed $numeroPartecipantiEntrata The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByNumeroPartecipantiEntrata($numeroPartecipantiEntrata = null, $comparison = null)
    {
        if (is_array($numeroPartecipantiEntrata)) {
            $useMinMax = false;
            if (isset($numeroPartecipantiEntrata['min'])) {
                $this->addUsingAlias(VideoTableMap::COL_NUMERO_PARTECIPANTI_ENTRATA, $numeroPartecipantiEntrata['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($numeroPartecipantiEntrata['max'])) {
                $this->addUsingAlias(VideoTableMap::COL_NUMERO_PARTECIPANTI_ENTRATA, $numeroPartecipantiEntrata['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_NUMERO_PARTECIPANTI_ENTRATA, $numeroPartecipantiEntrata, $comparison);
    }

    /**
     * Filter the query on the numero_partecipanti_uscita column
     *
     * Example usage:
     * <code>
     * $query->filterByNumeroPartecipantiUscita(1234); // WHERE numero_partecipanti_uscita = 1234
     * $query->filterByNumeroPartecipantiUscita(array(12, 34)); // WHERE numero_partecipanti_uscita IN (12, 34)
     * $query->filterByNumeroPartecipantiUscita(array('min' => 12)); // WHERE numero_partecipanti_uscita > 12
     * </code>
     *
     * @param     mixed $numeroPartecipantiUscita The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByNumeroPartecipantiUscita($numeroPartecipantiUscita = null, $comparison = null)
    {
        if (is_array($numeroPartecipantiUscita)) {
            $useMinMax = false;
            if (isset($numeroPartecipantiUscita['min'])) {
                $this->addUsingAlias(VideoTableMap::COL_NUMERO_PARTECIPANTI_USCITA, $numeroPartecipantiUscita['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($numeroPartecipantiUscita['max'])) {
                $this->addUsingAlias(VideoTableMap::COL_NUMERO_PARTECIPANTI_USCITA, $numeroPartecipantiUscita['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_NUMERO_PARTECIPANTI_USCITA, $numeroPartecipantiUscita, $comparison);
    }

    /**
     * Filter the query on the risoluzione column
     *
     * Example usage:
     * <code>
     * $query->filterByRisoluzione('fooValue');   // WHERE risoluzione = 'fooValue'
     * $query->filterByRisoluzione('%fooValue%', Criteria::LIKE); // WHERE risoluzione LIKE '%fooValue%'
     * </code>
     *
     * @param     string $risoluzione The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByRisoluzione($risoluzione = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($risoluzione)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_RISOLUZIONE, $risoluzione, $comparison);
    }

    /**
     * Filter the query on the dinamicita_immagine column
     *
     * Example usage:
     * <code>
     * $query->filterByDinamicitaImmagine(1234); // WHERE dinamicita_immagine = 1234
     * $query->filterByDinamicitaImmagine(array(12, 34)); // WHERE dinamicita_immagine IN (12, 34)
     * $query->filterByDinamicitaImmagine(array('min' => 12)); // WHERE dinamicita_immagine > 12
     * </code>
     *
     * @param     mixed $dinamicitaImmagine The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByDinamicitaImmagine($dinamicitaImmagine = null, $comparison = null)
    {
        if (is_array($dinamicitaImmagine)) {
            $useMinMax = false;
            if (isset($dinamicitaImmagine['min'])) {
                $this->addUsingAlias(VideoTableMap::COL_DINAMICITA_IMMAGINE, $dinamicitaImmagine['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dinamicitaImmagine['max'])) {
                $this->addUsingAlias(VideoTableMap::COL_DINAMICITA_IMMAGINE, $dinamicitaImmagine['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_DINAMICITA_IMMAGINE, $dinamicitaImmagine, $comparison);
    }

    /**
     * Filter the query on the fps column
     *
     * Example usage:
     * <code>
     * $query->filterByFps(1234); // WHERE fps = 1234
     * $query->filterByFps(array(12, 34)); // WHERE fps IN (12, 34)
     * $query->filterByFps(array('min' => 12)); // WHERE fps > 12
     * </code>
     *
     * @param     mixed $fps The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByFps($fps = null, $comparison = null)
    {
        if (is_array($fps)) {
            $useMinMax = false;
            if (isset($fps['min'])) {
                $this->addUsingAlias(VideoTableMap::COL_FPS, $fps['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fps['max'])) {
                $this->addUsingAlias(VideoTableMap::COL_FPS, $fps['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_FPS, $fps, $comparison);
    }

    /**
     * Filter the query on the sessioni_contemporanee column
     *
     * Example usage:
     * <code>
     * $query->filterBySessioniContemporanee(1234); // WHERE sessioni_contemporanee = 1234
     * $query->filterBySessioniContemporanee(array(12, 34)); // WHERE sessioni_contemporanee IN (12, 34)
     * $query->filterBySessioniContemporanee(array('min' => 12)); // WHERE sessioni_contemporanee > 12
     * </code>
     *
     * @param     mixed $sessioniContemporanee The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterBySessioniContemporanee($sessioniContemporanee = null, $comparison = null)
    {
        if (is_array($sessioniContemporanee)) {
            $useMinMax = false;
            if (isset($sessioniContemporanee['min'])) {
                $this->addUsingAlias(VideoTableMap::COL_SESSIONI_CONTEMPORANEE, $sessioniContemporanee['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sessioniContemporanee['max'])) {
                $this->addUsingAlias(VideoTableMap::COL_SESSIONI_CONTEMPORANEE, $sessioniContemporanee['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_SESSIONI_CONTEMPORANEE, $sessioniContemporanee, $comparison);
    }

    /**
     * Filter the query on the ext_rid column
     *
     * Example usage:
     * <code>
     * $query->filterByExtRid(1234); // WHERE ext_rid = 1234
     * $query->filterByExtRid(array(12, 34)); // WHERE ext_rid IN (12, 34)
     * $query->filterByExtRid(array('min' => 12)); // WHERE ext_rid > 12
     * </code>
     *
     * @see       filterByRequests()
     *
     * @param     mixed $extRid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByExtRid($extRid = null, $comparison = null)
    {
        if (is_array($extRid)) {
            $useMinMax = false;
            if (isset($extRid['min'])) {
                $this->addUsingAlias(VideoTableMap::COL_EXT_RID, $extRid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($extRid['max'])) {
                $this->addUsingAlias(VideoTableMap::COL_EXT_RID, $extRid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_EXT_RID, $extRid, $comparison);
    }

    /**
     * Filter the query on the up_bandwidth column
     *
     * Example usage:
     * <code>
     * $query->filterByUpBandwidth(1234); // WHERE up_bandwidth = 1234
     * $query->filterByUpBandwidth(array(12, 34)); // WHERE up_bandwidth IN (12, 34)
     * $query->filterByUpBandwidth(array('min' => 12)); // WHERE up_bandwidth > 12
     * </code>
     *
     * @param     mixed $upBandwidth The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByUpBandwidth($upBandwidth = null, $comparison = null)
    {
        if (is_array($upBandwidth)) {
            $useMinMax = false;
            if (isset($upBandwidth['min'])) {
                $this->addUsingAlias(VideoTableMap::COL_UP_BANDWIDTH, $upBandwidth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upBandwidth['max'])) {
                $this->addUsingAlias(VideoTableMap::COL_UP_BANDWIDTH, $upBandwidth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_UP_BANDWIDTH, $upBandwidth, $comparison);
    }

    /**
     * Filter the query on the down_bandwidth column
     *
     * Example usage:
     * <code>
     * $query->filterByDownBandwidth(1234); // WHERE down_bandwidth = 1234
     * $query->filterByDownBandwidth(array(12, 34)); // WHERE down_bandwidth IN (12, 34)
     * $query->filterByDownBandwidth(array('min' => 12)); // WHERE down_bandwidth > 12
     * </code>
     *
     * @param     mixed $downBandwidth The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByDownBandwidth($downBandwidth = null, $comparison = null)
    {
        if (is_array($downBandwidth)) {
            $useMinMax = false;
            if (isset($downBandwidth['min'])) {
                $this->addUsingAlias(VideoTableMap::COL_DOWN_BANDWIDTH, $downBandwidth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($downBandwidth['max'])) {
                $this->addUsingAlias(VideoTableMap::COL_DOWN_BANDWIDTH, $downBandwidth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_DOWN_BANDWIDTH, $downBandwidth, $comparison);
    }

    /**
     * Filter the query by a related \Requests object
     *
     * @param \Requests|ObjectCollection $requests The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVideoQuery The current query, for fluid interface
     */
    public function filterByRequests($requests, $comparison = null)
    {
        if ($requests instanceof \Requests) {
            return $this
                ->addUsingAlias(VideoTableMap::COL_EXT_RID, $requests->getRid(), $comparison);
        } elseif ($requests instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VideoTableMap::COL_EXT_RID, $requests->toKeyValue('PrimaryKey', 'Rid'), $comparison);
        } else {
            throw new PropelException('filterByRequests() only accepts arguments of type \Requests or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Requests relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function joinRequests($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Requests');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Requests');
        }

        return $this;
    }

    /**
     * Use the Requests relation Requests object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RequestsQuery A secondary query class using the current class as primary query
     */
    public function useRequestsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRequests($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Requests', '\RequestsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildVideo $video Object to remove from the list of results
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function prune($video = null)
    {
        if ($video) {
            $this->addUsingAlias(VideoTableMap::COL_VIDEO_ID, $video->getVideoId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the video table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VideoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VideoTableMap::clearInstancePool();
            VideoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VideoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VideoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VideoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VideoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // VideoQuery
