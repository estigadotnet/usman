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
$sales_by_category_for_1997_list = new sales_by_category_for_1997_list();

// Run the page
$sales_by_category_for_1997_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sales_by_category_for_1997_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sales_by_category_for_1997_list->isExport()) { ?>
<script>
var fsales_by_category_for_1997list, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsales_by_category_for_1997list = currentForm = new ew.Form("fsales_by_category_for_1997list", "list");
	fsales_by_category_for_1997list.formKeyCountName = '<?php echo $sales_by_category_for_1997_list->FormKeyCountName ?>';
	loadjs.done("fsales_by_category_for_1997list");
});
var fsales_by_category_for_1997listsrch;
loadjs.ready("head", function() {

	// Form object for search
	fsales_by_category_for_1997listsrch = currentSearchForm = new ew.Form("fsales_by_category_for_1997listsrch");

	// Dynamic selection lists
	// Filters

	fsales_by_category_for_1997listsrch.filterList = <?php echo $sales_by_category_for_1997_list->getFilterList() ?>;
	loadjs.done("fsales_by_category_for_1997listsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$sales_by_category_for_1997_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($sales_by_category_for_1997_list->TotalRecords > 0 && $sales_by_category_for_1997_list->ExportOptions->visible()) { ?>
<?php $sales_by_category_for_1997_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($sales_by_category_for_1997_list->ImportOptions->visible()) { ?>
<?php $sales_by_category_for_1997_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($sales_by_category_for_1997_list->SearchOptions->visible()) { ?>
<?php $sales_by_category_for_1997_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($sales_by_category_for_1997_list->FilterOptions->visible()) { ?>
<?php $sales_by_category_for_1997_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$sales_by_category_for_1997_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$sales_by_category_for_1997_list->isExport() && !$sales_by_category_for_1997->CurrentAction) { ?>
<form name="fsales_by_category_for_1997listsrch" id="fsales_by_category_for_1997listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsales_by_category_for_1997listsrch-search-panel" class="<?php echo $sales_by_category_for_1997_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="sales_by_category_for_1997">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $sales_by_category_for_1997_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($sales_by_category_for_1997_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($sales_by_category_for_1997_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $sales_by_category_for_1997_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($sales_by_category_for_1997_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($sales_by_category_for_1997_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($sales_by_category_for_1997_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($sales_by_category_for_1997_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $sales_by_category_for_1997_list->showPageHeader(); ?>
<?php
$sales_by_category_for_1997_list->showMessage();
?>
<?php if ($sales_by_category_for_1997_list->TotalRecords > 0 || $sales_by_category_for_1997->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($sales_by_category_for_1997_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> sales_by_category_for_1997">
<form name="fsales_by_category_for_1997list" id="fsales_by_category_for_1997list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sales_by_category_for_1997">
<div id="gmp_sales_by_category_for_1997" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($sales_by_category_for_1997_list->TotalRecords > 0 || $sales_by_category_for_1997_list->isGridEdit()) { ?>
<table id="tbl_sales_by_category_for_1997list" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$sales_by_category_for_1997->RowType = ROWTYPE_HEADER;

// Render list options
$sales_by_category_for_1997_list->renderListOptions();

// Render list options (header, left)
$sales_by_category_for_1997_list->ListOptions->render("header", "left");
?>
<?php if ($sales_by_category_for_1997_list->CategoryID->Visible) { // CategoryID ?>
	<?php if ($sales_by_category_for_1997_list->SortUrl($sales_by_category_for_1997_list->CategoryID) == "") { ?>
		<th data-name="CategoryID" class="<?php echo $sales_by_category_for_1997_list->CategoryID->headerCellClass() ?>"><div id="elh_sales_by_category_for_1997_CategoryID" class="sales_by_category_for_1997_CategoryID"><div class="ew-table-header-caption"><?php echo $sales_by_category_for_1997_list->CategoryID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CategoryID" class="<?php echo $sales_by_category_for_1997_list->CategoryID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sales_by_category_for_1997_list->SortUrl($sales_by_category_for_1997_list->CategoryID) ?>', 1);"><div id="elh_sales_by_category_for_1997_CategoryID" class="sales_by_category_for_1997_CategoryID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sales_by_category_for_1997_list->CategoryID->caption() ?></span><span class="ew-table-header-sort"><?php if ($sales_by_category_for_1997_list->CategoryID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sales_by_category_for_1997_list->CategoryID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sales_by_category_for_1997_list->CategoryName->Visible) { // CategoryName ?>
	<?php if ($sales_by_category_for_1997_list->SortUrl($sales_by_category_for_1997_list->CategoryName) == "") { ?>
		<th data-name="CategoryName" class="<?php echo $sales_by_category_for_1997_list->CategoryName->headerCellClass() ?>"><div id="elh_sales_by_category_for_1997_CategoryName" class="sales_by_category_for_1997_CategoryName"><div class="ew-table-header-caption"><?php echo $sales_by_category_for_1997_list->CategoryName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CategoryName" class="<?php echo $sales_by_category_for_1997_list->CategoryName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sales_by_category_for_1997_list->SortUrl($sales_by_category_for_1997_list->CategoryName) ?>', 1);"><div id="elh_sales_by_category_for_1997_CategoryName" class="sales_by_category_for_1997_CategoryName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sales_by_category_for_1997_list->CategoryName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($sales_by_category_for_1997_list->CategoryName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sales_by_category_for_1997_list->CategoryName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sales_by_category_for_1997_list->ProductName->Visible) { // ProductName ?>
	<?php if ($sales_by_category_for_1997_list->SortUrl($sales_by_category_for_1997_list->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $sales_by_category_for_1997_list->ProductName->headerCellClass() ?>"><div id="elh_sales_by_category_for_1997_ProductName" class="sales_by_category_for_1997_ProductName"><div class="ew-table-header-caption"><?php echo $sales_by_category_for_1997_list->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $sales_by_category_for_1997_list->ProductName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sales_by_category_for_1997_list->SortUrl($sales_by_category_for_1997_list->ProductName) ?>', 1);"><div id="elh_sales_by_category_for_1997_ProductName" class="sales_by_category_for_1997_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sales_by_category_for_1997_list->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($sales_by_category_for_1997_list->ProductName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sales_by_category_for_1997_list->ProductName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sales_by_category_for_1997_list->ProductSales->Visible) { // ProductSales ?>
	<?php if ($sales_by_category_for_1997_list->SortUrl($sales_by_category_for_1997_list->ProductSales) == "") { ?>
		<th data-name="ProductSales" class="<?php echo $sales_by_category_for_1997_list->ProductSales->headerCellClass() ?>"><div id="elh_sales_by_category_for_1997_ProductSales" class="sales_by_category_for_1997_ProductSales"><div class="ew-table-header-caption"><?php echo $sales_by_category_for_1997_list->ProductSales->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductSales" class="<?php echo $sales_by_category_for_1997_list->ProductSales->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sales_by_category_for_1997_list->SortUrl($sales_by_category_for_1997_list->ProductSales) ?>', 1);"><div id="elh_sales_by_category_for_1997_ProductSales" class="sales_by_category_for_1997_ProductSales">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sales_by_category_for_1997_list->ProductSales->caption() ?></span><span class="ew-table-header-sort"><?php if ($sales_by_category_for_1997_list->ProductSales->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sales_by_category_for_1997_list->ProductSales->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$sales_by_category_for_1997_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($sales_by_category_for_1997_list->ExportAll && $sales_by_category_for_1997_list->isExport()) {
	$sales_by_category_for_1997_list->StopRecord = $sales_by_category_for_1997_list->TotalRecords;
} else {

	// Set the last record to display
	if ($sales_by_category_for_1997_list->TotalRecords > $sales_by_category_for_1997_list->StartRecord + $sales_by_category_for_1997_list->DisplayRecords - 1)
		$sales_by_category_for_1997_list->StopRecord = $sales_by_category_for_1997_list->StartRecord + $sales_by_category_for_1997_list->DisplayRecords - 1;
	else
		$sales_by_category_for_1997_list->StopRecord = $sales_by_category_for_1997_list->TotalRecords;
}
$sales_by_category_for_1997_list->RecordCount = $sales_by_category_for_1997_list->StartRecord - 1;
if ($sales_by_category_for_1997_list->Recordset && !$sales_by_category_for_1997_list->Recordset->EOF) {
	$sales_by_category_for_1997_list->Recordset->moveFirst();
	$selectLimit = $sales_by_category_for_1997_list->UseSelectLimit;
	if (!$selectLimit && $sales_by_category_for_1997_list->StartRecord > 1)
		$sales_by_category_for_1997_list->Recordset->move($sales_by_category_for_1997_list->StartRecord - 1);
} elseif (!$sales_by_category_for_1997->AllowAddDeleteRow && $sales_by_category_for_1997_list->StopRecord == 0) {
	$sales_by_category_for_1997_list->StopRecord = $sales_by_category_for_1997->GridAddRowCount;
}

// Initialize aggregate
$sales_by_category_for_1997->RowType = ROWTYPE_AGGREGATEINIT;
$sales_by_category_for_1997->resetAttributes();
$sales_by_category_for_1997_list->renderRow();
while ($sales_by_category_for_1997_list->RecordCount < $sales_by_category_for_1997_list->StopRecord) {
	$sales_by_category_for_1997_list->RecordCount++;
	if ($sales_by_category_for_1997_list->RecordCount >= $sales_by_category_for_1997_list->StartRecord) {
		$sales_by_category_for_1997_list->RowCount++;

		// Set up key count
		$sales_by_category_for_1997_list->KeyCount = $sales_by_category_for_1997_list->RowIndex;

		// Init row class and style
		$sales_by_category_for_1997->resetAttributes();
		$sales_by_category_for_1997->CssClass = "";
		if ($sales_by_category_for_1997_list->isGridAdd()) {
		} else {
			$sales_by_category_for_1997_list->loadRowValues($sales_by_category_for_1997_list->Recordset); // Load row values
		}
		$sales_by_category_for_1997->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$sales_by_category_for_1997->RowAttrs->merge(["data-rowindex" => $sales_by_category_for_1997_list->RowCount, "id" => "r" . $sales_by_category_for_1997_list->RowCount . "_sales_by_category_for_1997", "data-rowtype" => $sales_by_category_for_1997->RowType]);

		// Render row
		$sales_by_category_for_1997_list->renderRow();

		// Render list options
		$sales_by_category_for_1997_list->renderListOptions();
?>
	<tr <?php echo $sales_by_category_for_1997->rowAttributes() ?>>
<?php

// Render list options (body, left)
$sales_by_category_for_1997_list->ListOptions->render("body", "left", $sales_by_category_for_1997_list->RowCount);
?>
	<?php if ($sales_by_category_for_1997_list->CategoryID->Visible) { // CategoryID ?>
		<td data-name="CategoryID" <?php echo $sales_by_category_for_1997_list->CategoryID->cellAttributes() ?>>
<span id="el<?php echo $sales_by_category_for_1997_list->RowCount ?>_sales_by_category_for_1997_CategoryID">
<span<?php echo $sales_by_category_for_1997_list->CategoryID->viewAttributes() ?>><?php echo $sales_by_category_for_1997_list->CategoryID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sales_by_category_for_1997_list->CategoryName->Visible) { // CategoryName ?>
		<td data-name="CategoryName" <?php echo $sales_by_category_for_1997_list->CategoryName->cellAttributes() ?>>
<span id="el<?php echo $sales_by_category_for_1997_list->RowCount ?>_sales_by_category_for_1997_CategoryName">
<span<?php echo $sales_by_category_for_1997_list->CategoryName->viewAttributes() ?>><?php echo $sales_by_category_for_1997_list->CategoryName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sales_by_category_for_1997_list->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" <?php echo $sales_by_category_for_1997_list->ProductName->cellAttributes() ?>>
<span id="el<?php echo $sales_by_category_for_1997_list->RowCount ?>_sales_by_category_for_1997_ProductName">
<span<?php echo $sales_by_category_for_1997_list->ProductName->viewAttributes() ?>><?php echo $sales_by_category_for_1997_list->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sales_by_category_for_1997_list->ProductSales->Visible) { // ProductSales ?>
		<td data-name="ProductSales" <?php echo $sales_by_category_for_1997_list->ProductSales->cellAttributes() ?>>
<span id="el<?php echo $sales_by_category_for_1997_list->RowCount ?>_sales_by_category_for_1997_ProductSales">
<span<?php echo $sales_by_category_for_1997_list->ProductSales->viewAttributes() ?>><?php echo $sales_by_category_for_1997_list->ProductSales->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$sales_by_category_for_1997_list->ListOptions->render("body", "right", $sales_by_category_for_1997_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$sales_by_category_for_1997_list->isGridAdd())
		$sales_by_category_for_1997_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$sales_by_category_for_1997->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($sales_by_category_for_1997_list->Recordset)
	$sales_by_category_for_1997_list->Recordset->Close();
?>
<?php if (!$sales_by_category_for_1997_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$sales_by_category_for_1997_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sales_by_category_for_1997_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sales_by_category_for_1997_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($sales_by_category_for_1997_list->TotalRecords == 0 && !$sales_by_category_for_1997->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $sales_by_category_for_1997_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$sales_by_category_for_1997_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sales_by_category_for_1997_list->isExport()) { ?>
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
$sales_by_category_for_1997_list->terminate();
?>