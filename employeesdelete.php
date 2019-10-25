<?php
namespace PHPMaker2020\p_usman;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$employees_delete = new employees_delete();

// Run the page
$employees_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employees_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployeesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	femployeesdelete = currentForm = new ew.Form("femployeesdelete", "delete");
	loadjs.done("femployeesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employees_delete->showPageHeader(); ?>
<?php
$employees_delete->showMessage();
?>
<form name="femployeesdelete" id="femployeesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employees">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($employees_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($employees_delete->EmployeeID->Visible) { // EmployeeID ?>
		<th class="<?php echo $employees_delete->EmployeeID->headerCellClass() ?>"><span id="elh_employees_EmployeeID" class="employees_EmployeeID"><?php echo $employees_delete->EmployeeID->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->LastName->Visible) { // LastName ?>
		<th class="<?php echo $employees_delete->LastName->headerCellClass() ?>"><span id="elh_employees_LastName" class="employees_LastName"><?php echo $employees_delete->LastName->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->FirstName->Visible) { // FirstName ?>
		<th class="<?php echo $employees_delete->FirstName->headerCellClass() ?>"><span id="elh_employees_FirstName" class="employees_FirstName"><?php echo $employees_delete->FirstName->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->Title->Visible) { // Title ?>
		<th class="<?php echo $employees_delete->Title->headerCellClass() ?>"><span id="elh_employees_Title" class="employees_Title"><?php echo $employees_delete->Title->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->TitleOfCourtesy->Visible) { // TitleOfCourtesy ?>
		<th class="<?php echo $employees_delete->TitleOfCourtesy->headerCellClass() ?>"><span id="elh_employees_TitleOfCourtesy" class="employees_TitleOfCourtesy"><?php echo $employees_delete->TitleOfCourtesy->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->BirthDate->Visible) { // BirthDate ?>
		<th class="<?php echo $employees_delete->BirthDate->headerCellClass() ?>"><span id="elh_employees_BirthDate" class="employees_BirthDate"><?php echo $employees_delete->BirthDate->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->HireDate->Visible) { // HireDate ?>
		<th class="<?php echo $employees_delete->HireDate->headerCellClass() ?>"><span id="elh_employees_HireDate" class="employees_HireDate"><?php echo $employees_delete->HireDate->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->Address->Visible) { // Address ?>
		<th class="<?php echo $employees_delete->Address->headerCellClass() ?>"><span id="elh_employees_Address" class="employees_Address"><?php echo $employees_delete->Address->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->City->Visible) { // City ?>
		<th class="<?php echo $employees_delete->City->headerCellClass() ?>"><span id="elh_employees_City" class="employees_City"><?php echo $employees_delete->City->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->Region->Visible) { // Region ?>
		<th class="<?php echo $employees_delete->Region->headerCellClass() ?>"><span id="elh_employees_Region" class="employees_Region"><?php echo $employees_delete->Region->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->PostalCode->Visible) { // PostalCode ?>
		<th class="<?php echo $employees_delete->PostalCode->headerCellClass() ?>"><span id="elh_employees_PostalCode" class="employees_PostalCode"><?php echo $employees_delete->PostalCode->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->Country->Visible) { // Country ?>
		<th class="<?php echo $employees_delete->Country->headerCellClass() ?>"><span id="elh_employees_Country" class="employees_Country"><?php echo $employees_delete->Country->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->HomePhone->Visible) { // HomePhone ?>
		<th class="<?php echo $employees_delete->HomePhone->headerCellClass() ?>"><span id="elh_employees_HomePhone" class="employees_HomePhone"><?php echo $employees_delete->HomePhone->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->Extension->Visible) { // Extension ?>
		<th class="<?php echo $employees_delete->Extension->headerCellClass() ?>"><span id="elh_employees_Extension" class="employees_Extension"><?php echo $employees_delete->Extension->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->_Email->Visible) { // Email ?>
		<th class="<?php echo $employees_delete->_Email->headerCellClass() ?>"><span id="elh_employees__Email" class="employees__Email"><?php echo $employees_delete->_Email->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->Photo->Visible) { // Photo ?>
		<th class="<?php echo $employees_delete->Photo->headerCellClass() ?>"><span id="elh_employees_Photo" class="employees_Photo"><?php echo $employees_delete->Photo->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->ReportsTo->Visible) { // ReportsTo ?>
		<th class="<?php echo $employees_delete->ReportsTo->headerCellClass() ?>"><span id="elh_employees_ReportsTo" class="employees_ReportsTo"><?php echo $employees_delete->ReportsTo->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->Password->Visible) { // Password ?>
		<th class="<?php echo $employees_delete->Password->headerCellClass() ?>"><span id="elh_employees_Password" class="employees_Password"><?php echo $employees_delete->Password->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->UserLevel->Visible) { // UserLevel ?>
		<th class="<?php echo $employees_delete->UserLevel->headerCellClass() ?>"><span id="elh_employees_UserLevel" class="employees_UserLevel"><?php echo $employees_delete->UserLevel->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->Username->Visible) { // Username ?>
		<th class="<?php echo $employees_delete->Username->headerCellClass() ?>"><span id="elh_employees_Username" class="employees_Username"><?php echo $employees_delete->Username->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->Activated->Visible) { // Activated ?>
		<th class="<?php echo $employees_delete->Activated->headerCellClass() ?>"><span id="elh_employees_Activated" class="employees_Activated"><?php echo $employees_delete->Activated->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$employees_delete->RecordCount = 0;
$i = 0;
while (!$employees_delete->Recordset->EOF) {
	$employees_delete->RecordCount++;
	$employees_delete->RowCount++;

	// Set row properties
	$employees->resetAttributes();
	$employees->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$employees_delete->loadRowValues($employees_delete->Recordset);

	// Render row
	$employees_delete->renderRow();
?>
	<tr <?php echo $employees->rowAttributes() ?>>
<?php if ($employees_delete->EmployeeID->Visible) { // EmployeeID ?>
		<td <?php echo $employees_delete->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_EmployeeID" class="employees_EmployeeID">
<span<?php echo $employees_delete->EmployeeID->viewAttributes() ?>><?php echo $employees_delete->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->LastName->Visible) { // LastName ?>
		<td <?php echo $employees_delete->LastName->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_LastName" class="employees_LastName">
<span<?php echo $employees_delete->LastName->viewAttributes() ?>><?php echo $employees_delete->LastName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->FirstName->Visible) { // FirstName ?>
		<td <?php echo $employees_delete->FirstName->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_FirstName" class="employees_FirstName">
<span<?php echo $employees_delete->FirstName->viewAttributes() ?>><?php echo $employees_delete->FirstName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->Title->Visible) { // Title ?>
		<td <?php echo $employees_delete->Title->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_Title" class="employees_Title">
<span<?php echo $employees_delete->Title->viewAttributes() ?>><?php echo $employees_delete->Title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->TitleOfCourtesy->Visible) { // TitleOfCourtesy ?>
		<td <?php echo $employees_delete->TitleOfCourtesy->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_TitleOfCourtesy" class="employees_TitleOfCourtesy">
<span<?php echo $employees_delete->TitleOfCourtesy->viewAttributes() ?>><?php echo $employees_delete->TitleOfCourtesy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->BirthDate->Visible) { // BirthDate ?>
		<td <?php echo $employees_delete->BirthDate->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_BirthDate" class="employees_BirthDate">
<span<?php echo $employees_delete->BirthDate->viewAttributes() ?>><?php echo $employees_delete->BirthDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->HireDate->Visible) { // HireDate ?>
		<td <?php echo $employees_delete->HireDate->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_HireDate" class="employees_HireDate">
<span<?php echo $employees_delete->HireDate->viewAttributes() ?>><?php echo $employees_delete->HireDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->Address->Visible) { // Address ?>
		<td <?php echo $employees_delete->Address->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_Address" class="employees_Address">
<span<?php echo $employees_delete->Address->viewAttributes() ?>><?php echo $employees_delete->Address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->City->Visible) { // City ?>
		<td <?php echo $employees_delete->City->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_City" class="employees_City">
<span<?php echo $employees_delete->City->viewAttributes() ?>><?php echo $employees_delete->City->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->Region->Visible) { // Region ?>
		<td <?php echo $employees_delete->Region->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_Region" class="employees_Region">
<span<?php echo $employees_delete->Region->viewAttributes() ?>><?php echo $employees_delete->Region->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->PostalCode->Visible) { // PostalCode ?>
		<td <?php echo $employees_delete->PostalCode->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_PostalCode" class="employees_PostalCode">
<span<?php echo $employees_delete->PostalCode->viewAttributes() ?>><?php echo $employees_delete->PostalCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->Country->Visible) { // Country ?>
		<td <?php echo $employees_delete->Country->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_Country" class="employees_Country">
<span<?php echo $employees_delete->Country->viewAttributes() ?>><?php echo $employees_delete->Country->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->HomePhone->Visible) { // HomePhone ?>
		<td <?php echo $employees_delete->HomePhone->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_HomePhone" class="employees_HomePhone">
<span<?php echo $employees_delete->HomePhone->viewAttributes() ?>><?php echo $employees_delete->HomePhone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->Extension->Visible) { // Extension ?>
		<td <?php echo $employees_delete->Extension->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_Extension" class="employees_Extension">
<span<?php echo $employees_delete->Extension->viewAttributes() ?>><?php echo $employees_delete->Extension->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->_Email->Visible) { // Email ?>
		<td <?php echo $employees_delete->_Email->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees__Email" class="employees__Email">
<span<?php echo $employees_delete->_Email->viewAttributes() ?>><?php echo $employees_delete->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->Photo->Visible) { // Photo ?>
		<td <?php echo $employees_delete->Photo->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_Photo" class="employees_Photo">
<span<?php echo $employees_delete->Photo->viewAttributes() ?>><?php echo $employees_delete->Photo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->ReportsTo->Visible) { // ReportsTo ?>
		<td <?php echo $employees_delete->ReportsTo->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_ReportsTo" class="employees_ReportsTo">
<span<?php echo $employees_delete->ReportsTo->viewAttributes() ?>><?php echo $employees_delete->ReportsTo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->Password->Visible) { // Password ?>
		<td <?php echo $employees_delete->Password->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_Password" class="employees_Password">
<span<?php echo $employees_delete->Password->viewAttributes() ?>><?php echo $employees_delete->Password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->UserLevel->Visible) { // UserLevel ?>
		<td <?php echo $employees_delete->UserLevel->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_UserLevel" class="employees_UserLevel">
<span<?php echo $employees_delete->UserLevel->viewAttributes() ?>><?php echo $employees_delete->UserLevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->Username->Visible) { // Username ?>
		<td <?php echo $employees_delete->Username->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_Username" class="employees_Username">
<span<?php echo $employees_delete->Username->viewAttributes() ?>><?php echo $employees_delete->Username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->Activated->Visible) { // Activated ?>
		<td <?php echo $employees_delete->Activated->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_Activated" class="employees_Activated">
<span<?php echo $employees_delete->Activated->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_Activated" class="custom-control-input" value="<?php echo $employees_delete->Activated->getViewValue() ?>" disabled<?php if (ConvertToBool($employees_delete->Activated->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_Activated"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$employees_delete->Recordset->moveNext();
}
$employees_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employees_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$employees_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$employees_delete->terminate();
?>