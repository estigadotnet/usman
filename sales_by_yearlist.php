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
$sales_by_year_list = new sales_by_year_list();

// Run the page
$sales_by_year_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sales_by_year_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sales_by_year_list->isExport()) { ?>
<script>
var fsales_by_yearlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsales_by_yearlist = currentForm = new ew.Form("fsales_by_yearlist", "list");
	fsales_by_yearlist.formKeyCountName = '<?php echo $sales_by_year_list->FormKeyCountName ?>';
	loadjs.done("fsales_by_yearlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$sales_by_year_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($sales_by_year_list->TotalRecords > 0 && $sales_by_year_list->ExportOptions->visible()) { ?>
<?php $sales_by_year_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($sales_by_year_list->ImportOptions->visible()) { ?>
<?php $sales_by_year_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$sales_by_year_list->renderOtherOptions();
?>
<?php $sales_by_year_list->showPageHeader(); ?>
<?php
$sales_by_year_list->showMessage();
?>
<?php if ($sales_by_year_list->TotalRecords > 0 || $sales_by_year->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($sales_by_year_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> sales_by_year">
<form name="fsales_by_yearlist" id="fsales_by_yearlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sales_by_year">
<div id="gmp_sales_by_year" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($sales_by_year_list->TotalRecords > 0 || $sales_by_year_list->isGridEdit()) { ?>
<table id="tbl_sales_by_yearlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$sales_by_year->RowType = ROWTYPE_HEADER;

// Render list options
$sales_by_year_list->renderListOptions();

// Render list options (header, left)
$sales_by_year_list->ListOptions->render("header", "left");
?>
<?php if ($sales_by_year_list->ShippedDate->Visible) { // ShippedDate ?>
	<?php if ($sales_by_year_list->SortUrl($sales_by_year_list->ShippedDate) == "") { ?>
		<th data-name="ShippedDate" class="<?php echo $sales_by_year_list->ShippedDate->headerCellClass() ?>"><div id="elh_sales_by_year_ShippedDate" class="sales_by_year_ShippedDate"><div class="ew-table-header-caption"><?php echo $sales_by_year_list->ShippedDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShippedDate" class="<?php echo $sales_by_year_list->ShippedDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sales_by_year_list->SortUrl($sales_by_year_list->ShippedDate) ?>', 1);"><div id="elh_sales_by_year_ShippedDate" class="sales_by_year_ShippedDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sales_by_year_list->ShippedDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($sales_by_year_list->ShippedDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sales_by_year_list->ShippedDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sales_by_year_list->OrderID->Visible) { // OrderID ?>
	<?php if ($sales_by_year_list->SortUrl($sales_by_year_list->OrderID) == "") { ?>
		<th data-name="OrderID" class="<?php echo $sales_by_year_list->OrderID->headerCellClass() ?>"><div id="elh_sales_by_year_OrderID" class="sales_by_year_OrderID"><div class="ew-table-header-caption"><?php echo $sales_by_year_list->OrderID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderID" class="<?php echo $sales_by_year_list->OrderID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sales_by_year_list->SortUrl($sales_by_year_list->OrderID) ?>', 1);"><div id="elh_sales_by_year_OrderID" class="sales_by_year_OrderID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sales_by_year_list->OrderID->caption() ?></span><span class="ew-table-header-sort"><?php if ($sales_by_year_list->OrderID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sales_by_year_list->OrderID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sales_by_year_list->Subtotal->Visible) { // Subtotal ?>
	<?php if ($sales_by_year_list->SortUrl($sales_by_year_list->Subtotal) == "") { ?>
		<th data-name="Subtotal" class="<?php echo $sales_by_year_list->Subtotal->headerCellClass() ?>"><div id="elh_sales_by_year_Subtotal" class="sales_by_year_Subtotal"><div class="ew-table-header-caption"><?php echo $sales_by_year_list->Subtotal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Subtotal" class="<?php echo $sales_by_year_list->Subtotal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sales_by_year_list->SortUrl($sales_by_year_list->Subtotal) ?>', 1);"><div id="elh_sales_by_year_Subtotal" class="sales_by_year_Subtotal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sales_by_year_list->Subtotal->caption() ?></span><span class="ew-table-header-sort"><?php if ($sales_by_year_list->Subtotal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sales_by_year_list->Subtotal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sales_by_year_list->Year->Visible) { // Year ?>
	<?php if ($sales_by_year_list->SortUrl($sales_by_year_list->Year) == "") { ?>
		<th data-name="Year" class="<?php echo $sales_by_year_list->Year->headerCellClass() ?>"><div id="elh_sales_by_year_Year" class="sales_by_year_Year"><div class="ew-table-header-caption"><?php echo $sales_by_year_list->Year->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Year" class="<?php echo $sales_by_year_list->Year->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sales_by_year_list->SortUrl($sales_by_year_list->Year) ?>', 1);"><div id="elh_sales_by_year_Year" class="sales_by_year_Year">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sales_by_year_list->Year->caption() ?></span><span class="ew-table-header-sort"><?php if ($sales_by_year_list->Year->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sales_by_year_list->Year->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$sales_by_year_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($sales_by_year_list->ExportAll && $sales_by_year_list->isExport()) {
	$sales_by_year_list->StopRecord = $sales_by_year_list->TotalRecords;
} else {

	// Set the last record to display
	if ($sales_by_year_list->TotalRecords > $sales_by_year_list->StartRecord + $sales_by_year_list->DisplayRecords - 1)
		$sales_by_year_list->StopRecord = $sales_by_year_list->StartRecord + $sales_by_year_list->DisplayRecords - 1;
	else
		$sales_by_year_list->StopRecord = $sales_by_year_list->TotalRecords;
}
$sales_by_year_list->RecordCount = $sales_by_year_list->StartRecord - 1;
if ($sales_by_year_list->Recordset && !$sales_by_year_list->Recordset->EOF) {
	$sales_by_year_list->Recordset->moveFirst();
	$selectLimit = $sales_by_year_list->UseSelectLimit;
	if (!$selectLimit && $sales_by_year_list->StartRecord > 1)
		$sales_by_year_list->Recordset->move($sales_by_year_list->StartRecord - 1);
} elseif (!$sales_by_year->AllowAddDeleteRow && $sales_by_year_list->StopRecord == 0) {
	$sales_by_year_list->StopRecord = $sales_by_year->GridAddRowCount;
}

// Initialize aggregate
$sales_by_year->RowType = ROWTYPE_AGGREGATEINIT;
$sales_by_year->resetAttributes();
$sales_by_year_list->renderRow();
while ($sales_by_year_list->RecordCount < $sales_by_year_list->StopRecord) {
	$sales_by_year_list->RecordCount++;
	if ($sales_by_year_list->RecordCount >= $sales_by_year_list->StartRecord) {
		$sales_by_year_list->RowCount++;

		// Set up key count
		$sales_by_year_list->KeyCount = $sales_by_year_list->RowIndex;

		// Init row class and style
		$sales_by_year->resetAttributes();
		$sales_by_year->CssClass = "";
		if ($sales_by_year_list->isGridAdd()) {
		} else {
			$sales_by_year_list->loadRowValues($sales_by_year_list->Recordset); // Load row values
		}
		$sales_by_year->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$sales_by_year->RowAttrs->merge(["data-rowindex" => $sales_by_year_list->RowCount, "id" => "r" . $sales_by_year_list->RowCount . "_sales_by_year", "data-rowtype" => $sales_by_year->RowType]);

		// Render row
		$sales_by_year_list->renderRow();

		// Render list options
		$sales_by_year_list->renderListOptions();
?>
	<tr <?php echo $sales_by_year->rowAttributes() ?>>
<?php

// Render list options (body, left)
$sales_by_year_list->ListOptions->render("body", "left", $sales_by_year_list->RowCount);
?>
	<?php if ($sales_by_year_list->ShippedDate->Visible) { // ShippedDate ?>
		<td data-name="ShippedDate" <?php echo $sales_by_year_list->ShippedDate->cellAttributes() ?>>
<span id="el<?php echo $sales_by_year_list->RowCount ?>_sales_by_year_ShippedDate">
<span<?php echo $sales_by_year_list->ShippedDate->viewAttributes() ?>><?php echo $sales_by_year_list->ShippedDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sales_by_year_list->OrderID->Visible) { // OrderID ?>
		<td data-name="OrderID" <?php echo $sales_by_year_list->OrderID->cellAttributes() ?>>
<span id="el<?php echo $sales_by_year_list->RowCount ?>_sales_by_year_OrderID">
<span<?php echo $sales_by_year_list->OrderID->viewAttributes() ?>><?php echo $sales_by_year_list->OrderID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sales_by_year_list->Subtotal->Visible) { // Subtotal ?>
		<td data-name="Subtotal" <?php echo $sales_by_year_list->Subtotal->cellAttributes() ?>>
<span id="el<?php echo $sales_by_year_list->RowCount ?>_sales_by_year_Subtotal">
<span<?php echo $sales_by_year_list->Subtotal->viewAttributes() ?>><?php echo $sales_by_year_list->Subtotal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sales_by_year_list->Year->Visible) { // Year ?>
		<td data-name="Year" <?php echo $sales_by_year_list->Year->cellAttributes() ?>>
<span id="el<?php echo $sales_by_year_list->RowCount ?>_sales_by_year_Year">
<span<?php echo $sales_by_year_list->Year->viewAttributes() ?>><?php echo $sales_by_year_list->Year->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$sales_by_year_list->ListOptions->render("body", "right", $sales_by_year_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$sales_by_year_list->isGridAdd())
		$sales_by_year_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$sales_by_year->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($sales_by_year_list->Recordset)
	$sales_by_year_list->Recordset->Close();
?>
<?php if (!$sales_by_year_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$sales_by_year_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sales_by_year_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sales_by_year_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($sales_by_year_list->TotalRecords == 0 && !$sales_by_year->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $sales_by_year_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$sales_by_year_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sales_by_year_list->isExport()) { ?>
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
$sales_by_year_list->terminate();
?>