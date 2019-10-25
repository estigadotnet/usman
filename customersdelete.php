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
$customers_delete = new customers_delete();

// Run the page
$customers_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$customers_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcustomersdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcustomersdelete = currentForm = new ew.Form("fcustomersdelete", "delete");
	loadjs.done("fcustomersdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $customers_delete->showPageHeader(); ?>
<?php
$customers_delete->showMessage();
?>
<form name="fcustomersdelete" id="fcustomersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="customers">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($customers_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($customers_delete->CustomerID->Visible) { // CustomerID ?>
		<th class="<?php echo $customers_delete->CustomerID->headerCellClass() ?>"><span id="elh_customers_CustomerID" class="customers_CustomerID"><?php echo $customers_delete->CustomerID->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->CompanyName->Visible) { // CompanyName ?>
		<th class="<?php echo $customers_delete->CompanyName->headerCellClass() ?>"><span id="elh_customers_CompanyName" class="customers_CompanyName"><?php echo $customers_delete->CompanyName->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->ContactName->Visible) { // ContactName ?>
		<th class="<?php echo $customers_delete->ContactName->headerCellClass() ?>"><span id="elh_customers_ContactName" class="customers_ContactName"><?php echo $customers_delete->ContactName->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->ContactTitle->Visible) { // ContactTitle ?>
		<th class="<?php echo $customers_delete->ContactTitle->headerCellClass() ?>"><span id="elh_customers_ContactTitle" class="customers_ContactTitle"><?php echo $customers_delete->ContactTitle->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->Address->Visible) { // Address ?>
		<th class="<?php echo $customers_delete->Address->headerCellClass() ?>"><span id="elh_customers_Address" class="customers_Address"><?php echo $customers_delete->Address->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->City->Visible) { // City ?>
		<th class="<?php echo $customers_delete->City->headerCellClass() ?>"><span id="elh_customers_City" class="customers_City"><?php echo $customers_delete->City->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->Region->Visible) { // Region ?>
		<th class="<?php echo $customers_delete->Region->headerCellClass() ?>"><span id="elh_customers_Region" class="customers_Region"><?php echo $customers_delete->Region->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->PostalCode->Visible) { // PostalCode ?>
		<th class="<?php echo $customers_delete->PostalCode->headerCellClass() ?>"><span id="elh_customers_PostalCode" class="customers_PostalCode"><?php echo $customers_delete->PostalCode->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->Country->Visible) { // Country ?>
		<th class="<?php echo $customers_delete->Country->headerCellClass() ?>"><span id="elh_customers_Country" class="customers_Country"><?php echo $customers_delete->Country->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->Phone->Visible) { // Phone ?>
		<th class="<?php echo $customers_delete->Phone->headerCellClass() ?>"><span id="elh_customers_Phone" class="customers_Phone"><?php echo $customers_delete->Phone->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->Fax->Visible) { // Fax ?>
		<th class="<?php echo $customers_delete->Fax->headerCellClass() ?>"><span id="elh_customers_Fax" class="customers_Fax"><?php echo $customers_delete->Fax->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$customers_delete->RecordCount = 0;
$i = 0;
while (!$customers_delete->Recordset->EOF) {
	$customers_delete->RecordCount++;
	$customers_delete->RowCount++;

	// Set row properties
	$customers->resetAttributes();
	$customers->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$customers_delete->loadRowValues($customers_delete->Recordset);

	// Render row
	$customers_delete->renderRow();
?>
	<tr <?php echo $customers->rowAttributes() ?>>
<?php if ($customers_delete->CustomerID->Visible) { // CustomerID ?>
		<td <?php echo $customers_delete->CustomerID->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_CustomerID" class="customers_CustomerID">
<span<?php echo $customers_delete->CustomerID->viewAttributes() ?>><?php echo $customers_delete->CustomerID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->CompanyName->Visible) { // CompanyName ?>
		<td <?php echo $customers_delete->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_CompanyName" class="customers_CompanyName">
<span<?php echo $customers_delete->CompanyName->viewAttributes() ?>><?php echo $customers_delete->CompanyName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->ContactName->Visible) { // ContactName ?>
		<td <?php echo $customers_delete->ContactName->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_ContactName" class="customers_ContactName">
<span<?php echo $customers_delete->ContactName->viewAttributes() ?>><?php echo $customers_delete->ContactName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->ContactTitle->Visible) { // ContactTitle ?>
		<td <?php echo $customers_delete->ContactTitle->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_ContactTitle" class="customers_ContactTitle">
<span<?php echo $customers_delete->ContactTitle->viewAttributes() ?>><?php echo $customers_delete->ContactTitle->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->Address->Visible) { // Address ?>
		<td <?php echo $customers_delete->Address->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_Address" class="customers_Address">
<span<?php echo $customers_delete->Address->viewAttributes() ?>><?php echo $customers_delete->Address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->City->Visible) { // City ?>
		<td <?php echo $customers_delete->City->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_City" class="customers_City">
<span<?php echo $customers_delete->City->viewAttributes() ?>><?php echo $customers_delete->City->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->Region->Visible) { // Region ?>
		<td <?php echo $customers_delete->Region->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_Region" class="customers_Region">
<span<?php echo $customers_delete->Region->viewAttributes() ?>><?php echo $customers_delete->Region->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->PostalCode->Visible) { // PostalCode ?>
		<td <?php echo $customers_delete->PostalCode->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_PostalCode" class="customers_PostalCode">
<span<?php echo $customers_delete->PostalCode->viewAttributes() ?>><?php echo $customers_delete->PostalCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->Country->Visible) { // Country ?>
		<td <?php echo $customers_delete->Country->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_Country" class="customers_Country">
<span<?php echo $customers_delete->Country->viewAttributes() ?>><?php echo $customers_delete->Country->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->Phone->Visible) { // Phone ?>
		<td <?php echo $customers_delete->Phone->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_Phone" class="customers_Phone">
<span<?php echo $customers_delete->Phone->viewAttributes() ?>><?php echo $customers_delete->Phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->Fax->Visible) { // Fax ?>
		<td <?php echo $customers_delete->Fax->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_Fax" class="customers_Fax">
<span<?php echo $customers_delete->Fax->viewAttributes() ?>><?php echo $customers_delete->Fax->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$customers_delete->Recordset->moveNext();
}
$customers_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $customers_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$customers_delete->showPageFooter();
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
$customers_delete->terminate();
?>