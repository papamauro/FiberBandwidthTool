<?php

namespace Base;

use \Security as ChildSecurity;
use \SecurityQuery as ChildSecurityQuery;
use \Exception;
use \PDO;
use Map\SecurityTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'security' table.
 *
 *
 *
 * @method     ChildSecurityQuery orderBySecurityId($order = Criteria::ASC) Order by the security_id column
 * @method     ChildSecurityQuery orderByUseSecurity($order = Criteria::ASC) Order by the use_security column
 * @method     ChildSecurityQuery orderByExternalMediaserver($order = Criteria::ASC) Order by the external_mediaserver column
 * @method     ChildSecurityQuery orderByRemoteAccess($order = Criteria::ASC) Order by the remote_access column
 * @method     ChildSecurityQuery orderByNumberCamera($order = Criteria::ASC) Order by the number_camera column
 * @method     ChildSecurityQuery orderByFps($order = Criteria::ASC) Order by the fps column
 * @method     ChildSecurityQuery orderByResolution($order = Criteria::ASC) Order by the resolution column
 * @method     ChildSecurityQuery orderByH264Profile($order = Criteria::ASC) Order by the h264_profile column
 * @method     ChildSecurityQuery orderByNumberCameraViewed($order = Criteria::ASC) Order by the number_camera_viewed column
 * @method     ChildSecurityQuery orderByUpBandwidth($order = Criteria::ASC) Order by the up_bandwidth column
 * @method     ChildSecurityQuery orderByDownBandwidth($order = Criteria::ASC) Order by the down_bandwidth column
 * @method     ChildSecurityQuery orderByViewResolution($order = Criteria::ASC) Order by the view_resolution column
 * @method     ChildSecurityQuery orderByExtRid($order = Criteria::ASC) Order by the ext_rid column
 *
 * @method     ChildSecurityQuery groupBySecurityId() Group by the security_id column
 * @method     ChildSecurityQuery groupByUseSecurity() Group by the use_security column
 * @method     ChildSecurityQuery groupByExternalMediaserver() Group by the external_mediaserver column
 * @method     ChildSecurityQuery groupByRemoteAccess() Group by the remote_access column
 * @method     ChildSecurityQuery groupByNumberCamera() Group by the number_camera column
 * @method     ChildSecurityQuery groupByFps() Group by the fps column
 * @method     ChildSecurityQuery groupByResolution() Group by the resolution column
 * @method     ChildSecurityQuery groupByH264Profile() Group by the h264_profile column
 * @method     ChildSecurityQuery groupByNumberCameraViewed() Group by the number_camera_viewed column
 * @method     ChildSecurityQuery groupByUpBandwidth() Group by the up_bandwidth column
 * @method     ChildSecurityQuery groupByDownBandwidth() Group by the down_bandwidth column
 * @method     ChildSecurityQuery groupByViewResolution() Group by the view_resolution column
 * @method     ChildSecurityQuery groupByExtRid() Group by the ext_rid column
 *
 * @method     ChildSecurityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSecurityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSecurityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSecurityQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSecurityQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSecurityQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSecurityQuery leftJoinRequests($relationAlias = null) Adds a LEFT JOIN clause to the query using the Requests relation
 * @method     ChildSecurityQuery rightJoinRequests($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Requests relation
 * @method     ChildSecurityQuery innerJoinRequests($relationAlias = null) Adds a INNER JOIN clause to the query using the Requests relation
 *
 * @method     ChildSecurityQuery joinWithRequests($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Requests relation
 *
 * @method     ChildSecurityQuery leftJoinWithRequests() Adds a LEFT JOIN clause and with to the query using the Requests relation
 * @method     ChildSecurityQuery rightJoinWithRequests() Adds a RIGHT JOIN clause and with to the query using the Requests relation
 * @method     ChildSecurityQuery innerJoinWithRequests() Adds a INNER JOIN clause and with to the query using the Requests relation
 *
 * @method     \RequestsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSecurity findOne(ConnectionInterface $con = null) Return the first ChildSecurity matching the query
 * @method     ChildSecurity findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSecurity matching the query, or a new ChildSecurity object populated from the query conditions when no match is found
 *
 * @method     ChildSecurity findOneBySecurityId(int $security_id) Return the first ChildSecurity filtered by the security_id column
 * @method     ChildSecurity findOneByUseSecurity(boolean $use_security) Return the first ChildSecurity filtered by the use_security column
 * @method     ChildSecurity findOneByExternalMediaserver(boolean $external_mediaserver) Return the first ChildSecurity filtered by the external_mediaserver column
 * @method     ChildSecurity findOneByRemoteAccess(boolean $remote_access) Return the first ChildSecurity filtered by the remote_access column
 * @method     ChildSecurity findOneByNumberCamera(int $number_camera) Return the first ChildSecurity filtered by the number_camera column
 * @method     ChildSecurity findOneByFps(int $fps) Return the first ChildSecurity filtered by the fps column
 * @method     ChildSecurity findOneByResolution(string $resolution) Return the first ChildSecurity filtered by the resolution column
 * @method     ChildSecurity findOneByH264Profile(int $h264_profile) Return the first ChildSecurity filtered by the h264_profile column
 * @method     ChildSecurity findOneByNumberCameraViewed(int $number_camera_viewed) Return the first ChildSecurity filtered by the number_camera_viewed column
 * @method     ChildSecurity findOneByUpBandwidth(int $up_bandwidth) Return the first ChildSecurity filtered by the up_bandwidth column
 * @method     ChildSecurity findOneByDownBandwidth(int $down_bandwidth) Return the first ChildSecurity filtered by the down_bandwidth column
 * @method     ChildSecurity findOneByViewResolution(string $view_resolution) Return the first ChildSecurity filtered by the view_resolution column
 * @method     ChildSecurity findOneByExtRid(int $ext_rid) Return the first ChildSecurity filtered by the ext_rid column *

 * @method     ChildSecurity requirePk($key, ConnectionInterface $con = null) Return the ChildSecurity by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSecurity requireOne(ConnectionInterface $con = null) Return the first ChildSecurity matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSecurity requireOneBySecurityId(int $security_id) Return the first ChildSecurity filtered by the security_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSecurity requireOneByUseSecurity(boolean $use_security) Return the first ChildSecurity filtered by the use_security column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSecurity requireOneByExternalMediaserver(boolean $external_mediaserver) Return the first ChildSecurity filtered by the external_mediaserver column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSecurity requireOneByRemoteAccess(boolean $remote_access) Return the first ChildSecurity filtered by the remote_access column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSecurity requireOneByNumberCamera(int $number_camera) Return the first ChildSecurity filtered by the number_camera column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSecurity requireOneByFps(int $fps) Return the first ChildSecurity filtered by the fps column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSecurity requireOneByResolution(string $resolution) Return the first ChildSecurity filtered by the resolution column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSecurity requireOneByH264Profile(int $h264_profile) Return the first ChildSecurity filtered by the h264_profile column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSecurity requireOneByNumberCameraViewed(int $number_camera_viewed) Return the first ChildSecurity filtered by the number_camera_viewed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSecurity requireOneByUpBandwidth(int $up_bandwidth) Return the first ChildSecurity filtered by the up_bandwidth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSecurity requireOneByDownBandwidth(int $down_bandwidth) Return the first ChildSecurity filtered by the down_bandwidth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSecurity requireOneByViewResolution(string $view_resolution) Return the first ChildSecurity filtered by the view_resolution column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSecurity requireOneByExtRid(int $ext_rid) Return the first ChildSecurity filtered by the ext_rid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSecurity[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSecurity objects based on current ModelCriteria
 * @method     ChildSecurity[]|ObjectCollection findBySecurityId(int $security_id) Return ChildSecurity objects filtered by the security_id column
 * @method     ChildSecurity[]|ObjectCollection findByUseSecurity(boolean $use_security) Return ChildSecurity objects filtered by the use_security column
 * @method     ChildSecurity[]|ObjectCollection findByExternalMediaserver(boolean $external_mediaserver) Return ChildSecurity objects filtered by the external_mediaserver column
 * @method     ChildSecurity[]|ObjectCollection findByRemoteAccess(boolean $remote_access) Return ChildSecurity objects filtered by the remote_access column
 * @method     ChildSecurity[]|ObjectCollection findByNumberCamera(int $number_camera) Return ChildSecurity objects filtered by the number_camera column
 * @method     ChildSecurity[]|ObjectCollection findByFps(int $fps) Return ChildSecurity objects filtered by the fps column
 * @method     ChildSecurity[]|ObjectCollection findByResolution(string $resolution) Return ChildSecurity objects filtered by the resolution column
 * @method     ChildSecurity[]|ObjectCollection findByH264Profile(int $h264_profile) Return ChildSecurity objects filtered by the h264_profile column
 * @method     ChildSecurity[]|ObjectCollection findByNumberCameraViewed(int $number_camera_viewed) Return ChildSecurity objects filtered by the number_camera_viewed column
 * @method     ChildSecurity[]|ObjectCollection findByUpBandwidth(int $up_bandwidth) Return ChildSecurity objects filtered by the up_bandwidth column
 * @method     ChildSecurity[]|ObjectCollection findByDownBandwidth(int $down_bandwidth) Return ChildSecurity objects filtered by the down_bandwidth column
 * @method     ChildSecurity[]|ObjectCollection findByViewResolution(string $view_resolution) Return ChildSecurity objects filtered by the view_resolution column
 * @method     ChildSecurity[]|ObjectCollection findByExtRid(int $ext_rid) Return ChildSecurity objects filtered by the ext_rid column
 * @method     ChildSecurity[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SecurityQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SecurityQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Security', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSecurityQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSecurityQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSecurityQuery) {
            return $criteria;
        }
        $query = new ChildSecurityQuery();
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
     * @return ChildSecurity|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SecurityTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SecurityTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSecurity A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT security_id, use_security, external_mediaserver, remote_access, number_camera, fps, resolution, h264_profile, number_camera_viewed, up_bandwidth, down_bandwidth, view_resolution, ext_rid FROM security WHERE security_id = :p0';
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
            /** @var ChildSecurity $obj */
            $obj = new ChildSecurity();
            $obj->hydrate($row);
            SecurityTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSecurity|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSecurityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SecurityTableMap::COL_SECURITY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSecurityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SecurityTableMap::COL_SECURITY_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the security_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySecurityId(1234); // WHERE security_id = 1234
     * $query->filterBySecurityId(array(12, 34)); // WHERE security_id IN (12, 34)
     * $query->filterBySecurityId(array('min' => 12)); // WHERE security_id > 12
     * </code>
     *
     * @param     mixed $securityId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSecurityQuery The current query, for fluid interface
     */
    public function filterBySecurityId($securityId = null, $comparison = null)
    {
        if (is_array($securityId)) {
            $useMinMax = false;
            if (isset($securityId['min'])) {
                $this->addUsingAlias(SecurityTableMap::COL_SECURITY_ID, $securityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($securityId['max'])) {
                $this->addUsingAlias(SecurityTableMap::COL_SECURITY_ID, $securityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecurityTableMap::COL_SECURITY_ID, $securityId, $comparison);
    }

    /**
     * Filter the query on the use_security column
     *
     * Example usage:
     * <code>
     * $query->filterByUseSecurity(true); // WHERE use_security = true
     * $query->filterByUseSecurity('yes'); // WHERE use_security = true
     * </code>
     *
     * @param     boolean|string $useSecurity The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSecurityQuery The current query, for fluid interface
     */
    public function filterByUseSecurity($useSecurity = null, $comparison = null)
    {
        if (is_string($useSecurity)) {
            $useSecurity = in_array(strtolower($useSecurity), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SecurityTableMap::COL_USE_SECURITY, $useSecurity, $comparison);
    }

    /**
     * Filter the query on the external_mediaserver column
     *
     * Example usage:
     * <code>
     * $query->filterByExternalMediaserver(true); // WHERE external_mediaserver = true
     * $query->filterByExternalMediaserver('yes'); // WHERE external_mediaserver = true
     * </code>
     *
     * @param     boolean|string $externalMediaserver The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSecurityQuery The current query, for fluid interface
     */
    public function filterByExternalMediaserver($externalMediaserver = null, $comparison = null)
    {
        if (is_string($externalMediaserver)) {
            $externalMediaserver = in_array(strtolower($externalMediaserver), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SecurityTableMap::COL_EXTERNAL_MEDIASERVER, $externalMediaserver, $comparison);
    }

    /**
     * Filter the query on the remote_access column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoteAccess(true); // WHERE remote_access = true
     * $query->filterByRemoteAccess('yes'); // WHERE remote_access = true
     * </code>
     *
     * @param     boolean|string $remoteAccess The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSecurityQuery The current query, for fluid interface
     */
    public function filterByRemoteAccess($remoteAccess = null, $comparison = null)
    {
        if (is_string($remoteAccess)) {
            $remoteAccess = in_array(strtolower($remoteAccess), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SecurityTableMap::COL_REMOTE_ACCESS, $remoteAccess, $comparison);
    }

    /**
     * Filter the query on the number_camera column
     *
     * Example usage:
     * <code>
     * $query->filterByNumberCamera(1234); // WHERE number_camera = 1234
     * $query->filterByNumberCamera(array(12, 34)); // WHERE number_camera IN (12, 34)
     * $query->filterByNumberCamera(array('min' => 12)); // WHERE number_camera > 12
     * </code>
     *
     * @param     mixed $numberCamera The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSecurityQuery The current query, for fluid interface
     */
    public function filterByNumberCamera($numberCamera = null, $comparison = null)
    {
        if (is_array($numberCamera)) {
            $useMinMax = false;
            if (isset($numberCamera['min'])) {
                $this->addUsingAlias(SecurityTableMap::COL_NUMBER_CAMERA, $numberCamera['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($numberCamera['max'])) {
                $this->addUsingAlias(SecurityTableMap::COL_NUMBER_CAMERA, $numberCamera['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecurityTableMap::COL_NUMBER_CAMERA, $numberCamera, $comparison);
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
     * @return $this|ChildSecurityQuery The current query, for fluid interface
     */
    public function filterByFps($fps = null, $comparison = null)
    {
        if (is_array($fps)) {
            $useMinMax = false;
            if (isset($fps['min'])) {
                $this->addUsingAlias(SecurityTableMap::COL_FPS, $fps['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fps['max'])) {
                $this->addUsingAlias(SecurityTableMap::COL_FPS, $fps['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecurityTableMap::COL_FPS, $fps, $comparison);
    }

    /**
     * Filter the query on the resolution column
     *
     * Example usage:
     * <code>
     * $query->filterByResolution('fooValue');   // WHERE resolution = 'fooValue'
     * $query->filterByResolution('%fooValue%', Criteria::LIKE); // WHERE resolution LIKE '%fooValue%'
     * </code>
     *
     * @param     string $resolution The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSecurityQuery The current query, for fluid interface
     */
    public function filterByResolution($resolution = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($resolution)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecurityTableMap::COL_RESOLUTION, $resolution, $comparison);
    }

    /**
     * Filter the query on the h264_profile column
     *
     * Example usage:
     * <code>
     * $query->filterByH264Profile(1234); // WHERE h264_profile = 1234
     * $query->filterByH264Profile(array(12, 34)); // WHERE h264_profile IN (12, 34)
     * $query->filterByH264Profile(array('min' => 12)); // WHERE h264_profile > 12
     * </code>
     *
     * @param     mixed $h264Profile The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSecurityQuery The current query, for fluid interface
     */
    public function filterByH264Profile($h264Profile = null, $comparison = null)
    {
        if (is_array($h264Profile)) {
            $useMinMax = false;
            if (isset($h264Profile['min'])) {
                $this->addUsingAlias(SecurityTableMap::COL_H264_PROFILE, $h264Profile['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($h264Profile['max'])) {
                $this->addUsingAlias(SecurityTableMap::COL_H264_PROFILE, $h264Profile['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecurityTableMap::COL_H264_PROFILE, $h264Profile, $comparison);
    }

    /**
     * Filter the query on the number_camera_viewed column
     *
     * Example usage:
     * <code>
     * $query->filterByNumberCameraViewed(1234); // WHERE number_camera_viewed = 1234
     * $query->filterByNumberCameraViewed(array(12, 34)); // WHERE number_camera_viewed IN (12, 34)
     * $query->filterByNumberCameraViewed(array('min' => 12)); // WHERE number_camera_viewed > 12
     * </code>
     *
     * @param     mixed $numberCameraViewed The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSecurityQuery The current query, for fluid interface
     */
    public function filterByNumberCameraViewed($numberCameraViewed = null, $comparison = null)
    {
        if (is_array($numberCameraViewed)) {
            $useMinMax = false;
            if (isset($numberCameraViewed['min'])) {
                $this->addUsingAlias(SecurityTableMap::COL_NUMBER_CAMERA_VIEWED, $numberCameraViewed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($numberCameraViewed['max'])) {
                $this->addUsingAlias(SecurityTableMap::COL_NUMBER_CAMERA_VIEWED, $numberCameraViewed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecurityTableMap::COL_NUMBER_CAMERA_VIEWED, $numberCameraViewed, $comparison);
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
     * @return $this|ChildSecurityQuery The current query, for fluid interface
     */
    public function filterByUpBandwidth($upBandwidth = null, $comparison = null)
    {
        if (is_array($upBandwidth)) {
            $useMinMax = false;
            if (isset($upBandwidth['min'])) {
                $this->addUsingAlias(SecurityTableMap::COL_UP_BANDWIDTH, $upBandwidth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upBandwidth['max'])) {
                $this->addUsingAlias(SecurityTableMap::COL_UP_BANDWIDTH, $upBandwidth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecurityTableMap::COL_UP_BANDWIDTH, $upBandwidth, $comparison);
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
     * @return $this|ChildSecurityQuery The current query, for fluid interface
     */
    public function filterByDownBandwidth($downBandwidth = null, $comparison = null)
    {
        if (is_array($downBandwidth)) {
            $useMinMax = false;
            if (isset($downBandwidth['min'])) {
                $this->addUsingAlias(SecurityTableMap::COL_DOWN_BANDWIDTH, $downBandwidth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($downBandwidth['max'])) {
                $this->addUsingAlias(SecurityTableMap::COL_DOWN_BANDWIDTH, $downBandwidth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecurityTableMap::COL_DOWN_BANDWIDTH, $downBandwidth, $comparison);
    }

    /**
     * Filter the query on the view_resolution column
     *
     * Example usage:
     * <code>
     * $query->filterByViewResolution('fooValue');   // WHERE view_resolution = 'fooValue'
     * $query->filterByViewResolution('%fooValue%', Criteria::LIKE); // WHERE view_resolution LIKE '%fooValue%'
     * </code>
     *
     * @param     string $viewResolution The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSecurityQuery The current query, for fluid interface
     */
    public function filterByViewResolution($viewResolution = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($viewResolution)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecurityTableMap::COL_VIEW_RESOLUTION, $viewResolution, $comparison);
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
     * @return $this|ChildSecurityQuery The current query, for fluid interface
     */
    public function filterByExtRid($extRid = null, $comparison = null)
    {
        if (is_array($extRid)) {
            $useMinMax = false;
            if (isset($extRid['min'])) {
                $this->addUsingAlias(SecurityTableMap::COL_EXT_RID, $extRid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($extRid['max'])) {
                $this->addUsingAlias(SecurityTableMap::COL_EXT_RID, $extRid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecurityTableMap::COL_EXT_RID, $extRid, $comparison);
    }

    /**
     * Filter the query by a related \Requests object
     *
     * @param \Requests|ObjectCollection $requests The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSecurityQuery The current query, for fluid interface
     */
    public function filterByRequests($requests, $comparison = null)
    {
        if ($requests instanceof \Requests) {
            return $this
                ->addUsingAlias(SecurityTableMap::COL_EXT_RID, $requests->getRid(), $comparison);
        } elseif ($requests instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SecurityTableMap::COL_EXT_RID, $requests->toKeyValue('PrimaryKey', 'Rid'), $comparison);
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
     * @return $this|ChildSecurityQuery The current query, for fluid interface
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
     * @param   ChildSecurity $security Object to remove from the list of results
     *
     * @return $this|ChildSecurityQuery The current query, for fluid interface
     */
    public function prune($security = null)
    {
        if ($security) {
            $this->addUsingAlias(SecurityTableMap::COL_SECURITY_ID, $security->getSecurityId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the security table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SecurityTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SecurityTableMap::clearInstancePool();
            SecurityTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SecurityTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SecurityTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SecurityTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SecurityTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SecurityQuery
