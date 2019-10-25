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
$gantt_delete = new gantt_delete();

// Run the page
$gantt_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gantt_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fganttdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fganttdelete = currentForm = new ew.Form("fganttdelete", "delete");
	loadjs.done("fganttdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gantt_delete->showPageHeader(); ?>
<?php
$gantt_delete->showMessage();
?>
<form name="fganttdelete" id="fganttdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gantt">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($gantt_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($gantt_delete->id->Visible) { // id ?>
		<th class="<?php echo $gantt_delete->id->headerCellClass() ?>"><span id="elh_gantt_id" class="gantt_id"><?php echo $gantt_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($gantt_delete->name->Visible) { // name ?>
		<th class="<?php echo $gantt_delete->name->headerCellClass() ?>"><span id="elh_gantt_name" class="gantt_name"><?php echo $gantt_delete->name->caption() ?></span></th>
<?php } ?>
<?php if ($gantt_delete->start->Visible) { // start ?>
		<th class="<?php echo $gantt_delete->start->headerCellClass() ?>"><span id="elh_gantt_start" class="gantt_start"><?php echo $gantt_delete->start->caption() ?></span></th>
<?php } ?>
<?php if ($gantt_delete->end->Visible) { // end ?>
		<th class="<?php echo $gantt_delete->end->headerCellClass() ?>"><span id="elh_gantt_end" class="gantt_end"><?php echo $gantt_delete->end->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$gantt_delete->RecordCount = 0;
$i = 0;
while (!$gantt_delete->Recordset->EOF) {
	$gantt_delete->RecordCount++;
	$gantt_delete->RowCount++;

	// Set row properties
	$gantt->resetAttributes();
	$gantt->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$gantt_delete->loadRowValues($gantt_delete->Recordset);

	// Render row
	$gantt_delete->renderRow();
?>
	<tr <?php echo $gantt->rowAttributes() ?>>
<?php if ($gantt_delete->id->Visible) { // id ?>
		<td <?php echo $gantt_delete->id->cellAttributes() ?>>
<span id="el<?php echo $gantt_delete->RowCount ?>_gantt_id" class="gantt_id">
<span<?php echo $gantt_delete->id->viewAttributes() ?>><?php echo $gantt_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gantt_delete->name->Visible) { // name ?>
		<td <?php echo $gantt_delete->name->cellAttributes() ?>>
<span id="el<?php echo $gantt_delete->RowCount ?>_gantt_name" class="gantt_name">
<span<?php echo $gantt_delete->name->viewAttributes() ?>><?php echo $gantt_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gantt_delete->start->Visible) { // start ?>
		<td <?php echo $gantt_delete->start->cellAttributes() ?>>
<span id="el<?php echo $gantt_delete->RowCount ?>_gantt_start" class="gantt_start">
<span<?php echo $gantt_delete->start->viewAttributes() ?>><?php echo $gantt_delete->start->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gantt_delete->end->Visible) { // end ?>
		<td <?php echo $gantt_delete->end->cellAttributes() ?>>
<span id="el<?php echo $gantt_delete->RowCount ?>_gantt_end" class="gantt_end">
<span<?php echo $gantt_delete->end->viewAttributes() ?>><?php echo $gantt_delete->end->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$gantt_delete->Recordset->moveNext();
}
$gantt_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gantt_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$gantt_delete->showPageFooter();
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
$gantt_delete->terminate();
?>