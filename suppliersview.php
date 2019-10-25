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
$suppliers_view = new suppliers_view();

// Run the page
$suppliers_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$suppliers_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$suppliers_view->isExport()) { ?>
<script>
var fsuppliersview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fsuppliersview = currentForm = new ew.Form("fsuppliersview", "view");
	loadjs.done("fsuppliersview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$suppliers_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $suppliers_view->ExportOptions->render("body") ?>
<?php $suppliers_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $suppliers_view->showPageHeader(); ?>
<?php
$suppliers_view->showMessage();
?>
<form name="fsuppliersview" id="fsuppliersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="suppliers">
<input type="hidden" name="modal" value="<?php echo (int)$suppliers_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($suppliers_view->SupplierID->Visible) { // SupplierID ?>
	<tr id="r_SupplierID">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_SupplierID"><?php echo $suppliers_view->SupplierID->caption() ?></span></td>
		<td data-name="SupplierID" <?php echo $suppliers_view->SupplierID->cellAttributes() ?>>
<span id="el_suppliers_SupplierID">
<span<?php echo $suppliers_view->SupplierID->viewAttributes() ?>><?php echo $suppliers_view->SupplierID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers_view->CompanyName->Visible) { // CompanyName ?>
	<tr id="r_CompanyName">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_CompanyName"><?php echo $suppliers_view->CompanyName->caption() ?></span></td>
		<td data-name="CompanyName" <?php echo $suppliers_view->CompanyName->cellAttributes() ?>>
<span id="el_suppliers_CompanyName">
<span<?php echo $suppliers_view->CompanyName->viewAttributes() ?>><?php echo $suppliers_view->CompanyName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers_view->ContactName->Visible) { // ContactName ?>
	<tr id="r_ContactName">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_ContactName"><?php echo $suppliers_view->ContactName->caption() ?></span></td>
		<td data-name="ContactName" <?php echo $suppliers_view->ContactName->cellAttributes() ?>>
<span id="el_suppliers_ContactName">
<span<?php echo $suppliers_view->ContactName->viewAttributes() ?>><?php echo $suppliers_view->ContactName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers_view->ContactTitle->Visible) { // ContactTitle ?>
	<tr id="r_ContactTitle">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_ContactTitle"><?php echo $suppliers_view->ContactTitle->caption() ?></span></td>
		<td data-name="ContactTitle" <?php echo $suppliers_view->ContactTitle->cellAttributes() ?>>
<span id="el_suppliers_ContactTitle">
<span<?php echo $suppliers_view->ContactTitle->viewAttributes() ?>><?php echo $suppliers_view->ContactTitle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers_view->Address->Visible) { // Address ?>
	<tr id="r_Address">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_Address"><?php echo $suppliers_view->Address->caption() ?></span></td>
		<td data-name="Address" <?php echo $suppliers_view->Address->cellAttributes() ?>>
<span id="el_suppliers_Address">
<span<?php echo $suppliers_view->Address->viewAttributes() ?>><?php echo $suppliers_view->Address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers_view->City->Visible) { // City ?>
	<tr id="r_City">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_City"><?php echo $suppliers_view->City->caption() ?></span></td>
		<td data-name="City" <?php echo $suppliers_view->City->cellAttributes() ?>>
<span id="el_suppliers_City">
<span<?php echo $suppliers_view->City->viewAttributes() ?>><?php echo $suppliers_view->City->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers_view->Region->Visible) { // Region ?>
	<tr id="r_Region">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_Region"><?php echo $suppliers_view->Region->caption() ?></span></td>
		<td data-name="Region" <?php echo $suppliers_view->Region->cellAttributes() ?>>
<span id="el_suppliers_Region">
<span<?php echo $suppliers_view->Region->viewAttributes() ?>><?php echo $suppliers_view->Region->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers_view->PostalCode->Visible) { // PostalCode ?>
	<tr id="r_PostalCode">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_PostalCode"><?php echo $suppliers_view->PostalCode->caption() ?></span></td>
		<td data-name="PostalCode" <?php echo $suppliers_view->PostalCode->cellAttributes() ?>>
<span id="el_suppliers_PostalCode">
<span<?php echo $suppliers_view->PostalCode->viewAttributes() ?>><?php echo $suppliers_view->PostalCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers_view->Country->Visible) { // Country ?>
	<tr id="r_Country">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_Country"><?php echo $suppliers_view->Country->caption() ?></span></td>
		<td data-name="Country" <?php echo $suppliers_view->Country->cellAttributes() ?>>
<span id="el_suppliers_Country">
<span<?php echo $suppliers_view->Country->viewAttributes() ?>><?php echo $suppliers_view->Country->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers_view->Phone->Visible) { // Phone ?>
	<tr id="r_Phone">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_Phone"><?php echo $suppliers_view->Phone->caption() ?></span></td>
		<td data-name="Phone" <?php echo $suppliers_view->Phone->cellAttributes() ?>>
<span id="el_suppliers_Phone">
<span<?php echo $suppliers_view->Phone->viewAttributes() ?>><?php echo $suppliers_view->Phone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers_view->Fax->Visible) { // Fax ?>
	<tr id="r_Fax">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_Fax"><?php echo $suppliers_view->Fax->caption() ?></span></td>
		<td data-name="Fax" <?php echo $suppliers_view->Fax->cellAttributes() ?>>
<span id="el_suppliers_Fax">
<span<?php echo $suppliers_view->Fax->viewAttributes() ?>><?php echo $suppliers_view->Fax->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($suppliers_view->HomePage->Visible) { // HomePage ?>
	<tr id="r_HomePage">
		<td class="<?php echo $suppliers_view->TableLeftColumnClass ?>"><span id="elh_suppliers_HomePage"><?php echo $suppliers_view->HomePage->caption() ?></span></td>
		<td data-name="HomePage" <?php echo $suppliers_view->HomePage->cellAttributes() ?>>
<span id="el_suppliers_HomePage">
<span<?php echo $suppliers_view->HomePage->viewAttributes() ?>><?php echo $suppliers_view->HomePage->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$suppliers_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$suppliers_view->isExport()) { ?>
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
$suppliers_view->terminate();
?>