<?php
namespace PHPMaker2020\p_usman;

/**
 * Page class
 */
class cars_add extends cars
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}";

	// Table name
	public $TableName = 'cars';

	// Page object name
	public $PageObjName = "cars_add";

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

		// Table object (cars)
		if (!isset($GLOBALS["cars"]) || get_class($GLOBALS["cars"]) == PROJECT_NAMESPACE . "cars") {
			$GLOBALS["cars"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cars"];
		}

		// Table object (employees)
		if (!isset($GLOBALS['employees']))
			$GLOBALS['employees'] = new employees();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'cars');

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
		global $cars;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($cars);
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
					if ($pageName == "carsview.php")
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
			$key .= @$ar['ID'];
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
			$this->ID->Visible = FALSE;
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
					$this->terminate(GetUrl("carslist.php"));
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
		$this->ID->Visible = FALSE;
		$this->Trademark->setVisibility();
		$this->Model->setVisibility();
		$this->HP->setVisibility();
		$this->Liter->setVisibility();
		$this->Cyl->setVisibility();
		$this->TransmissSpeedCount->setVisibility();
		$this->TransmissAutomatic->setVisibility();
		$this->MPG_City->setVisibility();
		$this->MPG_Highway->setVisibility();
		$this->Category->setVisibility();
		$this->Description->setVisibility();
		$this->Hyperlink->setVisibility();
		$this->Price->setVisibility();
		$this->Picture->setVisibility();
		$this->PictureName->setVisibility();
		$this->PictureSize->setVisibility();
		$this->PictureType->setVisibility();
		$this->PictureWidth->setVisibility();
		$this->PictureHeight->setVisibility();
		$this->Color->setVisibility();
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
			if (Get("ID") !== NULL) {
				$this->ID->setQueryStringValue(Get("ID"));
				$this->setKey("ID", $this->ID->CurrentValue); // Set up key
			} else {
				$this->setKey("ID", ""); // Clear key
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
					$this->terminate("carslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "carslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "carsview.php")
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
		$this->Picture->Upload->Index = $CurrentForm->Index;
		$this->Picture->Upload->uploadFile();
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->ID->CurrentValue = NULL;
		$this->ID->OldValue = $this->ID->CurrentValue;
		$this->Trademark->CurrentValue = NULL;
		$this->Trademark->OldValue = $this->Trademark->CurrentValue;
		$this->Model->CurrentValue = NULL;
		$this->Model->OldValue = $this->Model->CurrentValue;
		$this->HP->CurrentValue = NULL;
		$this->HP->OldValue = $this->HP->CurrentValue;
		$this->Liter->CurrentValue = NULL;
		$this->Liter->OldValue = $this->Liter->CurrentValue;
		$this->Cyl->CurrentValue = NULL;
		$this->Cyl->OldValue = $this->Cyl->CurrentValue;
		$this->TransmissSpeedCount->CurrentValue = NULL;
		$this->TransmissSpeedCount->OldValue = $this->TransmissSpeedCount->CurrentValue;
		$this->TransmissAutomatic->CurrentValue = NULL;
		$this->TransmissAutomatic->OldValue = $this->TransmissAutomatic->CurrentValue;
		$this->MPG_City->CurrentValue = NULL;
		$this->MPG_City->OldValue = $this->MPG_City->CurrentValue;
		$this->MPG_Highway->CurrentValue = NULL;
		$this->MPG_Highway->OldValue = $this->MPG_Highway->CurrentValue;
		$this->Category->CurrentValue = NULL;
		$this->Category->OldValue = $this->Category->CurrentValue;
		$this->Description->CurrentValue = NULL;
		$this->Description->OldValue = $this->Description->CurrentValue;
		$this->Hyperlink->CurrentValue = NULL;
		$this->Hyperlink->OldValue = $this->Hyperlink->CurrentValue;
		$this->Price->CurrentValue = NULL;
		$this->Price->OldValue = $this->Price->CurrentValue;
		$this->Picture->Upload->DbValue = NULL;
		$this->Picture->OldValue = $this->Picture->Upload->DbValue;
		$this->PictureName->CurrentValue = NULL;
		$this->PictureName->OldValue = $this->PictureName->CurrentValue;
		$this->PictureSize->CurrentValue = NULL;
		$this->PictureSize->OldValue = $this->PictureSize->CurrentValue;
		$this->PictureType->CurrentValue = NULL;
		$this->PictureType->OldValue = $this->PictureType->CurrentValue;
		$this->PictureWidth->CurrentValue = NULL;
		$this->PictureWidth->OldValue = $this->PictureWidth->CurrentValue;
		$this->PictureHeight->CurrentValue = NULL;
		$this->PictureHeight->OldValue = $this->PictureHeight->CurrentValue;
		$this->Color->CurrentValue = NULL;
		$this->Color->OldValue = $this->Color->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'Trademark' first before field var 'x_Trademark'
		$val = $CurrentForm->hasValue("Trademark") ? $CurrentForm->getValue("Trademark") : $CurrentForm->getValue("x_Trademark");
		if (!$this->Trademark->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Trademark->Visible = FALSE; // Disable update for API request
			else
				$this->Trademark->setFormValue($val);
		}

		// Check field name 'Model' first before field var 'x_Model'
		$val = $CurrentForm->hasValue("Model") ? $CurrentForm->getValue("Model") : $CurrentForm->getValue("x_Model");
		if (!$this->Model->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Model->Visible = FALSE; // Disable update for API request
			else
				$this->Model->setFormValue($val);
		}

		// Check field name 'HP' first before field var 'x_HP'
		$val = $CurrentForm->hasValue("HP") ? $CurrentForm->getValue("HP") : $CurrentForm->getValue("x_HP");
		if (!$this->HP->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->HP->Visible = FALSE; // Disable update for API request
			else
				$this->HP->setFormValue($val);
		}

		// Check field name 'Liter' first before field var 'x_Liter'
		$val = $CurrentForm->hasValue("Liter") ? $CurrentForm->getValue("Liter") : $CurrentForm->getValue("x_Liter");
		if (!$this->Liter->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Liter->Visible = FALSE; // Disable update for API request
			else
				$this->Liter->setFormValue($val);
		}

		// Check field name 'Cyl' first before field var 'x_Cyl'
		$val = $CurrentForm->hasValue("Cyl") ? $CurrentForm->getValue("Cyl") : $CurrentForm->getValue("x_Cyl");
		if (!$this->Cyl->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Cyl->Visible = FALSE; // Disable update for API request
			else
				$this->Cyl->setFormValue($val);
		}

		// Check field name 'TransmissSpeedCount' first before field var 'x_TransmissSpeedCount'
		$val = $CurrentForm->hasValue("TransmissSpeedCount") ? $CurrentForm->getValue("TransmissSpeedCount") : $CurrentForm->getValue("x_TransmissSpeedCount");
		if (!$this->TransmissSpeedCount->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->TransmissSpeedCount->Visible = FALSE; // Disable update for API request
			else
				$this->TransmissSpeedCount->setFormValue($val);
		}

		// Check field name 'TransmissAutomatic' first before field var 'x_TransmissAutomatic'
		$val = $CurrentForm->hasValue("TransmissAutomatic") ? $CurrentForm->getValue("TransmissAutomatic") : $CurrentForm->getValue("x_TransmissAutomatic");
		if (!$this->TransmissAutomatic->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->TransmissAutomatic->Visible = FALSE; // Disable update for API request
			else
				$this->TransmissAutomatic->setFormValue($val);
		}

		// Check field name 'MPG_City' first before field var 'x_MPG_City'
		$val = $CurrentForm->hasValue("MPG_City") ? $CurrentForm->getValue("MPG_City") : $CurrentForm->getValue("x_MPG_City");
		if (!$this->MPG_City->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->MPG_City->Visible = FALSE; // Disable update for API request
			else
				$this->MPG_City->setFormValue($val);
		}

		// Check field name 'MPG_Highway' first before field var 'x_MPG_Highway'
		$val = $CurrentForm->hasValue("MPG_Highway") ? $CurrentForm->getValue("MPG_Highway") : $CurrentForm->getValue("x_MPG_Highway");
		if (!$this->MPG_Highway->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->MPG_Highway->Visible = FALSE; // Disable update for API request
			else
				$this->MPG_Highway->setFormValue($val);
		}

		// Check field name 'Category' first before field var 'x_Category'
		$val = $CurrentForm->hasValue("Category") ? $CurrentForm->getValue("Category") : $CurrentForm->getValue("x_Category");
		if (!$this->Category->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Category->Visible = FALSE; // Disable update for API request
			else
				$this->Category->setFormValue($val);
		}

		// Check field name 'Description' first before field var 'x_Description'
		$val = $CurrentForm->hasValue("Description") ? $CurrentForm->getValue("Description") : $CurrentForm->getValue("x_Description");
		if (!$this->Description->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Description->Visible = FALSE; // Disable update for API request
			else
				$this->Description->setFormValue($val);
		}

		// Check field name 'Hyperlink' first before field var 'x_Hyperlink'
		$val = $CurrentForm->hasValue("Hyperlink") ? $CurrentForm->getValue("Hyperlink") : $CurrentForm->getValue("x_Hyperlink");
		if (!$this->Hyperlink->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Hyperlink->Visible = FALSE; // Disable update for API request
			else
				$this->Hyperlink->setFormValue($val);
		}

		// Check field name 'Price' first before field var 'x_Price'
		$val = $CurrentForm->hasValue("Price") ? $CurrentForm->getValue("Price") : $CurrentForm->getValue("x_Price");
		if (!$this->Price->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Price->Visible = FALSE; // Disable update for API request
			else
				$this->Price->setFormValue($val);
		}

		// Check field name 'PictureName' first before field var 'x_PictureName'
		$val = $CurrentForm->hasValue("PictureName") ? $CurrentForm->getValue("PictureName") : $CurrentForm->getValue("x_PictureName");
		if (!$this->PictureName->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PictureName->Visible = FALSE; // Disable update for API request
			else
				$this->PictureName->setFormValue($val);
		}

		// Check field name 'PictureSize' first before field var 'x_PictureSize'
		$val = $CurrentForm->hasValue("PictureSize") ? $CurrentForm->getValue("PictureSize") : $CurrentForm->getValue("x_PictureSize");
		if (!$this->PictureSize->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PictureSize->Visible = FALSE; // Disable update for API request
			else
				$this->PictureSize->setFormValue($val);
		}

		// Check field name 'PictureType' first before field var 'x_PictureType'
		$val = $CurrentForm->hasValue("PictureType") ? $CurrentForm->getValue("PictureType") : $CurrentForm->getValue("x_PictureType");
		if (!$this->PictureType->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PictureType->Visible = FALSE; // Disable update for API request
			else
				$this->PictureType->setFormValue($val);
		}

		// Check field name 'PictureWidth' first before field var 'x_PictureWidth'
		$val = $CurrentForm->hasValue("PictureWidth") ? $CurrentForm->getValue("PictureWidth") : $CurrentForm->getValue("x_PictureWidth");
		if (!$this->PictureWidth->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PictureWidth->Visible = FALSE; // Disable update for API request
			else
				$this->PictureWidth->setFormValue($val);
		}

		// Check field name 'PictureHeight' first before field var 'x_PictureHeight'
		$val = $CurrentForm->hasValue("PictureHeight") ? $CurrentForm->getValue("PictureHeight") : $CurrentForm->getValue("x_PictureHeight");
		if (!$this->PictureHeight->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PictureHeight->Visible = FALSE; // Disable update for API request
			else
				$this->PictureHeight->setFormValue($val);
		}

		// Check field name 'Color' first before field var 'x_Color'
		$val = $CurrentForm->hasValue("Color") ? $CurrentForm->getValue("Color") : $CurrentForm->getValue("x_Color");
		if (!$this->Color->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Color->Visible = FALSE; // Disable update for API request
			else
				$this->Color->setFormValue($val);
		}

		// Check field name 'ID' first before field var 'x_ID'
		$val = $CurrentForm->hasValue("ID") ? $CurrentForm->getValue("ID") : $CurrentForm->getValue("x_ID");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->Trademark->CurrentValue = $this->Trademark->FormValue;
		$this->Model->CurrentValue = $this->Model->FormValue;
		$this->HP->CurrentValue = $this->HP->FormValue;
		$this->Liter->CurrentValue = $this->Liter->FormValue;
		$this->Cyl->CurrentValue = $this->Cyl->FormValue;
		$this->TransmissSpeedCount->CurrentValue = $this->TransmissSpeedCount->FormValue;
		$this->TransmissAutomatic->CurrentValue = $this->TransmissAutomatic->FormValue;
		$this->MPG_City->CurrentValue = $this->MPG_City->FormValue;
		$this->MPG_Highway->CurrentValue = $this->MPG_Highway->FormValue;
		$this->Category->CurrentValue = $this->Category->FormValue;
		$this->Description->CurrentValue = $this->Description->FormValue;
		$this->Hyperlink->CurrentValue = $this->Hyperlink->FormValue;
		$this->Price->CurrentValue = $this->Price->FormValue;
		$this->PictureName->CurrentValue = $this->PictureName->FormValue;
		$this->PictureSize->CurrentValue = $this->PictureSize->FormValue;
		$this->PictureType->CurrentValue = $this->PictureType->FormValue;
		$this->PictureWidth->CurrentValue = $this->PictureWidth->FormValue;
		$this->PictureHeight->CurrentValue = $this->PictureHeight->FormValue;
		$this->Color->CurrentValue = $this->Color->FormValue;
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
		$this->ID->setDbValue($row['ID']);
		$this->Trademark->setDbValue($row['Trademark']);
		$this->Model->setDbValue($row['Model']);
		$this->HP->setDbValue($row['HP']);
		$this->Liter->setDbValue($row['Liter']);
		$this->Cyl->setDbValue($row['Cyl']);
		$this->TransmissSpeedCount->setDbValue($row['TransmissSpeedCount']);
		$this->TransmissAutomatic->setDbValue($row['TransmissAutomatic']);
		$this->MPG_City->setDbValue($row['MPG_City']);
		$this->MPG_Highway->setDbValue($row['MPG_Highway']);
		$this->Category->setDbValue($row['Category']);
		$this->Description->setDbValue($row['Description']);
		$this->Hyperlink->setDbValue($row['Hyperlink']);
		$this->Price->setDbValue($row['Price']);
		$this->Picture->Upload->DbValue = $row['Picture'];
		if (is_array($this->Picture->Upload->DbValue) || is_object($this->Picture->Upload->DbValue)) // Byte array
			$this->Picture->Upload->DbValue = BytesToString($this->Picture->Upload->DbValue);
		$this->PictureName->setDbValue($row['PictureName']);
		$this->PictureSize->setDbValue($row['PictureSize']);
		$this->PictureType->setDbValue($row['PictureType']);
		$this->PictureWidth->setDbValue($row['PictureWidth']);
		$this->PictureHeight->setDbValue($row['PictureHeight']);
		$this->Color->setDbValue($row['Color']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ID'] = $this->ID->CurrentValue;
		$row['Trademark'] = $this->Trademark->CurrentValue;
		$row['Model'] = $this->Model->CurrentValue;
		$row['HP'] = $this->HP->CurrentValue;
		$row['Liter'] = $this->Liter->CurrentValue;
		$row['Cyl'] = $this->Cyl->CurrentValue;
		$row['TransmissSpeedCount'] = $this->TransmissSpeedCount->CurrentValue;
		$row['TransmissAutomatic'] = $this->TransmissAutomatic->CurrentValue;
		$row['MPG_City'] = $this->MPG_City->CurrentValue;
		$row['MPG_Highway'] = $this->MPG_Highway->CurrentValue;
		$row['Category'] = $this->Category->CurrentValue;
		$row['Description'] = $this->Description->CurrentValue;
		$row['Hyperlink'] = $this->Hyperlink->CurrentValue;
		$row['Price'] = $this->Price->CurrentValue;
		$row['Picture'] = $this->Picture->Upload->DbValue;
		$row['PictureName'] = $this->PictureName->CurrentValue;
		$row['PictureSize'] = $this->PictureSize->CurrentValue;
		$row['PictureType'] = $this->PictureType->CurrentValue;
		$row['PictureWidth'] = $this->PictureWidth->CurrentValue;
		$row['PictureHeight'] = $this->PictureHeight->CurrentValue;
		$row['Color'] = $this->Color->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ID")) != "")
			$this->ID->OldValue = $this->getKey("ID"); // ID
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

		if ($this->Liter->FormValue == $this->Liter->CurrentValue && is_numeric(ConvertToFloatString($this->Liter->CurrentValue)))
			$this->Liter->CurrentValue = ConvertToFloatString($this->Liter->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Price->FormValue == $this->Price->CurrentValue && is_numeric(ConvertToFloatString($this->Price->CurrentValue)))
			$this->Price->CurrentValue = ConvertToFloatString($this->Price->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ID
		// Trademark
		// Model
		// HP
		// Liter
		// Cyl
		// TransmissSpeedCount
		// TransmissAutomatic
		// MPG_City
		// MPG_Highway
		// Category
		// Description
		// Hyperlink
		// Price
		// Picture
		// PictureName
		// PictureSize
		// PictureType
		// PictureWidth
		// PictureHeight
		// Color

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ID
			$this->ID->ViewValue = $this->ID->CurrentValue;
			$this->ID->ViewCustomAttributes = "";

			// Trademark
			$this->Trademark->ViewValue = $this->Trademark->CurrentValue;
			$this->Trademark->ViewValue = FormatNumber($this->Trademark->ViewValue, 0, -2, -2, -2);
			$this->Trademark->ViewCustomAttributes = "";

			// Model
			$this->Model->ViewValue = $this->Model->CurrentValue;
			$this->Model->ViewValue = FormatNumber($this->Model->ViewValue, 0, -2, -2, -2);
			$this->Model->ViewCustomAttributes = "";

			// HP
			$this->HP->ViewValue = $this->HP->CurrentValue;
			$this->HP->ViewValue = FormatNumber($this->HP->ViewValue, 0, -2, -2, -2);
			$this->HP->ViewCustomAttributes = "";

			// Liter
			$this->Liter->ViewValue = $this->Liter->CurrentValue;
			$this->Liter->ViewValue = FormatNumber($this->Liter->ViewValue, 2, -2, -2, -2);
			$this->Liter->ViewCustomAttributes = "";

			// Cyl
			$this->Cyl->ViewValue = $this->Cyl->CurrentValue;
			$this->Cyl->ViewValue = FormatNumber($this->Cyl->ViewValue, 0, -2, -2, -2);
			$this->Cyl->ViewCustomAttributes = "";

			// TransmissSpeedCount
			$this->TransmissSpeedCount->ViewValue = $this->TransmissSpeedCount->CurrentValue;
			$this->TransmissSpeedCount->ViewValue = FormatNumber($this->TransmissSpeedCount->ViewValue, 0, -2, -2, -2);
			$this->TransmissSpeedCount->ViewCustomAttributes = "";

			// TransmissAutomatic
			$this->TransmissAutomatic->ViewValue = $this->TransmissAutomatic->CurrentValue;
			$this->TransmissAutomatic->ViewCustomAttributes = "";

			// MPG_City
			$this->MPG_City->ViewValue = $this->MPG_City->CurrentValue;
			$this->MPG_City->ViewValue = FormatNumber($this->MPG_City->ViewValue, 0, -2, -2, -2);
			$this->MPG_City->ViewCustomAttributes = "";

			// MPG_Highway
			$this->MPG_Highway->ViewValue = $this->MPG_Highway->CurrentValue;
			$this->MPG_Highway->ViewValue = FormatNumber($this->MPG_Highway->ViewValue, 0, -2, -2, -2);
			$this->MPG_Highway->ViewCustomAttributes = "";

			// Category
			$this->Category->ViewValue = $this->Category->CurrentValue;
			$this->Category->ViewCustomAttributes = "";

			// Description
			$this->Description->ViewValue = $this->Description->CurrentValue;
			$this->Description->ViewCustomAttributes = "";

			// Hyperlink
			$this->Hyperlink->ViewValue = $this->Hyperlink->CurrentValue;
			$this->Hyperlink->ViewCustomAttributes = "";

			// Price
			$this->Price->ViewValue = $this->Price->CurrentValue;
			$this->Price->ViewValue = FormatNumber($this->Price->ViewValue, 2, -2, -2, -2);
			$this->Price->ViewCustomAttributes = "";

			// Picture
			if (!EmptyValue($this->Picture->Upload->DbValue)) {
				$this->Picture->ViewValue = $this->ID->CurrentValue;
				$this->Picture->IsBlobImage = IsImageFile(ContentExtension($this->Picture->Upload->DbValue));
			} else {
				$this->Picture->ViewValue = "";
			}
			$this->Picture->ViewCustomAttributes = "";

			// PictureName
			$this->PictureName->ViewValue = $this->PictureName->CurrentValue;
			$this->PictureName->ViewCustomAttributes = "";

			// PictureSize
			$this->PictureSize->ViewValue = $this->PictureSize->CurrentValue;
			$this->PictureSize->ViewValue = FormatNumber($this->PictureSize->ViewValue, 0, -2, -2, -2);
			$this->PictureSize->ViewCustomAttributes = "";

			// PictureType
			$this->PictureType->ViewValue = $this->PictureType->CurrentValue;
			$this->PictureType->ViewCustomAttributes = "";

			// PictureWidth
			$this->PictureWidth->ViewValue = $this->PictureWidth->CurrentValue;
			$this->PictureWidth->ViewValue = FormatNumber($this->PictureWidth->ViewValue, 0, -2, -2, -2);
			$this->PictureWidth->ViewCustomAttributes = "";

			// PictureHeight
			$this->PictureHeight->ViewValue = $this->PictureHeight->CurrentValue;
			$this->PictureHeight->ViewValue = FormatNumber($this->PictureHeight->ViewValue, 0, -2, -2, -2);
			$this->PictureHeight->ViewCustomAttributes = "";

			// Color
			$this->Color->ViewValue = $this->Color->CurrentValue;
			$this->Color->ViewCustomAttributes = "";

			// Trademark
			$this->Trademark->LinkCustomAttributes = "";
			$this->Trademark->HrefValue = "";
			$this->Trademark->TooltipValue = "";

			// Model
			$this->Model->LinkCustomAttributes = "";
			$this->Model->HrefValue = "";
			$this->Model->TooltipValue = "";

			// HP
			$this->HP->LinkCustomAttributes = "";
			$this->HP->HrefValue = "";
			$this->HP->TooltipValue = "";

			// Liter
			$this->Liter->LinkCustomAttributes = "";
			$this->Liter->HrefValue = "";
			$this->Liter->TooltipValue = "";

			// Cyl
			$this->Cyl->LinkCustomAttributes = "";
			$this->Cyl->HrefValue = "";
			$this->Cyl->TooltipValue = "";

			// TransmissSpeedCount
			$this->TransmissSpeedCount->LinkCustomAttributes = "";
			$this->TransmissSpeedCount->HrefValue = "";
			$this->TransmissSpeedCount->TooltipValue = "";

			// TransmissAutomatic
			$this->TransmissAutomatic->LinkCustomAttributes = "";
			$this->TransmissAutomatic->HrefValue = "";
			$this->TransmissAutomatic->TooltipValue = "";

			// MPG_City
			$this->MPG_City->LinkCustomAttributes = "";
			$this->MPG_City->HrefValue = "";
			$this->MPG_City->TooltipValue = "";

			// MPG_Highway
			$this->MPG_Highway->LinkCustomAttributes = "";
			$this->MPG_Highway->HrefValue = "";
			$this->MPG_Highway->TooltipValue = "";

			// Category
			$this->Category->LinkCustomAttributes = "";
			$this->Category->HrefValue = "";
			$this->Category->TooltipValue = "";

			// Description
			$this->Description->LinkCustomAttributes = "";
			$this->Description->HrefValue = "";
			$this->Description->TooltipValue = "";

			// Hyperlink
			$this->Hyperlink->LinkCustomAttributes = "";
			$this->Hyperlink->HrefValue = "";
			$this->Hyperlink->TooltipValue = "";

			// Price
			$this->Price->LinkCustomAttributes = "";
			$this->Price->HrefValue = "";
			$this->Price->TooltipValue = "";

			// Picture
			$this->Picture->LinkCustomAttributes = "";
			if (!empty($this->Picture->Upload->DbValue)) {
				$this->Picture->HrefValue = GetFileUploadUrl($this->Picture, $this->ID->CurrentValue);
				$this->Picture->LinkAttrs["target"] = "";
				if ($this->Picture->IsBlobImage && empty($this->Picture->LinkAttrs["target"]))
					$this->Picture->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->Picture->HrefValue = FullUrl($this->Picture->HrefValue, "href");
			} else {
				$this->Picture->HrefValue = "";
			}
			$this->Picture->ExportHrefValue = GetFileUploadUrl($this->Picture, $this->ID->CurrentValue);
			$this->Picture->TooltipValue = "";

			// PictureName
			$this->PictureName->LinkCustomAttributes = "";
			$this->PictureName->HrefValue = "";
			$this->PictureName->TooltipValue = "";

			// PictureSize
			$this->PictureSize->LinkCustomAttributes = "";
			$this->PictureSize->HrefValue = "";
			$this->PictureSize->TooltipValue = "";

			// PictureType
			$this->PictureType->LinkCustomAttributes = "";
			$this->PictureType->HrefValue = "";
			$this->PictureType->TooltipValue = "";

			// PictureWidth
			$this->PictureWidth->LinkCustomAttributes = "";
			$this->PictureWidth->HrefValue = "";
			$this->PictureWidth->TooltipValue = "";

			// PictureHeight
			$this->PictureHeight->LinkCustomAttributes = "";
			$this->PictureHeight->HrefValue = "";
			$this->PictureHeight->TooltipValue = "";

			// Color
			$this->Color->LinkCustomAttributes = "";
			$this->Color->HrefValue = "";
			$this->Color->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// Trademark
			$this->Trademark->EditAttrs["class"] = "form-control";
			$this->Trademark->EditCustomAttributes = "";
			$this->Trademark->EditValue = HtmlEncode($this->Trademark->CurrentValue);
			$this->Trademark->PlaceHolder = RemoveHtml($this->Trademark->caption());

			// Model
			$this->Model->EditAttrs["class"] = "form-control";
			$this->Model->EditCustomAttributes = "";
			$this->Model->EditValue = HtmlEncode($this->Model->CurrentValue);
			$this->Model->PlaceHolder = RemoveHtml($this->Model->caption());

			// HP
			$this->HP->EditAttrs["class"] = "form-control";
			$this->HP->EditCustomAttributes = "";
			$this->HP->EditValue = HtmlEncode($this->HP->CurrentValue);
			$this->HP->PlaceHolder = RemoveHtml($this->HP->caption());

			// Liter
			$this->Liter->EditAttrs["class"] = "form-control";
			$this->Liter->EditCustomAttributes = "";
			$this->Liter->EditValue = HtmlEncode($this->Liter->CurrentValue);
			$this->Liter->PlaceHolder = RemoveHtml($this->Liter->caption());
			if (strval($this->Liter->EditValue) != "" && is_numeric($this->Liter->EditValue))
				$this->Liter->EditValue = FormatNumber($this->Liter->EditValue, -2, -2, -2, -2);
			

			// Cyl
			$this->Cyl->EditAttrs["class"] = "form-control";
			$this->Cyl->EditCustomAttributes = "";
			$this->Cyl->EditValue = HtmlEncode($this->Cyl->CurrentValue);
			$this->Cyl->PlaceHolder = RemoveHtml($this->Cyl->caption());

			// TransmissSpeedCount
			$this->TransmissSpeedCount->EditAttrs["class"] = "form-control";
			$this->TransmissSpeedCount->EditCustomAttributes = "";
			$this->TransmissSpeedCount->EditValue = HtmlEncode($this->TransmissSpeedCount->CurrentValue);
			$this->TransmissSpeedCount->PlaceHolder = RemoveHtml($this->TransmissSpeedCount->caption());

			// TransmissAutomatic
			$this->TransmissAutomatic->EditAttrs["class"] = "form-control";
			$this->TransmissAutomatic->EditCustomAttributes = "";
			if (!$this->TransmissAutomatic->Raw)
				$this->TransmissAutomatic->CurrentValue = HtmlDecode($this->TransmissAutomatic->CurrentValue);
			$this->TransmissAutomatic->EditValue = HtmlEncode($this->TransmissAutomatic->CurrentValue);
			$this->TransmissAutomatic->PlaceHolder = RemoveHtml($this->TransmissAutomatic->caption());

			// MPG_City
			$this->MPG_City->EditAttrs["class"] = "form-control";
			$this->MPG_City->EditCustomAttributes = "";
			$this->MPG_City->EditValue = HtmlEncode($this->MPG_City->CurrentValue);
			$this->MPG_City->PlaceHolder = RemoveHtml($this->MPG_City->caption());

			// MPG_Highway
			$this->MPG_Highway->EditAttrs["class"] = "form-control";
			$this->MPG_Highway->EditCustomAttributes = "";
			$this->MPG_Highway->EditValue = HtmlEncode($this->MPG_Highway->CurrentValue);
			$this->MPG_Highway->PlaceHolder = RemoveHtml($this->MPG_Highway->caption());

			// Category
			$this->Category->EditAttrs["class"] = "form-control";
			$this->Category->EditCustomAttributes = "";
			if (!$this->Category->Raw)
				$this->Category->CurrentValue = HtmlDecode($this->Category->CurrentValue);
			$this->Category->EditValue = HtmlEncode($this->Category->CurrentValue);
			$this->Category->PlaceHolder = RemoveHtml($this->Category->caption());

			// Description
			$this->Description->EditAttrs["class"] = "form-control";
			$this->Description->EditCustomAttributes = "";
			$this->Description->EditValue = HtmlEncode($this->Description->CurrentValue);
			$this->Description->PlaceHolder = RemoveHtml($this->Description->caption());

			// Hyperlink
			$this->Hyperlink->EditAttrs["class"] = "form-control";
			$this->Hyperlink->EditCustomAttributes = "";
			if (!$this->Hyperlink->Raw)
				$this->Hyperlink->CurrentValue = HtmlDecode($this->Hyperlink->CurrentValue);
			$this->Hyperlink->EditValue = HtmlEncode($this->Hyperlink->CurrentValue);
			$this->Hyperlink->PlaceHolder = RemoveHtml($this->Hyperlink->caption());

			// Price
			$this->Price->EditAttrs["class"] = "form-control";
			$this->Price->EditCustomAttributes = "";
			$this->Price->EditValue = HtmlEncode($this->Price->CurrentValue);
			$this->Price->PlaceHolder = RemoveHtml($this->Price->caption());
			if (strval($this->Price->EditValue) != "" && is_numeric($this->Price->EditValue))
				$this->Price->EditValue = FormatNumber($this->Price->EditValue, -2, -2, -2, -2);
			

			// Picture
			$this->Picture->EditAttrs["class"] = "form-control";
			$this->Picture->EditCustomAttributes = "";
			if (!EmptyValue($this->Picture->Upload->DbValue)) {
				$this->Picture->EditValue = $this->ID->CurrentValue;
				$this->Picture->IsBlobImage = IsImageFile(ContentExtension($this->Picture->Upload->DbValue));
			} else {
				$this->Picture->EditValue = "";
			}
			if (($this->isShow() || $this->isCopy()) && !$this->EventCancelled)
				RenderUploadField($this->Picture);

			// PictureName
			$this->PictureName->EditAttrs["class"] = "form-control";
			$this->PictureName->EditCustomAttributes = "";
			if (!$this->PictureName->Raw)
				$this->PictureName->CurrentValue = HtmlDecode($this->PictureName->CurrentValue);
			$this->PictureName->EditValue = HtmlEncode($this->PictureName->CurrentValue);
			$this->PictureName->PlaceHolder = RemoveHtml($this->PictureName->caption());

			// PictureSize
			$this->PictureSize->EditAttrs["class"] = "form-control";
			$this->PictureSize->EditCustomAttributes = "";
			$this->PictureSize->EditValue = HtmlEncode($this->PictureSize->CurrentValue);
			$this->PictureSize->PlaceHolder = RemoveHtml($this->PictureSize->caption());

			// PictureType
			$this->PictureType->EditAttrs["class"] = "form-control";
			$this->PictureType->EditCustomAttributes = "";
			if (!$this->PictureType->Raw)
				$this->PictureType->CurrentValue = HtmlDecode($this->PictureType->CurrentValue);
			$this->PictureType->EditValue = HtmlEncode($this->PictureType->CurrentValue);
			$this->PictureType->PlaceHolder = RemoveHtml($this->PictureType->caption());

			// PictureWidth
			$this->PictureWidth->EditAttrs["class"] = "form-control";
			$this->PictureWidth->EditCustomAttributes = "";
			$this->PictureWidth->EditValue = HtmlEncode($this->PictureWidth->CurrentValue);
			$this->PictureWidth->PlaceHolder = RemoveHtml($this->PictureWidth->caption());

			// PictureHeight
			$this->PictureHeight->EditAttrs["class"] = "form-control";
			$this->PictureHeight->EditCustomAttributes = "";
			$this->PictureHeight->EditValue = HtmlEncode($this->PictureHeight->CurrentValue);
			$this->PictureHeight->PlaceHolder = RemoveHtml($this->PictureHeight->caption());

			// Color
			$this->Color->EditAttrs["class"] = "form-control";
			$this->Color->EditCustomAttributes = "";
			if (!$this->Color->Raw)
				$this->Color->CurrentValue = HtmlDecode($this->Color->CurrentValue);
			$this->Color->EditValue = HtmlEncode($this->Color->CurrentValue);
			$this->Color->PlaceHolder = RemoveHtml($this->Color->caption());

			// Add refer script
			// Trademark

			$this->Trademark->LinkCustomAttributes = "";
			$this->Trademark->HrefValue = "";

			// Model
			$this->Model->LinkCustomAttributes = "";
			$this->Model->HrefValue = "";

			// HP
			$this->HP->LinkCustomAttributes = "";
			$this->HP->HrefValue = "";

			// Liter
			$this->Liter->LinkCustomAttributes = "";
			$this->Liter->HrefValue = "";

			// Cyl
			$this->Cyl->LinkCustomAttributes = "";
			$this->Cyl->HrefValue = "";

			// TransmissSpeedCount
			$this->TransmissSpeedCount->LinkCustomAttributes = "";
			$this->TransmissSpeedCount->HrefValue = "";

			// TransmissAutomatic
			$this->TransmissAutomatic->LinkCustomAttributes = "";
			$this->TransmissAutomatic->HrefValue = "";

			// MPG_City
			$this->MPG_City->LinkCustomAttributes = "";
			$this->MPG_City->HrefValue = "";

			// MPG_Highway
			$this->MPG_Highway->LinkCustomAttributes = "";
			$this->MPG_Highway->HrefValue = "";

			// Category
			$this->Category->LinkCustomAttributes = "";
			$this->Category->HrefValue = "";

			// Description
			$this->Description->LinkCustomAttributes = "";
			$this->Description->HrefValue = "";

			// Hyperlink
			$this->Hyperlink->LinkCustomAttributes = "";
			$this->Hyperlink->HrefValue = "";

			// Price
			$this->Price->LinkCustomAttributes = "";
			$this->Price->HrefValue = "";

			// Picture
			$this->Picture->LinkCustomAttributes = "";
			if (!empty($this->Picture->Upload->DbValue)) {
				$this->Picture->HrefValue = GetFileUploadUrl($this->Picture, $this->ID->CurrentValue);
				$this->Picture->LinkAttrs["target"] = "";
				if ($this->Picture->IsBlobImage && empty($this->Picture->LinkAttrs["target"]))
					$this->Picture->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->Picture->HrefValue = FullUrl($this->Picture->HrefValue, "href");
			} else {
				$this->Picture->HrefValue = "";
			}
			$this->Picture->ExportHrefValue = GetFileUploadUrl($this->Picture, $this->ID->CurrentValue);

			// PictureName
			$this->PictureName->LinkCustomAttributes = "";
			$this->PictureName->HrefValue = "";

			// PictureSize
			$this->PictureSize->LinkCustomAttributes = "";
			$this->PictureSize->HrefValue = "";

			// PictureType
			$this->PictureType->LinkCustomAttributes = "";
			$this->PictureType->HrefValue = "";

			// PictureWidth
			$this->PictureWidth->LinkCustomAttributes = "";
			$this->PictureWidth->HrefValue = "";

			// PictureHeight
			$this->PictureHeight->LinkCustomAttributes = "";
			$this->PictureHeight->HrefValue = "";

			// Color
			$this->Color->LinkCustomAttributes = "";
			$this->Color->HrefValue = "";
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
		if ($this->Trademark->Required) {
			if (!$this->Trademark->IsDetailKey && $this->Trademark->FormValue != NULL && $this->Trademark->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Trademark->caption(), $this->Trademark->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Trademark->FormValue)) {
			AddMessage($FormError, $this->Trademark->errorMessage());
		}
		if ($this->Model->Required) {
			if (!$this->Model->IsDetailKey && $this->Model->FormValue != NULL && $this->Model->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Model->caption(), $this->Model->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Model->FormValue)) {
			AddMessage($FormError, $this->Model->errorMessage());
		}
		if ($this->HP->Required) {
			if (!$this->HP->IsDetailKey && $this->HP->FormValue != NULL && $this->HP->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->HP->caption(), $this->HP->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->HP->FormValue)) {
			AddMessage($FormError, $this->HP->errorMessage());
		}
		if ($this->Liter->Required) {
			if (!$this->Liter->IsDetailKey && $this->Liter->FormValue != NULL && $this->Liter->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Liter->caption(), $this->Liter->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Liter->FormValue)) {
			AddMessage($FormError, $this->Liter->errorMessage());
		}
		if ($this->Cyl->Required) {
			if (!$this->Cyl->IsDetailKey && $this->Cyl->FormValue != NULL && $this->Cyl->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Cyl->caption(), $this->Cyl->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Cyl->FormValue)) {
			AddMessage($FormError, $this->Cyl->errorMessage());
		}
		if ($this->TransmissSpeedCount->Required) {
			if (!$this->TransmissSpeedCount->IsDetailKey && $this->TransmissSpeedCount->FormValue != NULL && $this->TransmissSpeedCount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TransmissSpeedCount->caption(), $this->TransmissSpeedCount->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->TransmissSpeedCount->FormValue)) {
			AddMessage($FormError, $this->TransmissSpeedCount->errorMessage());
		}
		if ($this->TransmissAutomatic->Required) {
			if (!$this->TransmissAutomatic->IsDetailKey && $this->TransmissAutomatic->FormValue != NULL && $this->TransmissAutomatic->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TransmissAutomatic->caption(), $this->TransmissAutomatic->RequiredErrorMessage));
			}
		}
		if ($this->MPG_City->Required) {
			if (!$this->MPG_City->IsDetailKey && $this->MPG_City->FormValue != NULL && $this->MPG_City->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MPG_City->caption(), $this->MPG_City->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->MPG_City->FormValue)) {
			AddMessage($FormError, $this->MPG_City->errorMessage());
		}
		if ($this->MPG_Highway->Required) {
			if (!$this->MPG_Highway->IsDetailKey && $this->MPG_Highway->FormValue != NULL && $this->MPG_Highway->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MPG_Highway->caption(), $this->MPG_Highway->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->MPG_Highway->FormValue)) {
			AddMessage($FormError, $this->MPG_Highway->errorMessage());
		}
		if ($this->Category->Required) {
			if (!$this->Category->IsDetailKey && $this->Category->FormValue != NULL && $this->Category->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Category->caption(), $this->Category->RequiredErrorMessage));
			}
		}
		if ($this->Description->Required) {
			if (!$this->Description->IsDetailKey && $this->Description->FormValue != NULL && $this->Description->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Description->caption(), $this->Description->RequiredErrorMessage));
			}
		}
		if ($this->Hyperlink->Required) {
			if (!$this->Hyperlink->IsDetailKey && $this->Hyperlink->FormValue != NULL && $this->Hyperlink->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Hyperlink->caption(), $this->Hyperlink->RequiredErrorMessage));
			}
		}
		if ($this->Price->Required) {
			if (!$this->Price->IsDetailKey && $this->Price->FormValue != NULL && $this->Price->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Price->caption(), $this->Price->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Price->FormValue)) {
			AddMessage($FormError, $this->Price->errorMessage());
		}
		if ($this->Picture->Required) {
			if ($this->Picture->Upload->FileName == "" && !$this->Picture->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->Picture->caption(), $this->Picture->RequiredErrorMessage));
			}
		}
		if ($this->PictureName->Required) {
			if (!$this->PictureName->IsDetailKey && $this->PictureName->FormValue != NULL && $this->PictureName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PictureName->caption(), $this->PictureName->RequiredErrorMessage));
			}
		}
		if ($this->PictureSize->Required) {
			if (!$this->PictureSize->IsDetailKey && $this->PictureSize->FormValue != NULL && $this->PictureSize->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PictureSize->caption(), $this->PictureSize->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PictureSize->FormValue)) {
			AddMessage($FormError, $this->PictureSize->errorMessage());
		}
		if ($this->PictureType->Required) {
			if (!$this->PictureType->IsDetailKey && $this->PictureType->FormValue != NULL && $this->PictureType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PictureType->caption(), $this->PictureType->RequiredErrorMessage));
			}
		}
		if ($this->PictureWidth->Required) {
			if (!$this->PictureWidth->IsDetailKey && $this->PictureWidth->FormValue != NULL && $this->PictureWidth->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PictureWidth->caption(), $this->PictureWidth->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PictureWidth->FormValue)) {
			AddMessage($FormError, $this->PictureWidth->errorMessage());
		}
		if ($this->PictureHeight->Required) {
			if (!$this->PictureHeight->IsDetailKey && $this->PictureHeight->FormValue != NULL && $this->PictureHeight->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PictureHeight->caption(), $this->PictureHeight->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PictureHeight->FormValue)) {
			AddMessage($FormError, $this->PictureHeight->errorMessage());
		}
		if ($this->Color->Required) {
			if (!$this->Color->IsDetailKey && $this->Color->FormValue != NULL && $this->Color->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Color->caption(), $this->Color->RequiredErrorMessage));
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

		// Trademark
		$this->Trademark->setDbValueDef($rsnew, $this->Trademark->CurrentValue, NULL, FALSE);

		// Model
		$this->Model->setDbValueDef($rsnew, $this->Model->CurrentValue, NULL, FALSE);

		// HP
		$this->HP->setDbValueDef($rsnew, $this->HP->CurrentValue, NULL, FALSE);

		// Liter
		$this->Liter->setDbValueDef($rsnew, $this->Liter->CurrentValue, NULL, FALSE);

		// Cyl
		$this->Cyl->setDbValueDef($rsnew, $this->Cyl->CurrentValue, NULL, FALSE);

		// TransmissSpeedCount
		$this->TransmissSpeedCount->setDbValueDef($rsnew, $this->TransmissSpeedCount->CurrentValue, NULL, FALSE);

		// TransmissAutomatic
		$this->TransmissAutomatic->setDbValueDef($rsnew, $this->TransmissAutomatic->CurrentValue, NULL, FALSE);

		// MPG_City
		$this->MPG_City->setDbValueDef($rsnew, $this->MPG_City->CurrentValue, NULL, FALSE);

		// MPG_Highway
		$this->MPG_Highway->setDbValueDef($rsnew, $this->MPG_Highway->CurrentValue, NULL, FALSE);

		// Category
		$this->Category->setDbValueDef($rsnew, $this->Category->CurrentValue, NULL, FALSE);

		// Description
		$this->Description->setDbValueDef($rsnew, $this->Description->CurrentValue, NULL, FALSE);

		// Hyperlink
		$this->Hyperlink->setDbValueDef($rsnew, $this->Hyperlink->CurrentValue, NULL, FALSE);

		// Price
		$this->Price->setDbValueDef($rsnew, $this->Price->CurrentValue, NULL, FALSE);

		// Picture
		if ($this->Picture->Visible && !$this->Picture->Upload->KeepFile) {
			if ($this->Picture->Upload->Value == NULL) {
				$rsnew['Picture'] = NULL;
			} else {
				$rsnew['Picture'] = $this->Picture->Upload->Value;
			}
		}

		// PictureName
		$this->PictureName->setDbValueDef($rsnew, $this->PictureName->CurrentValue, NULL, FALSE);

		// PictureSize
		$this->PictureSize->setDbValueDef($rsnew, $this->PictureSize->CurrentValue, NULL, FALSE);

		// PictureType
		$this->PictureType->setDbValueDef($rsnew, $this->PictureType->CurrentValue, NULL, FALSE);

		// PictureWidth
		$this->PictureWidth->setDbValueDef($rsnew, $this->PictureWidth->CurrentValue, NULL, FALSE);

		// PictureHeight
		$this->PictureHeight->setDbValueDef($rsnew, $this->PictureHeight->CurrentValue, NULL, FALSE);

		// Color
		$this->Color->setDbValueDef($rsnew, $this->Color->CurrentValue, NULL, FALSE);

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

		// Picture
		if ($this->Picture->Upload->FileToken != "")
			CleanUploadTempPath($this->Picture->Upload->FileToken, $this->Picture->Upload->Index);
		else
			CleanUploadTempPath($this->Picture, $this->Picture->Upload->Index);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("carslist.php"), "", $this->TableVar, TRUE);
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