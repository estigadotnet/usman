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
$trademarks_view = new trademarks_view();

// Run the page
$trademarks_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trademarks_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$trademarks_view->isExport()) { ?>
<script>
var ftrademarksview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftrademarksview = currentForm = new ew.Form("ftrademarksview", "view");
	loadjs.done("ftrademarksview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$trademarks_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $trademarks_view->ExportOptions->render("body") ?>
<?php $trademarks_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $trademarks_view->showPageHeader(); ?>
<?php
$trademarks_view->showMessage();
?>
<form name="ftrademarksview" id="ftrademarksview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trademarks">
<input type="hidden" name="modal" value="<?php echo (int)$trademarks_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($trademarks_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $trademarks_view->TableLeftColumnClass ?>"><span id="elh_trademarks_ID"><?php echo $trademarks_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $trademarks_view->ID->cellAttributes() ?>>
<span id="el_trademarks_ID">
<span<?php echo $trademarks_view->ID->viewAttributes() ?>><?php echo $trademarks_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($trademarks_view->Trademark->Visible) { // Trademark ?>
	<tr id="r_Trademark">
		<td class="<?php echo $trademarks_view->TableLeftColumnClass ?>"><span id="elh_trademarks_Trademark"><?php echo $trademarks_view->Trademark->caption() ?></span></td>
		<td data-name="Trademark" <?php echo $trademarks_view->Trademark->cellAttributes() ?>>
<span id="el_trademarks_Trademark">
<span<?php echo $trademarks_view->Trademark->viewAttributes() ?>><?php echo $trademarks_view->Trademark->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$trademarks_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$trademarks_view->isExport()) { ?>
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
$trademarks_view->terminate();
?>