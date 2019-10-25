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
$customers_list = new customers_list();

// Run the page
$customers_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$customers_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$customers_list->isExport()) { ?>
<script>
var fcustomerslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcustomerslist = currentForm = new ew.Form("fcustomerslist", "list");
	fcustomerslist.formKeyCountName = '<?php echo $customers_list->FormKeyCountName ?>';
	loadjs.done("fcustomerslist");
});
var fcustomerslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcustomerslistsrch = currentSearchForm = new ew.Form("fcustomerslistsrch");

	// Dynamic selection lists
	// Filters

	fcustomerslistsrch.filterList = <?php echo $customers_list->getFilterList() ?>;
	loadjs.done("fcustomerslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$customers_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($customers_list->TotalRecords > 0 && $customers_list->ExportOptions->visible()) { ?>
<?php $customers_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($customers_list->ImportOptions->visible()) { ?>
<?php $customers_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($customers_list->SearchOptions->visible()) { ?>
<?php $customers_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($customers_list->FilterOptions->visible()) { ?>
<?php $customers_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$customers_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$customers_list->isExport() && !$customers->CurrentAction) { ?>
<form name="fcustomerslistsrch" id="fcustomerslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcustomerslistsrch-search-panel" class="<?php echo $customers_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="customers">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $customers_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($customers_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($customers_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $customers_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($customers_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($customers_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($customers_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($customers_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $customers_list->showPageHeader(); ?>
<?php
$customers_list->showMessage();
?>
<?php if ($customers_list->TotalRecords > 0 || $customers->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($customers_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> customers">
<form name="fcustomerslist" id="fcustomerslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="customers">
<div id="gmp_customers" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($customers_list->TotalRecords > 0 || $customers_list->isGridEdit()) { ?>
<table id="tbl_customerslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$customers->RowType = ROWTYPE_HEADER;

// Render list options
$customers_list->renderListOptions();

// Render list options (header, left)
$customers_list->ListOptions->render("header", "left");
?>
<?php if ($customers_list->CustomerID->Visible) { // CustomerID ?>
	<?php if ($customers_list->SortUrl($customers_list->CustomerID) == "") { ?>
		<th data-name="CustomerID" class="<?php echo $customers_list->CustomerID->headerCellClass() ?>"><div id="elh_customers_CustomerID" class="customers_CustomerID"><div class="ew-table-header-caption"><?php echo $customers_list->CustomerID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CustomerID" class="<?php echo $customers_list->CustomerID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->CustomerID) ?>', 1);"><div id="elh_customers_CustomerID" class="customers_CustomerID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->CustomerID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->CustomerID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->CustomerID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->CompanyName->Visible) { // CompanyName ?>
	<?php if ($customers_list->SortUrl($customers_list->CompanyName) == "") { ?>
		<th data-name="CompanyName" class="<?php echo $customers_list->CompanyName->headerCellClass() ?>"><div id="elh_customers_CompanyName" class="customers_CompanyName"><div class="ew-table-header-caption"><?php echo $customers_list->CompanyName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CompanyName" class="<?php echo $customers_list->CompanyName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->CompanyName) ?>', 1);"><div id="elh_customers_CompanyName" class="customers_CompanyName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->CompanyName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->CompanyName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->CompanyName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->ContactName->Visible) { // ContactName ?>
	<?php if ($customers_list->SortUrl($customers_list->ContactName) == "") { ?>
		<th data-name="ContactName" class="<?php echo $customers_list->ContactName->headerCellClass() ?>"><div id="elh_customers_ContactName" class="customers_ContactName"><div class="ew-table-header-caption"><?php echo $customers_list->ContactName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactName" class="<?php echo $customers_list->ContactName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->ContactName) ?>', 1);"><div id="elh_customers_ContactName" class="customers_ContactName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->ContactName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->ContactName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->ContactName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->ContactTitle->Visible) { // ContactTitle ?>
	<?php if ($customers_list->SortUrl($customers_list->ContactTitle) == "") { ?>
		<th data-name="ContactTitle" class="<?php echo $customers_list->ContactTitle->headerCellClass() ?>"><div id="elh_customers_ContactTitle" class="customers_ContactTitle"><div class="ew-table-header-caption"><?php echo $customers_list->ContactTitle->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactTitle" class="<?php echo $customers_list->ContactTitle->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->ContactTitle) ?>', 1);"><div id="elh_customers_ContactTitle" class="customers_ContactTitle">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->ContactTitle->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->ContactTitle->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->ContactTitle->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->Address->Visible) { // Address ?>
	<?php if ($customers_list->SortUrl($customers_list->Address) == "") { ?>
		<th data-name="Address" class="<?php echo $customers_list->Address->headerCellClass() ?>"><div id="elh_customers_Address" class="customers_Address"><div class="ew-table-header-caption"><?php echo $customers_list->Address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Address" class="<?php echo $customers_list->Address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->Address) ?>', 1);"><div id="elh_customers_Address" class="customers_Address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->Address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->Address->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->Address->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->City->Visible) { // City ?>
	<?php if ($customers_list->SortUrl($customers_list->City) == "") { ?>
		<th data-name="City" class="<?php echo $customers_list->City->headerCellClass() ?>"><div id="elh_customers_City" class="customers_City"><div class="ew-table-header-caption"><?php echo $customers_list->City->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="City" class="<?php echo $customers_list->City->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->City) ?>', 1);"><div id="elh_customers_City" class="customers_City">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->City->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->City->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->City->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->Region->Visible) { // Region ?>
	<?php if ($customers_list->SortUrl($customers_list->Region) == "") { ?>
		<th data-name="Region" class="<?php echo $customers_list->Region->headerCellClass() ?>"><div id="elh_customers_Region" class="customers_Region"><div class="ew-table-header-caption"><?php echo $customers_list->Region->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Region" class="<?php echo $customers_list->Region->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->Region) ?>', 1);"><div id="elh_customers_Region" class="customers_Region">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->Region->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->Region->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->Region->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->PostalCode->Visible) { // PostalCode ?>
	<?php if ($customers_list->SortUrl($customers_list->PostalCode) == "") { ?>
		<th data-name="PostalCode" class="<?php echo $customers_list->PostalCode->headerCellClass() ?>"><div id="elh_customers_PostalCode" class="customers_PostalCode"><div class="ew-table-header-caption"><?php echo $customers_list->PostalCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PostalCode" class="<?php echo $customers_list->PostalCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->PostalCode) ?>', 1);"><div id="elh_customers_PostalCode" class="customers_PostalCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->PostalCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->PostalCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->PostalCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->Country->Visible) { // Country ?>
	<?php if ($customers_list->SortUrl($customers_list->Country) == "") { ?>
		<th data-name="Country" class="<?php echo $customers_list->Country->headerCellClass() ?>"><div id="elh_customers_Country" class="customers_Country"><div class="ew-table-header-caption"><?php echo $customers_list->Country->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Country" class="<?php echo $customers_list->Country->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->Country) ?>', 1);"><div id="elh_customers_Country" class="customers_Country">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->Country->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->Country->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->Country->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->Phone->Visible) { // Phone ?>
	<?php if ($customers_list->SortUrl($customers_list->Phone) == "") { ?>
		<th data-name="Phone" class="<?php echo $customers_list->Phone->headerCellClass() ?>"><div id="elh_customers_Phone" class="customers_Phone"><div class="ew-table-header-caption"><?php echo $customers_list->Phone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Phone" class="<?php echo $customers_list->Phone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->Phone) ?>', 1);"><div id="elh_customers_Phone" class="customers_Phone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->Phone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->Phone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->Phone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->Fax->Visible) { // Fax ?>
	<?php if ($customers_list->SortUrl($customers_list->Fax) == "") { ?>
		<th data-name="Fax" class="<?php echo $customers_list->Fax->headerCellClass() ?>"><div id="elh_customers_Fax" class="customers_Fax"><div class="ew-table-header-caption"><?php echo $customers_list->Fax->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fax" class="<?php echo $customers_list->Fax->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->Fax) ?>', 1);"><div id="elh_customers_Fax" class="customers_Fax">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->Fax->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->Fax->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->Fax->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$customers_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($customers_list->ExportAll && $customers_list->isExport()) {
	$customers_list->StopRecord = $customers_list->TotalRecords;
} else {

	// Set the last record to display
	if ($customers_list->TotalRecords > $customers_list->StartRecord + $customers_list->DisplayRecords - 1)
		$customers_list->StopRecord = $customers_list->StartRecord + $customers_list->DisplayRecords - 1;
	else
		$customers_list->StopRecord = $customers_list->TotalRecords;
}
$customers_list->RecordCount = $customers_list->StartRecord - 1;
if ($customers_list->Recordset && !$customers_list->Recordset->EOF) {
	$customers_list->Recordset->moveFirst();
	$selectLimit = $customers_list->UseSelectLimit;
	if (!$selectLimit && $customers_list->StartRecord > 1)
		$customers_list->Recordset->move($customers_list->StartRecord - 1);
} elseif (!$customers->AllowAddDeleteRow && $customers_list->StopRecord == 0) {
	$customers_list->StopRecord = $customers->GridAddRowCount;
}

// Initialize aggregate
$customers->RowType = ROWTYPE_AGGREGATEINIT;
$customers->resetAttributes();
$customers_list->renderRow();
while ($customers_list->RecordCount < $customers_list->StopRecord) {
	$customers_list->RecordCount++;
	if ($customers_list->RecordCount >= $customers_list->StartRecord) {
		$customers_list->RowCount++;

		// Set up key count
		$customers_list->KeyCount = $customers_list->RowIndex;

		// Init row class and style
		$customers->resetAttributes();
		$customers->CssClass = "";
		if ($customers_list->isGridAdd()) {
		} else {
			$customers_list->loadRowValues($customers_list->Recordset); // Load row values
		}
		$customers->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$customers->RowAttrs->merge(["data-rowindex" => $customers_list->RowCount, "id" => "r" . $customers_list->RowCount . "_customers", "data-rowtype" => $customers->RowType]);

		// Render row
		$customers_list->renderRow();

		// Render list options
		$customers_list->renderListOptions();
?>
	<tr <?php echo $customers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$customers_list->ListOptions->render("body", "left", $customers_list->RowCount);
?>
	<?php if ($customers_list->CustomerID->Visible) { // CustomerID ?>
		<td data-name="CustomerID" <?php echo $customers_list->CustomerID->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_CustomerID">
<span<?php echo $customers_list->CustomerID->viewAttributes() ?>><?php echo $customers_list->CustomerID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->CompanyName->Visible) { // CompanyName ?>
		<td data-name="CompanyName" <?php echo $customers_list->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_CompanyName">
<span<?php echo $customers_list->CompanyName->viewAttributes() ?>><?php echo $customers_list->CompanyName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->ContactName->Visible) { // ContactName ?>
		<td data-name="ContactName" <?php echo $customers_list->ContactName->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_ContactName">
<span<?php echo $customers_list->ContactName->viewAttributes() ?>><?php echo $customers_list->ContactName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->ContactTitle->Visible) { // ContactTitle ?>
		<td data-name="ContactTitle" <?php echo $customers_list->ContactTitle->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_ContactTitle">
<span<?php echo $customers_list->ContactTitle->viewAttributes() ?>><?php echo $customers_list->ContactTitle->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->Address->Visible) { // Address ?>
		<td data-name="Address" <?php echo $customers_list->Address->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_Address">
<span<?php echo $customers_list->Address->viewAttributes() ?>><?php echo $customers_list->Address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->City->Visible) { // City ?>
		<td data-name="City" <?php echo $customers_list->City->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_City">
<span<?php echo $customers_list->City->viewAttributes() ?>><?php echo $customers_list->City->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->Region->Visible) { // Region ?>
		<td data-name="Region" <?php echo $customers_list->Region->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_Region">
<span<?php echo $customers_list->Region->viewAttributes() ?>><?php echo $customers_list->Region->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->PostalCode->Visible) { // PostalCode ?>
		<td data-name="PostalCode" <?php echo $customers_list->PostalCode->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_PostalCode">
<span<?php echo $customers_list->PostalCode->viewAttributes() ?>><?php echo $customers_list->PostalCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->Country->Visible) { // Country ?>
		<td data-name="Country" <?php echo $customers_list->Country->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_Country">
<span<?php echo $customers_list->Country->viewAttributes() ?>><?php echo $customers_list->Country->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->Phone->Visible) { // Phone ?>
		<td data-name="Phone" <?php echo $customers_list->Phone->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_Phone">
<span<?php echo $customers_list->Phone->viewAttributes() ?>><?php echo $customers_list->Phone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->Fax->Visible) { // Fax ?>
		<td data-name="Fax" <?php echo $customers_list->Fax->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_Fax">
<span<?php echo $customers_list->Fax->viewAttributes() ?>><?php echo $customers_list->Fax->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$customers_list->ListOptions->render("body", "right", $customers_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$customers_list->isGridAdd())
		$customers_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$customers->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($customers_list->Recordset)
	$customers_list->Recordset->Close();
?>
<?php if (!$customers_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$customers_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $customers_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $customers_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($customers_list->TotalRecords == 0 && !$customers->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $customers_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$customers_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$customers_list->isExport()) { ?>
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
$customers_list->terminate();
?>