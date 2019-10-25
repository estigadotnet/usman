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
$product_sales_for_1997_list = new product_sales_for_1997_list();

// Run the page
$product_sales_for_1997_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$product_sales_for_1997_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$product_sales_for_1997_list->isExport()) { ?>
<script>
var fproduct_sales_for_1997list, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fproduct_sales_for_1997list = currentForm = new ew.Form("fproduct_sales_for_1997list", "list");
	fproduct_sales_for_1997list.formKeyCountName = '<?php echo $product_sales_for_1997_list->FormKeyCountName ?>';
	loadjs.done("fproduct_sales_for_1997list");
});
var fproduct_sales_for_1997listsrch;
loadjs.ready("head", function() {

	// Form object for search
	fproduct_sales_for_1997listsrch = currentSearchForm = new ew.Form("fproduct_sales_for_1997listsrch");

	// Dynamic selection lists
	// Filters

	fproduct_sales_for_1997listsrch.filterList = <?php echo $product_sales_for_1997_list->getFilterList() ?>;
	loadjs.done("fproduct_sales_for_1997listsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$product_sales_for_1997_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($product_sales_for_1997_list->TotalRecords > 0 && $product_sales_for_1997_list->ExportOptions->visible()) { ?>
<?php $product_sales_for_1997_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($product_sales_for_1997_list->ImportOptions->visible()) { ?>
<?php $product_sales_for_1997_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($product_sales_for_1997_list->SearchOptions->visible()) { ?>
<?php $product_sales_for_1997_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($product_sales_for_1997_list->FilterOptions->visible()) { ?>
<?php $product_sales_for_1997_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$product_sales_for_1997_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$product_sales_for_1997_list->isExport() && !$product_sales_for_1997->CurrentAction) { ?>
<form name="fproduct_sales_for_1997listsrch" id="fproduct_sales_for_1997listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fproduct_sales_for_1997listsrch-search-panel" class="<?php echo $product_sales_for_1997_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="product_sales_for_1997">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $product_sales_for_1997_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($product_sales_for_1997_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($product_sales_for_1997_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $product_sales_for_1997_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($product_sales_for_1997_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($product_sales_for_1997_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($product_sales_for_1997_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($product_sales_for_1997_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $product_sales_for_1997_list->showPageHeader(); ?>
<?php
$product_sales_for_1997_list->showMessage();
?>
<?php if ($product_sales_for_1997_list->TotalRecords > 0 || $product_sales_for_1997->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($product_sales_for_1997_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> product_sales_for_1997">
<form name="fproduct_sales_for_1997list" id="fproduct_sales_for_1997list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="product_sales_for_1997">
<div id="gmp_product_sales_for_1997" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($product_sales_for_1997_list->TotalRecords > 0 || $product_sales_for_1997_list->isGridEdit()) { ?>
<table id="tbl_product_sales_for_1997list" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$product_sales_for_1997->RowType = ROWTYPE_HEADER;

// Render list options
$product_sales_for_1997_list->renderListOptions();

// Render list options (header, left)
$product_sales_for_1997_list->ListOptions->render("header", "left");
?>
<?php if ($product_sales_for_1997_list->CategoryName->Visible) { // CategoryName ?>
	<?php if ($product_sales_for_1997_list->SortUrl($product_sales_for_1997_list->CategoryName) == "") { ?>
		<th data-name="CategoryName" class="<?php echo $product_sales_for_1997_list->CategoryName->headerCellClass() ?>"><div id="elh_product_sales_for_1997_CategoryName" class="product_sales_for_1997_CategoryName"><div class="ew-table-header-caption"><?php echo $product_sales_for_1997_list->CategoryName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CategoryName" class="<?php echo $product_sales_for_1997_list->CategoryName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $product_sales_for_1997_list->SortUrl($product_sales_for_1997_list->CategoryName) ?>', 1);"><div id="elh_product_sales_for_1997_CategoryName" class="product_sales_for_1997_CategoryName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $product_sales_for_1997_list->CategoryName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($product_sales_for_1997_list->CategoryName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($product_sales_for_1997_list->CategoryName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($product_sales_for_1997_list->ProductName->Visible) { // ProductName ?>
	<?php if ($product_sales_for_1997_list->SortUrl($product_sales_for_1997_list->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $product_sales_for_1997_list->ProductName->headerCellClass() ?>"><div id="elh_product_sales_for_1997_ProductName" class="product_sales_for_1997_ProductName"><div class="ew-table-header-caption"><?php echo $product_sales_for_1997_list->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $product_sales_for_1997_list->ProductName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $product_sales_for_1997_list->SortUrl($product_sales_for_1997_list->ProductName) ?>', 1);"><div id="elh_product_sales_for_1997_ProductName" class="product_sales_for_1997_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $product_sales_for_1997_list->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($product_sales_for_1997_list->ProductName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($product_sales_for_1997_list->ProductName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($product_sales_for_1997_list->ProductSales->Visible) { // ProductSales ?>
	<?php if ($product_sales_for_1997_list->SortUrl($product_sales_for_1997_list->ProductSales) == "") { ?>
		<th data-name="ProductSales" class="<?php echo $product_sales_for_1997_list->ProductSales->headerCellClass() ?>"><div id="elh_product_sales_for_1997_ProductSales" class="product_sales_for_1997_ProductSales"><div class="ew-table-header-caption"><?php echo $product_sales_for_1997_list->ProductSales->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductSales" class="<?php echo $product_sales_for_1997_list->ProductSales->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $product_sales_for_1997_list->SortUrl($product_sales_for_1997_list->ProductSales) ?>', 1);"><div id="elh_product_sales_for_1997_ProductSales" class="product_sales_for_1997_ProductSales">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $product_sales_for_1997_list->ProductSales->caption() ?></span><span class="ew-table-header-sort"><?php if ($product_sales_for_1997_list->ProductSales->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($product_sales_for_1997_list->ProductSales->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$product_sales_for_1997_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($product_sales_for_1997_list->ExportAll && $product_sales_for_1997_list->isExport()) {
	$product_sales_for_1997_list->StopRecord = $product_sales_for_1997_list->TotalRecords;
} else {

	// Set the last record to display
	if ($product_sales_for_1997_list->TotalRecords > $product_sales_for_1997_list->StartRecord + $product_sales_for_1997_list->DisplayRecords - 1)
		$product_sales_for_1997_list->StopRecord = $product_sales_for_1997_list->StartRecord + $product_sales_for_1997_list->DisplayRecords - 1;
	else
		$product_sales_for_1997_list->StopRecord = $product_sales_for_1997_list->TotalRecords;
}
$product_sales_for_1997_list->RecordCount = $product_sales_for_1997_list->StartRecord - 1;
if ($product_sales_for_1997_list->Recordset && !$product_sales_for_1997_list->Recordset->EOF) {
	$product_sales_for_1997_list->Recordset->moveFirst();
	$selectLimit = $product_sales_for_1997_list->UseSelectLimit;
	if (!$selectLimit && $product_sales_for_1997_list->StartRecord > 1)
		$product_sales_for_1997_list->Recordset->move($product_sales_for_1997_list->StartRecord - 1);
} elseif (!$product_sales_for_1997->AllowAddDeleteRow && $product_sales_for_1997_list->StopRecord == 0) {
	$product_sales_for_1997_list->StopRecord = $product_sales_for_1997->GridAddRowCount;
}

// Initialize aggregate
$product_sales_for_1997->RowType = ROWTYPE_AGGREGATEINIT;
$product_sales_for_1997->resetAttributes();
$product_sales_for_1997_list->renderRow();
while ($product_sales_for_1997_list->RecordCount < $product_sales_for_1997_list->StopRecord) {
	$product_sales_for_1997_list->RecordCount++;
	if ($product_sales_for_1997_list->RecordCount >= $product_sales_for_1997_list->StartRecord) {
		$product_sales_for_1997_list->RowCount++;

		// Set up key count
		$product_sales_for_1997_list->KeyCount = $product_sales_for_1997_list->RowIndex;

		// Init row class and style
		$product_sales_for_1997->resetAttributes();
		$product_sales_for_1997->CssClass = "";
		if ($product_sales_for_1997_list->isGridAdd()) {
		} else {
			$product_sales_for_1997_list->loadRowValues($product_sales_for_1997_list->Recordset); // Load row values
		}
		$product_sales_for_1997->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$product_sales_for_1997->RowAttrs->merge(["data-rowindex" => $product_sales_for_1997_list->RowCount, "id" => "r" . $product_sales_for_1997_list->RowCount . "_product_sales_for_1997", "data-rowtype" => $product_sales_for_1997->RowType]);

		// Render row
		$product_sales_for_1997_list->renderRow();

		// Render list options
		$product_sales_for_1997_list->renderListOptions();
?>
	<tr <?php echo $product_sales_for_1997->rowAttributes() ?>>
<?php

// Render list options (body, left)
$product_sales_for_1997_list->ListOptions->render("body", "left", $product_sales_for_1997_list->RowCount);
?>
	<?php if ($product_sales_for_1997_list->CategoryName->Visible) { // CategoryName ?>
		<td data-name="CategoryName" <?php echo $product_sales_for_1997_list->CategoryName->cellAttributes() ?>>
<span id="el<?php echo $product_sales_for_1997_list->RowCount ?>_product_sales_for_1997_CategoryName">
<span<?php echo $product_sales_for_1997_list->CategoryName->viewAttributes() ?>><?php echo $product_sales_for_1997_list->CategoryName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($product_sales_for_1997_list->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" <?php echo $product_sales_for_1997_list->ProductName->cellAttributes() ?>>
<span id="el<?php echo $product_sales_for_1997_list->RowCount ?>_product_sales_for_1997_ProductName">
<span<?php echo $product_sales_for_1997_list->ProductName->viewAttributes() ?>><?php echo $product_sales_for_1997_list->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($product_sales_for_1997_list->ProductSales->Visible) { // ProductSales ?>
		<td data-name="ProductSales" <?php echo $product_sales_for_1997_list->ProductSales->cellAttributes() ?>>
<span id="el<?php echo $product_sales_for_1997_list->RowCount ?>_product_sales_for_1997_ProductSales">
<span<?php echo $product_sales_for_1997_list->ProductSales->viewAttributes() ?>><?php echo $product_sales_for_1997_list->ProductSales->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$product_sales_for_1997_list->ListOptions->render("body", "right", $product_sales_for_1997_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$product_sales_for_1997_list->isGridAdd())
		$product_sales_for_1997_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$product_sales_for_1997->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($product_sales_for_1997_list->Recordset)
	$product_sales_for_1997_list->Recordset->Close();
?>
<?php if (!$product_sales_for_1997_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$product_sales_for_1997_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $product_sales_for_1997_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $product_sales_for_1997_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($product_sales_for_1997_list->TotalRecords == 0 && !$product_sales_for_1997->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $product_sales_for_1997_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$product_sales_for_1997_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$product_sales_for_1997_list->isExport()) { ?>
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
$product_sales_for_1997_list->terminate();
?>