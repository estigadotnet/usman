<?php namespace PHPMaker2020\p_usman; ?>
<?php

/**
 * Table class for tasks
 */
class tasks extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $TaskID;
	public $TaskName;
	public $ResourceID;
	public $Start;
	public $End;
	public $Description;
	public $Milestone;
	public $Duration;
	public $PercentComplete;
	public $Dependencies;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'tasks';
		$this->TableName = 'tasks';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tasks`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// TaskID
		$this->TaskID = new DbField('tasks', 'tasks', 'x_TaskID', 'TaskID', '`TaskID`', '`TaskID`', 200, 50, -1, FALSE, '`TaskID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TaskID->IsPrimaryKey = TRUE; // Primary key field
		$this->TaskID->Nullable = FALSE; // NOT NULL field
		$this->TaskID->Required = TRUE; // Required field
		$this->TaskID->Sortable = TRUE; // Allow sort
		$this->fields['TaskID'] = &$this->TaskID;

		// TaskName
		$this->TaskName = new DbField('tasks', 'tasks', 'x_TaskName', 'TaskName', '`TaskName`', '`TaskName`', 200, 50, -1, FALSE, '`TaskName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TaskName->Sortable = TRUE; // Allow sort
		$this->fields['TaskName'] = &$this->TaskName;

		// ResourceID
		$this->ResourceID = new DbField('tasks', 'tasks', 'x_ResourceID', 'ResourceID', '`ResourceID`', '`ResourceID`', 200, 50, -1, FALSE, '`ResourceID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ResourceID->Sortable = TRUE; // Allow sort
		$this->fields['ResourceID'] = &$this->ResourceID;

		// Start
		$this->Start = new DbField('tasks', 'tasks', 'x_Start', 'Start', '`Start`', CastDateFieldForLike("`Start`", 0, "DB"), 133, 10, 0, FALSE, '`Start`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Start->Sortable = TRUE; // Allow sort
		$this->Start->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['Start'] = &$this->Start;

		// End
		$this->End = new DbField('tasks', 'tasks', 'x_End', 'End', '`End`', CastDateFieldForLike("`End`", 0, "DB"), 133, 10, 0, FALSE, '`End`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->End->Sortable = TRUE; // Allow sort
		$this->End->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['End'] = &$this->End;

		// Description
		$this->Description = new DbField('tasks', 'tasks', 'x_Description', 'Description', '`Description`', '`Description`', 200, 50, -1, FALSE, '`Description`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Description->Sortable = TRUE; // Allow sort
		$this->fields['Description'] = &$this->Description;

		// Milestone
		$this->Milestone = new DbField('tasks', 'tasks', 'x_Milestone', 'Milestone', '`Milestone`', CastDateFieldForLike("`Milestone`", 0, "DB"), 133, 10, 0, FALSE, '`Milestone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Milestone->Sortable = TRUE; // Allow sort
		$this->Milestone->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['Milestone'] = &$this->Milestone;

		// Duration
		$this->Duration = new DbField('tasks', 'tasks', 'x_Duration', 'Duration', '`Duration`', '`Duration`', 5, 22, -1, FALSE, '`Duration`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Duration->Sortable = TRUE; // Allow sort
		$this->Duration->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Duration'] = &$this->Duration;

		// PercentComplete
		$this->PercentComplete = new DbField('tasks', 'tasks', 'x_PercentComplete', 'PercentComplete', '`PercentComplete`', '`PercentComplete`', 5, 22, -1, FALSE, '`PercentComplete`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PercentComplete->Sortable = TRUE; // Allow sort
		$this->PercentComplete->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['PercentComplete'] = &$this->PercentComplete;

		// Dependencies
		$this->Dependencies = new DbField('tasks', 'tasks', 'x_Dependencies', 'Dependencies', '`Dependencies`', '`Dependencies`', 200, 50, -1, FALSE, '`Dependencies`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Dependencies->Sortable = TRUE; // Allow sort
		$this->fields['Dependencies'] = &$this->Dependencies;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`tasks`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = Config("USER_ID_ALLOW");
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('TaskID', $rs))
				AddFilter($where, QuotedName('TaskID', $this->Dbid) . '=' . QuotedValue($rs['TaskID'], $this->TaskID->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->TaskID->DbValue = $row['TaskID'];
		$this->TaskName->DbValue = $row['TaskName'];
		$this->ResourceID->DbValue = $row['ResourceID'];
		$this->Start->DbValue = $row['Start'];
		$this->End->DbValue = $row['End'];
		$this->Description->DbValue = $row['Description'];
		$this->Milestone->DbValue = $row['Milestone'];
		$this->Duration->DbValue = $row['Duration'];
		$this->PercentComplete->DbValue = $row['PercentComplete'];
		$this->Dependencies->DbValue = $row['Dependencies'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`TaskID` = '@TaskID@'";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('TaskID', $row) ? $row['TaskID'] : NULL;
		else
			$val = $this->TaskID->OldValue !== NULL ? $this->TaskID->OldValue : $this->TaskID->CurrentValue;
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@TaskID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "taskslist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "tasksview.php")
			return $Language->phrase("View");
		elseif ($pageName == "tasksedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "tasksadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "taskslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("tasksview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("tasksview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "tasksadd.php?" . $this->getUrlParm($parm);
		else
			$url = "tasksadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("tasksedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("tasksadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("tasksdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "TaskID:" . JsonEncode($this->TaskID->CurrentValue, "string");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->TaskID->CurrentValue != NULL) {
			$url .= "TaskID=" . urlencode($this->TaskID->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("TaskID") !== NULL)
				$arKeys[] = Param("TaskID");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->TaskID->CurrentValue = $key;
			else
				$this->TaskID->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->TaskID->setDbValue($rs->fields('TaskID'));
		$this->TaskName->setDbValue($rs->fields('TaskName'));
		$this->ResourceID->setDbValue($rs->fields('ResourceID'));
		$this->Start->setDbValue($rs->fields('Start'));
		$this->End->setDbValue($rs->fields('End'));
		$this->Description->setDbValue($rs->fields('Description'));
		$this->Milestone->setDbValue($rs->fields('Milestone'));
		$this->Duration->setDbValue($rs->fields('Duration'));
		$this->PercentComplete->setDbValue($rs->fields('PercentComplete'));
		$this->Dependencies->setDbValue($rs->fields('Dependencies'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// TaskID
		// TaskName
		// ResourceID
		// Start
		// End
		// Description
		// Milestone
		// Duration
		// PercentComplete
		// Dependencies
		// TaskID

		$this->TaskID->ViewValue = $this->TaskID->CurrentValue;
		$this->TaskID->ViewCustomAttributes = "";

		// TaskName
		$this->TaskName->ViewValue = $this->TaskName->CurrentValue;
		$this->TaskName->ViewCustomAttributes = "";

		// ResourceID
		$this->ResourceID->ViewValue = $this->ResourceID->CurrentValue;
		$this->ResourceID->ViewCustomAttributes = "";

		// Start
		$this->Start->ViewValue = $this->Start->CurrentValue;
		$this->Start->ViewValue = FormatDateTime($this->Start->ViewValue, 0);
		$this->Start->ViewCustomAttributes = "";

		// End
		$this->End->ViewValue = $this->End->CurrentValue;
		$this->End->ViewValue = FormatDateTime($this->End->ViewValue, 0);
		$this->End->ViewCustomAttributes = "";

		// Description
		$this->Description->ViewValue = $this->Description->CurrentValue;
		$this->Description->ViewCustomAttributes = "";

		// Milestone
		$this->Milestone->ViewValue = $this->Milestone->CurrentValue;
		$this->Milestone->ViewValue = FormatDateTime($this->Milestone->ViewValue, 0);
		$this->Milestone->ViewCustomAttributes = "";

		// Duration
		$this->Duration->ViewValue = $this->Duration->CurrentValue;
		$this->Duration->ViewValue = FormatNumber($this->Duration->ViewValue, 2, -2, -2, -2);
		$this->Duration->ViewCustomAttributes = "";

		// PercentComplete
		$this->PercentComplete->ViewValue = $this->PercentComplete->CurrentValue;
		$this->PercentComplete->ViewValue = FormatNumber($this->PercentComplete->ViewValue, 2, -2, -2, -2);
		$this->PercentComplete->ViewCustomAttributes = "";

		// Dependencies
		$this->Dependencies->ViewValue = $this->Dependencies->CurrentValue;
		$this->Dependencies->ViewCustomAttributes = "";

		// TaskID
		$this->TaskID->LinkCustomAttributes = "";
		$this->TaskID->HrefValue = "";
		$this->TaskID->TooltipValue = "";

		// TaskName
		$this->TaskName->LinkCustomAttributes = "";
		$this->TaskName->HrefValue = "";
		$this->TaskName->TooltipValue = "";

		// ResourceID
		$this->ResourceID->LinkCustomAttributes = "";
		$this->ResourceID->HrefValue = "";
		$this->ResourceID->TooltipValue = "";

		// Start
		$this->Start->LinkCustomAttributes = "";
		$this->Start->HrefValue = "";
		$this->Start->TooltipValue = "";

		// End
		$this->End->LinkCustomAttributes = "";
		$this->End->HrefValue = "";
		$this->End->TooltipValue = "";

		// Description
		$this->Description->LinkCustomAttributes = "";
		$this->Description->HrefValue = "";
		$this->Description->TooltipValue = "";

		// Milestone
		$this->Milestone->LinkCustomAttributes = "";
		$this->Milestone->HrefValue = "";
		$this->Milestone->TooltipValue = "";

		// Duration
		$this->Duration->LinkCustomAttributes = "";
		$this->Duration->HrefValue = "";
		$this->Duration->TooltipValue = "";

		// PercentComplete
		$this->PercentComplete->LinkCustomAttributes = "";
		$this->PercentComplete->HrefValue = "";
		$this->PercentComplete->TooltipValue = "";

		// Dependencies
		$this->Dependencies->LinkCustomAttributes = "";
		$this->Dependencies->HrefValue = "";
		$this->Dependencies->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// TaskID
		$this->TaskID->EditAttrs["class"] = "form-control";
		$this->TaskID->EditCustomAttributes = "";
		if (!$this->TaskID->Raw)
			$this->TaskID->CurrentValue = HtmlDecode($this->TaskID->CurrentValue);
		$this->TaskID->EditValue = $this->TaskID->CurrentValue;
		$this->TaskID->PlaceHolder = RemoveHtml($this->TaskID->caption());

		// TaskName
		$this->TaskName->EditAttrs["class"] = "form-control";
		$this->TaskName->EditCustomAttributes = "";
		if (!$this->TaskName->Raw)
			$this->TaskName->CurrentValue = HtmlDecode($this->TaskName->CurrentValue);
		$this->TaskName->EditValue = $this->TaskName->CurrentValue;
		$this->TaskName->PlaceHolder = RemoveHtml($this->TaskName->caption());

		// ResourceID
		$this->ResourceID->EditAttrs["class"] = "form-control";
		$this->ResourceID->EditCustomAttributes = "";
		if (!$this->ResourceID->Raw)
			$this->ResourceID->CurrentValue = HtmlDecode($this->ResourceID->CurrentValue);
		$this->ResourceID->EditValue = $this->ResourceID->CurrentValue;
		$this->ResourceID->PlaceHolder = RemoveHtml($this->ResourceID->caption());

		// Start
		$this->Start->EditAttrs["class"] = "form-control";
		$this->Start->EditCustomAttributes = "";
		$this->Start->EditValue = FormatDateTime($this->Start->CurrentValue, 8);
		$this->Start->PlaceHolder = RemoveHtml($this->Start->caption());

		// End
		$this->End->EditAttrs["class"] = "form-control";
		$this->End->EditCustomAttributes = "";
		$this->End->EditValue = FormatDateTime($this->End->CurrentValue, 8);
		$this->End->PlaceHolder = RemoveHtml($this->End->caption());

		// Description
		$this->Description->EditAttrs["class"] = "form-control";
		$this->Description->EditCustomAttributes = "";
		if (!$this->Description->Raw)
			$this->Description->CurrentValue = HtmlDecode($this->Description->CurrentValue);
		$this->Description->EditValue = $this->Description->CurrentValue;
		$this->Description->PlaceHolder = RemoveHtml($this->Description->caption());

		// Milestone
		$this->Milestone->EditAttrs["class"] = "form-control";
		$this->Milestone->EditCustomAttributes = "";
		$this->Milestone->EditValue = FormatDateTime($this->Milestone->CurrentValue, 8);
		$this->Milestone->PlaceHolder = RemoveHtml($this->Milestone->caption());

		// Duration
		$this->Duration->EditAttrs["class"] = "form-control";
		$this->Duration->EditCustomAttributes = "";
		$this->Duration->EditValue = $this->Duration->CurrentValue;
		$this->Duration->PlaceHolder = RemoveHtml($this->Duration->caption());
		if (strval($this->Duration->EditValue) != "" && is_numeric($this->Duration->EditValue))
			$this->Duration->EditValue = FormatNumber($this->Duration->EditValue, -2, -2, -2, -2);
		

		// PercentComplete
		$this->PercentComplete->EditAttrs["class"] = "form-control";
		$this->PercentComplete->EditCustomAttributes = "";
		$this->PercentComplete->EditValue = $this->PercentComplete->CurrentValue;
		$this->PercentComplete->PlaceHolder = RemoveHtml($this->PercentComplete->caption());
		if (strval($this->PercentComplete->EditValue) != "" && is_numeric($this->PercentComplete->EditValue))
			$this->PercentComplete->EditValue = FormatNumber($this->PercentComplete->EditValue, -2, -2, -2, -2);
		

		// Dependencies
		$this->Dependencies->EditAttrs["class"] = "form-control";
		$this->Dependencies->EditCustomAttributes = "";
		if (!$this->Dependencies->Raw)
			$this->Dependencies->CurrentValue = HtmlDecode($this->Dependencies->CurrentValue);
		$this->Dependencies->EditValue = $this->Dependencies->CurrentValue;
		$this->Dependencies->PlaceHolder = RemoveHtml($this->Dependencies->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->TaskID);
					$doc->exportCaption($this->TaskName);
					$doc->exportCaption($this->ResourceID);
					$doc->exportCaption($this->Start);
					$doc->exportCaption($this->End);
					$doc->exportCaption($this->Description);
					$doc->exportCaption($this->Milestone);
					$doc->exportCaption($this->Duration);
					$doc->exportCaption($this->PercentComplete);
					$doc->exportCaption($this->Dependencies);
				} else {
					$doc->exportCaption($this->TaskID);
					$doc->exportCaption($this->TaskName);
					$doc->exportCaption($this->ResourceID);
					$doc->exportCaption($this->Start);
					$doc->exportCaption($this->End);
					$doc->exportCaption($this->Description);
					$doc->exportCaption($this->Milestone);
					$doc->exportCaption($this->Duration);
					$doc->exportCaption($this->PercentComplete);
					$doc->exportCaption($this->Dependencies);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->TaskID);
						$doc->exportField($this->TaskName);
						$doc->exportField($this->ResourceID);
						$doc->exportField($this->Start);
						$doc->exportField($this->End);
						$doc->exportField($this->Description);
						$doc->exportField($this->Milestone);
						$doc->exportField($this->Duration);
						$doc->exportField($this->PercentComplete);
						$doc->exportField($this->Dependencies);
					} else {
						$doc->exportField($this->TaskID);
						$doc->exportField($this->TaskName);
						$doc->exportField($this->ResourceID);
						$doc->exportField($this->Start);
						$doc->exportField($this->End);
						$doc->exportField($this->Description);
						$doc->exportField($this->Milestone);
						$doc->exportField($this->Duration);
						$doc->exportField($this->PercentComplete);
						$doc->exportField($this->Dependencies);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>