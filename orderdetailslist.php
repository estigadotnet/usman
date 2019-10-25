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
$orderdetails_list = new orderdetails_list();

// Run the page
$orderdetails_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orderdetails_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$orderdetails_list->isExport()) { ?>
<script>
var forderdetailslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	forderdetailslist = currentForm = new ew.Form("forderdetailslist", "list");
	forderdetailslist.formKeyCountName = '<?php echo $orderdetails_list->FormKeyCountName ?>';
	loadjs.done("forderdetailslist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$orderdetails_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($orderdetails_list->TotalRecords > 0 && $orderdetails_list->ExportOptions->visible()) { ?>
<?php $orderdetails_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($orderdetails_list->ImportOptions->visible()) { ?>
<?php $orderdetails_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$orderdetails_list->renderOtherOptions();
?>
<?php $orderdetails_list->showPageHeader(); ?>
<?php
$orderdetails_list->showMessage();
?>
<?php if ($orderdetails_list->TotalRecords > 0 || $orderdetails->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($orderdetails_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> orderdetails">
<form name="forderdetailslist" id="forderdetailslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orderdetails">
<div id="gmp_orderdetails" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($orderdetails_list->TotalRecords > 0 || $orderdetails_list->isGridEdit()) { ?>
<table id="tbl_orderdetailslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$orderdetails->RowType = ROWTYPE_HEADER;

// Render list options
$orderdetails_list->renderListOptions();

// Render list options (header, left)
$orderdetails_list->ListOptions->render("header", "left");
?>
<?php if ($orderdetails_list->OrderID->Visible) { // OrderID ?>
	<?php if ($orderdetails_list->SortUrl($orderdetails_list->OrderID) == "") { ?>
		<th data-name="OrderID" class="<?php echo $orderdetails_list->OrderID->headerCellClass() ?>"><div id="elh_orderdetails_OrderID" class="orderdetails_OrderID"><div class="ew-table-header-caption"><?php echo $orderdetails_list->OrderID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderID" class="<?php echo $orderdetails_list->OrderID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orderdetails_list->SortUrl($orderdetails_list->OrderID) ?>', 1);"><div id="elh_orderdetails_OrderID" class="orderdetails_OrderID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orderdetails_list->OrderID->caption() ?></span><span class="ew-table-header-sort"><?php if ($orderdetails_list->OrderID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orderdetails_list->OrderID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orderdetails_list->ProductID->Visible) { // ProductID ?>
	<?php if ($orderdetails_list->SortUrl($orderdetails_list->ProductID) == "") { ?>
		<th data-name="ProductID" class="<?php echo $orderdetails_list->ProductID->headerCellClass() ?>"><div id="elh_orderdetails_ProductID" class="orderdetails_ProductID"><div class="ew-table-header-caption"><?php echo $orderdetails_list->ProductID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductID" class="<?php echo $orderdetails_list->ProductID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orderdetails_list->SortUrl($orderdetails_list->ProductID) ?>', 1);"><div id="elh_orderdetails_ProductID" class="orderdetails_ProductID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orderdetails_list->ProductID->caption() ?></span><span class="ew-table-header-sort"><?php if ($orderdetails_list->ProductID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orderdetails_list->ProductID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orderdetails_list->UnitPrice->Visible) { // UnitPrice ?>
	<?php if ($orderdetails_list->SortUrl($orderdetails_list->UnitPrice) == "") { ?>
		<th data-name="UnitPrice" class="<?php echo $orderdetails_list->UnitPrice->headerCellClass() ?>"><div id="elh_orderdetails_UnitPrice" class="orderdetails_UnitPrice"><div class="ew-table-header-caption"><?php echo $orderdetails_list->UnitPrice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitPrice" class="<?php echo $orderdetails_list->UnitPrice->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orderdetails_list->SortUrl($orderdetails_list->UnitPrice) ?>', 1);"><div id="elh_orderdetails_UnitPrice" class="orderdetails_UnitPrice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orderdetails_list->UnitPrice->caption() ?></span><span class="ew-table-header-sort"><?php if ($orderdetails_list->UnitPrice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orderdetails_list->UnitPrice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orderdetails_list->Quantity->Visible) { // Quantity ?>
	<?php if ($orderdetails_list->SortUrl($orderdetails_list->Quantity) == "") { ?>
		<th data-name="Quantity" class="<?php echo $orderdetails_list->Quantity->headerCellClass() ?>"><div id="elh_orderdetails_Quantity" class="orderdetails_Quantity"><div class="ew-table-header-caption"><?php echo $orderdetails_list->Quantity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Quantity" class="<?php echo $orderdetails_list->Quantity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orderdetails_list->SortUrl($orderdetails_list->Quantity) ?>', 1);"><div id="elh_orderdetails_Quantity" class="orderdetails_Quantity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orderdetails_list->Quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($orderdetails_list->Quantity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orderdetails_list->Quantity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orderdetails_list->Discount->Visible) { // Discount ?>
	<?php if ($orderdetails_list->SortUrl($orderdetails_list->Discount) == "") { ?>
		<th data-name="Discount" class="<?php echo $orderdetails_list->Discount->headerCellClass() ?>"><div id="elh_orderdetails_Discount" class="orderdetails_Discount"><div class="ew-table-header-caption"><?php echo $orderdetails_list->Discount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Discount" class="<?php echo $orderdetails_list->Discount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orderdetails_list->SortUrl($orderdetails_list->Discount) ?>', 1);"><div id="elh_orderdetails_Discount" class="orderdetails_Discount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orderdetails_list->Discount->caption() ?></span><span class="ew-table-header-sort"><?php if ($orderdetails_list->Discount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orderdetails_list->Discount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$orderdetails_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($orderdetails_list->ExportAll && $orderdetails_list->isExport()) {
	$orderdetails_list->StopRecord = $orderdetails_list->TotalRecords;
} else {

	// Set the last record to display
	if ($orderdetails_list->TotalRecords > $orderdetails_list->StartRecord + $orderdetails_list->DisplayRecords - 1)
		$orderdetails_list->StopRecord = $orderdetails_list->StartRecord + $orderdetails_list->DisplayRecords - 1;
	else
		$orderdetails_list->StopRecord = $orderdetails_list->TotalRecords;
}
$orderdetails_list->RecordCount = $orderdetails_list->StartRecord - 1;
if ($orderdetails_list->Recordset && !$orderdetails_list->Recordset->EOF) {
	$orderdetails_list->Recordset->moveFirst();
	$selectLimit = $orderdetails_list->UseSelectLimit;
	if (!$selectLimit && $orderdetails_list->StartRecord > 1)
		$orderdetails_list->Recordset->move($orderdetails_list->StartRecord - 1);
} elseif (!$orderdetails->AllowAddDeleteRow && $orderdetails_list->StopRecord == 0) {
	$orderdetails_list->StopRecord = $orderdetails->GridAddRowCount;
}

// Initialize aggregate
$orderdetails->RowType = ROWTYPE_AGGREGATEINIT;
$orderdetails->resetAttributes();
$orderdetails_list->renderRow();
while ($orderdetails_list->RecordCount < $orderdetails_list->StopRecord) {
	$orderdetails_list->RecordCount++;
	if ($orderdetails_list->RecordCount >= $orderdetails_list->StartRecord) {
		$orderdetails_list->RowCount++;

		// Set up key count
		$orderdetails_list->KeyCount = $orderdetails_list->RowIndex;

		// Init row class and style
		$orderdetails->resetAttributes();
		$orderdetails->CssClass = "";
		if ($orderdetails_list->isGridAdd()) {
		} else {
			$orderdetails_list->loadRowValues($orderdetails_list->Recordset); // Load row values
		}
		$orderdetails->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$orderdetails->RowAttrs->merge(["data-rowindex" => $orderdetails_list->RowCount, "id" => "r" . $orderdetails_list->RowCount . "_orderdetails", "data-rowtype" => $orderdetails->RowType]);

		// Render row
		$orderdetails_list->renderRow();

		// Render list options
		$orderdetails_list->renderListOptions();
?>
	<tr <?php echo $orderdetails->rowAttributes() ?>>
<?php

// Render list options (body, left)
$orderdetails_list->ListOptions->render("body", "left", $orderdetails_list->RowCount);
?>
	<?php if ($orderdetails_list->OrderID->Visible) { // OrderID ?>
		<td data-name="OrderID" <?php echo $orderdetails_list->OrderID->cellAttributes() ?>>
<span id="el<?php echo $orderdetails_list->RowCount ?>_orderdetails_OrderID">
<span<?php echo $orderdetails_list->OrderID->viewAttributes() ?>><?php echo $orderdetails_list->OrderID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orderdetails_list->ProductID->Visible) { // ProductID ?>
		<td data-name="ProductID" <?php echo $orderdetails_list->ProductID->cellAttributes() ?>>
<span id="el<?php echo $orderdetails_list->RowCount ?>_orderdetails_ProductID">
<span<?php echo $orderdetails_list->ProductID->viewAttributes() ?>><?php echo $orderdetails_list->ProductID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orderdetails_list->UnitPrice->Visible) { // UnitPrice ?>
		<td data-name="UnitPrice" <?php echo $orderdetails_list->UnitPrice->cellAttributes() ?>>
<span id="el<?php echo $orderdetails_list->RowCount ?>_orderdetails_UnitPrice">
<span<?php echo $orderdetails_list->UnitPrice->viewAttributes() ?>><?php echo $orderdetails_list->UnitPrice->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orderdetails_list->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity" <?php echo $orderdetails_list->Quantity->cellAttributes() ?>>
<span id="el<?php echo $orderdetails_list->RowCount ?>_orderdetails_Quantity">
<span<?php echo $orderdetails_list->Quantity->viewAttributes() ?>><?php echo $orderdetails_list->Quantity->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orderdetails_list->Discount->Visible) { // Discount ?>
		<td data-name="Discount" <?php echo $orderdetails_list->Discount->cellAttributes() ?>>
<span id="el<?php echo $orderdetails_list->RowCount ?>_orderdetails_Discount">
<span<?php echo $orderdetails_list->Discount->viewAttributes() ?>><?php echo $orderdetails_list->Discount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$orderdetails_list->ListOptions->render("body", "right", $orderdetails_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$orderdetails_list->isGridAdd())
		$orderdetails_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$orderdetails->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($orderdetails_list->Recordset)
	$orderdetails_list->Recordset->Close();
?>
<?php if (!$orderdetails_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$orderdetails_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $orderdetails_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $orderdetails_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($orderdetails_list->TotalRecords == 0 && !$orderdetails->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $orderdetails_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$orderdetails_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$orderdetails_list->isExport()) { ?>
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
$orderdetails_list->terminate();
?>