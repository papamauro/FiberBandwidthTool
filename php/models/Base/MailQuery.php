<?php

namespace Base;

use \Mail as ChildMail;
use \MailQuery as ChildMailQuery;
use \Exception;
use \PDO;
use Map\MailTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'mail' table.
 *
 *
 *
 * @method     ChildMailQuery orderByMailId($order = Criteria::ASC) Order by the mail_id column
 * @method     ChildMailQuery orderByInternalMailServer($order = Criteria::ASC) Order by the internal_mail_server column
 * @method     ChildMailQuery orderByMailCount($order = Criteria::ASC) Order by the mail_count column
 * @method     ChildMailQuery orderBySendMailLatency($order = Criteria::ASC) Order by the send_mail_latency column
 * @method     ChildMailQuery orderByReceiveMailLatency($order = Criteria::ASC) Order by the receive_mail_latency column
 * @method     ChildMailQuery orderByAverageReceivedMail($order = Criteria::ASC) Order by the average_received_mail column
 * @method     ChildMailQuery orderByAverageSendedMail($order = Criteria::ASC) Order by the average_sended_mail column
 * @method     ChildMailQuery orderByMailSize($order = Criteria::ASC) Order by the mail_size column
 * @method     ChildMailQuery orderByUpBandwidth($order = Criteria::ASC) Order by the up_bandwidth column
 * @method     ChildMailQuery orderByDownBandwidth($order = Criteria::ASC) Order by the down_bandwidth column
 * @method     ChildMailQuery orderByExtRid($order = Criteria::ASC) Order by the ext_rid column
 *
 * @method     ChildMailQuery groupByMailId() Group by the mail_id column
 * @method     ChildMailQuery groupByInternalMailServer() Group by the internal_mail_server column
 * @method     ChildMailQuery groupByMailCount() Group by the mail_count column
 * @method     ChildMailQuery groupBySendMailLatency() Group by the send_mail_latency column
 * @method     ChildMailQuery groupByReceiveMailLatency() Group by the receive_mail_latency column
 * @method     ChildMailQuery groupByAverageReceivedMail() Group by the average_received_mail column
 * @method     ChildMailQuery groupByAverageSendedMail() Group by the average_sended_mail column
 * @method     ChildMailQuery groupByMailSize() Group by the mail_size column
 * @method     ChildMailQuery groupByUpBandwidth() Group by the up_bandwidth column
 * @method     ChildMailQuery groupByDownBandwidth() Group by the down_bandwidth column
 * @method     ChildMailQuery groupByExtRid() Group by the ext_rid column
 *
 * @method     ChildMailQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMailQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMailQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMailQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMailQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMailQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMailQuery leftJoinRequests($relationAlias = null) Adds a LEFT JOIN clause to the query using the Requests relation
 * @method     ChildMailQuery rightJoinRequests($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Requests relation
 * @method     ChildMailQuery innerJoinRequests($relationAlias = null) Adds a INNER JOIN clause to the query using the Requests relation
 *
 * @method     ChildMailQuery joinWithRequests($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Requests relation
 *
 * @method     ChildMailQuery leftJoinWithRequests() Adds a LEFT JOIN clause and with to the query using the Requests relation
 * @method     ChildMailQuery rightJoinWithRequests() Adds a RIGHT JOIN clause and with to the query using the Requests relation
 * @method     ChildMailQuery innerJoinWithRequests() Adds a INNER JOIN clause and with to the query using the Requests relation
 *
 * @method     \RequestsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMail findOne(ConnectionInterface $con = null) Return the first ChildMail matching the query
 * @method     ChildMail findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMail matching the query, or a new ChildMail object populated from the query conditions when no match is found
 *
 * @method     ChildMail findOneByMailId(int $mail_id) Return the first ChildMail filtered by the mail_id column
 * @method     ChildMail findOneByInternalMailServer(boolean $internal_mail_server) Return the first ChildMail filtered by the internal_mail_server column
 * @method     ChildMail findOneByMailCount(int $mail_count) Return the first ChildMail filtered by the mail_count column
 * @method     ChildMail findOneBySendMailLatency(int $send_mail_latency) Return the first ChildMail filtered by the send_mail_latency column
 * @method     ChildMail findOneByReceiveMailLatency(int $receive_mail_latency) Return the first ChildMail filtered by the receive_mail_latency column
 * @method     ChildMail findOneByAverageReceivedMail(int $average_received_mail) Return the first ChildMail filtered by the average_received_mail column
 * @method     ChildMail findOneByAverageSendedMail(int $average_sended_mail) Return the first ChildMail filtered by the average_sended_mail column
 * @method     ChildMail findOneByMailSize(int $mail_size) Return the first ChildMail filtered by the mail_size column
 * @method     ChildMail findOneByUpBandwidth(int $up_bandwidth) Return the first ChildMail filtered by the up_bandwidth column
 * @method     ChildMail findOneByDownBandwidth(int $down_bandwidth) Return the first ChildMail filtered by the down_bandwidth column
 * @method     ChildMail findOneByExtRid(int $ext_rid) Return the first ChildMail filtered by the ext_rid column *

 * @method     ChildMail requirePk($key, ConnectionInterface $con = null) Return the ChildMail by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMail requireOne(ConnectionInterface $con = null) Return the first ChildMail matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMail requireOneByMailId(int $mail_id) Return the first ChildMail filtered by the mail_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMail requireOneByInternalMailServer(boolean $internal_mail_server) Return the first ChildMail filtered by the internal_mail_server column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMail requireOneByMailCount(int $mail_count) Return the first ChildMail filtered by the mail_count column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMail requireOneBySendMailLatency(int $send_mail_latency) Return the first ChildMail filtered by the send_mail_latency column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMail requireOneByReceiveMailLatency(int $receive_mail_latency) Return the first ChildMail filtered by the receive_mail_latency column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMail requireOneByAverageReceivedMail(int $average_received_mail) Return the first ChildMail filtered by the average_received_mail column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMail requireOneByAverageSendedMail(int $average_sended_mail) Return the first ChildMail filtered by the average_sended_mail column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMail requireOneByMailSize(int $mail_size) Return the first ChildMail filtered by the mail_size column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMail requireOneByUpBandwidth(int $up_bandwidth) Return the first ChildMail filtered by the up_bandwidth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMail requireOneByDownBandwidth(int $down_bandwidth) Return the first ChildMail filtered by the down_bandwidth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMail requireOneByExtRid(int $ext_rid) Return the first ChildMail filtered by the ext_rid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMail[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMail objects based on current ModelCriteria
 * @method     ChildMail[]|ObjectCollection findByMailId(int $mail_id) Return ChildMail objects filtered by the mail_id column
 * @method     ChildMail[]|ObjectCollection findByInternalMailServer(boolean $internal_mail_server) Return ChildMail objects filtered by the internal_mail_server column
 * @method     ChildMail[]|ObjectCollection findByMailCount(int $mail_count) Return ChildMail objects filtered by the mail_count column
 * @method     ChildMail[]|ObjectCollection findBySendMailLatency(int $send_mail_latency) Return ChildMail objects filtered by the send_mail_latency column
 * @method     ChildMail[]|ObjectCollection findByReceiveMailLatency(int $receive_mail_latency) Return ChildMail objects filtered by the receive_mail_latency column
 * @method     ChildMail[]|ObjectCollection findByAverageReceivedMail(int $average_received_mail) Return ChildMail objects filtered by the average_received_mail column
 * @method     ChildMail[]|ObjectCollection findByAverageSendedMail(int $average_sended_mail) Return ChildMail objects filtered by the average_sended_mail column
 * @method     ChildMail[]|ObjectCollection findByMailSize(int $mail_size) Return ChildMail objects filtered by the mail_size column
 * @method     ChildMail[]|ObjectCollection findByUpBandwidth(int $up_bandwidth) Return ChildMail objects filtered by the up_bandwidth column
 * @method     ChildMail[]|ObjectCollection findByDownBandwidth(int $down_bandwidth) Return ChildMail objects filtered by the down_bandwidth column
 * @method     ChildMail[]|ObjectCollection findByExtRid(int $ext_rid) Return ChildMail objects filtered by the ext_rid column
 * @method     ChildMail[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MailQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\MailQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Mail', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMailQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMailQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMailQuery) {
            return $criteria;
        }
        $query = new ChildMailQuery();
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
     * @return ChildMail|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MailTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MailTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildMail A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT mail_id, internal_mail_server, mail_count, send_mail_latency, receive_mail_latency, average_received_mail, average_sended_mail, mail_size, up_bandwidth, down_bandwidth, ext_rid FROM mail WHERE mail_id = :p0';
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
            /** @var ChildMail $obj */
            $obj = new ChildMail();
            $obj->hydrate($row);
            MailTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildMail|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MailTableMap::COL_MAIL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MailTableMap::COL_MAIL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the mail_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMailId(1234); // WHERE mail_id = 1234
     * $query->filterByMailId(array(12, 34)); // WHERE mail_id IN (12, 34)
     * $query->filterByMailId(array('min' => 12)); // WHERE mail_id > 12
     * </code>
     *
     * @param     mixed $mailId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterByMailId($mailId = null, $comparison = null)
    {
        if (is_array($mailId)) {
            $useMinMax = false;
            if (isset($mailId['min'])) {
                $this->addUsingAlias(MailTableMap::COL_MAIL_ID, $mailId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mailId['max'])) {
                $this->addUsingAlias(MailTableMap::COL_MAIL_ID, $mailId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MailTableMap::COL_MAIL_ID, $mailId, $comparison);
    }

    /**
     * Filter the query on the internal_mail_server column
     *
     * Example usage:
     * <code>
     * $query->filterByInternalMailServer(true); // WHERE internal_mail_server = true
     * $query->filterByInternalMailServer('yes'); // WHERE internal_mail_server = true
     * </code>
     *
     * @param     boolean|string $internalMailServer The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterByInternalMailServer($internalMailServer = null, $comparison = null)
    {
        if (is_string($internalMailServer)) {
            $internalMailServer = in_array(strtolower($internalMailServer), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(MailTableMap::COL_INTERNAL_MAIL_SERVER, $internalMailServer, $comparison);
    }

    /**
     * Filter the query on the mail_count column
     *
     * Example usage:
     * <code>
     * $query->filterByMailCount(1234); // WHERE mail_count = 1234
     * $query->filterByMailCount(array(12, 34)); // WHERE mail_count IN (12, 34)
     * $query->filterByMailCount(array('min' => 12)); // WHERE mail_count > 12
     * </code>
     *
     * @param     mixed $mailCount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterByMailCount($mailCount = null, $comparison = null)
    {
        if (is_array($mailCount)) {
            $useMinMax = false;
            if (isset($mailCount['min'])) {
                $this->addUsingAlias(MailTableMap::COL_MAIL_COUNT, $mailCount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mailCount['max'])) {
                $this->addUsingAlias(MailTableMap::COL_MAIL_COUNT, $mailCount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MailTableMap::COL_MAIL_COUNT, $mailCount, $comparison);
    }

    /**
     * Filter the query on the send_mail_latency column
     *
     * Example usage:
     * <code>
     * $query->filterBySendMailLatency(1234); // WHERE send_mail_latency = 1234
     * $query->filterBySendMailLatency(array(12, 34)); // WHERE send_mail_latency IN (12, 34)
     * $query->filterBySendMailLatency(array('min' => 12)); // WHERE send_mail_latency > 12
     * </code>
     *
     * @param     mixed $sendMailLatency The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterBySendMailLatency($sendMailLatency = null, $comparison = null)
    {
        if (is_array($sendMailLatency)) {
            $useMinMax = false;
            if (isset($sendMailLatency['min'])) {
                $this->addUsingAlias(MailTableMap::COL_SEND_MAIL_LATENCY, $sendMailLatency['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sendMailLatency['max'])) {
                $this->addUsingAlias(MailTableMap::COL_SEND_MAIL_LATENCY, $sendMailLatency['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MailTableMap::COL_SEND_MAIL_LATENCY, $sendMailLatency, $comparison);
    }

    /**
     * Filter the query on the receive_mail_latency column
     *
     * Example usage:
     * <code>
     * $query->filterByReceiveMailLatency(1234); // WHERE receive_mail_latency = 1234
     * $query->filterByReceiveMailLatency(array(12, 34)); // WHERE receive_mail_latency IN (12, 34)
     * $query->filterByReceiveMailLatency(array('min' => 12)); // WHERE receive_mail_latency > 12
     * </code>
     *
     * @param     mixed $receiveMailLatency The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterByReceiveMailLatency($receiveMailLatency = null, $comparison = null)
    {
        if (is_array($receiveMailLatency)) {
            $useMinMax = false;
            if (isset($receiveMailLatency['min'])) {
                $this->addUsingAlias(MailTableMap::COL_RECEIVE_MAIL_LATENCY, $receiveMailLatency['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($receiveMailLatency['max'])) {
                $this->addUsingAlias(MailTableMap::COL_RECEIVE_MAIL_LATENCY, $receiveMailLatency['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MailTableMap::COL_RECEIVE_MAIL_LATENCY, $receiveMailLatency, $comparison);
    }

    /**
     * Filter the query on the average_received_mail column
     *
     * Example usage:
     * <code>
     * $query->filterByAverageReceivedMail(1234); // WHERE average_received_mail = 1234
     * $query->filterByAverageReceivedMail(array(12, 34)); // WHERE average_received_mail IN (12, 34)
     * $query->filterByAverageReceivedMail(array('min' => 12)); // WHERE average_received_mail > 12
     * </code>
     *
     * @param     mixed $averageReceivedMail The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterByAverageReceivedMail($averageReceivedMail = null, $comparison = null)
    {
        if (is_array($averageReceivedMail)) {
            $useMinMax = false;
            if (isset($averageReceivedMail['min'])) {
                $this->addUsingAlias(MailTableMap::COL_AVERAGE_RECEIVED_MAIL, $averageReceivedMail['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($averageReceivedMail['max'])) {
                $this->addUsingAlias(MailTableMap::COL_AVERAGE_RECEIVED_MAIL, $averageReceivedMail['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MailTableMap::COL_AVERAGE_RECEIVED_MAIL, $averageReceivedMail, $comparison);
    }

    /**
     * Filter the query on the average_sended_mail column
     *
     * Example usage:
     * <code>
     * $query->filterByAverageSendedMail(1234); // WHERE average_sended_mail = 1234
     * $query->filterByAverageSendedMail(array(12, 34)); // WHERE average_sended_mail IN (12, 34)
     * $query->filterByAverageSendedMail(array('min' => 12)); // WHERE average_sended_mail > 12
     * </code>
     *
     * @param     mixed $averageSendedMail The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterByAverageSendedMail($averageSendedMail = null, $comparison = null)
    {
        if (is_array($averageSendedMail)) {
            $useMinMax = false;
            if (isset($averageSendedMail['min'])) {
                $this->addUsingAlias(MailTableMap::COL_AVERAGE_SENDED_MAIL, $averageSendedMail['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($averageSendedMail['max'])) {
                $this->addUsingAlias(MailTableMap::COL_AVERAGE_SENDED_MAIL, $averageSendedMail['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MailTableMap::COL_AVERAGE_SENDED_MAIL, $averageSendedMail, $comparison);
    }

    /**
     * Filter the query on the mail_size column
     *
     * Example usage:
     * <code>
     * $query->filterByMailSize(1234); // WHERE mail_size = 1234
     * $query->filterByMailSize(array(12, 34)); // WHERE mail_size IN (12, 34)
     * $query->filterByMailSize(array('min' => 12)); // WHERE mail_size > 12
     * </code>
     *
     * @param     mixed $mailSize The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterByMailSize($mailSize = null, $comparison = null)
    {
        if (is_array($mailSize)) {
            $useMinMax = false;
            if (isset($mailSize['min'])) {
                $this->addUsingAlias(MailTableMap::COL_MAIL_SIZE, $mailSize['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mailSize['max'])) {
                $this->addUsingAlias(MailTableMap::COL_MAIL_SIZE, $mailSize['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MailTableMap::COL_MAIL_SIZE, $mailSize, $comparison);
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
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterByUpBandwidth($upBandwidth = null, $comparison = null)
    {
        if (is_array($upBandwidth)) {
            $useMinMax = false;
            if (isset($upBandwidth['min'])) {
                $this->addUsingAlias(MailTableMap::COL_UP_BANDWIDTH, $upBandwidth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upBandwidth['max'])) {
                $this->addUsingAlias(MailTableMap::COL_UP_BANDWIDTH, $upBandwidth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MailTableMap::COL_UP_BANDWIDTH, $upBandwidth, $comparison);
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
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterByDownBandwidth($downBandwidth = null, $comparison = null)
    {
        if (is_array($downBandwidth)) {
            $useMinMax = false;
            if (isset($downBandwidth['min'])) {
                $this->addUsingAlias(MailTableMap::COL_DOWN_BANDWIDTH, $downBandwidth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($downBandwidth['max'])) {
                $this->addUsingAlias(MailTableMap::COL_DOWN_BANDWIDTH, $downBandwidth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MailTableMap::COL_DOWN_BANDWIDTH, $downBandwidth, $comparison);
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
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterByExtRid($extRid = null, $comparison = null)
    {
        if (is_array($extRid)) {
            $useMinMax = false;
            if (isset($extRid['min'])) {
                $this->addUsingAlias(MailTableMap::COL_EXT_RID, $extRid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($extRid['max'])) {
                $this->addUsingAlias(MailTableMap::COL_EXT_RID, $extRid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MailTableMap::COL_EXT_RID, $extRid, $comparison);
    }

    /**
     * Filter the query by a related \Requests object
     *
     * @param \Requests|ObjectCollection $requests The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMailQuery The current query, for fluid interface
     */
    public function filterByRequests($requests, $comparison = null)
    {
        if ($requests instanceof \Requests) {
            return $this
                ->addUsingAlias(MailTableMap::COL_EXT_RID, $requests->getRid(), $comparison);
        } elseif ($requests instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MailTableMap::COL_EXT_RID, $requests->toKeyValue('PrimaryKey', 'Rid'), $comparison);
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
     * @return $this|ChildMailQuery The current query, for fluid interface
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
     * @param   ChildMail $mail Object to remove from the list of results
     *
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function prune($mail = null)
    {
        if ($mail) {
            $this->addUsingAlias(MailTableMap::COL_MAIL_ID, $mail->getMailId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the mail table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MailTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MailTableMap::clearInstancePool();
            MailTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MailTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MailTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MailTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MailTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MailQuery
