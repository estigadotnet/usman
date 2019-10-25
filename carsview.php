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
$cars_view = new cars_view();

// Run the page
$cars_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cars_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cars_view->isExport()) { ?>
<script>
var fcarsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcarsview = currentForm = new ew.Form("fcarsview", "view");
	loadjs.done("fcarsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cars_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $cars_view->ExportOptions->render("body") ?>
<?php $cars_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $cars_view->showPageHeader(); ?>
<?php
$cars_view->showMessage();
?>
<form name="fcarsview" id="fcarsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cars">
<input type="hidden" name="modal" value="<?php echo (int)$cars_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($cars_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_ID"><?php echo $cars_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $cars_view->ID->cellAttributes() ?>>
<span id="el_cars_ID">
<span<?php echo $cars_view->ID->viewAttributes() ?>><?php echo $cars_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars_view->Trademark->Visible) { // Trademark ?>
	<tr id="r_Trademark">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_Trademark"><?php echo $cars_view->Trademark->caption() ?></span></td>
		<td data-name="Trademark" <?php echo $cars_view->Trademark->cellAttributes() ?>>
<span id="el_cars_Trademark">
<span<?php echo $cars_view->Trademark->viewAttributes() ?>><?php echo $cars_view->Trademark->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars_view->Model->Visible) { // Model ?>
	<tr id="r_Model">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_Model"><?php echo $cars_view->Model->caption() ?></span></td>
		<td data-name="Model" <?php echo $cars_view->Model->cellAttributes() ?>>
<span id="el_cars_Model">
<span<?php echo $cars_view->Model->viewAttributes() ?>><?php echo $cars_view->Model->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars_view->HP->Visible) { // HP ?>
	<tr id="r_HP">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_HP"><?php echo $cars_view->HP->caption() ?></span></td>
		<td data-name="HP" <?php echo $cars_view->HP->cellAttributes() ?>>
<span id="el_cars_HP">
<span<?php echo $cars_view->HP->viewAttributes() ?>><?php echo $cars_view->HP->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars_view->Liter->Visible) { // Liter ?>
	<tr id="r_Liter">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_Liter"><?php echo $cars_view->Liter->caption() ?></span></td>
		<td data-name="Liter" <?php echo $cars_view->Liter->cellAttributes() ?>>
<span id="el_cars_Liter">
<span<?php echo $cars_view->Liter->viewAttributes() ?>><?php echo $cars_view->Liter->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars_view->Cyl->Visible) { // Cyl ?>
	<tr id="r_Cyl">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_Cyl"><?php echo $cars_view->Cyl->caption() ?></span></td>
		<td data-name="Cyl" <?php echo $cars_view->Cyl->cellAttributes() ?>>
<span id="el_cars_Cyl">
<span<?php echo $cars_view->Cyl->viewAttributes() ?>><?php echo $cars_view->Cyl->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars_view->TransmissSpeedCount->Visible) { // TransmissSpeedCount ?>
	<tr id="r_TransmissSpeedCount">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_TransmissSpeedCount"><?php echo $cars_view->TransmissSpeedCount->caption() ?></span></td>
		<td data-name="TransmissSpeedCount" <?php echo $cars_view->TransmissSpeedCount->cellAttributes() ?>>
<span id="el_cars_TransmissSpeedCount">
<span<?php echo $cars_view->TransmissSpeedCount->viewAttributes() ?>><?php echo $cars_view->TransmissSpeedCount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars_view->TransmissAutomatic->Visible) { // TransmissAutomatic ?>
	<tr id="r_TransmissAutomatic">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_TransmissAutomatic"><?php echo $cars_view->TransmissAutomatic->caption() ?></span></td>
		<td data-name="TransmissAutomatic" <?php echo $cars_view->TransmissAutomatic->cellAttributes() ?>>
<span id="el_cars_TransmissAutomatic">
<span<?php echo $cars_view->TransmissAutomatic->viewAttributes() ?>><?php echo $cars_view->TransmissAutomatic->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars_view->MPG_City->Visible) { // MPG_City ?>
	<tr id="r_MPG_City">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_MPG_City"><?php echo $cars_view->MPG_City->caption() ?></span></td>
		<td data-name="MPG_City" <?php echo $cars_view->MPG_City->cellAttributes() ?>>
<span id="el_cars_MPG_City">
<span<?php echo $cars_view->MPG_City->viewAttributes() ?>><?php echo $cars_view->MPG_City->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars_view->MPG_Highway->Visible) { // MPG_Highway ?>
	<tr id="r_MPG_Highway">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_MPG_Highway"><?php echo $cars_view->MPG_Highway->caption() ?></span></td>
		<td data-name="MPG_Highway" <?php echo $cars_view->MPG_Highway->cellAttributes() ?>>
<span id="el_cars_MPG_Highway">
<span<?php echo $cars_view->MPG_Highway->viewAttributes() ?>><?php echo $cars_view->MPG_Highway->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars_view->Category->Visible) { // Category ?>
	<tr id="r_Category">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_Category"><?php echo $cars_view->Category->caption() ?></span></td>
		<td data-name="Category" <?php echo $cars_view->Category->cellAttributes() ?>>
<span id="el_cars_Category">
<span<?php echo $cars_view->Category->viewAttributes() ?>><?php echo $cars_view->Category->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars_view->Description->Visible) { // Description ?>
	<tr id="r_Description">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_Description"><?php echo $cars_view->Description->caption() ?></span></td>
		<td data-name="Description" <?php echo $cars_view->Description->cellAttributes() ?>>
<span id="el_cars_Description">
<span<?php echo $cars_view->Description->viewAttributes() ?>><?php echo $cars_view->Description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars_view->Hyperlink->Visible) { // Hyperlink ?>
	<tr id="r_Hyperlink">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_Hyperlink"><?php echo $cars_view->Hyperlink->caption() ?></span></td>
		<td data-name="Hyperlink" <?php echo $cars_view->Hyperlink->cellAttributes() ?>>
<span id="el_cars_Hyperlink">
<span<?php echo $cars_view->Hyperlink->viewAttributes() ?>><?php echo $cars_view->Hyperlink->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars_view->Price->Visible) { // Price ?>
	<tr id="r_Price">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_Price"><?php echo $cars_view->Price->caption() ?></span></td>
		<td data-name="Price" <?php echo $cars_view->Price->cellAttributes() ?>>
<span id="el_cars_Price">
<span<?php echo $cars_view->Price->viewAttributes() ?>><?php echo $cars_view->Price->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars_view->Picture->Visible) { // Picture ?>
	<tr id="r_Picture">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_Picture"><?php echo $cars_view->Picture->caption() ?></span></td>
		<td data-name="Picture" <?php echo $cars_view->Picture->cellAttributes() ?>>
<span id="el_cars_Picture">
<span<?php echo $cars_view->Picture->viewAttributes() ?>><?php echo GetFileViewTag($cars_view->Picture, $cars_view->Picture->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars_view->PictureName->Visible) { // PictureName ?>
	<tr id="r_PictureName">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_PictureName"><?php echo $cars_view->PictureName->caption() ?></span></td>
		<td data-name="PictureName" <?php echo $cars_view->PictureName->cellAttributes() ?>>
<span id="el_cars_PictureName">
<span<?php echo $cars_view->PictureName->viewAttributes() ?>><?php echo $cars_view->PictureName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars_view->PictureSize->Visible) { // PictureSize ?>
	<tr id="r_PictureSize">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_PictureSize"><?php echo $cars_view->PictureSize->caption() ?></span></td>
		<td data-name="PictureSize" <?php echo $cars_view->PictureSize->cellAttributes() ?>>
<span id="el_cars_PictureSize">
<span<?php echo $cars_view->PictureSize->viewAttributes() ?>><?php echo $cars_view->PictureSize->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars_view->PictureType->Visible) { // PictureType ?>
	<tr id="r_PictureType">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_PictureType"><?php echo $cars_view->PictureType->caption() ?></span></td>
		<td data-name="PictureType" <?php echo $cars_view->PictureType->cellAttributes() ?>>
<span id="el_cars_PictureType">
<span<?php echo $cars_view->PictureType->viewAttributes() ?>><?php echo $cars_view->PictureType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars_view->PictureWidth->Visible) { // PictureWidth ?>
	<tr id="r_PictureWidth">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_PictureWidth"><?php echo $cars_view->PictureWidth->caption() ?></span></td>
		<td data-name="PictureWidth" <?php echo $cars_view->PictureWidth->cellAttributes() ?>>
<span id="el_cars_PictureWidth">
<span<?php echo $cars_view->PictureWidth->viewAttributes() ?>><?php echo $cars_view->PictureWidth->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars_view->PictureHeight->Visible) { // PictureHeight ?>
	<tr id="r_PictureHeight">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_PictureHeight"><?php echo $cars_view->PictureHeight->caption() ?></span></td>
		<td data-name="PictureHeight" <?php echo $cars_view->PictureHeight->cellAttributes() ?>>
<span id="el_cars_PictureHeight">
<span<?php echo $cars_view->PictureHeight->viewAttributes() ?>><?php echo $cars_view->PictureHeight->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cars_view->Color->Visible) { // Color ?>
	<tr id="r_Color">
		<td class="<?php echo $cars_view->TableLeftColumnClass ?>"><span id="elh_cars_Color"><?php echo $cars_view->Color->caption() ?></span></td>
		<td data-name="Color" <?php echo $cars_view->Color->cellAttributes() ?>>
<span id="el_cars_Color">
<span<?php echo $cars_view->Color->viewAttributes() ?>><?php echo $cars_view->Color->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$cars_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cars_view->isExport()) { ?>
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
$cars_view->terminate();
?>