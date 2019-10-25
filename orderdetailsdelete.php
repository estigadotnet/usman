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
$orderdetails_delete = new orderdetails_delete();

// Run the page
$orderdetails_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orderdetails_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var forderdetailsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	forderdetailsdelete = currentForm = new ew.Form("forderdetailsdelete", "delete");
	loadjs.done("forderdetailsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $orderdetails_delete->showPageHeader(); ?>
<?php
$orderdetails_delete->showMessage();
?>
<form name="forderdetailsdelete" id="forderdetailsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orderdetails">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($orderdetails_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($orderdetails_delete->OrderID->Visible) { // OrderID ?>
		<th class="<?php echo $orderdetails_delete->OrderID->headerCellClass() ?>"><span id="elh_orderdetails_OrderID" class="orderdetails_OrderID"><?php echo $orderdetails_delete->OrderID->caption() ?></span></th>
<?php } ?>
<?php if ($orderdetails_delete->ProductID->Visible) { // ProductID ?>
		<th class="<?php echo $orderdetails_delete->ProductID->headerCellClass() ?>"><span id="elh_orderdetails_ProductID" class="orderdetails_ProductID"><?php echo $orderdetails_delete->ProductID->caption() ?></span></th>
<?php } ?>
<?php if ($orderdetails_delete->UnitPrice->Visible) { // UnitPrice ?>
		<th class="<?php echo $orderdetails_delete->UnitPrice->headerCellClass() ?>"><span id="elh_orderdetails_UnitPrice" class="orderdetails_UnitPrice"><?php echo $orderdetails_delete->UnitPrice->caption() ?></span></th>
<?php } ?>
<?php if ($orderdetails_delete->Quantity->Visible) { // Quantity ?>
		<th class="<?php echo $orderdetails_delete->Quantity->headerCellClass() ?>"><span id="elh_orderdetails_Quantity" class="orderdetails_Quantity"><?php echo $orderdetails_delete->Quantity->caption() ?></span></th>
<?php } ?>
<?php if ($orderdetails_delete->Discount->Visible) { // Discount ?>
		<th class="<?php echo $orderdetails_delete->Discount->headerCellClass() ?>"><span id="elh_orderdetails_Discount" class="orderdetails_Discount"><?php echo $orderdetails_delete->Discount->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$orderdetails_delete->RecordCount = 0;
$i = 0;
while (!$orderdetails_delete->Recordset->EOF) {
	$orderdetails_delete->RecordCount++;
	$orderdetails_delete->RowCount++;

	// Set row properties
	$orderdetails->resetAttributes();
	$orderdetails->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$orderdetails_delete->loadRowValues($orderdetails_delete->Recordset);

	// Render row
	$orderdetails_delete->renderRow();
?>
	<tr <?php echo $orderdetails->rowAttributes() ?>>
<?php if ($orderdetails_delete->OrderID->Visible) { // OrderID ?>
		<td <?php echo $orderdetails_delete->OrderID->cellAttributes() ?>>
<span id="el<?php echo $orderdetails_delete->RowCount ?>_orderdetails_OrderID" class="orderdetails_OrderID">
<span<?php echo $orderdetails_delete->OrderID->viewAttributes() ?>><?php echo $orderdetails_delete->OrderID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orderdetails_delete->ProductID->Visible) { // ProductID ?>
		<td <?php echo $orderdetails_delete->ProductID->cellAttributes() ?>>
<span id="el<?php echo $orderdetails_delete->RowCount ?>_orderdetails_ProductID" class="orderdetails_ProductID">
<span<?php echo $orderdetails_delete->ProductID->viewAttributes() ?>><?php echo $orderdetails_delete->ProductID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orderdetails_delete->UnitPrice->Visible) { // UnitPrice ?>
		<td <?php echo $orderdetails_delete->UnitPrice->cellAttributes() ?>>
<span id="el<?php echo $orderdetails_delete->RowCount ?>_orderdetails_UnitPrice" class="orderdetails_UnitPrice">
<span<?php echo $orderdetails_delete->UnitPrice->viewAttributes() ?>><?php echo $orderdetails_delete->UnitPrice->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orderdetails_delete->Quantity->Visible) { // Quantity ?>
		<td <?php echo $orderdetails_delete->Quantity->cellAttributes() ?>>
<span id="el<?php echo $orderdetails_delete->RowCount ?>_orderdetails_Quantity" class="orderdetails_Quantity">
<span<?php echo $orderdetails_delete->Quantity->viewAttributes() ?>><?php echo $orderdetails_delete->Quantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orderdetails_delete->Discount->Visible) { // Discount ?>
		<td <?php echo $orderdetails_delete->Discount->cellAttributes() ?>>
<span id="el<?php echo $orderdetails_delete->RowCount ?>_orderdetails_Discount" class="orderdetails_Discount">
<span<?php echo $orderdetails_delete->Discount->viewAttributes() ?>><?php echo $orderdetails_delete->Discount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$orderdetails_delete->Recordset->moveNext();
}
$orderdetails_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $orderdetails_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$orderdetails_delete->showPageFooter();
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
$orderdetails_delete->terminate();
?>