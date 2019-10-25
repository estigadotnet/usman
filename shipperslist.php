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
$shippers_list = new shippers_list();

// Run the page
$shippers_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$shippers_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$shippers_list->isExport()) { ?>
<script>
var fshipperslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fshipperslist = currentForm = new ew.Form("fshipperslist", "list");
	fshipperslist.formKeyCountName = '<?php echo $shippers_list->FormKeyCountName ?>';
	loadjs.done("fshipperslist");
});
var fshipperslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fshipperslistsrch = currentSearchForm = new ew.Form("fshipperslistsrch");

	// Dynamic selection lists
	// Filters

	fshipperslistsrch.filterList = <?php echo $shippers_list->getFilterList() ?>;
	loadjs.done("fshipperslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$shippers_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($shippers_list->TotalRecords > 0 && $shippers_list->ExportOptions->visible()) { ?>
<?php $shippers_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($shippers_list->ImportOptions->visible()) { ?>
<?php $shippers_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($shippers_list->SearchOptions->visible()) { ?>
<?php $shippers_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($shippers_list->FilterOptions->visible()) { ?>
<?php $shippers_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$shippers_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$shippers_list->isExport() && !$shippers->CurrentAction) { ?>
<form name="fshipperslistsrch" id="fshipperslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fshipperslistsrch-search-panel" class="<?php echo $shippers_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="shippers">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $shippers_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($shippers_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($shippers_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $shippers_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($shippers_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($shippers_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($shippers_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($shippers_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $shippers_list->showPageHeader(); ?>
<?php
$shippers_list->showMessage();
?>
<?php if ($shippers_list->TotalRecords > 0 || $shippers->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($shippers_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> shippers">
<form name="fshipperslist" id="fshipperslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="shippers">
<div id="gmp_shippers" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($shippers_list->TotalRecords > 0 || $shippers_list->isGridEdit()) { ?>
<table id="tbl_shipperslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$shippers->RowType = ROWTYPE_HEADER;

// Render list options
$shippers_list->renderListOptions();

// Render list options (header, left)
$shippers_list->ListOptions->render("header", "left");
?>
<?php if ($shippers_list->ShipperID->Visible) { // ShipperID ?>
	<?php if ($shippers_list->SortUrl($shippers_list->ShipperID) == "") { ?>
		<th data-name="ShipperID" class="<?php echo $shippers_list->ShipperID->headerCellClass() ?>"><div id="elh_shippers_ShipperID" class="shippers_ShipperID"><div class="ew-table-header-caption"><?php echo $shippers_list->ShipperID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipperID" class="<?php echo $shippers_list->ShipperID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $shippers_list->SortUrl($shippers_list->ShipperID) ?>', 1);"><div id="elh_shippers_ShipperID" class="shippers_ShipperID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $shippers_list->ShipperID->caption() ?></span><span class="ew-table-header-sort"><?php if ($shippers_list->ShipperID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($shippers_list->ShipperID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($shippers_list->CompanyName->Visible) { // CompanyName ?>
	<?php if ($shippers_list->SortUrl($shippers_list->CompanyName) == "") { ?>
		<th data-name="CompanyName" class="<?php echo $shippers_list->CompanyName->headerCellClass() ?>"><div id="elh_shippers_CompanyName" class="shippers_CompanyName"><div class="ew-table-header-caption"><?php echo $shippers_list->CompanyName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CompanyName" class="<?php echo $shippers_list->CompanyName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $shippers_list->SortUrl($shippers_list->CompanyName) ?>', 1);"><div id="elh_shippers_CompanyName" class="shippers_CompanyName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $shippers_list->CompanyName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($shippers_list->CompanyName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($shippers_list->CompanyName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($shippers_list->Phone->Visible) { // Phone ?>
	<?php if ($shippers_list->SortUrl($shippers_list->Phone) == "") { ?>
		<th data-name="Phone" class="<?php echo $shippers_list->Phone->headerCellClass() ?>"><div id="elh_shippers_Phone" class="shippers_Phone"><div class="ew-table-header-caption"><?php echo $shippers_list->Phone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Phone" class="<?php echo $shippers_list->Phone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $shippers_list->SortUrl($shippers_list->Phone) ?>', 1);"><div id="elh_shippers_Phone" class="shippers_Phone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $shippers_list->Phone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($shippers_list->Phone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($shippers_list->Phone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$shippers_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($shippers_list->ExportAll && $shippers_list->isExport()) {
	$shippers_list->StopRecord = $shippers_list->TotalRecords;
} else {

	// Set the last record to display
	if ($shippers_list->TotalRecords > $shippers_list->StartRecord + $shippers_list->DisplayRecords - 1)
		$shippers_list->StopRecord = $shippers_list->StartRecord + $shippers_list->DisplayRecords - 1;
	else
		$shippers_list->StopRecord = $shippers_list->TotalRecords;
}
$shippers_list->RecordCount = $shippers_list->StartRecord - 1;
if ($shippers_list->Recordset && !$shippers_list->Recordset->EOF) {
	$shippers_list->Recordset->moveFirst();
	$selectLimit = $shippers_list->UseSelectLimit;
	if (!$selectLimit && $shippers_list->StartRecord > 1)
		$shippers_list->Recordset->move($shippers_list->StartRecord - 1);
} elseif (!$shippers->AllowAddDeleteRow && $shippers_list->StopRecord == 0) {
	$shippers_list->StopRecord = $shippers->GridAddRowCount;
}

// Initialize aggregate
$shippers->RowType = ROWTYPE_AGGREGATEINIT;
$shippers->resetAttributes();
$shippers_list->renderRow();
while ($shippers_list->RecordCount < $shippers_list->StopRecord) {
	$shippers_list->RecordCount++;
	if ($shippers_list->RecordCount >= $shippers_list->StartRecord) {
		$shippers_list->RowCount++;

		// Set up key count
		$shippers_list->KeyCount = $shippers_list->RowIndex;

		// Init row class and style
		$shippers->resetAttributes();
		$shippers->CssClass = "";
		if ($shippers_list->isGridAdd()) {
		} else {
			$shippers_list->loadRowValues($shippers_list->Recordset); // Load row values
		}
		$shippers->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$shippers->RowAttrs->merge(["data-rowindex" => $shippers_list->RowCount, "id" => "r" . $shippers_list->RowCount . "_shippers", "data-rowtype" => $shippers->RowType]);

		// Render row
		$shippers_list->renderRow();

		// Render list options
		$shippers_list->renderListOptions();
?>
	<tr <?php echo $shippers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$shippers_list->ListOptions->render("body", "left", $shippers_list->RowCount);
?>
	<?php if ($shippers_list->ShipperID->Visible) { // ShipperID ?>
		<td data-name="ShipperID" <?php echo $shippers_list->ShipperID->cellAttributes() ?>>
<span id="el<?php echo $shippers_list->RowCount ?>_shippers_ShipperID">
<span<?php echo $shippers_list->ShipperID->viewAttributes() ?>><?php echo $shippers_list->ShipperID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($shippers_list->CompanyName->Visible) { // CompanyName ?>
		<td data-name="CompanyName" <?php echo $shippers_list->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $shippers_list->RowCount ?>_shippers_CompanyName">
<span<?php echo $shippers_list->CompanyName->viewAttributes() ?>><?php echo $shippers_list->CompanyName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($shippers_list->Phone->Visible) { // Phone ?>
		<td data-name="Phone" <?php echo $shippers_list->Phone->cellAttributes() ?>>
<span id="el<?php echo $shippers_list->RowCount ?>_shippers_Phone">
<span<?php echo $shippers_list->Phone->viewAttributes() ?>><?php echo $shippers_list->Phone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$shippers_list->ListOptions->render("body", "right", $shippers_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$shippers_list->isGridAdd())
		$shippers_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$shippers->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($shippers_list->Recordset)
	$shippers_list->Recordset->Close();
?>
<?php if (!$shippers_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$shippers_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $shippers_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $shippers_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($shippers_list->TotalRecords == 0 && !$shippers->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $shippers_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$shippers_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$shippers_list->isExport()) { ?>
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
$shippers_list->terminate();
?>