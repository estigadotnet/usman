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
$models_view = new models_view();

// Run the page
$models_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$models_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$models_view->isExport()) { ?>
<script>
var fmodelsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fmodelsview = currentForm = new ew.Form("fmodelsview", "view");
	loadjs.done("fmodelsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$models_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $models_view->ExportOptions->render("body") ?>
<?php $models_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $models_view->showPageHeader(); ?>
<?php
$models_view->showMessage();
?>
<form name="fmodelsview" id="fmodelsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="models">
<input type="hidden" name="modal" value="<?php echo (int)$models_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($models_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $models_view->TableLeftColumnClass ?>"><span id="elh_models_ID"><?php echo $models_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $models_view->ID->cellAttributes() ?>>
<span id="el_models_ID">
<span<?php echo $models_view->ID->viewAttributes() ?>><?php echo $models_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($models_view->Trademark->Visible) { // Trademark ?>
	<tr id="r_Trademark">
		<td class="<?php echo $models_view->TableLeftColumnClass ?>"><span id="elh_models_Trademark"><?php echo $models_view->Trademark->caption() ?></span></td>
		<td data-name="Trademark" <?php echo $models_view->Trademark->cellAttributes() ?>>
<span id="el_models_Trademark">
<span<?php echo $models_view->Trademark->viewAttributes() ?>><?php echo $models_view->Trademark->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($models_view->Model->Visible) { // Model ?>
	<tr id="r_Model">
		<td class="<?php echo $models_view->TableLeftColumnClass ?>"><span id="elh_models_Model"><?php echo $models_view->Model->caption() ?></span></td>
		<td data-name="Model" <?php echo $models_view->Model->cellAttributes() ?>>
<span id="el_models_Model">
<span<?php echo $models_view->Model->viewAttributes() ?>><?php echo $models_view->Model->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$models_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$models_view->isExport()) { ?>
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
$models_view->terminate();
?>