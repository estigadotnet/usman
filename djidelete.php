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
$dji_delete = new dji_delete();

// Run the page
$dji_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dji_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdjidelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdjidelete = currentForm = new ew.Form("fdjidelete", "delete");
	loadjs.done("fdjidelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $dji_delete->showPageHeader(); ?>
<?php
$dji_delete->showMessage();
?>
<form name="fdjidelete" id="fdjidelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dji">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($dji_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($dji_delete->ID->Visible) { // ID ?>
		<th class="<?php echo $dji_delete->ID->headerCellClass() ?>"><span id="elh_dji_ID" class="dji_ID"><?php echo $dji_delete->ID->caption() ?></span></th>
<?php } ?>
<?php if ($dji_delete->Date->Visible) { // Date ?>
		<th class="<?php echo $dji_delete->Date->headerCellClass() ?>"><span id="elh_dji_Date" class="dji_Date"><?php echo $dji_delete->Date->caption() ?></span></th>
<?php } ?>
<?php if ($dji_delete->Open->Visible) { // Open ?>
		<th class="<?php echo $dji_delete->Open->headerCellClass() ?>"><span id="elh_dji_Open" class="dji_Open"><?php echo $dji_delete->Open->caption() ?></span></th>
<?php } ?>
<?php if ($dji_delete->High->Visible) { // High ?>
		<th class="<?php echo $dji_delete->High->headerCellClass() ?>"><span id="elh_dji_High" class="dji_High"><?php echo $dji_delete->High->caption() ?></span></th>
<?php } ?>
<?php if ($dji_delete->Low->Visible) { // Low ?>
		<th class="<?php echo $dji_delete->Low->headerCellClass() ?>"><span id="elh_dji_Low" class="dji_Low"><?php echo $dji_delete->Low->caption() ?></span></th>
<?php } ?>
<?php if ($dji_delete->Close->Visible) { // Close ?>
		<th class="<?php echo $dji_delete->Close->headerCellClass() ?>"><span id="elh_dji_Close" class="dji_Close"><?php echo $dji_delete->Close->caption() ?></span></th>
<?php } ?>
<?php if ($dji_delete->Volume->Visible) { // Volume ?>
		<th class="<?php echo $dji_delete->Volume->headerCellClass() ?>"><span id="elh_dji_Volume" class="dji_Volume"><?php echo $dji_delete->Volume->caption() ?></span></th>
<?php } ?>
<?php if ($dji_delete->Adj_Close->Visible) { // Adj Close ?>
		<th class="<?php echo $dji_delete->Adj_Close->headerCellClass() ?>"><span id="elh_dji_Adj_Close" class="dji_Adj_Close"><?php echo $dji_delete->Adj_Close->caption() ?></span></th>
<?php } ?>
<?php if ($dji_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $dji_delete->Name->headerCellClass() ?>"><span id="elh_dji_Name" class="dji_Name"><?php echo $dji_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($dji_delete->Name2->Visible) { // Name2 ?>
		<th class="<?php echo $dji_delete->Name2->headerCellClass() ?>"><span id="elh_dji_Name2" class="dji_Name2"><?php echo $dji_delete->Name2->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$dji_delete->RecordCount = 0;
$i = 0;
while (!$dji_delete->Recordset->EOF) {
	$dji_delete->RecordCount++;
	$dji_delete->RowCount++;

	// Set row properties
	$dji->resetAttributes();
	$dji->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$dji_delete->loadRowValues($dji_delete->Recordset);

	// Render row
	$dji_delete->renderRow();
?>
	<tr <?php echo $dji->rowAttributes() ?>>
<?php if ($dji_delete->ID->Visible) { // ID ?>
		<td <?php echo $dji_delete->ID->cellAttributes() ?>>
<span id="el<?php echo $dji_delete->RowCount ?>_dji_ID" class="dji_ID">
<span<?php echo $dji_delete->ID->viewAttributes() ?>><?php echo $dji_delete->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dji_delete->Date->Visible) { // Date ?>
		<td <?php echo $dji_delete->Date->cellAttributes() ?>>
<span id="el<?php echo $dji_delete->RowCount ?>_dji_Date" class="dji_Date">
<span<?php echo $dji_delete->Date->viewAttributes() ?>><?php echo $dji_delete->Date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dji_delete->Open->Visible) { // Open ?>
		<td <?php echo $dji_delete->Open->cellAttributes() ?>>
<span id="el<?php echo $dji_delete->RowCount ?>_dji_Open" class="dji_Open">
<span<?php echo $dji_delete->Open->viewAttributes() ?>><?php echo $dji_delete->Open->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dji_delete->High->Visible) { // High ?>
		<td <?php echo $dji_delete->High->cellAttributes() ?>>
<span id="el<?php echo $dji_delete->RowCount ?>_dji_High" class="dji_High">
<span<?php echo $dji_delete->High->viewAttributes() ?>><?php echo $dji_delete->High->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dji_delete->Low->Visible) { // Low ?>
		<td <?php echo $dji_delete->Low->cellAttributes() ?>>
<span id="el<?php echo $dji_delete->RowCount ?>_dji_Low" class="dji_Low">
<span<?php echo $dji_delete->Low->viewAttributes() ?>><?php echo $dji_delete->Low->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dji_delete->Close->Visible) { // Close ?>
		<td <?php echo $dji_delete->Close->cellAttributes() ?>>
<span id="el<?php echo $dji_delete->RowCount ?>_dji_Close" class="dji_Close">
<span<?php echo $dji_delete->Close->viewAttributes() ?>><?php echo $dji_delete->Close->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dji_delete->Volume->Visible) { // Volume ?>
		<td <?php echo $dji_delete->Volume->cellAttributes() ?>>
<span id="el<?php echo $dji_delete->RowCount ?>_dji_Volume" class="dji_Volume">
<span<?php echo $dji_delete->Volume->viewAttributes() ?>><?php echo $dji_delete->Volume->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dji_delete->Adj_Close->Visible) { // Adj Close ?>
		<td <?php echo $dji_delete->Adj_Close->cellAttributes() ?>>
<span id="el<?php echo $dji_delete->RowCount ?>_dji_Adj_Close" class="dji_Adj_Close">
<span<?php echo $dji_delete->Adj_Close->viewAttributes() ?>><?php echo $dji_delete->Adj_Close->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dji_delete->Name->Visible) { // Name ?>
		<td <?php echo $dji_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $dji_delete->RowCount ?>_dji_Name" class="dji_Name">
<span<?php echo $dji_delete->Name->viewAttributes() ?>><?php echo $dji_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dji_delete->Name2->Visible) { // Name2 ?>
		<td <?php echo $dji_delete->Name2->cellAttributes() ?>>
<span id="el<?php echo $dji_delete->RowCount ?>_dji_Name2" class="dji_Name2">
<span<?php echo $dji_delete->Name2->viewAttributes() ?>><?php echo $dji_delete->Name2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$dji_delete->Recordset->moveNext();
}
$dji_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $dji_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$dji_delete->showPageFooter();
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
$dji_delete->terminate();
?>