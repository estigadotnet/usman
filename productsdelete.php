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
$products_delete = new products_delete();

// Run the page
$products_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$products_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproductsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fproductsdelete = currentForm = new ew.Form("fproductsdelete", "delete");
	loadjs.done("fproductsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $products_delete->showPageHeader(); ?>
<?php
$products_delete->showMessage();
?>
<form name="fproductsdelete" id="fproductsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="products">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($products_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($products_delete->ProductID->Visible) { // ProductID ?>
		<th class="<?php echo $products_delete->ProductID->headerCellClass() ?>"><span id="elh_products_ProductID" class="products_ProductID"><?php echo $products_delete->ProductID->caption() ?></span></th>
<?php } ?>
<?php if ($products_delete->ProductName->Visible) { // ProductName ?>
		<th class="<?php echo $products_delete->ProductName->headerCellClass() ?>"><span id="elh_products_ProductName" class="products_ProductName"><?php echo $products_delete->ProductName->caption() ?></span></th>
<?php } ?>
<?php if ($products_delete->SupplierID->Visible) { // SupplierID ?>
		<th class="<?php echo $products_delete->SupplierID->headerCellClass() ?>"><span id="elh_products_SupplierID" class="products_SupplierID"><?php echo $products_delete->SupplierID->caption() ?></span></th>
<?php } ?>
<?php if ($products_delete->CategoryID->Visible) { // CategoryID ?>
		<th class="<?php echo $products_delete->CategoryID->headerCellClass() ?>"><span id="elh_products_CategoryID" class="products_CategoryID"><?php echo $products_delete->CategoryID->caption() ?></span></th>
<?php } ?>
<?php if ($products_delete->QuantityPerUnit->Visible) { // QuantityPerUnit ?>
		<th class="<?php echo $products_delete->QuantityPerUnit->headerCellClass() ?>"><span id="elh_products_QuantityPerUnit" class="products_QuantityPerUnit"><?php echo $products_delete->QuantityPerUnit->caption() ?></span></th>
<?php } ?>
<?php if ($products_delete->UnitPrice->Visible) { // UnitPrice ?>
		<th class="<?php echo $products_delete->UnitPrice->headerCellClass() ?>"><span id="elh_products_UnitPrice" class="products_UnitPrice"><?php echo $products_delete->UnitPrice->caption() ?></span></th>
<?php } ?>
<?php if ($products_delete->UnitsInStock->Visible) { // UnitsInStock ?>
		<th class="<?php echo $products_delete->UnitsInStock->headerCellClass() ?>"><span id="elh_products_UnitsInStock" class="products_UnitsInStock"><?php echo $products_delete->UnitsInStock->caption() ?></span></th>
<?php } ?>
<?php if ($products_delete->UnitsOnOrder->Visible) { // UnitsOnOrder ?>
		<th class="<?php echo $products_delete->UnitsOnOrder->headerCellClass() ?>"><span id="elh_products_UnitsOnOrder" class="products_UnitsOnOrder"><?php echo $products_delete->UnitsOnOrder->caption() ?></span></th>
<?php } ?>
<?php if ($products_delete->ReorderLevel->Visible) { // ReorderLevel ?>
		<th class="<?php echo $products_delete->ReorderLevel->headerCellClass() ?>"><span id="elh_products_ReorderLevel" class="products_ReorderLevel"><?php echo $products_delete->ReorderLevel->caption() ?></span></th>
<?php } ?>
<?php if ($products_delete->Discontinued->Visible) { // Discontinued ?>
		<th class="<?php echo $products_delete->Discontinued->headerCellClass() ?>"><span id="elh_products_Discontinued" class="products_Discontinued"><?php echo $products_delete->Discontinued->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$products_delete->RecordCount = 0;
$i = 0;
while (!$products_delete->Recordset->EOF) {
	$products_delete->RecordCount++;
	$products_delete->RowCount++;

	// Set row properties
	$products->resetAttributes();
	$products->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$products_delete->loadRowValues($products_delete->Recordset);

	// Render row
	$products_delete->renderRow();
?>
	<tr <?php echo $products->rowAttributes() ?>>
<?php if ($products_delete->ProductID->Visible) { // ProductID ?>
		<td <?php echo $products_delete->ProductID->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCount ?>_products_ProductID" class="products_ProductID">
<span<?php echo $products_delete->ProductID->viewAttributes() ?>><?php echo $products_delete->ProductID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products_delete->ProductName->Visible) { // ProductName ?>
		<td <?php echo $products_delete->ProductName->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCount ?>_products_ProductName" class="products_ProductName">
<span<?php echo $products_delete->ProductName->viewAttributes() ?>><?php echo $products_delete->ProductName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products_delete->SupplierID->Visible) { // SupplierID ?>
		<td <?php echo $products_delete->SupplierID->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCount ?>_products_SupplierID" class="products_SupplierID">
<span<?php echo $products_delete->SupplierID->viewAttributes() ?>><?php echo $products_delete->SupplierID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products_delete->CategoryID->Visible) { // CategoryID ?>
		<td <?php echo $products_delete->CategoryID->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCount ?>_products_CategoryID" class="products_CategoryID">
<span<?php echo $products_delete->CategoryID->viewAttributes() ?>><?php echo $products_delete->CategoryID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products_delete->QuantityPerUnit->Visible) { // QuantityPerUnit ?>
		<td <?php echo $products_delete->QuantityPerUnit->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCount ?>_products_QuantityPerUnit" class="products_QuantityPerUnit">
<span<?php echo $products_delete->QuantityPerUnit->viewAttributes() ?>><?php echo $products_delete->QuantityPerUnit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products_delete->UnitPrice->Visible) { // UnitPrice ?>
		<td <?php echo $products_delete->UnitPrice->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCount ?>_products_UnitPrice" class="products_UnitPrice">
<span<?php echo $products_delete->UnitPrice->viewAttributes() ?>><?php echo $products_delete->UnitPrice->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products_delete->UnitsInStock->Visible) { // UnitsInStock ?>
		<td <?php echo $products_delete->UnitsInStock->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCount ?>_products_UnitsInStock" class="products_UnitsInStock">
<span<?php echo $products_delete->UnitsInStock->viewAttributes() ?>><?php echo $products_delete->UnitsInStock->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products_delete->UnitsOnOrder->Visible) { // UnitsOnOrder ?>
		<td <?php echo $products_delete->UnitsOnOrder->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCount ?>_products_UnitsOnOrder" class="products_UnitsOnOrder">
<span<?php echo $products_delete->UnitsOnOrder->viewAttributes() ?>><?php echo $products_delete->UnitsOnOrder->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products_delete->ReorderLevel->Visible) { // ReorderLevel ?>
		<td <?php echo $products_delete->ReorderLevel->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCount ?>_products_ReorderLevel" class="products_ReorderLevel">
<span<?php echo $products_delete->ReorderLevel->viewAttributes() ?>><?php echo $products_delete->ReorderLevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products_delete->Discontinued->Visible) { // Discontinued ?>
		<td <?php echo $products_delete->Discontinued->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCount ?>_products_Discontinued" class="products_Discontinued">
<span<?php echo $products_delete->Discontinued->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_Discontinued" class="custom-control-input" value="<?php echo $products_delete->Discontinued->getViewValue() ?>" disabled<?php if (ConvertToBool($products_delete->Discontinued->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_Discontinued"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$products_delete->Recordset->moveNext();
}
$products_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $products_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$products_delete->showPageFooter();
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
$products_delete->terminate();
?>