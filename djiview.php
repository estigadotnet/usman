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
$dji_view = new dji_view();

// Run the page
$dji_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dji_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$dji_view->isExport()) { ?>
<script>
var fdjiview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdjiview = currentForm = new ew.Form("fdjiview", "view");
	loadjs.done("fdjiview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$dji_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $dji_view->ExportOptions->render("body") ?>
<?php $dji_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $dji_view->showPageHeader(); ?>
<?php
$dji_view->showMessage();
?>
<form name="fdjiview" id="fdjiview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dji">
<input type="hidden" name="modal" value="<?php echo (int)$dji_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($dji_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $dji_view->TableLeftColumnClass ?>"><span id="elh_dji_ID"><?php echo $dji_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $dji_view->ID->cellAttributes() ?>>
<span id="el_dji_ID">
<span<?php echo $dji_view->ID->viewAttributes() ?>><?php echo $dji_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dji_view->Date->Visible) { // Date ?>
	<tr id="r_Date">
		<td class="<?php echo $dji_view->TableLeftColumnClass ?>"><span id="elh_dji_Date"><?php echo $dji_view->Date->caption() ?></span></td>
		<td data-name="Date" <?php echo $dji_view->Date->cellAttributes() ?>>
<span id="el_dji_Date">
<span<?php echo $dji_view->Date->viewAttributes() ?>><?php echo $dji_view->Date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dji_view->Open->Visible) { // Open ?>
	<tr id="r_Open">
		<td class="<?php echo $dji_view->TableLeftColumnClass ?>"><span id="elh_dji_Open"><?php echo $dji_view->Open->caption() ?></span></td>
		<td data-name="Open" <?php echo $dji_view->Open->cellAttributes() ?>>
<span id="el_dji_Open">
<span<?php echo $dji_view->Open->viewAttributes() ?>><?php echo $dji_view->Open->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dji_view->High->Visible) { // High ?>
	<tr id="r_High">
		<td class="<?php echo $dji_view->TableLeftColumnClass ?>"><span id="elh_dji_High"><?php echo $dji_view->High->caption() ?></span></td>
		<td data-name="High" <?php echo $dji_view->High->cellAttributes() ?>>
<span id="el_dji_High">
<span<?php echo $dji_view->High->viewAttributes() ?>><?php echo $dji_view->High->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dji_view->Low->Visible) { // Low ?>
	<tr id="r_Low">
		<td class="<?php echo $dji_view->TableLeftColumnClass ?>"><span id="elh_dji_Low"><?php echo $dji_view->Low->caption() ?></span></td>
		<td data-name="Low" <?php echo $dji_view->Low->cellAttributes() ?>>
<span id="el_dji_Low">
<span<?php echo $dji_view->Low->viewAttributes() ?>><?php echo $dji_view->Low->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dji_view->Close->Visible) { // Close ?>
	<tr id="r_Close">
		<td class="<?php echo $dji_view->TableLeftColumnClass ?>"><span id="elh_dji_Close"><?php echo $dji_view->Close->caption() ?></span></td>
		<td data-name="Close" <?php echo $dji_view->Close->cellAttributes() ?>>
<span id="el_dji_Close">
<span<?php echo $dji_view->Close->viewAttributes() ?>><?php echo $dji_view->Close->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dji_view->Volume->Visible) { // Volume ?>
	<tr id="r_Volume">
		<td class="<?php echo $dji_view->TableLeftColumnClass ?>"><span id="elh_dji_Volume"><?php echo $dji_view->Volume->caption() ?></span></td>
		<td data-name="Volume" <?php echo $dji_view->Volume->cellAttributes() ?>>
<span id="el_dji_Volume">
<span<?php echo $dji_view->Volume->viewAttributes() ?>><?php echo $dji_view->Volume->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dji_view->Adj_Close->Visible) { // Adj Close ?>
	<tr id="r_Adj_Close">
		<td class="<?php echo $dji_view->TableLeftColumnClass ?>"><span id="elh_dji_Adj_Close"><?php echo $dji_view->Adj_Close->caption() ?></span></td>
		<td data-name="Adj_Close" <?php echo $dji_view->Adj_Close->cellAttributes() ?>>
<span id="el_dji_Adj_Close">
<span<?php echo $dji_view->Adj_Close->viewAttributes() ?>><?php echo $dji_view->Adj_Close->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dji_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $dji_view->TableLeftColumnClass ?>"><span id="elh_dji_Name"><?php echo $dji_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $dji_view->Name->cellAttributes() ?>>
<span id="el_dji_Name">
<span<?php echo $dji_view->Name->viewAttributes() ?>><?php echo $dji_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dji_view->Name2->Visible) { // Name2 ?>
	<tr id="r_Name2">
		<td class="<?php echo $dji_view->TableLeftColumnClass ?>"><span id="elh_dji_Name2"><?php echo $dji_view->Name2->caption() ?></span></td>
		<td data-name="Name2" <?php echo $dji_view->Name2->cellAttributes() ?>>
<span id="el_dji_Name2">
<span<?php echo $dji_view->Name2->viewAttributes() ?>><?php echo $dji_view->Name2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$dji_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$dji_view->isExport()) { ?>
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
$dji_view->terminate();
?>