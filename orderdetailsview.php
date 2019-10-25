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
$orderdetails_view = new orderdetails_view();

// Run the page
$orderdetails_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orderdetails_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$orderdetails_view->isExport()) { ?>
<script>
var forderdetailsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	forderdetailsview = currentForm = new ew.Form("forderdetailsview", "view");
	loadjs.done("forderdetailsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$orderdetails_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $orderdetails_view->ExportOptions->render("body") ?>
<?php $orderdetails_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $orderdetails_view->showPageHeader(); ?>
<?php
$orderdetails_view->showMessage();
?>
<form name="forderdetailsview" id="forderdetailsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orderdetails">
<input type="hidden" name="modal" value="<?php echo (int)$orderdetails_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($orderdetails_view->OrderID->Visible) { // OrderID ?>
	<tr id="r_OrderID">
		<td class="<?php echo $orderdetails_view->TableLeftColumnClass ?>"><span id="elh_orderdetails_OrderID"><?php echo $orderdetails_view->OrderID->caption() ?></span></td>
		<td data-name="OrderID" <?php echo $orderdetails_view->OrderID->cellAttributes() ?>>
<span id="el_orderdetails_OrderID">
<span<?php echo $orderdetails_view->OrderID->viewAttributes() ?>><?php echo $orderdetails_view->OrderID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orderdetails_view->ProductID->Visible) { // ProductID ?>
	<tr id="r_ProductID">
		<td class="<?php echo $orderdetails_view->TableLeftColumnClass ?>"><span id="elh_orderdetails_ProductID"><?php echo $orderdetails_view->ProductID->caption() ?></span></td>
		<td data-name="ProductID" <?php echo $orderdetails_view->ProductID->cellAttributes() ?>>
<span id="el_orderdetails_ProductID">
<span<?php echo $orderdetails_view->ProductID->viewAttributes() ?>><?php echo $orderdetails_view->ProductID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orderdetails_view->UnitPrice->Visible) { // UnitPrice ?>
	<tr id="r_UnitPrice">
		<td class="<?php echo $orderdetails_view->TableLeftColumnClass ?>"><span id="elh_orderdetails_UnitPrice"><?php echo $orderdetails_view->UnitPrice->caption() ?></span></td>
		<td data-name="UnitPrice" <?php echo $orderdetails_view->UnitPrice->cellAttributes() ?>>
<span id="el_orderdetails_UnitPrice">
<span<?php echo $orderdetails_view->UnitPrice->viewAttributes() ?>><?php echo $orderdetails_view->UnitPrice->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orderdetails_view->Quantity->Visible) { // Quantity ?>
	<tr id="r_Quantity">
		<td class="<?php echo $orderdetails_view->TableLeftColumnClass ?>"><span id="elh_orderdetails_Quantity"><?php echo $orderdetails_view->Quantity->caption() ?></span></td>
		<td data-name="Quantity" <?php echo $orderdetails_view->Quantity->cellAttributes() ?>>
<span id="el_orderdetails_Quantity">
<span<?php echo $orderdetails_view->Quantity->viewAttributes() ?>><?php echo $orderdetails_view->Quantity->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orderdetails_view->Discount->Visible) { // Discount ?>
	<tr id="r_Discount">
		<td class="<?php echo $orderdetails_view->TableLeftColumnClass ?>"><span id="elh_orderdetails_Discount"><?php echo $orderdetails_view->Discount->caption() ?></span></td>
		<td data-name="Discount" <?php echo $orderdetails_view->Discount->cellAttributes() ?>>
<span id="el_orderdetails_Discount">
<span<?php echo $orderdetails_view->Discount->viewAttributes() ?>><?php echo $orderdetails_view->Discount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$orderdetails_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$orderdetails_view->isExport()) { ?>
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
$orderdetails_view->terminate();
?>