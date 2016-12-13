<?php

namespace Base;

use \MailQuery as ChildMailQuery;
use \Requests as ChildRequests;
use \RequestsQuery as ChildRequestsQuery;
use \Exception;
use \PDO;
use Map\MailTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'mail' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Mail implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\MailTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the mail_id field.
     *
     * @var        int
     */
    protected $mail_id;

    /**
     * The value for the internal_mail_server field.
     *
     * @var        boolean
     */
    protected $internal_mail_server;

    /**
     * The value for the mail_count field.
     *
     * @var        int
     */
    protected $mail_count;

    /**
     * The value for the send_mail_latency field.
     *
     * @var        int
     */
    protected $send_mail_latency;

    /**
     * The value for the receive_mail_latency field.
     *
     * @var        int
     */
    protected $receive_mail_latency;

    /**
     * The value for the average_received_mail field.
     *
     * @var        int
     */
    protected $average_received_mail;

    /**
     * The value for the average_sended_mail field.
     *
     * @var        int
     */
    protected $average_sended_mail;

    /**
     * The value for the mail_size field.
     *
     * @var        int
     */
    protected $mail_size;

    /**
     * The value for the up_bandwidth field.
     *
     * @var        int
     */
    protected $up_bandwidth;

    /**
     * The value for the down_bandwidth field.
     *
     * @var        int
     */
    protected $down_bandwidth;

    /**
     * The value for the ext_rid field.
     *
     * @var        int
     */
    protected $ext_rid;

    /**
     * @var        ChildRequests
     */
    protected $aRequests;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Base\Mail object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Mail</code> instance.  If
     * <code>obj</code> is an instance of <code>Mail</code>, delegates to
     * <code>equals(Mail)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Mail The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [mail_id] column value.
     *
     * @return int
     */
    public function getMailId()
    {
        return $this->mail_id;
    }

    /**
     * Get the [internal_mail_server] column value.
     *
     * @return boolean
     */
    public function getInternalMailServer()
    {
        return $this->internal_mail_server;
    }

    /**
     * Get the [internal_mail_server] column value.
     *
     * @return boolean
     */
    public function isInternalMailServer()
    {
        return $this->getInternalMailServer();
    }

    /**
     * Get the [mail_count] column value.
     *
     * @return int
     */
    public function getMailCount()
    {
        return $this->mail_count;
    }

    /**
     * Get the [send_mail_latency] column value.
     *
     * @return int
     */
    public function getSendMailLatency()
    {
        return $this->send_mail_latency;
    }

    /**
     * Get the [receive_mail_latency] column value.
     *
     * @return int
     */
    public function getReceiveMailLatency()
    {
        return $this->receive_mail_latency;
    }

    /**
     * Get the [average_received_mail] column value.
     *
     * @return int
     */
    public function getAverageReceivedMail()
    {
        return $this->average_received_mail;
    }

    /**
     * Get the [average_sended_mail] column value.
     *
     * @return int
     */
    public function getAverageSendedMail()
    {
        return $this->average_sended_mail;
    }

    /**
     * Get the [mail_size] column value.
     *
     * @return int
     */
    public function getMailSize()
    {
        return $this->mail_size;
    }

    /**
     * Get the [up_bandwidth] column value.
     *
     * @return int
     */
    public function getUpBandwidth()
    {
        return $this->up_bandwidth;
    }

    /**
     * Get the [down_bandwidth] column value.
     *
     * @return int
     */
    public function getDownBandwidth()
    {
        return $this->down_bandwidth;
    }

    /**
     * Get the [ext_rid] column value.
     *
     * @return int
     */
    public function getExtRid()
    {
        return $this->ext_rid;
    }

    /**
     * Set the value of [mail_id] column.
     *
     * @param int $v new value
     * @return $this|\Mail The current object (for fluent API support)
     */
    public function setMailId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->mail_id !== $v) {
            $this->mail_id = $v;
            $this->modifiedColumns[MailTableMap::COL_MAIL_ID] = true;
        }

        return $this;
    } // setMailId()

    /**
     * Sets the value of the [internal_mail_server] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Mail The current object (for fluent API support)
     */
    public function setInternalMailServer($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->internal_mail_server !== $v) {
            $this->internal_mail_server = $v;
            $this->modifiedColumns[MailTableMap::COL_INTERNAL_MAIL_SERVER] = true;
        }

        return $this;
    } // setInternalMailServer()

    /**
     * Set the value of [mail_count] column.
     *
     * @param int $v new value
     * @return $this|\Mail The current object (for fluent API support)
     */
    public function setMailCount($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->mail_count !== $v) {
            $this->mail_count = $v;
            $this->modifiedColumns[MailTableMap::COL_MAIL_COUNT] = true;
        }

        return $this;
    } // setMailCount()

    /**
     * Set the value of [send_mail_latency] column.
     *
     * @param int $v new value
     * @return $this|\Mail The current object (for fluent API support)
     */
    public function setSendMailLatency($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->send_mail_latency !== $v) {
            $this->send_mail_latency = $v;
            $this->modifiedColumns[MailTableMap::COL_SEND_MAIL_LATENCY] = true;
        }

        return $this;
    } // setSendMailLatency()

    /**
     * Set the value of [receive_mail_latency] column.
     *
     * @param int $v new value
     * @return $this|\Mail The current object (for fluent API support)
     */
    public function setReceiveMailLatency($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->receive_mail_latency !== $v) {
            $this->receive_mail_latency = $v;
            $this->modifiedColumns[MailTableMap::COL_RECEIVE_MAIL_LATENCY] = true;
        }

        return $this;
    } // setReceiveMailLatency()

    /**
     * Set the value of [average_received_mail] column.
     *
     * @param int $v new value
     * @return $this|\Mail The current object (for fluent API support)
     */
    public function setAverageReceivedMail($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->average_received_mail !== $v) {
            $this->average_received_mail = $v;
            $this->modifiedColumns[MailTableMap::COL_AVERAGE_RECEIVED_MAIL] = true;
        }

        return $this;
    } // setAverageReceivedMail()

    /**
     * Set the value of [average_sended_mail] column.
     *
     * @param int $v new value
     * @return $this|\Mail The current object (for fluent API support)
     */
    public function setAverageSendedMail($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->average_sended_mail !== $v) {
            $this->average_sended_mail = $v;
            $this->modifiedColumns[MailTableMap::COL_AVERAGE_SENDED_MAIL] = true;
        }

        return $this;
    } // setAverageSendedMail()

    /**
     * Set the value of [mail_size] column.
     *
     * @param int $v new value
     * @return $this|\Mail The current object (for fluent API support)
     */
    public function setMailSize($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->mail_size !== $v) {
            $this->mail_size = $v;
            $this->modifiedColumns[MailTableMap::COL_MAIL_SIZE] = true;
        }

        return $this;
    } // setMailSize()

    /**
     * Set the value of [up_bandwidth] column.
     *
     * @param int $v new value
     * @return $this|\Mail The current object (for fluent API support)
     */
    public function setUpBandwidth($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->up_bandwidth !== $v) {
            $this->up_bandwidth = $v;
            $this->modifiedColumns[MailTableMap::COL_UP_BANDWIDTH] = true;
        }

        return $this;
    } // setUpBandwidth()

    /**
     * Set the value of [down_bandwidth] column.
     *
     * @param int $v new value
     * @return $this|\Mail The current object (for fluent API support)
     */
    public function setDownBandwidth($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->down_bandwidth !== $v) {
            $this->down_bandwidth = $v;
            $this->modifiedColumns[MailTableMap::COL_DOWN_BANDWIDTH] = true;
        }

        return $this;
    } // setDownBandwidth()

    /**
     * Set the value of [ext_rid] column.
     *
     * @param int $v new value
     * @return $this|\Mail The current object (for fluent API support)
     */
    public function setExtRid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ext_rid !== $v) {
            $this->ext_rid = $v;
            $this->modifiedColumns[MailTableMap::COL_EXT_RID] = true;
        }

        if ($this->aRequests !== null && $this->aRequests->getRid() !== $v) {
            $this->aRequests = null;
        }

        return $this;
    } // setExtRid()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : MailTableMap::translateFieldName('MailId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mail_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : MailTableMap::translateFieldName('InternalMailServer', TableMap::TYPE_PHPNAME, $indexType)];
            $this->internal_mail_server = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : MailTableMap::translateFieldName('MailCount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mail_count = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : MailTableMap::translateFieldName('SendMailLatency', TableMap::TYPE_PHPNAME, $indexType)];
            $this->send_mail_latency = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : MailTableMap::translateFieldName('ReceiveMailLatency', TableMap::TYPE_PHPNAME, $indexType)];
            $this->receive_mail_latency = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : MailTableMap::translateFieldName('AverageReceivedMail', TableMap::TYPE_PHPNAME, $indexType)];
            $this->average_received_mail = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : MailTableMap::translateFieldName('AverageSendedMail', TableMap::TYPE_PHPNAME, $indexType)];
            $this->average_sended_mail = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : MailTableMap::translateFieldName('MailSize', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mail_size = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : MailTableMap::translateFieldName('UpBandwidth', TableMap::TYPE_PHPNAME, $indexType)];
            $this->up_bandwidth = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : MailTableMap::translateFieldName('DownBandwidth', TableMap::TYPE_PHPNAME, $indexType)];
            $this->down_bandwidth = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : MailTableMap::translateFieldName('ExtRid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ext_rid = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = MailTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Mail'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aRequests !== null && $this->ext_rid !== $this->aRequests->getRid()) {
            $this->aRequests = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MailTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildMailQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aRequests = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Mail::setDeleted()
     * @see Mail::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(MailTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildMailQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(MailTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                MailTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aRequests !== null) {
                if ($this->aRequests->isModified() || $this->aRequests->isNew()) {
                    $affectedRows += $this->aRequests->save($con);
                }
                $this->setRequests($this->aRequests);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[MailTableMap::COL_MAIL_ID] = true;
        if (null !== $this->mail_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . MailTableMap::COL_MAIL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(MailTableMap::COL_MAIL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'mail_id';
        }
        if ($this->isColumnModified(MailTableMap::COL_INTERNAL_MAIL_SERVER)) {
            $modifiedColumns[':p' . $index++]  = 'internal_mail_server';
        }
        if ($this->isColumnModified(MailTableMap::COL_MAIL_COUNT)) {
            $modifiedColumns[':p' . $index++]  = 'mail_count';
        }
        if ($this->isColumnModified(MailTableMap::COL_SEND_MAIL_LATENCY)) {
            $modifiedColumns[':p' . $index++]  = 'send_mail_latency';
        }
        if ($this->isColumnModified(MailTableMap::COL_RECEIVE_MAIL_LATENCY)) {
            $modifiedColumns[':p' . $index++]  = 'receive_mail_latency';
        }
        if ($this->isColumnModified(MailTableMap::COL_AVERAGE_RECEIVED_MAIL)) {
            $modifiedColumns[':p' . $index++]  = 'average_received_mail';
        }
        if ($this->isColumnModified(MailTableMap::COL_AVERAGE_SENDED_MAIL)) {
            $modifiedColumns[':p' . $index++]  = 'average_sended_mail';
        }
        if ($this->isColumnModified(MailTableMap::COL_MAIL_SIZE)) {
            $modifiedColumns[':p' . $index++]  = 'mail_size';
        }
        if ($this->isColumnModified(MailTableMap::COL_UP_BANDWIDTH)) {
            $modifiedColumns[':p' . $index++]  = 'up_bandwidth';
        }
        if ($this->isColumnModified(MailTableMap::COL_DOWN_BANDWIDTH)) {
            $modifiedColumns[':p' . $index++]  = 'down_bandwidth';
        }
        if ($this->isColumnModified(MailTableMap::COL_EXT_RID)) {
            $modifiedColumns[':p' . $index++]  = 'ext_rid';
        }

        $sql = sprintf(
            'INSERT INTO mail (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'mail_id':
                        $stmt->bindValue($identifier, $this->mail_id, PDO::PARAM_INT);
                        break;
                    case 'internal_mail_server':
                        $stmt->bindValue($identifier, (int) $this->internal_mail_server, PDO::PARAM_INT);
                        break;
                    case 'mail_count':
                        $stmt->bindValue($identifier, $this->mail_count, PDO::PARAM_INT);
                        break;
                    case 'send_mail_latency':
                        $stmt->bindValue($identifier, $this->send_mail_latency, PDO::PARAM_INT);
                        break;
                    case 'receive_mail_latency':
                        $stmt->bindValue($identifier, $this->receive_mail_latency, PDO::PARAM_INT);
                        break;
                    case 'average_received_mail':
                        $stmt->bindValue($identifier, $this->average_received_mail, PDO::PARAM_INT);
                        break;
                    case 'average_sended_mail':
                        $stmt->bindValue($identifier, $this->average_sended_mail, PDO::PARAM_INT);
                        break;
                    case 'mail_size':
                        $stmt->bindValue($identifier, $this->mail_size, PDO::PARAM_INT);
                        break;
                    case 'up_bandwidth':
                        $stmt->bindValue($identifier, $this->up_bandwidth, PDO::PARAM_INT);
                        break;
                    case 'down_bandwidth':
                        $stmt->bindValue($identifier, $this->down_bandwidth, PDO::PARAM_INT);
                        break;
                    case 'ext_rid':
                        $stmt->bindValue($identifier, $this->ext_rid, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setMailId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = MailTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getMailId();
                break;
            case 1:
                return $this->getInternalMailServer();
                break;
            case 2:
                return $this->getMailCount();
                break;
            case 3:
                return $this->getSendMailLatency();
                break;
            case 4:
                return $this->getReceiveMailLatency();
                break;
            case 5:
                return $this->getAverageReceivedMail();
                break;
            case 6:
                return $this->getAverageSendedMail();
                break;
            case 7:
                return $this->getMailSize();
                break;
            case 8:
                return $this->getUpBandwidth();
                break;
            case 9:
                return $this->getDownBandwidth();
                break;
            case 10:
                return $this->getExtRid();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Mail'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Mail'][$this->hashCode()] = true;
        $keys = MailTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getMailId(),
            $keys[1] => $this->getInternalMailServer(),
            $keys[2] => $this->getMailCount(),
            $keys[3] => $this->getSendMailLatency(),
            $keys[4] => $this->getReceiveMailLatency(),
            $keys[5] => $this->getAverageReceivedMail(),
            $keys[6] => $this->getAverageSendedMail(),
            $keys[7] => $this->getMailSize(),
            $keys[8] => $this->getUpBandwidth(),
            $keys[9] => $this->getDownBandwidth(),
            $keys[10] => $this->getExtRid(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aRequests) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'requests';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'requests';
                        break;
                    default:
                        $key = 'Requests';
                }

                $result[$key] = $this->aRequests->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Mail
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = MailTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Mail
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setMailId($value);
                break;
            case 1:
                $this->setInternalMailServer($value);
                break;
            case 2:
                $this->setMailCount($value);
                break;
            case 3:
                $this->setSendMailLatency($value);
                break;
            case 4:
                $this->setReceiveMailLatency($value);
                break;
            case 5:
                $this->setAverageReceivedMail($value);
                break;
            case 6:
                $this->setAverageSendedMail($value);
                break;
            case 7:
                $this->setMailSize($value);
                break;
            case 8:
                $this->setUpBandwidth($value);
                break;
            case 9:
                $this->setDownBandwidth($value);
                break;
            case 10:
                $this->setExtRid($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = MailTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setMailId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setInternalMailServer($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setMailCount($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setSendMailLatency($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setReceiveMailLatency($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setAverageReceivedMail($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setAverageSendedMail($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setMailSize($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setUpBandwidth($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setDownBandwidth($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setExtRid($arr[$keys[10]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Mail The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(MailTableMap::DATABASE_NAME);

        if ($this->isColumnModified(MailTableMap::COL_MAIL_ID)) {
            $criteria->add(MailTableMap::COL_MAIL_ID, $this->mail_id);
        }
        if ($this->isColumnModified(MailTableMap::COL_INTERNAL_MAIL_SERVER)) {
            $criteria->add(MailTableMap::COL_INTERNAL_MAIL_SERVER, $this->internal_mail_server);
        }
        if ($this->isColumnModified(MailTableMap::COL_MAIL_COUNT)) {
            $criteria->add(MailTableMap::COL_MAIL_COUNT, $this->mail_count);
        }
        if ($this->isColumnModified(MailTableMap::COL_SEND_MAIL_LATENCY)) {
            $criteria->add(MailTableMap::COL_SEND_MAIL_LATENCY, $this->send_mail_latency);
        }
        if ($this->isColumnModified(MailTableMap::COL_RECEIVE_MAIL_LATENCY)) {
            $criteria->add(MailTableMap::COL_RECEIVE_MAIL_LATENCY, $this->receive_mail_latency);
        }
        if ($this->isColumnModified(MailTableMap::COL_AVERAGE_RECEIVED_MAIL)) {
            $criteria->add(MailTableMap::COL_AVERAGE_RECEIVED_MAIL, $this->average_received_mail);
        }
        if ($this->isColumnModified(MailTableMap::COL_AVERAGE_SENDED_MAIL)) {
            $criteria->add(MailTableMap::COL_AVERAGE_SENDED_MAIL, $this->average_sended_mail);
        }
        if ($this->isColumnModified(MailTableMap::COL_MAIL_SIZE)) {
            $criteria->add(MailTableMap::COL_MAIL_SIZE, $this->mail_size);
        }
        if ($this->isColumnModified(MailTableMap::COL_UP_BANDWIDTH)) {
            $criteria->add(MailTableMap::COL_UP_BANDWIDTH, $this->up_bandwidth);
        }
        if ($this->isColumnModified(MailTableMap::COL_DOWN_BANDWIDTH)) {
            $criteria->add(MailTableMap::COL_DOWN_BANDWIDTH, $this->down_bandwidth);
        }
        if ($this->isColumnModified(MailTableMap::COL_EXT_RID)) {
            $criteria->add(MailTableMap::COL_EXT_RID, $this->ext_rid);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildMailQuery::create();
        $criteria->add(MailTableMap::COL_MAIL_ID, $this->mail_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getMailId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getMailId();
    }

    /**
     * Generic method to set the primary key (mail_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setMailId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getMailId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Mail (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setInternalMailServer($this->getInternalMailServer());
        $copyObj->setMailCount($this->getMailCount());
        $copyObj->setSendMailLatency($this->getSendMailLatency());
        $copyObj->setReceiveMailLatency($this->getReceiveMailLatency());
        $copyObj->setAverageReceivedMail($this->getAverageReceivedMail());
        $copyObj->setAverageSendedMail($this->getAverageSendedMail());
        $copyObj->setMailSize($this->getMailSize());
        $copyObj->setUpBandwidth($this->getUpBandwidth());
        $copyObj->setDownBandwidth($this->getDownBandwidth());
        $copyObj->setExtRid($this->getExtRid());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setMailId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Mail Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildRequests object.
     *
     * @param  ChildRequests $v
     * @return $this|\Mail The current object (for fluent API support)
     * @throws PropelException
     */
    public function setRequests(ChildRequests $v = null)
    {
        if ($v === null) {
            $this->setExtRid(NULL);
        } else {
            $this->setExtRid($v->getRid());
        }

        $this->aRequests = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildRequests object, it will not be re-added.
        if ($v !== null) {
            $v->addMail($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildRequests object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildRequests The associated ChildRequests object.
     * @throws PropelException
     */
    public function getRequests(ConnectionInterface $con = null)
    {
        if ($this->aRequests === null && ($this->ext_rid !== null)) {
            $this->aRequests = ChildRequestsQuery::create()->findPk($this->ext_rid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aRequests->addMails($this);
             */
        }

        return $this->aRequests;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aRequests) {
            $this->aRequests->removeMail($this);
        }
        $this->mail_id = null;
        $this->internal_mail_server = null;
        $this->mail_count = null;
        $this->send_mail_latency = null;
        $this->receive_mail_latency = null;
        $this->average_received_mail = null;
        $this->average_sended_mail = null;
        $this->mail_size = null;
        $this->up_bandwidth = null;
        $this->down_bandwidth = null;
        $this->ext_rid = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

        $this->aRequests = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(MailTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
