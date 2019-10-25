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
$categories_list = new categories_list();

// Run the page
$categories_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categories_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$categories_list->isExport()) { ?>
<script>
var fcategorieslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcategorieslist = currentForm = new ew.Form("fcategorieslist", "list");
	fcategorieslist.formKeyCountName = '<?php echo $categories_list->FormKeyCountName ?>';
	loadjs.done("fcategorieslist");
});
var fcategorieslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcategorieslistsrch = currentSearchForm = new ew.Form("fcategorieslistsrch");

	// Dynamic selection lists
	// Filters

	fcategorieslistsrch.filterList = <?php echo $categories_list->getFilterList() ?>;
	loadjs.done("fcategorieslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$categories_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($categories_list->TotalRecords > 0 && $categories_list->ExportOptions->visible()) { ?>
<?php $categories_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($categories_list->ImportOptions->visible()) { ?>
<?php $categories_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($categories_list->SearchOptions->visible()) { ?>
<?php $categories_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($categories_list->FilterOptions->visible()) { ?>
<?php $categories_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$categories_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$categories_list->isExport() && !$categories->CurrentAction) { ?>
<form name="fcategorieslistsrch" id="fcategorieslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcategorieslistsrch-search-panel" class="<?php echo $categories_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="categories">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $categories_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($categories_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($categories_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $categories_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($categories_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($categories_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($categories_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($categories_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $categories_list->showPageHeader(); ?>
<?php
$categories_list->showMessage();
?>
<?php if ($categories_list->TotalRecords > 0 || $categories->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($categories_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> categories">
<form name="fcategorieslist" id="fcategorieslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categories">
<div id="gmp_categories" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($categories_list->TotalRecords > 0 || $categories_list->isGridEdit()) { ?>
<table id="tbl_categorieslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$categories->RowType = ROWTYPE_HEADER;

// Render list options
$categories_list->renderListOptions();

// Render list options (header, left)
$categories_list->ListOptions->render("header", "left");
?>
<?php if ($categories_list->CategoryID->Visible) { // CategoryID ?>
	<?php if ($categories_list->SortUrl($categories_list->CategoryID) == "") { ?>
		<th data-name="CategoryID" class="<?php echo $categories_list->CategoryID->headerCellClass() ?>"><div id="elh_categories_CategoryID" class="categories_CategoryID"><div class="ew-table-header-caption"><?php echo $categories_list->CategoryID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CategoryID" class="<?php echo $categories_list->CategoryID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $categories_list->SortUrl($categories_list->CategoryID) ?>', 1);"><div id="elh_categories_CategoryID" class="categories_CategoryID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $categories_list->CategoryID->caption() ?></span><span class="ew-table-header-sort"><?php if ($categories_list->CategoryID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($categories_list->CategoryID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($categories_list->CategoryName->Visible) { // CategoryName ?>
	<?php if ($categories_list->SortUrl($categories_list->CategoryName) == "") { ?>
		<th data-name="CategoryName" class="<?php echo $categories_list->CategoryName->headerCellClass() ?>"><div id="elh_categories_CategoryName" class="categories_CategoryName"><div class="ew-table-header-caption"><?php echo $categories_list->CategoryName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CategoryName" class="<?php echo $categories_list->CategoryName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $categories_list->SortUrl($categories_list->CategoryName) ?>', 1);"><div id="elh_categories_CategoryName" class="categories_CategoryName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $categories_list->CategoryName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($categories_list->CategoryName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($categories_list->CategoryName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$categories_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($categories_list->ExportAll && $categories_list->isExport()) {
	$categories_list->StopRecord = $categories_list->TotalRecords;
} else {

	// Set the last record to display
	if ($categories_list->TotalRecords > $categories_list->StartRecord + $categories_list->DisplayRecords - 1)
		$categories_list->StopRecord = $categories_list->StartRecord + $categories_list->DisplayRecords - 1;
	else
		$categories_list->StopRecord = $categories_list->TotalRecords;
}
$categories_list->RecordCount = $categories_list->StartRecord - 1;
if ($categories_list->Recordset && !$categories_list->Recordset->EOF) {
	$categories_list->Recordset->moveFirst();
	$selectLimit = $categories_list->UseSelectLimit;
	if (!$selectLimit && $categories_list->StartRecord > 1)
		$categories_list->Recordset->move($categories_list->StartRecord - 1);
} elseif (!$categories->AllowAddDeleteRow && $categories_list->StopRecord == 0) {
	$categories_list->StopRecord = $categories->GridAddRowCount;
}

// Initialize aggregate
$categories->RowType = ROWTYPE_AGGREGATEINIT;
$categories->resetAttributes();
$categories_list->renderRow();
while ($categories_list->RecordCount < $categories_list->StopRecord) {
	$categories_list->RecordCount++;
	if ($categories_list->RecordCount >= $categories_list->StartRecord) {
		$categories_list->RowCount++;

		// Set up key count
		$categories_list->KeyCount = $categories_list->RowIndex;

		// Init row class and style
		$categories->resetAttributes();
		$categories->CssClass = "";
		if ($categories_list->isGridAdd()) {
		} else {
			$categories_list->loadRowValues($categories_list->Recordset); // Load row values
		}
		$categories->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$categories->RowAttrs->merge(["data-rowindex" => $categories_list->RowCount, "id" => "r" . $categories_list->RowCount . "_categories", "data-rowtype" => $categories->RowType]);

		// Render row
		$categories_list->renderRow();

		// Render list options
		$categories_list->renderListOptions();
?>
	<tr <?php echo $categories->rowAttributes() ?>>
<?php

// Render list options (body, left)
$categories_list->ListOptions->render("body", "left", $categories_list->RowCount);
?>
	<?php if ($categories_list->CategoryID->Visible) { // CategoryID ?>
		<td data-name="CategoryID" <?php echo $categories_list->CategoryID->cellAttributes() ?>>
<span id="el<?php echo $categories_list->RowCount ?>_categories_CategoryID">
<span<?php echo $categories_list->CategoryID->viewAttributes() ?>><?php echo $categories_list->CategoryID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($categories_list->CategoryName->Visible) { // CategoryName ?>
		<td data-name="CategoryName" <?php echo $categories_list->CategoryName->cellAttributes() ?>>
<span id="el<?php echo $categories_list->RowCount ?>_categories_CategoryName">
<span<?php echo $categories_list->CategoryName->viewAttributes() ?>><?php echo $categories_list->CategoryName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$categories_list->ListOptions->render("body", "right", $categories_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$categories_list->isGridAdd())
		$categories_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$categories->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($categories_list->Recordset)
	$categories_list->Recordset->Close();
?>
<?php if (!$categories_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$categories_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $categories_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $categories_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($categories_list->TotalRecords == 0 && !$categories->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $categories_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$categories_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$categories_list->isExport()) { ?>
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
$categories_list->terminate();
?>