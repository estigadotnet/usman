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
$orders_by_product_list = new orders_by_product_list();

// Run the page
$orders_by_product_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_by_product_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$orders_by_product_list->isExport()) { ?>
<script>
var forders_by_productlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	forders_by_productlist = currentForm = new ew.Form("forders_by_productlist", "list");
	forders_by_productlist.formKeyCountName = '<?php echo $orders_by_product_list->FormKeyCountName ?>';
	loadjs.done("forders_by_productlist");
});
var forders_by_productlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	forders_by_productlistsrch = currentSearchForm = new ew.Form("forders_by_productlistsrch");

	// Dynamic selection lists
	// Filters

	forders_by_productlistsrch.filterList = <?php echo $orders_by_product_list->getFilterList() ?>;
	loadjs.done("forders_by_productlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$orders_by_product_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($orders_by_product_list->TotalRecords > 0 && $orders_by_product_list->ExportOptions->visible()) { ?>
<?php $orders_by_product_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($orders_by_product_list->ImportOptions->visible()) { ?>
<?php $orders_by_product_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($orders_by_product_list->SearchOptions->visible()) { ?>
<?php $orders_by_product_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($orders_by_product_list->FilterOptions->visible()) { ?>
<?php $orders_by_product_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$orders_by_product_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$orders_by_product_list->isExport() && !$orders_by_product->CurrentAction) { ?>
<form name="forders_by_productlistsrch" id="forders_by_productlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="forders_by_productlistsrch-search-panel" class="<?php echo $orders_by_product_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="orders_by_product">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $orders_by_product_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($orders_by_product_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($orders_by_product_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $orders_by_product_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($orders_by_product_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($orders_by_product_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($orders_by_product_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($orders_by_product_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $orders_by_product_list->showPageHeader(); ?>
<?php
$orders_by_product_list->showMessage();
?>
<?php if ($orders_by_product_list->TotalRecords > 0 || $orders_by_product->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($orders_by_product_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> orders_by_product">
<form name="forders_by_productlist" id="forders_by_productlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders_by_product">
<div id="gmp_orders_by_product" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($orders_by_product_list->TotalRecords > 0 || $orders_by_product_list->isGridEdit()) { ?>
<table id="tbl_orders_by_productlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$orders_by_product->RowType = ROWTYPE_HEADER;

// Render list options
$orders_by_product_list->renderListOptions();

// Render list options (header, left)
$orders_by_product_list->ListOptions->render("header", "left");
?>
<?php if ($orders_by_product_list->CategoryName->Visible) { // CategoryName ?>
	<?php if ($orders_by_product_list->SortUrl($orders_by_product_list->CategoryName) == "") { ?>
		<th data-name="CategoryName" class="<?php echo $orders_by_product_list->CategoryName->headerCellClass() ?>"><div id="elh_orders_by_product_CategoryName" class="orders_by_product_CategoryName"><div class="ew-table-header-caption"><?php echo $orders_by_product_list->CategoryName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CategoryName" class="<?php echo $orders_by_product_list->CategoryName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_by_product_list->SortUrl($orders_by_product_list->CategoryName) ?>', 1);"><div id="elh_orders_by_product_CategoryName" class="orders_by_product_CategoryName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_by_product_list->CategoryName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders_by_product_list->CategoryName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_by_product_list->CategoryName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_by_product_list->ProductName->Visible) { // ProductName ?>
	<?php if ($orders_by_product_list->SortUrl($orders_by_product_list->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $orders_by_product_list->ProductName->headerCellClass() ?>"><div id="elh_orders_by_product_ProductName" class="orders_by_product_ProductName"><div class="ew-table-header-caption"><?php echo $orders_by_product_list->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $orders_by_product_list->ProductName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_by_product_list->SortUrl($orders_by_product_list->ProductName) ?>', 1);"><div id="elh_orders_by_product_ProductName" class="orders_by_product_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_by_product_list->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders_by_product_list->ProductName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_by_product_list->ProductName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_by_product_list->CompanyName->Visible) { // CompanyName ?>
	<?php if ($orders_by_product_list->SortUrl($orders_by_product_list->CompanyName) == "") { ?>
		<th data-name="CompanyName" class="<?php echo $orders_by_product_list->CompanyName->headerCellClass() ?>"><div id="elh_orders_by_product_CompanyName" class="orders_by_product_CompanyName"><div class="ew-table-header-caption"><?php echo $orders_by_product_list->CompanyName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CompanyName" class="<?php echo $orders_by_product_list->CompanyName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_by_product_list->SortUrl($orders_by_product_list->CompanyName) ?>', 1);"><div id="elh_orders_by_product_CompanyName" class="orders_by_product_CompanyName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_by_product_list->CompanyName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders_by_product_list->CompanyName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_by_product_list->CompanyName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_by_product_list->OrderDate->Visible) { // OrderDate ?>
	<?php if ($orders_by_product_list->SortUrl($orders_by_product_list->OrderDate) == "") { ?>
		<th data-name="OrderDate" class="<?php echo $orders_by_product_list->OrderDate->headerCellClass() ?>"><div id="elh_orders_by_product_OrderDate" class="orders_by_product_OrderDate"><div class="ew-table-header-caption"><?php echo $orders_by_product_list->OrderDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderDate" class="<?php echo $orders_by_product_list->OrderDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_by_product_list->SortUrl($orders_by_product_list->OrderDate) ?>', 1);"><div id="elh_orders_by_product_OrderDate" class="orders_by_product_OrderDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_by_product_list->OrderDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders_by_product_list->OrderDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_by_product_list->OrderDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_by_product_list->Amount->Visible) { // Amount ?>
	<?php if ($orders_by_product_list->SortUrl($orders_by_product_list->Amount) == "") { ?>
		<th data-name="Amount" class="<?php echo $orders_by_product_list->Amount->headerCellClass() ?>"><div id="elh_orders_by_product_Amount" class="orders_by_product_Amount"><div class="ew-table-header-caption"><?php echo $orders_by_product_list->Amount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Amount" class="<?php echo $orders_by_product_list->Amount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_by_product_list->SortUrl($orders_by_product_list->Amount) ?>', 1);"><div id="elh_orders_by_product_Amount" class="orders_by_product_Amount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_by_product_list->Amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders_by_product_list->Amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_by_product_list->Amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$orders_by_product_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($orders_by_product_list->ExportAll && $orders_by_product_list->isExport()) {
	$orders_by_product_list->StopRecord = $orders_by_product_list->TotalRecords;
} else {

	// Set the last record to display
	if ($orders_by_product_list->TotalRecords > $orders_by_product_list->StartRecord + $orders_by_product_list->DisplayRecords - 1)
		$orders_by_product_list->StopRecord = $orders_by_product_list->StartRecord + $orders_by_product_list->DisplayRecords - 1;
	else
		$orders_by_product_list->StopRecord = $orders_by_product_list->TotalRecords;
}
$orders_by_product_list->RecordCount = $orders_by_product_list->StartRecord - 1;
if ($orders_by_product_list->Recordset && !$orders_by_product_list->Recordset->EOF) {
	$orders_by_product_list->Recordset->moveFirst();
	$selectLimit = $orders_by_product_list->UseSelectLimit;
	if (!$selectLimit && $orders_by_product_list->StartRecord > 1)
		$orders_by_product_list->Recordset->move($orders_by_product_list->StartRecord - 1);
} elseif (!$orders_by_product->AllowAddDeleteRow && $orders_by_product_list->StopRecord == 0) {
	$orders_by_product_list->StopRecord = $orders_by_product->GridAddRowCount;
}

// Initialize aggregate
$orders_by_product->RowType = ROWTYPE_AGGREGATEINIT;
$orders_by_product->resetAttributes();
$orders_by_product_list->renderRow();
while ($orders_by_product_list->RecordCount < $orders_by_product_list->StopRecord) {
	$orders_by_product_list->RecordCount++;
	if ($orders_by_product_list->RecordCount >= $orders_by_product_list->StartRecord) {
		$orders_by_product_list->RowCount++;

		// Set up key count
		$orders_by_product_list->KeyCount = $orders_by_product_list->RowIndex;

		// Init row class and style
		$orders_by_product->resetAttributes();
		$orders_by_product->CssClass = "";
		if ($orders_by_product_list->isGridAdd()) {
		} else {
			$orders_by_product_list->loadRowValues($orders_by_product_list->Recordset); // Load row values
		}
		$orders_by_product->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$orders_by_product->RowAttrs->merge(["data-rowindex" => $orders_by_product_list->RowCount, "id" => "r" . $orders_by_product_list->RowCount . "_orders_by_product", "data-rowtype" => $orders_by_product->RowType]);

		// Render row
		$orders_by_product_list->renderRow();

		// Render list options
		$orders_by_product_list->renderListOptions();
?>
	<tr <?php echo $orders_by_product->rowAttributes() ?>>
<?php

// Render list options (body, left)
$orders_by_product_list->ListOptions->render("body", "left", $orders_by_product_list->RowCount);
?>
	<?php if ($orders_by_product_list->CategoryName->Visible) { // CategoryName ?>
		<td data-name="CategoryName" <?php echo $orders_by_product_list->CategoryName->cellAttributes() ?>>
<span id="el<?php echo $orders_by_product_list->RowCount ?>_orders_by_product_CategoryName">
<span<?php echo $orders_by_product_list->CategoryName->viewAttributes() ?>><?php echo $orders_by_product_list->CategoryName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_by_product_list->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" <?php echo $orders_by_product_list->ProductName->cellAttributes() ?>>
<span id="el<?php echo $orders_by_product_list->RowCount ?>_orders_by_product_ProductName">
<span<?php echo $orders_by_product_list->ProductName->viewAttributes() ?>><?php echo $orders_by_product_list->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_by_product_list->CompanyName->Visible) { // CompanyName ?>
		<td data-name="CompanyName" <?php echo $orders_by_product_list->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $orders_by_product_list->RowCount ?>_orders_by_product_CompanyName">
<span<?php echo $orders_by_product_list->CompanyName->viewAttributes() ?>><?php echo $orders_by_product_list->CompanyName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_by_product_list->OrderDate->Visible) { // OrderDate ?>
		<td data-name="OrderDate" <?php echo $orders_by_product_list->OrderDate->cellAttributes() ?>>
<span id="el<?php echo $orders_by_product_list->RowCount ?>_orders_by_product_OrderDate">
<span<?php echo $orders_by_product_list->OrderDate->viewAttributes() ?>><?php echo $orders_by_product_list->OrderDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_by_product_list->Amount->Visible) { // Amount ?>
		<td data-name="Amount" <?php echo $orders_by_product_list->Amount->cellAttributes() ?>>
<span id="el<?php echo $orders_by_product_list->RowCount ?>_orders_by_product_Amount">
<span<?php echo $orders_by_product_list->Amount->viewAttributes() ?>><?php echo $orders_by_product_list->Amount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$orders_by_product_list->ListOptions->render("body", "right", $orders_by_product_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$orders_by_product_list->isGridAdd())
		$orders_by_product_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$orders_by_product->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($orders_by_product_list->Recordset)
	$orders_by_product_list->Recordset->Close();
?>
<?php if (!$orders_by_product_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$orders_by_product_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $orders_by_product_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $orders_by_product_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($orders_by_product_list->TotalRecords == 0 && !$orders_by_product->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $orders_by_product_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$orders_by_product_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$orders_by_product_list->isExport()) { ?>
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
$orders_by_product_list->terminate();
?>