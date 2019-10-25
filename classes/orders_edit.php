<?php
namespace PHPMaker2020\p_usman;

/**
 * Page class
 */
class orders_edit extends orders
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}";

	// Table name
	public $TableName = 'orders';

	// Page object name
	public $PageObjName = "orders_edit";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (orders)
		if (!isset($GLOBALS["orders"]) || get_class($GLOBALS["orders"]) == PROJECT_NAMESPACE . "orders") {
			$GLOBALS["orders"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["orders"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees']))
			$GLOBALS['employees'] = new employees();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'orders');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (employees)
		$UserTable = $UserTable ?: new employees();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $orders;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($orders);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "ordersview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['OrderID'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->OrderID->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!$this->setupApiRequest())
			return FALSE;

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API request
	public function setupApiRequest()
	{
		global $Security;

		// Check security for API request
		If (ValidApiRequest()) {
			if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
			if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
			$Security->UserID_Loading();
			$Security->loadUserID();
			$Security->UserID_Loaded();
			return TRUE;
		}
		return FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (!$this->setupApiRequest()) {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("orderslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->OrderID->setVisibility();
		$this->CustomerID->setVisibility();
		$this->EmployeeID->setVisibility();
		$this->OrderDate->setVisibility();
		$this->RequiredDate->setVisibility();
		$this->ShippedDate->setVisibility();
		$this->ShipVia->setVisibility();
		$this->Freight->setVisibility();
		$this->ShipName->setVisibility();
		$this->ShipAddress->setVisibility();
		$this->ShipCity->setVisibility();
		$this->ShipRegion->setVisibility();
		$this->ShipPostalCode->setVisibility();
		$this->ShipCountry->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		// Check modal

		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get action code
			if (!$this->isShow()) // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($CurrentForm->hasValue("x_OrderID")) {
				$this->OrderID->setFormValue($CurrentForm->getValue("x_OrderID"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("OrderID") !== NULL) {
				$this->OrderID->setQueryStringValue(Get("OrderID"));
				$loadByQuery = TRUE;
			} else {
				$this->OrderID->CurrentValue = NULL;
			}
		}

		// Load current record
		$loaded = $this->loadRow();

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("orderslist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "orderslist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'OrderID' first before field var 'x_OrderID'
		$val = $CurrentForm->hasValue("OrderID") ? $CurrentForm->getValue("OrderID") : $CurrentForm->getValue("x_OrderID");
		if (!$this->OrderID->IsDetailKey)
			$this->OrderID->setFormValue($val);

		// Check field name 'CustomerID' first before field var 'x_CustomerID'
		$val = $CurrentForm->hasValue("CustomerID") ? $CurrentForm->getValue("CustomerID") : $CurrentForm->getValue("x_CustomerID");
		if (!$this->CustomerID->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CustomerID->Visible = FALSE; // Disable update for API request
			else
				$this->CustomerID->setFormValue($val);
		}

		// Check field name 'EmployeeID' first before field var 'x_EmployeeID'
		$val = $CurrentForm->hasValue("EmployeeID") ? $CurrentForm->getValue("EmployeeID") : $CurrentForm->getValue("x_EmployeeID");
		if (!$this->EmployeeID->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->EmployeeID->Visible = FALSE; // Disable update for API request
			else
				$this->EmployeeID->setFormValue($val);
		}

		// Check field name 'OrderDate' first before field var 'x_OrderDate'
		$val = $CurrentForm->hasValue("OrderDate") ? $CurrentForm->getValue("OrderDate") : $CurrentForm->getValue("x_OrderDate");
		if (!$this->OrderDate->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->OrderDate->Visible = FALSE; // Disable update for API request
			else
				$this->OrderDate->setFormValue($val);
			$this->OrderDate->CurrentValue = UnFormatDateTime($this->OrderDate->CurrentValue, 0);
		}

		// Check field name 'RequiredDate' first before field var 'x_RequiredDate'
		$val = $CurrentForm->hasValue("RequiredDate") ? $CurrentForm->getValue("RequiredDate") : $CurrentForm->getValue("x_RequiredDate");
		if (!$this->RequiredDate->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->RequiredDate->Visible = FALSE; // Disable update for API request
			else
				$this->RequiredDate->setFormValue($val);
			$this->RequiredDate->CurrentValue = UnFormatDateTime($this->RequiredDate->CurrentValue, 0);
		}

		// Check field name 'ShippedDate' first before field var 'x_ShippedDate'
		$val = $CurrentForm->hasValue("ShippedDate") ? $CurrentForm->getValue("ShippedDate") : $CurrentForm->getValue("x_ShippedDate");
		if (!$this->ShippedDate->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ShippedDate->Visible = FALSE; // Disable update for API request
			else
				$this->ShippedDate->setFormValue($val);
			$this->ShippedDate->CurrentValue = UnFormatDateTime($this->ShippedDate->CurrentValue, 0);
		}

		// Check field name 'ShipVia' first before field var 'x_ShipVia'
		$val = $CurrentForm->hasValue("ShipVia") ? $CurrentForm->getValue("ShipVia") : $CurrentForm->getValue("x_ShipVia");
		if (!$this->ShipVia->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ShipVia->Visible = FALSE; // Disable update for API request
			else
				$this->ShipVia->setFormValue($val);
		}

		// Check field name 'Freight' first before field var 'x_Freight'
		$val = $CurrentForm->hasValue("Freight") ? $CurrentForm->getValue("Freight") : $CurrentForm->getValue("x_Freight");
		if (!$this->Freight->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Freight->Visible = FALSE; // Disable update for API request
			else
				$this->Freight->setFormValue($val);
		}

		// Check field name 'ShipName' first before field var 'x_ShipName'
		$val = $CurrentForm->hasValue("ShipName") ? $CurrentForm->getValue("ShipName") : $CurrentForm->getValue("x_ShipName");
		if (!$this->ShipName->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ShipName->Visible = FALSE; // Disable update for API request
			else
				$this->ShipName->setFormValue($val);
		}

		// Check field name 'ShipAddress' first before field var 'x_ShipAddress'
		$val = $CurrentForm->hasValue("ShipAddress") ? $CurrentForm->getValue("ShipAddress") : $CurrentForm->getValue("x_ShipAddress");
		if (!$this->ShipAddress->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ShipAddress->Visible = FALSE; // Disable update for API request
			else
				$this->ShipAddress->setFormValue($val);
		}

		// Check field name 'ShipCity' first before field var 'x_ShipCity'
		$val = $CurrentForm->hasValue("ShipCity") ? $CurrentForm->getValue("ShipCity") : $CurrentForm->getValue("x_ShipCity");
		if (!$this->ShipCity->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ShipCity->Visible = FALSE; // Disable update for API request
			else
				$this->ShipCity->setFormValue($val);
		}

		// Check field name 'ShipRegion' first before field var 'x_ShipRegion'
		$val = $CurrentForm->hasValue("ShipRegion") ? $CurrentForm->getValue("ShipRegion") : $CurrentForm->getValue("x_ShipRegion");
		if (!$this->ShipRegion->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ShipRegion->Visible = FALSE; // Disable update for API request
			else
				$this->ShipRegion->setFormValue($val);
		}

		// Check field name 'ShipPostalCode' first before field var 'x_ShipPostalCode'
		$val = $CurrentForm->hasValue("ShipPostalCode") ? $CurrentForm->getValue("ShipPostalCode") : $CurrentForm->getValue("x_ShipPostalCode");
		if (!$this->ShipPostalCode->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ShipPostalCode->Visible = FALSE; // Disable update for API request
			else
				$this->ShipPostalCode->setFormValue($val);
		}

		// Check field name 'ShipCountry' first before field var 'x_ShipCountry'
		$val = $CurrentForm->hasValue("ShipCountry") ? $CurrentForm->getValue("ShipCountry") : $CurrentForm->getValue("x_ShipCountry");
		if (!$this->ShipCountry->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ShipCountry->Visible = FALSE; // Disable update for API request
			else
				$this->ShipCountry->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->OrderID->CurrentValue = $this->OrderID->FormValue;
		$this->CustomerID->CurrentValue = $this->CustomerID->FormValue;
		$this->EmployeeID->CurrentValue = $this->EmployeeID->FormValue;
		$this->OrderDate->CurrentValue = $this->OrderDate->FormValue;
		$this->OrderDate->CurrentValue = UnFormatDateTime($this->OrderDate->CurrentValue, 0);
		$this->RequiredDate->CurrentValue = $this->RequiredDate->FormValue;
		$this->RequiredDate->CurrentValue = UnFormatDateTime($this->RequiredDate->CurrentValue, 0);
		$this->ShippedDate->CurrentValue = $this->ShippedDate->FormValue;
		$this->ShippedDate->CurrentValue = UnFormatDateTime($this->ShippedDate->CurrentValue, 0);
		$this->ShipVia->CurrentValue = $this->ShipVia->FormValue;
		$this->Freight->CurrentValue = $this->Freight->FormValue;
		$this->ShipName->CurrentValue = $this->ShipName->FormValue;
		$this->ShipAddress->CurrentValue = $this->ShipAddress->FormValue;
		$this->ShipCity->CurrentValue = $this->ShipCity->FormValue;
		$this->ShipRegion->CurrentValue = $this->ShipRegion->FormValue;
		$this->ShipPostalCode->CurrentValue = $this->ShipPostalCode->FormValue;
		$this->ShipCountry->CurrentValue = $this->ShipCountry->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->OrderID->setDbValue($row['OrderID']);
		$this->CustomerID->setDbValue($row['CustomerID']);
		$this->EmployeeID->setDbValue($row['EmployeeID']);
		$this->OrderDate->setDbValue($row['OrderDate']);
		$this->RequiredDate->setDbValue($row['RequiredDate']);
		$this->ShippedDate->setDbValue($row['ShippedDate']);
		$this->ShipVia->setDbValue($row['ShipVia']);
		$this->Freight->setDbValue($row['Freight']);
		$this->ShipName->setDbValue($row['ShipName']);
		$this->ShipAddress->setDbValue($row['ShipAddress']);
		$this->ShipCity->setDbValue($row['ShipCity']);
		$this->ShipRegion->setDbValue($row['ShipRegion']);
		$this->ShipPostalCode->setDbValue($row['ShipPostalCode']);
		$this->ShipCountry->setDbValue($row['ShipCountry']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['OrderID'] = NULL;
		$row['CustomerID'] = NULL;
		$row['EmployeeID'] = NULL;
		$row['OrderDate'] = NULL;
		$row['RequiredDate'] = NULL;
		$row['ShippedDate'] = NULL;
		$row['ShipVia'] = NULL;
		$row['Freight'] = NULL;
		$row['ShipName'] = NULL;
		$row['ShipAddress'] = NULL;
		$row['ShipCity'] = NULL;
		$row['ShipRegion'] = NULL;
		$row['ShipPostalCode'] = NULL;
		$row['ShipCountry'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("OrderID")) != "")
			$this->OrderID->OldValue = $this->getKey("OrderID"); // OrderID
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Freight->FormValue == $this->Freight->CurrentValue && is_numeric(ConvertToFloatString($this->Freight->CurrentValue)))
			$this->Freight->CurrentValue = ConvertToFloatString($this->Freight->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// OrderID
		// CustomerID
		// EmployeeID
		// OrderDate
		// RequiredDate
		// ShippedDate
		// ShipVia
		// Freight
		// ShipName
		// ShipAddress
		// ShipCity
		// ShipRegion
		// ShipPostalCode
		// ShipCountry

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// OrderID
			$this->OrderID->ViewValue = $this->OrderID->CurrentValue;
			$this->OrderID->ViewCustomAttributes = "";

			// CustomerID
			$this->CustomerID->ViewValue = $this->CustomerID->CurrentValue;
			$this->CustomerID->ViewCustomAttributes = "";

			// EmployeeID
			$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
			$this->EmployeeID->ViewValue = FormatNumber($this->EmployeeID->ViewValue, 0, -2, -2, -2);
			$this->EmployeeID->ViewCustomAttributes = "";

			// OrderDate
			$this->OrderDate->ViewValue = $this->OrderDate->CurrentValue;
			$this->OrderDate->ViewValue = FormatDateTime($this->OrderDate->ViewValue, 0);
			$this->OrderDate->ViewCustomAttributes = "";

			// RequiredDate
			$this->RequiredDate->ViewValue = $this->RequiredDate->CurrentValue;
			$this->RequiredDate->ViewValue = FormatDateTime($this->RequiredDate->ViewValue, 0);
			$this->RequiredDate->ViewCustomAttributes = "";

			// ShippedDate
			$this->ShippedDate->ViewValue = $this->ShippedDate->CurrentValue;
			$this->ShippedDate->ViewValue = FormatDateTime($this->ShippedDate->ViewValue, 0);
			$this->ShippedDate->ViewCustomAttributes = "";

			// ShipVia
			$this->ShipVia->ViewValue = $this->ShipVia->CurrentValue;
			$this->ShipVia->ViewValue = FormatNumber($this->ShipVia->ViewValue, 0, -2, -2, -2);
			$this->ShipVia->ViewCustomAttributes = "";

			// Freight
			$this->Freight->ViewValue = $this->Freight->CurrentValue;
			$this->Freight->ViewValue = FormatNumber($this->Freight->ViewValue, 2, -2, -2, -2);
			$this->Freight->ViewCustomAttributes = "";

			// ShipName
			$this->ShipName->ViewValue = $this->ShipName->CurrentValue;
			$this->ShipName->ViewCustomAttributes = "";

			// ShipAddress
			$this->ShipAddress->ViewValue = $this->ShipAddress->CurrentValue;
			$this->ShipAddress->ViewCustomAttributes = "";

			// ShipCity
			$this->ShipCity->ViewValue = $this->ShipCity->CurrentValue;
			$this->ShipCity->ViewCustomAttributes = "";

			// ShipRegion
			$this->ShipRegion->ViewValue = $this->ShipRegion->CurrentValue;
			$this->ShipRegion->ViewCustomAttributes = "";

			// ShipPostalCode
			$this->ShipPostalCode->ViewValue = $this->ShipPostalCode->CurrentValue;
			$this->ShipPostalCode->ViewCustomAttributes = "";

			// ShipCountry
			$this->ShipCountry->ViewValue = $this->ShipCountry->CurrentValue;
			$this->ShipCountry->ViewCustomAttributes = "";

			// OrderID
			$this->OrderID->LinkCustomAttributes = "";
			$this->OrderID->HrefValue = "";
			$this->OrderID->TooltipValue = "";

			// CustomerID
			$this->CustomerID->LinkCustomAttributes = "";
			$this->CustomerID->HrefValue = "";
			$this->CustomerID->TooltipValue = "";

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";
			$this->EmployeeID->TooltipValue = "";

			// OrderDate
			$this->OrderDate->LinkCustomAttributes = "";
			$this->OrderDate->HrefValue = "";
			$this->OrderDate->TooltipValue = "";

			// RequiredDate
			$this->RequiredDate->LinkCustomAttributes = "";
			$this->RequiredDate->HrefValue = "";
			$this->RequiredDate->TooltipValue = "";

			// ShippedDate
			$this->ShippedDate->LinkCustomAttributes = "";
			$this->ShippedDate->HrefValue = "";
			$this->ShippedDate->TooltipValue = "";

			// ShipVia
			$this->ShipVia->LinkCustomAttributes = "";
			$this->ShipVia->HrefValue = "";
			$this->ShipVia->TooltipValue = "";

			// Freight
			$this->Freight->LinkCustomAttributes = "";
			$this->Freight->HrefValue = "";
			$this->Freight->TooltipValue = "";

			// ShipName
			$this->ShipName->LinkCustomAttributes = "";
			$this->ShipName->HrefValue = "";
			$this->ShipName->TooltipValue = "";

			// ShipAddress
			$this->ShipAddress->LinkCustomAttributes = "";
			$this->ShipAddress->HrefValue = "";
			$this->ShipAddress->TooltipValue = "";

			// ShipCity
			$this->ShipCity->LinkCustomAttributes = "";
			$this->ShipCity->HrefValue = "";
			$this->ShipCity->TooltipValue = "";

			// ShipRegion
			$this->ShipRegion->LinkCustomAttributes = "";
			$this->ShipRegion->HrefValue = "";
			$this->ShipRegion->TooltipValue = "";

			// ShipPostalCode
			$this->ShipPostalCode->LinkCustomAttributes = "";
			$this->ShipPostalCode->HrefValue = "";
			$this->ShipPostalCode->TooltipValue = "";

			// ShipCountry
			$this->ShipCountry->LinkCustomAttributes = "";
			$this->ShipCountry->HrefValue = "";
			$this->ShipCountry->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// OrderID
			$this->OrderID->EditAttrs["class"] = "form-control";
			$this->OrderID->EditCustomAttributes = "";
			$this->OrderID->EditValue = $this->OrderID->CurrentValue;
			$this->OrderID->ViewCustomAttributes = "";

			// CustomerID
			$this->CustomerID->EditAttrs["class"] = "form-control";
			$this->CustomerID->EditCustomAttributes = "";
			if (!$this->CustomerID->Raw)
				$this->CustomerID->CurrentValue = HtmlDecode($this->CustomerID->CurrentValue);
			$this->CustomerID->EditValue = HtmlEncode($this->CustomerID->CurrentValue);
			$this->CustomerID->PlaceHolder = RemoveHtml($this->CustomerID->caption());

			// EmployeeID
			$this->EmployeeID->EditAttrs["class"] = "form-control";
			$this->EmployeeID->EditCustomAttributes = "";
			$this->EmployeeID->EditValue = HtmlEncode($this->EmployeeID->CurrentValue);
			$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

			// OrderDate
			$this->OrderDate->EditAttrs["class"] = "form-control";
			$this->OrderDate->EditCustomAttributes = "";
			$this->OrderDate->EditValue = HtmlEncode(FormatDateTime($this->OrderDate->CurrentValue, 8));
			$this->OrderDate->PlaceHolder = RemoveHtml($this->OrderDate->caption());

			// RequiredDate
			$this->RequiredDate->EditAttrs["class"] = "form-control";
			$this->RequiredDate->EditCustomAttributes = "";
			$this->RequiredDate->EditValue = HtmlEncode(FormatDateTime($this->RequiredDate->CurrentValue, 8));
			$this->RequiredDate->PlaceHolder = RemoveHtml($this->RequiredDate->caption());

			// ShippedDate
			$this->ShippedDate->EditAttrs["class"] = "form-control";
			$this->ShippedDate->EditCustomAttributes = "";
			$this->ShippedDate->EditValue = HtmlEncode(FormatDateTime($this->ShippedDate->CurrentValue, 8));
			$this->ShippedDate->PlaceHolder = RemoveHtml($this->ShippedDate->caption());

			// ShipVia
			$this->ShipVia->EditAttrs["class"] = "form-control";
			$this->ShipVia->EditCustomAttributes = "";
			$this->ShipVia->EditValue = HtmlEncode($this->ShipVia->CurrentValue);
			$this->ShipVia->PlaceHolder = RemoveHtml($this->ShipVia->caption());

			// Freight
			$this->Freight->EditAttrs["class"] = "form-control";
			$this->Freight->EditCustomAttributes = "";
			$this->Freight->EditValue = HtmlEncode($this->Freight->CurrentValue);
			$this->Freight->PlaceHolder = RemoveHtml($this->Freight->caption());
			if (strval($this->Freight->EditValue) != "" && is_numeric($this->Freight->EditValue))
				$this->Freight->EditValue = FormatNumber($this->Freight->EditValue, -2, -2, -2, -2);
			

			// ShipName
			$this->ShipName->EditAttrs["class"] = "form-control";
			$this->ShipName->EditCustomAttributes = "";
			if (!$this->ShipName->Raw)
				$this->ShipName->CurrentValue = HtmlDecode($this->ShipName->CurrentValue);
			$this->ShipName->EditValue = HtmlEncode($this->ShipName->CurrentValue);
			$this->ShipName->PlaceHolder = RemoveHtml($this->ShipName->caption());

			// ShipAddress
			$this->ShipAddress->EditAttrs["class"] = "form-control";
			$this->ShipAddress->EditCustomAttributes = "";
			if (!$this->ShipAddress->Raw)
				$this->ShipAddress->CurrentValue = HtmlDecode($this->ShipAddress->CurrentValue);
			$this->ShipAddress->EditValue = HtmlEncode($this->ShipAddress->CurrentValue);
			$this->ShipAddress->PlaceHolder = RemoveHtml($this->ShipAddress->caption());

			// ShipCity
			$this->ShipCity->EditAttrs["class"] = "form-control";
			$this->ShipCity->EditCustomAttributes = "";
			if (!$this->ShipCity->Raw)
				$this->ShipCity->CurrentValue = HtmlDecode($this->ShipCity->CurrentValue);
			$this->ShipCity->EditValue = HtmlEncode($this->ShipCity->CurrentValue);
			$this->ShipCity->PlaceHolder = RemoveHtml($this->ShipCity->caption());

			// ShipRegion
			$this->ShipRegion->EditAttrs["class"] = "form-control";
			$this->ShipRegion->EditCustomAttributes = "";
			if (!$this->ShipRegion->Raw)
				$this->ShipRegion->CurrentValue = HtmlDecode($this->ShipRegion->CurrentValue);
			$this->ShipRegion->EditValue = HtmlEncode($this->ShipRegion->CurrentValue);
			$this->ShipRegion->PlaceHolder = RemoveHtml($this->ShipRegion->caption());

			// ShipPostalCode
			$this->ShipPostalCode->EditAttrs["class"] = "form-control";
			$this->ShipPostalCode->EditCustomAttributes = "";
			if (!$this->ShipPostalCode->Raw)
				$this->ShipPostalCode->CurrentValue = HtmlDecode($this->ShipPostalCode->CurrentValue);
			$this->ShipPostalCode->EditValue = HtmlEncode($this->ShipPostalCode->CurrentValue);
			$this->ShipPostalCode->PlaceHolder = RemoveHtml($this->ShipPostalCode->caption());

			// ShipCountry
			$this->ShipCountry->EditAttrs["class"] = "form-control";
			$this->ShipCountry->EditCustomAttributes = "";
			if (!$this->ShipCountry->Raw)
				$this->ShipCountry->CurrentValue = HtmlDecode($this->ShipCountry->CurrentValue);
			$this->ShipCountry->EditValue = HtmlEncode($this->ShipCountry->CurrentValue);
			$this->ShipCountry->PlaceHolder = RemoveHtml($this->ShipCountry->caption());

			// Edit refer script
			// OrderID

			$this->OrderID->LinkCustomAttributes = "";
			$this->OrderID->HrefValue = "";

			// CustomerID
			$this->CustomerID->LinkCustomAttributes = "";
			$this->CustomerID->HrefValue = "";

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";

			// OrderDate
			$this->OrderDate->LinkCustomAttributes = "";
			$this->OrderDate->HrefValue = "";

			// RequiredDate
			$this->RequiredDate->LinkCustomAttributes = "";
			$this->RequiredDate->HrefValue = "";

			// ShippedDate
			$this->ShippedDate->LinkCustomAttributes = "";
			$this->ShippedDate->HrefValue = "";

			// ShipVia
			$this->ShipVia->LinkCustomAttributes = "";
			$this->ShipVia->HrefValue = "";

			// Freight
			$this->Freight->LinkCustomAttributes = "";
			$this->Freight->HrefValue = "";

			// ShipName
			$this->ShipName->LinkCustomAttributes = "";
			$this->ShipName->HrefValue = "";

			// ShipAddress
			$this->ShipAddress->LinkCustomAttributes = "";
			$this->ShipAddress->HrefValue = "";

			// ShipCity
			$this->ShipCity->LinkCustomAttributes = "";
			$this->ShipCity->HrefValue = "";

			// ShipRegion
			$this->ShipRegion->LinkCustomAttributes = "";
			$this->ShipRegion->HrefValue = "";

			// ShipPostalCode
			$this->ShipPostalCode->LinkCustomAttributes = "";
			$this->ShipPostalCode->HrefValue = "";

			// ShipCountry
			$this->ShipCountry->LinkCustomAttributes = "";
			$this->ShipCountry->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->OrderID->Required) {
			if (!$this->OrderID->IsDetailKey && $this->OrderID->FormValue != NULL && $this->OrderID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OrderID->caption(), $this->OrderID->RequiredErrorMessage));
			}
		}
		if ($this->CustomerID->Required) {
			if (!$this->CustomerID->IsDetailKey && $this->CustomerID->FormValue != NULL && $this->CustomerID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CustomerID->caption(), $this->CustomerID->RequiredErrorMessage));
			}
		}
		if ($this->EmployeeID->Required) {
			if (!$this->EmployeeID->IsDetailKey && $this->EmployeeID->FormValue != NULL && $this->EmployeeID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EmployeeID->caption(), $this->EmployeeID->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->EmployeeID->FormValue)) {
			AddMessage($FormError, $this->EmployeeID->errorMessage());
		}
		if ($this->OrderDate->Required) {
			if (!$this->OrderDate->IsDetailKey && $this->OrderDate->FormValue != NULL && $this->OrderDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OrderDate->caption(), $this->OrderDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->OrderDate->FormValue)) {
			AddMessage($FormError, $this->OrderDate->errorMessage());
		}
		if ($this->RequiredDate->Required) {
			if (!$this->RequiredDate->IsDetailKey && $this->RequiredDate->FormValue != NULL && $this->RequiredDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RequiredDate->caption(), $this->RequiredDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->RequiredDate->FormValue)) {
			AddMessage($FormError, $this->RequiredDate->errorMessage());
		}
		if ($this->ShippedDate->Required) {
			if (!$this->ShippedDate->IsDetailKey && $this->ShippedDate->FormValue != NULL && $this->ShippedDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ShippedDate->caption(), $this->ShippedDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ShippedDate->FormValue)) {
			AddMessage($FormError, $this->ShippedDate->errorMessage());
		}
		if ($this->ShipVia->Required) {
			if (!$this->ShipVia->IsDetailKey && $this->ShipVia->FormValue != NULL && $this->ShipVia->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ShipVia->caption(), $this->ShipVia->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ShipVia->FormValue)) {
			AddMessage($FormError, $this->ShipVia->errorMessage());
		}
		if ($this->Freight->Required) {
			if (!$this->Freight->IsDetailKey && $this->Freight->FormValue != NULL && $this->Freight->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Freight->caption(), $this->Freight->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Freight->FormValue)) {
			AddMessage($FormError, $this->Freight->errorMessage());
		}
		if ($this->ShipName->Required) {
			if (!$this->ShipName->IsDetailKey && $this->ShipName->FormValue != NULL && $this->ShipName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ShipName->caption(), $this->ShipName->RequiredErrorMessage));
			}
		}
		if ($this->ShipAddress->Required) {
			if (!$this->ShipAddress->IsDetailKey && $this->ShipAddress->FormValue != NULL && $this->ShipAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ShipAddress->caption(), $this->ShipAddress->RequiredErrorMessage));
			}
		}
		if ($this->ShipCity->Required) {
			if (!$this->ShipCity->IsDetailKey && $this->ShipCity->FormValue != NULL && $this->ShipCity->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ShipCity->caption(), $this->ShipCity->RequiredErrorMessage));
			}
		}
		if ($this->ShipRegion->Required) {
			if (!$this->ShipRegion->IsDetailKey && $this->ShipRegion->FormValue != NULL && $this->ShipRegion->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ShipRegion->caption(), $this->ShipRegion->RequiredErrorMessage));
			}
		}
		if ($this->ShipPostalCode->Required) {
			if (!$this->ShipPostalCode->IsDetailKey && $this->ShipPostalCode->FormValue != NULL && $this->ShipPostalCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ShipPostalCode->caption(), $this->ShipPostalCode->RequiredErrorMessage));
			}
		}
		if ($this->ShipCountry->Required) {
			if (!$this->ShipCountry->IsDetailKey && $this->ShipCountry->FormValue != NULL && $this->ShipCountry->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ShipCountry->caption(), $this->ShipCountry->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// CustomerID
			$this->CustomerID->setDbValueDef($rsnew, $this->CustomerID->CurrentValue, NULL, $this->CustomerID->ReadOnly);

			// EmployeeID
			$this->EmployeeID->setDbValueDef($rsnew, $this->EmployeeID->CurrentValue, NULL, $this->EmployeeID->ReadOnly);

			// OrderDate
			$this->OrderDate->setDbValueDef($rsnew, UnFormatDateTime($this->OrderDate->CurrentValue, 0), NULL, $this->OrderDate->ReadOnly);

			// RequiredDate
			$this->RequiredDate->setDbValueDef($rsnew, UnFormatDateTime($this->RequiredDate->CurrentValue, 0), NULL, $this->RequiredDate->ReadOnly);

			// ShippedDate
			$this->ShippedDate->setDbValueDef($rsnew, UnFormatDateTime($this->ShippedDate->CurrentValue, 0), NULL, $this->ShippedDate->ReadOnly);

			// ShipVia
			$this->ShipVia->setDbValueDef($rsnew, $this->ShipVia->CurrentValue, NULL, $this->ShipVia->ReadOnly);

			// Freight
			$this->Freight->setDbValueDef($rsnew, $this->Freight->CurrentValue, NULL, $this->Freight->ReadOnly);

			// ShipName
			$this->ShipName->setDbValueDef($rsnew, $this->ShipName->CurrentValue, NULL, $this->ShipName->ReadOnly);

			// ShipAddress
			$this->ShipAddress->setDbValueDef($rsnew, $this->ShipAddress->CurrentValue, NULL, $this->ShipAddress->ReadOnly);

			// ShipCity
			$this->ShipCity->setDbValueDef($rsnew, $this->ShipCity->CurrentValue, NULL, $this->ShipCity->ReadOnly);

			// ShipRegion
			$this->ShipRegion->setDbValueDef($rsnew, $this->ShipRegion->CurrentValue, NULL, $this->ShipRegion->ReadOnly);

			// ShipPostalCode
			$this->ShipPostalCode->setDbValueDef($rsnew, $this->ShipPostalCode->CurrentValue, NULL, $this->ShipPostalCode->ReadOnly);

			// ShipCountry
			$this->ShipCountry->setDbValueDef($rsnew, $this->ShipCountry->CurrentValue, NULL, $this->ShipCountry->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew); 
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("orderslist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			} elseif ($pageNo !== NULL) {
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>