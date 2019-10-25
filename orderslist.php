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
$orders_list = new orders_list();

// Run the page
$orders_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$orders_list->isExport()) { ?>
<script>
var forderslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	forderslist = currentForm = new ew.Form("forderslist", "list");
	forderslist.formKeyCountName = '<?php echo $orders_list->FormKeyCountName ?>';
	loadjs.done("forderslist");
});
var forderslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	forderslistsrch = currentSearchForm = new ew.Form("forderslistsrch");

	// Dynamic selection lists
	// Filters

	forderslistsrch.filterList = <?php echo $orders_list->getFilterList() ?>;
	loadjs.done("forderslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$orders_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($orders_list->TotalRecords > 0 && $orders_list->ExportOptions->visible()) { ?>
<?php $orders_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($orders_list->ImportOptions->visible()) { ?>
<?php $orders_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($orders_list->SearchOptions->visible()) { ?>
<?php $orders_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($orders_list->FilterOptions->visible()) { ?>
<?php $orders_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$orders_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$orders_list->isExport() && !$orders->CurrentAction) { ?>
<form name="forderslistsrch" id="forderslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="forderslistsrch-search-panel" class="<?php echo $orders_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="orders">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $orders_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($orders_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($orders_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $orders_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($orders_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($orders_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($orders_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($orders_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $orders_list->showPageHeader(); ?>
<?php
$orders_list->showMessage();
?>
<?php if ($orders_list->TotalRecords > 0 || $orders->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($orders_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> orders">
<form name="forderslist" id="forderslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders">
<div id="gmp_orders" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($orders_list->TotalRecords > 0 || $orders_list->isGridEdit()) { ?>
<table id="tbl_orderslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$orders->RowType = ROWTYPE_HEADER;

// Render list options
$orders_list->renderListOptions();

// Render list options (header, left)
$orders_list->ListOptions->render("header", "left");
?>
<?php if ($orders_list->OrderID->Visible) { // OrderID ?>
	<?php if ($orders_list->SortUrl($orders_list->OrderID) == "") { ?>
		<th data-name="OrderID" class="<?php echo $orders_list->OrderID->headerCellClass() ?>"><div id="elh_orders_OrderID" class="orders_OrderID"><div class="ew-table-header-caption"><?php echo $orders_list->OrderID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderID" class="<?php echo $orders_list->OrderID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_list->SortUrl($orders_list->OrderID) ?>', 1);"><div id="elh_orders_OrderID" class="orders_OrderID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_list->OrderID->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders_list->OrderID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_list->OrderID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_list->CustomerID->Visible) { // CustomerID ?>
	<?php if ($orders_list->SortUrl($orders_list->CustomerID) == "") { ?>
		<th data-name="CustomerID" class="<?php echo $orders_list->CustomerID->headerCellClass() ?>"><div id="elh_orders_CustomerID" class="orders_CustomerID"><div class="ew-table-header-caption"><?php echo $orders_list->CustomerID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CustomerID" class="<?php echo $orders_list->CustomerID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_list->SortUrl($orders_list->CustomerID) ?>', 1);"><div id="elh_orders_CustomerID" class="orders_CustomerID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_list->CustomerID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders_list->CustomerID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_list->CustomerID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($orders_list->SortUrl($orders_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $orders_list->EmployeeID->headerCellClass() ?>"><div id="elh_orders_EmployeeID" class="orders_EmployeeID"><div class="ew-table-header-caption"><?php echo $orders_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $orders_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_list->SortUrl($orders_list->EmployeeID) ?>', 1);"><div id="elh_orders_EmployeeID" class="orders_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_list->OrderDate->Visible) { // OrderDate ?>
	<?php if ($orders_list->SortUrl($orders_list->OrderDate) == "") { ?>
		<th data-name="OrderDate" class="<?php echo $orders_list->OrderDate->headerCellClass() ?>"><div id="elh_orders_OrderDate" class="orders_OrderDate"><div class="ew-table-header-caption"><?php echo $orders_list->OrderDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderDate" class="<?php echo $orders_list->OrderDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_list->SortUrl($orders_list->OrderDate) ?>', 1);"><div id="elh_orders_OrderDate" class="orders_OrderDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_list->OrderDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders_list->OrderDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_list->OrderDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_list->RequiredDate->Visible) { // RequiredDate ?>
	<?php if ($orders_list->SortUrl($orders_list->RequiredDate) == "") { ?>
		<th data-name="RequiredDate" class="<?php echo $orders_list->RequiredDate->headerCellClass() ?>"><div id="elh_orders_RequiredDate" class="orders_RequiredDate"><div class="ew-table-header-caption"><?php echo $orders_list->RequiredDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RequiredDate" class="<?php echo $orders_list->RequiredDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_list->SortUrl($orders_list->RequiredDate) ?>', 1);"><div id="elh_orders_RequiredDate" class="orders_RequiredDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_list->RequiredDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders_list->RequiredDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_list->RequiredDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_list->ShippedDate->Visible) { // ShippedDate ?>
	<?php if ($orders_list->SortUrl($orders_list->ShippedDate) == "") { ?>
		<th data-name="ShippedDate" class="<?php echo $orders_list->ShippedDate->headerCellClass() ?>"><div id="elh_orders_ShippedDate" class="orders_ShippedDate"><div class="ew-table-header-caption"><?php echo $orders_list->ShippedDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShippedDate" class="<?php echo $orders_list->ShippedDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_list->SortUrl($orders_list->ShippedDate) ?>', 1);"><div id="elh_orders_ShippedDate" class="orders_ShippedDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_list->ShippedDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders_list->ShippedDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_list->ShippedDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_list->ShipVia->Visible) { // ShipVia ?>
	<?php if ($orders_list->SortUrl($orders_list->ShipVia) == "") { ?>
		<th data-name="ShipVia" class="<?php echo $orders_list->ShipVia->headerCellClass() ?>"><div id="elh_orders_ShipVia" class="orders_ShipVia"><div class="ew-table-header-caption"><?php echo $orders_list->ShipVia->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipVia" class="<?php echo $orders_list->ShipVia->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_list->SortUrl($orders_list->ShipVia) ?>', 1);"><div id="elh_orders_ShipVia" class="orders_ShipVia">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_list->ShipVia->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders_list->ShipVia->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_list->ShipVia->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_list->Freight->Visible) { // Freight ?>
	<?php if ($orders_list->SortUrl($orders_list->Freight) == "") { ?>
		<th data-name="Freight" class="<?php echo $orders_list->Freight->headerCellClass() ?>"><div id="elh_orders_Freight" class="orders_Freight"><div class="ew-table-header-caption"><?php echo $orders_list->Freight->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Freight" class="<?php echo $orders_list->Freight->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_list->SortUrl($orders_list->Freight) ?>', 1);"><div id="elh_orders_Freight" class="orders_Freight">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_list->Freight->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders_list->Freight->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_list->Freight->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_list->ShipName->Visible) { // ShipName ?>
	<?php if ($orders_list->SortUrl($orders_list->ShipName) == "") { ?>
		<th data-name="ShipName" class="<?php echo $orders_list->ShipName->headerCellClass() ?>"><div id="elh_orders_ShipName" class="orders_ShipName"><div class="ew-table-header-caption"><?php echo $orders_list->ShipName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipName" class="<?php echo $orders_list->ShipName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_list->SortUrl($orders_list->ShipName) ?>', 1);"><div id="elh_orders_ShipName" class="orders_ShipName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_list->ShipName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders_list->ShipName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_list->ShipName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_list->ShipAddress->Visible) { // ShipAddress ?>
	<?php if ($orders_list->SortUrl($orders_list->ShipAddress) == "") { ?>
		<th data-name="ShipAddress" class="<?php echo $orders_list->ShipAddress->headerCellClass() ?>"><div id="elh_orders_ShipAddress" class="orders_ShipAddress"><div class="ew-table-header-caption"><?php echo $orders_list->ShipAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipAddress" class="<?php echo $orders_list->ShipAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_list->SortUrl($orders_list->ShipAddress) ?>', 1);"><div id="elh_orders_ShipAddress" class="orders_ShipAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_list->ShipAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders_list->ShipAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_list->ShipAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_list->ShipCity->Visible) { // ShipCity ?>
	<?php if ($orders_list->SortUrl($orders_list->ShipCity) == "") { ?>
		<th data-name="ShipCity" class="<?php echo $orders_list->ShipCity->headerCellClass() ?>"><div id="elh_orders_ShipCity" class="orders_ShipCity"><div class="ew-table-header-caption"><?php echo $orders_list->ShipCity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipCity" class="<?php echo $orders_list->ShipCity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_list->SortUrl($orders_list->ShipCity) ?>', 1);"><div id="elh_orders_ShipCity" class="orders_ShipCity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_list->ShipCity->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders_list->ShipCity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_list->ShipCity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_list->ShipRegion->Visible) { // ShipRegion ?>
	<?php if ($orders_list->SortUrl($orders_list->ShipRegion) == "") { ?>
		<th data-name="ShipRegion" class="<?php echo $orders_list->ShipRegion->headerCellClass() ?>"><div id="elh_orders_ShipRegion" class="orders_ShipRegion"><div class="ew-table-header-caption"><?php echo $orders_list->ShipRegion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipRegion" class="<?php echo $orders_list->ShipRegion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_list->SortUrl($orders_list->ShipRegion) ?>', 1);"><div id="elh_orders_ShipRegion" class="orders_ShipRegion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_list->ShipRegion->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders_list->ShipRegion->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_list->ShipRegion->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_list->ShipPostalCode->Visible) { // ShipPostalCode ?>
	<?php if ($orders_list->SortUrl($orders_list->ShipPostalCode) == "") { ?>
		<th data-name="ShipPostalCode" class="<?php echo $orders_list->ShipPostalCode->headerCellClass() ?>"><div id="elh_orders_ShipPostalCode" class="orders_ShipPostalCode"><div class="ew-table-header-caption"><?php echo $orders_list->ShipPostalCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipPostalCode" class="<?php echo $orders_list->ShipPostalCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_list->SortUrl($orders_list->ShipPostalCode) ?>', 1);"><div id="elh_orders_ShipPostalCode" class="orders_ShipPostalCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_list->ShipPostalCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders_list->ShipPostalCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_list->ShipPostalCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_list->ShipCountry->Visible) { // ShipCountry ?>
	<?php if ($orders_list->SortUrl($orders_list->ShipCountry) == "") { ?>
		<th data-name="ShipCountry" class="<?php echo $orders_list->ShipCountry->headerCellClass() ?>"><div id="elh_orders_ShipCountry" class="orders_ShipCountry"><div class="ew-table-header-caption"><?php echo $orders_list->ShipCountry->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipCountry" class="<?php echo $orders_list->ShipCountry->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_list->SortUrl($orders_list->ShipCountry) ?>', 1);"><div id="elh_orders_ShipCountry" class="orders_ShipCountry">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_list->ShipCountry->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders_list->ShipCountry->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_list->ShipCountry->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$orders_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($orders_list->ExportAll && $orders_list->isExport()) {
	$orders_list->StopRecord = $orders_list->TotalRecords;
} else {

	// Set the last record to display
	if ($orders_list->TotalRecords > $orders_list->StartRecord + $orders_list->DisplayRecords - 1)
		$orders_list->StopRecord = $orders_list->StartRecord + $orders_list->DisplayRecords - 1;
	else
		$orders_list->StopRecord = $orders_list->TotalRecords;
}
$orders_list->RecordCount = $orders_list->StartRecord - 1;
if ($orders_list->Recordset && !$orders_list->Recordset->EOF) {
	$orders_list->Recordset->moveFirst();
	$selectLimit = $orders_list->UseSelectLimit;
	if (!$selectLimit && $orders_list->StartRecord > 1)
		$orders_list->Recordset->move($orders_list->StartRecord - 1);
} elseif (!$orders->AllowAddDeleteRow && $orders_list->StopRecord == 0) {
	$orders_list->StopRecord = $orders->GridAddRowCount;
}

// Initialize aggregate
$orders->RowType = ROWTYPE_AGGREGATEINIT;
$orders->resetAttributes();
$orders_list->renderRow();
while ($orders_list->RecordCount < $orders_list->StopRecord) {
	$orders_list->RecordCount++;
	if ($orders_list->RecordCount >= $orders_list->StartRecord) {
		$orders_list->RowCount++;

		// Set up key count
		$orders_list->KeyCount = $orders_list->RowIndex;

		// Init row class and style
		$orders->resetAttributes();
		$orders->CssClass = "";
		if ($orders_list->isGridAdd()) {
		} else {
			$orders_list->loadRowValues($orders_list->Recordset); // Load row values
		}
		$orders->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$orders->RowAttrs->merge(["data-rowindex" => $orders_list->RowCount, "id" => "r" . $orders_list->RowCount . "_orders", "data-rowtype" => $orders->RowType]);

		// Render row
		$orders_list->renderRow();

		// Render list options
		$orders_list->renderListOptions();
?>
	<tr <?php echo $orders->rowAttributes() ?>>
<?php

// Render list options (body, left)
$orders_list->ListOptions->render("body", "left", $orders_list->RowCount);
?>
	<?php if ($orders_list->OrderID->Visible) { // OrderID ?>
		<td data-name="OrderID" <?php echo $orders_list->OrderID->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCount ?>_orders_OrderID">
<span<?php echo $orders_list->OrderID->viewAttributes() ?>><?php echo $orders_list->OrderID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_list->CustomerID->Visible) { // CustomerID ?>
		<td data-name="CustomerID" <?php echo $orders_list->CustomerID->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCount ?>_orders_CustomerID">
<span<?php echo $orders_list->CustomerID->viewAttributes() ?>><?php echo $orders_list->CustomerID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $orders_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCount ?>_orders_EmployeeID">
<span<?php echo $orders_list->EmployeeID->viewAttributes() ?>><?php echo $orders_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_list->OrderDate->Visible) { // OrderDate ?>
		<td data-name="OrderDate" <?php echo $orders_list->OrderDate->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCount ?>_orders_OrderDate">
<span<?php echo $orders_list->OrderDate->viewAttributes() ?>><?php echo $orders_list->OrderDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_list->RequiredDate->Visible) { // RequiredDate ?>
		<td data-name="RequiredDate" <?php echo $orders_list->RequiredDate->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCount ?>_orders_RequiredDate">
<span<?php echo $orders_list->RequiredDate->viewAttributes() ?>><?php echo $orders_list->RequiredDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_list->ShippedDate->Visible) { // ShippedDate ?>
		<td data-name="ShippedDate" <?php echo $orders_list->ShippedDate->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCount ?>_orders_ShippedDate">
<span<?php echo $orders_list->ShippedDate->viewAttributes() ?>><?php echo $orders_list->ShippedDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_list->ShipVia->Visible) { // ShipVia ?>
		<td data-name="ShipVia" <?php echo $orders_list->ShipVia->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCount ?>_orders_ShipVia">
<span<?php echo $orders_list->ShipVia->viewAttributes() ?>><?php echo $orders_list->ShipVia->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_list->Freight->Visible) { // Freight ?>
		<td data-name="Freight" <?php echo $orders_list->Freight->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCount ?>_orders_Freight">
<span<?php echo $orders_list->Freight->viewAttributes() ?>><?php echo $orders_list->Freight->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_list->ShipName->Visible) { // ShipName ?>
		<td data-name="ShipName" <?php echo $orders_list->ShipName->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCount ?>_orders_ShipName">
<span<?php echo $orders_list->ShipName->viewAttributes() ?>><?php echo $orders_list->ShipName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_list->ShipAddress->Visible) { // ShipAddress ?>
		<td data-name="ShipAddress" <?php echo $orders_list->ShipAddress->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCount ?>_orders_ShipAddress">
<span<?php echo $orders_list->ShipAddress->viewAttributes() ?>><?php echo $orders_list->ShipAddress->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_list->ShipCity->Visible) { // ShipCity ?>
		<td data-name="ShipCity" <?php echo $orders_list->ShipCity->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCount ?>_orders_ShipCity">
<span<?php echo $orders_list->ShipCity->viewAttributes() ?>><?php echo $orders_list->ShipCity->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_list->ShipRegion->Visible) { // ShipRegion ?>
		<td data-name="ShipRegion" <?php echo $orders_list->ShipRegion->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCount ?>_orders_ShipRegion">
<span<?php echo $orders_list->ShipRegion->viewAttributes() ?>><?php echo $orders_list->ShipRegion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_list->ShipPostalCode->Visible) { // ShipPostalCode ?>
		<td data-name="ShipPostalCode" <?php echo $orders_list->ShipPostalCode->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCount ?>_orders_ShipPostalCode">
<span<?php echo $orders_list->ShipPostalCode->viewAttributes() ?>><?php echo $orders_list->ShipPostalCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_list->ShipCountry->Visible) { // ShipCountry ?>
		<td data-name="ShipCountry" <?php echo $orders_list->ShipCountry->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCount ?>_orders_ShipCountry">
<span<?php echo $orders_list->ShipCountry->viewAttributes() ?>><?php echo $orders_list->ShipCountry->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$orders_list->ListOptions->render("body", "right", $orders_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$orders_list->isGridAdd())
		$orders_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$orders->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($orders_list->Recordset)
	$orders_list->Recordset->Close();
?>
<?php if (!$orders_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$orders_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $orders_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $orders_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($orders_list->TotalRecords == 0 && !$orders->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $orders_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$orders_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$orders_list->isExport()) { ?>
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
$orders_list->terminate();
?>