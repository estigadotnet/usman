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
$models_delete = new models_delete();

// Run the page
$models_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$models_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmodelsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fmodelsdelete = currentForm = new ew.Form("fmodelsdelete", "delete");
	loadjs.done("fmodelsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $models_delete->showPageHeader(); ?>
<?php
$models_delete->showMessage();
?>
<form name="fmodelsdelete" id="fmodelsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="models">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($models_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($models_delete->ID->Visible) { // ID ?>
		<th class="<?php echo $models_delete->ID->headerCellClass() ?>"><span id="elh_models_ID" class="models_ID"><?php echo $models_delete->ID->caption() ?></span></th>
<?php } ?>
<?php if ($models_delete->Trademark->Visible) { // Trademark ?>
		<th class="<?php echo $models_delete->Trademark->headerCellClass() ?>"><span id="elh_models_Trademark" class="models_Trademark"><?php echo $models_delete->Trademark->caption() ?></span></th>
<?php } ?>
<?php if ($models_delete->Model->Visible) { // Model ?>
		<th class="<?php echo $models_delete->Model->headerCellClass() ?>"><span id="elh_models_Model" class="models_Model"><?php echo $models_delete->Model->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$models_delete->RecordCount = 0;
$i = 0;
while (!$models_delete->Recordset->EOF) {
	$models_delete->RecordCount++;
	$models_delete->RowCount++;

	// Set row properties
	$models->resetAttributes();
	$models->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$models_delete->loadRowValues($models_delete->Recordset);

	// Render row
	$models_delete->renderRow();
?>
	<tr <?php echo $models->rowAttributes() ?>>
<?php if ($models_delete->ID->Visible) { // ID ?>
		<td <?php echo $models_delete->ID->cellAttributes() ?>>
<span id="el<?php echo $models_delete->RowCount ?>_models_ID" class="models_ID">
<span<?php echo $models_delete->ID->viewAttributes() ?>><?php echo $models_delete->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($models_delete->Trademark->Visible) { // Trademark ?>
		<td <?php echo $models_delete->Trademark->cellAttributes() ?>>
<span id="el<?php echo $models_delete->RowCount ?>_models_Trademark" class="models_Trademark">
<span<?php echo $models_delete->Trademark->viewAttributes() ?>><?php echo $models_delete->Trademark->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($models_delete->Model->Visible) { // Model ?>
		<td <?php echo $models_delete->Model->cellAttributes() ?>>
<span id="el<?php echo $models_delete->RowCount ?>_models_Model" class="models_Model">
<span<?php echo $models_delete->Model->viewAttributes() ?>><?php echo $models_delete->Model->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$models_delete->Recordset->moveNext();
}
$models_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $models_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$models_delete->showPageFooter();
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
$models_delete->terminate();
?>