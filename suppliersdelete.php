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
$suppliers_delete = new suppliers_delete();

// Run the page
$suppliers_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$suppliers_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsuppliersdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fsuppliersdelete = currentForm = new ew.Form("fsuppliersdelete", "delete");
	loadjs.done("fsuppliersdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $suppliers_delete->showPageHeader(); ?>
<?php
$suppliers_delete->showMessage();
?>
<form name="fsuppliersdelete" id="fsuppliersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="suppliers">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($suppliers_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($suppliers_delete->SupplierID->Visible) { // SupplierID ?>
		<th class="<?php echo $suppliers_delete->SupplierID->headerCellClass() ?>"><span id="elh_suppliers_SupplierID" class="suppliers_SupplierID"><?php echo $suppliers_delete->SupplierID->caption() ?></span></th>
<?php } ?>
<?php if ($suppliers_delete->CompanyName->Visible) { // CompanyName ?>
		<th class="<?php echo $suppliers_delete->CompanyName->headerCellClass() ?>"><span id="elh_suppliers_CompanyName" class="suppliers_CompanyName"><?php echo $suppliers_delete->CompanyName->caption() ?></span></th>
<?php } ?>
<?php if ($suppliers_delete->ContactName->Visible) { // ContactName ?>
		<th class="<?php echo $suppliers_delete->ContactName->headerCellClass() ?>"><span id="elh_suppliers_ContactName" class="suppliers_ContactName"><?php echo $suppliers_delete->ContactName->caption() ?></span></th>
<?php } ?>
<?php if ($suppliers_delete->ContactTitle->Visible) { // ContactTitle ?>
		<th class="<?php echo $suppliers_delete->ContactTitle->headerCellClass() ?>"><span id="elh_suppliers_ContactTitle" class="suppliers_ContactTitle"><?php echo $suppliers_delete->ContactTitle->caption() ?></span></th>
<?php } ?>
<?php if ($suppliers_delete->Address->Visible) { // Address ?>
		<th class="<?php echo $suppliers_delete->Address->headerCellClass() ?>"><span id="elh_suppliers_Address" class="suppliers_Address"><?php echo $suppliers_delete->Address->caption() ?></span></th>
<?php } ?>
<?php if ($suppliers_delete->City->Visible) { // City ?>
		<th class="<?php echo $suppliers_delete->City->headerCellClass() ?>"><span id="elh_suppliers_City" class="suppliers_City"><?php echo $suppliers_delete->City->caption() ?></span></th>
<?php } ?>
<?php if ($suppliers_delete->Region->Visible) { // Region ?>
		<th class="<?php echo $suppliers_delete->Region->headerCellClass() ?>"><span id="elh_suppliers_Region" class="suppliers_Region"><?php echo $suppliers_delete->Region->caption() ?></span></th>
<?php } ?>
<?php if ($suppliers_delete->PostalCode->Visible) { // PostalCode ?>
		<th class="<?php echo $suppliers_delete->PostalCode->headerCellClass() ?>"><span id="elh_suppliers_PostalCode" class="suppliers_PostalCode"><?php echo $suppliers_delete->PostalCode->caption() ?></span></th>
<?php } ?>
<?php if ($suppliers_delete->Country->Visible) { // Country ?>
		<th class="<?php echo $suppliers_delete->Country->headerCellClass() ?>"><span id="elh_suppliers_Country" class="suppliers_Country"><?php echo $suppliers_delete->Country->caption() ?></span></th>
<?php } ?>
<?php if ($suppliers_delete->Phone->Visible) { // Phone ?>
		<th class="<?php echo $suppliers_delete->Phone->headerCellClass() ?>"><span id="elh_suppliers_Phone" class="suppliers_Phone"><?php echo $suppliers_delete->Phone->caption() ?></span></th>
<?php } ?>
<?php if ($suppliers_delete->Fax->Visible) { // Fax ?>
		<th class="<?php echo $suppliers_delete->Fax->headerCellClass() ?>"><span id="elh_suppliers_Fax" class="suppliers_Fax"><?php echo $suppliers_delete->Fax->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$suppliers_delete->RecordCount = 0;
$i = 0;
while (!$suppliers_delete->Recordset->EOF) {
	$suppliers_delete->RecordCount++;
	$suppliers_delete->RowCount++;

	// Set row properties
	$suppliers->resetAttributes();
	$suppliers->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$suppliers_delete->loadRowValues($suppliers_delete->Recordset);

	// Render row
	$suppliers_delete->renderRow();
?>
	<tr <?php echo $suppliers->rowAttributes() ?>>
<?php if ($suppliers_delete->SupplierID->Visible) { // SupplierID ?>
		<td <?php echo $suppliers_delete->SupplierID->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCount ?>_suppliers_SupplierID" class="suppliers_SupplierID">
<span<?php echo $suppliers_delete->SupplierID->viewAttributes() ?>><?php echo $suppliers_delete->SupplierID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($suppliers_delete->CompanyName->Visible) { // CompanyName ?>
		<td <?php echo $suppliers_delete->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCount ?>_suppliers_CompanyName" class="suppliers_CompanyName">
<span<?php echo $suppliers_delete->CompanyName->viewAttributes() ?>><?php echo $suppliers_delete->CompanyName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($suppliers_delete->ContactName->Visible) { // ContactName ?>
		<td <?php echo $suppliers_delete->ContactName->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCount ?>_suppliers_ContactName" class="suppliers_ContactName">
<span<?php echo $suppliers_delete->ContactName->viewAttributes() ?>><?php echo $suppliers_delete->ContactName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($suppliers_delete->ContactTitle->Visible) { // ContactTitle ?>
		<td <?php echo $suppliers_delete->ContactTitle->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCount ?>_suppliers_ContactTitle" class="suppliers_ContactTitle">
<span<?php echo $suppliers_delete->ContactTitle->viewAttributes() ?>><?php echo $suppliers_delete->ContactTitle->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($suppliers_delete->Address->Visible) { // Address ?>
		<td <?php echo $suppliers_delete->Address->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCount ?>_suppliers_Address" class="suppliers_Address">
<span<?php echo $suppliers_delete->Address->viewAttributes() ?>><?php echo $suppliers_delete->Address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($suppliers_delete->City->Visible) { // City ?>
		<td <?php echo $suppliers_delete->City->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCount ?>_suppliers_City" class="suppliers_City">
<span<?php echo $suppliers_delete->City->viewAttributes() ?>><?php echo $suppliers_delete->City->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($suppliers_delete->Region->Visible) { // Region ?>
		<td <?php echo $suppliers_delete->Region->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCount ?>_suppliers_Region" class="suppliers_Region">
<span<?php echo $suppliers_delete->Region->viewAttributes() ?>><?php echo $suppliers_delete->Region->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($suppliers_delete->PostalCode->Visible) { // PostalCode ?>
		<td <?php echo $suppliers_delete->PostalCode->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCount ?>_suppliers_PostalCode" class="suppliers_PostalCode">
<span<?php echo $suppliers_delete->PostalCode->viewAttributes() ?>><?php echo $suppliers_delete->PostalCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($suppliers_delete->Country->Visible) { // Country ?>
		<td <?php echo $suppliers_delete->Country->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCount ?>_suppliers_Country" class="suppliers_Country">
<span<?php echo $suppliers_delete->Country->viewAttributes() ?>><?php echo $suppliers_delete->Country->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($suppliers_delete->Phone->Visible) { // Phone ?>
		<td <?php echo $suppliers_delete->Phone->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCount ?>_suppliers_Phone" class="suppliers_Phone">
<span<?php echo $suppliers_delete->Phone->viewAttributes() ?>><?php echo $suppliers_delete->Phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($suppliers_delete->Fax->Visible) { // Fax ?>
		<td <?php echo $suppliers_delete->Fax->cellAttributes() ?>>
<span id="el<?php echo $suppliers_delete->RowCount ?>_suppliers_Fax" class="suppliers_Fax">
<span<?php echo $suppliers_delete->Fax->viewAttributes() ?>><?php echo $suppliers_delete->Fax->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$suppliers_delete->Recordset->moveNext();
}
$suppliers_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $suppliers_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$suppliers_delete->showPageFooter();
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
$suppliers_delete->terminate();
?>