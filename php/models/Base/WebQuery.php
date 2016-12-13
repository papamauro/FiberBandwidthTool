<?php

namespace Base;

use \Web as ChildWeb;
use \WebQuery as ChildWebQuery;
use \Exception;
use \PDO;
use Map\WebTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'web' table.
 *
 *
 *
 * @method     ChildWebQuery orderByWebId($order = Criteria::ASC) Order by the web_id column
 * @method     ChildWebQuery orderByInternalWebServer($order = Criteria::ASC) Order by the internal_web_server column
 * @method     ChildWebQuery orderByPageSize($order = Criteria::ASC) Order by the page_size column
 * @method     ChildWebQuery orderByPageLoadTime($order = Criteria::ASC) Order by the page_load_time column
 * @method     ChildWebQuery orderByConcorrentRequests($order = Criteria::ASC) Order by the concorrent_requests column
 * @method     ChildWebQuery orderByUpBandwidth($order = Criteria::ASC) Order by the up_bandwidth column
 * @method     ChildWebQuery orderByDownBandwidth($order = Criteria::ASC) Order by the down_bandwidth column
 * @method     ChildWebQuery orderByExtRid($order = Criteria::ASC) Order by the ext_rid column
 *
 * @method     ChildWebQuery groupByWebId() Group by the web_id column
 * @method     ChildWebQuery groupByInternalWebServer() Group by the internal_web_server column
 * @method     ChildWebQuery groupByPageSize() Group by the page_size column
 * @method     ChildWebQuery groupByPageLoadTime() Group by the page_load_time column
 * @method     ChildWebQuery groupByConcorrentRequests() Group by the concorrent_requests column
 * @method     ChildWebQuery groupByUpBandwidth() Group by the up_bandwidth column
 * @method     ChildWebQuery groupByDownBandwidth() Group by the down_bandwidth column
 * @method     ChildWebQuery groupByExtRid() Group by the ext_rid column
 *
 * @method     ChildWebQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWebQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWebQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWebQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWebQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWebQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWebQuery leftJoinRequests($relationAlias = null) Adds a LEFT JOIN clause to the query using the Requests relation
 * @method     ChildWebQuery rightJoinRequests($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Requests relation
 * @method     ChildWebQuery innerJoinRequests($relationAlias = null) Adds a INNER JOIN clause to the query using the Requests relation
 *
 * @method     ChildWebQuery joinWithRequests($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Requests relation
 *
 * @method     ChildWebQuery leftJoinWithRequests() Adds a LEFT JOIN clause and with to the query using the Requests relation
 * @method     ChildWebQuery rightJoinWithRequests() Adds a RIGHT JOIN clause and with to the query using the Requests relation
 * @method     ChildWebQuery innerJoinWithRequests() Adds a INNER JOIN clause and with to the query using the Requests relation
 *
 * @method     \RequestsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWeb findOne(ConnectionInterface $con = null) Return the first ChildWeb matching the query
 * @method     ChildWeb findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWeb matching the query, or a new ChildWeb object populated from the query conditions when no match is found
 *
 * @method     ChildWeb findOneByWebId(int $web_id) Return the first ChildWeb filtered by the web_id column
 * @method     ChildWeb findOneByInternalWebServer(boolean $internal_web_server) Return the first ChildWeb filtered by the internal_web_server column
 * @method     ChildWeb findOneByPageSize(int $page_size) Return the first ChildWeb filtered by the page_size column
 * @method     ChildWeb findOneByPageLoadTime(int $page_load_time) Return the first ChildWeb filtered by the page_load_time column
 * @method     ChildWeb findOneByConcorrentRequests(int $concorrent_requests) Return the first ChildWeb filtered by the concorrent_requests column
 * @method     ChildWeb findOneByUpBandwidth(int $up_bandwidth) Return the first ChildWeb filtered by the up_bandwidth column
 * @method     ChildWeb findOneByDownBandwidth(int $down_bandwidth) Return the first ChildWeb filtered by the down_bandwidth column
 * @method     ChildWeb findOneByExtRid(int $ext_rid) Return the first ChildWeb filtered by the ext_rid column *

 * @method     ChildWeb requirePk($key, ConnectionInterface $con = null) Return the ChildWeb by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWeb requireOne(ConnectionInterface $con = null) Return the first ChildWeb matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWeb requireOneByWebId(int $web_id) Return the first ChildWeb filtered by the web_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWeb requireOneByInternalWebServer(boolean $internal_web_server) Return the first ChildWeb filtered by the internal_web_server column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWeb requireOneByPageSize(int $page_size) Return the first ChildWeb filtered by the page_size column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWeb requireOneByPageLoadTime(int $page_load_time) Return the first ChildWeb filtered by the page_load_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWeb requireOneByConcorrentRequests(int $concorrent_requests) Return the first ChildWeb filtered by the concorrent_requests column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWeb requireOneByUpBandwidth(int $up_bandwidth) Return the first ChildWeb filtered by the up_bandwidth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWeb requireOneByDownBandwidth(int $down_bandwidth) Return the first ChildWeb filtered by the down_bandwidth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWeb requireOneByExtRid(int $ext_rid) Return the first ChildWeb filtered by the ext_rid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWeb[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWeb objects based on current ModelCriteria
 * @method     ChildWeb[]|ObjectCollection findByWebId(int $web_id) Return ChildWeb objects filtered by the web_id column
 * @method     ChildWeb[]|ObjectCollection findByInternalWebServer(boolean $internal_web_server) Return ChildWeb objects filtered by the internal_web_server column
 * @method     ChildWeb[]|ObjectCollection findByPageSize(int $page_size) Return ChildWeb objects filtered by the page_size column
 * @method     ChildWeb[]|ObjectCollection findByPageLoadTime(int $page_load_time) Return ChildWeb objects filtered by the page_load_time column
 * @method     ChildWeb[]|ObjectCollection findByConcorrentRequests(int $concorrent_requests) Return ChildWeb objects filtered by the concorrent_requests column
 * @method     ChildWeb[]|ObjectCollection findByUpBandwidth(int $up_bandwidth) Return ChildWeb objects filtered by the up_bandwidth column
 * @method     ChildWeb[]|ObjectCollection findByDownBandwidth(int $down_bandwidth) Return ChildWeb objects filtered by the down_bandwidth column
 * @method     ChildWeb[]|ObjectCollection findByExtRid(int $ext_rid) Return ChildWeb objects filtered by the ext_rid column
 * @method     ChildWeb[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WebQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\WebQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Web', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWebQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWebQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWebQuery) {
            return $criteria;
        }
        $query = new ChildWebQuery();
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
     * @return ChildWeb|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WebTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WebTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildWeb A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT web_id, internal_web_server, page_size, page_load_time, concorrent_requests, up_bandwidth, down_bandwidth, ext_rid FROM web WHERE web_id = :p0';
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
            /** @var ChildWeb $obj */
            $obj = new ChildWeb();
            $obj->hydrate($row);
            WebTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWeb|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildWebQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WebTableMap::COL_WEB_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWebQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WebTableMap::COL_WEB_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the web_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWebId(1234); // WHERE web_id = 1234
     * $query->filterByWebId(array(12, 34)); // WHERE web_id IN (12, 34)
     * $query->filterByWebId(array('min' => 12)); // WHERE web_id > 12
     * </code>
     *
     * @param     mixed $webId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebQuery The current query, for fluid interface
     */
    public function filterByWebId($webId = null, $comparison = null)
    {
        if (is_array($webId)) {
            $useMinMax = false;
            if (isset($webId['min'])) {
                $this->addUsingAlias(WebTableMap::COL_WEB_ID, $webId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($webId['max'])) {
                $this->addUsingAlias(WebTableMap::COL_WEB_ID, $webId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebTableMap::COL_WEB_ID, $webId, $comparison);
    }

    /**
     * Filter the query on the internal_web_server column
     *
     * Example usage:
     * <code>
     * $query->filterByInternalWebServer(true); // WHERE internal_web_server = true
     * $query->filterByInternalWebServer('yes'); // WHERE internal_web_server = true
     * </code>
     *
     * @param     boolean|string $internalWebServer The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebQuery The current query, for fluid interface
     */
    public function filterByInternalWebServer($internalWebServer = null, $comparison = null)
    {
        if (is_string($internalWebServer)) {
            $internalWebServer = in_array(strtolower($internalWebServer), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(WebTableMap::COL_INTERNAL_WEB_SERVER, $internalWebServer, $comparison);
    }

    /**
     * Filter the query on the page_size column
     *
     * Example usage:
     * <code>
     * $query->filterByPageSize(1234); // WHERE page_size = 1234
     * $query->filterByPageSize(array(12, 34)); // WHERE page_size IN (12, 34)
     * $query->filterByPageSize(array('min' => 12)); // WHERE page_size > 12
     * </code>
     *
     * @param     mixed $pageSize The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebQuery The current query, for fluid interface
     */
    public function filterByPageSize($pageSize = null, $comparison = null)
    {
        if (is_array($pageSize)) {
            $useMinMax = false;
            if (isset($pageSize['min'])) {
                $this->addUsingAlias(WebTableMap::COL_PAGE_SIZE, $pageSize['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pageSize['max'])) {
                $this->addUsingAlias(WebTableMap::COL_PAGE_SIZE, $pageSize['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebTableMap::COL_PAGE_SIZE, $pageSize, $comparison);
    }

    /**
     * Filter the query on the page_load_time column
     *
     * Example usage:
     * <code>
     * $query->filterByPageLoadTime(1234); // WHERE page_load_time = 1234
     * $query->filterByPageLoadTime(array(12, 34)); // WHERE page_load_time IN (12, 34)
     * $query->filterByPageLoadTime(array('min' => 12)); // WHERE page_load_time > 12
     * </code>
     *
     * @param     mixed $pageLoadTime The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebQuery The current query, for fluid interface
     */
    public function filterByPageLoadTime($pageLoadTime = null, $comparison = null)
    {
        if (is_array($pageLoadTime)) {
            $useMinMax = false;
            if (isset($pageLoadTime['min'])) {
                $this->addUsingAlias(WebTableMap::COL_PAGE_LOAD_TIME, $pageLoadTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pageLoadTime['max'])) {
                $this->addUsingAlias(WebTableMap::COL_PAGE_LOAD_TIME, $pageLoadTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebTableMap::COL_PAGE_LOAD_TIME, $pageLoadTime, $comparison);
    }

    /**
     * Filter the query on the concorrent_requests column
     *
     * Example usage:
     * <code>
     * $query->filterByConcorrentRequests(1234); // WHERE concorrent_requests = 1234
     * $query->filterByConcorrentRequests(array(12, 34)); // WHERE concorrent_requests IN (12, 34)
     * $query->filterByConcorrentRequests(array('min' => 12)); // WHERE concorrent_requests > 12
     * </code>
     *
     * @param     mixed $concorrentRequests The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebQuery The current query, for fluid interface
     */
    public function filterByConcorrentRequests($concorrentRequests = null, $comparison = null)
    {
        if (is_array($concorrentRequests)) {
            $useMinMax = false;
            if (isset($concorrentRequests['min'])) {
                $this->addUsingAlias(WebTableMap::COL_CONCORRENT_REQUESTS, $concorrentRequests['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($concorrentRequests['max'])) {
                $this->addUsingAlias(WebTableMap::COL_CONCORRENT_REQUESTS, $concorrentRequests['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebTableMap::COL_CONCORRENT_REQUESTS, $concorrentRequests, $comparison);
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
     * @return $this|ChildWebQuery The current query, for fluid interface
     */
    public function filterByUpBandwidth($upBandwidth = null, $comparison = null)
    {
        if (is_array($upBandwidth)) {
            $useMinMax = false;
            if (isset($upBandwidth['min'])) {
                $this->addUsingAlias(WebTableMap::COL_UP_BANDWIDTH, $upBandwidth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upBandwidth['max'])) {
                $this->addUsingAlias(WebTableMap::COL_UP_BANDWIDTH, $upBandwidth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebTableMap::COL_UP_BANDWIDTH, $upBandwidth, $comparison);
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
     * @return $this|ChildWebQuery The current query, for fluid interface
     */
    public function filterByDownBandwidth($downBandwidth = null, $comparison = null)
    {
        if (is_array($downBandwidth)) {
            $useMinMax = false;
            if (isset($downBandwidth['min'])) {
                $this->addUsingAlias(WebTableMap::COL_DOWN_BANDWIDTH, $downBandwidth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($downBandwidth['max'])) {
                $this->addUsingAlias(WebTableMap::COL_DOWN_BANDWIDTH, $downBandwidth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebTableMap::COL_DOWN_BANDWIDTH, $downBandwidth, $comparison);
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
     * @return $this|ChildWebQuery The current query, for fluid interface
     */
    public function filterByExtRid($extRid = null, $comparison = null)
    {
        if (is_array($extRid)) {
            $useMinMax = false;
            if (isset($extRid['min'])) {
                $this->addUsingAlias(WebTableMap::COL_EXT_RID, $extRid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($extRid['max'])) {
                $this->addUsingAlias(WebTableMap::COL_EXT_RID, $extRid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebTableMap::COL_EXT_RID, $extRid, $comparison);
    }

    /**
     * Filter the query by a related \Requests object
     *
     * @param \Requests|ObjectCollection $requests The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildWebQuery The current query, for fluid interface
     */
    public function filterByRequests($requests, $comparison = null)
    {
        if ($requests instanceof \Requests) {
            return $this
                ->addUsingAlias(WebTableMap::COL_EXT_RID, $requests->getRid(), $comparison);
        } elseif ($requests instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(WebTableMap::COL_EXT_RID, $requests->toKeyValue('PrimaryKey', 'Rid'), $comparison);
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
     * @return $this|ChildWebQuery The current query, for fluid interface
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
     * @param   ChildWeb $web Object to remove from the list of results
     *
     * @return $this|ChildWebQuery The current query, for fluid interface
     */
    public function prune($web = null)
    {
        if ($web) {
            $this->addUsingAlias(WebTableMap::COL_WEB_ID, $web->getWebId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the web table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WebTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WebTableMap::clearInstancePool();
            WebTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WebTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WebTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WebTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WebTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // WebQuery
