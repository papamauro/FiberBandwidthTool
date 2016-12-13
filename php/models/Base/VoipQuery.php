<?php

namespace Base;

use \Voip as ChildVoip;
use \VoipQuery as ChildVoipQuery;
use \Exception;
use \PDO;
use Map\VoipTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'voip' table.
 *
 *
 *
 * @method     ChildVoipQuery orderByVoidId($order = Criteria::ASC) Order by the void_id column
 * @method     ChildVoipQuery orderByUsoVoip($order = Criteria::ASC) Order by the uso_voip column
 * @method     ChildVoipQuery orderByTelefonateContemporanee($order = Criteria::ASC) Order by the telefonate_contemporanee column
 * @method     ChildVoipQuery orderByCodec($order = Criteria::ASC) Order by the codec column
 * @method     ChildVoipQuery orderByCompressedRtp($order = Criteria::ASC) Order by the compressed_rtp column
 * @method     ChildVoipQuery orderByL2Protocol($order = Criteria::ASC) Order by the l2_protocol column
 * @method     ChildVoipQuery orderByUpBandwidth($order = Criteria::ASC) Order by the up_bandwidth column
 * @method     ChildVoipQuery orderByDownBandwidth($order = Criteria::ASC) Order by the down_bandwidth column
 * @method     ChildVoipQuery orderByExtRid($order = Criteria::ASC) Order by the ext_rid column
 *
 * @method     ChildVoipQuery groupByVoidId() Group by the void_id column
 * @method     ChildVoipQuery groupByUsoVoip() Group by the uso_voip column
 * @method     ChildVoipQuery groupByTelefonateContemporanee() Group by the telefonate_contemporanee column
 * @method     ChildVoipQuery groupByCodec() Group by the codec column
 * @method     ChildVoipQuery groupByCompressedRtp() Group by the compressed_rtp column
 * @method     ChildVoipQuery groupByL2Protocol() Group by the l2_protocol column
 * @method     ChildVoipQuery groupByUpBandwidth() Group by the up_bandwidth column
 * @method     ChildVoipQuery groupByDownBandwidth() Group by the down_bandwidth column
 * @method     ChildVoipQuery groupByExtRid() Group by the ext_rid column
 *
 * @method     ChildVoipQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVoipQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVoipQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVoipQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVoipQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVoipQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVoipQuery leftJoinRequests($relationAlias = null) Adds a LEFT JOIN clause to the query using the Requests relation
 * @method     ChildVoipQuery rightJoinRequests($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Requests relation
 * @method     ChildVoipQuery innerJoinRequests($relationAlias = null) Adds a INNER JOIN clause to the query using the Requests relation
 *
 * @method     ChildVoipQuery joinWithRequests($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Requests relation
 *
 * @method     ChildVoipQuery leftJoinWithRequests() Adds a LEFT JOIN clause and with to the query using the Requests relation
 * @method     ChildVoipQuery rightJoinWithRequests() Adds a RIGHT JOIN clause and with to the query using the Requests relation
 * @method     ChildVoipQuery innerJoinWithRequests() Adds a INNER JOIN clause and with to the query using the Requests relation
 *
 * @method     \RequestsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVoip findOne(ConnectionInterface $con = null) Return the first ChildVoip matching the query
 * @method     ChildVoip findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVoip matching the query, or a new ChildVoip object populated from the query conditions when no match is found
 *
 * @method     ChildVoip findOneByVoidId(int $void_id) Return the first ChildVoip filtered by the void_id column
 * @method     ChildVoip findOneByUsoVoip(boolean $uso_voip) Return the first ChildVoip filtered by the uso_voip column
 * @method     ChildVoip findOneByTelefonateContemporanee(int $telefonate_contemporanee) Return the first ChildVoip filtered by the telefonate_contemporanee column
 * @method     ChildVoip findOneByCodec(int $codec) Return the first ChildVoip filtered by the codec column
 * @method     ChildVoip findOneByCompressedRtp(boolean $compressed_rtp) Return the first ChildVoip filtered by the compressed_rtp column
 * @method     ChildVoip findOneByL2Protocol(string $l2_protocol) Return the first ChildVoip filtered by the l2_protocol column
 * @method     ChildVoip findOneByUpBandwidth(int $up_bandwidth) Return the first ChildVoip filtered by the up_bandwidth column
 * @method     ChildVoip findOneByDownBandwidth(int $down_bandwidth) Return the first ChildVoip filtered by the down_bandwidth column
 * @method     ChildVoip findOneByExtRid(int $ext_rid) Return the first ChildVoip filtered by the ext_rid column *

 * @method     ChildVoip requirePk($key, ConnectionInterface $con = null) Return the ChildVoip by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVoip requireOne(ConnectionInterface $con = null) Return the first ChildVoip matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVoip requireOneByVoidId(int $void_id) Return the first ChildVoip filtered by the void_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVoip requireOneByUsoVoip(boolean $uso_voip) Return the first ChildVoip filtered by the uso_voip column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVoip requireOneByTelefonateContemporanee(int $telefonate_contemporanee) Return the first ChildVoip filtered by the telefonate_contemporanee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVoip requireOneByCodec(int $codec) Return the first ChildVoip filtered by the codec column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVoip requireOneByCompressedRtp(boolean $compressed_rtp) Return the first ChildVoip filtered by the compressed_rtp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVoip requireOneByL2Protocol(string $l2_protocol) Return the first ChildVoip filtered by the l2_protocol column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVoip requireOneByUpBandwidth(int $up_bandwidth) Return the first ChildVoip filtered by the up_bandwidth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVoip requireOneByDownBandwidth(int $down_bandwidth) Return the first ChildVoip filtered by the down_bandwidth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVoip requireOneByExtRid(int $ext_rid) Return the first ChildVoip filtered by the ext_rid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVoip[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVoip objects based on current ModelCriteria
 * @method     ChildVoip[]|ObjectCollection findByVoidId(int $void_id) Return ChildVoip objects filtered by the void_id column
 * @method     ChildVoip[]|ObjectCollection findByUsoVoip(boolean $uso_voip) Return ChildVoip objects filtered by the uso_voip column
 * @method     ChildVoip[]|ObjectCollection findByTelefonateContemporanee(int $telefonate_contemporanee) Return ChildVoip objects filtered by the telefonate_contemporanee column
 * @method     ChildVoip[]|ObjectCollection findByCodec(int $codec) Return ChildVoip objects filtered by the codec column
 * @method     ChildVoip[]|ObjectCollection findByCompressedRtp(boolean $compressed_rtp) Return ChildVoip objects filtered by the compressed_rtp column
 * @method     ChildVoip[]|ObjectCollection findByL2Protocol(string $l2_protocol) Return ChildVoip objects filtered by the l2_protocol column
 * @method     ChildVoip[]|ObjectCollection findByUpBandwidth(int $up_bandwidth) Return ChildVoip objects filtered by the up_bandwidth column
 * @method     ChildVoip[]|ObjectCollection findByDownBandwidth(int $down_bandwidth) Return ChildVoip objects filtered by the down_bandwidth column
 * @method     ChildVoip[]|ObjectCollection findByExtRid(int $ext_rid) Return ChildVoip objects filtered by the ext_rid column
 * @method     ChildVoip[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VoipQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\VoipQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Voip', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVoipQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVoipQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVoipQuery) {
            return $criteria;
        }
        $query = new ChildVoipQuery();
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
     * @return ChildVoip|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VoipTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VoipTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildVoip A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT void_id, uso_voip, telefonate_contemporanee, codec, compressed_rtp, l2_protocol, up_bandwidth, down_bandwidth, ext_rid FROM voip WHERE void_id = :p0';
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
            /** @var ChildVoip $obj */
            $obj = new ChildVoip();
            $obj->hydrate($row);
            VoipTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildVoip|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildVoipQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VoipTableMap::COL_VOID_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVoipQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VoipTableMap::COL_VOID_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the void_id column
     *
     * Example usage:
     * <code>
     * $query->filterByVoidId(1234); // WHERE void_id = 1234
     * $query->filterByVoidId(array(12, 34)); // WHERE void_id IN (12, 34)
     * $query->filterByVoidId(array('min' => 12)); // WHERE void_id > 12
     * </code>
     *
     * @param     mixed $voidId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVoipQuery The current query, for fluid interface
     */
    public function filterByVoidId($voidId = null, $comparison = null)
    {
        if (is_array($voidId)) {
            $useMinMax = false;
            if (isset($voidId['min'])) {
                $this->addUsingAlias(VoipTableMap::COL_VOID_ID, $voidId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($voidId['max'])) {
                $this->addUsingAlias(VoipTableMap::COL_VOID_ID, $voidId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VoipTableMap::COL_VOID_ID, $voidId, $comparison);
    }

    /**
     * Filter the query on the uso_voip column
     *
     * Example usage:
     * <code>
     * $query->filterByUsoVoip(true); // WHERE uso_voip = true
     * $query->filterByUsoVoip('yes'); // WHERE uso_voip = true
     * </code>
     *
     * @param     boolean|string $usoVoip The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVoipQuery The current query, for fluid interface
     */
    public function filterByUsoVoip($usoVoip = null, $comparison = null)
    {
        if (is_string($usoVoip)) {
            $usoVoip = in_array(strtolower($usoVoip), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(VoipTableMap::COL_USO_VOIP, $usoVoip, $comparison);
    }

    /**
     * Filter the query on the telefonate_contemporanee column
     *
     * Example usage:
     * <code>
     * $query->filterByTelefonateContemporanee(1234); // WHERE telefonate_contemporanee = 1234
     * $query->filterByTelefonateContemporanee(array(12, 34)); // WHERE telefonate_contemporanee IN (12, 34)
     * $query->filterByTelefonateContemporanee(array('min' => 12)); // WHERE telefonate_contemporanee > 12
     * </code>
     *
     * @param     mixed $telefonateContemporanee The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVoipQuery The current query, for fluid interface
     */
    public function filterByTelefonateContemporanee($telefonateContemporanee = null, $comparison = null)
    {
        if (is_array($telefonateContemporanee)) {
            $useMinMax = false;
            if (isset($telefonateContemporanee['min'])) {
                $this->addUsingAlias(VoipTableMap::COL_TELEFONATE_CONTEMPORANEE, $telefonateContemporanee['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($telefonateContemporanee['max'])) {
                $this->addUsingAlias(VoipTableMap::COL_TELEFONATE_CONTEMPORANEE, $telefonateContemporanee['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VoipTableMap::COL_TELEFONATE_CONTEMPORANEE, $telefonateContemporanee, $comparison);
    }

    /**
     * Filter the query on the codec column
     *
     * Example usage:
     * <code>
     * $query->filterByCodec(1234); // WHERE codec = 1234
     * $query->filterByCodec(array(12, 34)); // WHERE codec IN (12, 34)
     * $query->filterByCodec(array('min' => 12)); // WHERE codec > 12
     * </code>
     *
     * @param     mixed $codec The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVoipQuery The current query, for fluid interface
     */
    public function filterByCodec($codec = null, $comparison = null)
    {
        if (is_array($codec)) {
            $useMinMax = false;
            if (isset($codec['min'])) {
                $this->addUsingAlias(VoipTableMap::COL_CODEC, $codec['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($codec['max'])) {
                $this->addUsingAlias(VoipTableMap::COL_CODEC, $codec['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VoipTableMap::COL_CODEC, $codec, $comparison);
    }

    /**
     * Filter the query on the compressed_rtp column
     *
     * Example usage:
     * <code>
     * $query->filterByCompressedRtp(true); // WHERE compressed_rtp = true
     * $query->filterByCompressedRtp('yes'); // WHERE compressed_rtp = true
     * </code>
     *
     * @param     boolean|string $compressedRtp The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVoipQuery The current query, for fluid interface
     */
    public function filterByCompressedRtp($compressedRtp = null, $comparison = null)
    {
        if (is_string($compressedRtp)) {
            $compressedRtp = in_array(strtolower($compressedRtp), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(VoipTableMap::COL_COMPRESSED_RTP, $compressedRtp, $comparison);
    }

    /**
     * Filter the query on the l2_protocol column
     *
     * Example usage:
     * <code>
     * $query->filterByL2Protocol('fooValue');   // WHERE l2_protocol = 'fooValue'
     * $query->filterByL2Protocol('%fooValue%', Criteria::LIKE); // WHERE l2_protocol LIKE '%fooValue%'
     * </code>
     *
     * @param     string $l2Protocol The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVoipQuery The current query, for fluid interface
     */
    public function filterByL2Protocol($l2Protocol = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($l2Protocol)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VoipTableMap::COL_L2_PROTOCOL, $l2Protocol, $comparison);
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
     * @return $this|ChildVoipQuery The current query, for fluid interface
     */
    public function filterByUpBandwidth($upBandwidth = null, $comparison = null)
    {
        if (is_array($upBandwidth)) {
            $useMinMax = false;
            if (isset($upBandwidth['min'])) {
                $this->addUsingAlias(VoipTableMap::COL_UP_BANDWIDTH, $upBandwidth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upBandwidth['max'])) {
                $this->addUsingAlias(VoipTableMap::COL_UP_BANDWIDTH, $upBandwidth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VoipTableMap::COL_UP_BANDWIDTH, $upBandwidth, $comparison);
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
     * @return $this|ChildVoipQuery The current query, for fluid interface
     */
    public function filterByDownBandwidth($downBandwidth = null, $comparison = null)
    {
        if (is_array($downBandwidth)) {
            $useMinMax = false;
            if (isset($downBandwidth['min'])) {
                $this->addUsingAlias(VoipTableMap::COL_DOWN_BANDWIDTH, $downBandwidth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($downBandwidth['max'])) {
                $this->addUsingAlias(VoipTableMap::COL_DOWN_BANDWIDTH, $downBandwidth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VoipTableMap::COL_DOWN_BANDWIDTH, $downBandwidth, $comparison);
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
     * @return $this|ChildVoipQuery The current query, for fluid interface
     */
    public function filterByExtRid($extRid = null, $comparison = null)
    {
        if (is_array($extRid)) {
            $useMinMax = false;
            if (isset($extRid['min'])) {
                $this->addUsingAlias(VoipTableMap::COL_EXT_RID, $extRid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($extRid['max'])) {
                $this->addUsingAlias(VoipTableMap::COL_EXT_RID, $extRid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VoipTableMap::COL_EXT_RID, $extRid, $comparison);
    }

    /**
     * Filter the query by a related \Requests object
     *
     * @param \Requests|ObjectCollection $requests The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVoipQuery The current query, for fluid interface
     */
    public function filterByRequests($requests, $comparison = null)
    {
        if ($requests instanceof \Requests) {
            return $this
                ->addUsingAlias(VoipTableMap::COL_EXT_RID, $requests->getRid(), $comparison);
        } elseif ($requests instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VoipTableMap::COL_EXT_RID, $requests->toKeyValue('PrimaryKey', 'Rid'), $comparison);
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
     * @return $this|ChildVoipQuery The current query, for fluid interface
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
     * @param   ChildVoip $voip Object to remove from the list of results
     *
     * @return $this|ChildVoipQuery The current query, for fluid interface
     */
    public function prune($voip = null)
    {
        if ($voip) {
            $this->addUsingAlias(VoipTableMap::COL_VOID_ID, $voip->getVoidId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the voip table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VoipTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VoipTableMap::clearInstancePool();
            VoipTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VoipTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VoipTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VoipTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VoipTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // VoipQuery
