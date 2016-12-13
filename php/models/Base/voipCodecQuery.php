<?php

namespace Base;

use \voipCodec as ChildvoipCodec;
use \voipCodecQuery as ChildvoipCodecQuery;
use \Exception;
use \PDO;
use Map\voipCodecTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'voipcodec' table.
 *
 *
 *
 * @method     ChildvoipCodecQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildvoipCodecQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildvoipCodecQuery orderByPayload($order = Criteria::ASC) Order by the payload column
 * @method     ChildvoipCodecQuery orderByBitRate($order = Criteria::ASC) Order by the bit_rate column
 *
 * @method     ChildvoipCodecQuery groupById() Group by the id column
 * @method     ChildvoipCodecQuery groupByName() Group by the name column
 * @method     ChildvoipCodecQuery groupByPayload() Group by the payload column
 * @method     ChildvoipCodecQuery groupByBitRate() Group by the bit_rate column
 *
 * @method     ChildvoipCodecQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildvoipCodecQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildvoipCodecQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildvoipCodecQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildvoipCodecQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildvoipCodecQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildvoipCodec findOne(ConnectionInterface $con = null) Return the first ChildvoipCodec matching the query
 * @method     ChildvoipCodec findOneOrCreate(ConnectionInterface $con = null) Return the first ChildvoipCodec matching the query, or a new ChildvoipCodec object populated from the query conditions when no match is found
 *
 * @method     ChildvoipCodec findOneById(string $id) Return the first ChildvoipCodec filtered by the id column
 * @method     ChildvoipCodec findOneByName(string $name) Return the first ChildvoipCodec filtered by the name column
 * @method     ChildvoipCodec findOneByPayload(int $payload) Return the first ChildvoipCodec filtered by the payload column
 * @method     ChildvoipCodec findOneByBitRate(int $bit_rate) Return the first ChildvoipCodec filtered by the bit_rate column *

 * @method     ChildvoipCodec requirePk($key, ConnectionInterface $con = null) Return the ChildvoipCodec by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildvoipCodec requireOne(ConnectionInterface $con = null) Return the first ChildvoipCodec matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildvoipCodec requireOneById(string $id) Return the first ChildvoipCodec filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildvoipCodec requireOneByName(string $name) Return the first ChildvoipCodec filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildvoipCodec requireOneByPayload(int $payload) Return the first ChildvoipCodec filtered by the payload column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildvoipCodec requireOneByBitRate(int $bit_rate) Return the first ChildvoipCodec filtered by the bit_rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildvoipCodec[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildvoipCodec objects based on current ModelCriteria
 * @method     ChildvoipCodec[]|ObjectCollection findById(string $id) Return ChildvoipCodec objects filtered by the id column
 * @method     ChildvoipCodec[]|ObjectCollection findByName(string $name) Return ChildvoipCodec objects filtered by the name column
 * @method     ChildvoipCodec[]|ObjectCollection findByPayload(int $payload) Return ChildvoipCodec objects filtered by the payload column
 * @method     ChildvoipCodec[]|ObjectCollection findByBitRate(int $bit_rate) Return ChildvoipCodec objects filtered by the bit_rate column
 * @method     ChildvoipCodec[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class voipCodecQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\voipCodecQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\voipCodec', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildvoipCodecQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildvoipCodecQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildvoipCodecQuery) {
            return $criteria;
        }
        $query = new ChildvoipCodecQuery();
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
     * @return ChildvoipCodec|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(voipCodecTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = voipCodecTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildvoipCodec A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, payload, bit_rate FROM voipcodec WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildvoipCodec $obj */
            $obj = new ChildvoipCodec();
            $obj->hydrate($row);
            voipCodecTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildvoipCodec|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildvoipCodecQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(voipCodecTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildvoipCodecQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(voipCodecTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE id = 'fooValue'
     * $query->filterById('%fooValue%', Criteria::LIKE); // WHERE id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $id The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildvoipCodecQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(voipCodecTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildvoipCodecQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(voipCodecTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the payload column
     *
     * Example usage:
     * <code>
     * $query->filterByPayload(1234); // WHERE payload = 1234
     * $query->filterByPayload(array(12, 34)); // WHERE payload IN (12, 34)
     * $query->filterByPayload(array('min' => 12)); // WHERE payload > 12
     * </code>
     *
     * @param     mixed $payload The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildvoipCodecQuery The current query, for fluid interface
     */
    public function filterByPayload($payload = null, $comparison = null)
    {
        if (is_array($payload)) {
            $useMinMax = false;
            if (isset($payload['min'])) {
                $this->addUsingAlias(voipCodecTableMap::COL_PAYLOAD, $payload['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($payload['max'])) {
                $this->addUsingAlias(voipCodecTableMap::COL_PAYLOAD, $payload['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(voipCodecTableMap::COL_PAYLOAD, $payload, $comparison);
    }

    /**
     * Filter the query on the bit_rate column
     *
     * Example usage:
     * <code>
     * $query->filterByBitRate(1234); // WHERE bit_rate = 1234
     * $query->filterByBitRate(array(12, 34)); // WHERE bit_rate IN (12, 34)
     * $query->filterByBitRate(array('min' => 12)); // WHERE bit_rate > 12
     * </code>
     *
     * @param     mixed $bitRate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildvoipCodecQuery The current query, for fluid interface
     */
    public function filterByBitRate($bitRate = null, $comparison = null)
    {
        if (is_array($bitRate)) {
            $useMinMax = false;
            if (isset($bitRate['min'])) {
                $this->addUsingAlias(voipCodecTableMap::COL_BIT_RATE, $bitRate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bitRate['max'])) {
                $this->addUsingAlias(voipCodecTableMap::COL_BIT_RATE, $bitRate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(voipCodecTableMap::COL_BIT_RATE, $bitRate, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildvoipCodec $voipCodec Object to remove from the list of results
     *
     * @return $this|ChildvoipCodecQuery The current query, for fluid interface
     */
    public function prune($voipCodec = null)
    {
        if ($voipCodec) {
            $this->addUsingAlias(voipCodecTableMap::COL_ID, $voipCodec->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the voipcodec table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(voipCodecTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            voipCodecTableMap::clearInstancePool();
            voipCodecTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(voipCodecTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(voipCodecTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            voipCodecTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            voipCodecTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // voipCodecQuery
