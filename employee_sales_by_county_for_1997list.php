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
$employee_sales_by_county_for_1997_list = new employee_sales_by_county_for_1997_list();

// Run the page
$employee_sales_by_county_for_1997_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_sales_by_county_for_1997_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employee_sales_by_county_for_1997_list->isExport()) { ?>
<script>
var femployee_sales_by_county_for_1997list, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	femployee_sales_by_county_for_1997list = currentForm = new ew.Form("femployee_sales_by_county_for_1997list", "list");
	femployee_sales_by_county_for_1997list.formKeyCountName = '<?php echo $employee_sales_by_county_for_1997_list->FormKeyCountName ?>';
	loadjs.done("femployee_sales_by_county_for_1997list");
});
var femployee_sales_by_county_for_1997listsrch;
loadjs.ready("head", function() {

	// Form object for search
	femployee_sales_by_county_for_1997listsrch = currentSearchForm = new ew.Form("femployee_sales_by_county_for_1997listsrch");

	// Dynamic selection lists
	// Filters

	femployee_sales_by_county_for_1997listsrch.filterList = <?php echo $employee_sales_by_county_for_1997_list->getFilterList() ?>;
	loadjs.done("femployee_sales_by_county_for_1997listsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$employee_sales_by_county_for_1997_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($employee_sales_by_county_for_1997_list->TotalRecords > 0 && $employee_sales_by_county_for_1997_list->ExportOptions->visible()) { ?>
<?php $employee_sales_by_county_for_1997_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($employee_sales_by_county_for_1997_list->ImportOptions->visible()) { ?>
<?php $employee_sales_by_county_for_1997_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($employee_sales_by_county_for_1997_list->SearchOptions->visible()) { ?>
<?php $employee_sales_by_county_for_1997_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($employee_sales_by_county_for_1997_list->FilterOptions->visible()) { ?>
<?php $employee_sales_by_county_for_1997_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$employee_sales_by_county_for_1997_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$employee_sales_by_county_for_1997_list->isExport() && !$employee_sales_by_county_for_1997->CurrentAction) { ?>
<form name="femployee_sales_by_county_for_1997listsrch" id="femployee_sales_by_county_for_1997listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="femployee_sales_by_county_for_1997listsrch-search-panel" class="<?php echo $employee_sales_by_county_for_1997_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="employee_sales_by_county_for_1997">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $employee_sales_by_county_for_1997_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($employee_sales_by_county_for_1997_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($employee_sales_by_county_for_1997_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $employee_sales_by_county_for_1997_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($employee_sales_by_county_for_1997_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($employee_sales_by_county_for_1997_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($employee_sales_by_county_for_1997_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($employee_sales_by_county_for_1997_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $employee_sales_by_county_for_1997_list->showPageHeader(); ?>
<?php
$employee_sales_by_county_for_1997_list->showMessage();
?>
<?php if ($employee_sales_by_county_for_1997_list->TotalRecords > 0 || $employee_sales_by_county_for_1997->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($employee_sales_by_county_for_1997_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> employee_sales_by_county_for_1997">
<form name="femployee_sales_by_county_for_1997list" id="femployee_sales_by_county_for_1997list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee_sales_by_county_for_1997">
<div id="gmp_employee_sales_by_county_for_1997" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($employee_sales_by_county_for_1997_list->TotalRecords > 0 || $employee_sales_by_county_for_1997_list->isGridEdit()) { ?>
<table id="tbl_employee_sales_by_county_for_1997list" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$employee_sales_by_county_for_1997->RowType = ROWTYPE_HEADER;

// Render list options
$employee_sales_by_county_for_1997_list->renderListOptions();

// Render list options (header, left)
$employee_sales_by_county_for_1997_list->ListOptions->render("header", "left");
?>
<?php if ($employee_sales_by_county_for_1997_list->Country->Visible) { // Country ?>
	<?php if ($employee_sales_by_county_for_1997_list->SortUrl($employee_sales_by_county_for_1997_list->Country) == "") { ?>
		<th data-name="Country" class="<?php echo $employee_sales_by_county_for_1997_list->Country->headerCellClass() ?>"><div id="elh_employee_sales_by_county_for_1997_Country" class="employee_sales_by_county_for_1997_Country"><div class="ew-table-header-caption"><?php echo $employee_sales_by_county_for_1997_list->Country->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Country" class="<?php echo $employee_sales_by_county_for_1997_list->Country->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_sales_by_county_for_1997_list->SortUrl($employee_sales_by_county_for_1997_list->Country) ?>', 1);"><div id="elh_employee_sales_by_county_for_1997_Country" class="employee_sales_by_county_for_1997_Country">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_sales_by_county_for_1997_list->Country->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employee_sales_by_county_for_1997_list->Country->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_sales_by_county_for_1997_list->Country->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_sales_by_county_for_1997_list->LastName->Visible) { // LastName ?>
	<?php if ($employee_sales_by_county_for_1997_list->SortUrl($employee_sales_by_county_for_1997_list->LastName) == "") { ?>
		<th data-name="LastName" class="<?php echo $employee_sales_by_county_for_1997_list->LastName->headerCellClass() ?>"><div id="elh_employee_sales_by_county_for_1997_LastName" class="employee_sales_by_county_for_1997_LastName"><div class="ew-table-header-caption"><?php echo $employee_sales_by_county_for_1997_list->LastName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastName" class="<?php echo $employee_sales_by_county_for_1997_list->LastName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_sales_by_county_for_1997_list->SortUrl($employee_sales_by_county_for_1997_list->LastName) ?>', 1);"><div id="elh_employee_sales_by_county_for_1997_LastName" class="employee_sales_by_county_for_1997_LastName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_sales_by_county_for_1997_list->LastName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employee_sales_by_county_for_1997_list->LastName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_sales_by_county_for_1997_list->LastName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_sales_by_county_for_1997_list->FirstName->Visible) { // FirstName ?>
	<?php if ($employee_sales_by_county_for_1997_list->SortUrl($employee_sales_by_county_for_1997_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $employee_sales_by_county_for_1997_list->FirstName->headerCellClass() ?>"><div id="elh_employee_sales_by_county_for_1997_FirstName" class="employee_sales_by_county_for_1997_FirstName"><div class="ew-table-header-caption"><?php echo $employee_sales_by_county_for_1997_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $employee_sales_by_county_for_1997_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_sales_by_county_for_1997_list->SortUrl($employee_sales_by_county_for_1997_list->FirstName) ?>', 1);"><div id="elh_employee_sales_by_county_for_1997_FirstName" class="employee_sales_by_county_for_1997_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_sales_by_county_for_1997_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employee_sales_by_county_for_1997_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_sales_by_county_for_1997_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_sales_by_county_for_1997_list->ShippedDate->Visible) { // ShippedDate ?>
	<?php if ($employee_sales_by_county_for_1997_list->SortUrl($employee_sales_by_county_for_1997_list->ShippedDate) == "") { ?>
		<th data-name="ShippedDate" class="<?php echo $employee_sales_by_county_for_1997_list->ShippedDate->headerCellClass() ?>"><div id="elh_employee_sales_by_county_for_1997_ShippedDate" class="employee_sales_by_county_for_1997_ShippedDate"><div class="ew-table-header-caption"><?php echo $employee_sales_by_county_for_1997_list->ShippedDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShippedDate" class="<?php echo $employee_sales_by_county_for_1997_list->ShippedDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_sales_by_county_for_1997_list->SortUrl($employee_sales_by_county_for_1997_list->ShippedDate) ?>', 1);"><div id="elh_employee_sales_by_county_for_1997_ShippedDate" class="employee_sales_by_county_for_1997_ShippedDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_sales_by_county_for_1997_list->ShippedDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_sales_by_county_for_1997_list->ShippedDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_sales_by_county_for_1997_list->ShippedDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_sales_by_county_for_1997_list->OrderID->Visible) { // OrderID ?>
	<?php if ($employee_sales_by_county_for_1997_list->SortUrl($employee_sales_by_county_for_1997_list->OrderID) == "") { ?>
		<th data-name="OrderID" class="<?php echo $employee_sales_by_county_for_1997_list->OrderID->headerCellClass() ?>"><div id="elh_employee_sales_by_county_for_1997_OrderID" class="employee_sales_by_county_for_1997_OrderID"><div class="ew-table-header-caption"><?php echo $employee_sales_by_county_for_1997_list->OrderID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderID" class="<?php echo $employee_sales_by_county_for_1997_list->OrderID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_sales_by_county_for_1997_list->SortUrl($employee_sales_by_county_for_1997_list->OrderID) ?>', 1);"><div id="elh_employee_sales_by_county_for_1997_OrderID" class="employee_sales_by_county_for_1997_OrderID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_sales_by_county_for_1997_list->OrderID->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_sales_by_county_for_1997_list->OrderID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_sales_by_county_for_1997_list->OrderID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_sales_by_county_for_1997_list->Subtotal->Visible) { // Subtotal ?>
	<?php if ($employee_sales_by_county_for_1997_list->SortUrl($employee_sales_by_county_for_1997_list->Subtotal) == "") { ?>
		<th data-name="Subtotal" class="<?php echo $employee_sales_by_county_for_1997_list->Subtotal->headerCellClass() ?>"><div id="elh_employee_sales_by_county_for_1997_Subtotal" class="employee_sales_by_county_for_1997_Subtotal"><div class="ew-table-header-caption"><?php echo $employee_sales_by_county_for_1997_list->Subtotal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Subtotal" class="<?php echo $employee_sales_by_county_for_1997_list->Subtotal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_sales_by_county_for_1997_list->SortUrl($employee_sales_by_county_for_1997_list->Subtotal) ?>', 1);"><div id="elh_employee_sales_by_county_for_1997_Subtotal" class="employee_sales_by_county_for_1997_Subtotal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_sales_by_county_for_1997_list->Subtotal->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_sales_by_county_for_1997_list->Subtotal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_sales_by_county_for_1997_list->Subtotal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employee_sales_by_county_for_1997_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($employee_sales_by_county_for_1997_list->ExportAll && $employee_sales_by_county_for_1997_list->isExport()) {
	$employee_sales_by_county_for_1997_list->StopRecord = $employee_sales_by_county_for_1997_list->TotalRecords;
} else {

	// Set the last record to display
	if ($employee_sales_by_county_for_1997_list->TotalRecords > $employee_sales_by_county_for_1997_list->StartRecord + $employee_sales_by_county_for_1997_list->DisplayRecords - 1)
		$employee_sales_by_county_for_1997_list->StopRecord = $employee_sales_by_county_for_1997_list->StartRecord + $employee_sales_by_county_for_1997_list->DisplayRecords - 1;
	else
		$employee_sales_by_county_for_1997_list->StopRecord = $employee_sales_by_county_for_1997_list->TotalRecords;
}
$employee_sales_by_county_for_1997_list->RecordCount = $employee_sales_by_county_for_1997_list->StartRecord - 1;
if ($employee_sales_by_county_for_1997_list->Recordset && !$employee_sales_by_county_for_1997_list->Recordset->EOF) {
	$employee_sales_by_county_for_1997_list->Recordset->moveFirst();
	$selectLimit = $employee_sales_by_county_for_1997_list->UseSelectLimit;
	if (!$selectLimit && $employee_sales_by_county_for_1997_list->StartRecord > 1)
		$employee_sales_by_county_for_1997_list->Recordset->move($employee_sales_by_county_for_1997_list->StartRecord - 1);
} elseif (!$employee_sales_by_county_for_1997->AllowAddDeleteRow && $employee_sales_by_county_for_1997_list->StopRecord == 0) {
	$employee_sales_by_county_for_1997_list->StopRecord = $employee_sales_by_county_for_1997->GridAddRowCount;
}

// Initialize aggregate
$employee_sales_by_county_for_1997->RowType = ROWTYPE_AGGREGATEINIT;
$employee_sales_by_county_for_1997->resetAttributes();
$employee_sales_by_county_for_1997_list->renderRow();
while ($employee_sales_by_county_for_1997_list->RecordCount < $employee_sales_by_county_for_1997_list->StopRecord) {
	$employee_sales_by_county_for_1997_list->RecordCount++;
	if ($employee_sales_by_county_for_1997_list->RecordCount >= $employee_sales_by_county_for_1997_list->StartRecord) {
		$employee_sales_by_county_for_1997_list->RowCount++;

		// Set up key count
		$employee_sales_by_county_for_1997_list->KeyCount = $employee_sales_by_county_for_1997_list->RowIndex;

		// Init row class and style
		$employee_sales_by_county_for_1997->resetAttributes();
		$employee_sales_by_county_for_1997->CssClass = "";
		if ($employee_sales_by_county_for_1997_list->isGridAdd()) {
		} else {
			$employee_sales_by_county_for_1997_list->loadRowValues($employee_sales_by_county_for_1997_list->Recordset); // Load row values
		}
		$employee_sales_by_county_for_1997->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$employee_sales_by_county_for_1997->RowAttrs->merge(["data-rowindex" => $employee_sales_by_county_for_1997_list->RowCount, "id" => "r" . $employee_sales_by_county_for_1997_list->RowCount . "_employee_sales_by_county_for_1997", "data-rowtype" => $employee_sales_by_county_for_1997->RowType]);

		// Render row
		$employee_sales_by_county_for_1997_list->renderRow();

		// Render list options
		$employee_sales_by_county_for_1997_list->renderListOptions();
?>
	<tr <?php echo $employee_sales_by_county_for_1997->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employee_sales_by_county_for_1997_list->ListOptions->render("body", "left", $employee_sales_by_county_for_1997_list->RowCount);
?>
	<?php if ($employee_sales_by_county_for_1997_list->Country->Visible) { // Country ?>
		<td data-name="Country" <?php echo $employee_sales_by_county_for_1997_list->Country->cellAttributes() ?>>
<span id="el<?php echo $employee_sales_by_county_for_1997_list->RowCount ?>_employee_sales_by_county_for_1997_Country">
<span<?php echo $employee_sales_by_county_for_1997_list->Country->viewAttributes() ?>><?php echo $employee_sales_by_county_for_1997_list->Country->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_sales_by_county_for_1997_list->LastName->Visible) { // LastName ?>
		<td data-name="LastName" <?php echo $employee_sales_by_county_for_1997_list->LastName->cellAttributes() ?>>
<span id="el<?php echo $employee_sales_by_county_for_1997_list->RowCount ?>_employee_sales_by_county_for_1997_LastName">
<span<?php echo $employee_sales_by_county_for_1997_list->LastName->viewAttributes() ?>><?php echo $employee_sales_by_county_for_1997_list->LastName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_sales_by_county_for_1997_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $employee_sales_by_county_for_1997_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $employee_sales_by_county_for_1997_list->RowCount ?>_employee_sales_by_county_for_1997_FirstName">
<span<?php echo $employee_sales_by_county_for_1997_list->FirstName->viewAttributes() ?>><?php echo $employee_sales_by_county_for_1997_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_sales_by_county_for_1997_list->ShippedDate->Visible) { // ShippedDate ?>
		<td data-name="ShippedDate" <?php echo $employee_sales_by_county_for_1997_list->ShippedDate->cellAttributes() ?>>
<span id="el<?php echo $employee_sales_by_county_for_1997_list->RowCount ?>_employee_sales_by_county_for_1997_ShippedDate">
<span<?php echo $employee_sales_by_county_for_1997_list->ShippedDate->viewAttributes() ?>><?php echo $employee_sales_by_county_for_1997_list->ShippedDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_sales_by_county_for_1997_list->OrderID->Visible) { // OrderID ?>
		<td data-name="OrderID" <?php echo $employee_sales_by_county_for_1997_list->OrderID->cellAttributes() ?>>
<span id="el<?php echo $employee_sales_by_county_for_1997_list->RowCount ?>_employee_sales_by_county_for_1997_OrderID">
<span<?php echo $employee_sales_by_county_for_1997_list->OrderID->viewAttributes() ?>><?php echo $employee_sales_by_county_for_1997_list->OrderID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_sales_by_county_for_1997_list->Subtotal->Visible) { // Subtotal ?>
		<td data-name="Subtotal" <?php echo $employee_sales_by_county_for_1997_list->Subtotal->cellAttributes() ?>>
<span id="el<?php echo $employee_sales_by_county_for_1997_list->RowCount ?>_employee_sales_by_county_for_1997_Subtotal">
<span<?php echo $employee_sales_by_county_for_1997_list->Subtotal->viewAttributes() ?>><?php echo $employee_sales_by_county_for_1997_list->Subtotal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employee_sales_by_county_for_1997_list->ListOptions->render("body", "right", $employee_sales_by_county_for_1997_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$employee_sales_by_county_for_1997_list->isGridAdd())
		$employee_sales_by_county_for_1997_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$employee_sales_by_county_for_1997->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($employee_sales_by_county_for_1997_list->Recordset)
	$employee_sales_by_county_for_1997_list->Recordset->Close();
?>
<?php if (!$employee_sales_by_county_for_1997_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$employee_sales_by_county_for_1997_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employee_sales_by_county_for_1997_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employee_sales_by_county_for_1997_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($employee_sales_by_county_for_1997_list->TotalRecords == 0 && !$employee_sales_by_county_for_1997->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $employee_sales_by_county_for_1997_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$employee_sales_by_county_for_1997_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employee_sales_by_county_for_1997_list->isExport()) { ?>
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
$employee_sales_by_county_for_1997_list->terminate();
?>