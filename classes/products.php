<?php namespace PHPMaker2020\p_usman; ?>
<?php

/**
 * Table class for products
 */
class products extends DbTable
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
	public $ProductID;
	public $ProductName;
	public $SupplierID;
	public $CategoryID;
	public $QuantityPerUnit;
	public $UnitPrice;
	public $UnitsInStock;
	public $UnitsOnOrder;
	public $ReorderLevel;
	public $Discontinued;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'products';
		$this->TableName = 'products';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`products`";
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

		// ProductID
		$this->ProductID = new DbField('products', 'products', 'x_ProductID', 'ProductID', '`ProductID`', '`ProductID`', 3, 11, -1, FALSE, '`ProductID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ProductID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ProductID->IsPrimaryKey = TRUE; // Primary key field
		$this->ProductID->Sortable = TRUE; // Allow sort
		$this->ProductID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ProductID'] = &$this->ProductID;

		// ProductName
		$this->ProductName = new DbField('products', 'products', 'x_ProductName', 'ProductName', '`ProductName`', '`ProductName`', 200, 40, -1, FALSE, '`ProductName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProductName->Sortable = TRUE; // Allow sort
		$this->fields['ProductName'] = &$this->ProductName;

		// SupplierID
		$this->SupplierID = new DbField('products', 'products', 'x_SupplierID', 'SupplierID', '`SupplierID`', '`SupplierID`', 3, 11, -1, FALSE, '`SupplierID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SupplierID->Sortable = TRUE; // Allow sort
		$this->SupplierID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SupplierID'] = &$this->SupplierID;

		// CategoryID
		$this->CategoryID = new DbField('products', 'products', 'x_CategoryID', 'CategoryID', '`CategoryID`', '`CategoryID`', 3, 11, -1, FALSE, '`CategoryID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CategoryID->Sortable = TRUE; // Allow sort
		$this->CategoryID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['CategoryID'] = &$this->CategoryID;

		// QuantityPerUnit
		$this->QuantityPerUnit = new DbField('products', 'products', 'x_QuantityPerUnit', 'QuantityPerUnit', '`QuantityPerUnit`', '`QuantityPerUnit`', 200, 20, -1, FALSE, '`QuantityPerUnit`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->QuantityPerUnit->Sortable = TRUE; // Allow sort
		$this->fields['QuantityPerUnit'] = &$this->QuantityPerUnit;

		// UnitPrice
		$this->UnitPrice = new DbField('products', 'products', 'x_UnitPrice', 'UnitPrice', '`UnitPrice`', '`UnitPrice`', 5, 22, -1, FALSE, '`UnitPrice`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UnitPrice->Sortable = TRUE; // Allow sort
		$this->UnitPrice->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['UnitPrice'] = &$this->UnitPrice;

		// UnitsInStock
		$this->UnitsInStock = new DbField('products', 'products', 'x_UnitsInStock', 'UnitsInStock', '`UnitsInStock`', '`UnitsInStock`', 2, 6, -1, FALSE, '`UnitsInStock`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UnitsInStock->Sortable = TRUE; // Allow sort
		$this->UnitsInStock->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['UnitsInStock'] = &$this->UnitsInStock;

		// UnitsOnOrder
		$this->UnitsOnOrder = new DbField('products', 'products', 'x_UnitsOnOrder', 'UnitsOnOrder', '`UnitsOnOrder`', '`UnitsOnOrder`', 2, 6, -1, FALSE, '`UnitsOnOrder`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UnitsOnOrder->Sortable = TRUE; // Allow sort
		$this->UnitsOnOrder->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['UnitsOnOrder'] = &$this->UnitsOnOrder;

		// ReorderLevel
		$this->ReorderLevel = new DbField('products', 'products', 'x_ReorderLevel', 'ReorderLevel', '`ReorderLevel`', '`ReorderLevel`', 2, 6, -1, FALSE, '`ReorderLevel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ReorderLevel->Sortable = TRUE; // Allow sort
		$this->ReorderLevel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ReorderLevel'] = &$this->ReorderLevel;

		// Discontinued
		$this->Discontinued = new DbField('products', 'products', 'x_Discontinued', 'Discontinued', '`Discontinued`', '`Discontinued`', 202, 1, -1, FALSE, '`Discontinued`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->Discontinued->Nullable = FALSE; // NOT NULL field
		$this->Discontinued->Sortable = TRUE; // Allow sort
		$this->Discontinued->DataType = DATATYPE_BOOLEAN;
		$this->Discontinued->Lookup = new Lookup('Discontinued', 'products', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->Discontinued->OptionCount = 2;
		$this->fields['Discontinued'] = &$this->Discontinued;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`products`";
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
			$this->ProductID->setDbValue($conn->insert_ID());
			$rs['ProductID'] = $this->ProductID->DbValue;
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
			if (array_key_exists('ProductID', $rs))
				AddFilter($where, QuotedName('ProductID', $this->Dbid) . '=' . QuotedValue($rs['ProductID'], $this->ProductID->DataType, $this->Dbid));
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
		$this->ProductID->DbValue = $row['ProductID'];
		$this->ProductName->DbValue = $row['ProductName'];
		$this->SupplierID->DbValue = $row['SupplierID'];
		$this->CategoryID->DbValue = $row['CategoryID'];
		$this->QuantityPerUnit->DbValue = $row['QuantityPerUnit'];
		$this->UnitPrice->DbValue = $row['UnitPrice'];
		$this->UnitsInStock->DbValue = $row['UnitsInStock'];
		$this->UnitsOnOrder->DbValue = $row['UnitsOnOrder'];
		$this->ReorderLevel->DbValue = $row['ReorderLevel'];
		$this->Discontinued->DbValue = $row['Discontinued'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ProductID` = @ProductID@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('ProductID', $row) ? $row['ProductID'] : NULL;
		else
			$val = $this->ProductID->OldValue !== NULL ? $this->ProductID->OldValue : $this->ProductID->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ProductID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "productslist.php";
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
		if ($pageName == "productsview.php")
			return $Language->phrase("View");
		elseif ($pageName == "productsedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "productsadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "productslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("productsview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("productsview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "productsadd.php?" . $this->getUrlParm($parm);
		else
			$url = "productsadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("productsedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("productsadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("productsdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ProductID:" . JsonEncode($this->ProductID->CurrentValue, "number");
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
		if ($this->ProductID->CurrentValue != NULL) {
			$url .= "ProductID=" . urlencode($this->ProductID->CurrentValue);
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
			if (Param("ProductID") !== NULL)
				$arKeys[] = Param("ProductID");
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
				$this->ProductID->CurrentValue = $key;
			else
				$this->ProductID->OldValue = $key;
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
		$this->ProductID->setDbValue($rs->fields('ProductID'));
		$this->ProductName->setDbValue($rs->fields('ProductName'));
		$this->SupplierID->setDbValue($rs->fields('SupplierID'));
		$this->CategoryID->setDbValue($rs->fields('CategoryID'));
		$this->QuantityPerUnit->setDbValue($rs->fields('QuantityPerUnit'));
		$this->UnitPrice->setDbValue($rs->fields('UnitPrice'));
		$this->UnitsInStock->setDbValue($rs->fields('UnitsInStock'));
		$this->UnitsOnOrder->setDbValue($rs->fields('UnitsOnOrder'));
		$this->ReorderLevel->setDbValue($rs->fields('ReorderLevel'));
		$this->Discontinued->setDbValue($rs->fields('Discontinued'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ProductID
		// ProductName
		// SupplierID
		// CategoryID
		// QuantityPerUnit
		// UnitPrice
		// UnitsInStock
		// UnitsOnOrder
		// ReorderLevel
		// Discontinued
		// ProductID

		$this->ProductID->ViewValue = $this->ProductID->CurrentValue;
		$this->ProductID->ViewCustomAttributes = "";

		// ProductName
		$this->ProductName->ViewValue = $this->ProductName->CurrentValue;
		$this->ProductName->ViewCustomAttributes = "";

		// SupplierID
		$this->SupplierID->ViewValue = $this->SupplierID->CurrentValue;
		$this->SupplierID->ViewValue = FormatNumber($this->SupplierID->ViewValue, 0, -2, -2, -2);
		$this->SupplierID->ViewCustomAttributes = "";

		// CategoryID
		$this->CategoryID->ViewValue = $this->CategoryID->CurrentValue;
		$this->CategoryID->ViewValue = FormatNumber($this->CategoryID->ViewValue, 0, -2, -2, -2);
		$this->CategoryID->ViewCustomAttributes = "";

		// QuantityPerUnit
		$this->QuantityPerUnit->ViewValue = $this->QuantityPerUnit->CurrentValue;
		$this->QuantityPerUnit->ViewCustomAttributes = "";

		// UnitPrice
		$this->UnitPrice->ViewValue = $this->UnitPrice->CurrentValue;
		$this->UnitPrice->ViewValue = FormatNumber($this->UnitPrice->ViewValue, 2, -2, -2, -2);
		$this->UnitPrice->ViewCustomAttributes = "";

		// UnitsInStock
		$this->UnitsInStock->ViewValue = $this->UnitsInStock->CurrentValue;
		$this->UnitsInStock->ViewValue = FormatNumber($this->UnitsInStock->ViewValue, 0, -2, -2, -2);
		$this->UnitsInStock->ViewCustomAttributes = "";

		// UnitsOnOrder
		$this->UnitsOnOrder->ViewValue = $this->UnitsOnOrder->CurrentValue;
		$this->UnitsOnOrder->ViewValue = FormatNumber($this->UnitsOnOrder->ViewValue, 0, -2, -2, -2);
		$this->UnitsOnOrder->ViewCustomAttributes = "";

		// ReorderLevel
		$this->ReorderLevel->ViewValue = $this->ReorderLevel->CurrentValue;
		$this->ReorderLevel->ViewValue = FormatNumber($this->ReorderLevel->ViewValue, 0, -2, -2, -2);
		$this->ReorderLevel->ViewCustomAttributes = "";

		// Discontinued
		if (ConvertToBool($this->Discontinued->CurrentValue)) {
			$this->Discontinued->ViewValue = $this->Discontinued->tagCaption(1) != "" ? $this->Discontinued->tagCaption(1) : "1";
		} else {
			$this->Discontinued->ViewValue = $this->Discontinued->tagCaption(2) != "" ? $this->Discontinued->tagCaption(2) : "0";
		}
		$this->Discontinued->ViewCustomAttributes = "";

		// ProductID
		$this->ProductID->LinkCustomAttributes = "";
		$this->ProductID->HrefValue = "";
		$this->ProductID->TooltipValue = "";

		// ProductName
		$this->ProductName->LinkCustomAttributes = "";
		$this->ProductName->HrefValue = "";
		$this->ProductName->TooltipValue = "";

		// SupplierID
		$this->SupplierID->LinkCustomAttributes = "";
		$this->SupplierID->HrefValue = "";
		$this->SupplierID->TooltipValue = "";

		// CategoryID
		$this->CategoryID->LinkCustomAttributes = "";
		$this->CategoryID->HrefValue = "";
		$this->CategoryID->TooltipValue = "";

		// QuantityPerUnit
		$this->QuantityPerUnit->LinkCustomAttributes = "";
		$this->QuantityPerUnit->HrefValue = "";
		$this->QuantityPerUnit->TooltipValue = "";

		// UnitPrice
		$this->UnitPrice->LinkCustomAttributes = "";
		$this->UnitPrice->HrefValue = "";
		$this->UnitPrice->TooltipValue = "";

		// UnitsInStock
		$this->UnitsInStock->LinkCustomAttributes = "";
		$this->UnitsInStock->HrefValue = "";
		$this->UnitsInStock->TooltipValue = "";

		// UnitsOnOrder
		$this->UnitsOnOrder->LinkCustomAttributes = "";
		$this->UnitsOnOrder->HrefValue = "";
		$this->UnitsOnOrder->TooltipValue = "";

		// ReorderLevel
		$this->ReorderLevel->LinkCustomAttributes = "";
		$this->ReorderLevel->HrefValue = "";
		$this->ReorderLevel->TooltipValue = "";

		// Discontinued
		$this->Discontinued->LinkCustomAttributes = "";
		$this->Discontinued->HrefValue = "";
		$this->Discontinued->TooltipValue = "";

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

		// ProductID
		$this->ProductID->EditAttrs["class"] = "form-control";
		$this->ProductID->EditCustomAttributes = "";
		$this->ProductID->EditValue = $this->ProductID->CurrentValue;
		$this->ProductID->ViewCustomAttributes = "";

		// ProductName
		$this->ProductName->EditAttrs["class"] = "form-control";
		$this->ProductName->EditCustomAttributes = "";
		if (!$this->ProductName->Raw)
			$this->ProductName->CurrentValue = HtmlDecode($this->ProductName->CurrentValue);
		$this->ProductName->EditValue = $this->ProductName->CurrentValue;
		$this->ProductName->PlaceHolder = RemoveHtml($this->ProductName->caption());

		// SupplierID
		$this->SupplierID->EditAttrs["class"] = "form-control";
		$this->SupplierID->EditCustomAttributes = "";
		$this->SupplierID->EditValue = $this->SupplierID->CurrentValue;
		$this->SupplierID->PlaceHolder = RemoveHtml($this->SupplierID->caption());

		// CategoryID
		$this->CategoryID->EditAttrs["class"] = "form-control";
		$this->CategoryID->EditCustomAttributes = "";
		$this->CategoryID->EditValue = $this->CategoryID->CurrentValue;
		$this->CategoryID->PlaceHolder = RemoveHtml($this->CategoryID->caption());

		// QuantityPerUnit
		$this->QuantityPerUnit->EditAttrs["class"] = "form-control";
		$this->QuantityPerUnit->EditCustomAttributes = "";
		if (!$this->QuantityPerUnit->Raw)
			$this->QuantityPerUnit->CurrentValue = HtmlDecode($this->QuantityPerUnit->CurrentValue);
		$this->QuantityPerUnit->EditValue = $this->QuantityPerUnit->CurrentValue;
		$this->QuantityPerUnit->PlaceHolder = RemoveHtml($this->QuantityPerUnit->caption());

		// UnitPrice
		$this->UnitPrice->EditAttrs["class"] = "form-control";
		$this->UnitPrice->EditCustomAttributes = "";
		$this->UnitPrice->EditValue = $this->UnitPrice->CurrentValue;
		$this->UnitPrice->PlaceHolder = RemoveHtml($this->UnitPrice->caption());
		if (strval($this->UnitPrice->EditValue) != "" && is_numeric($this->UnitPrice->EditValue))
			$this->UnitPrice->EditValue = FormatNumber($this->UnitPrice->EditValue, -2, -2, -2, -2);
		

		// UnitsInStock
		$this->UnitsInStock->EditAttrs["class"] = "form-control";
		$this->UnitsInStock->EditCustomAttributes = "";
		$this->UnitsInStock->EditValue = $this->UnitsInStock->CurrentValue;
		$this->UnitsInStock->PlaceHolder = RemoveHtml($this->UnitsInStock->caption());

		// UnitsOnOrder
		$this->UnitsOnOrder->EditAttrs["class"] = "form-control";
		$this->UnitsOnOrder->EditCustomAttributes = "";
		$this->UnitsOnOrder->EditValue = $this->UnitsOnOrder->CurrentValue;
		$this->UnitsOnOrder->PlaceHolder = RemoveHtml($this->UnitsOnOrder->caption());

		// ReorderLevel
		$this->ReorderLevel->EditAttrs["class"] = "form-control";
		$this->ReorderLevel->EditCustomAttributes = "";
		$this->ReorderLevel->EditValue = $this->ReorderLevel->CurrentValue;
		$this->ReorderLevel->PlaceHolder = RemoveHtml($this->ReorderLevel->caption());

		// Discontinued
		$this->Discontinued->EditCustomAttributes = "";
		$this->Discontinued->EditValue = $this->Discontinued->options(FALSE);

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
					$doc->exportCaption($this->ProductID);
					$doc->exportCaption($this->ProductName);
					$doc->exportCaption($this->SupplierID);
					$doc->exportCaption($this->CategoryID);
					$doc->exportCaption($this->QuantityPerUnit);
					$doc->exportCaption($this->UnitPrice);
					$doc->exportCaption($this->UnitsInStock);
					$doc->exportCaption($this->UnitsOnOrder);
					$doc->exportCaption($this->ReorderLevel);
					$doc->exportCaption($this->Discontinued);
				} else {
					$doc->exportCaption($this->ProductID);
					$doc->exportCaption($this->ProductName);
					$doc->exportCaption($this->SupplierID);
					$doc->exportCaption($this->CategoryID);
					$doc->exportCaption($this->QuantityPerUnit);
					$doc->exportCaption($this->UnitPrice);
					$doc->exportCaption($this->UnitsInStock);
					$doc->exportCaption($this->UnitsOnOrder);
					$doc->exportCaption($this->ReorderLevel);
					$doc->exportCaption($this->Discontinued);
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
						$doc->exportField($this->ProductID);
						$doc->exportField($this->ProductName);
						$doc->exportField($this->SupplierID);
						$doc->exportField($this->CategoryID);
						$doc->exportField($this->QuantityPerUnit);
						$doc->exportField($this->UnitPrice);
						$doc->exportField($this->UnitsInStock);
						$doc->exportField($this->UnitsOnOrder);
						$doc->exportField($this->ReorderLevel);
						$doc->exportField($this->Discontinued);
					} else {
						$doc->exportField($this->ProductID);
						$doc->exportField($this->ProductName);
						$doc->exportField($this->SupplierID);
						$doc->exportField($this->CategoryID);
						$doc->exportField($this->QuantityPerUnit);
						$doc->exportField($this->UnitPrice);
						$doc->exportField($this->UnitsInStock);
						$doc->exportField($this->UnitsOnOrder);
						$doc->exportField($this->ReorderLevel);
						$doc->exportField($this->Discontinued);
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