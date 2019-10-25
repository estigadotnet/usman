<?php
namespace PHPMaker2020\p_usman;

/**
 * Page class
 */
class products_add extends products
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}";

	// Table name
	public $TableName = 'products';

	// Page object name
	public $PageObjName = "products_add";

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

		// Table object (products)
		if (!isset($GLOBALS["products"]) || get_class($GLOBALS["products"]) == PROJECT_NAMESPACE . "products") {
			$GLOBALS["products"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["products"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees']))
			$GLOBALS['employees'] = new employees();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'products');

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
		global $products;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($products);
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
					if ($pageName == "productsview.php")
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
			$key .= @$ar['ProductID'];
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
			$this->ProductID->Visible = FALSE;
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
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("productslist.php"));
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
		$this->ProductID->Visible = FALSE;
		$this->ProductName->setVisibility();
		$this->SupplierID->setVisibility();
		$this->CategoryID->setVisibility();
		$this->QuantityPerUnit->setVisibility();
		$this->UnitPrice->setVisibility();
		$this->UnitsInStock->setVisibility();
		$this->UnitsOnOrder->setVisibility();
		$this->ReorderLevel->setVisibility();
		$this->Discontinued->setVisibility();
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
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("ProductID") !== NULL) {
				$this->ProductID->setQueryStringValue(Get("ProductID"));
				$this->setKey("ProductID", $this->ProductID->CurrentValue); // Set up key
			} else {
				$this->setKey("ProductID", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("productslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "productslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "productsview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->ProductID->CurrentValue = NULL;
		$this->ProductID->OldValue = $this->ProductID->CurrentValue;
		$this->ProductName->CurrentValue = NULL;
		$this->ProductName->OldValue = $this->ProductName->CurrentValue;
		$this->SupplierID->CurrentValue = NULL;
		$this->SupplierID->OldValue = $this->SupplierID->CurrentValue;
		$this->CategoryID->CurrentValue = NULL;
		$this->CategoryID->OldValue = $this->CategoryID->CurrentValue;
		$this->QuantityPerUnit->CurrentValue = NULL;
		$this->QuantityPerUnit->OldValue = $this->QuantityPerUnit->CurrentValue;
		$this->UnitPrice->CurrentValue = NULL;
		$this->UnitPrice->OldValue = $this->UnitPrice->CurrentValue;
		$this->UnitsInStock->CurrentValue = NULL;
		$this->UnitsInStock->OldValue = $this->UnitsInStock->CurrentValue;
		$this->UnitsOnOrder->CurrentValue = NULL;
		$this->UnitsOnOrder->OldValue = $this->UnitsOnOrder->CurrentValue;
		$this->ReorderLevel->CurrentValue = NULL;
		$this->ReorderLevel->OldValue = $this->ReorderLevel->CurrentValue;
		$this->Discontinued->CurrentValue = "0";
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'ProductName' first before field var 'x_ProductName'
		$val = $CurrentForm->hasValue("ProductName") ? $CurrentForm->getValue("ProductName") : $CurrentForm->getValue("x_ProductName");
		if (!$this->ProductName->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ProductName->Visible = FALSE; // Disable update for API request
			else
				$this->ProductName->setFormValue($val);
		}

		// Check field name 'SupplierID' first before field var 'x_SupplierID'
		$val = $CurrentForm->hasValue("SupplierID") ? $CurrentForm->getValue("SupplierID") : $CurrentForm->getValue("x_SupplierID");
		if (!$this->SupplierID->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->SupplierID->Visible = FALSE; // Disable update for API request
			else
				$this->SupplierID->setFormValue($val);
		}

		// Check field name 'CategoryID' first before field var 'x_CategoryID'
		$val = $CurrentForm->hasValue("CategoryID") ? $CurrentForm->getValue("CategoryID") : $CurrentForm->getValue("x_CategoryID");
		if (!$this->CategoryID->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CategoryID->Visible = FALSE; // Disable update for API request
			else
				$this->CategoryID->setFormValue($val);
		}

		// Check field name 'QuantityPerUnit' first before field var 'x_QuantityPerUnit'
		$val = $CurrentForm->hasValue("QuantityPerUnit") ? $CurrentForm->getValue("QuantityPerUnit") : $CurrentForm->getValue("x_QuantityPerUnit");
		if (!$this->QuantityPerUnit->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->QuantityPerUnit->Visible = FALSE; // Disable update for API request
			else
				$this->QuantityPerUnit->setFormValue($val);
		}

		// Check field name 'UnitPrice' first before field var 'x_UnitPrice'
		$val = $CurrentForm->hasValue("UnitPrice") ? $CurrentForm->getValue("UnitPrice") : $CurrentForm->getValue("x_UnitPrice");
		if (!$this->UnitPrice->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->UnitPrice->Visible = FALSE; // Disable update for API request
			else
				$this->UnitPrice->setFormValue($val);
		}

		// Check field name 'UnitsInStock' first before field var 'x_UnitsInStock'
		$val = $CurrentForm->hasValue("UnitsInStock") ? $CurrentForm->getValue("UnitsInStock") : $CurrentForm->getValue("x_UnitsInStock");
		if (!$this->UnitsInStock->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->UnitsInStock->Visible = FALSE; // Disable update for API request
			else
				$this->UnitsInStock->setFormValue($val);
		}

		// Check field name 'UnitsOnOrder' first before field var 'x_UnitsOnOrder'
		$val = $CurrentForm->hasValue("UnitsOnOrder") ? $CurrentForm->getValue("UnitsOnOrder") : $CurrentForm->getValue("x_UnitsOnOrder");
		if (!$this->UnitsOnOrder->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->UnitsOnOrder->Visible = FALSE; // Disable update for API request
			else
				$this->UnitsOnOrder->setFormValue($val);
		}

		// Check field name 'ReorderLevel' first before field var 'x_ReorderLevel'
		$val = $CurrentForm->hasValue("ReorderLevel") ? $CurrentForm->getValue("ReorderLevel") : $CurrentForm->getValue("x_ReorderLevel");
		if (!$this->ReorderLevel->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ReorderLevel->Visible = FALSE; // Disable update for API request
			else
				$this->ReorderLevel->setFormValue($val);
		}

		// Check field name 'Discontinued' first before field var 'x_Discontinued'
		$val = $CurrentForm->hasValue("Discontinued") ? $CurrentForm->getValue("Discontinued") : $CurrentForm->getValue("x_Discontinued");
		if (!$this->Discontinued->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Discontinued->Visible = FALSE; // Disable update for API request
			else
				$this->Discontinued->setFormValue($val);
		}

		// Check field name 'ProductID' first before field var 'x_ProductID'
		$val = $CurrentForm->hasValue("ProductID") ? $CurrentForm->getValue("ProductID") : $CurrentForm->getValue("x_ProductID");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ProductName->CurrentValue = $this->ProductName->FormValue;
		$this->SupplierID->CurrentValue = $this->SupplierID->FormValue;
		$this->CategoryID->CurrentValue = $this->CategoryID->FormValue;
		$this->QuantityPerUnit->CurrentValue = $this->QuantityPerUnit->FormValue;
		$this->UnitPrice->CurrentValue = $this->UnitPrice->FormValue;
		$this->UnitsInStock->CurrentValue = $this->UnitsInStock->FormValue;
		$this->UnitsOnOrder->CurrentValue = $this->UnitsOnOrder->FormValue;
		$this->ReorderLevel->CurrentValue = $this->ReorderLevel->FormValue;
		$this->Discontinued->CurrentValue = $this->Discontinued->FormValue;
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
		$this->ProductID->setDbValue($row['ProductID']);
		$this->ProductName->setDbValue($row['ProductName']);
		$this->SupplierID->setDbValue($row['SupplierID']);
		$this->CategoryID->setDbValue($row['CategoryID']);
		$this->QuantityPerUnit->setDbValue($row['QuantityPerUnit']);
		$this->UnitPrice->setDbValue($row['UnitPrice']);
		$this->UnitsInStock->setDbValue($row['UnitsInStock']);
		$this->UnitsOnOrder->setDbValue($row['UnitsOnOrder']);
		$this->ReorderLevel->setDbValue($row['ReorderLevel']);
		$this->Discontinued->setDbValue($row['Discontinued']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ProductID'] = $this->ProductID->CurrentValue;
		$row['ProductName'] = $this->ProductName->CurrentValue;
		$row['SupplierID'] = $this->SupplierID->CurrentValue;
		$row['CategoryID'] = $this->CategoryID->CurrentValue;
		$row['QuantityPerUnit'] = $this->QuantityPerUnit->CurrentValue;
		$row['UnitPrice'] = $this->UnitPrice->CurrentValue;
		$row['UnitsInStock'] = $this->UnitsInStock->CurrentValue;
		$row['UnitsOnOrder'] = $this->UnitsOnOrder->CurrentValue;
		$row['ReorderLevel'] = $this->ReorderLevel->CurrentValue;
		$row['Discontinued'] = $this->Discontinued->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ProductID")) != "")
			$this->ProductID->OldValue = $this->getKey("ProductID"); // ProductID
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

		if ($this->UnitPrice->FormValue == $this->UnitPrice->CurrentValue && is_numeric(ConvertToFloatString($this->UnitPrice->CurrentValue)))
			$this->UnitPrice->CurrentValue = ConvertToFloatString($this->UnitPrice->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// ProductName
			$this->ProductName->EditAttrs["class"] = "form-control";
			$this->ProductName->EditCustomAttributes = "";
			if (!$this->ProductName->Raw)
				$this->ProductName->CurrentValue = HtmlDecode($this->ProductName->CurrentValue);
			$this->ProductName->EditValue = HtmlEncode($this->ProductName->CurrentValue);
			$this->ProductName->PlaceHolder = RemoveHtml($this->ProductName->caption());

			// SupplierID
			$this->SupplierID->EditAttrs["class"] = "form-control";
			$this->SupplierID->EditCustomAttributes = "";
			$this->SupplierID->EditValue = HtmlEncode($this->SupplierID->CurrentValue);
			$this->SupplierID->PlaceHolder = RemoveHtml($this->SupplierID->caption());

			// CategoryID
			$this->CategoryID->EditAttrs["class"] = "form-control";
			$this->CategoryID->EditCustomAttributes = "";
			$this->CategoryID->EditValue = HtmlEncode($this->CategoryID->CurrentValue);
			$this->CategoryID->PlaceHolder = RemoveHtml($this->CategoryID->caption());

			// QuantityPerUnit
			$this->QuantityPerUnit->EditAttrs["class"] = "form-control";
			$this->QuantityPerUnit->EditCustomAttributes = "";
			if (!$this->QuantityPerUnit->Raw)
				$this->QuantityPerUnit->CurrentValue = HtmlDecode($this->QuantityPerUnit->CurrentValue);
			$this->QuantityPerUnit->EditValue = HtmlEncode($this->QuantityPerUnit->CurrentValue);
			$this->QuantityPerUnit->PlaceHolder = RemoveHtml($this->QuantityPerUnit->caption());

			// UnitPrice
			$this->UnitPrice->EditAttrs["class"] = "form-control";
			$this->UnitPrice->EditCustomAttributes = "";
			$this->UnitPrice->EditValue = HtmlEncode($this->UnitPrice->CurrentValue);
			$this->UnitPrice->PlaceHolder = RemoveHtml($this->UnitPrice->caption());
			if (strval($this->UnitPrice->EditValue) != "" && is_numeric($this->UnitPrice->EditValue))
				$this->UnitPrice->EditValue = FormatNumber($this->UnitPrice->EditValue, -2, -2, -2, -2);
			

			// UnitsInStock
			$this->UnitsInStock->EditAttrs["class"] = "form-control";
			$this->UnitsInStock->EditCustomAttributes = "";
			$this->UnitsInStock->EditValue = HtmlEncode($this->UnitsInStock->CurrentValue);
			$this->UnitsInStock->PlaceHolder = RemoveHtml($this->UnitsInStock->caption());

			// UnitsOnOrder
			$this->UnitsOnOrder->EditAttrs["class"] = "form-control";
			$this->UnitsOnOrder->EditCustomAttributes = "";
			$this->UnitsOnOrder->EditValue = HtmlEncode($this->UnitsOnOrder->CurrentValue);
			$this->UnitsOnOrder->PlaceHolder = RemoveHtml($this->UnitsOnOrder->caption());

			// ReorderLevel
			$this->ReorderLevel->EditAttrs["class"] = "form-control";
			$this->ReorderLevel->EditCustomAttributes = "";
			$this->ReorderLevel->EditValue = HtmlEncode($this->ReorderLevel->CurrentValue);
			$this->ReorderLevel->PlaceHolder = RemoveHtml($this->ReorderLevel->caption());

			// Discontinued
			$this->Discontinued->EditCustomAttributes = "";
			$this->Discontinued->EditValue = $this->Discontinued->options(FALSE);

			// Add refer script
			// ProductName

			$this->ProductName->LinkCustomAttributes = "";
			$this->ProductName->HrefValue = "";

			// SupplierID
			$this->SupplierID->LinkCustomAttributes = "";
			$this->SupplierID->HrefValue = "";

			// CategoryID
			$this->CategoryID->LinkCustomAttributes = "";
			$this->CategoryID->HrefValue = "";

			// QuantityPerUnit
			$this->QuantityPerUnit->LinkCustomAttributes = "";
			$this->QuantityPerUnit->HrefValue = "";

			// UnitPrice
			$this->UnitPrice->LinkCustomAttributes = "";
			$this->UnitPrice->HrefValue = "";

			// UnitsInStock
			$this->UnitsInStock->LinkCustomAttributes = "";
			$this->UnitsInStock->HrefValue = "";

			// UnitsOnOrder
			$this->UnitsOnOrder->LinkCustomAttributes = "";
			$this->UnitsOnOrder->HrefValue = "";

			// ReorderLevel
			$this->ReorderLevel->LinkCustomAttributes = "";
			$this->ReorderLevel->HrefValue = "";

			// Discontinued
			$this->Discontinued->LinkCustomAttributes = "";
			$this->Discontinued->HrefValue = "";
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
		if ($this->ProductName->Required) {
			if (!$this->ProductName->IsDetailKey && $this->ProductName->FormValue != NULL && $this->ProductName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProductName->caption(), $this->ProductName->RequiredErrorMessage));
			}
		}
		if ($this->SupplierID->Required) {
			if (!$this->SupplierID->IsDetailKey && $this->SupplierID->FormValue != NULL && $this->SupplierID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SupplierID->caption(), $this->SupplierID->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->SupplierID->FormValue)) {
			AddMessage($FormError, $this->SupplierID->errorMessage());
		}
		if ($this->CategoryID->Required) {
			if (!$this->CategoryID->IsDetailKey && $this->CategoryID->FormValue != NULL && $this->CategoryID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CategoryID->caption(), $this->CategoryID->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->CategoryID->FormValue)) {
			AddMessage($FormError, $this->CategoryID->errorMessage());
		}
		if ($this->QuantityPerUnit->Required) {
			if (!$this->QuantityPerUnit->IsDetailKey && $this->QuantityPerUnit->FormValue != NULL && $this->QuantityPerUnit->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->QuantityPerUnit->caption(), $this->QuantityPerUnit->RequiredErrorMessage));
			}
		}
		if ($this->UnitPrice->Required) {
			if (!$this->UnitPrice->IsDetailKey && $this->UnitPrice->FormValue != NULL && $this->UnitPrice->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UnitPrice->caption(), $this->UnitPrice->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->UnitPrice->FormValue)) {
			AddMessage($FormError, $this->UnitPrice->errorMessage());
		}
		if ($this->UnitsInStock->Required) {
			if (!$this->UnitsInStock->IsDetailKey && $this->UnitsInStock->FormValue != NULL && $this->UnitsInStock->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UnitsInStock->caption(), $this->UnitsInStock->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->UnitsInStock->FormValue)) {
			AddMessage($FormError, $this->UnitsInStock->errorMessage());
		}
		if ($this->UnitsOnOrder->Required) {
			if (!$this->UnitsOnOrder->IsDetailKey && $this->UnitsOnOrder->FormValue != NULL && $this->UnitsOnOrder->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UnitsOnOrder->caption(), $this->UnitsOnOrder->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->UnitsOnOrder->FormValue)) {
			AddMessage($FormError, $this->UnitsOnOrder->errorMessage());
		}
		if ($this->ReorderLevel->Required) {
			if (!$this->ReorderLevel->IsDetailKey && $this->ReorderLevel->FormValue != NULL && $this->ReorderLevel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ReorderLevel->caption(), $this->ReorderLevel->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ReorderLevel->FormValue)) {
			AddMessage($FormError, $this->ReorderLevel->errorMessage());
		}
		if ($this->Discontinued->Required) {
			if ($this->Discontinued->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Discontinued->caption(), $this->Discontinued->RequiredErrorMessage));
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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// ProductName
		$this->ProductName->setDbValueDef($rsnew, $this->ProductName->CurrentValue, NULL, FALSE);

		// SupplierID
		$this->SupplierID->setDbValueDef($rsnew, $this->SupplierID->CurrentValue, NULL, FALSE);

		// CategoryID
		$this->CategoryID->setDbValueDef($rsnew, $this->CategoryID->CurrentValue, NULL, FALSE);

		// QuantityPerUnit
		$this->QuantityPerUnit->setDbValueDef($rsnew, $this->QuantityPerUnit->CurrentValue, NULL, FALSE);

		// UnitPrice
		$this->UnitPrice->setDbValueDef($rsnew, $this->UnitPrice->CurrentValue, NULL, FALSE);

		// UnitsInStock
		$this->UnitsInStock->setDbValueDef($rsnew, $this->UnitsInStock->CurrentValue, NULL, FALSE);

		// UnitsOnOrder
		$this->UnitsOnOrder->setDbValueDef($rsnew, $this->UnitsOnOrder->CurrentValue, NULL, FALSE);

		// ReorderLevel
		$this->ReorderLevel->setDbValueDef($rsnew, $this->ReorderLevel->CurrentValue, NULL, FALSE);

		// Discontinued
		$tmpBool = $this->Discontinued->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->Discontinued->setDbValueDef($rsnew, $tmpBool, 0, strval($this->Discontinued->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("productslist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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
				case "x_Discontinued":
					$conn = Conn("");
					break;
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