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
$order_details_extended_list = new order_details_extended_list();

// Run the page
$order_details_extended_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$order_details_extended_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$order_details_extended_list->isExport()) { ?>
<script>
var forder_details_extendedlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	forder_details_extendedlist = currentForm = new ew.Form("forder_details_extendedlist", "list");
	forder_details_extendedlist.formKeyCountName = '<?php echo $order_details_extended_list->FormKeyCountName ?>';
	loadjs.done("forder_details_extendedlist");
});
var forder_details_extendedlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	forder_details_extendedlistsrch = currentSearchForm = new ew.Form("forder_details_extendedlistsrch");

	// Dynamic selection lists
	// Filters

	forder_details_extendedlistsrch.filterList = <?php echo $order_details_extended_list->getFilterList() ?>;
	loadjs.done("forder_details_extendedlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$order_details_extended_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($order_details_extended_list->TotalRecords > 0 && $order_details_extended_list->ExportOptions->visible()) { ?>
<?php $order_details_extended_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($order_details_extended_list->ImportOptions->visible()) { ?>
<?php $order_details_extended_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($order_details_extended_list->SearchOptions->visible()) { ?>
<?php $order_details_extended_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($order_details_extended_list->FilterOptions->visible()) { ?>
<?php $order_details_extended_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$order_details_extended_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$order_details_extended_list->isExport() && !$order_details_extended->CurrentAction) { ?>
<form name="forder_details_extendedlistsrch" id="forder_details_extendedlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="forder_details_extendedlistsrch-search-panel" class="<?php echo $order_details_extended_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="order_details_extended">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $order_details_extended_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($order_details_extended_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($order_details_extended_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $order_details_extended_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($order_details_extended_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($order_details_extended_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($order_details_extended_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($order_details_extended_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $order_details_extended_list->showPageHeader(); ?>
<?php
$order_details_extended_list->showMessage();
?>
<?php if ($order_details_extended_list->TotalRecords > 0 || $order_details_extended->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($order_details_extended_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> order_details_extended">
<form name="forder_details_extendedlist" id="forder_details_extendedlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="order_details_extended">
<div id="gmp_order_details_extended" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($order_details_extended_list->TotalRecords > 0 || $order_details_extended_list->isGridEdit()) { ?>
<table id="tbl_order_details_extendedlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$order_details_extended->RowType = ROWTYPE_HEADER;

// Render list options
$order_details_extended_list->renderListOptions();

// Render list options (header, left)
$order_details_extended_list->ListOptions->render("header", "left");
?>
<?php if ($order_details_extended_list->CompanyName->Visible) { // CompanyName ?>
	<?php if ($order_details_extended_list->SortUrl($order_details_extended_list->CompanyName) == "") { ?>
		<th data-name="CompanyName" class="<?php echo $order_details_extended_list->CompanyName->headerCellClass() ?>"><div id="elh_order_details_extended_CompanyName" class="order_details_extended_CompanyName"><div class="ew-table-header-caption"><?php echo $order_details_extended_list->CompanyName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CompanyName" class="<?php echo $order_details_extended_list->CompanyName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_list->SortUrl($order_details_extended_list->CompanyName) ?>', 1);"><div id="elh_order_details_extended_CompanyName" class="order_details_extended_CompanyName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_list->CompanyName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_list->CompanyName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_list->CompanyName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_list->OrderID->Visible) { // OrderID ?>
	<?php if ($order_details_extended_list->SortUrl($order_details_extended_list->OrderID) == "") { ?>
		<th data-name="OrderID" class="<?php echo $order_details_extended_list->OrderID->headerCellClass() ?>"><div id="elh_order_details_extended_OrderID" class="order_details_extended_OrderID"><div class="ew-table-header-caption"><?php echo $order_details_extended_list->OrderID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderID" class="<?php echo $order_details_extended_list->OrderID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_list->SortUrl($order_details_extended_list->OrderID) ?>', 1);"><div id="elh_order_details_extended_OrderID" class="order_details_extended_OrderID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_list->OrderID->caption() ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_list->OrderID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_list->OrderID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_list->ProductName->Visible) { // ProductName ?>
	<?php if ($order_details_extended_list->SortUrl($order_details_extended_list->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $order_details_extended_list->ProductName->headerCellClass() ?>"><div id="elh_order_details_extended_ProductName" class="order_details_extended_ProductName"><div class="ew-table-header-caption"><?php echo $order_details_extended_list->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $order_details_extended_list->ProductName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_list->SortUrl($order_details_extended_list->ProductName) ?>', 1);"><div id="elh_order_details_extended_ProductName" class="order_details_extended_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_list->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_list->ProductName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_list->ProductName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_list->UnitPrice->Visible) { // UnitPrice ?>
	<?php if ($order_details_extended_list->SortUrl($order_details_extended_list->UnitPrice) == "") { ?>
		<th data-name="UnitPrice" class="<?php echo $order_details_extended_list->UnitPrice->headerCellClass() ?>"><div id="elh_order_details_extended_UnitPrice" class="order_details_extended_UnitPrice"><div class="ew-table-header-caption"><?php echo $order_details_extended_list->UnitPrice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitPrice" class="<?php echo $order_details_extended_list->UnitPrice->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_list->SortUrl($order_details_extended_list->UnitPrice) ?>', 1);"><div id="elh_order_details_extended_UnitPrice" class="order_details_extended_UnitPrice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_list->UnitPrice->caption() ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_list->UnitPrice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_list->UnitPrice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_list->Quantity->Visible) { // Quantity ?>
	<?php if ($order_details_extended_list->SortUrl($order_details_extended_list->Quantity) == "") { ?>
		<th data-name="Quantity" class="<?php echo $order_details_extended_list->Quantity->headerCellClass() ?>"><div id="elh_order_details_extended_Quantity" class="order_details_extended_Quantity"><div class="ew-table-header-caption"><?php echo $order_details_extended_list->Quantity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Quantity" class="<?php echo $order_details_extended_list->Quantity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_list->SortUrl($order_details_extended_list->Quantity) ?>', 1);"><div id="elh_order_details_extended_Quantity" class="order_details_extended_Quantity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_list->Quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_list->Quantity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_list->Quantity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_list->Discount->Visible) { // Discount ?>
	<?php if ($order_details_extended_list->SortUrl($order_details_extended_list->Discount) == "") { ?>
		<th data-name="Discount" class="<?php echo $order_details_extended_list->Discount->headerCellClass() ?>"><div id="elh_order_details_extended_Discount" class="order_details_extended_Discount"><div class="ew-table-header-caption"><?php echo $order_details_extended_list->Discount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Discount" class="<?php echo $order_details_extended_list->Discount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_list->SortUrl($order_details_extended_list->Discount) ?>', 1);"><div id="elh_order_details_extended_Discount" class="order_details_extended_Discount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_list->Discount->caption() ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_list->Discount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_list->Discount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_list->Extended_Price->Visible) { // Extended Price ?>
	<?php if ($order_details_extended_list->SortUrl($order_details_extended_list->Extended_Price) == "") { ?>
		<th data-name="Extended_Price" class="<?php echo $order_details_extended_list->Extended_Price->headerCellClass() ?>"><div id="elh_order_details_extended_Extended_Price" class="order_details_extended_Extended_Price"><div class="ew-table-header-caption"><?php echo $order_details_extended_list->Extended_Price->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Extended_Price" class="<?php echo $order_details_extended_list->Extended_Price->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_list->SortUrl($order_details_extended_list->Extended_Price) ?>', 1);"><div id="elh_order_details_extended_Extended_Price" class="order_details_extended_Extended_Price">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_list->Extended_Price->caption() ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_list->Extended_Price->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_list->Extended_Price->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$order_details_extended_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($order_details_extended_list->ExportAll && $order_details_extended_list->isExport()) {
	$order_details_extended_list->StopRecord = $order_details_extended_list->TotalRecords;
} else {

	// Set the last record to display
	if ($order_details_extended_list->TotalRecords > $order_details_extended_list->StartRecord + $order_details_extended_list->DisplayRecords - 1)
		$order_details_extended_list->StopRecord = $order_details_extended_list->StartRecord + $order_details_extended_list->DisplayRecords - 1;
	else
		$order_details_extended_list->StopRecord = $order_details_extended_list->TotalRecords;
}
$order_details_extended_list->RecordCount = $order_details_extended_list->StartRecord - 1;
if ($order_details_extended_list->Recordset && !$order_details_extended_list->Recordset->EOF) {
	$order_details_extended_list->Recordset->moveFirst();
	$selectLimit = $order_details_extended_list->UseSelectLimit;
	if (!$selectLimit && $order_details_extended_list->StartRecord > 1)
		$order_details_extended_list->Recordset->move($order_details_extended_list->StartRecord - 1);
} elseif (!$order_details_extended->AllowAddDeleteRow && $order_details_extended_list->StopRecord == 0) {
	$order_details_extended_list->StopRecord = $order_details_extended->GridAddRowCount;
}

// Initialize aggregate
$order_details_extended->RowType = ROWTYPE_AGGREGATEINIT;
$order_details_extended->resetAttributes();
$order_details_extended_list->renderRow();
while ($order_details_extended_list->RecordCount < $order_details_extended_list->StopRecord) {
	$order_details_extended_list->RecordCount++;
	if ($order_details_extended_list->RecordCount >= $order_details_extended_list->StartRecord) {
		$order_details_extended_list->RowCount++;

		// Set up key count
		$order_details_extended_list->KeyCount = $order_details_extended_list->RowIndex;

		// Init row class and style
		$order_details_extended->resetAttributes();
		$order_details_extended->CssClass = "";
		if ($order_details_extended_list->isGridAdd()) {
		} else {
			$order_details_extended_list->loadRowValues($order_details_extended_list->Recordset); // Load row values
		}
		$order_details_extended->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$order_details_extended->RowAttrs->merge(["data-rowindex" => $order_details_extended_list->RowCount, "id" => "r" . $order_details_extended_list->RowCount . "_order_details_extended", "data-rowtype" => $order_details_extended->RowType]);

		// Render row
		$order_details_extended_list->renderRow();

		// Render list options
		$order_details_extended_list->renderListOptions();
?>
	<tr <?php echo $order_details_extended->rowAttributes() ?>>
<?php

// Render list options (body, left)
$order_details_extended_list->ListOptions->render("body", "left", $order_details_extended_list->RowCount);
?>
	<?php if ($order_details_extended_list->CompanyName->Visible) { // CompanyName ?>
		<td data-name="CompanyName" <?php echo $order_details_extended_list->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_list->RowCount ?>_order_details_extended_CompanyName">
<span<?php echo $order_details_extended_list->CompanyName->viewAttributes() ?>><?php echo $order_details_extended_list->CompanyName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_list->OrderID->Visible) { // OrderID ?>
		<td data-name="OrderID" <?php echo $order_details_extended_list->OrderID->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_list->RowCount ?>_order_details_extended_OrderID">
<span<?php echo $order_details_extended_list->OrderID->viewAttributes() ?>><?php echo $order_details_extended_list->OrderID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_list->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" <?php echo $order_details_extended_list->ProductName->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_list->RowCount ?>_order_details_extended_ProductName">
<span<?php echo $order_details_extended_list->ProductName->viewAttributes() ?>><?php echo $order_details_extended_list->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_list->UnitPrice->Visible) { // UnitPrice ?>
		<td data-name="UnitPrice" <?php echo $order_details_extended_list->UnitPrice->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_list->RowCount ?>_order_details_extended_UnitPrice">
<span<?php echo $order_details_extended_list->UnitPrice->viewAttributes() ?>><?php echo $order_details_extended_list->UnitPrice->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_list->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity" <?php echo $order_details_extended_list->Quantity->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_list->RowCount ?>_order_details_extended_Quantity">
<span<?php echo $order_details_extended_list->Quantity->viewAttributes() ?>><?php echo $order_details_extended_list->Quantity->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_list->Discount->Visible) { // Discount ?>
		<td data-name="Discount" <?php echo $order_details_extended_list->Discount->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_list->RowCount ?>_order_details_extended_Discount">
<span<?php echo $order_details_extended_list->Discount->viewAttributes() ?>><?php echo $order_details_extended_list->Discount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_list->Extended_Price->Visible) { // Extended Price ?>
		<td data-name="Extended_Price" <?php echo $order_details_extended_list->Extended_Price->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_list->RowCount ?>_order_details_extended_Extended_Price">
<span<?php echo $order_details_extended_list->Extended_Price->viewAttributes() ?>><?php echo $order_details_extended_list->Extended_Price->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$order_details_extended_list->ListOptions->render("body", "right", $order_details_extended_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$order_details_extended_list->isGridAdd())
		$order_details_extended_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$order_details_extended->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($order_details_extended_list->Recordset)
	$order_details_extended_list->Recordset->Close();
?>
<?php if (!$order_details_extended_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$order_details_extended_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $order_details_extended_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $order_details_extended_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($order_details_extended_list->TotalRecords == 0 && !$order_details_extended->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $order_details_extended_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$order_details_extended_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$order_details_extended_list->isExport()) { ?>
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
$order_details_extended_list->terminate();
?>