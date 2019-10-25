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
$products_by_category_list = new products_by_category_list();

// Run the page
$products_by_category_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$products_by_category_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$products_by_category_list->isExport()) { ?>
<script>
var fproducts_by_categorylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fproducts_by_categorylist = currentForm = new ew.Form("fproducts_by_categorylist", "list");
	fproducts_by_categorylist.formKeyCountName = '<?php echo $products_by_category_list->FormKeyCountName ?>';
	loadjs.done("fproducts_by_categorylist");
});
var fproducts_by_categorylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fproducts_by_categorylistsrch = currentSearchForm = new ew.Form("fproducts_by_categorylistsrch");

	// Dynamic selection lists
	// Filters

	fproducts_by_categorylistsrch.filterList = <?php echo $products_by_category_list->getFilterList() ?>;
	loadjs.done("fproducts_by_categorylistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$products_by_category_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($products_by_category_list->TotalRecords > 0 && $products_by_category_list->ExportOptions->visible()) { ?>
<?php $products_by_category_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($products_by_category_list->ImportOptions->visible()) { ?>
<?php $products_by_category_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($products_by_category_list->SearchOptions->visible()) { ?>
<?php $products_by_category_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($products_by_category_list->FilterOptions->visible()) { ?>
<?php $products_by_category_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$products_by_category_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$products_by_category_list->isExport() && !$products_by_category->CurrentAction) { ?>
<form name="fproducts_by_categorylistsrch" id="fproducts_by_categorylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fproducts_by_categorylistsrch-search-panel" class="<?php echo $products_by_category_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="products_by_category">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $products_by_category_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($products_by_category_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($products_by_category_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $products_by_category_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($products_by_category_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($products_by_category_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($products_by_category_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($products_by_category_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $products_by_category_list->showPageHeader(); ?>
<?php
$products_by_category_list->showMessage();
?>
<?php if ($products_by_category_list->TotalRecords > 0 || $products_by_category->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($products_by_category_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> products_by_category">
<form name="fproducts_by_categorylist" id="fproducts_by_categorylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="products_by_category">
<div id="gmp_products_by_category" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($products_by_category_list->TotalRecords > 0 || $products_by_category_list->isGridEdit()) { ?>
<table id="tbl_products_by_categorylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$products_by_category->RowType = ROWTYPE_HEADER;

// Render list options
$products_by_category_list->renderListOptions();

// Render list options (header, left)
$products_by_category_list->ListOptions->render("header", "left");
?>
<?php if ($products_by_category_list->CategoryName->Visible) { // CategoryName ?>
	<?php if ($products_by_category_list->SortUrl($products_by_category_list->CategoryName) == "") { ?>
		<th data-name="CategoryName" class="<?php echo $products_by_category_list->CategoryName->headerCellClass() ?>"><div id="elh_products_by_category_CategoryName" class="products_by_category_CategoryName"><div class="ew-table-header-caption"><?php echo $products_by_category_list->CategoryName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CategoryName" class="<?php echo $products_by_category_list->CategoryName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $products_by_category_list->SortUrl($products_by_category_list->CategoryName) ?>', 1);"><div id="elh_products_by_category_CategoryName" class="products_by_category_CategoryName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $products_by_category_list->CategoryName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($products_by_category_list->CategoryName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($products_by_category_list->CategoryName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($products_by_category_list->ProductName->Visible) { // ProductName ?>
	<?php if ($products_by_category_list->SortUrl($products_by_category_list->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $products_by_category_list->ProductName->headerCellClass() ?>"><div id="elh_products_by_category_ProductName" class="products_by_category_ProductName"><div class="ew-table-header-caption"><?php echo $products_by_category_list->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $products_by_category_list->ProductName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $products_by_category_list->SortUrl($products_by_category_list->ProductName) ?>', 1);"><div id="elh_products_by_category_ProductName" class="products_by_category_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $products_by_category_list->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($products_by_category_list->ProductName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($products_by_category_list->ProductName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($products_by_category_list->QuantityPerUnit->Visible) { // QuantityPerUnit ?>
	<?php if ($products_by_category_list->SortUrl($products_by_category_list->QuantityPerUnit) == "") { ?>
		<th data-name="QuantityPerUnit" class="<?php echo $products_by_category_list->QuantityPerUnit->headerCellClass() ?>"><div id="elh_products_by_category_QuantityPerUnit" class="products_by_category_QuantityPerUnit"><div class="ew-table-header-caption"><?php echo $products_by_category_list->QuantityPerUnit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="QuantityPerUnit" class="<?php echo $products_by_category_list->QuantityPerUnit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $products_by_category_list->SortUrl($products_by_category_list->QuantityPerUnit) ?>', 1);"><div id="elh_products_by_category_QuantityPerUnit" class="products_by_category_QuantityPerUnit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $products_by_category_list->QuantityPerUnit->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($products_by_category_list->QuantityPerUnit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($products_by_category_list->QuantityPerUnit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($products_by_category_list->UnitsInStock->Visible) { // UnitsInStock ?>
	<?php if ($products_by_category_list->SortUrl($products_by_category_list->UnitsInStock) == "") { ?>
		<th data-name="UnitsInStock" class="<?php echo $products_by_category_list->UnitsInStock->headerCellClass() ?>"><div id="elh_products_by_category_UnitsInStock" class="products_by_category_UnitsInStock"><div class="ew-table-header-caption"><?php echo $products_by_category_list->UnitsInStock->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitsInStock" class="<?php echo $products_by_category_list->UnitsInStock->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $products_by_category_list->SortUrl($products_by_category_list->UnitsInStock) ?>', 1);"><div id="elh_products_by_category_UnitsInStock" class="products_by_category_UnitsInStock">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $products_by_category_list->UnitsInStock->caption() ?></span><span class="ew-table-header-sort"><?php if ($products_by_category_list->UnitsInStock->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($products_by_category_list->UnitsInStock->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($products_by_category_list->Discontinued->Visible) { // Discontinued ?>
	<?php if ($products_by_category_list->SortUrl($products_by_category_list->Discontinued) == "") { ?>
		<th data-name="Discontinued" class="<?php echo $products_by_category_list->Discontinued->headerCellClass() ?>"><div id="elh_products_by_category_Discontinued" class="products_by_category_Discontinued"><div class="ew-table-header-caption"><?php echo $products_by_category_list->Discontinued->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Discontinued" class="<?php echo $products_by_category_list->Discontinued->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $products_by_category_list->SortUrl($products_by_category_list->Discontinued) ?>', 1);"><div id="elh_products_by_category_Discontinued" class="products_by_category_Discontinued">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $products_by_category_list->Discontinued->caption() ?></span><span class="ew-table-header-sort"><?php if ($products_by_category_list->Discontinued->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($products_by_category_list->Discontinued->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$products_by_category_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($products_by_category_list->ExportAll && $products_by_category_list->isExport()) {
	$products_by_category_list->StopRecord = $products_by_category_list->TotalRecords;
} else {

	// Set the last record to display
	if ($products_by_category_list->TotalRecords > $products_by_category_list->StartRecord + $products_by_category_list->DisplayRecords - 1)
		$products_by_category_list->StopRecord = $products_by_category_list->StartRecord + $products_by_category_list->DisplayRecords - 1;
	else
		$products_by_category_list->StopRecord = $products_by_category_list->TotalRecords;
}
$products_by_category_list->RecordCount = $products_by_category_list->StartRecord - 1;
if ($products_by_category_list->Recordset && !$products_by_category_list->Recordset->EOF) {
	$products_by_category_list->Recordset->moveFirst();
	$selectLimit = $products_by_category_list->UseSelectLimit;
	if (!$selectLimit && $products_by_category_list->StartRecord > 1)
		$products_by_category_list->Recordset->move($products_by_category_list->StartRecord - 1);
} elseif (!$products_by_category->AllowAddDeleteRow && $products_by_category_list->StopRecord == 0) {
	$products_by_category_list->StopRecord = $products_by_category->GridAddRowCount;
}

// Initialize aggregate
$products_by_category->RowType = ROWTYPE_AGGREGATEINIT;
$products_by_category->resetAttributes();
$products_by_category_list->renderRow();
while ($products_by_category_list->RecordCount < $products_by_category_list->StopRecord) {
	$products_by_category_list->RecordCount++;
	if ($products_by_category_list->RecordCount >= $products_by_category_list->StartRecord) {
		$products_by_category_list->RowCount++;

		// Set up key count
		$products_by_category_list->KeyCount = $products_by_category_list->RowIndex;

		// Init row class and style
		$products_by_category->resetAttributes();
		$products_by_category->CssClass = "";
		if ($products_by_category_list->isGridAdd()) {
		} else {
			$products_by_category_list->loadRowValues($products_by_category_list->Recordset); // Load row values
		}
		$products_by_category->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$products_by_category->RowAttrs->merge(["data-rowindex" => $products_by_category_list->RowCount, "id" => "r" . $products_by_category_list->RowCount . "_products_by_category", "data-rowtype" => $products_by_category->RowType]);

		// Render row
		$products_by_category_list->renderRow();

		// Render list options
		$products_by_category_list->renderListOptions();
?>
	<tr <?php echo $products_by_category->rowAttributes() ?>>
<?php

// Render list options (body, left)
$products_by_category_list->ListOptions->render("body", "left", $products_by_category_list->RowCount);
?>
	<?php if ($products_by_category_list->CategoryName->Visible) { // CategoryName ?>
		<td data-name="CategoryName" <?php echo $products_by_category_list->CategoryName->cellAttributes() ?>>
<span id="el<?php echo $products_by_category_list->RowCount ?>_products_by_category_CategoryName">
<span<?php echo $products_by_category_list->CategoryName->viewAttributes() ?>><?php echo $products_by_category_list->CategoryName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($products_by_category_list->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" <?php echo $products_by_category_list->ProductName->cellAttributes() ?>>
<span id="el<?php echo $products_by_category_list->RowCount ?>_products_by_category_ProductName">
<span<?php echo $products_by_category_list->ProductName->viewAttributes() ?>><?php echo $products_by_category_list->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($products_by_category_list->QuantityPerUnit->Visible) { // QuantityPerUnit ?>
		<td data-name="QuantityPerUnit" <?php echo $products_by_category_list->QuantityPerUnit->cellAttributes() ?>>
<span id="el<?php echo $products_by_category_list->RowCount ?>_products_by_category_QuantityPerUnit">
<span<?php echo $products_by_category_list->QuantityPerUnit->viewAttributes() ?>><?php echo $products_by_category_list->QuantityPerUnit->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($products_by_category_list->UnitsInStock->Visible) { // UnitsInStock ?>
		<td data-name="UnitsInStock" <?php echo $products_by_category_list->UnitsInStock->cellAttributes() ?>>
<span id="el<?php echo $products_by_category_list->RowCount ?>_products_by_category_UnitsInStock">
<span<?php echo $products_by_category_list->UnitsInStock->viewAttributes() ?>><?php echo $products_by_category_list->UnitsInStock->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($products_by_category_list->Discontinued->Visible) { // Discontinued ?>
		<td data-name="Discontinued" <?php echo $products_by_category_list->Discontinued->cellAttributes() ?>>
<span id="el<?php echo $products_by_category_list->RowCount ?>_products_by_category_Discontinued">
<span<?php echo $products_by_category_list->Discontinued->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_Discontinued" class="custom-control-input" value="<?php echo $products_by_category_list->Discontinued->getViewValue() ?>" disabled<?php if (ConvertToBool($products_by_category_list->Discontinued->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_Discontinued"></label></div></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$products_by_category_list->ListOptions->render("body", "right", $products_by_category_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$products_by_category_list->isGridAdd())
		$products_by_category_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$products_by_category->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($products_by_category_list->Recordset)
	$products_by_category_list->Recordset->Close();
?>
<?php if (!$products_by_category_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$products_by_category_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $products_by_category_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $products_by_category_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($products_by_category_list->TotalRecords == 0 && !$products_by_category->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $products_by_category_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$products_by_category_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$products_by_category_list->isExport()) { ?>
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
$products_by_category_list->terminate();
?>