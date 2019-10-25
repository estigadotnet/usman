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
$gantt_view = new gantt_view();

// Run the page
$gantt_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gantt_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gantt_view->isExport()) { ?>
<script>
var fganttview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fganttview = currentForm = new ew.Form("fganttview", "view");
	loadjs.done("fganttview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$gantt_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $gantt_view->ExportOptions->render("body") ?>
<?php $gantt_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $gantt_view->showPageHeader(); ?>
<?php
$gantt_view->showMessage();
?>
<form name="fganttview" id="fganttview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gantt">
<input type="hidden" name="modal" value="<?php echo (int)$gantt_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($gantt_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $gantt_view->TableLeftColumnClass ?>"><span id="elh_gantt_id"><?php echo $gantt_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $gantt_view->id->cellAttributes() ?>>
<span id="el_gantt_id">
<span<?php echo $gantt_view->id->viewAttributes() ?>><?php echo $gantt_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gantt_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $gantt_view->TableLeftColumnClass ?>"><span id="elh_gantt_name"><?php echo $gantt_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $gantt_view->name->cellAttributes() ?>>
<span id="el_gantt_name">
<span<?php echo $gantt_view->name->viewAttributes() ?>><?php echo $gantt_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gantt_view->start->Visible) { // start ?>
	<tr id="r_start">
		<td class="<?php echo $gantt_view->TableLeftColumnClass ?>"><span id="elh_gantt_start"><?php echo $gantt_view->start->caption() ?></span></td>
		<td data-name="start" <?php echo $gantt_view->start->cellAttributes() ?>>
<span id="el_gantt_start">
<span<?php echo $gantt_view->start->viewAttributes() ?>><?php echo $gantt_view->start->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gantt_view->end->Visible) { // end ?>
	<tr id="r_end">
		<td class="<?php echo $gantt_view->TableLeftColumnClass ?>"><span id="elh_gantt_end"><?php echo $gantt_view->end->caption() ?></span></td>
		<td data-name="end" <?php echo $gantt_view->end->cellAttributes() ?>>
<span id="el_gantt_end">
<span<?php echo $gantt_view->end->viewAttributes() ?>><?php echo $gantt_view->end->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$gantt_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gantt_view->isExport()) { ?>
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
$gantt_view->terminate();
?>