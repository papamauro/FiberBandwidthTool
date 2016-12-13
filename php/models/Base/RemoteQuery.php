<?php

namespace Base;

use \Remote as ChildRemote;
use \RemoteQuery as ChildRemoteQuery;
use \Exception;
use \PDO;
use Map\RemoteTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'remote' table.
 *
 *
 *
 * @method     ChildRemoteQuery orderByRemoteId($order = Criteria::ASC) Order by the remote_id column
 * @method     ChildRemoteQuery orderByRemoteUsed($order = Criteria::ASC) Order by the remote_used column
 * @method     ChildRemoteQuery orderByConcurrentAccess($order = Criteria::ASC) Order by the concurrent_access column
 * @method     ChildRemoteQuery orderByRemoteService($order = Criteria::ASC) Order by the remote_service column
 * @method     ChildRemoteQuery orderByCitrixBr($order = Criteria::ASC) Order by the citrix_br column
 * @method     ChildRemoteQuery orderByOfficeBand($order = Criteria::ASC) Order by the office_band column
 * @method     ChildRemoteQuery orderByInternetBand($order = Criteria::ASC) Order by the internet_band column
 * @method     ChildRemoteQuery orderByPrintingBand($order = Criteria::ASC) Order by the printing_band column
 * @method     ChildRemoteQuery orderBySdVideoBand($order = Criteria::ASC) Order by the sd_video_band column
 * @method     ChildRemoteQuery orderByHdVideoBand($order = Criteria::ASC) Order by the hd_video_band column
 * @method     ChildRemoteQuery orderByUpBandwidth($order = Criteria::ASC) Order by the up_bandwidth column
 * @method     ChildRemoteQuery orderByDownBandwidth($order = Criteria::ASC) Order by the down_bandwidth column
 * @method     ChildRemoteQuery orderByExtRid($order = Criteria::ASC) Order by the ext_rid column
 *
 * @method     ChildRemoteQuery groupByRemoteId() Group by the remote_id column
 * @method     ChildRemoteQuery groupByRemoteUsed() Group by the remote_used column
 * @method     ChildRemoteQuery groupByConcurrentAccess() Group by the concurrent_access column
 * @method     ChildRemoteQuery groupByRemoteService() Group by the remote_service column
 * @method     ChildRemoteQuery groupByCitrixBr() Group by the citrix_br column
 * @method     ChildRemoteQuery groupByOfficeBand() Group by the office_band column
 * @method     ChildRemoteQuery groupByInternetBand() Group by the internet_band column
 * @method     ChildRemoteQuery groupByPrintingBand() Group by the printing_band column
 * @method     ChildRemoteQuery groupBySdVideoBand() Group by the sd_video_band column
 * @method     ChildRemoteQuery groupByHdVideoBand() Group by the hd_video_band column
 * @method     ChildRemoteQuery groupByUpBandwidth() Group by the up_bandwidth column
 * @method     ChildRemoteQuery groupByDownBandwidth() Group by the down_bandwidth column
 * @method     ChildRemoteQuery groupByExtRid() Group by the ext_rid column
 *
 * @method     ChildRemoteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRemoteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRemoteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRemoteQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRemoteQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRemoteQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRemoteQuery leftJoinRequests($relationAlias = null) Adds a LEFT JOIN clause to the query using the Requests relation
 * @method     ChildRemoteQuery rightJoinRequests($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Requests relation
 * @method     ChildRemoteQuery innerJoinRequests($relationAlias = null) Adds a INNER JOIN clause to the query using the Requests relation
 *
 * @method     ChildRemoteQuery joinWithRequests($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Requests relation
 *
 * @method     ChildRemoteQuery leftJoinWithRequests() Adds a LEFT JOIN clause and with to the query using the Requests relation
 * @method     ChildRemoteQuery rightJoinWithRequests() Adds a RIGHT JOIN clause and with to the query using the Requests relation
 * @method     ChildRemoteQuery innerJoinWithRequests() Adds a INNER JOIN clause and with to the query using the Requests relation
 *
 * @method     \RequestsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRemote findOne(ConnectionInterface $con = null) Return the first ChildRemote matching the query
 * @method     ChildRemote findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRemote matching the query, or a new ChildRemote object populated from the query conditions when no match is found
 *
 * @method     ChildRemote findOneByRemoteId(int $remote_id) Return the first ChildRemote filtered by the remote_id column
 * @method     ChildRemote findOneByRemoteUsed(boolean $remote_used) Return the first ChildRemote filtered by the remote_used column
 * @method     ChildRemote findOneByConcurrentAccess(int $concurrent_access) Return the first ChildRemote filtered by the concurrent_access column
 * @method     ChildRemote findOneByRemoteService(string $remote_service) Return the first ChildRemote filtered by the remote_service column
 * @method     ChildRemote findOneByCitrixBr(boolean $citrix_br) Return the first ChildRemote filtered by the citrix_br column
 * @method     ChildRemote findOneByOfficeBand(int $office_band) Return the first ChildRemote filtered by the office_band column
 * @method     ChildRemote findOneByInternetBand(int $internet_band) Return the first ChildRemote filtered by the internet_band column
 * @method     ChildRemote findOneByPrintingBand(int $printing_band) Return the first ChildRemote filtered by the printing_band column
 * @method     ChildRemote findOneBySdVideoBand(int $sd_video_band) Return the first ChildRemote filtered by the sd_video_band column
 * @method     ChildRemote findOneByHdVideoBand(int $hd_video_band) Return the first ChildRemote filtered by the hd_video_band column
 * @method     ChildRemote findOneByUpBandwidth(int $up_bandwidth) Return the first ChildRemote filtered by the up_bandwidth column
 * @method     ChildRemote findOneByDownBandwidth(int $down_bandwidth) Return the first ChildRemote filtered by the down_bandwidth column
 * @method     ChildRemote findOneByExtRid(int $ext_rid) Return the first ChildRemote filtered by the ext_rid column *

 * @method     ChildRemote requirePk($key, ConnectionInterface $con = null) Return the ChildRemote by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRemote requireOne(ConnectionInterface $con = null) Return the first ChildRemote matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRemote requireOneByRemoteId(int $remote_id) Return the first ChildRemote filtered by the remote_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRemote requireOneByRemoteUsed(boolean $remote_used) Return the first ChildRemote filtered by the remote_used column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRemote requireOneByConcurrentAccess(int $concurrent_access) Return the first ChildRemote filtered by the concurrent_access column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRemote requireOneByRemoteService(string $remote_service) Return the first ChildRemote filtered by the remote_service column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRemote requireOneByCitrixBr(boolean $citrix_br) Return the first ChildRemote filtered by the citrix_br column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRemote requireOneByOfficeBand(int $office_band) Return the first ChildRemote filtered by the office_band column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRemote requireOneByInternetBand(int $internet_band) Return the first ChildRemote filtered by the internet_band column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRemote requireOneByPrintingBand(int $printing_band) Return the first ChildRemote filtered by the printing_band column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRemote requireOneBySdVideoBand(int $sd_video_band) Return the first ChildRemote filtered by the sd_video_band column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRemote requireOneByHdVideoBand(int $hd_video_band) Return the first ChildRemote filtered by the hd_video_band column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRemote requireOneByUpBandwidth(int $up_bandwidth) Return the first ChildRemote filtered by the up_bandwidth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRemote requireOneByDownBandwidth(int $down_bandwidth) Return the first ChildRemote filtered by the down_bandwidth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRemote requireOneByExtRid(int $ext_rid) Return the first ChildRemote filtered by the ext_rid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRemote[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRemote objects based on current ModelCriteria
 * @method     ChildRemote[]|ObjectCollection findByRemoteId(int $remote_id) Return ChildRemote objects filtered by the remote_id column
 * @method     ChildRemote[]|ObjectCollection findByRemoteUsed(boolean $remote_used) Return ChildRemote objects filtered by the remote_used column
 * @method     ChildRemote[]|ObjectCollection findByConcurrentAccess(int $concurrent_access) Return ChildRemote objects filtered by the concurrent_access column
 * @method     ChildRemote[]|ObjectCollection findByRemoteService(string $remote_service) Return ChildRemote objects filtered by the remote_service column
 * @method     ChildRemote[]|ObjectCollection findByCitrixBr(boolean $citrix_br) Return ChildRemote objects filtered by the citrix_br column
 * @method     ChildRemote[]|ObjectCollection findByOfficeBand(int $office_band) Return ChildRemote objects filtered by the office_band column
 * @method     ChildRemote[]|ObjectCollection findByInternetBand(int $internet_band) Return ChildRemote objects filtered by the internet_band column
 * @method     ChildRemote[]|ObjectCollection findByPrintingBand(int $printing_band) Return ChildRemote objects filtered by the printing_band column
 * @method     ChildRemote[]|ObjectCollection findBySdVideoBand(int $sd_video_band) Return ChildRemote objects filtered by the sd_video_band column
 * @method     ChildRemote[]|ObjectCollection findByHdVideoBand(int $hd_video_band) Return ChildRemote objects filtered by the hd_video_band column
 * @method     ChildRemote[]|ObjectCollection findByUpBandwidth(int $up_bandwidth) Return ChildRemote objects filtered by the up_bandwidth column
 * @method     ChildRemote[]|ObjectCollection findByDownBandwidth(int $down_bandwidth) Return ChildRemote objects filtered by the down_bandwidth column
 * @method     ChildRemote[]|ObjectCollection findByExtRid(int $ext_rid) Return ChildRemote objects filtered by the ext_rid column
 * @method     ChildRemote[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RemoteQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\RemoteQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Remote', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRemoteQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRemoteQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRemoteQuery) {
            return $criteria;
        }
        $query = new ChildRemoteQuery();
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
     * @return ChildRemote|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RemoteTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RemoteTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildRemote A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT remote_id, remote_used, concurrent_access, remote_service, citrix_br, office_band, internet_band, printing_band, sd_video_band, hd_video_band, up_bandwidth, down_bandwidth, ext_rid FROM remote WHERE remote_id = :p0';
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
            /** @var ChildRemote $obj */
            $obj = new ChildRemote();
            $obj->hydrate($row);
            RemoteTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildRemote|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRemoteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RemoteTableMap::COL_REMOTE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRemoteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RemoteTableMap::COL_REMOTE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the remote_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoteId(1234); // WHERE remote_id = 1234
     * $query->filterByRemoteId(array(12, 34)); // WHERE remote_id IN (12, 34)
     * $query->filterByRemoteId(array('min' => 12)); // WHERE remote_id > 12
     * </code>
     *
     * @param     mixed $remoteId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRemoteQuery The current query, for fluid interface
     */
    public function filterByRemoteId($remoteId = null, $comparison = null)
    {
        if (is_array($remoteId)) {
            $useMinMax = false;
            if (isset($remoteId['min'])) {
                $this->addUsingAlias(RemoteTableMap::COL_REMOTE_ID, $remoteId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($remoteId['max'])) {
                $this->addUsingAlias(RemoteTableMap::COL_REMOTE_ID, $remoteId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RemoteTableMap::COL_REMOTE_ID, $remoteId, $comparison);
    }

    /**
     * Filter the query on the remote_used column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoteUsed(true); // WHERE remote_used = true
     * $query->filterByRemoteUsed('yes'); // WHERE remote_used = true
     * </code>
     *
     * @param     boolean|string $remoteUsed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRemoteQuery The current query, for fluid interface
     */
    public function filterByRemoteUsed($remoteUsed = null, $comparison = null)
    {
        if (is_string($remoteUsed)) {
            $remoteUsed = in_array(strtolower($remoteUsed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(RemoteTableMap::COL_REMOTE_USED, $remoteUsed, $comparison);
    }

    /**
     * Filter the query on the concurrent_access column
     *
     * Example usage:
     * <code>
     * $query->filterByConcurrentAccess(1234); // WHERE concurrent_access = 1234
     * $query->filterByConcurrentAccess(array(12, 34)); // WHERE concurrent_access IN (12, 34)
     * $query->filterByConcurrentAccess(array('min' => 12)); // WHERE concurrent_access > 12
     * </code>
     *
     * @param     mixed $concurrentAccess The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRemoteQuery The current query, for fluid interface
     */
    public function filterByConcurrentAccess($concurrentAccess = null, $comparison = null)
    {
        if (is_array($concurrentAccess)) {
            $useMinMax = false;
            if (isset($concurrentAccess['min'])) {
                $this->addUsingAlias(RemoteTableMap::COL_CONCURRENT_ACCESS, $concurrentAccess['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($concurrentAccess['max'])) {
                $this->addUsingAlias(RemoteTableMap::COL_CONCURRENT_ACCESS, $concurrentAccess['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RemoteTableMap::COL_CONCURRENT_ACCESS, $concurrentAccess, $comparison);
    }

    /**
     * Filter the query on the remote_service column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoteService('fooValue');   // WHERE remote_service = 'fooValue'
     * $query->filterByRemoteService('%fooValue%', Criteria::LIKE); // WHERE remote_service LIKE '%fooValue%'
     * </code>
     *
     * @param     string $remoteService The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRemoteQuery The current query, for fluid interface
     */
    public function filterByRemoteService($remoteService = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($remoteService)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RemoteTableMap::COL_REMOTE_SERVICE, $remoteService, $comparison);
    }

    /**
     * Filter the query on the citrix_br column
     *
     * Example usage:
     * <code>
     * $query->filterByCitrixBr(true); // WHERE citrix_br = true
     * $query->filterByCitrixBr('yes'); // WHERE citrix_br = true
     * </code>
     *
     * @param     boolean|string $citrixBr The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRemoteQuery The current query, for fluid interface
     */
    public function filterByCitrixBr($citrixBr = null, $comparison = null)
    {
        if (is_string($citrixBr)) {
            $citrixBr = in_array(strtolower($citrixBr), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(RemoteTableMap::COL_CITRIX_BR, $citrixBr, $comparison);
    }

    /**
     * Filter the query on the office_band column
     *
     * Example usage:
     * <code>
     * $query->filterByOfficeBand(1234); // WHERE office_band = 1234
     * $query->filterByOfficeBand(array(12, 34)); // WHERE office_band IN (12, 34)
     * $query->filterByOfficeBand(array('min' => 12)); // WHERE office_band > 12
     * </code>
     *
     * @param     mixed $officeBand The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRemoteQuery The current query, for fluid interface
     */
    public function filterByOfficeBand($officeBand = null, $comparison = null)
    {
        if (is_array($officeBand)) {
            $useMinMax = false;
            if (isset($officeBand['min'])) {
                $this->addUsingAlias(RemoteTableMap::COL_OFFICE_BAND, $officeBand['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($officeBand['max'])) {
                $this->addUsingAlias(RemoteTableMap::COL_OFFICE_BAND, $officeBand['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RemoteTableMap::COL_OFFICE_BAND, $officeBand, $comparison);
    }

    /**
     * Filter the query on the internet_band column
     *
     * Example usage:
     * <code>
     * $query->filterByInternetBand(1234); // WHERE internet_band = 1234
     * $query->filterByInternetBand(array(12, 34)); // WHERE internet_band IN (12, 34)
     * $query->filterByInternetBand(array('min' => 12)); // WHERE internet_band > 12
     * </code>
     *
     * @param     mixed $internetBand The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRemoteQuery The current query, for fluid interface
     */
    public function filterByInternetBand($internetBand = null, $comparison = null)
    {
        if (is_array($internetBand)) {
            $useMinMax = false;
            if (isset($internetBand['min'])) {
                $this->addUsingAlias(RemoteTableMap::COL_INTERNET_BAND, $internetBand['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($internetBand['max'])) {
                $this->addUsingAlias(RemoteTableMap::COL_INTERNET_BAND, $internetBand['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RemoteTableMap::COL_INTERNET_BAND, $internetBand, $comparison);
    }

    /**
     * Filter the query on the printing_band column
     *
     * Example usage:
     * <code>
     * $query->filterByPrintingBand(1234); // WHERE printing_band = 1234
     * $query->filterByPrintingBand(array(12, 34)); // WHERE printing_band IN (12, 34)
     * $query->filterByPrintingBand(array('min' => 12)); // WHERE printing_band > 12
     * </code>
     *
     * @param     mixed $printingBand The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRemoteQuery The current query, for fluid interface
     */
    public function filterByPrintingBand($printingBand = null, $comparison = null)
    {
        if (is_array($printingBand)) {
            $useMinMax = false;
            if (isset($printingBand['min'])) {
                $this->addUsingAlias(RemoteTableMap::COL_PRINTING_BAND, $printingBand['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($printingBand['max'])) {
                $this->addUsingAlias(RemoteTableMap::COL_PRINTING_BAND, $printingBand['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RemoteTableMap::COL_PRINTING_BAND, $printingBand, $comparison);
    }

    /**
     * Filter the query on the sd_video_band column
     *
     * Example usage:
     * <code>
     * $query->filterBySdVideoBand(1234); // WHERE sd_video_band = 1234
     * $query->filterBySdVideoBand(array(12, 34)); // WHERE sd_video_band IN (12, 34)
     * $query->filterBySdVideoBand(array('min' => 12)); // WHERE sd_video_band > 12
     * </code>
     *
     * @param     mixed $sdVideoBand The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRemoteQuery The current query, for fluid interface
     */
    public function filterBySdVideoBand($sdVideoBand = null, $comparison = null)
    {
        if (is_array($sdVideoBand)) {
            $useMinMax = false;
            if (isset($sdVideoBand['min'])) {
                $this->addUsingAlias(RemoteTableMap::COL_SD_VIDEO_BAND, $sdVideoBand['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sdVideoBand['max'])) {
                $this->addUsingAlias(RemoteTableMap::COL_SD_VIDEO_BAND, $sdVideoBand['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RemoteTableMap::COL_SD_VIDEO_BAND, $sdVideoBand, $comparison);
    }

    /**
     * Filter the query on the hd_video_band column
     *
     * Example usage:
     * <code>
     * $query->filterByHdVideoBand(1234); // WHERE hd_video_band = 1234
     * $query->filterByHdVideoBand(array(12, 34)); // WHERE hd_video_band IN (12, 34)
     * $query->filterByHdVideoBand(array('min' => 12)); // WHERE hd_video_band > 12
     * </code>
     *
     * @param     mixed $hdVideoBand The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRemoteQuery The current query, for fluid interface
     */
    public function filterByHdVideoBand($hdVideoBand = null, $comparison = null)
    {
        if (is_array($hdVideoBand)) {
            $useMinMax = false;
            if (isset($hdVideoBand['min'])) {
                $this->addUsingAlias(RemoteTableMap::COL_HD_VIDEO_BAND, $hdVideoBand['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hdVideoBand['max'])) {
                $this->addUsingAlias(RemoteTableMap::COL_HD_VIDEO_BAND, $hdVideoBand['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RemoteTableMap::COL_HD_VIDEO_BAND, $hdVideoBand, $comparison);
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
     * @return $this|ChildRemoteQuery The current query, for fluid interface
     */
    public function filterByUpBandwidth($upBandwidth = null, $comparison = null)
    {
        if (is_array($upBandwidth)) {
            $useMinMax = false;
            if (isset($upBandwidth['min'])) {
                $this->addUsingAlias(RemoteTableMap::COL_UP_BANDWIDTH, $upBandwidth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upBandwidth['max'])) {
                $this->addUsingAlias(RemoteTableMap::COL_UP_BANDWIDTH, $upBandwidth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RemoteTableMap::COL_UP_BANDWIDTH, $upBandwidth, $comparison);
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
     * @return $this|ChildRemoteQuery The current query, for fluid interface
     */
    public function filterByDownBandwidth($downBandwidth = null, $comparison = null)
    {
        if (is_array($downBandwidth)) {
            $useMinMax = false;
            if (isset($downBandwidth['min'])) {
                $this->addUsingAlias(RemoteTableMap::COL_DOWN_BANDWIDTH, $downBandwidth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($downBandwidth['max'])) {
                $this->addUsingAlias(RemoteTableMap::COL_DOWN_BANDWIDTH, $downBandwidth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RemoteTableMap::COL_DOWN_BANDWIDTH, $downBandwidth, $comparison);
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
     * @return $this|ChildRemoteQuery The current query, for fluid interface
     */
    public function filterByExtRid($extRid = null, $comparison = null)
    {
        if (is_array($extRid)) {
            $useMinMax = false;
            if (isset($extRid['min'])) {
                $this->addUsingAlias(RemoteTableMap::COL_EXT_RID, $extRid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($extRid['max'])) {
                $this->addUsingAlias(RemoteTableMap::COL_EXT_RID, $extRid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RemoteTableMap::COL_EXT_RID, $extRid, $comparison);
    }

    /**
     * Filter the query by a related \Requests object
     *
     * @param \Requests|ObjectCollection $requests The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRemoteQuery The current query, for fluid interface
     */
    public function filterByRequests($requests, $comparison = null)
    {
        if ($requests instanceof \Requests) {
            return $this
                ->addUsingAlias(RemoteTableMap::COL_EXT_RID, $requests->getRid(), $comparison);
        } elseif ($requests instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RemoteTableMap::COL_EXT_RID, $requests->toKeyValue('PrimaryKey', 'Rid'), $comparison);
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
     * @return $this|ChildRemoteQuery The current query, for fluid interface
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
     * @param   ChildRemote $remote Object to remove from the list of results
     *
     * @return $this|ChildRemoteQuery The current query, for fluid interface
     */
    public function prune($remote = null)
    {
        if ($remote) {
            $this->addUsingAlias(RemoteTableMap::COL_REMOTE_ID, $remote->getRemoteId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the remote table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RemoteTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RemoteTableMap::clearInstancePool();
            RemoteTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RemoteTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RemoteTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RemoteTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RemoteTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RemoteQuery
