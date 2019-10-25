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
$gantt_list = new gantt_list();

// Run the page
$gantt_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gantt_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gantt_list->isExport()) { ?>
<script>
var fganttlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fganttlist = currentForm = new ew.Form("fganttlist", "list");
	fganttlist.formKeyCountName = '<?php echo $gantt_list->FormKeyCountName ?>';
	loadjs.done("fganttlist");
});
var fganttlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fganttlistsrch = currentSearchForm = new ew.Form("fganttlistsrch");

	// Dynamic selection lists
	// Filters

	fganttlistsrch.filterList = <?php echo $gantt_list->getFilterList() ?>;
	loadjs.done("fganttlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$gantt_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($gantt_list->TotalRecords > 0 && $gantt_list->ExportOptions->visible()) { ?>
<?php $gantt_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($gantt_list->ImportOptions->visible()) { ?>
<?php $gantt_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($gantt_list->SearchOptions->visible()) { ?>
<?php $gantt_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($gantt_list->FilterOptions->visible()) { ?>
<?php $gantt_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$gantt_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$gantt_list->isExport() && !$gantt->CurrentAction) { ?>
<form name="fganttlistsrch" id="fganttlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fganttlistsrch-search-panel" class="<?php echo $gantt_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="gantt">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $gantt_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($gantt_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($gantt_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $gantt_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($gantt_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($gantt_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($gantt_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($gantt_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $gantt_list->showPageHeader(); ?>
<?php
$gantt_list->showMessage();
?>
<?php if ($gantt_list->TotalRecords > 0 || $gantt->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gantt_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gantt">
<form name="fganttlist" id="fganttlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gantt">
<div id="gmp_gantt" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($gantt_list->TotalRecords > 0 || $gantt_list->isGridEdit()) { ?>
<table id="tbl_ganttlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gantt->RowType = ROWTYPE_HEADER;

// Render list options
$gantt_list->renderListOptions();

// Render list options (header, left)
$gantt_list->ListOptions->render("header", "left");
?>
<?php if ($gantt_list->id->Visible) { // id ?>
	<?php if ($gantt_list->SortUrl($gantt_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $gantt_list->id->headerCellClass() ?>"><div id="elh_gantt_id" class="gantt_id"><div class="ew-table-header-caption"><?php echo $gantt_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $gantt_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gantt_list->SortUrl($gantt_list->id) ?>', 1);"><div id="elh_gantt_id" class="gantt_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gantt_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gantt_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gantt_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gantt_list->name->Visible) { // name ?>
	<?php if ($gantt_list->SortUrl($gantt_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $gantt_list->name->headerCellClass() ?>"><div id="elh_gantt_name" class="gantt_name"><div class="ew-table-header-caption"><?php echo $gantt_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $gantt_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gantt_list->SortUrl($gantt_list->name) ?>', 1);"><div id="elh_gantt_name" class="gantt_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gantt_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($gantt_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gantt_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gantt_list->start->Visible) { // start ?>
	<?php if ($gantt_list->SortUrl($gantt_list->start) == "") { ?>
		<th data-name="start" class="<?php echo $gantt_list->start->headerCellClass() ?>"><div id="elh_gantt_start" class="gantt_start"><div class="ew-table-header-caption"><?php echo $gantt_list->start->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="start" class="<?php echo $gantt_list->start->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gantt_list->SortUrl($gantt_list->start) ?>', 1);"><div id="elh_gantt_start" class="gantt_start">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gantt_list->start->caption() ?></span><span class="ew-table-header-sort"><?php if ($gantt_list->start->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gantt_list->start->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gantt_list->end->Visible) { // end ?>
	<?php if ($gantt_list->SortUrl($gantt_list->end) == "") { ?>
		<th data-name="end" class="<?php echo $gantt_list->end->headerCellClass() ?>"><div id="elh_gantt_end" class="gantt_end"><div class="ew-table-header-caption"><?php echo $gantt_list->end->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="end" class="<?php echo $gantt_list->end->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gantt_list->SortUrl($gantt_list->end) ?>', 1);"><div id="elh_gantt_end" class="gantt_end">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gantt_list->end->caption() ?></span><span class="ew-table-header-sort"><?php if ($gantt_list->end->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gantt_list->end->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gantt_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($gantt_list->ExportAll && $gantt_list->isExport()) {
	$gantt_list->StopRecord = $gantt_list->TotalRecords;
} else {

	// Set the last record to display
	if ($gantt_list->TotalRecords > $gantt_list->StartRecord + $gantt_list->DisplayRecords - 1)
		$gantt_list->StopRecord = $gantt_list->StartRecord + $gantt_list->DisplayRecords - 1;
	else
		$gantt_list->StopRecord = $gantt_list->TotalRecords;
}
$gantt_list->RecordCount = $gantt_list->StartRecord - 1;
if ($gantt_list->Recordset && !$gantt_list->Recordset->EOF) {
	$gantt_list->Recordset->moveFirst();
	$selectLimit = $gantt_list->UseSelectLimit;
	if (!$selectLimit && $gantt_list->StartRecord > 1)
		$gantt_list->Recordset->move($gantt_list->StartRecord - 1);
} elseif (!$gantt->AllowAddDeleteRow && $gantt_list->StopRecord == 0) {
	$gantt_list->StopRecord = $gantt->GridAddRowCount;
}

// Initialize aggregate
$gantt->RowType = ROWTYPE_AGGREGATEINIT;
$gantt->resetAttributes();
$gantt_list->renderRow();
while ($gantt_list->RecordCount < $gantt_list->StopRecord) {
	$gantt_list->RecordCount++;
	if ($gantt_list->RecordCount >= $gantt_list->StartRecord) {
		$gantt_list->RowCount++;

		// Set up key count
		$gantt_list->KeyCount = $gantt_list->RowIndex;

		// Init row class and style
		$gantt->resetAttributes();
		$gantt->CssClass = "";
		if ($gantt_list->isGridAdd()) {
		} else {
			$gantt_list->loadRowValues($gantt_list->Recordset); // Load row values
		}
		$gantt->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$gantt->RowAttrs->merge(["data-rowindex" => $gantt_list->RowCount, "id" => "r" . $gantt_list->RowCount . "_gantt", "data-rowtype" => $gantt->RowType]);

		// Render row
		$gantt_list->renderRow();

		// Render list options
		$gantt_list->renderListOptions();
?>
	<tr <?php echo $gantt->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gantt_list->ListOptions->render("body", "left", $gantt_list->RowCount);
?>
	<?php if ($gantt_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $gantt_list->id->cellAttributes() ?>>
<span id="el<?php echo $gantt_list->RowCount ?>_gantt_id">
<span<?php echo $gantt_list->id->viewAttributes() ?>><?php echo $gantt_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gantt_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $gantt_list->name->cellAttributes() ?>>
<span id="el<?php echo $gantt_list->RowCount ?>_gantt_name">
<span<?php echo $gantt_list->name->viewAttributes() ?>><?php echo $gantt_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gantt_list->start->Visible) { // start ?>
		<td data-name="start" <?php echo $gantt_list->start->cellAttributes() ?>>
<span id="el<?php echo $gantt_list->RowCount ?>_gantt_start">
<span<?php echo $gantt_list->start->viewAttributes() ?>><?php echo $gantt_list->start->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gantt_list->end->Visible) { // end ?>
		<td data-name="end" <?php echo $gantt_list->end->cellAttributes() ?>>
<span id="el<?php echo $gantt_list->RowCount ?>_gantt_end">
<span<?php echo $gantt_list->end->viewAttributes() ?>><?php echo $gantt_list->end->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gantt_list->ListOptions->render("body", "right", $gantt_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$gantt_list->isGridAdd())
		$gantt_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$gantt->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gantt_list->Recordset)
	$gantt_list->Recordset->Close();
?>
<?php if (!$gantt_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$gantt_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gantt_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gantt_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gantt_list->TotalRecords == 0 && !$gantt->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gantt_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$gantt_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gantt_list->isExport()) { ?>
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
$gantt_list->terminate();
?>