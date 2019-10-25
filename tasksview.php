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
$tasks_view = new tasks_view();

// Run the page
$tasks_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tasks_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tasks_view->isExport()) { ?>
<script>
var ftasksview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftasksview = currentForm = new ew.Form("ftasksview", "view");
	loadjs.done("ftasksview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tasks_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tasks_view->ExportOptions->render("body") ?>
<?php $tasks_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tasks_view->showPageHeader(); ?>
<?php
$tasks_view->showMessage();
?>
<form name="ftasksview" id="ftasksview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tasks">
<input type="hidden" name="modal" value="<?php echo (int)$tasks_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tasks_view->TaskID->Visible) { // TaskID ?>
	<tr id="r_TaskID">
		<td class="<?php echo $tasks_view->TableLeftColumnClass ?>"><span id="elh_tasks_TaskID"><?php echo $tasks_view->TaskID->caption() ?></span></td>
		<td data-name="TaskID" <?php echo $tasks_view->TaskID->cellAttributes() ?>>
<span id="el_tasks_TaskID">
<span<?php echo $tasks_view->TaskID->viewAttributes() ?>><?php echo $tasks_view->TaskID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tasks_view->TaskName->Visible) { // TaskName ?>
	<tr id="r_TaskName">
		<td class="<?php echo $tasks_view->TableLeftColumnClass ?>"><span id="elh_tasks_TaskName"><?php echo $tasks_view->TaskName->caption() ?></span></td>
		<td data-name="TaskName" <?php echo $tasks_view->TaskName->cellAttributes() ?>>
<span id="el_tasks_TaskName">
<span<?php echo $tasks_view->TaskName->viewAttributes() ?>><?php echo $tasks_view->TaskName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tasks_view->ResourceID->Visible) { // ResourceID ?>
	<tr id="r_ResourceID">
		<td class="<?php echo $tasks_view->TableLeftColumnClass ?>"><span id="elh_tasks_ResourceID"><?php echo $tasks_view->ResourceID->caption() ?></span></td>
		<td data-name="ResourceID" <?php echo $tasks_view->ResourceID->cellAttributes() ?>>
<span id="el_tasks_ResourceID">
<span<?php echo $tasks_view->ResourceID->viewAttributes() ?>><?php echo $tasks_view->ResourceID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tasks_view->Start->Visible) { // Start ?>
	<tr id="r_Start">
		<td class="<?php echo $tasks_view->TableLeftColumnClass ?>"><span id="elh_tasks_Start"><?php echo $tasks_view->Start->caption() ?></span></td>
		<td data-name="Start" <?php echo $tasks_view->Start->cellAttributes() ?>>
<span id="el_tasks_Start">
<span<?php echo $tasks_view->Start->viewAttributes() ?>><?php echo $tasks_view->Start->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tasks_view->End->Visible) { // End ?>
	<tr id="r_End">
		<td class="<?php echo $tasks_view->TableLeftColumnClass ?>"><span id="elh_tasks_End"><?php echo $tasks_view->End->caption() ?></span></td>
		<td data-name="End" <?php echo $tasks_view->End->cellAttributes() ?>>
<span id="el_tasks_End">
<span<?php echo $tasks_view->End->viewAttributes() ?>><?php echo $tasks_view->End->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tasks_view->Description->Visible) { // Description ?>
	<tr id="r_Description">
		<td class="<?php echo $tasks_view->TableLeftColumnClass ?>"><span id="elh_tasks_Description"><?php echo $tasks_view->Description->caption() ?></span></td>
		<td data-name="Description" <?php echo $tasks_view->Description->cellAttributes() ?>>
<span id="el_tasks_Description">
<span<?php echo $tasks_view->Description->viewAttributes() ?>><?php echo $tasks_view->Description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tasks_view->Milestone->Visible) { // Milestone ?>
	<tr id="r_Milestone">
		<td class="<?php echo $tasks_view->TableLeftColumnClass ?>"><span id="elh_tasks_Milestone"><?php echo $tasks_view->Milestone->caption() ?></span></td>
		<td data-name="Milestone" <?php echo $tasks_view->Milestone->cellAttributes() ?>>
<span id="el_tasks_Milestone">
<span<?php echo $tasks_view->Milestone->viewAttributes() ?>><?php echo $tasks_view->Milestone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tasks_view->Duration->Visible) { // Duration ?>
	<tr id="r_Duration">
		<td class="<?php echo $tasks_view->TableLeftColumnClass ?>"><span id="elh_tasks_Duration"><?php echo $tasks_view->Duration->caption() ?></span></td>
		<td data-name="Duration" <?php echo $tasks_view->Duration->cellAttributes() ?>>
<span id="el_tasks_Duration">
<span<?php echo $tasks_view->Duration->viewAttributes() ?>><?php echo $tasks_view->Duration->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tasks_view->PercentComplete->Visible) { // PercentComplete ?>
	<tr id="r_PercentComplete">
		<td class="<?php echo $tasks_view->TableLeftColumnClass ?>"><span id="elh_tasks_PercentComplete"><?php echo $tasks_view->PercentComplete->caption() ?></span></td>
		<td data-name="PercentComplete" <?php echo $tasks_view->PercentComplete->cellAttributes() ?>>
<span id="el_tasks_PercentComplete">
<span<?php echo $tasks_view->PercentComplete->viewAttributes() ?>><?php echo $tasks_view->PercentComplete->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tasks_view->Dependencies->Visible) { // Dependencies ?>
	<tr id="r_Dependencies">
		<td class="<?php echo $tasks_view->TableLeftColumnClass ?>"><span id="elh_tasks_Dependencies"><?php echo $tasks_view->Dependencies->caption() ?></span></td>
		<td data-name="Dependencies" <?php echo $tasks_view->Dependencies->cellAttributes() ?>>
<span id="el_tasks_Dependencies">
<span<?php echo $tasks_view->Dependencies->viewAttributes() ?>><?php echo $tasks_view->Dependencies->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tasks_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tasks_view->isExport()) { ?>
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
$tasks_view->terminate();
?>