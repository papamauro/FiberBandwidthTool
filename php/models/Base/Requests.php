<?php

namespace Base;

use \Generic as ChildGeneric;
use \GenericQuery as ChildGenericQuery;
use \Mail as ChildMail;
use \MailQuery as ChildMailQuery;
use \Remote as ChildRemote;
use \RemoteQuery as ChildRemoteQuery;
use \Requests as ChildRequests;
use \RequestsQuery as ChildRequestsQuery;
use \Security as ChildSecurity;
use \SecurityQuery as ChildSecurityQuery;
use \User as ChildUser;
use \UserQuery as ChildUserQuery;
use \Video as ChildVideo;
use \VideoQuery as ChildVideoQuery;
use \Voip as ChildVoip;
use \VoipQuery as ChildVoipQuery;
use \Web as ChildWeb;
use \WebQuery as ChildWebQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\GenericTableMap;
use Map\MailTableMap;
use Map\RemoteTableMap;
use Map\RequestsTableMap;
use Map\SecurityTableMap;
use Map\VideoTableMap;
use Map\VoipTableMap;
use Map\WebTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'requests' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Requests implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\RequestsTableMap';


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
     * The value for the rid field.
     *
     * @var        int
     */
    protected $rid;

    /**
     * The value for the completed field.
     *
     * @var        boolean
     */
    protected $completed;

    /**
     * The value for the date field.
     *
     * @var        DateTime
     */
    protected $date;

    /**
     * The value for the resultup field.
     *
     * @var        int
     */
    protected $resultup;

    /**
     * The value for the resultdown field.
     *
     * @var        int
     */
    protected $resultdown;

    /**
     * The value for the last_screen field.
     *
     * @var        int
     */
    protected $last_screen;

    /**
     * The value for the avg field.
     *
     * @var        boolean
     */
    protected $avg;

    /**
     * The value for the ext_uid field.
     *
     * @var        int
     */
    protected $ext_uid;

    /**
     * @var        ChildUser
     */
    protected $aUser;

    /**
     * @var        ObjectCollection|ChildWeb[] Collection to store aggregation of ChildWeb objects.
     */
    protected $collWebs;
    protected $collWebsPartial;

    /**
     * @var        ObjectCollection|ChildVideo[] Collection to store aggregation of ChildVideo objects.
     */
    protected $collVideos;
    protected $collVideosPartial;

    /**
     * @var        ObjectCollection|ChildGeneric[] Collection to store aggregation of ChildGeneric objects.
     */
    protected $collGenerics;
    protected $collGenericsPartial;

    /**
     * @var        ObjectCollection|ChildVoip[] Collection to store aggregation of ChildVoip objects.
     */
    protected $collVoips;
    protected $collVoipsPartial;

    /**
     * @var        ObjectCollection|ChildSecurity[] Collection to store aggregation of ChildSecurity objects.
     */
    protected $collSecurities;
    protected $collSecuritiesPartial;

    /**
     * @var        ObjectCollection|ChildRemote[] Collection to store aggregation of ChildRemote objects.
     */
    protected $collRemotes;
    protected $collRemotesPartial;

    /**
     * @var        ObjectCollection|ChildMail[] Collection to store aggregation of ChildMail objects.
     */
    protected $collMails;
    protected $collMailsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWeb[]
     */
    protected $websScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVideo[]
     */
    protected $videosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGeneric[]
     */
    protected $genericsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVoip[]
     */
    protected $voipsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSecurity[]
     */
    protected $securitiesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildRemote[]
     */
    protected $remotesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildMail[]
     */
    protected $mailsScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Requests object.
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
     * Compares this with another <code>Requests</code> instance.  If
     * <code>obj</code> is an instance of <code>Requests</code>, delegates to
     * <code>equals(Requests)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Requests The current object, for fluid interface
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
     * Get the [rid] column value.
     *
     * @return int
     */
    public function getRid()
    {
        return $this->rid;
    }

    /**
     * Get the [completed] column value.
     *
     * @return boolean
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * Get the [completed] column value.
     *
     * @return boolean
     */
    public function isCompleted()
    {
        return $this->getCompleted();
    }

    /**
     * Get the [optionally formatted] temporal [date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDate($format = NULL)
    {
        if ($format === null) {
            return $this->date;
        } else {
            return $this->date instanceof \DateTimeInterface ? $this->date->format($format) : null;
        }
    }

    /**
     * Get the [resultup] column value.
     *
     * @return int
     */
    public function getResultup()
    {
        return $this->resultup;
    }

    /**
     * Get the [resultdown] column value.
     *
     * @return int
     */
    public function getResultdown()
    {
        return $this->resultdown;
    }

    /**
     * Get the [last_screen] column value.
     *
     * @return int
     */
    public function getLastScreen()
    {
        return $this->last_screen;
    }

    /**
     * Get the [avg] column value.
     *
     * @return boolean
     */
    public function getAvg()
    {
        return $this->avg;
    }

    /**
     * Get the [avg] column value.
     *
     * @return boolean
     */
    public function isAvg()
    {
        return $this->getAvg();
    }

    /**
     * Get the [ext_uid] column value.
     *
     * @return int
     */
    public function getExtUid()
    {
        return $this->ext_uid;
    }

    /**
     * Set the value of [rid] column.
     *
     * @param int $v new value
     * @return $this|\Requests The current object (for fluent API support)
     */
    public function setRid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->rid !== $v) {
            $this->rid = $v;
            $this->modifiedColumns[RequestsTableMap::COL_RID] = true;
        }

        return $this;
    } // setRid()

    /**
     * Sets the value of the [completed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Requests The current object (for fluent API support)
     */
    public function setCompleted($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->completed !== $v) {
            $this->completed = $v;
            $this->modifiedColumns[RequestsTableMap::COL_COMPLETED] = true;
        }

        return $this;
    } // setCompleted()

    /**
     * Sets the value of [date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Requests The current object (for fluent API support)
     */
    public function setDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date !== null || $dt !== null) {
            if ($this->date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->date->format("Y-m-d H:i:s.u")) {
                $this->date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[RequestsTableMap::COL_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setDate()

    /**
     * Set the value of [resultup] column.
     *
     * @param int $v new value
     * @return $this|\Requests The current object (for fluent API support)
     */
    public function setResultup($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->resultup !== $v) {
            $this->resultup = $v;
            $this->modifiedColumns[RequestsTableMap::COL_RESULTUP] = true;
        }

        return $this;
    } // setResultup()

    /**
     * Set the value of [resultdown] column.
     *
     * @param int $v new value
     * @return $this|\Requests The current object (for fluent API support)
     */
    public function setResultdown($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->resultdown !== $v) {
            $this->resultdown = $v;
            $this->modifiedColumns[RequestsTableMap::COL_RESULTDOWN] = true;
        }

        return $this;
    } // setResultdown()

    /**
     * Set the value of [last_screen] column.
     *
     * @param int $v new value
     * @return $this|\Requests The current object (for fluent API support)
     */
    public function setLastScreen($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->last_screen !== $v) {
            $this->last_screen = $v;
            $this->modifiedColumns[RequestsTableMap::COL_LAST_SCREEN] = true;
        }

        return $this;
    } // setLastScreen()

    /**
     * Sets the value of the [avg] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Requests The current object (for fluent API support)
     */
    public function setAvg($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->avg !== $v) {
            $this->avg = $v;
            $this->modifiedColumns[RequestsTableMap::COL_AVG] = true;
        }

        return $this;
    } // setAvg()

    /**
     * Set the value of [ext_uid] column.
     *
     * @param int $v new value
     * @return $this|\Requests The current object (for fluent API support)
     */
    public function setExtUid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ext_uid !== $v) {
            $this->ext_uid = $v;
            $this->modifiedColumns[RequestsTableMap::COL_EXT_UID] = true;
        }

        if ($this->aUser !== null && $this->aUser->getUid() !== $v) {
            $this->aUser = null;
        }

        return $this;
    } // setExtUid()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : RequestsTableMap::translateFieldName('Rid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : RequestsTableMap::translateFieldName('Completed', TableMap::TYPE_PHPNAME, $indexType)];
            $this->completed = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : RequestsTableMap::translateFieldName('Date', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : RequestsTableMap::translateFieldName('Resultup', TableMap::TYPE_PHPNAME, $indexType)];
            $this->resultup = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : RequestsTableMap::translateFieldName('Resultdown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->resultdown = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : RequestsTableMap::translateFieldName('LastScreen', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_screen = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : RequestsTableMap::translateFieldName('Avg', TableMap::TYPE_PHPNAME, $indexType)];
            $this->avg = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : RequestsTableMap::translateFieldName('ExtUid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ext_uid = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = RequestsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Requests'), 0, $e);
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
        if ($this->aUser !== null && $this->ext_uid !== $this->aUser->getUid()) {
            $this->aUser = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(RequestsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildRequestsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUser = null;
            $this->collWebs = null;

            $this->collVideos = null;

            $this->collGenerics = null;

            $this->collVoips = null;

            $this->collSecurities = null;

            $this->collRemotes = null;

            $this->collMails = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Requests::setDeleted()
     * @see Requests::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(RequestsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildRequestsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(RequestsTableMap::DATABASE_NAME);
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
                RequestsTableMap::addInstanceToPool($this);
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

            if ($this->aUser !== null) {
                if ($this->aUser->isModified() || $this->aUser->isNew()) {
                    $affectedRows += $this->aUser->save($con);
                }
                $this->setUser($this->aUser);
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

            if ($this->websScheduledForDeletion !== null) {
                if (!$this->websScheduledForDeletion->isEmpty()) {
                    foreach ($this->websScheduledForDeletion as $web) {
                        // need to save related object because we set the relation to null
                        $web->save($con);
                    }
                    $this->websScheduledForDeletion = null;
                }
            }

            if ($this->collWebs !== null) {
                foreach ($this->collWebs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->videosScheduledForDeletion !== null) {
                if (!$this->videosScheduledForDeletion->isEmpty()) {
                    foreach ($this->videosScheduledForDeletion as $video) {
                        // need to save related object because we set the relation to null
                        $video->save($con);
                    }
                    $this->videosScheduledForDeletion = null;
                }
            }

            if ($this->collVideos !== null) {
                foreach ($this->collVideos as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->genericsScheduledForDeletion !== null) {
                if (!$this->genericsScheduledForDeletion->isEmpty()) {
                    foreach ($this->genericsScheduledForDeletion as $generic) {
                        // need to save related object because we set the relation to null
                        $generic->save($con);
                    }
                    $this->genericsScheduledForDeletion = null;
                }
            }

            if ($this->collGenerics !== null) {
                foreach ($this->collGenerics as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->voipsScheduledForDeletion !== null) {
                if (!$this->voipsScheduledForDeletion->isEmpty()) {
                    foreach ($this->voipsScheduledForDeletion as $voip) {
                        // need to save related object because we set the relation to null
                        $voip->save($con);
                    }
                    $this->voipsScheduledForDeletion = null;
                }
            }

            if ($this->collVoips !== null) {
                foreach ($this->collVoips as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->securitiesScheduledForDeletion !== null) {
                if (!$this->securitiesScheduledForDeletion->isEmpty()) {
                    foreach ($this->securitiesScheduledForDeletion as $security) {
                        // need to save related object because we set the relation to null
                        $security->save($con);
                    }
                    $this->securitiesScheduledForDeletion = null;
                }
            }

            if ($this->collSecurities !== null) {
                foreach ($this->collSecurities as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->remotesScheduledForDeletion !== null) {
                if (!$this->remotesScheduledForDeletion->isEmpty()) {
                    foreach ($this->remotesScheduledForDeletion as $remote) {
                        // need to save related object because we set the relation to null
                        $remote->save($con);
                    }
                    $this->remotesScheduledForDeletion = null;
                }
            }

            if ($this->collRemotes !== null) {
                foreach ($this->collRemotes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->mailsScheduledForDeletion !== null) {
                if (!$this->mailsScheduledForDeletion->isEmpty()) {
                    foreach ($this->mailsScheduledForDeletion as $mail) {
                        // need to save related object because we set the relation to null
                        $mail->save($con);
                    }
                    $this->mailsScheduledForDeletion = null;
                }
            }

            if ($this->collMails !== null) {
                foreach ($this->collMails as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

        $this->modifiedColumns[RequestsTableMap::COL_RID] = true;
        if (null !== $this->rid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . RequestsTableMap::COL_RID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(RequestsTableMap::COL_RID)) {
            $modifiedColumns[':p' . $index++]  = 'rid';
        }
        if ($this->isColumnModified(RequestsTableMap::COL_COMPLETED)) {
            $modifiedColumns[':p' . $index++]  = 'completed';
        }
        if ($this->isColumnModified(RequestsTableMap::COL_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'date';
        }
        if ($this->isColumnModified(RequestsTableMap::COL_RESULTUP)) {
            $modifiedColumns[':p' . $index++]  = 'resultup';
        }
        if ($this->isColumnModified(RequestsTableMap::COL_RESULTDOWN)) {
            $modifiedColumns[':p' . $index++]  = 'resultdown';
        }
        if ($this->isColumnModified(RequestsTableMap::COL_LAST_SCREEN)) {
            $modifiedColumns[':p' . $index++]  = 'last_screen';
        }
        if ($this->isColumnModified(RequestsTableMap::COL_AVG)) {
            $modifiedColumns[':p' . $index++]  = 'avg';
        }
        if ($this->isColumnModified(RequestsTableMap::COL_EXT_UID)) {
            $modifiedColumns[':p' . $index++]  = 'ext_uid';
        }

        $sql = sprintf(
            'INSERT INTO requests (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'rid':
                        $stmt->bindValue($identifier, $this->rid, PDO::PARAM_INT);
                        break;
                    case 'completed':
                        $stmt->bindValue($identifier, (int) $this->completed, PDO::PARAM_INT);
                        break;
                    case 'date':
                        $stmt->bindValue($identifier, $this->date ? $this->date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'resultup':
                        $stmt->bindValue($identifier, $this->resultup, PDO::PARAM_INT);
                        break;
                    case 'resultdown':
                        $stmt->bindValue($identifier, $this->resultdown, PDO::PARAM_INT);
                        break;
                    case 'last_screen':
                        $stmt->bindValue($identifier, $this->last_screen, PDO::PARAM_INT);
                        break;
                    case 'avg':
                        $stmt->bindValue($identifier, (int) $this->avg, PDO::PARAM_INT);
                        break;
                    case 'ext_uid':
                        $stmt->bindValue($identifier, $this->ext_uid, PDO::PARAM_INT);
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
        $this->setRid($pk);

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
        $pos = RequestsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getRid();
                break;
            case 1:
                return $this->getCompleted();
                break;
            case 2:
                return $this->getDate();
                break;
            case 3:
                return $this->getResultup();
                break;
            case 4:
                return $this->getResultdown();
                break;
            case 5:
                return $this->getLastScreen();
                break;
            case 6:
                return $this->getAvg();
                break;
            case 7:
                return $this->getExtUid();
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

        if (isset($alreadyDumpedObjects['Requests'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Requests'][$this->hashCode()] = true;
        $keys = RequestsTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getRid(),
            $keys[1] => $this->getCompleted(),
            $keys[2] => $this->getDate(),
            $keys[3] => $this->getResultup(),
            $keys[4] => $this->getResultdown(),
            $keys[5] => $this->getLastScreen(),
            $keys[6] => $this->getAvg(),
            $keys[7] => $this->getExtUid(),
        );
        if ($result[$keys[2]] instanceof \DateTime) {
            $result[$keys[2]] = $result[$keys[2]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aUser) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'user';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user';
                        break;
                    default:
                        $key = 'User';
                }

                $result[$key] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collWebs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'webs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'webs';
                        break;
                    default:
                        $key = 'Webs';
                }

                $result[$key] = $this->collWebs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collVideos) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'videos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'videos';
                        break;
                    default:
                        $key = 'Videos';
                }

                $result[$key] = $this->collVideos->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collGenerics) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'generics';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'generics';
                        break;
                    default:
                        $key = 'Generics';
                }

                $result[$key] = $this->collGenerics->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collVoips) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'voips';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'voips';
                        break;
                    default:
                        $key = 'Voips';
                }

                $result[$key] = $this->collVoips->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSecurities) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'securities';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'securities';
                        break;
                    default:
                        $key = 'Securities';
                }

                $result[$key] = $this->collSecurities->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRemotes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'remotes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'remotes';
                        break;
                    default:
                        $key = 'Remotes';
                }

                $result[$key] = $this->collRemotes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMails) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'mails';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'mails';
                        break;
                    default:
                        $key = 'Mails';
                }

                $result[$key] = $this->collMails->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Requests
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = RequestsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Requests
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setRid($value);
                break;
            case 1:
                $this->setCompleted($value);
                break;
            case 2:
                $this->setDate($value);
                break;
            case 3:
                $this->setResultup($value);
                break;
            case 4:
                $this->setResultdown($value);
                break;
            case 5:
                $this->setLastScreen($value);
                break;
            case 6:
                $this->setAvg($value);
                break;
            case 7:
                $this->setExtUid($value);
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
        $keys = RequestsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setRid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCompleted($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDate($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setResultup($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setResultdown($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setLastScreen($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setAvg($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setExtUid($arr[$keys[7]]);
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
     * @return $this|\Requests The current object, for fluid interface
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
        $criteria = new Criteria(RequestsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(RequestsTableMap::COL_RID)) {
            $criteria->add(RequestsTableMap::COL_RID, $this->rid);
        }
        if ($this->isColumnModified(RequestsTableMap::COL_COMPLETED)) {
            $criteria->add(RequestsTableMap::COL_COMPLETED, $this->completed);
        }
        if ($this->isColumnModified(RequestsTableMap::COL_DATE)) {
            $criteria->add(RequestsTableMap::COL_DATE, $this->date);
        }
        if ($this->isColumnModified(RequestsTableMap::COL_RESULTUP)) {
            $criteria->add(RequestsTableMap::COL_RESULTUP, $this->resultup);
        }
        if ($this->isColumnModified(RequestsTableMap::COL_RESULTDOWN)) {
            $criteria->add(RequestsTableMap::COL_RESULTDOWN, $this->resultdown);
        }
        if ($this->isColumnModified(RequestsTableMap::COL_LAST_SCREEN)) {
            $criteria->add(RequestsTableMap::COL_LAST_SCREEN, $this->last_screen);
        }
        if ($this->isColumnModified(RequestsTableMap::COL_AVG)) {
            $criteria->add(RequestsTableMap::COL_AVG, $this->avg);
        }
        if ($this->isColumnModified(RequestsTableMap::COL_EXT_UID)) {
            $criteria->add(RequestsTableMap::COL_EXT_UID, $this->ext_uid);
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
        $criteria = ChildRequestsQuery::create();
        $criteria->add(RequestsTableMap::COL_RID, $this->rid);

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
        $validPk = null !== $this->getRid();

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
        return $this->getRid();
    }

    /**
     * Generic method to set the primary key (rid column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setRid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getRid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Requests (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCompleted($this->getCompleted());
        $copyObj->setDate($this->getDate());
        $copyObj->setResultup($this->getResultup());
        $copyObj->setResultdown($this->getResultdown());
        $copyObj->setLastScreen($this->getLastScreen());
        $copyObj->setAvg($this->getAvg());
        $copyObj->setExtUid($this->getExtUid());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getWebs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWeb($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getVideos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVideo($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getGenerics() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGeneric($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getVoips() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVoip($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSecurities() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSecurity($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRemotes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRemote($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMails() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMail($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setRid(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Requests Clone of current object.
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
     * Declares an association between this object and a ChildUser object.
     *
     * @param  ChildUser $v
     * @return $this|\Requests The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUser(ChildUser $v = null)
    {
        if ($v === null) {
            $this->setExtUid(NULL);
        } else {
            $this->setExtUid($v->getUid());
        }

        $this->aUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUser object, it will not be re-added.
        if ($v !== null) {
            $v->addRequests($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUser object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUser The associated ChildUser object.
     * @throws PropelException
     */
    public function getUser(ConnectionInterface $con = null)
    {
        if ($this->aUser === null && ($this->ext_uid !== null)) {
            $this->aUser = ChildUserQuery::create()->findPk($this->ext_uid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUser->addRequestss($this);
             */
        }

        return $this->aUser;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Web' == $relationName) {
            return $this->initWebs();
        }
        if ('Video' == $relationName) {
            return $this->initVideos();
        }
        if ('Generic' == $relationName) {
            return $this->initGenerics();
        }
        if ('Voip' == $relationName) {
            return $this->initVoips();
        }
        if ('Security' == $relationName) {
            return $this->initSecurities();
        }
        if ('Remote' == $relationName) {
            return $this->initRemotes();
        }
        if ('Mail' == $relationName) {
            return $this->initMails();
        }
    }

    /**
     * Clears out the collWebs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addWebs()
     */
    public function clearWebs()
    {
        $this->collWebs = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collWebs collection loaded partially.
     */
    public function resetPartialWebs($v = true)
    {
        $this->collWebsPartial = $v;
    }

    /**
     * Initializes the collWebs collection.
     *
     * By default this just sets the collWebs collection to an empty array (like clearcollWebs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWebs($overrideExisting = true)
    {
        if (null !== $this->collWebs && !$overrideExisting) {
            return;
        }

        $collectionClassName = WebTableMap::getTableMap()->getCollectionClassName();

        $this->collWebs = new $collectionClassName;
        $this->collWebs->setModel('\Web');
    }

    /**
     * Gets an array of ChildWeb objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildRequests is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWeb[] List of ChildWeb objects
     * @throws PropelException
     */
    public function getWebs(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsPartial && !$this->isNew();
        if (null === $this->collWebs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collWebs) {
                // return empty collection
                $this->initWebs();
            } else {
                $collWebs = ChildWebQuery::create(null, $criteria)
                    ->filterByRequests($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWebsPartial && count($collWebs)) {
                        $this->initWebs(false);

                        foreach ($collWebs as $obj) {
                            if (false == $this->collWebs->contains($obj)) {
                                $this->collWebs->append($obj);
                            }
                        }

                        $this->collWebsPartial = true;
                    }

                    return $collWebs;
                }

                if ($partial && $this->collWebs) {
                    foreach ($this->collWebs as $obj) {
                        if ($obj->isNew()) {
                            $collWebs[] = $obj;
                        }
                    }
                }

                $this->collWebs = $collWebs;
                $this->collWebsPartial = false;
            }
        }

        return $this->collWebs;
    }

    /**
     * Sets a collection of ChildWeb objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $webs A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildRequests The current object (for fluent API support)
     */
    public function setWebs(Collection $webs, ConnectionInterface $con = null)
    {
        /** @var ChildWeb[] $websToDelete */
        $websToDelete = $this->getWebs(new Criteria(), $con)->diff($webs);


        $this->websScheduledForDeletion = $websToDelete;

        foreach ($websToDelete as $webRemoved) {
            $webRemoved->setRequests(null);
        }

        $this->collWebs = null;
        foreach ($webs as $web) {
            $this->addWeb($web);
        }

        $this->collWebs = $webs;
        $this->collWebsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Web objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Web objects.
     * @throws PropelException
     */
    public function countWebs(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsPartial && !$this->isNew();
        if (null === $this->collWebs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWebs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWebs());
            }

            $query = ChildWebQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByRequests($this)
                ->count($con);
        }

        return count($this->collWebs);
    }

    /**
     * Method called to associate a ChildWeb object to this object
     * through the ChildWeb foreign key attribute.
     *
     * @param  ChildWeb $l ChildWeb
     * @return $this|\Requests The current object (for fluent API support)
     */
    public function addWeb(ChildWeb $l)
    {
        if ($this->collWebs === null) {
            $this->initWebs();
            $this->collWebsPartial = true;
        }

        if (!$this->collWebs->contains($l)) {
            $this->doAddWeb($l);

            if ($this->websScheduledForDeletion and $this->websScheduledForDeletion->contains($l)) {
                $this->websScheduledForDeletion->remove($this->websScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWeb $web The ChildWeb object to add.
     */
    protected function doAddWeb(ChildWeb $web)
    {
        $this->collWebs[]= $web;
        $web->setRequests($this);
    }

    /**
     * @param  ChildWeb $web The ChildWeb object to remove.
     * @return $this|ChildRequests The current object (for fluent API support)
     */
    public function removeWeb(ChildWeb $web)
    {
        if ($this->getWebs()->contains($web)) {
            $pos = $this->collWebs->search($web);
            $this->collWebs->remove($pos);
            if (null === $this->websScheduledForDeletion) {
                $this->websScheduledForDeletion = clone $this->collWebs;
                $this->websScheduledForDeletion->clear();
            }
            $this->websScheduledForDeletion[]= $web;
            $web->setRequests(null);
        }

        return $this;
    }

    /**
     * Clears out the collVideos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addVideos()
     */
    public function clearVideos()
    {
        $this->collVideos = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collVideos collection loaded partially.
     */
    public function resetPartialVideos($v = true)
    {
        $this->collVideosPartial = $v;
    }

    /**
     * Initializes the collVideos collection.
     *
     * By default this just sets the collVideos collection to an empty array (like clearcollVideos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVideos($overrideExisting = true)
    {
        if (null !== $this->collVideos && !$overrideExisting) {
            return;
        }

        $collectionClassName = VideoTableMap::getTableMap()->getCollectionClassName();

        $this->collVideos = new $collectionClassName;
        $this->collVideos->setModel('\Video');
    }

    /**
     * Gets an array of ChildVideo objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildRequests is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildVideo[] List of ChildVideo objects
     * @throws PropelException
     */
    public function getVideos(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collVideosPartial && !$this->isNew();
        if (null === $this->collVideos || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collVideos) {
                // return empty collection
                $this->initVideos();
            } else {
                $collVideos = ChildVideoQuery::create(null, $criteria)
                    ->filterByRequests($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVideosPartial && count($collVideos)) {
                        $this->initVideos(false);

                        foreach ($collVideos as $obj) {
                            if (false == $this->collVideos->contains($obj)) {
                                $this->collVideos->append($obj);
                            }
                        }

                        $this->collVideosPartial = true;
                    }

                    return $collVideos;
                }

                if ($partial && $this->collVideos) {
                    foreach ($this->collVideos as $obj) {
                        if ($obj->isNew()) {
                            $collVideos[] = $obj;
                        }
                    }
                }

                $this->collVideos = $collVideos;
                $this->collVideosPartial = false;
            }
        }

        return $this->collVideos;
    }

    /**
     * Sets a collection of ChildVideo objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $videos A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildRequests The current object (for fluent API support)
     */
    public function setVideos(Collection $videos, ConnectionInterface $con = null)
    {
        /** @var ChildVideo[] $videosToDelete */
        $videosToDelete = $this->getVideos(new Criteria(), $con)->diff($videos);


        $this->videosScheduledForDeletion = $videosToDelete;

        foreach ($videosToDelete as $videoRemoved) {
            $videoRemoved->setRequests(null);
        }

        $this->collVideos = null;
        foreach ($videos as $video) {
            $this->addVideo($video);
        }

        $this->collVideos = $videos;
        $this->collVideosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Video objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Video objects.
     * @throws PropelException
     */
    public function countVideos(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collVideosPartial && !$this->isNew();
        if (null === $this->collVideos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVideos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVideos());
            }

            $query = ChildVideoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByRequests($this)
                ->count($con);
        }

        return count($this->collVideos);
    }

    /**
     * Method called to associate a ChildVideo object to this object
     * through the ChildVideo foreign key attribute.
     *
     * @param  ChildVideo $l ChildVideo
     * @return $this|\Requests The current object (for fluent API support)
     */
    public function addVideo(ChildVideo $l)
    {
        if ($this->collVideos === null) {
            $this->initVideos();
            $this->collVideosPartial = true;
        }

        if (!$this->collVideos->contains($l)) {
            $this->doAddVideo($l);

            if ($this->videosScheduledForDeletion and $this->videosScheduledForDeletion->contains($l)) {
                $this->videosScheduledForDeletion->remove($this->videosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildVideo $video The ChildVideo object to add.
     */
    protected function doAddVideo(ChildVideo $video)
    {
        $this->collVideos[]= $video;
        $video->setRequests($this);
    }

    /**
     * @param  ChildVideo $video The ChildVideo object to remove.
     * @return $this|ChildRequests The current object (for fluent API support)
     */
    public function removeVideo(ChildVideo $video)
    {
        if ($this->getVideos()->contains($video)) {
            $pos = $this->collVideos->search($video);
            $this->collVideos->remove($pos);
            if (null === $this->videosScheduledForDeletion) {
                $this->videosScheduledForDeletion = clone $this->collVideos;
                $this->videosScheduledForDeletion->clear();
            }
            $this->videosScheduledForDeletion[]= $video;
            $video->setRequests(null);
        }

        return $this;
    }

    /**
     * Clears out the collGenerics collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addGenerics()
     */
    public function clearGenerics()
    {
        $this->collGenerics = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collGenerics collection loaded partially.
     */
    public function resetPartialGenerics($v = true)
    {
        $this->collGenericsPartial = $v;
    }

    /**
     * Initializes the collGenerics collection.
     *
     * By default this just sets the collGenerics collection to an empty array (like clearcollGenerics());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGenerics($overrideExisting = true)
    {
        if (null !== $this->collGenerics && !$overrideExisting) {
            return;
        }

        $collectionClassName = GenericTableMap::getTableMap()->getCollectionClassName();

        $this->collGenerics = new $collectionClassName;
        $this->collGenerics->setModel('\Generic');
    }

    /**
     * Gets an array of ChildGeneric objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildRequests is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildGeneric[] List of ChildGeneric objects
     * @throws PropelException
     */
    public function getGenerics(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collGenericsPartial && !$this->isNew();
        if (null === $this->collGenerics || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collGenerics) {
                // return empty collection
                $this->initGenerics();
            } else {
                $collGenerics = ChildGenericQuery::create(null, $criteria)
                    ->filterByRequests($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collGenericsPartial && count($collGenerics)) {
                        $this->initGenerics(false);

                        foreach ($collGenerics as $obj) {
                            if (false == $this->collGenerics->contains($obj)) {
                                $this->collGenerics->append($obj);
                            }
                        }

                        $this->collGenericsPartial = true;
                    }

                    return $collGenerics;
                }

                if ($partial && $this->collGenerics) {
                    foreach ($this->collGenerics as $obj) {
                        if ($obj->isNew()) {
                            $collGenerics[] = $obj;
                        }
                    }
                }

                $this->collGenerics = $collGenerics;
                $this->collGenericsPartial = false;
            }
        }

        return $this->collGenerics;
    }

    /**
     * Sets a collection of ChildGeneric objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $generics A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildRequests The current object (for fluent API support)
     */
    public function setGenerics(Collection $generics, ConnectionInterface $con = null)
    {
        /** @var ChildGeneric[] $genericsToDelete */
        $genericsToDelete = $this->getGenerics(new Criteria(), $con)->diff($generics);


        $this->genericsScheduledForDeletion = $genericsToDelete;

        foreach ($genericsToDelete as $genericRemoved) {
            $genericRemoved->setRequests(null);
        }

        $this->collGenerics = null;
        foreach ($generics as $generic) {
            $this->addGeneric($generic);
        }

        $this->collGenerics = $generics;
        $this->collGenericsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Generic objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Generic objects.
     * @throws PropelException
     */
    public function countGenerics(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collGenericsPartial && !$this->isNew();
        if (null === $this->collGenerics || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGenerics) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getGenerics());
            }

            $query = ChildGenericQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByRequests($this)
                ->count($con);
        }

        return count($this->collGenerics);
    }

    /**
     * Method called to associate a ChildGeneric object to this object
     * through the ChildGeneric foreign key attribute.
     *
     * @param  ChildGeneric $l ChildGeneric
     * @return $this|\Requests The current object (for fluent API support)
     */
    public function addGeneric(ChildGeneric $l)
    {
        if ($this->collGenerics === null) {
            $this->initGenerics();
            $this->collGenericsPartial = true;
        }

        if (!$this->collGenerics->contains($l)) {
            $this->doAddGeneric($l);

            if ($this->genericsScheduledForDeletion and $this->genericsScheduledForDeletion->contains($l)) {
                $this->genericsScheduledForDeletion->remove($this->genericsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildGeneric $generic The ChildGeneric object to add.
     */
    protected function doAddGeneric(ChildGeneric $generic)
    {
        $this->collGenerics[]= $generic;
        $generic->setRequests($this);
    }

    /**
     * @param  ChildGeneric $generic The ChildGeneric object to remove.
     * @return $this|ChildRequests The current object (for fluent API support)
     */
    public function removeGeneric(ChildGeneric $generic)
    {
        if ($this->getGenerics()->contains($generic)) {
            $pos = $this->collGenerics->search($generic);
            $this->collGenerics->remove($pos);
            if (null === $this->genericsScheduledForDeletion) {
                $this->genericsScheduledForDeletion = clone $this->collGenerics;
                $this->genericsScheduledForDeletion->clear();
            }
            $this->genericsScheduledForDeletion[]= $generic;
            $generic->setRequests(null);
        }

        return $this;
    }

    /**
     * Clears out the collVoips collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addVoips()
     */
    public function clearVoips()
    {
        $this->collVoips = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collVoips collection loaded partially.
     */
    public function resetPartialVoips($v = true)
    {
        $this->collVoipsPartial = $v;
    }

    /**
     * Initializes the collVoips collection.
     *
     * By default this just sets the collVoips collection to an empty array (like clearcollVoips());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVoips($overrideExisting = true)
    {
        if (null !== $this->collVoips && !$overrideExisting) {
            return;
        }

        $collectionClassName = VoipTableMap::getTableMap()->getCollectionClassName();

        $this->collVoips = new $collectionClassName;
        $this->collVoips->setModel('\Voip');
    }

    /**
     * Gets an array of ChildVoip objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildRequests is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildVoip[] List of ChildVoip objects
     * @throws PropelException
     */
    public function getVoips(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collVoipsPartial && !$this->isNew();
        if (null === $this->collVoips || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collVoips) {
                // return empty collection
                $this->initVoips();
            } else {
                $collVoips = ChildVoipQuery::create(null, $criteria)
                    ->filterByRequests($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVoipsPartial && count($collVoips)) {
                        $this->initVoips(false);

                        foreach ($collVoips as $obj) {
                            if (false == $this->collVoips->contains($obj)) {
                                $this->collVoips->append($obj);
                            }
                        }

                        $this->collVoipsPartial = true;
                    }

                    return $collVoips;
                }

                if ($partial && $this->collVoips) {
                    foreach ($this->collVoips as $obj) {
                        if ($obj->isNew()) {
                            $collVoips[] = $obj;
                        }
                    }
                }

                $this->collVoips = $collVoips;
                $this->collVoipsPartial = false;
            }
        }

        return $this->collVoips;
    }

    /**
     * Sets a collection of ChildVoip objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $voips A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildRequests The current object (for fluent API support)
     */
    public function setVoips(Collection $voips, ConnectionInterface $con = null)
    {
        /** @var ChildVoip[] $voipsToDelete */
        $voipsToDelete = $this->getVoips(new Criteria(), $con)->diff($voips);


        $this->voipsScheduledForDeletion = $voipsToDelete;

        foreach ($voipsToDelete as $voipRemoved) {
            $voipRemoved->setRequests(null);
        }

        $this->collVoips = null;
        foreach ($voips as $voip) {
            $this->addVoip($voip);
        }

        $this->collVoips = $voips;
        $this->collVoipsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Voip objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Voip objects.
     * @throws PropelException
     */
    public function countVoips(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collVoipsPartial && !$this->isNew();
        if (null === $this->collVoips || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVoips) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVoips());
            }

            $query = ChildVoipQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByRequests($this)
                ->count($con);
        }

        return count($this->collVoips);
    }

    /**
     * Method called to associate a ChildVoip object to this object
     * through the ChildVoip foreign key attribute.
     *
     * @param  ChildVoip $l ChildVoip
     * @return $this|\Requests The current object (for fluent API support)
     */
    public function addVoip(ChildVoip $l)
    {
        if ($this->collVoips === null) {
            $this->initVoips();
            $this->collVoipsPartial = true;
        }

        if (!$this->collVoips->contains($l)) {
            $this->doAddVoip($l);

            if ($this->voipsScheduledForDeletion and $this->voipsScheduledForDeletion->contains($l)) {
                $this->voipsScheduledForDeletion->remove($this->voipsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildVoip $voip The ChildVoip object to add.
     */
    protected function doAddVoip(ChildVoip $voip)
    {
        $this->collVoips[]= $voip;
        $voip->setRequests($this);
    }

    /**
     * @param  ChildVoip $voip The ChildVoip object to remove.
     * @return $this|ChildRequests The current object (for fluent API support)
     */
    public function removeVoip(ChildVoip $voip)
    {
        if ($this->getVoips()->contains($voip)) {
            $pos = $this->collVoips->search($voip);
            $this->collVoips->remove($pos);
            if (null === $this->voipsScheduledForDeletion) {
                $this->voipsScheduledForDeletion = clone $this->collVoips;
                $this->voipsScheduledForDeletion->clear();
            }
            $this->voipsScheduledForDeletion[]= $voip;
            $voip->setRequests(null);
        }

        return $this;
    }

    /**
     * Clears out the collSecurities collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSecurities()
     */
    public function clearSecurities()
    {
        $this->collSecurities = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSecurities collection loaded partially.
     */
    public function resetPartialSecurities($v = true)
    {
        $this->collSecuritiesPartial = $v;
    }

    /**
     * Initializes the collSecurities collection.
     *
     * By default this just sets the collSecurities collection to an empty array (like clearcollSecurities());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSecurities($overrideExisting = true)
    {
        if (null !== $this->collSecurities && !$overrideExisting) {
            return;
        }

        $collectionClassName = SecurityTableMap::getTableMap()->getCollectionClassName();

        $this->collSecurities = new $collectionClassName;
        $this->collSecurities->setModel('\Security');
    }

    /**
     * Gets an array of ChildSecurity objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildRequests is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSecurity[] List of ChildSecurity objects
     * @throws PropelException
     */
    public function getSecurities(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSecuritiesPartial && !$this->isNew();
        if (null === $this->collSecurities || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSecurities) {
                // return empty collection
                $this->initSecurities();
            } else {
                $collSecurities = ChildSecurityQuery::create(null, $criteria)
                    ->filterByRequests($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSecuritiesPartial && count($collSecurities)) {
                        $this->initSecurities(false);

                        foreach ($collSecurities as $obj) {
                            if (false == $this->collSecurities->contains($obj)) {
                                $this->collSecurities->append($obj);
                            }
                        }

                        $this->collSecuritiesPartial = true;
                    }

                    return $collSecurities;
                }

                if ($partial && $this->collSecurities) {
                    foreach ($this->collSecurities as $obj) {
                        if ($obj->isNew()) {
                            $collSecurities[] = $obj;
                        }
                    }
                }

                $this->collSecurities = $collSecurities;
                $this->collSecuritiesPartial = false;
            }
        }

        return $this->collSecurities;
    }

    /**
     * Sets a collection of ChildSecurity objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $securities A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildRequests The current object (for fluent API support)
     */
    public function setSecurities(Collection $securities, ConnectionInterface $con = null)
    {
        /** @var ChildSecurity[] $securitiesToDelete */
        $securitiesToDelete = $this->getSecurities(new Criteria(), $con)->diff($securities);


        $this->securitiesScheduledForDeletion = $securitiesToDelete;

        foreach ($securitiesToDelete as $securityRemoved) {
            $securityRemoved->setRequests(null);
        }

        $this->collSecurities = null;
        foreach ($securities as $security) {
            $this->addSecurity($security);
        }

        $this->collSecurities = $securities;
        $this->collSecuritiesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Security objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Security objects.
     * @throws PropelException
     */
    public function countSecurities(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSecuritiesPartial && !$this->isNew();
        if (null === $this->collSecurities || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSecurities) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSecurities());
            }

            $query = ChildSecurityQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByRequests($this)
                ->count($con);
        }

        return count($this->collSecurities);
    }

    /**
     * Method called to associate a ChildSecurity object to this object
     * through the ChildSecurity foreign key attribute.
     *
     * @param  ChildSecurity $l ChildSecurity
     * @return $this|\Requests The current object (for fluent API support)
     */
    public function addSecurity(ChildSecurity $l)
    {
        if ($this->collSecurities === null) {
            $this->initSecurities();
            $this->collSecuritiesPartial = true;
        }

        if (!$this->collSecurities->contains($l)) {
            $this->doAddSecurity($l);

            if ($this->securitiesScheduledForDeletion and $this->securitiesScheduledForDeletion->contains($l)) {
                $this->securitiesScheduledForDeletion->remove($this->securitiesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSecurity $security The ChildSecurity object to add.
     */
    protected function doAddSecurity(ChildSecurity $security)
    {
        $this->collSecurities[]= $security;
        $security->setRequests($this);
    }

    /**
     * @param  ChildSecurity $security The ChildSecurity object to remove.
     * @return $this|ChildRequests The current object (for fluent API support)
     */
    public function removeSecurity(ChildSecurity $security)
    {
        if ($this->getSecurities()->contains($security)) {
            $pos = $this->collSecurities->search($security);
            $this->collSecurities->remove($pos);
            if (null === $this->securitiesScheduledForDeletion) {
                $this->securitiesScheduledForDeletion = clone $this->collSecurities;
                $this->securitiesScheduledForDeletion->clear();
            }
            $this->securitiesScheduledForDeletion[]= $security;
            $security->setRequests(null);
        }

        return $this;
    }

    /**
     * Clears out the collRemotes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addRemotes()
     */
    public function clearRemotes()
    {
        $this->collRemotes = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collRemotes collection loaded partially.
     */
    public function resetPartialRemotes($v = true)
    {
        $this->collRemotesPartial = $v;
    }

    /**
     * Initializes the collRemotes collection.
     *
     * By default this just sets the collRemotes collection to an empty array (like clearcollRemotes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRemotes($overrideExisting = true)
    {
        if (null !== $this->collRemotes && !$overrideExisting) {
            return;
        }

        $collectionClassName = RemoteTableMap::getTableMap()->getCollectionClassName();

        $this->collRemotes = new $collectionClassName;
        $this->collRemotes->setModel('\Remote');
    }

    /**
     * Gets an array of ChildRemote objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildRequests is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildRemote[] List of ChildRemote objects
     * @throws PropelException
     */
    public function getRemotes(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collRemotesPartial && !$this->isNew();
        if (null === $this->collRemotes || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRemotes) {
                // return empty collection
                $this->initRemotes();
            } else {
                $collRemotes = ChildRemoteQuery::create(null, $criteria)
                    ->filterByRequests($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collRemotesPartial && count($collRemotes)) {
                        $this->initRemotes(false);

                        foreach ($collRemotes as $obj) {
                            if (false == $this->collRemotes->contains($obj)) {
                                $this->collRemotes->append($obj);
                            }
                        }

                        $this->collRemotesPartial = true;
                    }

                    return $collRemotes;
                }

                if ($partial && $this->collRemotes) {
                    foreach ($this->collRemotes as $obj) {
                        if ($obj->isNew()) {
                            $collRemotes[] = $obj;
                        }
                    }
                }

                $this->collRemotes = $collRemotes;
                $this->collRemotesPartial = false;
            }
        }

        return $this->collRemotes;
    }

    /**
     * Sets a collection of ChildRemote objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $remotes A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildRequests The current object (for fluent API support)
     */
    public function setRemotes(Collection $remotes, ConnectionInterface $con = null)
    {
        /** @var ChildRemote[] $remotesToDelete */
        $remotesToDelete = $this->getRemotes(new Criteria(), $con)->diff($remotes);


        $this->remotesScheduledForDeletion = $remotesToDelete;

        foreach ($remotesToDelete as $remoteRemoved) {
            $remoteRemoved->setRequests(null);
        }

        $this->collRemotes = null;
        foreach ($remotes as $remote) {
            $this->addRemote($remote);
        }

        $this->collRemotes = $remotes;
        $this->collRemotesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Remote objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Remote objects.
     * @throws PropelException
     */
    public function countRemotes(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collRemotesPartial && !$this->isNew();
        if (null === $this->collRemotes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRemotes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getRemotes());
            }

            $query = ChildRemoteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByRequests($this)
                ->count($con);
        }

        return count($this->collRemotes);
    }

    /**
     * Method called to associate a ChildRemote object to this object
     * through the ChildRemote foreign key attribute.
     *
     * @param  ChildRemote $l ChildRemote
     * @return $this|\Requests The current object (for fluent API support)
     */
    public function addRemote(ChildRemote $l)
    {
        if ($this->collRemotes === null) {
            $this->initRemotes();
            $this->collRemotesPartial = true;
        }

        if (!$this->collRemotes->contains($l)) {
            $this->doAddRemote($l);

            if ($this->remotesScheduledForDeletion and $this->remotesScheduledForDeletion->contains($l)) {
                $this->remotesScheduledForDeletion->remove($this->remotesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildRemote $remote The ChildRemote object to add.
     */
    protected function doAddRemote(ChildRemote $remote)
    {
        $this->collRemotes[]= $remote;
        $remote->setRequests($this);
    }

    /**
     * @param  ChildRemote $remote The ChildRemote object to remove.
     * @return $this|ChildRequests The current object (for fluent API support)
     */
    public function removeRemote(ChildRemote $remote)
    {
        if ($this->getRemotes()->contains($remote)) {
            $pos = $this->collRemotes->search($remote);
            $this->collRemotes->remove($pos);
            if (null === $this->remotesScheduledForDeletion) {
                $this->remotesScheduledForDeletion = clone $this->collRemotes;
                $this->remotesScheduledForDeletion->clear();
            }
            $this->remotesScheduledForDeletion[]= $remote;
            $remote->setRequests(null);
        }

        return $this;
    }

    /**
     * Clears out the collMails collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addMails()
     */
    public function clearMails()
    {
        $this->collMails = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collMails collection loaded partially.
     */
    public function resetPartialMails($v = true)
    {
        $this->collMailsPartial = $v;
    }

    /**
     * Initializes the collMails collection.
     *
     * By default this just sets the collMails collection to an empty array (like clearcollMails());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMails($overrideExisting = true)
    {
        if (null !== $this->collMails && !$overrideExisting) {
            return;
        }

        $collectionClassName = MailTableMap::getTableMap()->getCollectionClassName();

        $this->collMails = new $collectionClassName;
        $this->collMails->setModel('\Mail');
    }

    /**
     * Gets an array of ChildMail objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildRequests is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildMail[] List of ChildMail objects
     * @throws PropelException
     */
    public function getMails(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collMailsPartial && !$this->isNew();
        if (null === $this->collMails || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMails) {
                // return empty collection
                $this->initMails();
            } else {
                $collMails = ChildMailQuery::create(null, $criteria)
                    ->filterByRequests($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMailsPartial && count($collMails)) {
                        $this->initMails(false);

                        foreach ($collMails as $obj) {
                            if (false == $this->collMails->contains($obj)) {
                                $this->collMails->append($obj);
                            }
                        }

                        $this->collMailsPartial = true;
                    }

                    return $collMails;
                }

                if ($partial && $this->collMails) {
                    foreach ($this->collMails as $obj) {
                        if ($obj->isNew()) {
                            $collMails[] = $obj;
                        }
                    }
                }

                $this->collMails = $collMails;
                $this->collMailsPartial = false;
            }
        }

        return $this->collMails;
    }

    /**
     * Sets a collection of ChildMail objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $mails A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildRequests The current object (for fluent API support)
     */
    public function setMails(Collection $mails, ConnectionInterface $con = null)
    {
        /** @var ChildMail[] $mailsToDelete */
        $mailsToDelete = $this->getMails(new Criteria(), $con)->diff($mails);


        $this->mailsScheduledForDeletion = $mailsToDelete;

        foreach ($mailsToDelete as $mailRemoved) {
            $mailRemoved->setRequests(null);
        }

        $this->collMails = null;
        foreach ($mails as $mail) {
            $this->addMail($mail);
        }

        $this->collMails = $mails;
        $this->collMailsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Mail objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Mail objects.
     * @throws PropelException
     */
    public function countMails(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collMailsPartial && !$this->isNew();
        if (null === $this->collMails || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMails) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMails());
            }

            $query = ChildMailQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByRequests($this)
                ->count($con);
        }

        return count($this->collMails);
    }

    /**
     * Method called to associate a ChildMail object to this object
     * through the ChildMail foreign key attribute.
     *
     * @param  ChildMail $l ChildMail
     * @return $this|\Requests The current object (for fluent API support)
     */
    public function addMail(ChildMail $l)
    {
        if ($this->collMails === null) {
            $this->initMails();
            $this->collMailsPartial = true;
        }

        if (!$this->collMails->contains($l)) {
            $this->doAddMail($l);

            if ($this->mailsScheduledForDeletion and $this->mailsScheduledForDeletion->contains($l)) {
                $this->mailsScheduledForDeletion->remove($this->mailsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildMail $mail The ChildMail object to add.
     */
    protected function doAddMail(ChildMail $mail)
    {
        $this->collMails[]= $mail;
        $mail->setRequests($this);
    }

    /**
     * @param  ChildMail $mail The ChildMail object to remove.
     * @return $this|ChildRequests The current object (for fluent API support)
     */
    public function removeMail(ChildMail $mail)
    {
        if ($this->getMails()->contains($mail)) {
            $pos = $this->collMails->search($mail);
            $this->collMails->remove($pos);
            if (null === $this->mailsScheduledForDeletion) {
                $this->mailsScheduledForDeletion = clone $this->collMails;
                $this->mailsScheduledForDeletion->clear();
            }
            $this->mailsScheduledForDeletion[]= $mail;
            $mail->setRequests(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aUser) {
            $this->aUser->removeRequests($this);
        }
        $this->rid = null;
        $this->completed = null;
        $this->date = null;
        $this->resultup = null;
        $this->resultdown = null;
        $this->last_screen = null;
        $this->avg = null;
        $this->ext_uid = null;
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
            if ($this->collWebs) {
                foreach ($this->collWebs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collVideos) {
                foreach ($this->collVideos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGenerics) {
                foreach ($this->collGenerics as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collVoips) {
                foreach ($this->collVoips as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSecurities) {
                foreach ($this->collSecurities as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRemotes) {
                foreach ($this->collRemotes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMails) {
                foreach ($this->collMails as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collWebs = null;
        $this->collVideos = null;
        $this->collGenerics = null;
        $this->collVoips = null;
        $this->collSecurities = null;
        $this->collRemotes = null;
        $this->collMails = null;
        $this->aUser = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(RequestsTableMap::DEFAULT_STRING_FORMAT);
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
