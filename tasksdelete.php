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
$tasks_delete = new tasks_delete();

// Run the page
$tasks_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tasks_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftasksdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftasksdelete = currentForm = new ew.Form("ftasksdelete", "delete");
	loadjs.done("ftasksdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tasks_delete->showPageHeader(); ?>
<?php
$tasks_delete->showMessage();
?>
<form name="ftasksdelete" id="ftasksdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tasks">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tasks_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tasks_delete->TaskID->Visible) { // TaskID ?>
		<th class="<?php echo $tasks_delete->TaskID->headerCellClass() ?>"><span id="elh_tasks_TaskID" class="tasks_TaskID"><?php echo $tasks_delete->TaskID->caption() ?></span></th>
<?php } ?>
<?php if ($tasks_delete->TaskName->Visible) { // TaskName ?>
		<th class="<?php echo $tasks_delete->TaskName->headerCellClass() ?>"><span id="elh_tasks_TaskName" class="tasks_TaskName"><?php echo $tasks_delete->TaskName->caption() ?></span></th>
<?php } ?>
<?php if ($tasks_delete->ResourceID->Visible) { // ResourceID ?>
		<th class="<?php echo $tasks_delete->ResourceID->headerCellClass() ?>"><span id="elh_tasks_ResourceID" class="tasks_ResourceID"><?php echo $tasks_delete->ResourceID->caption() ?></span></th>
<?php } ?>
<?php if ($tasks_delete->Start->Visible) { // Start ?>
		<th class="<?php echo $tasks_delete->Start->headerCellClass() ?>"><span id="elh_tasks_Start" class="tasks_Start"><?php echo $tasks_delete->Start->caption() ?></span></th>
<?php } ?>
<?php if ($tasks_delete->End->Visible) { // End ?>
		<th class="<?php echo $tasks_delete->End->headerCellClass() ?>"><span id="elh_tasks_End" class="tasks_End"><?php echo $tasks_delete->End->caption() ?></span></th>
<?php } ?>
<?php if ($tasks_delete->Description->Visible) { // Description ?>
		<th class="<?php echo $tasks_delete->Description->headerCellClass() ?>"><span id="elh_tasks_Description" class="tasks_Description"><?php echo $tasks_delete->Description->caption() ?></span></th>
<?php } ?>
<?php if ($tasks_delete->Milestone->Visible) { // Milestone ?>
		<th class="<?php echo $tasks_delete->Milestone->headerCellClass() ?>"><span id="elh_tasks_Milestone" class="tasks_Milestone"><?php echo $tasks_delete->Milestone->caption() ?></span></th>
<?php } ?>
<?php if ($tasks_delete->Duration->Visible) { // Duration ?>
		<th class="<?php echo $tasks_delete->Duration->headerCellClass() ?>"><span id="elh_tasks_Duration" class="tasks_Duration"><?php echo $tasks_delete->Duration->caption() ?></span></th>
<?php } ?>
<?php if ($tasks_delete->PercentComplete->Visible) { // PercentComplete ?>
		<th class="<?php echo $tasks_delete->PercentComplete->headerCellClass() ?>"><span id="elh_tasks_PercentComplete" class="tasks_PercentComplete"><?php echo $tasks_delete->PercentComplete->caption() ?></span></th>
<?php } ?>
<?php if ($tasks_delete->Dependencies->Visible) { // Dependencies ?>
		<th class="<?php echo $tasks_delete->Dependencies->headerCellClass() ?>"><span id="elh_tasks_Dependencies" class="tasks_Dependencies"><?php echo $tasks_delete->Dependencies->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tasks_delete->RecordCount = 0;
$i = 0;
while (!$tasks_delete->Recordset->EOF) {
	$tasks_delete->RecordCount++;
	$tasks_delete->RowCount++;

	// Set row properties
	$tasks->resetAttributes();
	$tasks->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tasks_delete->loadRowValues($tasks_delete->Recordset);

	// Render row
	$tasks_delete->renderRow();
?>
	<tr <?php echo $tasks->rowAttributes() ?>>
<?php if ($tasks_delete->TaskID->Visible) { // TaskID ?>
		<td <?php echo $tasks_delete->TaskID->cellAttributes() ?>>
<span id="el<?php echo $tasks_delete->RowCount ?>_tasks_TaskID" class="tasks_TaskID">
<span<?php echo $tasks_delete->TaskID->viewAttributes() ?>><?php echo $tasks_delete->TaskID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tasks_delete->TaskName->Visible) { // TaskName ?>
		<td <?php echo $tasks_delete->TaskName->cellAttributes() ?>>
<span id="el<?php echo $tasks_delete->RowCount ?>_tasks_TaskName" class="tasks_TaskName">
<span<?php echo $tasks_delete->TaskName->viewAttributes() ?>><?php echo $tasks_delete->TaskName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tasks_delete->ResourceID->Visible) { // ResourceID ?>
		<td <?php echo $tasks_delete->ResourceID->cellAttributes() ?>>
<span id="el<?php echo $tasks_delete->RowCount ?>_tasks_ResourceID" class="tasks_ResourceID">
<span<?php echo $tasks_delete->ResourceID->viewAttributes() ?>><?php echo $tasks_delete->ResourceID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tasks_delete->Start->Visible) { // Start ?>
		<td <?php echo $tasks_delete->Start->cellAttributes() ?>>
<span id="el<?php echo $tasks_delete->RowCount ?>_tasks_Start" class="tasks_Start">
<span<?php echo $tasks_delete->Start->viewAttributes() ?>><?php echo $tasks_delete->Start->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tasks_delete->End->Visible) { // End ?>
		<td <?php echo $tasks_delete->End->cellAttributes() ?>>
<span id="el<?php echo $tasks_delete->RowCount ?>_tasks_End" class="tasks_End">
<span<?php echo $tasks_delete->End->viewAttributes() ?>><?php echo $tasks_delete->End->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tasks_delete->Description->Visible) { // Description ?>
		<td <?php echo $tasks_delete->Description->cellAttributes() ?>>
<span id="el<?php echo $tasks_delete->RowCount ?>_tasks_Description" class="tasks_Description">
<span<?php echo $tasks_delete->Description->viewAttributes() ?>><?php echo $tasks_delete->Description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tasks_delete->Milestone->Visible) { // Milestone ?>
		<td <?php echo $tasks_delete->Milestone->cellAttributes() ?>>
<span id="el<?php echo $tasks_delete->RowCount ?>_tasks_Milestone" class="tasks_Milestone">
<span<?php echo $tasks_delete->Milestone->viewAttributes() ?>><?php echo $tasks_delete->Milestone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tasks_delete->Duration->Visible) { // Duration ?>
		<td <?php echo $tasks_delete->Duration->cellAttributes() ?>>
<span id="el<?php echo $tasks_delete->RowCount ?>_tasks_Duration" class="tasks_Duration">
<span<?php echo $tasks_delete->Duration->viewAttributes() ?>><?php echo $tasks_delete->Duration->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tasks_delete->PercentComplete->Visible) { // PercentComplete ?>
		<td <?php echo $tasks_delete->PercentComplete->cellAttributes() ?>>
<span id="el<?php echo $tasks_delete->RowCount ?>_tasks_PercentComplete" class="tasks_PercentComplete">
<span<?php echo $tasks_delete->PercentComplete->viewAttributes() ?>><?php echo $tasks_delete->PercentComplete->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tasks_delete->Dependencies->Visible) { // Dependencies ?>
		<td <?php echo $tasks_delete->Dependencies->cellAttributes() ?>>
<span id="el<?php echo $tasks_delete->RowCount ?>_tasks_Dependencies" class="tasks_Dependencies">
<span<?php echo $tasks_delete->Dependencies->viewAttributes() ?>><?php echo $tasks_delete->Dependencies->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tasks_delete->Recordset->moveNext();
}
$tasks_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tasks_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tasks_delete->showPageFooter();
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
$tasks_delete->terminate();
?>