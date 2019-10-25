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
$cars_delete = new cars_delete();

// Run the page
$cars_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cars_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcarsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcarsdelete = currentForm = new ew.Form("fcarsdelete", "delete");
	loadjs.done("fcarsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cars_delete->showPageHeader(); ?>
<?php
$cars_delete->showMessage();
?>
<form name="fcarsdelete" id="fcarsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cars">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($cars_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($cars_delete->ID->Visible) { // ID ?>
		<th class="<?php echo $cars_delete->ID->headerCellClass() ?>"><span id="elh_cars_ID" class="cars_ID"><?php echo $cars_delete->ID->caption() ?></span></th>
<?php } ?>
<?php if ($cars_delete->Trademark->Visible) { // Trademark ?>
		<th class="<?php echo $cars_delete->Trademark->headerCellClass() ?>"><span id="elh_cars_Trademark" class="cars_Trademark"><?php echo $cars_delete->Trademark->caption() ?></span></th>
<?php } ?>
<?php if ($cars_delete->Model->Visible) { // Model ?>
		<th class="<?php echo $cars_delete->Model->headerCellClass() ?>"><span id="elh_cars_Model" class="cars_Model"><?php echo $cars_delete->Model->caption() ?></span></th>
<?php } ?>
<?php if ($cars_delete->HP->Visible) { // HP ?>
		<th class="<?php echo $cars_delete->HP->headerCellClass() ?>"><span id="elh_cars_HP" class="cars_HP"><?php echo $cars_delete->HP->caption() ?></span></th>
<?php } ?>
<?php if ($cars_delete->Liter->Visible) { // Liter ?>
		<th class="<?php echo $cars_delete->Liter->headerCellClass() ?>"><span id="elh_cars_Liter" class="cars_Liter"><?php echo $cars_delete->Liter->caption() ?></span></th>
<?php } ?>
<?php if ($cars_delete->Cyl->Visible) { // Cyl ?>
		<th class="<?php echo $cars_delete->Cyl->headerCellClass() ?>"><span id="elh_cars_Cyl" class="cars_Cyl"><?php echo $cars_delete->Cyl->caption() ?></span></th>
<?php } ?>
<?php if ($cars_delete->TransmissSpeedCount->Visible) { // TransmissSpeedCount ?>
		<th class="<?php echo $cars_delete->TransmissSpeedCount->headerCellClass() ?>"><span id="elh_cars_TransmissSpeedCount" class="cars_TransmissSpeedCount"><?php echo $cars_delete->TransmissSpeedCount->caption() ?></span></th>
<?php } ?>
<?php if ($cars_delete->TransmissAutomatic->Visible) { // TransmissAutomatic ?>
		<th class="<?php echo $cars_delete->TransmissAutomatic->headerCellClass() ?>"><span id="elh_cars_TransmissAutomatic" class="cars_TransmissAutomatic"><?php echo $cars_delete->TransmissAutomatic->caption() ?></span></th>
<?php } ?>
<?php if ($cars_delete->MPG_City->Visible) { // MPG_City ?>
		<th class="<?php echo $cars_delete->MPG_City->headerCellClass() ?>"><span id="elh_cars_MPG_City" class="cars_MPG_City"><?php echo $cars_delete->MPG_City->caption() ?></span></th>
<?php } ?>
<?php if ($cars_delete->MPG_Highway->Visible) { // MPG_Highway ?>
		<th class="<?php echo $cars_delete->MPG_Highway->headerCellClass() ?>"><span id="elh_cars_MPG_Highway" class="cars_MPG_Highway"><?php echo $cars_delete->MPG_Highway->caption() ?></span></th>
<?php } ?>
<?php if ($cars_delete->Category->Visible) { // Category ?>
		<th class="<?php echo $cars_delete->Category->headerCellClass() ?>"><span id="elh_cars_Category" class="cars_Category"><?php echo $cars_delete->Category->caption() ?></span></th>
<?php } ?>
<?php if ($cars_delete->Hyperlink->Visible) { // Hyperlink ?>
		<th class="<?php echo $cars_delete->Hyperlink->headerCellClass() ?>"><span id="elh_cars_Hyperlink" class="cars_Hyperlink"><?php echo $cars_delete->Hyperlink->caption() ?></span></th>
<?php } ?>
<?php if ($cars_delete->Price->Visible) { // Price ?>
		<th class="<?php echo $cars_delete->Price->headerCellClass() ?>"><span id="elh_cars_Price" class="cars_Price"><?php echo $cars_delete->Price->caption() ?></span></th>
<?php } ?>
<?php if ($cars_delete->PictureName->Visible) { // PictureName ?>
		<th class="<?php echo $cars_delete->PictureName->headerCellClass() ?>"><span id="elh_cars_PictureName" class="cars_PictureName"><?php echo $cars_delete->PictureName->caption() ?></span></th>
<?php } ?>
<?php if ($cars_delete->PictureSize->Visible) { // PictureSize ?>
		<th class="<?php echo $cars_delete->PictureSize->headerCellClass() ?>"><span id="elh_cars_PictureSize" class="cars_PictureSize"><?php echo $cars_delete->PictureSize->caption() ?></span></th>
<?php } ?>
<?php if ($cars_delete->PictureType->Visible) { // PictureType ?>
		<th class="<?php echo $cars_delete->PictureType->headerCellClass() ?>"><span id="elh_cars_PictureType" class="cars_PictureType"><?php echo $cars_delete->PictureType->caption() ?></span></th>
<?php } ?>
<?php if ($cars_delete->PictureWidth->Visible) { // PictureWidth ?>
		<th class="<?php echo $cars_delete->PictureWidth->headerCellClass() ?>"><span id="elh_cars_PictureWidth" class="cars_PictureWidth"><?php echo $cars_delete->PictureWidth->caption() ?></span></th>
<?php } ?>
<?php if ($cars_delete->PictureHeight->Visible) { // PictureHeight ?>
		<th class="<?php echo $cars_delete->PictureHeight->headerCellClass() ?>"><span id="elh_cars_PictureHeight" class="cars_PictureHeight"><?php echo $cars_delete->PictureHeight->caption() ?></span></th>
<?php } ?>
<?php if ($cars_delete->Color->Visible) { // Color ?>
		<th class="<?php echo $cars_delete->Color->headerCellClass() ?>"><span id="elh_cars_Color" class="cars_Color"><?php echo $cars_delete->Color->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$cars_delete->RecordCount = 0;
$i = 0;
while (!$cars_delete->Recordset->EOF) {
	$cars_delete->RecordCount++;
	$cars_delete->RowCount++;

	// Set row properties
	$cars->resetAttributes();
	$cars->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$cars_delete->loadRowValues($cars_delete->Recordset);

	// Render row
	$cars_delete->renderRow();
?>
	<tr <?php echo $cars->rowAttributes() ?>>
<?php if ($cars_delete->ID->Visible) { // ID ?>
		<td <?php echo $cars_delete->ID->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCount ?>_cars_ID" class="cars_ID">
<span<?php echo $cars_delete->ID->viewAttributes() ?>><?php echo $cars_delete->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars_delete->Trademark->Visible) { // Trademark ?>
		<td <?php echo $cars_delete->Trademark->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCount ?>_cars_Trademark" class="cars_Trademark">
<span<?php echo $cars_delete->Trademark->viewAttributes() ?>><?php echo $cars_delete->Trademark->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars_delete->Model->Visible) { // Model ?>
		<td <?php echo $cars_delete->Model->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCount ?>_cars_Model" class="cars_Model">
<span<?php echo $cars_delete->Model->viewAttributes() ?>><?php echo $cars_delete->Model->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars_delete->HP->Visible) { // HP ?>
		<td <?php echo $cars_delete->HP->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCount ?>_cars_HP" class="cars_HP">
<span<?php echo $cars_delete->HP->viewAttributes() ?>><?php echo $cars_delete->HP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars_delete->Liter->Visible) { // Liter ?>
		<td <?php echo $cars_delete->Liter->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCount ?>_cars_Liter" class="cars_Liter">
<span<?php echo $cars_delete->Liter->viewAttributes() ?>><?php echo $cars_delete->Liter->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars_delete->Cyl->Visible) { // Cyl ?>
		<td <?php echo $cars_delete->Cyl->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCount ?>_cars_Cyl" class="cars_Cyl">
<span<?php echo $cars_delete->Cyl->viewAttributes() ?>><?php echo $cars_delete->Cyl->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars_delete->TransmissSpeedCount->Visible) { // TransmissSpeedCount ?>
		<td <?php echo $cars_delete->TransmissSpeedCount->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCount ?>_cars_TransmissSpeedCount" class="cars_TransmissSpeedCount">
<span<?php echo $cars_delete->TransmissSpeedCount->viewAttributes() ?>><?php echo $cars_delete->TransmissSpeedCount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars_delete->TransmissAutomatic->Visible) { // TransmissAutomatic ?>
		<td <?php echo $cars_delete->TransmissAutomatic->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCount ?>_cars_TransmissAutomatic" class="cars_TransmissAutomatic">
<span<?php echo $cars_delete->TransmissAutomatic->viewAttributes() ?>><?php echo $cars_delete->TransmissAutomatic->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars_delete->MPG_City->Visible) { // MPG_City ?>
		<td <?php echo $cars_delete->MPG_City->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCount ?>_cars_MPG_City" class="cars_MPG_City">
<span<?php echo $cars_delete->MPG_City->viewAttributes() ?>><?php echo $cars_delete->MPG_City->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars_delete->MPG_Highway->Visible) { // MPG_Highway ?>
		<td <?php echo $cars_delete->MPG_Highway->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCount ?>_cars_MPG_Highway" class="cars_MPG_Highway">
<span<?php echo $cars_delete->MPG_Highway->viewAttributes() ?>><?php echo $cars_delete->MPG_Highway->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars_delete->Category->Visible) { // Category ?>
		<td <?php echo $cars_delete->Category->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCount ?>_cars_Category" class="cars_Category">
<span<?php echo $cars_delete->Category->viewAttributes() ?>><?php echo $cars_delete->Category->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars_delete->Hyperlink->Visible) { // Hyperlink ?>
		<td <?php echo $cars_delete->Hyperlink->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCount ?>_cars_Hyperlink" class="cars_Hyperlink">
<span<?php echo $cars_delete->Hyperlink->viewAttributes() ?>><?php echo $cars_delete->Hyperlink->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars_delete->Price->Visible) { // Price ?>
		<td <?php echo $cars_delete->Price->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCount ?>_cars_Price" class="cars_Price">
<span<?php echo $cars_delete->Price->viewAttributes() ?>><?php echo $cars_delete->Price->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars_delete->PictureName->Visible) { // PictureName ?>
		<td <?php echo $cars_delete->PictureName->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCount ?>_cars_PictureName" class="cars_PictureName">
<span<?php echo $cars_delete->PictureName->viewAttributes() ?>><?php echo $cars_delete->PictureName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars_delete->PictureSize->Visible) { // PictureSize ?>
		<td <?php echo $cars_delete->PictureSize->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCount ?>_cars_PictureSize" class="cars_PictureSize">
<span<?php echo $cars_delete->PictureSize->viewAttributes() ?>><?php echo $cars_delete->PictureSize->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars_delete->PictureType->Visible) { // PictureType ?>
		<td <?php echo $cars_delete->PictureType->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCount ?>_cars_PictureType" class="cars_PictureType">
<span<?php echo $cars_delete->PictureType->viewAttributes() ?>><?php echo $cars_delete->PictureType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars_delete->PictureWidth->Visible) { // PictureWidth ?>
		<td <?php echo $cars_delete->PictureWidth->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCount ?>_cars_PictureWidth" class="cars_PictureWidth">
<span<?php echo $cars_delete->PictureWidth->viewAttributes() ?>><?php echo $cars_delete->PictureWidth->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars_delete->PictureHeight->Visible) { // PictureHeight ?>
		<td <?php echo $cars_delete->PictureHeight->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCount ?>_cars_PictureHeight" class="cars_PictureHeight">
<span<?php echo $cars_delete->PictureHeight->viewAttributes() ?>><?php echo $cars_delete->PictureHeight->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cars_delete->Color->Visible) { // Color ?>
		<td <?php echo $cars_delete->Color->cellAttributes() ?>>
<span id="el<?php echo $cars_delete->RowCount ?>_cars_Color" class="cars_Color">
<span<?php echo $cars_delete->Color->viewAttributes() ?>><?php echo $cars_delete->Color->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$cars_delete->Recordset->moveNext();
}
$cars_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cars_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$cars_delete->showPageFooter();
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
$cars_delete->terminate();
?>