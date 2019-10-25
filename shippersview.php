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
$shippers_view = new shippers_view();

// Run the page
$shippers_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$shippers_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$shippers_view->isExport()) { ?>
<script>
var fshippersview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fshippersview = currentForm = new ew.Form("fshippersview", "view");
	loadjs.done("fshippersview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$shippers_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $shippers_view->ExportOptions->render("body") ?>
<?php $shippers_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $shippers_view->showPageHeader(); ?>
<?php
$shippers_view->showMessage();
?>
<form name="fshippersview" id="fshippersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="shippers">
<input type="hidden" name="modal" value="<?php echo (int)$shippers_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($shippers_view->ShipperID->Visible) { // ShipperID ?>
	<tr id="r_ShipperID">
		<td class="<?php echo $shippers_view->TableLeftColumnClass ?>"><span id="elh_shippers_ShipperID"><?php echo $shippers_view->ShipperID->caption() ?></span></td>
		<td data-name="ShipperID" <?php echo $shippers_view->ShipperID->cellAttributes() ?>>
<span id="el_shippers_ShipperID">
<span<?php echo $shippers_view->ShipperID->viewAttributes() ?>><?php echo $shippers_view->ShipperID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($shippers_view->CompanyName->Visible) { // CompanyName ?>
	<tr id="r_CompanyName">
		<td class="<?php echo $shippers_view->TableLeftColumnClass ?>"><span id="elh_shippers_CompanyName"><?php echo $shippers_view->CompanyName->caption() ?></span></td>
		<td data-name="CompanyName" <?php echo $shippers_view->CompanyName->cellAttributes() ?>>
<span id="el_shippers_CompanyName">
<span<?php echo $shippers_view->CompanyName->viewAttributes() ?>><?php echo $shippers_view->CompanyName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($shippers_view->Phone->Visible) { // Phone ?>
	<tr id="r_Phone">
		<td class="<?php echo $shippers_view->TableLeftColumnClass ?>"><span id="elh_shippers_Phone"><?php echo $shippers_view->Phone->caption() ?></span></td>
		<td data-name="Phone" <?php echo $shippers_view->Phone->cellAttributes() ?>>
<span id="el_shippers_Phone">
<span<?php echo $shippers_view->Phone->viewAttributes() ?>><?php echo $shippers_view->Phone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$shippers_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$shippers_view->isExport()) { ?>
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
$shippers_view->terminate();
?>