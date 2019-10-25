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
$trademarks_list = new trademarks_list();

// Run the page
$trademarks_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trademarks_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$trademarks_list->isExport()) { ?>
<script>
var ftrademarkslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftrademarkslist = currentForm = new ew.Form("ftrademarkslist", "list");
	ftrademarkslist.formKeyCountName = '<?php echo $trademarks_list->FormKeyCountName ?>';
	loadjs.done("ftrademarkslist");
});
var ftrademarkslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftrademarkslistsrch = currentSearchForm = new ew.Form("ftrademarkslistsrch");

	// Dynamic selection lists
	// Filters

	ftrademarkslistsrch.filterList = <?php echo $trademarks_list->getFilterList() ?>;
	loadjs.done("ftrademarkslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$trademarks_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($trademarks_list->TotalRecords > 0 && $trademarks_list->ExportOptions->visible()) { ?>
<?php $trademarks_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($trademarks_list->ImportOptions->visible()) { ?>
<?php $trademarks_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($trademarks_list->SearchOptions->visible()) { ?>
<?php $trademarks_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($trademarks_list->FilterOptions->visible()) { ?>
<?php $trademarks_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$trademarks_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$trademarks_list->isExport() && !$trademarks->CurrentAction) { ?>
<form name="ftrademarkslistsrch" id="ftrademarkslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftrademarkslistsrch-search-panel" class="<?php echo $trademarks_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="trademarks">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $trademarks_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($trademarks_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($trademarks_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $trademarks_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($trademarks_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($trademarks_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($trademarks_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($trademarks_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $trademarks_list->showPageHeader(); ?>
<?php
$trademarks_list->showMessage();
?>
<?php if ($trademarks_list->TotalRecords > 0 || $trademarks->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($trademarks_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> trademarks">
<form name="ftrademarkslist" id="ftrademarkslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trademarks">
<div id="gmp_trademarks" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($trademarks_list->TotalRecords > 0 || $trademarks_list->isGridEdit()) { ?>
<table id="tbl_trademarkslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$trademarks->RowType = ROWTYPE_HEADER;

// Render list options
$trademarks_list->renderListOptions();

// Render list options (header, left)
$trademarks_list->ListOptions->render("header", "left");
?>
<?php if ($trademarks_list->ID->Visible) { // ID ?>
	<?php if ($trademarks_list->SortUrl($trademarks_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $trademarks_list->ID->headerCellClass() ?>"><div id="elh_trademarks_ID" class="trademarks_ID"><div class="ew-table-header-caption"><?php echo $trademarks_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $trademarks_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $trademarks_list->SortUrl($trademarks_list->ID) ?>', 1);"><div id="elh_trademarks_ID" class="trademarks_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trademarks_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($trademarks_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($trademarks_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trademarks_list->Trademark->Visible) { // Trademark ?>
	<?php if ($trademarks_list->SortUrl($trademarks_list->Trademark) == "") { ?>
		<th data-name="Trademark" class="<?php echo $trademarks_list->Trademark->headerCellClass() ?>"><div id="elh_trademarks_Trademark" class="trademarks_Trademark"><div class="ew-table-header-caption"><?php echo $trademarks_list->Trademark->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Trademark" class="<?php echo $trademarks_list->Trademark->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $trademarks_list->SortUrl($trademarks_list->Trademark) ?>', 1);"><div id="elh_trademarks_Trademark" class="trademarks_Trademark">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trademarks_list->Trademark->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($trademarks_list->Trademark->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($trademarks_list->Trademark->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$trademarks_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($trademarks_list->ExportAll && $trademarks_list->isExport()) {
	$trademarks_list->StopRecord = $trademarks_list->TotalRecords;
} else {

	// Set the last record to display
	if ($trademarks_list->TotalRecords > $trademarks_list->StartRecord + $trademarks_list->DisplayRecords - 1)
		$trademarks_list->StopRecord = $trademarks_list->StartRecord + $trademarks_list->DisplayRecords - 1;
	else
		$trademarks_list->StopRecord = $trademarks_list->TotalRecords;
}
$trademarks_list->RecordCount = $trademarks_list->StartRecord - 1;
if ($trademarks_list->Recordset && !$trademarks_list->Recordset->EOF) {
	$trademarks_list->Recordset->moveFirst();
	$selectLimit = $trademarks_list->UseSelectLimit;
	if (!$selectLimit && $trademarks_list->StartRecord > 1)
		$trademarks_list->Recordset->move($trademarks_list->StartRecord - 1);
} elseif (!$trademarks->AllowAddDeleteRow && $trademarks_list->StopRecord == 0) {
	$trademarks_list->StopRecord = $trademarks->GridAddRowCount;
}

// Initialize aggregate
$trademarks->RowType = ROWTYPE_AGGREGATEINIT;
$trademarks->resetAttributes();
$trademarks_list->renderRow();
while ($trademarks_list->RecordCount < $trademarks_list->StopRecord) {
	$trademarks_list->RecordCount++;
	if ($trademarks_list->RecordCount >= $trademarks_list->StartRecord) {
		$trademarks_list->RowCount++;

		// Set up key count
		$trademarks_list->KeyCount = $trademarks_list->RowIndex;

		// Init row class and style
		$trademarks->resetAttributes();
		$trademarks->CssClass = "";
		if ($trademarks_list->isGridAdd()) {
		} else {
			$trademarks_list->loadRowValues($trademarks_list->Recordset); // Load row values
		}
		$trademarks->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$trademarks->RowAttrs->merge(["data-rowindex" => $trademarks_list->RowCount, "id" => "r" . $trademarks_list->RowCount . "_trademarks", "data-rowtype" => $trademarks->RowType]);

		// Render row
		$trademarks_list->renderRow();

		// Render list options
		$trademarks_list->renderListOptions();
?>
	<tr <?php echo $trademarks->rowAttributes() ?>>
<?php

// Render list options (body, left)
$trademarks_list->ListOptions->render("body", "left", $trademarks_list->RowCount);
?>
	<?php if ($trademarks_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $trademarks_list->ID->cellAttributes() ?>>
<span id="el<?php echo $trademarks_list->RowCount ?>_trademarks_ID">
<span<?php echo $trademarks_list->ID->viewAttributes() ?>><?php echo $trademarks_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($trademarks_list->Trademark->Visible) { // Trademark ?>
		<td data-name="Trademark" <?php echo $trademarks_list->Trademark->cellAttributes() ?>>
<span id="el<?php echo $trademarks_list->RowCount ?>_trademarks_Trademark">
<span<?php echo $trademarks_list->Trademark->viewAttributes() ?>><?php echo $trademarks_list->Trademark->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$trademarks_list->ListOptions->render("body", "right", $trademarks_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$trademarks_list->isGridAdd())
		$trademarks_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$trademarks->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($trademarks_list->Recordset)
	$trademarks_list->Recordset->Close();
?>
<?php if (!$trademarks_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$trademarks_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $trademarks_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $trademarks_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($trademarks_list->TotalRecords == 0 && !$trademarks->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $trademarks_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$trademarks_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$trademarks_list->isExport()) { ?>
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
$trademarks_list->terminate();
?>