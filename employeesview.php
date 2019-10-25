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
$employees_view = new employees_view();

// Run the page
$employees_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employees_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employees_view->isExport()) { ?>
<script>
var femployeesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	femployeesview = currentForm = new ew.Form("femployeesview", "view");
	loadjs.done("femployeesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$employees_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $employees_view->ExportOptions->render("body") ?>
<?php $employees_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $employees_view->showPageHeader(); ?>
<?php
$employees_view->showMessage();
?>
<form name="femployeesview" id="femployeesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employees">
<input type="hidden" name="modal" value="<?php echo (int)$employees_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($employees_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_EmployeeID"><?php echo $employees_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $employees_view->EmployeeID->cellAttributes() ?>>
<span id="el_employees_EmployeeID">
<span<?php echo $employees_view->EmployeeID->viewAttributes() ?>><?php echo $employees_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->LastName->Visible) { // LastName ?>
	<tr id="r_LastName">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_LastName"><?php echo $employees_view->LastName->caption() ?></span></td>
		<td data-name="LastName" <?php echo $employees_view->LastName->cellAttributes() ?>>
<span id="el_employees_LastName">
<span<?php echo $employees_view->LastName->viewAttributes() ?>><?php echo $employees_view->LastName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->FirstName->Visible) { // FirstName ?>
	<tr id="r_FirstName">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_FirstName"><?php echo $employees_view->FirstName->caption() ?></span></td>
		<td data-name="FirstName" <?php echo $employees_view->FirstName->cellAttributes() ?>>
<span id="el_employees_FirstName">
<span<?php echo $employees_view->FirstName->viewAttributes() ?>><?php echo $employees_view->FirstName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->Title->Visible) { // Title ?>
	<tr id="r_Title">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Title"><?php echo $employees_view->Title->caption() ?></span></td>
		<td data-name="Title" <?php echo $employees_view->Title->cellAttributes() ?>>
<span id="el_employees_Title">
<span<?php echo $employees_view->Title->viewAttributes() ?>><?php echo $employees_view->Title->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->TitleOfCourtesy->Visible) { // TitleOfCourtesy ?>
	<tr id="r_TitleOfCourtesy">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_TitleOfCourtesy"><?php echo $employees_view->TitleOfCourtesy->caption() ?></span></td>
		<td data-name="TitleOfCourtesy" <?php echo $employees_view->TitleOfCourtesy->cellAttributes() ?>>
<span id="el_employees_TitleOfCourtesy">
<span<?php echo $employees_view->TitleOfCourtesy->viewAttributes() ?>><?php echo $employees_view->TitleOfCourtesy->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->BirthDate->Visible) { // BirthDate ?>
	<tr id="r_BirthDate">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_BirthDate"><?php echo $employees_view->BirthDate->caption() ?></span></td>
		<td data-name="BirthDate" <?php echo $employees_view->BirthDate->cellAttributes() ?>>
<span id="el_employees_BirthDate">
<span<?php echo $employees_view->BirthDate->viewAttributes() ?>><?php echo $employees_view->BirthDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->HireDate->Visible) { // HireDate ?>
	<tr id="r_HireDate">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_HireDate"><?php echo $employees_view->HireDate->caption() ?></span></td>
		<td data-name="HireDate" <?php echo $employees_view->HireDate->cellAttributes() ?>>
<span id="el_employees_HireDate">
<span<?php echo $employees_view->HireDate->viewAttributes() ?>><?php echo $employees_view->HireDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->Address->Visible) { // Address ?>
	<tr id="r_Address">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Address"><?php echo $employees_view->Address->caption() ?></span></td>
		<td data-name="Address" <?php echo $employees_view->Address->cellAttributes() ?>>
<span id="el_employees_Address">
<span<?php echo $employees_view->Address->viewAttributes() ?>><?php echo $employees_view->Address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->City->Visible) { // City ?>
	<tr id="r_City">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_City"><?php echo $employees_view->City->caption() ?></span></td>
		<td data-name="City" <?php echo $employees_view->City->cellAttributes() ?>>
<span id="el_employees_City">
<span<?php echo $employees_view->City->viewAttributes() ?>><?php echo $employees_view->City->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->Region->Visible) { // Region ?>
	<tr id="r_Region">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Region"><?php echo $employees_view->Region->caption() ?></span></td>
		<td data-name="Region" <?php echo $employees_view->Region->cellAttributes() ?>>
<span id="el_employees_Region">
<span<?php echo $employees_view->Region->viewAttributes() ?>><?php echo $employees_view->Region->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->PostalCode->Visible) { // PostalCode ?>
	<tr id="r_PostalCode">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_PostalCode"><?php echo $employees_view->PostalCode->caption() ?></span></td>
		<td data-name="PostalCode" <?php echo $employees_view->PostalCode->cellAttributes() ?>>
<span id="el_employees_PostalCode">
<span<?php echo $employees_view->PostalCode->viewAttributes() ?>><?php echo $employees_view->PostalCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->Country->Visible) { // Country ?>
	<tr id="r_Country">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Country"><?php echo $employees_view->Country->caption() ?></span></td>
		<td data-name="Country" <?php echo $employees_view->Country->cellAttributes() ?>>
<span id="el_employees_Country">
<span<?php echo $employees_view->Country->viewAttributes() ?>><?php echo $employees_view->Country->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->HomePhone->Visible) { // HomePhone ?>
	<tr id="r_HomePhone">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_HomePhone"><?php echo $employees_view->HomePhone->caption() ?></span></td>
		<td data-name="HomePhone" <?php echo $employees_view->HomePhone->cellAttributes() ?>>
<span id="el_employees_HomePhone">
<span<?php echo $employees_view->HomePhone->viewAttributes() ?>><?php echo $employees_view->HomePhone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->Extension->Visible) { // Extension ?>
	<tr id="r_Extension">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Extension"><?php echo $employees_view->Extension->caption() ?></span></td>
		<td data-name="Extension" <?php echo $employees_view->Extension->cellAttributes() ?>>
<span id="el_employees_Extension">
<span<?php echo $employees_view->Extension->viewAttributes() ?>><?php echo $employees_view->Extension->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->_Email->Visible) { // Email ?>
	<tr id="r__Email">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees__Email"><?php echo $employees_view->_Email->caption() ?></span></td>
		<td data-name="_Email" <?php echo $employees_view->_Email->cellAttributes() ?>>
<span id="el_employees__Email">
<span<?php echo $employees_view->_Email->viewAttributes() ?>><?php echo $employees_view->_Email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->Photo->Visible) { // Photo ?>
	<tr id="r_Photo">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Photo"><?php echo $employees_view->Photo->caption() ?></span></td>
		<td data-name="Photo" <?php echo $employees_view->Photo->cellAttributes() ?>>
<span id="el_employees_Photo">
<span<?php echo $employees_view->Photo->viewAttributes() ?>><?php echo $employees_view->Photo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->Notes->Visible) { // Notes ?>
	<tr id="r_Notes">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Notes"><?php echo $employees_view->Notes->caption() ?></span></td>
		<td data-name="Notes" <?php echo $employees_view->Notes->cellAttributes() ?>>
<span id="el_employees_Notes">
<span<?php echo $employees_view->Notes->viewAttributes() ?>><?php echo $employees_view->Notes->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->ReportsTo->Visible) { // ReportsTo ?>
	<tr id="r_ReportsTo">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_ReportsTo"><?php echo $employees_view->ReportsTo->caption() ?></span></td>
		<td data-name="ReportsTo" <?php echo $employees_view->ReportsTo->cellAttributes() ?>>
<span id="el_employees_ReportsTo">
<span<?php echo $employees_view->ReportsTo->viewAttributes() ?>><?php echo $employees_view->ReportsTo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->Password->Visible) { // Password ?>
	<tr id="r_Password">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Password"><?php echo $employees_view->Password->caption() ?></span></td>
		<td data-name="Password" <?php echo $employees_view->Password->cellAttributes() ?>>
<span id="el_employees_Password">
<span<?php echo $employees_view->Password->viewAttributes() ?>><?php echo $employees_view->Password->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->UserLevel->Visible) { // UserLevel ?>
	<tr id="r_UserLevel">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_UserLevel"><?php echo $employees_view->UserLevel->caption() ?></span></td>
		<td data-name="UserLevel" <?php echo $employees_view->UserLevel->cellAttributes() ?>>
<span id="el_employees_UserLevel">
<span<?php echo $employees_view->UserLevel->viewAttributes() ?>><?php echo $employees_view->UserLevel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->Username->Visible) { // Username ?>
	<tr id="r_Username">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Username"><?php echo $employees_view->Username->caption() ?></span></td>
		<td data-name="Username" <?php echo $employees_view->Username->cellAttributes() ?>>
<span id="el_employees_Username">
<span<?php echo $employees_view->Username->viewAttributes() ?>><?php echo $employees_view->Username->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->Activated->Visible) { // Activated ?>
	<tr id="r_Activated">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Activated"><?php echo $employees_view->Activated->caption() ?></span></td>
		<td data-name="Activated" <?php echo $employees_view->Activated->cellAttributes() ?>>
<span id="el_employees_Activated">
<span<?php echo $employees_view->Activated->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_Activated" class="custom-control-input" value="<?php echo $employees_view->Activated->getViewValue() ?>" disabled<?php if (ConvertToBool($employees_view->Activated->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_Activated"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->Profile->Visible) { // Profile ?>
	<tr id="r_Profile">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_Profile"><?php echo $employees_view->Profile->caption() ?></span></td>
		<td data-name="Profile" <?php echo $employees_view->Profile->cellAttributes() ?>>
<span id="el_employees_Profile">
<span<?php echo $employees_view->Profile->viewAttributes() ?>><?php echo $employees_view->Profile->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$employees_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employees_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$employees_view->terminate();
?>