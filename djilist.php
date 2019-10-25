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
$dji_list = new dji_list();

// Run the page
$dji_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dji_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$dji_list->isExport()) { ?>
<script>
var fdjilist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdjilist = currentForm = new ew.Form("fdjilist", "list");
	fdjilist.formKeyCountName = '<?php echo $dji_list->FormKeyCountName ?>';
	loadjs.done("fdjilist");
});
var fdjilistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdjilistsrch = currentSearchForm = new ew.Form("fdjilistsrch");

	// Dynamic selection lists
	// Filters

	fdjilistsrch.filterList = <?php echo $dji_list->getFilterList() ?>;
	loadjs.done("fdjilistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$dji_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($dji_list->TotalRecords > 0 && $dji_list->ExportOptions->visible()) { ?>
<?php $dji_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($dji_list->ImportOptions->visible()) { ?>
<?php $dji_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($dji_list->SearchOptions->visible()) { ?>
<?php $dji_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($dji_list->FilterOptions->visible()) { ?>
<?php $dji_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$dji_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$dji_list->isExport() && !$dji->CurrentAction) { ?>
<form name="fdjilistsrch" id="fdjilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdjilistsrch-search-panel" class="<?php echo $dji_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="dji">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $dji_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($dji_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($dji_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $dji_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($dji_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($dji_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($dji_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($dji_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $dji_list->showPageHeader(); ?>
<?php
$dji_list->showMessage();
?>
<?php if ($dji_list->TotalRecords > 0 || $dji->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($dji_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> dji">
<form name="fdjilist" id="fdjilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dji">
<div id="gmp_dji" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($dji_list->TotalRecords > 0 || $dji_list->isGridEdit()) { ?>
<table id="tbl_djilist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$dji->RowType = ROWTYPE_HEADER;

// Render list options
$dji_list->renderListOptions();

// Render list options (header, left)
$dji_list->ListOptions->render("header", "left");
?>
<?php if ($dji_list->ID->Visible) { // ID ?>
	<?php if ($dji_list->SortUrl($dji_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $dji_list->ID->headerCellClass() ?>"><div id="elh_dji_ID" class="dji_ID"><div class="ew-table-header-caption"><?php echo $dji_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $dji_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dji_list->SortUrl($dji_list->ID) ?>', 1);"><div id="elh_dji_ID" class="dji_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dji_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($dji_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dji_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dji_list->Date->Visible) { // Date ?>
	<?php if ($dji_list->SortUrl($dji_list->Date) == "") { ?>
		<th data-name="Date" class="<?php echo $dji_list->Date->headerCellClass() ?>"><div id="elh_dji_Date" class="dji_Date"><div class="ew-table-header-caption"><?php echo $dji_list->Date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Date" class="<?php echo $dji_list->Date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dji_list->SortUrl($dji_list->Date) ?>', 1);"><div id="elh_dji_Date" class="dji_Date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dji_list->Date->caption() ?></span><span class="ew-table-header-sort"><?php if ($dji_list->Date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dji_list->Date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dji_list->Open->Visible) { // Open ?>
	<?php if ($dji_list->SortUrl($dji_list->Open) == "") { ?>
		<th data-name="Open" class="<?php echo $dji_list->Open->headerCellClass() ?>"><div id="elh_dji_Open" class="dji_Open"><div class="ew-table-header-caption"><?php echo $dji_list->Open->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Open" class="<?php echo $dji_list->Open->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dji_list->SortUrl($dji_list->Open) ?>', 1);"><div id="elh_dji_Open" class="dji_Open">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dji_list->Open->caption() ?></span><span class="ew-table-header-sort"><?php if ($dji_list->Open->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dji_list->Open->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dji_list->High->Visible) { // High ?>
	<?php if ($dji_list->SortUrl($dji_list->High) == "") { ?>
		<th data-name="High" class="<?php echo $dji_list->High->headerCellClass() ?>"><div id="elh_dji_High" class="dji_High"><div class="ew-table-header-caption"><?php echo $dji_list->High->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="High" class="<?php echo $dji_list->High->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dji_list->SortUrl($dji_list->High) ?>', 1);"><div id="elh_dji_High" class="dji_High">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dji_list->High->caption() ?></span><span class="ew-table-header-sort"><?php if ($dji_list->High->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dji_list->High->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dji_list->Low->Visible) { // Low ?>
	<?php if ($dji_list->SortUrl($dji_list->Low) == "") { ?>
		<th data-name="Low" class="<?php echo $dji_list->Low->headerCellClass() ?>"><div id="elh_dji_Low" class="dji_Low"><div class="ew-table-header-caption"><?php echo $dji_list->Low->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Low" class="<?php echo $dji_list->Low->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dji_list->SortUrl($dji_list->Low) ?>', 1);"><div id="elh_dji_Low" class="dji_Low">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dji_list->Low->caption() ?></span><span class="ew-table-header-sort"><?php if ($dji_list->Low->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dji_list->Low->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dji_list->Close->Visible) { // Close ?>
	<?php if ($dji_list->SortUrl($dji_list->Close) == "") { ?>
		<th data-name="Close" class="<?php echo $dji_list->Close->headerCellClass() ?>"><div id="elh_dji_Close" class="dji_Close"><div class="ew-table-header-caption"><?php echo $dji_list->Close->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Close" class="<?php echo $dji_list->Close->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dji_list->SortUrl($dji_list->Close) ?>', 1);"><div id="elh_dji_Close" class="dji_Close">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dji_list->Close->caption() ?></span><span class="ew-table-header-sort"><?php if ($dji_list->Close->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dji_list->Close->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dji_list->Volume->Visible) { // Volume ?>
	<?php if ($dji_list->SortUrl($dji_list->Volume) == "") { ?>
		<th data-name="Volume" class="<?php echo $dji_list->Volume->headerCellClass() ?>"><div id="elh_dji_Volume" class="dji_Volume"><div class="ew-table-header-caption"><?php echo $dji_list->Volume->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Volume" class="<?php echo $dji_list->Volume->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dji_list->SortUrl($dji_list->Volume) ?>', 1);"><div id="elh_dji_Volume" class="dji_Volume">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dji_list->Volume->caption() ?></span><span class="ew-table-header-sort"><?php if ($dji_list->Volume->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dji_list->Volume->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dji_list->Adj_Close->Visible) { // Adj Close ?>
	<?php if ($dji_list->SortUrl($dji_list->Adj_Close) == "") { ?>
		<th data-name="Adj_Close" class="<?php echo $dji_list->Adj_Close->headerCellClass() ?>"><div id="elh_dji_Adj_Close" class="dji_Adj_Close"><div class="ew-table-header-caption"><?php echo $dji_list->Adj_Close->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Adj_Close" class="<?php echo $dji_list->Adj_Close->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dji_list->SortUrl($dji_list->Adj_Close) ?>', 1);"><div id="elh_dji_Adj_Close" class="dji_Adj_Close">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dji_list->Adj_Close->caption() ?></span><span class="ew-table-header-sort"><?php if ($dji_list->Adj_Close->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dji_list->Adj_Close->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dji_list->Name->Visible) { // Name ?>
	<?php if ($dji_list->SortUrl($dji_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $dji_list->Name->headerCellClass() ?>"><div id="elh_dji_Name" class="dji_Name"><div class="ew-table-header-caption"><?php echo $dji_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $dji_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dji_list->SortUrl($dji_list->Name) ?>', 1);"><div id="elh_dji_Name" class="dji_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dji_list->Name->caption() ?></span><span class="ew-table-header-sort"><?php if ($dji_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dji_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dji_list->Name2->Visible) { // Name2 ?>
	<?php if ($dji_list->SortUrl($dji_list->Name2) == "") { ?>
		<th data-name="Name2" class="<?php echo $dji_list->Name2->headerCellClass() ?>"><div id="elh_dji_Name2" class="dji_Name2"><div class="ew-table-header-caption"><?php echo $dji_list->Name2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name2" class="<?php echo $dji_list->Name2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dji_list->SortUrl($dji_list->Name2) ?>', 1);"><div id="elh_dji_Name2" class="dji_Name2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dji_list->Name2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dji_list->Name2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dji_list->Name2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$dji_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($dji_list->ExportAll && $dji_list->isExport()) {
	$dji_list->StopRecord = $dji_list->TotalRecords;
} else {

	// Set the last record to display
	if ($dji_list->TotalRecords > $dji_list->StartRecord + $dji_list->DisplayRecords - 1)
		$dji_list->StopRecord = $dji_list->StartRecord + $dji_list->DisplayRecords - 1;
	else
		$dji_list->StopRecord = $dji_list->TotalRecords;
}
$dji_list->RecordCount = $dji_list->StartRecord - 1;
if ($dji_list->Recordset && !$dji_list->Recordset->EOF) {
	$dji_list->Recordset->moveFirst();
	$selectLimit = $dji_list->UseSelectLimit;
	if (!$selectLimit && $dji_list->StartRecord > 1)
		$dji_list->Recordset->move($dji_list->StartRecord - 1);
} elseif (!$dji->AllowAddDeleteRow && $dji_list->StopRecord == 0) {
	$dji_list->StopRecord = $dji->GridAddRowCount;
}

// Initialize aggregate
$dji->RowType = ROWTYPE_AGGREGATEINIT;
$dji->resetAttributes();
$dji_list->renderRow();
while ($dji_list->RecordCount < $dji_list->StopRecord) {
	$dji_list->RecordCount++;
	if ($dji_list->RecordCount >= $dji_list->StartRecord) {
		$dji_list->RowCount++;

		// Set up key count
		$dji_list->KeyCount = $dji_list->RowIndex;

		// Init row class and style
		$dji->resetAttributes();
		$dji->CssClass = "";
		if ($dji_list->isGridAdd()) {
		} else {
			$dji_list->loadRowValues($dji_list->Recordset); // Load row values
		}
		$dji->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$dji->RowAttrs->merge(["data-rowindex" => $dji_list->RowCount, "id" => "r" . $dji_list->RowCount . "_dji", "data-rowtype" => $dji->RowType]);

		// Render row
		$dji_list->renderRow();

		// Render list options
		$dji_list->renderListOptions();
?>
	<tr <?php echo $dji->rowAttributes() ?>>
<?php

// Render list options (body, left)
$dji_list->ListOptions->render("body", "left", $dji_list->RowCount);
?>
	<?php if ($dji_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $dji_list->ID->cellAttributes() ?>>
<span id="el<?php echo $dji_list->RowCount ?>_dji_ID">
<span<?php echo $dji_list->ID->viewAttributes() ?>><?php echo $dji_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dji_list->Date->Visible) { // Date ?>
		<td data-name="Date" <?php echo $dji_list->Date->cellAttributes() ?>>
<span id="el<?php echo $dji_list->RowCount ?>_dji_Date">
<span<?php echo $dji_list->Date->viewAttributes() ?>><?php echo $dji_list->Date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dji_list->Open->Visible) { // Open ?>
		<td data-name="Open" <?php echo $dji_list->Open->cellAttributes() ?>>
<span id="el<?php echo $dji_list->RowCount ?>_dji_Open">
<span<?php echo $dji_list->Open->viewAttributes() ?>><?php echo $dji_list->Open->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dji_list->High->Visible) { // High ?>
		<td data-name="High" <?php echo $dji_list->High->cellAttributes() ?>>
<span id="el<?php echo $dji_list->RowCount ?>_dji_High">
<span<?php echo $dji_list->High->viewAttributes() ?>><?php echo $dji_list->High->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dji_list->Low->Visible) { // Low ?>
		<td data-name="Low" <?php echo $dji_list->Low->cellAttributes() ?>>
<span id="el<?php echo $dji_list->RowCount ?>_dji_Low">
<span<?php echo $dji_list->Low->viewAttributes() ?>><?php echo $dji_list->Low->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dji_list->Close->Visible) { // Close ?>
		<td data-name="Close" <?php echo $dji_list->Close->cellAttributes() ?>>
<span id="el<?php echo $dji_list->RowCount ?>_dji_Close">
<span<?php echo $dji_list->Close->viewAttributes() ?>><?php echo $dji_list->Close->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dji_list->Volume->Visible) { // Volume ?>
		<td data-name="Volume" <?php echo $dji_list->Volume->cellAttributes() ?>>
<span id="el<?php echo $dji_list->RowCount ?>_dji_Volume">
<span<?php echo $dji_list->Volume->viewAttributes() ?>><?php echo $dji_list->Volume->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dji_list->Adj_Close->Visible) { // Adj Close ?>
		<td data-name="Adj_Close" <?php echo $dji_list->Adj_Close->cellAttributes() ?>>
<span id="el<?php echo $dji_list->RowCount ?>_dji_Adj_Close">
<span<?php echo $dji_list->Adj_Close->viewAttributes() ?>><?php echo $dji_list->Adj_Close->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dji_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $dji_list->Name->cellAttributes() ?>>
<span id="el<?php echo $dji_list->RowCount ?>_dji_Name">
<span<?php echo $dji_list->Name->viewAttributes() ?>><?php echo $dji_list->Name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dji_list->Name2->Visible) { // Name2 ?>
		<td data-name="Name2" <?php echo $dji_list->Name2->cellAttributes() ?>>
<span id="el<?php echo $dji_list->RowCount ?>_dji_Name2">
<span<?php echo $dji_list->Name2->viewAttributes() ?>><?php echo $dji_list->Name2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$dji_list->ListOptions->render("body", "right", $dji_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$dji_list->isGridAdd())
		$dji_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$dji->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($dji_list->Recordset)
	$dji_list->Recordset->Close();
?>
<?php if (!$dji_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$dji_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $dji_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $dji_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($dji_list->TotalRecords == 0 && !$dji->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $dji_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$dji_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$dji_list->isExport()) { ?>
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
$dji_list->terminate();
?>