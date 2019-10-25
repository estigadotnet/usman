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
$orders_delete = new orders_delete();

// Run the page
$orders_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fordersdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fordersdelete = currentForm = new ew.Form("fordersdelete", "delete");
	loadjs.done("fordersdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $orders_delete->showPageHeader(); ?>
<?php
$orders_delete->showMessage();
?>
<form name="fordersdelete" id="fordersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($orders_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($orders_delete->OrderID->Visible) { // OrderID ?>
		<th class="<?php echo $orders_delete->OrderID->headerCellClass() ?>"><span id="elh_orders_OrderID" class="orders_OrderID"><?php echo $orders_delete->OrderID->caption() ?></span></th>
<?php } ?>
<?php if ($orders_delete->CustomerID->Visible) { // CustomerID ?>
		<th class="<?php echo $orders_delete->CustomerID->headerCellClass() ?>"><span id="elh_orders_CustomerID" class="orders_CustomerID"><?php echo $orders_delete->CustomerID->caption() ?></span></th>
<?php } ?>
<?php if ($orders_delete->EmployeeID->Visible) { // EmployeeID ?>
		<th class="<?php echo $orders_delete->EmployeeID->headerCellClass() ?>"><span id="elh_orders_EmployeeID" class="orders_EmployeeID"><?php echo $orders_delete->EmployeeID->caption() ?></span></th>
<?php } ?>
<?php if ($orders_delete->OrderDate->Visible) { // OrderDate ?>
		<th class="<?php echo $orders_delete->OrderDate->headerCellClass() ?>"><span id="elh_orders_OrderDate" class="orders_OrderDate"><?php echo $orders_delete->OrderDate->caption() ?></span></th>
<?php } ?>
<?php if ($orders_delete->RequiredDate->Visible) { // RequiredDate ?>
		<th class="<?php echo $orders_delete->RequiredDate->headerCellClass() ?>"><span id="elh_orders_RequiredDate" class="orders_RequiredDate"><?php echo $orders_delete->RequiredDate->caption() ?></span></th>
<?php } ?>
<?php if ($orders_delete->ShippedDate->Visible) { // ShippedDate ?>
		<th class="<?php echo $orders_delete->ShippedDate->headerCellClass() ?>"><span id="elh_orders_ShippedDate" class="orders_ShippedDate"><?php echo $orders_delete->ShippedDate->caption() ?></span></th>
<?php } ?>
<?php if ($orders_delete->ShipVia->Visible) { // ShipVia ?>
		<th class="<?php echo $orders_delete->ShipVia->headerCellClass() ?>"><span id="elh_orders_ShipVia" class="orders_ShipVia"><?php echo $orders_delete->ShipVia->caption() ?></span></th>
<?php } ?>
<?php if ($orders_delete->Freight->Visible) { // Freight ?>
		<th class="<?php echo $orders_delete->Freight->headerCellClass() ?>"><span id="elh_orders_Freight" class="orders_Freight"><?php echo $orders_delete->Freight->caption() ?></span></th>
<?php } ?>
<?php if ($orders_delete->ShipName->Visible) { // ShipName ?>
		<th class="<?php echo $orders_delete->ShipName->headerCellClass() ?>"><span id="elh_orders_ShipName" class="orders_ShipName"><?php echo $orders_delete->ShipName->caption() ?></span></th>
<?php } ?>
<?php if ($orders_delete->ShipAddress->Visible) { // ShipAddress ?>
		<th class="<?php echo $orders_delete->ShipAddress->headerCellClass() ?>"><span id="elh_orders_ShipAddress" class="orders_ShipAddress"><?php echo $orders_delete->ShipAddress->caption() ?></span></th>
<?php } ?>
<?php if ($orders_delete->ShipCity->Visible) { // ShipCity ?>
		<th class="<?php echo $orders_delete->ShipCity->headerCellClass() ?>"><span id="elh_orders_ShipCity" class="orders_ShipCity"><?php echo $orders_delete->ShipCity->caption() ?></span></th>
<?php } ?>
<?php if ($orders_delete->ShipRegion->Visible) { // ShipRegion ?>
		<th class="<?php echo $orders_delete->ShipRegion->headerCellClass() ?>"><span id="elh_orders_ShipRegion" class="orders_ShipRegion"><?php echo $orders_delete->ShipRegion->caption() ?></span></th>
<?php } ?>
<?php if ($orders_delete->ShipPostalCode->Visible) { // ShipPostalCode ?>
		<th class="<?php echo $orders_delete->ShipPostalCode->headerCellClass() ?>"><span id="elh_orders_ShipPostalCode" class="orders_ShipPostalCode"><?php echo $orders_delete->ShipPostalCode->caption() ?></span></th>
<?php } ?>
<?php if ($orders_delete->ShipCountry->Visible) { // ShipCountry ?>
		<th class="<?php echo $orders_delete->ShipCountry->headerCellClass() ?>"><span id="elh_orders_ShipCountry" class="orders_ShipCountry"><?php echo $orders_delete->ShipCountry->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$orders_delete->RecordCount = 0;
$i = 0;
while (!$orders_delete->Recordset->EOF) {
	$orders_delete->RecordCount++;
	$orders_delete->RowCount++;

	// Set row properties
	$orders->resetAttributes();
	$orders->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$orders_delete->loadRowValues($orders_delete->Recordset);

	// Render row
	$orders_delete->renderRow();
?>
	<tr <?php echo $orders->rowAttributes() ?>>
<?php if ($orders_delete->OrderID->Visible) { // OrderID ?>
		<td <?php echo $orders_delete->OrderID->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCount ?>_orders_OrderID" class="orders_OrderID">
<span<?php echo $orders_delete->OrderID->viewAttributes() ?>><?php echo $orders_delete->OrderID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders_delete->CustomerID->Visible) { // CustomerID ?>
		<td <?php echo $orders_delete->CustomerID->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCount ?>_orders_CustomerID" class="orders_CustomerID">
<span<?php echo $orders_delete->CustomerID->viewAttributes() ?>><?php echo $orders_delete->CustomerID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders_delete->EmployeeID->Visible) { // EmployeeID ?>
		<td <?php echo $orders_delete->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCount ?>_orders_EmployeeID" class="orders_EmployeeID">
<span<?php echo $orders_delete->EmployeeID->viewAttributes() ?>><?php echo $orders_delete->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders_delete->OrderDate->Visible) { // OrderDate ?>
		<td <?php echo $orders_delete->OrderDate->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCount ?>_orders_OrderDate" class="orders_OrderDate">
<span<?php echo $orders_delete->OrderDate->viewAttributes() ?>><?php echo $orders_delete->OrderDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders_delete->RequiredDate->Visible) { // RequiredDate ?>
		<td <?php echo $orders_delete->RequiredDate->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCount ?>_orders_RequiredDate" class="orders_RequiredDate">
<span<?php echo $orders_delete->RequiredDate->viewAttributes() ?>><?php echo $orders_delete->RequiredDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders_delete->ShippedDate->Visible) { // ShippedDate ?>
		<td <?php echo $orders_delete->ShippedDate->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCount ?>_orders_ShippedDate" class="orders_ShippedDate">
<span<?php echo $orders_delete->ShippedDate->viewAttributes() ?>><?php echo $orders_delete->ShippedDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders_delete->ShipVia->Visible) { // ShipVia ?>
		<td <?php echo $orders_delete->ShipVia->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCount ?>_orders_ShipVia" class="orders_ShipVia">
<span<?php echo $orders_delete->ShipVia->viewAttributes() ?>><?php echo $orders_delete->ShipVia->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders_delete->Freight->Visible) { // Freight ?>
		<td <?php echo $orders_delete->Freight->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCount ?>_orders_Freight" class="orders_Freight">
<span<?php echo $orders_delete->Freight->viewAttributes() ?>><?php echo $orders_delete->Freight->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders_delete->ShipName->Visible) { // ShipName ?>
		<td <?php echo $orders_delete->ShipName->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCount ?>_orders_ShipName" class="orders_ShipName">
<span<?php echo $orders_delete->ShipName->viewAttributes() ?>><?php echo $orders_delete->ShipName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders_delete->ShipAddress->Visible) { // ShipAddress ?>
		<td <?php echo $orders_delete->ShipAddress->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCount ?>_orders_ShipAddress" class="orders_ShipAddress">
<span<?php echo $orders_delete->ShipAddress->viewAttributes() ?>><?php echo $orders_delete->ShipAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders_delete->ShipCity->Visible) { // ShipCity ?>
		<td <?php echo $orders_delete->ShipCity->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCount ?>_orders_ShipCity" class="orders_ShipCity">
<span<?php echo $orders_delete->ShipCity->viewAttributes() ?>><?php echo $orders_delete->ShipCity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders_delete->ShipRegion->Visible) { // ShipRegion ?>
		<td <?php echo $orders_delete->ShipRegion->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCount ?>_orders_ShipRegion" class="orders_ShipRegion">
<span<?php echo $orders_delete->ShipRegion->viewAttributes() ?>><?php echo $orders_delete->ShipRegion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders_delete->ShipPostalCode->Visible) { // ShipPostalCode ?>
		<td <?php echo $orders_delete->ShipPostalCode->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCount ?>_orders_ShipPostalCode" class="orders_ShipPostalCode">
<span<?php echo $orders_delete->ShipPostalCode->viewAttributes() ?>><?php echo $orders_delete->ShipPostalCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders_delete->ShipCountry->Visible) { // ShipCountry ?>
		<td <?php echo $orders_delete->ShipCountry->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCount ?>_orders_ShipCountry" class="orders_ShipCountry">
<span<?php echo $orders_delete->ShipCountry->viewAttributes() ?>><?php echo $orders_delete->ShipCountry->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$orders_delete->Recordset->moveNext();
}
$orders_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $orders_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$orders_delete->showPageFooter();
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
$orders_delete->terminate();
?>