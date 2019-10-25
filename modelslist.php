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
$models_list = new models_list();

// Run the page
$models_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$models_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$models_list->isExport()) { ?>
<script>
var fmodelslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmodelslist = currentForm = new ew.Form("fmodelslist", "list");
	fmodelslist.formKeyCountName = '<?php echo $models_list->FormKeyCountName ?>';
	loadjs.done("fmodelslist");
});
var fmodelslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmodelslistsrch = currentSearchForm = new ew.Form("fmodelslistsrch");

	// Dynamic selection lists
	// Filters

	fmodelslistsrch.filterList = <?php echo $models_list->getFilterList() ?>;
	loadjs.done("fmodelslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$models_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($models_list->TotalRecords > 0 && $models_list->ExportOptions->visible()) { ?>
<?php $models_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($models_list->ImportOptions->visible()) { ?>
<?php $models_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($models_list->SearchOptions->visible()) { ?>
<?php $models_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($models_list->FilterOptions->visible()) { ?>
<?php $models_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$models_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$models_list->isExport() && !$models->CurrentAction) { ?>
<form name="fmodelslistsrch" id="fmodelslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmodelslistsrch-search-panel" class="<?php echo $models_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="models">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $models_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($models_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($models_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $models_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($models_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($models_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($models_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($models_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $models_list->showPageHeader(); ?>
<?php
$models_list->showMessage();
?>
<?php if ($models_list->TotalRecords > 0 || $models->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($models_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> models">
<form name="fmodelslist" id="fmodelslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="models">
<div id="gmp_models" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($models_list->TotalRecords > 0 || $models_list->isGridEdit()) { ?>
<table id="tbl_modelslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$models->RowType = ROWTYPE_HEADER;

// Render list options
$models_list->renderListOptions();

// Render list options (header, left)
$models_list->ListOptions->render("header", "left");
?>
<?php if ($models_list->ID->Visible) { // ID ?>
	<?php if ($models_list->SortUrl($models_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $models_list->ID->headerCellClass() ?>"><div id="elh_models_ID" class="models_ID"><div class="ew-table-header-caption"><?php echo $models_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $models_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $models_list->SortUrl($models_list->ID) ?>', 1);"><div id="elh_models_ID" class="models_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $models_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($models_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($models_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($models_list->Trademark->Visible) { // Trademark ?>
	<?php if ($models_list->SortUrl($models_list->Trademark) == "") { ?>
		<th data-name="Trademark" class="<?php echo $models_list->Trademark->headerCellClass() ?>"><div id="elh_models_Trademark" class="models_Trademark"><div class="ew-table-header-caption"><?php echo $models_list->Trademark->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Trademark" class="<?php echo $models_list->Trademark->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $models_list->SortUrl($models_list->Trademark) ?>', 1);"><div id="elh_models_Trademark" class="models_Trademark">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $models_list->Trademark->caption() ?></span><span class="ew-table-header-sort"><?php if ($models_list->Trademark->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($models_list->Trademark->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($models_list->Model->Visible) { // Model ?>
	<?php if ($models_list->SortUrl($models_list->Model) == "") { ?>
		<th data-name="Model" class="<?php echo $models_list->Model->headerCellClass() ?>"><div id="elh_models_Model" class="models_Model"><div class="ew-table-header-caption"><?php echo $models_list->Model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Model" class="<?php echo $models_list->Model->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $models_list->SortUrl($models_list->Model) ?>', 1);"><div id="elh_models_Model" class="models_Model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $models_list->Model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($models_list->Model->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($models_list->Model->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$models_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($models_list->ExportAll && $models_list->isExport()) {
	$models_list->StopRecord = $models_list->TotalRecords;
} else {

	// Set the last record to display
	if ($models_list->TotalRecords > $models_list->StartRecord + $models_list->DisplayRecords - 1)
		$models_list->StopRecord = $models_list->StartRecord + $models_list->DisplayRecords - 1;
	else
		$models_list->StopRecord = $models_list->TotalRecords;
}
$models_list->RecordCount = $models_list->StartRecord - 1;
if ($models_list->Recordset && !$models_list->Recordset->EOF) {
	$models_list->Recordset->moveFirst();
	$selectLimit = $models_list->UseSelectLimit;
	if (!$selectLimit && $models_list->StartRecord > 1)
		$models_list->Recordset->move($models_list->StartRecord - 1);
} elseif (!$models->AllowAddDeleteRow && $models_list->StopRecord == 0) {
	$models_list->StopRecord = $models->GridAddRowCount;
}

// Initialize aggregate
$models->RowType = ROWTYPE_AGGREGATEINIT;
$models->resetAttributes();
$models_list->renderRow();
while ($models_list->RecordCount < $models_list->StopRecord) {
	$models_list->RecordCount++;
	if ($models_list->RecordCount >= $models_list->StartRecord) {
		$models_list->RowCount++;

		// Set up key count
		$models_list->KeyCount = $models_list->RowIndex;

		// Init row class and style
		$models->resetAttributes();
		$models->CssClass = "";
		if ($models_list->isGridAdd()) {
		} else {
			$models_list->loadRowValues($models_list->Recordset); // Load row values
		}
		$models->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$models->RowAttrs->merge(["data-rowindex" => $models_list->RowCount, "id" => "r" . $models_list->RowCount . "_models", "data-rowtype" => $models->RowType]);

		// Render row
		$models_list->renderRow();

		// Render list options
		$models_list->renderListOptions();
?>
	<tr <?php echo $models->rowAttributes() ?>>
<?php

// Render list options (body, left)
$models_list->ListOptions->render("body", "left", $models_list->RowCount);
?>
	<?php if ($models_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $models_list->ID->cellAttributes() ?>>
<span id="el<?php echo $models_list->RowCount ?>_models_ID">
<span<?php echo $models_list->ID->viewAttributes() ?>><?php echo $models_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($models_list->Trademark->Visible) { // Trademark ?>
		<td data-name="Trademark" <?php echo $models_list->Trademark->cellAttributes() ?>>
<span id="el<?php echo $models_list->RowCount ?>_models_Trademark">
<span<?php echo $models_list->Trademark->viewAttributes() ?>><?php echo $models_list->Trademark->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($models_list->Model->Visible) { // Model ?>
		<td data-name="Model" <?php echo $models_list->Model->cellAttributes() ?>>
<span id="el<?php echo $models_list->RowCount ?>_models_Model">
<span<?php echo $models_list->Model->viewAttributes() ?>><?php echo $models_list->Model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$models_list->ListOptions->render("body", "right", $models_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$models_list->isGridAdd())
		$models_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$models->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($models_list->Recordset)
	$models_list->Recordset->Close();
?>
<?php if (!$models_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$models_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $models_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $models_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($models_list->TotalRecords == 0 && !$models->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $models_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$models_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$models_list->isExport()) { ?>
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
$models_list->terminate();
?>