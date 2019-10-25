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
$orders_view = new orders_view();

// Run the page
$orders_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$orders_view->isExport()) { ?>
<script>
var fordersview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fordersview = currentForm = new ew.Form("fordersview", "view");
	loadjs.done("fordersview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$orders_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $orders_view->ExportOptions->render("body") ?>
<?php $orders_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $orders_view->showPageHeader(); ?>
<?php
$orders_view->showMessage();
?>
<form name="fordersview" id="fordersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders">
<input type="hidden" name="modal" value="<?php echo (int)$orders_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($orders_view->OrderID->Visible) { // OrderID ?>
	<tr id="r_OrderID">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_OrderID"><?php echo $orders_view->OrderID->caption() ?></span></td>
		<td data-name="OrderID" <?php echo $orders_view->OrderID->cellAttributes() ?>>
<span id="el_orders_OrderID">
<span<?php echo $orders_view->OrderID->viewAttributes() ?>><?php echo $orders_view->OrderID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders_view->CustomerID->Visible) { // CustomerID ?>
	<tr id="r_CustomerID">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_CustomerID"><?php echo $orders_view->CustomerID->caption() ?></span></td>
		<td data-name="CustomerID" <?php echo $orders_view->CustomerID->cellAttributes() ?>>
<span id="el_orders_CustomerID">
<span<?php echo $orders_view->CustomerID->viewAttributes() ?>><?php echo $orders_view->CustomerID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_EmployeeID"><?php echo $orders_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $orders_view->EmployeeID->cellAttributes() ?>>
<span id="el_orders_EmployeeID">
<span<?php echo $orders_view->EmployeeID->viewAttributes() ?>><?php echo $orders_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders_view->OrderDate->Visible) { // OrderDate ?>
	<tr id="r_OrderDate">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_OrderDate"><?php echo $orders_view->OrderDate->caption() ?></span></td>
		<td data-name="OrderDate" <?php echo $orders_view->OrderDate->cellAttributes() ?>>
<span id="el_orders_OrderDate">
<span<?php echo $orders_view->OrderDate->viewAttributes() ?>><?php echo $orders_view->OrderDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders_view->RequiredDate->Visible) { // RequiredDate ?>
	<tr id="r_RequiredDate">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_RequiredDate"><?php echo $orders_view->RequiredDate->caption() ?></span></td>
		<td data-name="RequiredDate" <?php echo $orders_view->RequiredDate->cellAttributes() ?>>
<span id="el_orders_RequiredDate">
<span<?php echo $orders_view->RequiredDate->viewAttributes() ?>><?php echo $orders_view->RequiredDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders_view->ShippedDate->Visible) { // ShippedDate ?>
	<tr id="r_ShippedDate">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_ShippedDate"><?php echo $orders_view->ShippedDate->caption() ?></span></td>
		<td data-name="ShippedDate" <?php echo $orders_view->ShippedDate->cellAttributes() ?>>
<span id="el_orders_ShippedDate">
<span<?php echo $orders_view->ShippedDate->viewAttributes() ?>><?php echo $orders_view->ShippedDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders_view->ShipVia->Visible) { // ShipVia ?>
	<tr id="r_ShipVia">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_ShipVia"><?php echo $orders_view->ShipVia->caption() ?></span></td>
		<td data-name="ShipVia" <?php echo $orders_view->ShipVia->cellAttributes() ?>>
<span id="el_orders_ShipVia">
<span<?php echo $orders_view->ShipVia->viewAttributes() ?>><?php echo $orders_view->ShipVia->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders_view->Freight->Visible) { // Freight ?>
	<tr id="r_Freight">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_Freight"><?php echo $orders_view->Freight->caption() ?></span></td>
		<td data-name="Freight" <?php echo $orders_view->Freight->cellAttributes() ?>>
<span id="el_orders_Freight">
<span<?php echo $orders_view->Freight->viewAttributes() ?>><?php echo $orders_view->Freight->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders_view->ShipName->Visible) { // ShipName ?>
	<tr id="r_ShipName">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_ShipName"><?php echo $orders_view->ShipName->caption() ?></span></td>
		<td data-name="ShipName" <?php echo $orders_view->ShipName->cellAttributes() ?>>
<span id="el_orders_ShipName">
<span<?php echo $orders_view->ShipName->viewAttributes() ?>><?php echo $orders_view->ShipName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders_view->ShipAddress->Visible) { // ShipAddress ?>
	<tr id="r_ShipAddress">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_ShipAddress"><?php echo $orders_view->ShipAddress->caption() ?></span></td>
		<td data-name="ShipAddress" <?php echo $orders_view->ShipAddress->cellAttributes() ?>>
<span id="el_orders_ShipAddress">
<span<?php echo $orders_view->ShipAddress->viewAttributes() ?>><?php echo $orders_view->ShipAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders_view->ShipCity->Visible) { // ShipCity ?>
	<tr id="r_ShipCity">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_ShipCity"><?php echo $orders_view->ShipCity->caption() ?></span></td>
		<td data-name="ShipCity" <?php echo $orders_view->ShipCity->cellAttributes() ?>>
<span id="el_orders_ShipCity">
<span<?php echo $orders_view->ShipCity->viewAttributes() ?>><?php echo $orders_view->ShipCity->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders_view->ShipRegion->Visible) { // ShipRegion ?>
	<tr id="r_ShipRegion">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_ShipRegion"><?php echo $orders_view->ShipRegion->caption() ?></span></td>
		<td data-name="ShipRegion" <?php echo $orders_view->ShipRegion->cellAttributes() ?>>
<span id="el_orders_ShipRegion">
<span<?php echo $orders_view->ShipRegion->viewAttributes() ?>><?php echo $orders_view->ShipRegion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders_view->ShipPostalCode->Visible) { // ShipPostalCode ?>
	<tr id="r_ShipPostalCode">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_ShipPostalCode"><?php echo $orders_view->ShipPostalCode->caption() ?></span></td>
		<td data-name="ShipPostalCode" <?php echo $orders_view->ShipPostalCode->cellAttributes() ?>>
<span id="el_orders_ShipPostalCode">
<span<?php echo $orders_view->ShipPostalCode->viewAttributes() ?>><?php echo $orders_view->ShipPostalCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders_view->ShipCountry->Visible) { // ShipCountry ?>
	<tr id="r_ShipCountry">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_ShipCountry"><?php echo $orders_view->ShipCountry->caption() ?></span></td>
		<td data-name="ShipCountry" <?php echo $orders_view->ShipCountry->cellAttributes() ?>>
<span id="el_orders_ShipCountry">
<span<?php echo $orders_view->ShipCountry->viewAttributes() ?>><?php echo $orders_view->ShipCountry->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$orders_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$orders_view->isExport()) { ?>
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
$orders_view->terminate();
?>