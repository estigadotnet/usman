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
$list_of_products_list = new list_of_products_list();

// Run the page
$list_of_products_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$list_of_products_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$list_of_products_list->isExport()) { ?>
<script>
var flist_of_productslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	flist_of_productslist = currentForm = new ew.Form("flist_of_productslist", "list");
	flist_of_productslist.formKeyCountName = '<?php echo $list_of_products_list->FormKeyCountName ?>';
	loadjs.done("flist_of_productslist");
});
var flist_of_productslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	flist_of_productslistsrch = currentSearchForm = new ew.Form("flist_of_productslistsrch");

	// Dynamic selection lists
	// Filters

	flist_of_productslistsrch.filterList = <?php echo $list_of_products_list->getFilterList() ?>;
	loadjs.done("flist_of_productslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$list_of_products_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($list_of_products_list->TotalRecords > 0 && $list_of_products_list->ExportOptions->visible()) { ?>
<?php $list_of_products_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($list_of_products_list->ImportOptions->visible()) { ?>
<?php $list_of_products_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($list_of_products_list->SearchOptions->visible()) { ?>
<?php $list_of_products_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($list_of_products_list->FilterOptions->visible()) { ?>
<?php $list_of_products_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$list_of_products_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$list_of_products_list->isExport() && !$list_of_products->CurrentAction) { ?>
<form name="flist_of_productslistsrch" id="flist_of_productslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="flist_of_productslistsrch-search-panel" class="<?php echo $list_of_products_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="list_of_products">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $list_of_products_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($list_of_products_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($list_of_products_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $list_of_products_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($list_of_products_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($list_of_products_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($list_of_products_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($list_of_products_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $list_of_products_list->showPageHeader(); ?>
<?php
$list_of_products_list->showMessage();
?>
<?php if ($list_of_products_list->TotalRecords > 0 || $list_of_products->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($list_of_products_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> list_of_products">
<form name="flist_of_productslist" id="flist_of_productslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="list_of_products">
<div id="gmp_list_of_products" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($list_of_products_list->TotalRecords > 0 || $list_of_products_list->isGridEdit()) { ?>
<table id="tbl_list_of_productslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$list_of_products->RowType = ROWTYPE_HEADER;

// Render list options
$list_of_products_list->renderListOptions();

// Render list options (header, left)
$list_of_products_list->ListOptions->render("header", "left");
?>
<?php if ($list_of_products_list->ProductName->Visible) { // ProductName ?>
	<?php if ($list_of_products_list->SortUrl($list_of_products_list->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $list_of_products_list->ProductName->headerCellClass() ?>"><div id="elh_list_of_products_ProductName" class="list_of_products_ProductName"><div class="ew-table-header-caption"><?php echo $list_of_products_list->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $list_of_products_list->ProductName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $list_of_products_list->SortUrl($list_of_products_list->ProductName) ?>', 1);"><div id="elh_list_of_products_ProductName" class="list_of_products_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $list_of_products_list->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($list_of_products_list->ProductName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($list_of_products_list->ProductName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($list_of_products_list->CategoryName->Visible) { // CategoryName ?>
	<?php if ($list_of_products_list->SortUrl($list_of_products_list->CategoryName) == "") { ?>
		<th data-name="CategoryName" class="<?php echo $list_of_products_list->CategoryName->headerCellClass() ?>"><div id="elh_list_of_products_CategoryName" class="list_of_products_CategoryName"><div class="ew-table-header-caption"><?php echo $list_of_products_list->CategoryName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CategoryName" class="<?php echo $list_of_products_list->CategoryName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $list_of_products_list->SortUrl($list_of_products_list->CategoryName) ?>', 1);"><div id="elh_list_of_products_CategoryName" class="list_of_products_CategoryName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $list_of_products_list->CategoryName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($list_of_products_list->CategoryName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($list_of_products_list->CategoryName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($list_of_products_list->QuantityPerUnit->Visible) { // QuantityPerUnit ?>
	<?php if ($list_of_products_list->SortUrl($list_of_products_list->QuantityPerUnit) == "") { ?>
		<th data-name="QuantityPerUnit" class="<?php echo $list_of_products_list->QuantityPerUnit->headerCellClass() ?>"><div id="elh_list_of_products_QuantityPerUnit" class="list_of_products_QuantityPerUnit"><div class="ew-table-header-caption"><?php echo $list_of_products_list->QuantityPerUnit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="QuantityPerUnit" class="<?php echo $list_of_products_list->QuantityPerUnit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $list_of_products_list->SortUrl($list_of_products_list->QuantityPerUnit) ?>', 1);"><div id="elh_list_of_products_QuantityPerUnit" class="list_of_products_QuantityPerUnit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $list_of_products_list->QuantityPerUnit->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($list_of_products_list->QuantityPerUnit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($list_of_products_list->QuantityPerUnit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($list_of_products_list->UnitsInStock->Visible) { // UnitsInStock ?>
	<?php if ($list_of_products_list->SortUrl($list_of_products_list->UnitsInStock) == "") { ?>
		<th data-name="UnitsInStock" class="<?php echo $list_of_products_list->UnitsInStock->headerCellClass() ?>"><div id="elh_list_of_products_UnitsInStock" class="list_of_products_UnitsInStock"><div class="ew-table-header-caption"><?php echo $list_of_products_list->UnitsInStock->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitsInStock" class="<?php echo $list_of_products_list->UnitsInStock->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $list_of_products_list->SortUrl($list_of_products_list->UnitsInStock) ?>', 1);"><div id="elh_list_of_products_UnitsInStock" class="list_of_products_UnitsInStock">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $list_of_products_list->UnitsInStock->caption() ?></span><span class="ew-table-header-sort"><?php if ($list_of_products_list->UnitsInStock->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($list_of_products_list->UnitsInStock->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($list_of_products_list->ProductName2->Visible) { // ProductName2 ?>
	<?php if ($list_of_products_list->SortUrl($list_of_products_list->ProductName2) == "") { ?>
		<th data-name="ProductName2" class="<?php echo $list_of_products_list->ProductName2->headerCellClass() ?>"><div id="elh_list_of_products_ProductName2" class="list_of_products_ProductName2"><div class="ew-table-header-caption"><?php echo $list_of_products_list->ProductName2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName2" class="<?php echo $list_of_products_list->ProductName2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $list_of_products_list->SortUrl($list_of_products_list->ProductName2) ?>', 1);"><div id="elh_list_of_products_ProductName2" class="list_of_products_ProductName2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $list_of_products_list->ProductName2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($list_of_products_list->ProductName2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($list_of_products_list->ProductName2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$list_of_products_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($list_of_products_list->ExportAll && $list_of_products_list->isExport()) {
	$list_of_products_list->StopRecord = $list_of_products_list->TotalRecords;
} else {

	// Set the last record to display
	if ($list_of_products_list->TotalRecords > $list_of_products_list->StartRecord + $list_of_products_list->DisplayRecords - 1)
		$list_of_products_list->StopRecord = $list_of_products_list->StartRecord + $list_of_products_list->DisplayRecords - 1;
	else
		$list_of_products_list->StopRecord = $list_of_products_list->TotalRecords;
}
$list_of_products_list->RecordCount = $list_of_products_list->StartRecord - 1;
if ($list_of_products_list->Recordset && !$list_of_products_list->Recordset->EOF) {
	$list_of_products_list->Recordset->moveFirst();
	$selectLimit = $list_of_products_list->UseSelectLimit;
	if (!$selectLimit && $list_of_products_list->StartRecord > 1)
		$list_of_products_list->Recordset->move($list_of_products_list->StartRecord - 1);
} elseif (!$list_of_products->AllowAddDeleteRow && $list_of_products_list->StopRecord == 0) {
	$list_of_products_list->StopRecord = $list_of_products->GridAddRowCount;
}

// Initialize aggregate
$list_of_products->RowType = ROWTYPE_AGGREGATEINIT;
$list_of_products->resetAttributes();
$list_of_products_list->renderRow();
while ($list_of_products_list->RecordCount < $list_of_products_list->StopRecord) {
	$list_of_products_list->RecordCount++;
	if ($list_of_products_list->RecordCount >= $list_of_products_list->StartRecord) {
		$list_of_products_list->RowCount++;

		// Set up key count
		$list_of_products_list->KeyCount = $list_of_products_list->RowIndex;

		// Init row class and style
		$list_of_products->resetAttributes();
		$list_of_products->CssClass = "";
		if ($list_of_products_list->isGridAdd()) {
		} else {
			$list_of_products_list->loadRowValues($list_of_products_list->Recordset); // Load row values
		}
		$list_of_products->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$list_of_products->RowAttrs->merge(["data-rowindex" => $list_of_products_list->RowCount, "id" => "r" . $list_of_products_list->RowCount . "_list_of_products", "data-rowtype" => $list_of_products->RowType]);

		// Render row
		$list_of_products_list->renderRow();

		// Render list options
		$list_of_products_list->renderListOptions();
?>
	<tr <?php echo $list_of_products->rowAttributes() ?>>
<?php

// Render list options (body, left)
$list_of_products_list->ListOptions->render("body", "left", $list_of_products_list->RowCount);
?>
	<?php if ($list_of_products_list->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" <?php echo $list_of_products_list->ProductName->cellAttributes() ?>>
<span id="el<?php echo $list_of_products_list->RowCount ?>_list_of_products_ProductName">
<span<?php echo $list_of_products_list->ProductName->viewAttributes() ?>><?php echo $list_of_products_list->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($list_of_products_list->CategoryName->Visible) { // CategoryName ?>
		<td data-name="CategoryName" <?php echo $list_of_products_list->CategoryName->cellAttributes() ?>>
<span id="el<?php echo $list_of_products_list->RowCount ?>_list_of_products_CategoryName">
<span<?php echo $list_of_products_list->CategoryName->viewAttributes() ?>><?php echo $list_of_products_list->CategoryName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($list_of_products_list->QuantityPerUnit->Visible) { // QuantityPerUnit ?>
		<td data-name="QuantityPerUnit" <?php echo $list_of_products_list->QuantityPerUnit->cellAttributes() ?>>
<span id="el<?php echo $list_of_products_list->RowCount ?>_list_of_products_QuantityPerUnit">
<span<?php echo $list_of_products_list->QuantityPerUnit->viewAttributes() ?>><?php echo $list_of_products_list->QuantityPerUnit->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($list_of_products_list->UnitsInStock->Visible) { // UnitsInStock ?>
		<td data-name="UnitsInStock" <?php echo $list_of_products_list->UnitsInStock->cellAttributes() ?>>
<span id="el<?php echo $list_of_products_list->RowCount ?>_list_of_products_UnitsInStock">
<span<?php echo $list_of_products_list->UnitsInStock->viewAttributes() ?>><?php echo $list_of_products_list->UnitsInStock->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($list_of_products_list->ProductName2->Visible) { // ProductName2 ?>
		<td data-name="ProductName2" <?php echo $list_of_products_list->ProductName2->cellAttributes() ?>>
<span id="el<?php echo $list_of_products_list->RowCount ?>_list_of_products_ProductName2">
<span<?php echo $list_of_products_list->ProductName2->viewAttributes() ?>><?php echo $list_of_products_list->ProductName2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$list_of_products_list->ListOptions->render("body", "right", $list_of_products_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$list_of_products_list->isGridAdd())
		$list_of_products_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$list_of_products->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($list_of_products_list->Recordset)
	$list_of_products_list->Recordset->Close();
?>
<?php if (!$list_of_products_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$list_of_products_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $list_of_products_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $list_of_products_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($list_of_products_list->TotalRecords == 0 && !$list_of_products->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $list_of_products_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$list_of_products_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$list_of_products_list->isExport()) { ?>
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
$list_of_products_list->terminate();
?>