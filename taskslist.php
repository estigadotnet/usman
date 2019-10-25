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
$tasks_list = new tasks_list();

// Run the page
$tasks_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tasks_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tasks_list->isExport()) { ?>
<script>
var ftaskslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftaskslist = currentForm = new ew.Form("ftaskslist", "list");
	ftaskslist.formKeyCountName = '<?php echo $tasks_list->FormKeyCountName ?>';
	loadjs.done("ftaskslist");
});
var ftaskslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftaskslistsrch = currentSearchForm = new ew.Form("ftaskslistsrch");

	// Dynamic selection lists
	// Filters

	ftaskslistsrch.filterList = <?php echo $tasks_list->getFilterList() ?>;
	loadjs.done("ftaskslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tasks_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tasks_list->TotalRecords > 0 && $tasks_list->ExportOptions->visible()) { ?>
<?php $tasks_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tasks_list->ImportOptions->visible()) { ?>
<?php $tasks_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tasks_list->SearchOptions->visible()) { ?>
<?php $tasks_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tasks_list->FilterOptions->visible()) { ?>
<?php $tasks_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tasks_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tasks_list->isExport() && !$tasks->CurrentAction) { ?>
<form name="ftaskslistsrch" id="ftaskslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftaskslistsrch-search-panel" class="<?php echo $tasks_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tasks">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tasks_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tasks_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tasks_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tasks_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tasks_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tasks_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tasks_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tasks_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tasks_list->showPageHeader(); ?>
<?php
$tasks_list->showMessage();
?>
<?php if ($tasks_list->TotalRecords > 0 || $tasks->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tasks_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tasks">
<form name="ftaskslist" id="ftaskslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tasks">
<div id="gmp_tasks" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tasks_list->TotalRecords > 0 || $tasks_list->isGridEdit()) { ?>
<table id="tbl_taskslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tasks->RowType = ROWTYPE_HEADER;

// Render list options
$tasks_list->renderListOptions();

// Render list options (header, left)
$tasks_list->ListOptions->render("header", "left");
?>
<?php if ($tasks_list->TaskID->Visible) { // TaskID ?>
	<?php if ($tasks_list->SortUrl($tasks_list->TaskID) == "") { ?>
		<th data-name="TaskID" class="<?php echo $tasks_list->TaskID->headerCellClass() ?>"><div id="elh_tasks_TaskID" class="tasks_TaskID"><div class="ew-table-header-caption"><?php echo $tasks_list->TaskID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TaskID" class="<?php echo $tasks_list->TaskID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tasks_list->SortUrl($tasks_list->TaskID) ?>', 1);"><div id="elh_tasks_TaskID" class="tasks_TaskID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tasks_list->TaskID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tasks_list->TaskID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tasks_list->TaskID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tasks_list->TaskName->Visible) { // TaskName ?>
	<?php if ($tasks_list->SortUrl($tasks_list->TaskName) == "") { ?>
		<th data-name="TaskName" class="<?php echo $tasks_list->TaskName->headerCellClass() ?>"><div id="elh_tasks_TaskName" class="tasks_TaskName"><div class="ew-table-header-caption"><?php echo $tasks_list->TaskName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TaskName" class="<?php echo $tasks_list->TaskName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tasks_list->SortUrl($tasks_list->TaskName) ?>', 1);"><div id="elh_tasks_TaskName" class="tasks_TaskName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tasks_list->TaskName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tasks_list->TaskName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tasks_list->TaskName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tasks_list->ResourceID->Visible) { // ResourceID ?>
	<?php if ($tasks_list->SortUrl($tasks_list->ResourceID) == "") { ?>
		<th data-name="ResourceID" class="<?php echo $tasks_list->ResourceID->headerCellClass() ?>"><div id="elh_tasks_ResourceID" class="tasks_ResourceID"><div class="ew-table-header-caption"><?php echo $tasks_list->ResourceID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ResourceID" class="<?php echo $tasks_list->ResourceID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tasks_list->SortUrl($tasks_list->ResourceID) ?>', 1);"><div id="elh_tasks_ResourceID" class="tasks_ResourceID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tasks_list->ResourceID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tasks_list->ResourceID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tasks_list->ResourceID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tasks_list->Start->Visible) { // Start ?>
	<?php if ($tasks_list->SortUrl($tasks_list->Start) == "") { ?>
		<th data-name="Start" class="<?php echo $tasks_list->Start->headerCellClass() ?>"><div id="elh_tasks_Start" class="tasks_Start"><div class="ew-table-header-caption"><?php echo $tasks_list->Start->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Start" class="<?php echo $tasks_list->Start->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tasks_list->SortUrl($tasks_list->Start) ?>', 1);"><div id="elh_tasks_Start" class="tasks_Start">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tasks_list->Start->caption() ?></span><span class="ew-table-header-sort"><?php if ($tasks_list->Start->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tasks_list->Start->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tasks_list->End->Visible) { // End ?>
	<?php if ($tasks_list->SortUrl($tasks_list->End) == "") { ?>
		<th data-name="End" class="<?php echo $tasks_list->End->headerCellClass() ?>"><div id="elh_tasks_End" class="tasks_End"><div class="ew-table-header-caption"><?php echo $tasks_list->End->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="End" class="<?php echo $tasks_list->End->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tasks_list->SortUrl($tasks_list->End) ?>', 1);"><div id="elh_tasks_End" class="tasks_End">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tasks_list->End->caption() ?></span><span class="ew-table-header-sort"><?php if ($tasks_list->End->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tasks_list->End->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tasks_list->Description->Visible) { // Description ?>
	<?php if ($tasks_list->SortUrl($tasks_list->Description) == "") { ?>
		<th data-name="Description" class="<?php echo $tasks_list->Description->headerCellClass() ?>"><div id="elh_tasks_Description" class="tasks_Description"><div class="ew-table-header-caption"><?php echo $tasks_list->Description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Description" class="<?php echo $tasks_list->Description->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tasks_list->SortUrl($tasks_list->Description) ?>', 1);"><div id="elh_tasks_Description" class="tasks_Description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tasks_list->Description->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tasks_list->Description->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tasks_list->Description->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tasks_list->Milestone->Visible) { // Milestone ?>
	<?php if ($tasks_list->SortUrl($tasks_list->Milestone) == "") { ?>
		<th data-name="Milestone" class="<?php echo $tasks_list->Milestone->headerCellClass() ?>"><div id="elh_tasks_Milestone" class="tasks_Milestone"><div class="ew-table-header-caption"><?php echo $tasks_list->Milestone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Milestone" class="<?php echo $tasks_list->Milestone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tasks_list->SortUrl($tasks_list->Milestone) ?>', 1);"><div id="elh_tasks_Milestone" class="tasks_Milestone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tasks_list->Milestone->caption() ?></span><span class="ew-table-header-sort"><?php if ($tasks_list->Milestone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tasks_list->Milestone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tasks_list->Duration->Visible) { // Duration ?>
	<?php if ($tasks_list->SortUrl($tasks_list->Duration) == "") { ?>
		<th data-name="Duration" class="<?php echo $tasks_list->Duration->headerCellClass() ?>"><div id="elh_tasks_Duration" class="tasks_Duration"><div class="ew-table-header-caption"><?php echo $tasks_list->Duration->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Duration" class="<?php echo $tasks_list->Duration->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tasks_list->SortUrl($tasks_list->Duration) ?>', 1);"><div id="elh_tasks_Duration" class="tasks_Duration">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tasks_list->Duration->caption() ?></span><span class="ew-table-header-sort"><?php if ($tasks_list->Duration->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tasks_list->Duration->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tasks_list->PercentComplete->Visible) { // PercentComplete ?>
	<?php if ($tasks_list->SortUrl($tasks_list->PercentComplete) == "") { ?>
		<th data-name="PercentComplete" class="<?php echo $tasks_list->PercentComplete->headerCellClass() ?>"><div id="elh_tasks_PercentComplete" class="tasks_PercentComplete"><div class="ew-table-header-caption"><?php echo $tasks_list->PercentComplete->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PercentComplete" class="<?php echo $tasks_list->PercentComplete->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tasks_list->SortUrl($tasks_list->PercentComplete) ?>', 1);"><div id="elh_tasks_PercentComplete" class="tasks_PercentComplete">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tasks_list->PercentComplete->caption() ?></span><span class="ew-table-header-sort"><?php if ($tasks_list->PercentComplete->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tasks_list->PercentComplete->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tasks_list->Dependencies->Visible) { // Dependencies ?>
	<?php if ($tasks_list->SortUrl($tasks_list->Dependencies) == "") { ?>
		<th data-name="Dependencies" class="<?php echo $tasks_list->Dependencies->headerCellClass() ?>"><div id="elh_tasks_Dependencies" class="tasks_Dependencies"><div class="ew-table-header-caption"><?php echo $tasks_list->Dependencies->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Dependencies" class="<?php echo $tasks_list->Dependencies->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tasks_list->SortUrl($tasks_list->Dependencies) ?>', 1);"><div id="elh_tasks_Dependencies" class="tasks_Dependencies">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tasks_list->Dependencies->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tasks_list->Dependencies->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tasks_list->Dependencies->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tasks_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tasks_list->ExportAll && $tasks_list->isExport()) {
	$tasks_list->StopRecord = $tasks_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tasks_list->TotalRecords > $tasks_list->StartRecord + $tasks_list->DisplayRecords - 1)
		$tasks_list->StopRecord = $tasks_list->StartRecord + $tasks_list->DisplayRecords - 1;
	else
		$tasks_list->StopRecord = $tasks_list->TotalRecords;
}
$tasks_list->RecordCount = $tasks_list->StartRecord - 1;
if ($tasks_list->Recordset && !$tasks_list->Recordset->EOF) {
	$tasks_list->Recordset->moveFirst();
	$selectLimit = $tasks_list->UseSelectLimit;
	if (!$selectLimit && $tasks_list->StartRecord > 1)
		$tasks_list->Recordset->move($tasks_list->StartRecord - 1);
} elseif (!$tasks->AllowAddDeleteRow && $tasks_list->StopRecord == 0) {
	$tasks_list->StopRecord = $tasks->GridAddRowCount;
}

// Initialize aggregate
$tasks->RowType = ROWTYPE_AGGREGATEINIT;
$tasks->resetAttributes();
$tasks_list->renderRow();
while ($tasks_list->RecordCount < $tasks_list->StopRecord) {
	$tasks_list->RecordCount++;
	if ($tasks_list->RecordCount >= $tasks_list->StartRecord) {
		$tasks_list->RowCount++;

		// Set up key count
		$tasks_list->KeyCount = $tasks_list->RowIndex;

		// Init row class and style
		$tasks->resetAttributes();
		$tasks->CssClass = "";
		if ($tasks_list->isGridAdd()) {
		} else {
			$tasks_list->loadRowValues($tasks_list->Recordset); // Load row values
		}
		$tasks->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tasks->RowAttrs->merge(["data-rowindex" => $tasks_list->RowCount, "id" => "r" . $tasks_list->RowCount . "_tasks", "data-rowtype" => $tasks->RowType]);

		// Render row
		$tasks_list->renderRow();

		// Render list options
		$tasks_list->renderListOptions();
?>
	<tr <?php echo $tasks->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tasks_list->ListOptions->render("body", "left", $tasks_list->RowCount);
?>
	<?php if ($tasks_list->TaskID->Visible) { // TaskID ?>
		<td data-name="TaskID" <?php echo $tasks_list->TaskID->cellAttributes() ?>>
<span id="el<?php echo $tasks_list->RowCount ?>_tasks_TaskID">
<span<?php echo $tasks_list->TaskID->viewAttributes() ?>><?php echo $tasks_list->TaskID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tasks_list->TaskName->Visible) { // TaskName ?>
		<td data-name="TaskName" <?php echo $tasks_list->TaskName->cellAttributes() ?>>
<span id="el<?php echo $tasks_list->RowCount ?>_tasks_TaskName">
<span<?php echo $tasks_list->TaskName->viewAttributes() ?>><?php echo $tasks_list->TaskName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tasks_list->ResourceID->Visible) { // ResourceID ?>
		<td data-name="ResourceID" <?php echo $tasks_list->ResourceID->cellAttributes() ?>>
<span id="el<?php echo $tasks_list->RowCount ?>_tasks_ResourceID">
<span<?php echo $tasks_list->ResourceID->viewAttributes() ?>><?php echo $tasks_list->ResourceID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tasks_list->Start->Visible) { // Start ?>
		<td data-name="Start" <?php echo $tasks_list->Start->cellAttributes() ?>>
<span id="el<?php echo $tasks_list->RowCount ?>_tasks_Start">
<span<?php echo $tasks_list->Start->viewAttributes() ?>><?php echo $tasks_list->Start->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tasks_list->End->Visible) { // End ?>
		<td data-name="End" <?php echo $tasks_list->End->cellAttributes() ?>>
<span id="el<?php echo $tasks_list->RowCount ?>_tasks_End">
<span<?php echo $tasks_list->End->viewAttributes() ?>><?php echo $tasks_list->End->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tasks_list->Description->Visible) { // Description ?>
		<td data-name="Description" <?php echo $tasks_list->Description->cellAttributes() ?>>
<span id="el<?php echo $tasks_list->RowCount ?>_tasks_Description">
<span<?php echo $tasks_list->Description->viewAttributes() ?>><?php echo $tasks_list->Description->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tasks_list->Milestone->Visible) { // Milestone ?>
		<td data-name="Milestone" <?php echo $tasks_list->Milestone->cellAttributes() ?>>
<span id="el<?php echo $tasks_list->RowCount ?>_tasks_Milestone">
<span<?php echo $tasks_list->Milestone->viewAttributes() ?>><?php echo $tasks_list->Milestone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tasks_list->Duration->Visible) { // Duration ?>
		<td data-name="Duration" <?php echo $tasks_list->Duration->cellAttributes() ?>>
<span id="el<?php echo $tasks_list->RowCount ?>_tasks_Duration">
<span<?php echo $tasks_list->Duration->viewAttributes() ?>><?php echo $tasks_list->Duration->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tasks_list->PercentComplete->Visible) { // PercentComplete ?>
		<td data-name="PercentComplete" <?php echo $tasks_list->PercentComplete->cellAttributes() ?>>
<span id="el<?php echo $tasks_list->RowCount ?>_tasks_PercentComplete">
<span<?php echo $tasks_list->PercentComplete->viewAttributes() ?>><?php echo $tasks_list->PercentComplete->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tasks_list->Dependencies->Visible) { // Dependencies ?>
		<td data-name="Dependencies" <?php echo $tasks_list->Dependencies->cellAttributes() ?>>
<span id="el<?php echo $tasks_list->RowCount ?>_tasks_Dependencies">
<span<?php echo $tasks_list->Dependencies->viewAttributes() ?>><?php echo $tasks_list->Dependencies->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tasks_list->ListOptions->render("body", "right", $tasks_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tasks_list->isGridAdd())
		$tasks_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tasks->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tasks_list->Recordset)
	$tasks_list->Recordset->Close();
?>
<?php if (!$tasks_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tasks_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tasks_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tasks_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tasks_list->TotalRecords == 0 && !$tasks->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tasks_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tasks_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tasks_list->isExport()) { ?>
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
$tasks_list->terminate();
?>