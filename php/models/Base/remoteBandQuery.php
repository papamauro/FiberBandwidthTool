<?php

namespace Base;

use \remoteBand as ChildremoteBand;
use \remoteBandQuery as ChildremoteBandQuery;
use \Exception;
use \PDO;
use Map\remoteBandTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'remoteband' table.
 *
 *
 *
 * @method     ChildremoteBandQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildremoteBandQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildremoteBandQuery orderByOffice($order = Criteria::ASC) Order by the office column
 * @method     ChildremoteBandQuery orderByInternet($order = Criteria::ASC) Order by the internet column
 * @method     ChildremoteBandQuery orderByPrinting($order = Criteria::ASC) Order by the printing column
 * @method     ChildremoteBandQuery orderBySdVideo($order = Criteria::ASC) Order by the sd_video column
 * @method     ChildremoteBandQuery orderByHdVideo($order = Criteria::ASC) Order by the hd_video column
 *
 * @method     ChildremoteBandQuery groupById() Group by the id column
 * @method     ChildremoteBandQuery groupByName() Group by the name column
 * @method     ChildremoteBandQuery groupByOffice() Group by the office column
 * @method     ChildremoteBandQuery groupByInternet() Group by the internet column
 * @method     ChildremoteBandQuery groupByPrinting() Group by the printing column
 * @method     ChildremoteBandQuery groupBySdVideo() Group by the sd_video column
 * @method     ChildremoteBandQuery groupByHdVideo() Group by the hd_video column
 *
 * @method     ChildremoteBandQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildremoteBandQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildremoteBandQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildremoteBandQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildremoteBandQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildremoteBandQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildremoteBand findOne(ConnectionInterface $con = null) Return the first ChildremoteBand matching the query
 * @method     ChildremoteBand findOneOrCreate(ConnectionInterface $con = null) Return the first ChildremoteBand matching the query, or a new ChildremoteBand object populated from the query conditions when no match is found
 *
 * @method     ChildremoteBand findOneById(int $id) Return the first ChildremoteBand filtered by the id column
 * @method     ChildremoteBand findOneByName(string $name) Return the first ChildremoteBand filtered by the name column
 * @method     ChildremoteBand findOneByOffice(int $office) Return the first ChildremoteBand filtered by the office column
 * @method     ChildremoteBand findOneByInternet(int $internet) Return the first ChildremoteBand filtered by the internet column
 * @method     ChildremoteBand findOneByPrinting(int $printing) Return the first ChildremoteBand filtered by the printing column
 * @method     ChildremoteBand findOneBySdVideo(int $sd_video) Return the first ChildremoteBand filtered by the sd_video column
 * @method     ChildremoteBand findOneByHdVideo(int $hd_video) Return the first ChildremoteBand filtered by the hd_video column *

 * @method     ChildremoteBand requirePk($key, ConnectionInterface $con = null) Return the ChildremoteBand by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildremoteBand requireOne(ConnectionInterface $con = null) Return the first ChildremoteBand matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildremoteBand requireOneById(int $id) Return the first ChildremoteBand filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildremoteBand requireOneByName(string $name) Return the first ChildremoteBand filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildremoteBand requireOneByOffice(int $office) Return the first ChildremoteBand filtered by the office column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildremoteBand requireOneByInternet(int $internet) Return the first ChildremoteBand filtered by the internet column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildremoteBand requireOneByPrinting(int $printing) Return the first ChildremoteBand filtered by the printing column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildremoteBand requireOneBySdVideo(int $sd_video) Return the first ChildremoteBand filtered by the sd_video column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildremoteBand requireOneByHdVideo(int $hd_video) Return the first ChildremoteBand filtered by the hd_video column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildremoteBand[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildremoteBand objects based on current ModelCriteria
 * @method     ChildremoteBand[]|ObjectCollection findById(int $id) Return ChildremoteBand objects filtered by the id column
 * @method     ChildremoteBand[]|ObjectCollection findByName(string $name) Return ChildremoteBand objects filtered by the name column
 * @method     ChildremoteBand[]|ObjectCollection findByOffice(int $office) Return ChildremoteBand objects filtered by the office column
 * @method     ChildremoteBand[]|ObjectCollection findByInternet(int $internet) Return ChildremoteBand objects filtered by the internet column
 * @method     ChildremoteBand[]|ObjectCollection findByPrinting(int $printing) Return ChildremoteBand objects filtered by the printing column
 * @method     ChildremoteBand[]|ObjectCollection findBySdVideo(int $sd_video) Return ChildremoteBand objects filtered by the sd_video column
 * @method     ChildremoteBand[]|ObjectCollection findByHdVideo(int $hd_video) Return ChildremoteBand objects filtered by the hd_video column
 * @method     ChildremoteBand[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class remoteBandQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\remoteBandQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\remoteBand', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildremoteBandQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildremoteBandQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildremoteBandQuery) {
            return $criteria;
        }
        $query = new ChildremoteBandQuery();
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
     * @return ChildremoteBand|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(remoteBandTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = remoteBandTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildremoteBand A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, office, internet, printing, sd_video, hd_video FROM remoteband WHERE id = :p0';
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
            /** @var ChildremoteBand $obj */
            $obj = new ChildremoteBand();
            $obj->hydrate($row);
            remoteBandTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildremoteBand|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildremoteBandQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(remoteBandTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildremoteBandQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(remoteBandTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildremoteBandQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(remoteBandTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(remoteBandTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(remoteBandTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildremoteBandQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(remoteBandTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the office column
     *
     * Example usage:
     * <code>
     * $query->filterByOffice(1234); // WHERE office = 1234
     * $query->filterByOffice(array(12, 34)); // WHERE office IN (12, 34)
     * $query->filterByOffice(array('min' => 12)); // WHERE office > 12
     * </code>
     *
     * @param     mixed $office The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildremoteBandQuery The current query, for fluid interface
     */
    public function filterByOffice($office = null, $comparison = null)
    {
        if (is_array($office)) {
            $useMinMax = false;
            if (isset($office['min'])) {
                $this->addUsingAlias(remoteBandTableMap::COL_OFFICE, $office['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($office['max'])) {
                $this->addUsingAlias(remoteBandTableMap::COL_OFFICE, $office['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(remoteBandTableMap::COL_OFFICE, $office, $comparison);
    }

    /**
     * Filter the query on the internet column
     *
     * Example usage:
     * <code>
     * $query->filterByInternet(1234); // WHERE internet = 1234
     * $query->filterByInternet(array(12, 34)); // WHERE internet IN (12, 34)
     * $query->filterByInternet(array('min' => 12)); // WHERE internet > 12
     * </code>
     *
     * @param     mixed $internet The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildremoteBandQuery The current query, for fluid interface
     */
    public function filterByInternet($internet = null, $comparison = null)
    {
        if (is_array($internet)) {
            $useMinMax = false;
            if (isset($internet['min'])) {
                $this->addUsingAlias(remoteBandTableMap::COL_INTERNET, $internet['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($internet['max'])) {
                $this->addUsingAlias(remoteBandTableMap::COL_INTERNET, $internet['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(remoteBandTableMap::COL_INTERNET, $internet, $comparison);
    }

    /**
     * Filter the query on the printing column
     *
     * Example usage:
     * <code>
     * $query->filterByPrinting(1234); // WHERE printing = 1234
     * $query->filterByPrinting(array(12, 34)); // WHERE printing IN (12, 34)
     * $query->filterByPrinting(array('min' => 12)); // WHERE printing > 12
     * </code>
     *
     * @param     mixed $printing The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildremoteBandQuery The current query, for fluid interface
     */
    public function filterByPrinting($printing = null, $comparison = null)
    {
        if (is_array($printing)) {
            $useMinMax = false;
            if (isset($printing['min'])) {
                $this->addUsingAlias(remoteBandTableMap::COL_PRINTING, $printing['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($printing['max'])) {
                $this->addUsingAlias(remoteBandTableMap::COL_PRINTING, $printing['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(remoteBandTableMap::COL_PRINTING, $printing, $comparison);
    }

    /**
     * Filter the query on the sd_video column
     *
     * Example usage:
     * <code>
     * $query->filterBySdVideo(1234); // WHERE sd_video = 1234
     * $query->filterBySdVideo(array(12, 34)); // WHERE sd_video IN (12, 34)
     * $query->filterBySdVideo(array('min' => 12)); // WHERE sd_video > 12
     * </code>
     *
     * @param     mixed $sdVideo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildremoteBandQuery The current query, for fluid interface
     */
    public function filterBySdVideo($sdVideo = null, $comparison = null)
    {
        if (is_array($sdVideo)) {
            $useMinMax = false;
            if (isset($sdVideo['min'])) {
                $this->addUsingAlias(remoteBandTableMap::COL_SD_VIDEO, $sdVideo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sdVideo['max'])) {
                $this->addUsingAlias(remoteBandTableMap::COL_SD_VIDEO, $sdVideo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(remoteBandTableMap::COL_SD_VIDEO, $sdVideo, $comparison);
    }

    /**
     * Filter the query on the hd_video column
     *
     * Example usage:
     * <code>
     * $query->filterByHdVideo(1234); // WHERE hd_video = 1234
     * $query->filterByHdVideo(array(12, 34)); // WHERE hd_video IN (12, 34)
     * $query->filterByHdVideo(array('min' => 12)); // WHERE hd_video > 12
     * </code>
     *
     * @param     mixed $hdVideo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildremoteBandQuery The current query, for fluid interface
     */
    public function filterByHdVideo($hdVideo = null, $comparison = null)
    {
        if (is_array($hdVideo)) {
            $useMinMax = false;
            if (isset($hdVideo['min'])) {
                $this->addUsingAlias(remoteBandTableMap::COL_HD_VIDEO, $hdVideo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hdVideo['max'])) {
                $this->addUsingAlias(remoteBandTableMap::COL_HD_VIDEO, $hdVideo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(remoteBandTableMap::COL_HD_VIDEO, $hdVideo, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildremoteBand $remoteBand Object to remove from the list of results
     *
     * @return $this|ChildremoteBandQuery The current query, for fluid interface
     */
    public function prune($remoteBand = null)
    {
        if ($remoteBand) {
            $this->addUsingAlias(remoteBandTableMap::COL_ID, $remoteBand->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the remoteband table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(remoteBandTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            remoteBandTableMap::clearInstancePool();
            remoteBandTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(remoteBandTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(remoteBandTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            remoteBandTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            remoteBandTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // remoteBandQuery
