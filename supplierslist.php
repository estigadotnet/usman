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
$suppliers_list = new suppliers_list();

// Run the page
$suppliers_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$suppliers_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$suppliers_list->isExport()) { ?>
<script>
var fsupplierslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsupplierslist = currentForm = new ew.Form("fsupplierslist", "list");
	fsupplierslist.formKeyCountName = '<?php echo $suppliers_list->FormKeyCountName ?>';
	loadjs.done("fsupplierslist");
});
var fsupplierslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fsupplierslistsrch = currentSearchForm = new ew.Form("fsupplierslistsrch");

	// Dynamic selection lists
	// Filters

	fsupplierslistsrch.filterList = <?php echo $suppliers_list->getFilterList() ?>;
	loadjs.done("fsupplierslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$suppliers_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($suppliers_list->TotalRecords > 0 && $suppliers_list->ExportOptions->visible()) { ?>
<?php $suppliers_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($suppliers_list->ImportOptions->visible()) { ?>
<?php $suppliers_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($suppliers_list->SearchOptions->visible()) { ?>
<?php $suppliers_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($suppliers_list->FilterOptions->visible()) { ?>
<?php $suppliers_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$suppliers_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$suppliers_list->isExport() && !$suppliers->CurrentAction) { ?>
<form name="fsupplierslistsrch" id="fsupplierslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsupplierslistsrch-search-panel" class="<?php echo $suppliers_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="suppliers">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $suppliers_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($suppliers_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($suppliers_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $suppliers_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($suppliers_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($suppliers_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($suppliers_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($suppliers_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $suppliers_list->showPageHeader(); ?>
<?php
$suppliers_list->showMessage();
?>
<?php if ($suppliers_list->TotalRecords > 0 || $suppliers->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($suppliers_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> suppliers">
<form name="fsupplierslist" id="fsupplierslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="suppliers">
<div id="gmp_suppliers" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($suppliers_list->TotalRecords > 0 || $suppliers_list->isGridEdit()) { ?>
<table id="tbl_supplierslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$suppliers->RowType = ROWTYPE_HEADER;

// Render list options
$suppliers_list->renderListOptions();

// Render list options (header, left)
$suppliers_list->ListOptions->render("header", "left");
?>
<?php if ($suppliers_list->SupplierID->Visible) { // SupplierID ?>
	<?php if ($suppliers_list->SortUrl($suppliers_list->SupplierID) == "") { ?>
		<th data-name="SupplierID" class="<?php echo $suppliers_list->SupplierID->headerCellClass() ?>"><div id="elh_suppliers_SupplierID" class="suppliers_SupplierID"><div class="ew-table-header-caption"><?php echo $suppliers_list->SupplierID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SupplierID" class="<?php echo $suppliers_list->SupplierID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $suppliers_list->SortUrl($suppliers_list->SupplierID) ?>', 1);"><div id="elh_suppliers_SupplierID" class="suppliers_SupplierID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers_list->SupplierID->caption() ?></span><span class="ew-table-header-sort"><?php if ($suppliers_list->SupplierID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($suppliers_list->SupplierID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($suppliers_list->CompanyName->Visible) { // CompanyName ?>
	<?php if ($suppliers_list->SortUrl($suppliers_list->CompanyName) == "") { ?>
		<th data-name="CompanyName" class="<?php echo $suppliers_list->CompanyName->headerCellClass() ?>"><div id="elh_suppliers_CompanyName" class="suppliers_CompanyName"><div class="ew-table-header-caption"><?php echo $suppliers_list->CompanyName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CompanyName" class="<?php echo $suppliers_list->CompanyName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $suppliers_list->SortUrl($suppliers_list->CompanyName) ?>', 1);"><div id="elh_suppliers_CompanyName" class="suppliers_CompanyName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers_list->CompanyName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($suppliers_list->CompanyName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($suppliers_list->CompanyName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($suppliers_list->ContactName->Visible) { // ContactName ?>
	<?php if ($suppliers_list->SortUrl($suppliers_list->ContactName) == "") { ?>
		<th data-name="ContactName" class="<?php echo $suppliers_list->ContactName->headerCellClass() ?>"><div id="elh_suppliers_ContactName" class="suppliers_ContactName"><div class="ew-table-header-caption"><?php echo $suppliers_list->ContactName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactName" class="<?php echo $suppliers_list->ContactName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $suppliers_list->SortUrl($suppliers_list->ContactName) ?>', 1);"><div id="elh_suppliers_ContactName" class="suppliers_ContactName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers_list->ContactName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($suppliers_list->ContactName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($suppliers_list->ContactName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($suppliers_list->ContactTitle->Visible) { // ContactTitle ?>
	<?php if ($suppliers_list->SortUrl($suppliers_list->ContactTitle) == "") { ?>
		<th data-name="ContactTitle" class="<?php echo $suppliers_list->ContactTitle->headerCellClass() ?>"><div id="elh_suppliers_ContactTitle" class="suppliers_ContactTitle"><div class="ew-table-header-caption"><?php echo $suppliers_list->ContactTitle->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactTitle" class="<?php echo $suppliers_list->ContactTitle->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $suppliers_list->SortUrl($suppliers_list->ContactTitle) ?>', 1);"><div id="elh_suppliers_ContactTitle" class="suppliers_ContactTitle">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers_list->ContactTitle->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($suppliers_list->ContactTitle->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($suppliers_list->ContactTitle->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($suppliers_list->Address->Visible) { // Address ?>
	<?php if ($suppliers_list->SortUrl($suppliers_list->Address) == "") { ?>
		<th data-name="Address" class="<?php echo $suppliers_list->Address->headerCellClass() ?>"><div id="elh_suppliers_Address" class="suppliers_Address"><div class="ew-table-header-caption"><?php echo $suppliers_list->Address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Address" class="<?php echo $suppliers_list->Address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $suppliers_list->SortUrl($suppliers_list->Address) ?>', 1);"><div id="elh_suppliers_Address" class="suppliers_Address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers_list->Address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($suppliers_list->Address->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($suppliers_list->Address->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($suppliers_list->City->Visible) { // City ?>
	<?php if ($suppliers_list->SortUrl($suppliers_list->City) == "") { ?>
		<th data-name="City" class="<?php echo $suppliers_list->City->headerCellClass() ?>"><div id="elh_suppliers_City" class="suppliers_City"><div class="ew-table-header-caption"><?php echo $suppliers_list->City->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="City" class="<?php echo $suppliers_list->City->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $suppliers_list->SortUrl($suppliers_list->City) ?>', 1);"><div id="elh_suppliers_City" class="suppliers_City">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers_list->City->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($suppliers_list->City->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($suppliers_list->City->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($suppliers_list->Region->Visible) { // Region ?>
	<?php if ($suppliers_list->SortUrl($suppliers_list->Region) == "") { ?>
		<th data-name="Region" class="<?php echo $suppliers_list->Region->headerCellClass() ?>"><div id="elh_suppliers_Region" class="suppliers_Region"><div class="ew-table-header-caption"><?php echo $suppliers_list->Region->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Region" class="<?php echo $suppliers_list->Region->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $suppliers_list->SortUrl($suppliers_list->Region) ?>', 1);"><div id="elh_suppliers_Region" class="suppliers_Region">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers_list->Region->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($suppliers_list->Region->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($suppliers_list->Region->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($suppliers_list->PostalCode->Visible) { // PostalCode ?>
	<?php if ($suppliers_list->SortUrl($suppliers_list->PostalCode) == "") { ?>
		<th data-name="PostalCode" class="<?php echo $suppliers_list->PostalCode->headerCellClass() ?>"><div id="elh_suppliers_PostalCode" class="suppliers_PostalCode"><div class="ew-table-header-caption"><?php echo $suppliers_list->PostalCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PostalCode" class="<?php echo $suppliers_list->PostalCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $suppliers_list->SortUrl($suppliers_list->PostalCode) ?>', 1);"><div id="elh_suppliers_PostalCode" class="suppliers_PostalCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers_list->PostalCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($suppliers_list->PostalCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($suppliers_list->PostalCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($suppliers_list->Country->Visible) { // Country ?>
	<?php if ($suppliers_list->SortUrl($suppliers_list->Country) == "") { ?>
		<th data-name="Country" class="<?php echo $suppliers_list->Country->headerCellClass() ?>"><div id="elh_suppliers_Country" class="suppliers_Country"><div class="ew-table-header-caption"><?php echo $suppliers_list->Country->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Country" class="<?php echo $suppliers_list->Country->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $suppliers_list->SortUrl($suppliers_list->Country) ?>', 1);"><div id="elh_suppliers_Country" class="suppliers_Country">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers_list->Country->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($suppliers_list->Country->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($suppliers_list->Country->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($suppliers_list->Phone->Visible) { // Phone ?>
	<?php if ($suppliers_list->SortUrl($suppliers_list->Phone) == "") { ?>
		<th data-name="Phone" class="<?php echo $suppliers_list->Phone->headerCellClass() ?>"><div id="elh_suppliers_Phone" class="suppliers_Phone"><div class="ew-table-header-caption"><?php echo $suppliers_list->Phone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Phone" class="<?php echo $suppliers_list->Phone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $suppliers_list->SortUrl($suppliers_list->Phone) ?>', 1);"><div id="elh_suppliers_Phone" class="suppliers_Phone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers_list->Phone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($suppliers_list->Phone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($suppliers_list->Phone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($suppliers_list->Fax->Visible) { // Fax ?>
	<?php if ($suppliers_list->SortUrl($suppliers_list->Fax) == "") { ?>
		<th data-name="Fax" class="<?php echo $suppliers_list->Fax->headerCellClass() ?>"><div id="elh_suppliers_Fax" class="suppliers_Fax"><div class="ew-table-header-caption"><?php echo $suppliers_list->Fax->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fax" class="<?php echo $suppliers_list->Fax->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $suppliers_list->SortUrl($suppliers_list->Fax) ?>', 1);"><div id="elh_suppliers_Fax" class="suppliers_Fax">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $suppliers_list->Fax->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($suppliers_list->Fax->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($suppliers_list->Fax->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$suppliers_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($suppliers_list->ExportAll && $suppliers_list->isExport()) {
	$suppliers_list->StopRecord = $suppliers_list->TotalRecords;
} else {

	// Set the last record to display
	if ($suppliers_list->TotalRecords > $suppliers_list->StartRecord + $suppliers_list->DisplayRecords - 1)
		$suppliers_list->StopRecord = $suppliers_list->StartRecord + $suppliers_list->DisplayRecords - 1;
	else
		$suppliers_list->StopRecord = $suppliers_list->TotalRecords;
}
$suppliers_list->RecordCount = $suppliers_list->StartRecord - 1;
if ($suppliers_list->Recordset && !$suppliers_list->Recordset->EOF) {
	$suppliers_list->Recordset->moveFirst();
	$selectLimit = $suppliers_list->UseSelectLimit;
	if (!$selectLimit && $suppliers_list->StartRecord > 1)
		$suppliers_list->Recordset->move($suppliers_list->StartRecord - 1);
} elseif (!$suppliers->AllowAddDeleteRow && $suppliers_list->StopRecord == 0) {
	$suppliers_list->StopRecord = $suppliers->GridAddRowCount;
}

// Initialize aggregate
$suppliers->RowType = ROWTYPE_AGGREGATEINIT;
$suppliers->resetAttributes();
$suppliers_list->renderRow();
while ($suppliers_list->RecordCount < $suppliers_list->StopRecord) {
	$suppliers_list->RecordCount++;
	if ($suppliers_list->RecordCount >= $suppliers_list->StartRecord) {
		$suppliers_list->RowCount++;

		// Set up key count
		$suppliers_list->KeyCount = $suppliers_list->RowIndex;

		// Init row class and style
		$suppliers->resetAttributes();
		$suppliers->CssClass = "";
		if ($suppliers_list->isGridAdd()) {
		} else {
			$suppliers_list->loadRowValues($suppliers_list->Recordset); // Load row values
		}
		$suppliers->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$suppliers->RowAttrs->merge(["data-rowindex" => $suppliers_list->RowCount, "id" => "r" . $suppliers_list->RowCount . "_suppliers", "data-rowtype" => $suppliers->RowType]);

		// Render row
		$suppliers_list->renderRow();

		// Render list options
		$suppliers_list->renderListOptions();
?>
	<tr <?php echo $suppliers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$suppliers_list->ListOptions->render("body", "left", $suppliers_list->RowCount);
?>
	<?php if ($suppliers_list->SupplierID->Visible) { // SupplierID ?>
		<td data-name="SupplierID" <?php echo $suppliers_list->SupplierID->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCount ?>_suppliers_SupplierID">
<span<?php echo $suppliers_list->SupplierID->viewAttributes() ?>><?php echo $suppliers_list->SupplierID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($suppliers_list->CompanyName->Visible) { // CompanyName ?>
		<td data-name="CompanyName" <?php echo $suppliers_list->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCount ?>_suppliers_CompanyName">
<span<?php echo $suppliers_list->CompanyName->viewAttributes() ?>><?php echo $suppliers_list->CompanyName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($suppliers_list->ContactName->Visible) { // ContactName ?>
		<td data-name="ContactName" <?php echo $suppliers_list->ContactName->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCount ?>_suppliers_ContactName">
<span<?php echo $suppliers_list->ContactName->viewAttributes() ?>><?php echo $suppliers_list->ContactName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($suppliers_list->ContactTitle->Visible) { // ContactTitle ?>
		<td data-name="ContactTitle" <?php echo $suppliers_list->ContactTitle->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCount ?>_suppliers_ContactTitle">
<span<?php echo $suppliers_list->ContactTitle->viewAttributes() ?>><?php echo $suppliers_list->ContactTitle->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($suppliers_list->Address->Visible) { // Address ?>
		<td data-name="Address" <?php echo $suppliers_list->Address->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCount ?>_suppliers_Address">
<span<?php echo $suppliers_list->Address->viewAttributes() ?>><?php echo $suppliers_list->Address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($suppliers_list->City->Visible) { // City ?>
		<td data-name="City" <?php echo $suppliers_list->City->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCount ?>_suppliers_City">
<span<?php echo $suppliers_list->City->viewAttributes() ?>><?php echo $suppliers_list->City->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($suppliers_list->Region->Visible) { // Region ?>
		<td data-name="Region" <?php echo $suppliers_list->Region->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCount ?>_suppliers_Region">
<span<?php echo $suppliers_list->Region->viewAttributes() ?>><?php echo $suppliers_list->Region->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($suppliers_list->PostalCode->Visible) { // PostalCode ?>
		<td data-name="PostalCode" <?php echo $suppliers_list->PostalCode->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCount ?>_suppliers_PostalCode">
<span<?php echo $suppliers_list->PostalCode->viewAttributes() ?>><?php echo $suppliers_list->PostalCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($suppliers_list->Country->Visible) { // Country ?>
		<td data-name="Country" <?php echo $suppliers_list->Country->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCount ?>_suppliers_Country">
<span<?php echo $suppliers_list->Country->viewAttributes() ?>><?php echo $suppliers_list->Country->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($suppliers_list->Phone->Visible) { // Phone ?>
		<td data-name="Phone" <?php echo $suppliers_list->Phone->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCount ?>_suppliers_Phone">
<span<?php echo $suppliers_list->Phone->viewAttributes() ?>><?php echo $suppliers_list->Phone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($suppliers_list->Fax->Visible) { // Fax ?>
		<td data-name="Fax" <?php echo $suppliers_list->Fax->cellAttributes() ?>>
<span id="el<?php echo $suppliers_list->RowCount ?>_suppliers_Fax">
<span<?php echo $suppliers_list->Fax->viewAttributes() ?>><?php echo $suppliers_list->Fax->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$suppliers_list->ListOptions->render("body", "right", $suppliers_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$suppliers_list->isGridAdd())
		$suppliers_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$suppliers->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($suppliers_list->Recordset)
	$suppliers_list->Recordset->Close();
?>
<?php if (!$suppliers_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$suppliers_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $suppliers_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $suppliers_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($suppliers_list->TotalRecords == 0 && !$suppliers->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $suppliers_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$suppliers_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$suppliers_list->isExport()) { ?>
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
$suppliers_list->terminate();
?>