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
$customers_view = new customers_view();

// Run the page
$customers_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$customers_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$customers_view->isExport()) { ?>
<script>
var fcustomersview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcustomersview = currentForm = new ew.Form("fcustomersview", "view");
	loadjs.done("fcustomersview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$customers_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $customers_view->ExportOptions->render("body") ?>
<?php $customers_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $customers_view->showPageHeader(); ?>
<?php
$customers_view->showMessage();
?>
<form name="fcustomersview" id="fcustomersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="customers">
<input type="hidden" name="modal" value="<?php echo (int)$customers_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($customers_view->CustomerID->Visible) { // CustomerID ?>
	<tr id="r_CustomerID">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_CustomerID"><?php echo $customers_view->CustomerID->caption() ?></span></td>
		<td data-name="CustomerID" <?php echo $customers_view->CustomerID->cellAttributes() ?>>
<span id="el_customers_CustomerID">
<span<?php echo $customers_view->CustomerID->viewAttributes() ?>><?php echo $customers_view->CustomerID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->CompanyName->Visible) { // CompanyName ?>
	<tr id="r_CompanyName">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_CompanyName"><?php echo $customers_view->CompanyName->caption() ?></span></td>
		<td data-name="CompanyName" <?php echo $customers_view->CompanyName->cellAttributes() ?>>
<span id="el_customers_CompanyName">
<span<?php echo $customers_view->CompanyName->viewAttributes() ?>><?php echo $customers_view->CompanyName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->ContactName->Visible) { // ContactName ?>
	<tr id="r_ContactName">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_ContactName"><?php echo $customers_view->ContactName->caption() ?></span></td>
		<td data-name="ContactName" <?php echo $customers_view->ContactName->cellAttributes() ?>>
<span id="el_customers_ContactName">
<span<?php echo $customers_view->ContactName->viewAttributes() ?>><?php echo $customers_view->ContactName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->ContactTitle->Visible) { // ContactTitle ?>
	<tr id="r_ContactTitle">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_ContactTitle"><?php echo $customers_view->ContactTitle->caption() ?></span></td>
		<td data-name="ContactTitle" <?php echo $customers_view->ContactTitle->cellAttributes() ?>>
<span id="el_customers_ContactTitle">
<span<?php echo $customers_view->ContactTitle->viewAttributes() ?>><?php echo $customers_view->ContactTitle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->Address->Visible) { // Address ?>
	<tr id="r_Address">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_Address"><?php echo $customers_view->Address->caption() ?></span></td>
		<td data-name="Address" <?php echo $customers_view->Address->cellAttributes() ?>>
<span id="el_customers_Address">
<span<?php echo $customers_view->Address->viewAttributes() ?>><?php echo $customers_view->Address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->City->Visible) { // City ?>
	<tr id="r_City">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_City"><?php echo $customers_view->City->caption() ?></span></td>
		<td data-name="City" <?php echo $customers_view->City->cellAttributes() ?>>
<span id="el_customers_City">
<span<?php echo $customers_view->City->viewAttributes() ?>><?php echo $customers_view->City->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->Region->Visible) { // Region ?>
	<tr id="r_Region">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_Region"><?php echo $customers_view->Region->caption() ?></span></td>
		<td data-name="Region" <?php echo $customers_view->Region->cellAttributes() ?>>
<span id="el_customers_Region">
<span<?php echo $customers_view->Region->viewAttributes() ?>><?php echo $customers_view->Region->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->PostalCode->Visible) { // PostalCode ?>
	<tr id="r_PostalCode">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_PostalCode"><?php echo $customers_view->PostalCode->caption() ?></span></td>
		<td data-name="PostalCode" <?php echo $customers_view->PostalCode->cellAttributes() ?>>
<span id="el_customers_PostalCode">
<span<?php echo $customers_view->PostalCode->viewAttributes() ?>><?php echo $customers_view->PostalCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->Country->Visible) { // Country ?>
	<tr id="r_Country">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_Country"><?php echo $customers_view->Country->caption() ?></span></td>
		<td data-name="Country" <?php echo $customers_view->Country->cellAttributes() ?>>
<span id="el_customers_Country">
<span<?php echo $customers_view->Country->viewAttributes() ?>><?php echo $customers_view->Country->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->Phone->Visible) { // Phone ?>
	<tr id="r_Phone">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_Phone"><?php echo $customers_view->Phone->caption() ?></span></td>
		<td data-name="Phone" <?php echo $customers_view->Phone->cellAttributes() ?>>
<span id="el_customers_Phone">
<span<?php echo $customers_view->Phone->viewAttributes() ?>><?php echo $customers_view->Phone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->Fax->Visible) { // Fax ?>
	<tr id="r_Fax">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_Fax"><?php echo $customers_view->Fax->caption() ?></span></td>
		<td data-name="Fax" <?php echo $customers_view->Fax->cellAttributes() ?>>
<span id="el_customers_Fax">
<span<?php echo $customers_view->Fax->viewAttributes() ?>><?php echo $customers_view->Fax->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$customers_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$customers_view->isExport()) { ?>
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
$customers_view->terminate();
?>