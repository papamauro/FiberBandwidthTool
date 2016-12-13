<?php

namespace Base;

use \Requests as ChildRequests;
use \RequestsQuery as ChildRequestsQuery;
use \Exception;
use \PDO;
use Map\RequestsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'requests' table.
 *
 *
 *
 * @method     ChildRequestsQuery orderByRid($order = Criteria::ASC) Order by the rid column
 * @method     ChildRequestsQuery orderByCompleted($order = Criteria::ASC) Order by the completed column
 * @method     ChildRequestsQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method     ChildRequestsQuery orderByResultup($order = Criteria::ASC) Order by the resultup column
 * @method     ChildRequestsQuery orderByResultdown($order = Criteria::ASC) Order by the resultdown column
 * @method     ChildRequestsQuery orderByLastScreen($order = Criteria::ASC) Order by the last_screen column
 * @method     ChildRequestsQuery orderByAvg($order = Criteria::ASC) Order by the avg column
 * @method     ChildRequestsQuery orderByExtUid($order = Criteria::ASC) Order by the ext_uid column
 *
 * @method     ChildRequestsQuery groupByRid() Group by the rid column
 * @method     ChildRequestsQuery groupByCompleted() Group by the completed column
 * @method     ChildRequestsQuery groupByDate() Group by the date column
 * @method     ChildRequestsQuery groupByResultup() Group by the resultup column
 * @method     ChildRequestsQuery groupByResultdown() Group by the resultdown column
 * @method     ChildRequestsQuery groupByLastScreen() Group by the last_screen column
 * @method     ChildRequestsQuery groupByAvg() Group by the avg column
 * @method     ChildRequestsQuery groupByExtUid() Group by the ext_uid column
 *
 * @method     ChildRequestsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRequestsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRequestsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRequestsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRequestsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRequestsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRequestsQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildRequestsQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildRequestsQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildRequestsQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildRequestsQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildRequestsQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildRequestsQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     ChildRequestsQuery leftJoinWeb($relationAlias = null) Adds a LEFT JOIN clause to the query using the Web relation
 * @method     ChildRequestsQuery rightJoinWeb($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Web relation
 * @method     ChildRequestsQuery innerJoinWeb($relationAlias = null) Adds a INNER JOIN clause to the query using the Web relation
 *
 * @method     ChildRequestsQuery joinWithWeb($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Web relation
 *
 * @method     ChildRequestsQuery leftJoinWithWeb() Adds a LEFT JOIN clause and with to the query using the Web relation
 * @method     ChildRequestsQuery rightJoinWithWeb() Adds a RIGHT JOIN clause and with to the query using the Web relation
 * @method     ChildRequestsQuery innerJoinWithWeb() Adds a INNER JOIN clause and with to the query using the Web relation
 *
 * @method     ChildRequestsQuery leftJoinVideo($relationAlias = null) Adds a LEFT JOIN clause to the query using the Video relation
 * @method     ChildRequestsQuery rightJoinVideo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Video relation
 * @method     ChildRequestsQuery innerJoinVideo($relationAlias = null) Adds a INNER JOIN clause to the query using the Video relation
 *
 * @method     ChildRequestsQuery joinWithVideo($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Video relation
 *
 * @method     ChildRequestsQuery leftJoinWithVideo() Adds a LEFT JOIN clause and with to the query using the Video relation
 * @method     ChildRequestsQuery rightJoinWithVideo() Adds a RIGHT JOIN clause and with to the query using the Video relation
 * @method     ChildRequestsQuery innerJoinWithVideo() Adds a INNER JOIN clause and with to the query using the Video relation
 *
 * @method     ChildRequestsQuery leftJoinGeneric($relationAlias = null) Adds a LEFT JOIN clause to the query using the Generic relation
 * @method     ChildRequestsQuery rightJoinGeneric($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Generic relation
 * @method     ChildRequestsQuery innerJoinGeneric($relationAlias = null) Adds a INNER JOIN clause to the query using the Generic relation
 *
 * @method     ChildRequestsQuery joinWithGeneric($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Generic relation
 *
 * @method     ChildRequestsQuery leftJoinWithGeneric() Adds a LEFT JOIN clause and with to the query using the Generic relation
 * @method     ChildRequestsQuery rightJoinWithGeneric() Adds a RIGHT JOIN clause and with to the query using the Generic relation
 * @method     ChildRequestsQuery innerJoinWithGeneric() Adds a INNER JOIN clause and with to the query using the Generic relation
 *
 * @method     ChildRequestsQuery leftJoinVoip($relationAlias = null) Adds a LEFT JOIN clause to the query using the Voip relation
 * @method     ChildRequestsQuery rightJoinVoip($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Voip relation
 * @method     ChildRequestsQuery innerJoinVoip($relationAlias = null) Adds a INNER JOIN clause to the query using the Voip relation
 *
 * @method     ChildRequestsQuery joinWithVoip($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Voip relation
 *
 * @method     ChildRequestsQuery leftJoinWithVoip() Adds a LEFT JOIN clause and with to the query using the Voip relation
 * @method     ChildRequestsQuery rightJoinWithVoip() Adds a RIGHT JOIN clause and with to the query using the Voip relation
 * @method     ChildRequestsQuery innerJoinWithVoip() Adds a INNER JOIN clause and with to the query using the Voip relation
 *
 * @method     ChildRequestsQuery leftJoinSecurity($relationAlias = null) Adds a LEFT JOIN clause to the query using the Security relation
 * @method     ChildRequestsQuery rightJoinSecurity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Security relation
 * @method     ChildRequestsQuery innerJoinSecurity($relationAlias = null) Adds a INNER JOIN clause to the query using the Security relation
 *
 * @method     ChildRequestsQuery joinWithSecurity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Security relation
 *
 * @method     ChildRequestsQuery leftJoinWithSecurity() Adds a LEFT JOIN clause and with to the query using the Security relation
 * @method     ChildRequestsQuery rightJoinWithSecurity() Adds a RIGHT JOIN clause and with to the query using the Security relation
 * @method     ChildRequestsQuery innerJoinWithSecurity() Adds a INNER JOIN clause and with to the query using the Security relation
 *
 * @method     ChildRequestsQuery leftJoinRemote($relationAlias = null) Adds a LEFT JOIN clause to the query using the Remote relation
 * @method     ChildRequestsQuery rightJoinRemote($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Remote relation
 * @method     ChildRequestsQuery innerJoinRemote($relationAlias = null) Adds a INNER JOIN clause to the query using the Remote relation
 *
 * @method     ChildRequestsQuery joinWithRemote($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Remote relation
 *
 * @method     ChildRequestsQuery leftJoinWithRemote() Adds a LEFT JOIN clause and with to the query using the Remote relation
 * @method     ChildRequestsQuery rightJoinWithRemote() Adds a RIGHT JOIN clause and with to the query using the Remote relation
 * @method     ChildRequestsQuery innerJoinWithRemote() Adds a INNER JOIN clause and with to the query using the Remote relation
 *
 * @method     ChildRequestsQuery leftJoinMail($relationAlias = null) Adds a LEFT JOIN clause to the query using the Mail relation
 * @method     ChildRequestsQuery rightJoinMail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Mail relation
 * @method     ChildRequestsQuery innerJoinMail($relationAlias = null) Adds a INNER JOIN clause to the query using the Mail relation
 *
 * @method     ChildRequestsQuery joinWithMail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Mail relation
 *
 * @method     ChildRequestsQuery leftJoinWithMail() Adds a LEFT JOIN clause and with to the query using the Mail relation
 * @method     ChildRequestsQuery rightJoinWithMail() Adds a RIGHT JOIN clause and with to the query using the Mail relation
 * @method     ChildRequestsQuery innerJoinWithMail() Adds a INNER JOIN clause and with to the query using the Mail relation
 *
 * @method     \UserQuery|\WebQuery|\VideoQuery|\GenericQuery|\VoipQuery|\SecurityQuery|\RemoteQuery|\MailQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRequests findOne(ConnectionInterface $con = null) Return the first ChildRequests matching the query
 * @method     ChildRequests findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRequests matching the query, or a new ChildRequests object populated from the query conditions when no match is found
 *
 * @method     ChildRequests findOneByRid(int $rid) Return the first ChildRequests filtered by the rid column
 * @method     ChildRequests findOneByCompleted(boolean $completed) Return the first ChildRequests filtered by the completed column
 * @method     ChildRequests findOneByDate(string $date) Return the first ChildRequests filtered by the date column
 * @method     ChildRequests findOneByResultup(int $resultup) Return the first ChildRequests filtered by the resultup column
 * @method     ChildRequests findOneByResultdown(int $resultdown) Return the first ChildRequests filtered by the resultdown column
 * @method     ChildRequests findOneByLastScreen(int $last_screen) Return the first ChildRequests filtered by the last_screen column
 * @method     ChildRequests findOneByAvg(boolean $avg) Return the first ChildRequests filtered by the avg column
 * @method     ChildRequests findOneByExtUid(int $ext_uid) Return the first ChildRequests filtered by the ext_uid column *

 * @method     ChildRequests requirePk($key, ConnectionInterface $con = null) Return the ChildRequests by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRequests requireOne(ConnectionInterface $con = null) Return the first ChildRequests matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRequests requireOneByRid(int $rid) Return the first ChildRequests filtered by the rid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRequests requireOneByCompleted(boolean $completed) Return the first ChildRequests filtered by the completed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRequests requireOneByDate(string $date) Return the first ChildRequests filtered by the date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRequests requireOneByResultup(int $resultup) Return the first ChildRequests filtered by the resultup column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRequests requireOneByResultdown(int $resultdown) Return the first ChildRequests filtered by the resultdown column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRequests requireOneByLastScreen(int $last_screen) Return the first ChildRequests filtered by the last_screen column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRequests requireOneByAvg(boolean $avg) Return the first ChildRequests filtered by the avg column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRequests requireOneByExtUid(int $ext_uid) Return the first ChildRequests filtered by the ext_uid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRequests[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRequests objects based on current ModelCriteria
 * @method     ChildRequests[]|ObjectCollection findByRid(int $rid) Return ChildRequests objects filtered by the rid column
 * @method     ChildRequests[]|ObjectCollection findByCompleted(boolean $completed) Return ChildRequests objects filtered by the completed column
 * @method     ChildRequests[]|ObjectCollection findByDate(string $date) Return ChildRequests objects filtered by the date column
 * @method     ChildRequests[]|ObjectCollection findByResultup(int $resultup) Return ChildRequests objects filtered by the resultup column
 * @method     ChildRequests[]|ObjectCollection findByResultdown(int $resultdown) Return ChildRequests objects filtered by the resultdown column
 * @method     ChildRequests[]|ObjectCollection findByLastScreen(int $last_screen) Return ChildRequests objects filtered by the last_screen column
 * @method     ChildRequests[]|ObjectCollection findByAvg(boolean $avg) Return ChildRequests objects filtered by the avg column
 * @method     ChildRequests[]|ObjectCollection findByExtUid(int $ext_uid) Return ChildRequests objects filtered by the ext_uid column
 * @method     ChildRequests[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RequestsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\RequestsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Requests', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRequestsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRequestsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRequestsQuery) {
            return $criteria;
        }
        $query = new ChildRequestsQuery();
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
     * @return ChildRequests|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RequestsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RequestsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildRequests A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT rid, completed, date, resultup, resultdown, last_screen, avg, ext_uid FROM requests WHERE rid = :p0';
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
            /** @var ChildRequests $obj */
            $obj = new ChildRequests();
            $obj->hydrate($row);
            RequestsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildRequests|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRequestsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RequestsTableMap::COL_RID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRequestsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RequestsTableMap::COL_RID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the rid column
     *
     * Example usage:
     * <code>
     * $query->filterByRid(1234); // WHERE rid = 1234
     * $query->filterByRid(array(12, 34)); // WHERE rid IN (12, 34)
     * $query->filterByRid(array('min' => 12)); // WHERE rid > 12
     * </code>
     *
     * @param     mixed $rid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRequestsQuery The current query, for fluid interface
     */
    public function filterByRid($rid = null, $comparison = null)
    {
        if (is_array($rid)) {
            $useMinMax = false;
            if (isset($rid['min'])) {
                $this->addUsingAlias(RequestsTableMap::COL_RID, $rid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rid['max'])) {
                $this->addUsingAlias(RequestsTableMap::COL_RID, $rid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequestsTableMap::COL_RID, $rid, $comparison);
    }

    /**
     * Filter the query on the completed column
     *
     * Example usage:
     * <code>
     * $query->filterByCompleted(true); // WHERE completed = true
     * $query->filterByCompleted('yes'); // WHERE completed = true
     * </code>
     *
     * @param     boolean|string $completed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRequestsQuery The current query, for fluid interface
     */
    public function filterByCompleted($completed = null, $comparison = null)
    {
        if (is_string($completed)) {
            $completed = in_array(strtolower($completed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(RequestsTableMap::COL_COMPLETED, $completed, $comparison);
    }

    /**
     * Filter the query on the date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE date > '2011-03-13'
     * </code>
     *
     * @param     mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRequestsQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(RequestsTableMap::COL_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(RequestsTableMap::COL_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequestsTableMap::COL_DATE, $date, $comparison);
    }

    /**
     * Filter the query on the resultup column
     *
     * Example usage:
     * <code>
     * $query->filterByResultup(1234); // WHERE resultup = 1234
     * $query->filterByResultup(array(12, 34)); // WHERE resultup IN (12, 34)
     * $query->filterByResultup(array('min' => 12)); // WHERE resultup > 12
     * </code>
     *
     * @param     mixed $resultup The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRequestsQuery The current query, for fluid interface
     */
    public function filterByResultup($resultup = null, $comparison = null)
    {
        if (is_array($resultup)) {
            $useMinMax = false;
            if (isset($resultup['min'])) {
                $this->addUsingAlias(RequestsTableMap::COL_RESULTUP, $resultup['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resultup['max'])) {
                $this->addUsingAlias(RequestsTableMap::COL_RESULTUP, $resultup['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequestsTableMap::COL_RESULTUP, $resultup, $comparison);
    }

    /**
     * Filter the query on the resultdown column
     *
     * Example usage:
     * <code>
     * $query->filterByResultdown(1234); // WHERE resultdown = 1234
     * $query->filterByResultdown(array(12, 34)); // WHERE resultdown IN (12, 34)
     * $query->filterByResultdown(array('min' => 12)); // WHERE resultdown > 12
     * </code>
     *
     * @param     mixed $resultdown The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRequestsQuery The current query, for fluid interface
     */
    public function filterByResultdown($resultdown = null, $comparison = null)
    {
        if (is_array($resultdown)) {
            $useMinMax = false;
            if (isset($resultdown['min'])) {
                $this->addUsingAlias(RequestsTableMap::COL_RESULTDOWN, $resultdown['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resultdown['max'])) {
                $this->addUsingAlias(RequestsTableMap::COL_RESULTDOWN, $resultdown['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequestsTableMap::COL_RESULTDOWN, $resultdown, $comparison);
    }

    /**
     * Filter the query on the last_screen column
     *
     * Example usage:
     * <code>
     * $query->filterByLastScreen(1234); // WHERE last_screen = 1234
     * $query->filterByLastScreen(array(12, 34)); // WHERE last_screen IN (12, 34)
     * $query->filterByLastScreen(array('min' => 12)); // WHERE last_screen > 12
     * </code>
     *
     * @param     mixed $lastScreen The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRequestsQuery The current query, for fluid interface
     */
    public function filterByLastScreen($lastScreen = null, $comparison = null)
    {
        if (is_array($lastScreen)) {
            $useMinMax = false;
            if (isset($lastScreen['min'])) {
                $this->addUsingAlias(RequestsTableMap::COL_LAST_SCREEN, $lastScreen['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastScreen['max'])) {
                $this->addUsingAlias(RequestsTableMap::COL_LAST_SCREEN, $lastScreen['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequestsTableMap::COL_LAST_SCREEN, $lastScreen, $comparison);
    }

    /**
     * Filter the query on the avg column
     *
     * Example usage:
     * <code>
     * $query->filterByAvg(true); // WHERE avg = true
     * $query->filterByAvg('yes'); // WHERE avg = true
     * </code>
     *
     * @param     boolean|string $avg The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRequestsQuery The current query, for fluid interface
     */
    public function filterByAvg($avg = null, $comparison = null)
    {
        if (is_string($avg)) {
            $avg = in_array(strtolower($avg), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(RequestsTableMap::COL_AVG, $avg, $comparison);
    }

    /**
     * Filter the query on the ext_uid column
     *
     * Example usage:
     * <code>
     * $query->filterByExtUid(1234); // WHERE ext_uid = 1234
     * $query->filterByExtUid(array(12, 34)); // WHERE ext_uid IN (12, 34)
     * $query->filterByExtUid(array('min' => 12)); // WHERE ext_uid > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $extUid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRequestsQuery The current query, for fluid interface
     */
    public function filterByExtUid($extUid = null, $comparison = null)
    {
        if (is_array($extUid)) {
            $useMinMax = false;
            if (isset($extUid['min'])) {
                $this->addUsingAlias(RequestsTableMap::COL_EXT_UID, $extUid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($extUid['max'])) {
                $this->addUsingAlias(RequestsTableMap::COL_EXT_UID, $extUid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequestsTableMap::COL_EXT_UID, $extUid, $comparison);
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRequestsQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(RequestsTableMap::COL_EXT_UID, $user->getUid(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RequestsTableMap::COL_EXT_UID, $user->toKeyValue('PrimaryKey', 'Uid'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRequestsQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\UserQuery');
    }

    /**
     * Filter the query by a related \Web object
     *
     * @param \Web|ObjectCollection $web the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRequestsQuery The current query, for fluid interface
     */
    public function filterByWeb($web, $comparison = null)
    {
        if ($web instanceof \Web) {
            return $this
                ->addUsingAlias(RequestsTableMap::COL_RID, $web->getExtRid(), $comparison);
        } elseif ($web instanceof ObjectCollection) {
            return $this
                ->useWebQuery()
                ->filterByPrimaryKeys($web->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByWeb() only accepts arguments of type \Web or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Web relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRequestsQuery The current query, for fluid interface
     */
    public function joinWeb($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Web');

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
            $this->addJoinObject($join, 'Web');
        }

        return $this;
    }

    /**
     * Use the Web relation Web object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \WebQuery A secondary query class using the current class as primary query
     */
    public function useWebQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinWeb($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Web', '\WebQuery');
    }

    /**
     * Filter the query by a related \Video object
     *
     * @param \Video|ObjectCollection $video the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRequestsQuery The current query, for fluid interface
     */
    public function filterByVideo($video, $comparison = null)
    {
        if ($video instanceof \Video) {
            return $this
                ->addUsingAlias(RequestsTableMap::COL_RID, $video->getExtRid(), $comparison);
        } elseif ($video instanceof ObjectCollection) {
            return $this
                ->useVideoQuery()
                ->filterByPrimaryKeys($video->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVideo() only accepts arguments of type \Video or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Video relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRequestsQuery The current query, for fluid interface
     */
    public function joinVideo($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Video');

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
            $this->addJoinObject($join, 'Video');
        }

        return $this;
    }

    /**
     * Use the Video relation Video object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \VideoQuery A secondary query class using the current class as primary query
     */
    public function useVideoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinVideo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Video', '\VideoQuery');
    }

    /**
     * Filter the query by a related \Generic object
     *
     * @param \Generic|ObjectCollection $generic the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRequestsQuery The current query, for fluid interface
     */
    public function filterByGeneric($generic, $comparison = null)
    {
        if ($generic instanceof \Generic) {
            return $this
                ->addUsingAlias(RequestsTableMap::COL_RID, $generic->getExtRid(), $comparison);
        } elseif ($generic instanceof ObjectCollection) {
            return $this
                ->useGenericQuery()
                ->filterByPrimaryKeys($generic->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByGeneric() only accepts arguments of type \Generic or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Generic relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRequestsQuery The current query, for fluid interface
     */
    public function joinGeneric($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Generic');

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
            $this->addJoinObject($join, 'Generic');
        }

        return $this;
    }

    /**
     * Use the Generic relation Generic object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \GenericQuery A secondary query class using the current class as primary query
     */
    public function useGenericQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGeneric($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Generic', '\GenericQuery');
    }

    /**
     * Filter the query by a related \Voip object
     *
     * @param \Voip|ObjectCollection $voip the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRequestsQuery The current query, for fluid interface
     */
    public function filterByVoip($voip, $comparison = null)
    {
        if ($voip instanceof \Voip) {
            return $this
                ->addUsingAlias(RequestsTableMap::COL_RID, $voip->getExtRid(), $comparison);
        } elseif ($voip instanceof ObjectCollection) {
            return $this
                ->useVoipQuery()
                ->filterByPrimaryKeys($voip->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVoip() only accepts arguments of type \Voip or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Voip relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRequestsQuery The current query, for fluid interface
     */
    public function joinVoip($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Voip');

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
            $this->addJoinObject($join, 'Voip');
        }

        return $this;
    }

    /**
     * Use the Voip relation Voip object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \VoipQuery A secondary query class using the current class as primary query
     */
    public function useVoipQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinVoip($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Voip', '\VoipQuery');
    }

    /**
     * Filter the query by a related \Security object
     *
     * @param \Security|ObjectCollection $security the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRequestsQuery The current query, for fluid interface
     */
    public function filterBySecurity($security, $comparison = null)
    {
        if ($security instanceof \Security) {
            return $this
                ->addUsingAlias(RequestsTableMap::COL_RID, $security->getExtRid(), $comparison);
        } elseif ($security instanceof ObjectCollection) {
            return $this
                ->useSecurityQuery()
                ->filterByPrimaryKeys($security->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySecurity() only accepts arguments of type \Security or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Security relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRequestsQuery The current query, for fluid interface
     */
    public function joinSecurity($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Security');

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
            $this->addJoinObject($join, 'Security');
        }

        return $this;
    }

    /**
     * Use the Security relation Security object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SecurityQuery A secondary query class using the current class as primary query
     */
    public function useSecurityQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSecurity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Security', '\SecurityQuery');
    }

    /**
     * Filter the query by a related \Remote object
     *
     * @param \Remote|ObjectCollection $remote the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRequestsQuery The current query, for fluid interface
     */
    public function filterByRemote($remote, $comparison = null)
    {
        if ($remote instanceof \Remote) {
            return $this
                ->addUsingAlias(RequestsTableMap::COL_RID, $remote->getExtRid(), $comparison);
        } elseif ($remote instanceof ObjectCollection) {
            return $this
                ->useRemoteQuery()
                ->filterByPrimaryKeys($remote->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRemote() only accepts arguments of type \Remote or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Remote relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRequestsQuery The current query, for fluid interface
     */
    public function joinRemote($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Remote');

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
            $this->addJoinObject($join, 'Remote');
        }

        return $this;
    }

    /**
     * Use the Remote relation Remote object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RemoteQuery A secondary query class using the current class as primary query
     */
    public function useRemoteQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRemote($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Remote', '\RemoteQuery');
    }

    /**
     * Filter the query by a related \Mail object
     *
     * @param \Mail|ObjectCollection $mail the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRequestsQuery The current query, for fluid interface
     */
    public function filterByMail($mail, $comparison = null)
    {
        if ($mail instanceof \Mail) {
            return $this
                ->addUsingAlias(RequestsTableMap::COL_RID, $mail->getExtRid(), $comparison);
        } elseif ($mail instanceof ObjectCollection) {
            return $this
                ->useMailQuery()
                ->filterByPrimaryKeys($mail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMail() only accepts arguments of type \Mail or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Mail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRequestsQuery The current query, for fluid interface
     */
    public function joinMail($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Mail');

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
            $this->addJoinObject($join, 'Mail');
        }

        return $this;
    }

    /**
     * Use the Mail relation Mail object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \MailQuery A secondary query class using the current class as primary query
     */
    public function useMailQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Mail', '\MailQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRequests $requests Object to remove from the list of results
     *
     * @return $this|ChildRequestsQuery The current query, for fluid interface
     */
    public function prune($requests = null)
    {
        if ($requests) {
            $this->addUsingAlias(RequestsTableMap::COL_RID, $requests->getRid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the requests table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RequestsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RequestsTableMap::clearInstancePool();
            RequestsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RequestsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RequestsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RequestsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RequestsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RequestsQuery
