<?php namespace PHPMaker2020\p_usman; ?>
<?php

/**
 * Table class for suppliers
 */
class suppliers extends DbTable
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
	public $SupplierID;
	public $CompanyName;
	public $ContactName;
	public $ContactTitle;
	public $Address;
	public $City;
	public $Region;
	public $PostalCode;
	public $Country;
	public $Phone;
	public $Fax;
	public $HomePage;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'suppliers';
		$this->TableName = 'suppliers';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`suppliers`";
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

		// SupplierID
		$this->SupplierID = new DbField('suppliers', 'suppliers', 'x_SupplierID', 'SupplierID', '`SupplierID`', '`SupplierID`', 3, 11, -1, FALSE, '`SupplierID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->SupplierID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->SupplierID->IsPrimaryKey = TRUE; // Primary key field
		$this->SupplierID->Sortable = TRUE; // Allow sort
		$this->SupplierID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SupplierID'] = &$this->SupplierID;

		// CompanyName
		$this->CompanyName = new DbField('suppliers', 'suppliers', 'x_CompanyName', 'CompanyName', '`CompanyName`', '`CompanyName`', 200, 40, -1, FALSE, '`CompanyName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CompanyName->Sortable = TRUE; // Allow sort
		$this->fields['CompanyName'] = &$this->CompanyName;

		// ContactName
		$this->ContactName = new DbField('suppliers', 'suppliers', 'x_ContactName', 'ContactName', '`ContactName`', '`ContactName`', 200, 30, -1, FALSE, '`ContactName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ContactName->Sortable = TRUE; // Allow sort
		$this->fields['ContactName'] = &$this->ContactName;

		// ContactTitle
		$this->ContactTitle = new DbField('suppliers', 'suppliers', 'x_ContactTitle', 'ContactTitle', '`ContactTitle`', '`ContactTitle`', 200, 30, -1, FALSE, '`ContactTitle`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ContactTitle->Sortable = TRUE; // Allow sort
		$this->fields['ContactTitle'] = &$this->ContactTitle;

		// Address
		$this->Address = new DbField('suppliers', 'suppliers', 'x_Address', 'Address', '`Address`', '`Address`', 200, 60, -1, FALSE, '`Address`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Address->Sortable = TRUE; // Allow sort
		$this->fields['Address'] = &$this->Address;

		// City
		$this->City = new DbField('suppliers', 'suppliers', 'x_City', 'City', '`City`', '`City`', 200, 15, -1, FALSE, '`City`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->City->Sortable = TRUE; // Allow sort
		$this->fields['City'] = &$this->City;

		// Region
		$this->Region = new DbField('suppliers', 'suppliers', 'x_Region', 'Region', '`Region`', '`Region`', 200, 15, -1, FALSE, '`Region`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Region->Sortable = TRUE; // Allow sort
		$this->fields['Region'] = &$this->Region;

		// PostalCode
		$this->PostalCode = new DbField('suppliers', 'suppliers', 'x_PostalCode', 'PostalCode', '`PostalCode`', '`PostalCode`', 200, 10, -1, FALSE, '`PostalCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PostalCode->Sortable = TRUE; // Allow sort
		$this->fields['PostalCode'] = &$this->PostalCode;

		// Country
		$this->Country = new DbField('suppliers', 'suppliers', 'x_Country', 'Country', '`Country`', '`Country`', 200, 15, -1, FALSE, '`Country`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Country->Sortable = TRUE; // Allow sort
		$this->fields['Country'] = &$this->Country;

		// Phone
		$this->Phone = new DbField('suppliers', 'suppliers', 'x_Phone', 'Phone', '`Phone`', '`Phone`', 200, 24, -1, FALSE, '`Phone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Phone->Sortable = TRUE; // Allow sort
		$this->fields['Phone'] = &$this->Phone;

		// Fax
		$this->Fax = new DbField('suppliers', 'suppliers', 'x_Fax', 'Fax', '`Fax`', '`Fax`', 200, 24, -1, FALSE, '`Fax`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Fax->Sortable = TRUE; // Allow sort
		$this->fields['Fax'] = &$this->Fax;

		// HomePage
		$this->HomePage = new DbField('suppliers', 'suppliers', 'x_HomePage', 'HomePage', '`HomePage`', '`HomePage`', 201, -1, -1, FALSE, '`HomePage`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->HomePage->Sortable = TRUE; // Allow sort
		$this->fields['HomePage'] = &$this->HomePage;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`suppliers`";
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

			// Get insert id if necessary
			$this->SupplierID->setDbValue($conn->insert_ID());
			$rs['SupplierID'] = $this->SupplierID->DbValue;
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
			if (array_key_exists('SupplierID', $rs))
				AddFilter($where, QuotedName('SupplierID', $this->Dbid) . '=' . QuotedValue($rs['SupplierID'], $this->SupplierID->DataType, $this->Dbid));
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
		$this->SupplierID->DbValue = $row['SupplierID'];
		$this->CompanyName->DbValue = $row['CompanyName'];
		$this->ContactName->DbValue = $row['ContactName'];
		$this->ContactTitle->DbValue = $row['ContactTitle'];
		$this->Address->DbValue = $row['Address'];
		$this->City->DbValue = $row['City'];
		$this->Region->DbValue = $row['Region'];
		$this->PostalCode->DbValue = $row['PostalCode'];
		$this->Country->DbValue = $row['Country'];
		$this->Phone->DbValue = $row['Phone'];
		$this->Fax->DbValue = $row['Fax'];
		$this->HomePage->DbValue = $row['HomePage'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`SupplierID` = @SupplierID@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('SupplierID', $row) ? $row['SupplierID'] : NULL;
		else
			$val = $this->SupplierID->OldValue !== NULL ? $this->SupplierID->OldValue : $this->SupplierID->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@SupplierID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "supplierslist.php";
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
		if ($pageName == "suppliersview.php")
			return $Language->phrase("View");
		elseif ($pageName == "suppliersedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "suppliersadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "supplierslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("suppliersview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("suppliersview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "suppliersadd.php?" . $this->getUrlParm($parm);
		else
			$url = "suppliersadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("suppliersedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("suppliersadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("suppliersdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "SupplierID:" . JsonEncode($this->SupplierID->CurrentValue, "number");
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
		if ($this->SupplierID->CurrentValue != NULL) {
			$url .= "SupplierID=" . urlencode($this->SupplierID->CurrentValue);
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
			if (Param("SupplierID") !== NULL)
				$arKeys[] = Param("SupplierID");
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
				if (!is_numeric($key))
					continue;
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
				$this->SupplierID->CurrentValue = $key;
			else
				$this->SupplierID->OldValue = $key;
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
		$this->SupplierID->setDbValue($rs->fields('SupplierID'));
		$this->CompanyName->setDbValue($rs->fields('CompanyName'));
		$this->ContactName->setDbValue($rs->fields('ContactName'));
		$this->ContactTitle->setDbValue($rs->fields('ContactTitle'));
		$this->Address->setDbValue($rs->fields('Address'));
		$this->City->setDbValue($rs->fields('City'));
		$this->Region->setDbValue($rs->fields('Region'));
		$this->PostalCode->setDbValue($rs->fields('PostalCode'));
		$this->Country->setDbValue($rs->fields('Country'));
		$this->Phone->setDbValue($rs->fields('Phone'));
		$this->Fax->setDbValue($rs->fields('Fax'));
		$this->HomePage->setDbValue($rs->fields('HomePage'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// SupplierID
		// CompanyName
		// ContactName
		// ContactTitle
		// Address
		// City
		// Region
		// PostalCode
		// Country
		// Phone
		// Fax
		// HomePage
		// SupplierID

		$this->SupplierID->ViewValue = $this->SupplierID->CurrentValue;
		$this->SupplierID->ViewCustomAttributes = "";

		// CompanyName
		$this->CompanyName->ViewValue = $this->CompanyName->CurrentValue;
		$this->CompanyName->ViewCustomAttributes = "";

		// ContactName
		$this->ContactName->ViewValue = $this->ContactName->CurrentValue;
		$this->ContactName->ViewCustomAttributes = "";

		// ContactTitle
		$this->ContactTitle->ViewValue = $this->ContactTitle->CurrentValue;
		$this->ContactTitle->ViewCustomAttributes = "";

		// Address
		$this->Address->ViewValue = $this->Address->CurrentValue;
		$this->Address->ViewCustomAttributes = "";

		// City
		$this->City->ViewValue = $this->City->CurrentValue;
		$this->City->ViewCustomAttributes = "";

		// Region
		$this->Region->ViewValue = $this->Region->CurrentValue;
		$this->Region->ViewCustomAttributes = "";

		// PostalCode
		$this->PostalCode->ViewValue = $this->PostalCode->CurrentValue;
		$this->PostalCode->ViewCustomAttributes = "";

		// Country
		$this->Country->ViewValue = $this->Country->CurrentValue;
		$this->Country->ViewCustomAttributes = "";

		// Phone
		$this->Phone->ViewValue = $this->Phone->CurrentValue;
		$this->Phone->ViewCustomAttributes = "";

		// Fax
		$this->Fax->ViewValue = $this->Fax->CurrentValue;
		$this->Fax->ViewCustomAttributes = "";

		// HomePage
		$this->HomePage->ViewValue = $this->HomePage->CurrentValue;
		$this->HomePage->ViewCustomAttributes = "";

		// SupplierID
		$this->SupplierID->LinkCustomAttributes = "";
		$this->SupplierID->HrefValue = "";
		$this->SupplierID->TooltipValue = "";

		// CompanyName
		$this->CompanyName->LinkCustomAttributes = "";
		$this->CompanyName->HrefValue = "";
		$this->CompanyName->TooltipValue = "";

		// ContactName
		$this->ContactName->LinkCustomAttributes = "";
		$this->ContactName->HrefValue = "";
		$this->ContactName->TooltipValue = "";

		// ContactTitle
		$this->ContactTitle->LinkCustomAttributes = "";
		$this->ContactTitle->HrefValue = "";
		$this->ContactTitle->TooltipValue = "";

		// Address
		$this->Address->LinkCustomAttributes = "";
		$this->Address->HrefValue = "";
		$this->Address->TooltipValue = "";

		// City
		$this->City->LinkCustomAttributes = "";
		$this->City->HrefValue = "";
		$this->City->TooltipValue = "";

		// Region
		$this->Region->LinkCustomAttributes = "";
		$this->Region->HrefValue = "";
		$this->Region->TooltipValue = "";

		// PostalCode
		$this->PostalCode->LinkCustomAttributes = "";
		$this->PostalCode->HrefValue = "";
		$this->PostalCode->TooltipValue = "";

		// Country
		$this->Country->LinkCustomAttributes = "";
		$this->Country->HrefValue = "";
		$this->Country->TooltipValue = "";

		// Phone
		$this->Phone->LinkCustomAttributes = "";
		$this->Phone->HrefValue = "";
		$this->Phone->TooltipValue = "";

		// Fax
		$this->Fax->LinkCustomAttributes = "";
		$this->Fax->HrefValue = "";
		$this->Fax->TooltipValue = "";

		// HomePage
		$this->HomePage->LinkCustomAttributes = "";
		$this->HomePage->HrefValue = "";
		$this->HomePage->TooltipValue = "";

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

		// SupplierID
		$this->SupplierID->EditAttrs["class"] = "form-control";
		$this->SupplierID->EditCustomAttributes = "";
		$this->SupplierID->EditValue = $this->SupplierID->CurrentValue;
		$this->SupplierID->ViewCustomAttributes = "";

		// CompanyName
		$this->CompanyName->EditAttrs["class"] = "form-control";
		$this->CompanyName->EditCustomAttributes = "";
		if (!$this->CompanyName->Raw)
			$this->CompanyName->CurrentValue = HtmlDecode($this->CompanyName->CurrentValue);
		$this->CompanyName->EditValue = $this->CompanyName->CurrentValue;
		$this->CompanyName->PlaceHolder = RemoveHtml($this->CompanyName->caption());

		// ContactName
		$this->ContactName->EditAttrs["class"] = "form-control";
		$this->ContactName->EditCustomAttributes = "";
		if (!$this->ContactName->Raw)
			$this->ContactName->CurrentValue = HtmlDecode($this->ContactName->CurrentValue);
		$this->ContactName->EditValue = $this->ContactName->CurrentValue;
		$this->ContactName->PlaceHolder = RemoveHtml($this->ContactName->caption());

		// ContactTitle
		$this->ContactTitle->EditAttrs["class"] = "form-control";
		$this->ContactTitle->EditCustomAttributes = "";
		if (!$this->ContactTitle->Raw)
			$this->ContactTitle->CurrentValue = HtmlDecode($this->ContactTitle->CurrentValue);
		$this->ContactTitle->EditValue = $this->ContactTitle->CurrentValue;
		$this->ContactTitle->PlaceHolder = RemoveHtml($this->ContactTitle->caption());

		// Address
		$this->Address->EditAttrs["class"] = "form-control";
		$this->Address->EditCustomAttributes = "";
		if (!$this->Address->Raw)
			$this->Address->CurrentValue = HtmlDecode($this->Address->CurrentValue);
		$this->Address->EditValue = $this->Address->CurrentValue;
		$this->Address->PlaceHolder = RemoveHtml($this->Address->caption());

		// City
		$this->City->EditAttrs["class"] = "form-control";
		$this->City->EditCustomAttributes = "";
		if (!$this->City->Raw)
			$this->City->CurrentValue = HtmlDecode($this->City->CurrentValue);
		$this->City->EditValue = $this->City->CurrentValue;
		$this->City->PlaceHolder = RemoveHtml($this->City->caption());

		// Region
		$this->Region->EditAttrs["class"] = "form-control";
		$this->Region->EditCustomAttributes = "";
		if (!$this->Region->Raw)
			$this->Region->CurrentValue = HtmlDecode($this->Region->CurrentValue);
		$this->Region->EditValue = $this->Region->CurrentValue;
		$this->Region->PlaceHolder = RemoveHtml($this->Region->caption());

		// PostalCode
		$this->PostalCode->EditAttrs["class"] = "form-control";
		$this->PostalCode->EditCustomAttributes = "";
		if (!$this->PostalCode->Raw)
			$this->PostalCode->CurrentValue = HtmlDecode($this->PostalCode->CurrentValue);
		$this->PostalCode->EditValue = $this->PostalCode->CurrentValue;
		$this->PostalCode->PlaceHolder = RemoveHtml($this->PostalCode->caption());

		// Country
		$this->Country->EditAttrs["class"] = "form-control";
		$this->Country->EditCustomAttributes = "";
		if (!$this->Country->Raw)
			$this->Country->CurrentValue = HtmlDecode($this->Country->CurrentValue);
		$this->Country->EditValue = $this->Country->CurrentValue;
		$this->Country->PlaceHolder = RemoveHtml($this->Country->caption());

		// Phone
		$this->Phone->EditAttrs["class"] = "form-control";
		$this->Phone->EditCustomAttributes = "";
		if (!$this->Phone->Raw)
			$this->Phone->CurrentValue = HtmlDecode($this->Phone->CurrentValue);
		$this->Phone->EditValue = $this->Phone->CurrentValue;
		$this->Phone->PlaceHolder = RemoveHtml($this->Phone->caption());

		// Fax
		$this->Fax->EditAttrs["class"] = "form-control";
		$this->Fax->EditCustomAttributes = "";
		if (!$this->Fax->Raw)
			$this->Fax->CurrentValue = HtmlDecode($this->Fax->CurrentValue);
		$this->Fax->EditValue = $this->Fax->CurrentValue;
		$this->Fax->PlaceHolder = RemoveHtml($this->Fax->caption());

		// HomePage
		$this->HomePage->EditAttrs["class"] = "form-control";
		$this->HomePage->EditCustomAttributes = "";
		$this->HomePage->EditValue = $this->HomePage->CurrentValue;
		$this->HomePage->PlaceHolder = RemoveHtml($this->HomePage->caption());

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
					$doc->exportCaption($this->SupplierID);
					$doc->exportCaption($this->CompanyName);
					$doc->exportCaption($this->ContactName);
					$doc->exportCaption($this->ContactTitle);
					$doc->exportCaption($this->Address);
					$doc->exportCaption($this->City);
					$doc->exportCaption($this->Region);
					$doc->exportCaption($this->PostalCode);
					$doc->exportCaption($this->Country);
					$doc->exportCaption($this->Phone);
					$doc->exportCaption($this->Fax);
					$doc->exportCaption($this->HomePage);
				} else {
					$doc->exportCaption($this->SupplierID);
					$doc->exportCaption($this->CompanyName);
					$doc->exportCaption($this->ContactName);
					$doc->exportCaption($this->ContactTitle);
					$doc->exportCaption($this->Address);
					$doc->exportCaption($this->City);
					$doc->exportCaption($this->Region);
					$doc->exportCaption($this->PostalCode);
					$doc->exportCaption($this->Country);
					$doc->exportCaption($this->Phone);
					$doc->exportCaption($this->Fax);
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
						$doc->exportField($this->SupplierID);
						$doc->exportField($this->CompanyName);
						$doc->exportField($this->ContactName);
						$doc->exportField($this->ContactTitle);
						$doc->exportField($this->Address);
						$doc->exportField($this->City);
						$doc->exportField($this->Region);
						$doc->exportField($this->PostalCode);
						$doc->exportField($this->Country);
						$doc->exportField($this->Phone);
						$doc->exportField($this->Fax);
						$doc->exportField($this->HomePage);
					} else {
						$doc->exportField($this->SupplierID);
						$doc->exportField($this->CompanyName);
						$doc->exportField($this->ContactName);
						$doc->exportField($this->ContactTitle);
						$doc->exportField($this->Address);
						$doc->exportField($this->City);
						$doc->exportField($this->Region);
						$doc->exportField($this->PostalCode);
						$doc->exportField($this->Country);
						$doc->exportField($this->Phone);
						$doc->exportField($this->Fax);
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