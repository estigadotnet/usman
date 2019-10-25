<?php
namespace PHPMaker2020\p_usman;

/**
 * Page class
 */
class tasks_add extends tasks
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}";

	// Table name
	public $TableName = 'tasks';

	// Page object name
	public $PageObjName = "tasks_add";

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

		// Table object (tasks)
		if (!isset($GLOBALS["tasks"]) || get_class($GLOBALS["tasks"]) == PROJECT_NAMESPACE . "tasks") {
			$GLOBALS["tasks"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tasks"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees']))
			$GLOBALS['employees'] = new employees();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tasks');

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
		global $tasks;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($tasks);
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
					if ($pageName == "tasksview.php")
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
			$key .= @$ar['TaskID'];
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
					$this->terminate(GetUrl("taskslist.php"));
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
		$this->TaskID->setVisibility();
		$this->TaskName->setVisibility();
		$this->ResourceID->setVisibility();
		$this->Start->setVisibility();
		$this->End->setVisibility();
		$this->Description->setVisibility();
		$this->Milestone->setVisibility();
		$this->Duration->setVisibility();
		$this->PercentComplete->setVisibility();
		$this->Dependencies->setVisibility();
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
			if (Get("TaskID") !== NULL) {
				$this->TaskID->setQueryStringValue(Get("TaskID"));
				$this->setKey("TaskID", $this->TaskID->CurrentValue); // Set up key
			} else {
				$this->setKey("TaskID", ""); // Clear key
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
					$this->terminate("taskslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "taskslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "tasksview.php")
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
		$this->TaskID->CurrentValue = NULL;
		$this->TaskID->OldValue = $this->TaskID->CurrentValue;
		$this->TaskName->CurrentValue = NULL;
		$this->TaskName->OldValue = $this->TaskName->CurrentValue;
		$this->ResourceID->CurrentValue = NULL;
		$this->ResourceID->OldValue = $this->ResourceID->CurrentValue;
		$this->Start->CurrentValue = NULL;
		$this->Start->OldValue = $this->Start->CurrentValue;
		$this->End->CurrentValue = NULL;
		$this->End->OldValue = $this->End->CurrentValue;
		$this->Description->CurrentValue = NULL;
		$this->Description->OldValue = $this->Description->CurrentValue;
		$this->Milestone->CurrentValue = NULL;
		$this->Milestone->OldValue = $this->Milestone->CurrentValue;
		$this->Duration->CurrentValue = NULL;
		$this->Duration->OldValue = $this->Duration->CurrentValue;
		$this->PercentComplete->CurrentValue = NULL;
		$this->PercentComplete->OldValue = $this->PercentComplete->CurrentValue;
		$this->Dependencies->CurrentValue = NULL;
		$this->Dependencies->OldValue = $this->Dependencies->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'TaskID' first before field var 'x_TaskID'
		$val = $CurrentForm->hasValue("TaskID") ? $CurrentForm->getValue("TaskID") : $CurrentForm->getValue("x_TaskID");
		if (!$this->TaskID->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->TaskID->Visible = FALSE; // Disable update for API request
			else
				$this->TaskID->setFormValue($val);
		}

		// Check field name 'TaskName' first before field var 'x_TaskName'
		$val = $CurrentForm->hasValue("TaskName") ? $CurrentForm->getValue("TaskName") : $CurrentForm->getValue("x_TaskName");
		if (!$this->TaskName->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->TaskName->Visible = FALSE; // Disable update for API request
			else
				$this->TaskName->setFormValue($val);
		}

		// Check field name 'ResourceID' first before field var 'x_ResourceID'
		$val = $CurrentForm->hasValue("ResourceID") ? $CurrentForm->getValue("ResourceID") : $CurrentForm->getValue("x_ResourceID");
		if (!$this->ResourceID->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ResourceID->Visible = FALSE; // Disable update for API request
			else
				$this->ResourceID->setFormValue($val);
		}

		// Check field name 'Start' first before field var 'x_Start'
		$val = $CurrentForm->hasValue("Start") ? $CurrentForm->getValue("Start") : $CurrentForm->getValue("x_Start");
		if (!$this->Start->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Start->Visible = FALSE; // Disable update for API request
			else
				$this->Start->setFormValue($val);
			$this->Start->CurrentValue = UnFormatDateTime($this->Start->CurrentValue, 0);
		}

		// Check field name 'End' first before field var 'x_End'
		$val = $CurrentForm->hasValue("End") ? $CurrentForm->getValue("End") : $CurrentForm->getValue("x_End");
		if (!$this->End->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->End->Visible = FALSE; // Disable update for API request
			else
				$this->End->setFormValue($val);
			$this->End->CurrentValue = UnFormatDateTime($this->End->CurrentValue, 0);
		}

		// Check field name 'Description' first before field var 'x_Description'
		$val = $CurrentForm->hasValue("Description") ? $CurrentForm->getValue("Description") : $CurrentForm->getValue("x_Description");
		if (!$this->Description->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Description->Visible = FALSE; // Disable update for API request
			else
				$this->Description->setFormValue($val);
		}

		// Check field name 'Milestone' first before field var 'x_Milestone'
		$val = $CurrentForm->hasValue("Milestone") ? $CurrentForm->getValue("Milestone") : $CurrentForm->getValue("x_Milestone");
		if (!$this->Milestone->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Milestone->Visible = FALSE; // Disable update for API request
			else
				$this->Milestone->setFormValue($val);
			$this->Milestone->CurrentValue = UnFormatDateTime($this->Milestone->CurrentValue, 0);
		}

		// Check field name 'Duration' first before field var 'x_Duration'
		$val = $CurrentForm->hasValue("Duration") ? $CurrentForm->getValue("Duration") : $CurrentForm->getValue("x_Duration");
		if (!$this->Duration->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Duration->Visible = FALSE; // Disable update for API request
			else
				$this->Duration->setFormValue($val);
		}

		// Check field name 'PercentComplete' first before field var 'x_PercentComplete'
		$val = $CurrentForm->hasValue("PercentComplete") ? $CurrentForm->getValue("PercentComplete") : $CurrentForm->getValue("x_PercentComplete");
		if (!$this->PercentComplete->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PercentComplete->Visible = FALSE; // Disable update for API request
			else
				$this->PercentComplete->setFormValue($val);
		}

		// Check field name 'Dependencies' first before field var 'x_Dependencies'
		$val = $CurrentForm->hasValue("Dependencies") ? $CurrentForm->getValue("Dependencies") : $CurrentForm->getValue("x_Dependencies");
		if (!$this->Dependencies->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Dependencies->Visible = FALSE; // Disable update for API request
			else
				$this->Dependencies->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->TaskID->CurrentValue = $this->TaskID->FormValue;
		$this->TaskName->CurrentValue = $this->TaskName->FormValue;
		$this->ResourceID->CurrentValue = $this->ResourceID->FormValue;
		$this->Start->CurrentValue = $this->Start->FormValue;
		$this->Start->CurrentValue = UnFormatDateTime($this->Start->CurrentValue, 0);
		$this->End->CurrentValue = $this->End->FormValue;
		$this->End->CurrentValue = UnFormatDateTime($this->End->CurrentValue, 0);
		$this->Description->CurrentValue = $this->Description->FormValue;
		$this->Milestone->CurrentValue = $this->Milestone->FormValue;
		$this->Milestone->CurrentValue = UnFormatDateTime($this->Milestone->CurrentValue, 0);
		$this->Duration->CurrentValue = $this->Duration->FormValue;
		$this->PercentComplete->CurrentValue = $this->PercentComplete->FormValue;
		$this->Dependencies->CurrentValue = $this->Dependencies->FormValue;
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
		$this->TaskID->setDbValue($row['TaskID']);
		$this->TaskName->setDbValue($row['TaskName']);
		$this->ResourceID->setDbValue($row['ResourceID']);
		$this->Start->setDbValue($row['Start']);
		$this->End->setDbValue($row['End']);
		$this->Description->setDbValue($row['Description']);
		$this->Milestone->setDbValue($row['Milestone']);
		$this->Duration->setDbValue($row['Duration']);
		$this->PercentComplete->setDbValue($row['PercentComplete']);
		$this->Dependencies->setDbValue($row['Dependencies']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['TaskID'] = $this->TaskID->CurrentValue;
		$row['TaskName'] = $this->TaskName->CurrentValue;
		$row['ResourceID'] = $this->ResourceID->CurrentValue;
		$row['Start'] = $this->Start->CurrentValue;
		$row['End'] = $this->End->CurrentValue;
		$row['Description'] = $this->Description->CurrentValue;
		$row['Milestone'] = $this->Milestone->CurrentValue;
		$row['Duration'] = $this->Duration->CurrentValue;
		$row['PercentComplete'] = $this->PercentComplete->CurrentValue;
		$row['Dependencies'] = $this->Dependencies->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("TaskID")) != "")
			$this->TaskID->OldValue = $this->getKey("TaskID"); // TaskID
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

		if ($this->Duration->FormValue == $this->Duration->CurrentValue && is_numeric(ConvertToFloatString($this->Duration->CurrentValue)))
			$this->Duration->CurrentValue = ConvertToFloatString($this->Duration->CurrentValue);

		// Convert decimal values if posted back
		if ($this->PercentComplete->FormValue == $this->PercentComplete->CurrentValue && is_numeric(ConvertToFloatString($this->PercentComplete->CurrentValue)))
			$this->PercentComplete->CurrentValue = ConvertToFloatString($this->PercentComplete->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// TaskID
			$this->TaskID->EditAttrs["class"] = "form-control";
			$this->TaskID->EditCustomAttributes = "";
			if (!$this->TaskID->Raw)
				$this->TaskID->CurrentValue = HtmlDecode($this->TaskID->CurrentValue);
			$this->TaskID->EditValue = HtmlEncode($this->TaskID->CurrentValue);
			$this->TaskID->PlaceHolder = RemoveHtml($this->TaskID->caption());

			// TaskName
			$this->TaskName->EditAttrs["class"] = "form-control";
			$this->TaskName->EditCustomAttributes = "";
			if (!$this->TaskName->Raw)
				$this->TaskName->CurrentValue = HtmlDecode($this->TaskName->CurrentValue);
			$this->TaskName->EditValue = HtmlEncode($this->TaskName->CurrentValue);
			$this->TaskName->PlaceHolder = RemoveHtml($this->TaskName->caption());

			// ResourceID
			$this->ResourceID->EditAttrs["class"] = "form-control";
			$this->ResourceID->EditCustomAttributes = "";
			if (!$this->ResourceID->Raw)
				$this->ResourceID->CurrentValue = HtmlDecode($this->ResourceID->CurrentValue);
			$this->ResourceID->EditValue = HtmlEncode($this->ResourceID->CurrentValue);
			$this->ResourceID->PlaceHolder = RemoveHtml($this->ResourceID->caption());

			// Start
			$this->Start->EditAttrs["class"] = "form-control";
			$this->Start->EditCustomAttributes = "";
			$this->Start->EditValue = HtmlEncode(FormatDateTime($this->Start->CurrentValue, 8));
			$this->Start->PlaceHolder = RemoveHtml($this->Start->caption());

			// End
			$this->End->EditAttrs["class"] = "form-control";
			$this->End->EditCustomAttributes = "";
			$this->End->EditValue = HtmlEncode(FormatDateTime($this->End->CurrentValue, 8));
			$this->End->PlaceHolder = RemoveHtml($this->End->caption());

			// Description
			$this->Description->EditAttrs["class"] = "form-control";
			$this->Description->EditCustomAttributes = "";
			if (!$this->Description->Raw)
				$this->Description->CurrentValue = HtmlDecode($this->Description->CurrentValue);
			$this->Description->EditValue = HtmlEncode($this->Description->CurrentValue);
			$this->Description->PlaceHolder = RemoveHtml($this->Description->caption());

			// Milestone
			$this->Milestone->EditAttrs["class"] = "form-control";
			$this->Milestone->EditCustomAttributes = "";
			$this->Milestone->EditValue = HtmlEncode(FormatDateTime($this->Milestone->CurrentValue, 8));
			$this->Milestone->PlaceHolder = RemoveHtml($this->Milestone->caption());

			// Duration
			$this->Duration->EditAttrs["class"] = "form-control";
			$this->Duration->EditCustomAttributes = "";
			$this->Duration->EditValue = HtmlEncode($this->Duration->CurrentValue);
			$this->Duration->PlaceHolder = RemoveHtml($this->Duration->caption());
			if (strval($this->Duration->EditValue) != "" && is_numeric($this->Duration->EditValue))
				$this->Duration->EditValue = FormatNumber($this->Duration->EditValue, -2, -2, -2, -2);
			

			// PercentComplete
			$this->PercentComplete->EditAttrs["class"] = "form-control";
			$this->PercentComplete->EditCustomAttributes = "";
			$this->PercentComplete->EditValue = HtmlEncode($this->PercentComplete->CurrentValue);
			$this->PercentComplete->PlaceHolder = RemoveHtml($this->PercentComplete->caption());
			if (strval($this->PercentComplete->EditValue) != "" && is_numeric($this->PercentComplete->EditValue))
				$this->PercentComplete->EditValue = FormatNumber($this->PercentComplete->EditValue, -2, -2, -2, -2);
			

			// Dependencies
			$this->Dependencies->EditAttrs["class"] = "form-control";
			$this->Dependencies->EditCustomAttributes = "";
			if (!$this->Dependencies->Raw)
				$this->Dependencies->CurrentValue = HtmlDecode($this->Dependencies->CurrentValue);
			$this->Dependencies->EditValue = HtmlEncode($this->Dependencies->CurrentValue);
			$this->Dependencies->PlaceHolder = RemoveHtml($this->Dependencies->caption());

			// Add refer script
			// TaskID

			$this->TaskID->LinkCustomAttributes = "";
			$this->TaskID->HrefValue = "";

			// TaskName
			$this->TaskName->LinkCustomAttributes = "";
			$this->TaskName->HrefValue = "";

			// ResourceID
			$this->ResourceID->LinkCustomAttributes = "";
			$this->ResourceID->HrefValue = "";

			// Start
			$this->Start->LinkCustomAttributes = "";
			$this->Start->HrefValue = "";

			// End
			$this->End->LinkCustomAttributes = "";
			$this->End->HrefValue = "";

			// Description
			$this->Description->LinkCustomAttributes = "";
			$this->Description->HrefValue = "";

			// Milestone
			$this->Milestone->LinkCustomAttributes = "";
			$this->Milestone->HrefValue = "";

			// Duration
			$this->Duration->LinkCustomAttributes = "";
			$this->Duration->HrefValue = "";

			// PercentComplete
			$this->PercentComplete->LinkCustomAttributes = "";
			$this->PercentComplete->HrefValue = "";

			// Dependencies
			$this->Dependencies->LinkCustomAttributes = "";
			$this->Dependencies->HrefValue = "";
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
		if ($this->TaskID->Required) {
			if (!$this->TaskID->IsDetailKey && $this->TaskID->FormValue != NULL && $this->TaskID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TaskID->caption(), $this->TaskID->RequiredErrorMessage));
			}
		}
		if ($this->TaskName->Required) {
			if (!$this->TaskName->IsDetailKey && $this->TaskName->FormValue != NULL && $this->TaskName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TaskName->caption(), $this->TaskName->RequiredErrorMessage));
			}
		}
		if ($this->ResourceID->Required) {
			if (!$this->ResourceID->IsDetailKey && $this->ResourceID->FormValue != NULL && $this->ResourceID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ResourceID->caption(), $this->ResourceID->RequiredErrorMessage));
			}
		}
		if ($this->Start->Required) {
			if (!$this->Start->IsDetailKey && $this->Start->FormValue != NULL && $this->Start->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Start->caption(), $this->Start->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->Start->FormValue)) {
			AddMessage($FormError, $this->Start->errorMessage());
		}
		if ($this->End->Required) {
			if (!$this->End->IsDetailKey && $this->End->FormValue != NULL && $this->End->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->End->caption(), $this->End->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->End->FormValue)) {
			AddMessage($FormError, $this->End->errorMessage());
		}
		if ($this->Description->Required) {
			if (!$this->Description->IsDetailKey && $this->Description->FormValue != NULL && $this->Description->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Description->caption(), $this->Description->RequiredErrorMessage));
			}
		}
		if ($this->Milestone->Required) {
			if (!$this->Milestone->IsDetailKey && $this->Milestone->FormValue != NULL && $this->Milestone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Milestone->caption(), $this->Milestone->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->Milestone->FormValue)) {
			AddMessage($FormError, $this->Milestone->errorMessage());
		}
		if ($this->Duration->Required) {
			if (!$this->Duration->IsDetailKey && $this->Duration->FormValue != NULL && $this->Duration->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Duration->caption(), $this->Duration->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Duration->FormValue)) {
			AddMessage($FormError, $this->Duration->errorMessage());
		}
		if ($this->PercentComplete->Required) {
			if (!$this->PercentComplete->IsDetailKey && $this->PercentComplete->FormValue != NULL && $this->PercentComplete->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PercentComplete->caption(), $this->PercentComplete->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->PercentComplete->FormValue)) {
			AddMessage($FormError, $this->PercentComplete->errorMessage());
		}
		if ($this->Dependencies->Required) {
			if (!$this->Dependencies->IsDetailKey && $this->Dependencies->FormValue != NULL && $this->Dependencies->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Dependencies->caption(), $this->Dependencies->RequiredErrorMessage));
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

		// TaskID
		$this->TaskID->setDbValueDef($rsnew, $this->TaskID->CurrentValue, "", FALSE);

		// TaskName
		$this->TaskName->setDbValueDef($rsnew, $this->TaskName->CurrentValue, NULL, FALSE);

		// ResourceID
		$this->ResourceID->setDbValueDef($rsnew, $this->ResourceID->CurrentValue, NULL, FALSE);

		// Start
		$this->Start->setDbValueDef($rsnew, UnFormatDateTime($this->Start->CurrentValue, 0), NULL, FALSE);

		// End
		$this->End->setDbValueDef($rsnew, UnFormatDateTime($this->End->CurrentValue, 0), NULL, FALSE);

		// Description
		$this->Description->setDbValueDef($rsnew, $this->Description->CurrentValue, NULL, FALSE);

		// Milestone
		$this->Milestone->setDbValueDef($rsnew, UnFormatDateTime($this->Milestone->CurrentValue, 0), NULL, FALSE);

		// Duration
		$this->Duration->setDbValueDef($rsnew, $this->Duration->CurrentValue, NULL, FALSE);

		// PercentComplete
		$this->PercentComplete->setDbValueDef($rsnew, $this->PercentComplete->CurrentValue, NULL, FALSE);

		// Dependencies
		$this->Dependencies->setDbValueDef($rsnew, $this->Dependencies->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['TaskID']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check for duplicate key
		if ($insertRow && $this->ValidateKey) {
			$filter = $this->getRecordFilter($rsnew);
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$keyErrMsg = str_replace("%f", $filter, $Language->phrase("DupKey"));
				$this->setFailureMessage($keyErrMsg);
				$rsChk->close();
				$insertRow = FALSE;
			}
		}
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("taskslist.php"), "", $this->TableVar, TRUE);
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