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
$orders2_list = new orders2_list();

// Run the page
$orders2_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders2_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$orders2_list->isExport()) { ?>
<script>
var forders2list, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	forders2list = currentForm = new ew.Form("forders2list", "list");
	forders2list.formKeyCountName = '<?php echo $orders2_list->FormKeyCountName ?>';
	loadjs.done("forders2list");
});
var forders2listsrch;
loadjs.ready("head", function() {

	// Form object for search
	forders2listsrch = currentSearchForm = new ew.Form("forders2listsrch");

	// Dynamic selection lists
	// Filters

	forders2listsrch.filterList = <?php echo $orders2_list->getFilterList() ?>;
	loadjs.done("forders2listsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$orders2_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($orders2_list->TotalRecords > 0 && $orders2_list->ExportOptions->visible()) { ?>
<?php $orders2_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($orders2_list->ImportOptions->visible()) { ?>
<?php $orders2_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($orders2_list->SearchOptions->visible()) { ?>
<?php $orders2_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($orders2_list->FilterOptions->visible()) { ?>
<?php $orders2_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$orders2_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$orders2_list->isExport() && !$orders2->CurrentAction) { ?>
<form name="forders2listsrch" id="forders2listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="forders2listsrch-search-panel" class="<?php echo $orders2_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="orders2">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $orders2_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($orders2_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($orders2_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $orders2_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($orders2_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($orders2_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($orders2_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($orders2_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $orders2_list->showPageHeader(); ?>
<?php
$orders2_list->showMessage();
?>
<?php if ($orders2_list->TotalRecords > 0 || $orders2->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($orders2_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> orders2">
<form name="forders2list" id="forders2list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders2">
<div id="gmp_orders2" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($orders2_list->TotalRecords > 0 || $orders2_list->isGridEdit()) { ?>
<table id="tbl_orders2list" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$orders2->RowType = ROWTYPE_HEADER;

// Render list options
$orders2_list->renderListOptions();

// Render list options (header, left)
$orders2_list->ListOptions->render("header", "left");
?>
<?php if ($orders2_list->OrderID->Visible) { // OrderID ?>
	<?php if ($orders2_list->SortUrl($orders2_list->OrderID) == "") { ?>
		<th data-name="OrderID" class="<?php echo $orders2_list->OrderID->headerCellClass() ?>"><div id="elh_orders2_OrderID" class="orders2_OrderID"><div class="ew-table-header-caption"><?php echo $orders2_list->OrderID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderID" class="<?php echo $orders2_list->OrderID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders2_list->SortUrl($orders2_list->OrderID) ?>', 1);"><div id="elh_orders2_OrderID" class="orders2_OrderID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2_list->OrderID->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders2_list->OrderID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders2_list->OrderID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2_list->CustomerID->Visible) { // CustomerID ?>
	<?php if ($orders2_list->SortUrl($orders2_list->CustomerID) == "") { ?>
		<th data-name="CustomerID" class="<?php echo $orders2_list->CustomerID->headerCellClass() ?>"><div id="elh_orders2_CustomerID" class="orders2_CustomerID"><div class="ew-table-header-caption"><?php echo $orders2_list->CustomerID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CustomerID" class="<?php echo $orders2_list->CustomerID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders2_list->SortUrl($orders2_list->CustomerID) ?>', 1);"><div id="elh_orders2_CustomerID" class="orders2_CustomerID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2_list->CustomerID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders2_list->CustomerID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders2_list->CustomerID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($orders2_list->SortUrl($orders2_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $orders2_list->EmployeeID->headerCellClass() ?>"><div id="elh_orders2_EmployeeID" class="orders2_EmployeeID"><div class="ew-table-header-caption"><?php echo $orders2_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $orders2_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders2_list->SortUrl($orders2_list->EmployeeID) ?>', 1);"><div id="elh_orders2_EmployeeID" class="orders2_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders2_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders2_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2_list->OrderDate->Visible) { // OrderDate ?>
	<?php if ($orders2_list->SortUrl($orders2_list->OrderDate) == "") { ?>
		<th data-name="OrderDate" class="<?php echo $orders2_list->OrderDate->headerCellClass() ?>"><div id="elh_orders2_OrderDate" class="orders2_OrderDate"><div class="ew-table-header-caption"><?php echo $orders2_list->OrderDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderDate" class="<?php echo $orders2_list->OrderDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders2_list->SortUrl($orders2_list->OrderDate) ?>', 1);"><div id="elh_orders2_OrderDate" class="orders2_OrderDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2_list->OrderDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders2_list->OrderDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders2_list->OrderDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2_list->RequiredDate->Visible) { // RequiredDate ?>
	<?php if ($orders2_list->SortUrl($orders2_list->RequiredDate) == "") { ?>
		<th data-name="RequiredDate" class="<?php echo $orders2_list->RequiredDate->headerCellClass() ?>"><div id="elh_orders2_RequiredDate" class="orders2_RequiredDate"><div class="ew-table-header-caption"><?php echo $orders2_list->RequiredDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RequiredDate" class="<?php echo $orders2_list->RequiredDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders2_list->SortUrl($orders2_list->RequiredDate) ?>', 1);"><div id="elh_orders2_RequiredDate" class="orders2_RequiredDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2_list->RequiredDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders2_list->RequiredDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders2_list->RequiredDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2_list->ShippedDate->Visible) { // ShippedDate ?>
	<?php if ($orders2_list->SortUrl($orders2_list->ShippedDate) == "") { ?>
		<th data-name="ShippedDate" class="<?php echo $orders2_list->ShippedDate->headerCellClass() ?>"><div id="elh_orders2_ShippedDate" class="orders2_ShippedDate"><div class="ew-table-header-caption"><?php echo $orders2_list->ShippedDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShippedDate" class="<?php echo $orders2_list->ShippedDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders2_list->SortUrl($orders2_list->ShippedDate) ?>', 1);"><div id="elh_orders2_ShippedDate" class="orders2_ShippedDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2_list->ShippedDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders2_list->ShippedDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders2_list->ShippedDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2_list->ShipVia->Visible) { // ShipVia ?>
	<?php if ($orders2_list->SortUrl($orders2_list->ShipVia) == "") { ?>
		<th data-name="ShipVia" class="<?php echo $orders2_list->ShipVia->headerCellClass() ?>"><div id="elh_orders2_ShipVia" class="orders2_ShipVia"><div class="ew-table-header-caption"><?php echo $orders2_list->ShipVia->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipVia" class="<?php echo $orders2_list->ShipVia->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders2_list->SortUrl($orders2_list->ShipVia) ?>', 1);"><div id="elh_orders2_ShipVia" class="orders2_ShipVia">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2_list->ShipVia->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders2_list->ShipVia->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders2_list->ShipVia->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2_list->Freight->Visible) { // Freight ?>
	<?php if ($orders2_list->SortUrl($orders2_list->Freight) == "") { ?>
		<th data-name="Freight" class="<?php echo $orders2_list->Freight->headerCellClass() ?>"><div id="elh_orders2_Freight" class="orders2_Freight"><div class="ew-table-header-caption"><?php echo $orders2_list->Freight->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Freight" class="<?php echo $orders2_list->Freight->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders2_list->SortUrl($orders2_list->Freight) ?>', 1);"><div id="elh_orders2_Freight" class="orders2_Freight">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2_list->Freight->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders2_list->Freight->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders2_list->Freight->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2_list->ShipName->Visible) { // ShipName ?>
	<?php if ($orders2_list->SortUrl($orders2_list->ShipName) == "") { ?>
		<th data-name="ShipName" class="<?php echo $orders2_list->ShipName->headerCellClass() ?>"><div id="elh_orders2_ShipName" class="orders2_ShipName"><div class="ew-table-header-caption"><?php echo $orders2_list->ShipName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipName" class="<?php echo $orders2_list->ShipName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders2_list->SortUrl($orders2_list->ShipName) ?>', 1);"><div id="elh_orders2_ShipName" class="orders2_ShipName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2_list->ShipName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders2_list->ShipName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders2_list->ShipName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2_list->ShipAddress->Visible) { // ShipAddress ?>
	<?php if ($orders2_list->SortUrl($orders2_list->ShipAddress) == "") { ?>
		<th data-name="ShipAddress" class="<?php echo $orders2_list->ShipAddress->headerCellClass() ?>"><div id="elh_orders2_ShipAddress" class="orders2_ShipAddress"><div class="ew-table-header-caption"><?php echo $orders2_list->ShipAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipAddress" class="<?php echo $orders2_list->ShipAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders2_list->SortUrl($orders2_list->ShipAddress) ?>', 1);"><div id="elh_orders2_ShipAddress" class="orders2_ShipAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2_list->ShipAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders2_list->ShipAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders2_list->ShipAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2_list->ShipCity->Visible) { // ShipCity ?>
	<?php if ($orders2_list->SortUrl($orders2_list->ShipCity) == "") { ?>
		<th data-name="ShipCity" class="<?php echo $orders2_list->ShipCity->headerCellClass() ?>"><div id="elh_orders2_ShipCity" class="orders2_ShipCity"><div class="ew-table-header-caption"><?php echo $orders2_list->ShipCity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipCity" class="<?php echo $orders2_list->ShipCity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders2_list->SortUrl($orders2_list->ShipCity) ?>', 1);"><div id="elh_orders2_ShipCity" class="orders2_ShipCity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2_list->ShipCity->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders2_list->ShipCity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders2_list->ShipCity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2_list->ShipRegion->Visible) { // ShipRegion ?>
	<?php if ($orders2_list->SortUrl($orders2_list->ShipRegion) == "") { ?>
		<th data-name="ShipRegion" class="<?php echo $orders2_list->ShipRegion->headerCellClass() ?>"><div id="elh_orders2_ShipRegion" class="orders2_ShipRegion"><div class="ew-table-header-caption"><?php echo $orders2_list->ShipRegion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipRegion" class="<?php echo $orders2_list->ShipRegion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders2_list->SortUrl($orders2_list->ShipRegion) ?>', 1);"><div id="elh_orders2_ShipRegion" class="orders2_ShipRegion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2_list->ShipRegion->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders2_list->ShipRegion->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders2_list->ShipRegion->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2_list->ShipPostalCode->Visible) { // ShipPostalCode ?>
	<?php if ($orders2_list->SortUrl($orders2_list->ShipPostalCode) == "") { ?>
		<th data-name="ShipPostalCode" class="<?php echo $orders2_list->ShipPostalCode->headerCellClass() ?>"><div id="elh_orders2_ShipPostalCode" class="orders2_ShipPostalCode"><div class="ew-table-header-caption"><?php echo $orders2_list->ShipPostalCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipPostalCode" class="<?php echo $orders2_list->ShipPostalCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders2_list->SortUrl($orders2_list->ShipPostalCode) ?>', 1);"><div id="elh_orders2_ShipPostalCode" class="orders2_ShipPostalCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2_list->ShipPostalCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders2_list->ShipPostalCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders2_list->ShipPostalCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders2_list->ShipCountry->Visible) { // ShipCountry ?>
	<?php if ($orders2_list->SortUrl($orders2_list->ShipCountry) == "") { ?>
		<th data-name="ShipCountry" class="<?php echo $orders2_list->ShipCountry->headerCellClass() ?>"><div id="elh_orders2_ShipCountry" class="orders2_ShipCountry"><div class="ew-table-header-caption"><?php echo $orders2_list->ShipCountry->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShipCountry" class="<?php echo $orders2_list->ShipCountry->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders2_list->SortUrl($orders2_list->ShipCountry) ?>', 1);"><div id="elh_orders2_ShipCountry" class="orders2_ShipCountry">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders2_list->ShipCountry->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders2_list->ShipCountry->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders2_list->ShipCountry->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$orders2_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($orders2_list->ExportAll && $orders2_list->isExport()) {
	$orders2_list->StopRecord = $orders2_list->TotalRecords;
} else {

	// Set the last record to display
	if ($orders2_list->TotalRecords > $orders2_list->StartRecord + $orders2_list->DisplayRecords - 1)
		$orders2_list->StopRecord = $orders2_list->StartRecord + $orders2_list->DisplayRecords - 1;
	else
		$orders2_list->StopRecord = $orders2_list->TotalRecords;
}
$orders2_list->RecordCount = $orders2_list->StartRecord - 1;
if ($orders2_list->Recordset && !$orders2_list->Recordset->EOF) {
	$orders2_list->Recordset->moveFirst();
	$selectLimit = $orders2_list->UseSelectLimit;
	if (!$selectLimit && $orders2_list->StartRecord > 1)
		$orders2_list->Recordset->move($orders2_list->StartRecord - 1);
} elseif (!$orders2->AllowAddDeleteRow && $orders2_list->StopRecord == 0) {
	$orders2_list->StopRecord = $orders2->GridAddRowCount;
}

// Initialize aggregate
$orders2->RowType = ROWTYPE_AGGREGATEINIT;
$orders2->resetAttributes();
$orders2_list->renderRow();
while ($orders2_list->RecordCount < $orders2_list->StopRecord) {
	$orders2_list->RecordCount++;
	if ($orders2_list->RecordCount >= $orders2_list->StartRecord) {
		$orders2_list->RowCount++;

		// Set up key count
		$orders2_list->KeyCount = $orders2_list->RowIndex;

		// Init row class and style
		$orders2->resetAttributes();
		$orders2->CssClass = "";
		if ($orders2_list->isGridAdd()) {
		} else {
			$orders2_list->loadRowValues($orders2_list->Recordset); // Load row values
		}
		$orders2->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$orders2->RowAttrs->merge(["data-rowindex" => $orders2_list->RowCount, "id" => "r" . $orders2_list->RowCount . "_orders2", "data-rowtype" => $orders2->RowType]);

		// Render row
		$orders2_list->renderRow();

		// Render list options
		$orders2_list->renderListOptions();
?>
	<tr <?php echo $orders2->rowAttributes() ?>>
<?php

// Render list options (body, left)
$orders2_list->ListOptions->render("body", "left", $orders2_list->RowCount);
?>
	<?php if ($orders2_list->OrderID->Visible) { // OrderID ?>
		<td data-name="OrderID" <?php echo $orders2_list->OrderID->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCount ?>_orders2_OrderID">
<span<?php echo $orders2_list->OrderID->viewAttributes() ?>><?php echo $orders2_list->OrderID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2_list->CustomerID->Visible) { // CustomerID ?>
		<td data-name="CustomerID" <?php echo $orders2_list->CustomerID->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCount ?>_orders2_CustomerID">
<span<?php echo $orders2_list->CustomerID->viewAttributes() ?>><?php echo $orders2_list->CustomerID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $orders2_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCount ?>_orders2_EmployeeID">
<span<?php echo $orders2_list->EmployeeID->viewAttributes() ?>><?php echo $orders2_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2_list->OrderDate->Visible) { // OrderDate ?>
		<td data-name="OrderDate" <?php echo $orders2_list->OrderDate->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCount ?>_orders2_OrderDate">
<span<?php echo $orders2_list->OrderDate->viewAttributes() ?>><?php echo $orders2_list->OrderDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2_list->RequiredDate->Visible) { // RequiredDate ?>
		<td data-name="RequiredDate" <?php echo $orders2_list->RequiredDate->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCount ?>_orders2_RequiredDate">
<span<?php echo $orders2_list->RequiredDate->viewAttributes() ?>><?php echo $orders2_list->RequiredDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2_list->ShippedDate->Visible) { // ShippedDate ?>
		<td data-name="ShippedDate" <?php echo $orders2_list->ShippedDate->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCount ?>_orders2_ShippedDate">
<span<?php echo $orders2_list->ShippedDate->viewAttributes() ?>><?php echo $orders2_list->ShippedDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2_list->ShipVia->Visible) { // ShipVia ?>
		<td data-name="ShipVia" <?php echo $orders2_list->ShipVia->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCount ?>_orders2_ShipVia">
<span<?php echo $orders2_list->ShipVia->viewAttributes() ?>><?php echo $orders2_list->ShipVia->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2_list->Freight->Visible) { // Freight ?>
		<td data-name="Freight" <?php echo $orders2_list->Freight->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCount ?>_orders2_Freight">
<span<?php echo $orders2_list->Freight->viewAttributes() ?>><?php echo $orders2_list->Freight->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2_list->ShipName->Visible) { // ShipName ?>
		<td data-name="ShipName" <?php echo $orders2_list->ShipName->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCount ?>_orders2_ShipName">
<span<?php echo $orders2_list->ShipName->viewAttributes() ?>><?php echo $orders2_list->ShipName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2_list->ShipAddress->Visible) { // ShipAddress ?>
		<td data-name="ShipAddress" <?php echo $orders2_list->ShipAddress->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCount ?>_orders2_ShipAddress">
<span<?php echo $orders2_list->ShipAddress->viewAttributes() ?>><?php echo $orders2_list->ShipAddress->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2_list->ShipCity->Visible) { // ShipCity ?>
		<td data-name="ShipCity" <?php echo $orders2_list->ShipCity->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCount ?>_orders2_ShipCity">
<span<?php echo $orders2_list->ShipCity->viewAttributes() ?>><?php echo $orders2_list->ShipCity->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2_list->ShipRegion->Visible) { // ShipRegion ?>
		<td data-name="ShipRegion" <?php echo $orders2_list->ShipRegion->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCount ?>_orders2_ShipRegion">
<span<?php echo $orders2_list->ShipRegion->viewAttributes() ?>><?php echo $orders2_list->ShipRegion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2_list->ShipPostalCode->Visible) { // ShipPostalCode ?>
		<td data-name="ShipPostalCode" <?php echo $orders2_list->ShipPostalCode->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCount ?>_orders2_ShipPostalCode">
<span<?php echo $orders2_list->ShipPostalCode->viewAttributes() ?>><?php echo $orders2_list->ShipPostalCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders2_list->ShipCountry->Visible) { // ShipCountry ?>
		<td data-name="ShipCountry" <?php echo $orders2_list->ShipCountry->cellAttributes() ?>>
<span id="el<?php echo $orders2_list->RowCount ?>_orders2_ShipCountry">
<span<?php echo $orders2_list->ShipCountry->viewAttributes() ?>><?php echo $orders2_list->ShipCountry->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$orders2_list->ListOptions->render("body", "right", $orders2_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$orders2_list->isGridAdd())
		$orders2_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$orders2->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($orders2_list->Recordset)
	$orders2_list->Recordset->Close();
?>
<?php if (!$orders2_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$orders2_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $orders2_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $orders2_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($orders2_list->TotalRecords == 0 && !$orders2->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $orders2_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$orders2_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$orders2_list->isExport()) { ?>
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
$orders2_list->terminate();
?>