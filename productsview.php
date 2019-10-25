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
$products_view = new products_view();

// Run the page
$products_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$products_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$products_view->isExport()) { ?>
<script>
var fproductsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fproductsview = currentForm = new ew.Form("fproductsview", "view");
	loadjs.done("fproductsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$products_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $products_view->ExportOptions->render("body") ?>
<?php $products_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $products_view->showPageHeader(); ?>
<?php
$products_view->showMessage();
?>
<form name="fproductsview" id="fproductsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="products">
<input type="hidden" name="modal" value="<?php echo (int)$products_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($products_view->ProductID->Visible) { // ProductID ?>
	<tr id="r_ProductID">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_ProductID"><?php echo $products_view->ProductID->caption() ?></span></td>
		<td data-name="ProductID" <?php echo $products_view->ProductID->cellAttributes() ?>>
<span id="el_products_ProductID">
<span<?php echo $products_view->ProductID->viewAttributes() ?>><?php echo $products_view->ProductID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products_view->ProductName->Visible) { // ProductName ?>
	<tr id="r_ProductName">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_ProductName"><?php echo $products_view->ProductName->caption() ?></span></td>
		<td data-name="ProductName" <?php echo $products_view->ProductName->cellAttributes() ?>>
<span id="el_products_ProductName">
<span<?php echo $products_view->ProductName->viewAttributes() ?>><?php echo $products_view->ProductName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products_view->SupplierID->Visible) { // SupplierID ?>
	<tr id="r_SupplierID">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_SupplierID"><?php echo $products_view->SupplierID->caption() ?></span></td>
		<td data-name="SupplierID" <?php echo $products_view->SupplierID->cellAttributes() ?>>
<span id="el_products_SupplierID">
<span<?php echo $products_view->SupplierID->viewAttributes() ?>><?php echo $products_view->SupplierID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products_view->CategoryID->Visible) { // CategoryID ?>
	<tr id="r_CategoryID">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_CategoryID"><?php echo $products_view->CategoryID->caption() ?></span></td>
		<td data-name="CategoryID" <?php echo $products_view->CategoryID->cellAttributes() ?>>
<span id="el_products_CategoryID">
<span<?php echo $products_view->CategoryID->viewAttributes() ?>><?php echo $products_view->CategoryID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products_view->QuantityPerUnit->Visible) { // QuantityPerUnit ?>
	<tr id="r_QuantityPerUnit">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_QuantityPerUnit"><?php echo $products_view->QuantityPerUnit->caption() ?></span></td>
		<td data-name="QuantityPerUnit" <?php echo $products_view->QuantityPerUnit->cellAttributes() ?>>
<span id="el_products_QuantityPerUnit">
<span<?php echo $products_view->QuantityPerUnit->viewAttributes() ?>><?php echo $products_view->QuantityPerUnit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products_view->UnitPrice->Visible) { // UnitPrice ?>
	<tr id="r_UnitPrice">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_UnitPrice"><?php echo $products_view->UnitPrice->caption() ?></span></td>
		<td data-name="UnitPrice" <?php echo $products_view->UnitPrice->cellAttributes() ?>>
<span id="el_products_UnitPrice">
<span<?php echo $products_view->UnitPrice->viewAttributes() ?>><?php echo $products_view->UnitPrice->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products_view->UnitsInStock->Visible) { // UnitsInStock ?>
	<tr id="r_UnitsInStock">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_UnitsInStock"><?php echo $products_view->UnitsInStock->caption() ?></span></td>
		<td data-name="UnitsInStock" <?php echo $products_view->UnitsInStock->cellAttributes() ?>>
<span id="el_products_UnitsInStock">
<span<?php echo $products_view->UnitsInStock->viewAttributes() ?>><?php echo $products_view->UnitsInStock->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products_view->UnitsOnOrder->Visible) { // UnitsOnOrder ?>
	<tr id="r_UnitsOnOrder">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_UnitsOnOrder"><?php echo $products_view->UnitsOnOrder->caption() ?></span></td>
		<td data-name="UnitsOnOrder" <?php echo $products_view->UnitsOnOrder->cellAttributes() ?>>
<span id="el_products_UnitsOnOrder">
<span<?php echo $products_view->UnitsOnOrder->viewAttributes() ?>><?php echo $products_view->UnitsOnOrder->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products_view->ReorderLevel->Visible) { // ReorderLevel ?>
	<tr id="r_ReorderLevel">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_ReorderLevel"><?php echo $products_view->ReorderLevel->caption() ?></span></td>
		<td data-name="ReorderLevel" <?php echo $products_view->ReorderLevel->cellAttributes() ?>>
<span id="el_products_ReorderLevel">
<span<?php echo $products_view->ReorderLevel->viewAttributes() ?>><?php echo $products_view->ReorderLevel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products_view->Discontinued->Visible) { // Discontinued ?>
	<tr id="r_Discontinued">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_Discontinued"><?php echo $products_view->Discontinued->caption() ?></span></td>
		<td data-name="Discontinued" <?php echo $products_view->Discontinued->cellAttributes() ?>>
<span id="el_products_Discontinued">
<span<?php echo $products_view->Discontinued->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_Discontinued" class="custom-control-input" value="<?php echo $products_view->Discontinued->getViewValue() ?>" disabled<?php if (ConvertToBool($products_view->Discontinued->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_Discontinued"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$products_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$products_view->isExport()) { ?>
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
$products_view->terminate();
?>