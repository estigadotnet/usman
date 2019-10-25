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
$order_details_extended_2_list = new order_details_extended_2_list();

// Run the page
$order_details_extended_2_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$order_details_extended_2_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$order_details_extended_2_list->isExport()) { ?>
<script>
var forder_details_extended_2list, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	forder_details_extended_2list = currentForm = new ew.Form("forder_details_extended_2list", "list");
	forder_details_extended_2list.formKeyCountName = '<?php echo $order_details_extended_2_list->FormKeyCountName ?>';
	loadjs.done("forder_details_extended_2list");
});
var forder_details_extended_2listsrch;
loadjs.ready("head", function() {

	// Form object for search
	forder_details_extended_2listsrch = currentSearchForm = new ew.Form("forder_details_extended_2listsrch");

	// Dynamic selection lists
	// Filters

	forder_details_extended_2listsrch.filterList = <?php echo $order_details_extended_2_list->getFilterList() ?>;
	loadjs.done("forder_details_extended_2listsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$order_details_extended_2_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($order_details_extended_2_list->TotalRecords > 0 && $order_details_extended_2_list->ExportOptions->visible()) { ?>
<?php $order_details_extended_2_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($order_details_extended_2_list->ImportOptions->visible()) { ?>
<?php $order_details_extended_2_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($order_details_extended_2_list->SearchOptions->visible()) { ?>
<?php $order_details_extended_2_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($order_details_extended_2_list->FilterOptions->visible()) { ?>
<?php $order_details_extended_2_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$order_details_extended_2_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$order_details_extended_2_list->isExport() && !$order_details_extended_2->CurrentAction) { ?>
<form name="forder_details_extended_2listsrch" id="forder_details_extended_2listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="forder_details_extended_2listsrch-search-panel" class="<?php echo $order_details_extended_2_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="order_details_extended_2">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $order_details_extended_2_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($order_details_extended_2_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($order_details_extended_2_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $order_details_extended_2_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($order_details_extended_2_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($order_details_extended_2_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($order_details_extended_2_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($order_details_extended_2_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $order_details_extended_2_list->showPageHeader(); ?>
<?php
$order_details_extended_2_list->showMessage();
?>
<?php if ($order_details_extended_2_list->TotalRecords > 0 || $order_details_extended_2->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($order_details_extended_2_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> order_details_extended_2">
<form name="forder_details_extended_2list" id="forder_details_extended_2list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="order_details_extended_2">
<div id="gmp_order_details_extended_2" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($order_details_extended_2_list->TotalRecords > 0 || $order_details_extended_2_list->isGridEdit()) { ?>
<table id="tbl_order_details_extended_2list" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$order_details_extended_2->RowType = ROWTYPE_HEADER;

// Render list options
$order_details_extended_2_list->renderListOptions();

// Render list options (header, left)
$order_details_extended_2_list->ListOptions->render("header", "left");
?>
<?php if ($order_details_extended_2_list->CompanyName->Visible) { // CompanyName ?>
	<?php if ($order_details_extended_2_list->SortUrl($order_details_extended_2_list->CompanyName) == "") { ?>
		<th data-name="CompanyName" class="<?php echo $order_details_extended_2_list->CompanyName->headerCellClass() ?>"><div id="elh_order_details_extended_2_CompanyName" class="order_details_extended_2_CompanyName"><div class="ew-table-header-caption"><?php echo $order_details_extended_2_list->CompanyName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CompanyName" class="<?php echo $order_details_extended_2_list->CompanyName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_2_list->SortUrl($order_details_extended_2_list->CompanyName) ?>', 1);"><div id="elh_order_details_extended_2_CompanyName" class="order_details_extended_2_CompanyName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_2_list->CompanyName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_2_list->CompanyName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_2_list->CompanyName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_2_list->OrderID->Visible) { // OrderID ?>
	<?php if ($order_details_extended_2_list->SortUrl($order_details_extended_2_list->OrderID) == "") { ?>
		<th data-name="OrderID" class="<?php echo $order_details_extended_2_list->OrderID->headerCellClass() ?>"><div id="elh_order_details_extended_2_OrderID" class="order_details_extended_2_OrderID"><div class="ew-table-header-caption"><?php echo $order_details_extended_2_list->OrderID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderID" class="<?php echo $order_details_extended_2_list->OrderID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_2_list->SortUrl($order_details_extended_2_list->OrderID) ?>', 1);"><div id="elh_order_details_extended_2_OrderID" class="order_details_extended_2_OrderID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_2_list->OrderID->caption() ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_2_list->OrderID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_2_list->OrderID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_2_list->ProductName->Visible) { // ProductName ?>
	<?php if ($order_details_extended_2_list->SortUrl($order_details_extended_2_list->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $order_details_extended_2_list->ProductName->headerCellClass() ?>"><div id="elh_order_details_extended_2_ProductName" class="order_details_extended_2_ProductName"><div class="ew-table-header-caption"><?php echo $order_details_extended_2_list->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $order_details_extended_2_list->ProductName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_2_list->SortUrl($order_details_extended_2_list->ProductName) ?>', 1);"><div id="elh_order_details_extended_2_ProductName" class="order_details_extended_2_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_2_list->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_2_list->ProductName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_2_list->ProductName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_2_list->UnitPrice->Visible) { // UnitPrice ?>
	<?php if ($order_details_extended_2_list->SortUrl($order_details_extended_2_list->UnitPrice) == "") { ?>
		<th data-name="UnitPrice" class="<?php echo $order_details_extended_2_list->UnitPrice->headerCellClass() ?>"><div id="elh_order_details_extended_2_UnitPrice" class="order_details_extended_2_UnitPrice"><div class="ew-table-header-caption"><?php echo $order_details_extended_2_list->UnitPrice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitPrice" class="<?php echo $order_details_extended_2_list->UnitPrice->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_2_list->SortUrl($order_details_extended_2_list->UnitPrice) ?>', 1);"><div id="elh_order_details_extended_2_UnitPrice" class="order_details_extended_2_UnitPrice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_2_list->UnitPrice->caption() ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_2_list->UnitPrice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_2_list->UnitPrice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_2_list->Quantity->Visible) { // Quantity ?>
	<?php if ($order_details_extended_2_list->SortUrl($order_details_extended_2_list->Quantity) == "") { ?>
		<th data-name="Quantity" class="<?php echo $order_details_extended_2_list->Quantity->headerCellClass() ?>"><div id="elh_order_details_extended_2_Quantity" class="order_details_extended_2_Quantity"><div class="ew-table-header-caption"><?php echo $order_details_extended_2_list->Quantity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Quantity" class="<?php echo $order_details_extended_2_list->Quantity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_2_list->SortUrl($order_details_extended_2_list->Quantity) ?>', 1);"><div id="elh_order_details_extended_2_Quantity" class="order_details_extended_2_Quantity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_2_list->Quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_2_list->Quantity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_2_list->Quantity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_2_list->Discount->Visible) { // Discount ?>
	<?php if ($order_details_extended_2_list->SortUrl($order_details_extended_2_list->Discount) == "") { ?>
		<th data-name="Discount" class="<?php echo $order_details_extended_2_list->Discount->headerCellClass() ?>"><div id="elh_order_details_extended_2_Discount" class="order_details_extended_2_Discount"><div class="ew-table-header-caption"><?php echo $order_details_extended_2_list->Discount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Discount" class="<?php echo $order_details_extended_2_list->Discount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_2_list->SortUrl($order_details_extended_2_list->Discount) ?>', 1);"><div id="elh_order_details_extended_2_Discount" class="order_details_extended_2_Discount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_2_list->Discount->caption() ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_2_list->Discount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_2_list->Discount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_2_list->Extended_Price->Visible) { // Extended Price ?>
	<?php if ($order_details_extended_2_list->SortUrl($order_details_extended_2_list->Extended_Price) == "") { ?>
		<th data-name="Extended_Price" class="<?php echo $order_details_extended_2_list->Extended_Price->headerCellClass() ?>"><div id="elh_order_details_extended_2_Extended_Price" class="order_details_extended_2_Extended_Price"><div class="ew-table-header-caption"><?php echo $order_details_extended_2_list->Extended_Price->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Extended_Price" class="<?php echo $order_details_extended_2_list->Extended_Price->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_2_list->SortUrl($order_details_extended_2_list->Extended_Price) ?>', 1);"><div id="elh_order_details_extended_2_Extended_Price" class="order_details_extended_2_Extended_Price">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_2_list->Extended_Price->caption() ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_2_list->Extended_Price->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_2_list->Extended_Price->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_2_list->OrderDate->Visible) { // OrderDate ?>
	<?php if ($order_details_extended_2_list->SortUrl($order_details_extended_2_list->OrderDate) == "") { ?>
		<th data-name="OrderDate" class="<?php echo $order_details_extended_2_list->OrderDate->headerCellClass() ?>"><div id="elh_order_details_extended_2_OrderDate" class="order_details_extended_2_OrderDate"><div class="ew-table-header-caption"><?php echo $order_details_extended_2_list->OrderDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderDate" class="<?php echo $order_details_extended_2_list->OrderDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_2_list->SortUrl($order_details_extended_2_list->OrderDate) ?>', 1);"><div id="elh_order_details_extended_2_OrderDate" class="order_details_extended_2_OrderDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_2_list->OrderDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_2_list->OrderDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_2_list->OrderDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_2_list->ContactName->Visible) { // ContactName ?>
	<?php if ($order_details_extended_2_list->SortUrl($order_details_extended_2_list->ContactName) == "") { ?>
		<th data-name="ContactName" class="<?php echo $order_details_extended_2_list->ContactName->headerCellClass() ?>"><div id="elh_order_details_extended_2_ContactName" class="order_details_extended_2_ContactName"><div class="ew-table-header-caption"><?php echo $order_details_extended_2_list->ContactName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactName" class="<?php echo $order_details_extended_2_list->ContactName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_2_list->SortUrl($order_details_extended_2_list->ContactName) ?>', 1);"><div id="elh_order_details_extended_2_ContactName" class="order_details_extended_2_ContactName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_2_list->ContactName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_2_list->ContactName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_2_list->ContactName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_2_list->ContactTitle->Visible) { // ContactTitle ?>
	<?php if ($order_details_extended_2_list->SortUrl($order_details_extended_2_list->ContactTitle) == "") { ?>
		<th data-name="ContactTitle" class="<?php echo $order_details_extended_2_list->ContactTitle->headerCellClass() ?>"><div id="elh_order_details_extended_2_ContactTitle" class="order_details_extended_2_ContactTitle"><div class="ew-table-header-caption"><?php echo $order_details_extended_2_list->ContactTitle->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactTitle" class="<?php echo $order_details_extended_2_list->ContactTitle->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_2_list->SortUrl($order_details_extended_2_list->ContactTitle) ?>', 1);"><div id="elh_order_details_extended_2_ContactTitle" class="order_details_extended_2_ContactTitle">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_2_list->ContactTitle->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_2_list->ContactTitle->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_2_list->ContactTitle->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_2_list->Address->Visible) { // Address ?>
	<?php if ($order_details_extended_2_list->SortUrl($order_details_extended_2_list->Address) == "") { ?>
		<th data-name="Address" class="<?php echo $order_details_extended_2_list->Address->headerCellClass() ?>"><div id="elh_order_details_extended_2_Address" class="order_details_extended_2_Address"><div class="ew-table-header-caption"><?php echo $order_details_extended_2_list->Address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Address" class="<?php echo $order_details_extended_2_list->Address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_2_list->SortUrl($order_details_extended_2_list->Address) ?>', 1);"><div id="elh_order_details_extended_2_Address" class="order_details_extended_2_Address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_2_list->Address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_2_list->Address->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_2_list->Address->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_2_list->City->Visible) { // City ?>
	<?php if ($order_details_extended_2_list->SortUrl($order_details_extended_2_list->City) == "") { ?>
		<th data-name="City" class="<?php echo $order_details_extended_2_list->City->headerCellClass() ?>"><div id="elh_order_details_extended_2_City" class="order_details_extended_2_City"><div class="ew-table-header-caption"><?php echo $order_details_extended_2_list->City->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="City" class="<?php echo $order_details_extended_2_list->City->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_2_list->SortUrl($order_details_extended_2_list->City) ?>', 1);"><div id="elh_order_details_extended_2_City" class="order_details_extended_2_City">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_2_list->City->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_2_list->City->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_2_list->City->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_2_list->Region->Visible) { // Region ?>
	<?php if ($order_details_extended_2_list->SortUrl($order_details_extended_2_list->Region) == "") { ?>
		<th data-name="Region" class="<?php echo $order_details_extended_2_list->Region->headerCellClass() ?>"><div id="elh_order_details_extended_2_Region" class="order_details_extended_2_Region"><div class="ew-table-header-caption"><?php echo $order_details_extended_2_list->Region->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Region" class="<?php echo $order_details_extended_2_list->Region->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_2_list->SortUrl($order_details_extended_2_list->Region) ?>', 1);"><div id="elh_order_details_extended_2_Region" class="order_details_extended_2_Region">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_2_list->Region->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_2_list->Region->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_2_list->Region->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_2_list->PostalCode->Visible) { // PostalCode ?>
	<?php if ($order_details_extended_2_list->SortUrl($order_details_extended_2_list->PostalCode) == "") { ?>
		<th data-name="PostalCode" class="<?php echo $order_details_extended_2_list->PostalCode->headerCellClass() ?>"><div id="elh_order_details_extended_2_PostalCode" class="order_details_extended_2_PostalCode"><div class="ew-table-header-caption"><?php echo $order_details_extended_2_list->PostalCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PostalCode" class="<?php echo $order_details_extended_2_list->PostalCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_2_list->SortUrl($order_details_extended_2_list->PostalCode) ?>', 1);"><div id="elh_order_details_extended_2_PostalCode" class="order_details_extended_2_PostalCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_2_list->PostalCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_2_list->PostalCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_2_list->PostalCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_2_list->Country->Visible) { // Country ?>
	<?php if ($order_details_extended_2_list->SortUrl($order_details_extended_2_list->Country) == "") { ?>
		<th data-name="Country" class="<?php echo $order_details_extended_2_list->Country->headerCellClass() ?>"><div id="elh_order_details_extended_2_Country" class="order_details_extended_2_Country"><div class="ew-table-header-caption"><?php echo $order_details_extended_2_list->Country->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Country" class="<?php echo $order_details_extended_2_list->Country->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_2_list->SortUrl($order_details_extended_2_list->Country) ?>', 1);"><div id="elh_order_details_extended_2_Country" class="order_details_extended_2_Country">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_2_list->Country->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_2_list->Country->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_2_list->Country->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order_details_extended_2_list->Phone->Visible) { // Phone ?>
	<?php if ($order_details_extended_2_list->SortUrl($order_details_extended_2_list->Phone) == "") { ?>
		<th data-name="Phone" class="<?php echo $order_details_extended_2_list->Phone->headerCellClass() ?>"><div id="elh_order_details_extended_2_Phone" class="order_details_extended_2_Phone"><div class="ew-table-header-caption"><?php echo $order_details_extended_2_list->Phone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Phone" class="<?php echo $order_details_extended_2_list->Phone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $order_details_extended_2_list->SortUrl($order_details_extended_2_list->Phone) ?>', 1);"><div id="elh_order_details_extended_2_Phone" class="order_details_extended_2_Phone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order_details_extended_2_list->Phone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($order_details_extended_2_list->Phone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($order_details_extended_2_list->Phone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$order_details_extended_2_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($order_details_extended_2_list->ExportAll && $order_details_extended_2_list->isExport()) {
	$order_details_extended_2_list->StopRecord = $order_details_extended_2_list->TotalRecords;
} else {

	// Set the last record to display
	if ($order_details_extended_2_list->TotalRecords > $order_details_extended_2_list->StartRecord + $order_details_extended_2_list->DisplayRecords - 1)
		$order_details_extended_2_list->StopRecord = $order_details_extended_2_list->StartRecord + $order_details_extended_2_list->DisplayRecords - 1;
	else
		$order_details_extended_2_list->StopRecord = $order_details_extended_2_list->TotalRecords;
}
$order_details_extended_2_list->RecordCount = $order_details_extended_2_list->StartRecord - 1;
if ($order_details_extended_2_list->Recordset && !$order_details_extended_2_list->Recordset->EOF) {
	$order_details_extended_2_list->Recordset->moveFirst();
	$selectLimit = $order_details_extended_2_list->UseSelectLimit;
	if (!$selectLimit && $order_details_extended_2_list->StartRecord > 1)
		$order_details_extended_2_list->Recordset->move($order_details_extended_2_list->StartRecord - 1);
} elseif (!$order_details_extended_2->AllowAddDeleteRow && $order_details_extended_2_list->StopRecord == 0) {
	$order_details_extended_2_list->StopRecord = $order_details_extended_2->GridAddRowCount;
}

// Initialize aggregate
$order_details_extended_2->RowType = ROWTYPE_AGGREGATEINIT;
$order_details_extended_2->resetAttributes();
$order_details_extended_2_list->renderRow();
while ($order_details_extended_2_list->RecordCount < $order_details_extended_2_list->StopRecord) {
	$order_details_extended_2_list->RecordCount++;
	if ($order_details_extended_2_list->RecordCount >= $order_details_extended_2_list->StartRecord) {
		$order_details_extended_2_list->RowCount++;

		// Set up key count
		$order_details_extended_2_list->KeyCount = $order_details_extended_2_list->RowIndex;

		// Init row class and style
		$order_details_extended_2->resetAttributes();
		$order_details_extended_2->CssClass = "";
		if ($order_details_extended_2_list->isGridAdd()) {
		} else {
			$order_details_extended_2_list->loadRowValues($order_details_extended_2_list->Recordset); // Load row values
		}
		$order_details_extended_2->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$order_details_extended_2->RowAttrs->merge(["data-rowindex" => $order_details_extended_2_list->RowCount, "id" => "r" . $order_details_extended_2_list->RowCount . "_order_details_extended_2", "data-rowtype" => $order_details_extended_2->RowType]);

		// Render row
		$order_details_extended_2_list->renderRow();

		// Render list options
		$order_details_extended_2_list->renderListOptions();
?>
	<tr <?php echo $order_details_extended_2->rowAttributes() ?>>
<?php

// Render list options (body, left)
$order_details_extended_2_list->ListOptions->render("body", "left", $order_details_extended_2_list->RowCount);
?>
	<?php if ($order_details_extended_2_list->CompanyName->Visible) { // CompanyName ?>
		<td data-name="CompanyName" <?php echo $order_details_extended_2_list->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_2_list->RowCount ?>_order_details_extended_2_CompanyName">
<span<?php echo $order_details_extended_2_list->CompanyName->viewAttributes() ?>><?php echo $order_details_extended_2_list->CompanyName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_2_list->OrderID->Visible) { // OrderID ?>
		<td data-name="OrderID" <?php echo $order_details_extended_2_list->OrderID->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_2_list->RowCount ?>_order_details_extended_2_OrderID">
<span<?php echo $order_details_extended_2_list->OrderID->viewAttributes() ?>><?php echo $order_details_extended_2_list->OrderID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_2_list->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" <?php echo $order_details_extended_2_list->ProductName->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_2_list->RowCount ?>_order_details_extended_2_ProductName">
<span<?php echo $order_details_extended_2_list->ProductName->viewAttributes() ?>><?php echo $order_details_extended_2_list->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_2_list->UnitPrice->Visible) { // UnitPrice ?>
		<td data-name="UnitPrice" <?php echo $order_details_extended_2_list->UnitPrice->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_2_list->RowCount ?>_order_details_extended_2_UnitPrice">
<span<?php echo $order_details_extended_2_list->UnitPrice->viewAttributes() ?>><?php echo $order_details_extended_2_list->UnitPrice->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_2_list->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity" <?php echo $order_details_extended_2_list->Quantity->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_2_list->RowCount ?>_order_details_extended_2_Quantity">
<span<?php echo $order_details_extended_2_list->Quantity->viewAttributes() ?>><?php echo $order_details_extended_2_list->Quantity->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_2_list->Discount->Visible) { // Discount ?>
		<td data-name="Discount" <?php echo $order_details_extended_2_list->Discount->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_2_list->RowCount ?>_order_details_extended_2_Discount">
<span<?php echo $order_details_extended_2_list->Discount->viewAttributes() ?>><?php echo $order_details_extended_2_list->Discount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_2_list->Extended_Price->Visible) { // Extended Price ?>
		<td data-name="Extended_Price" <?php echo $order_details_extended_2_list->Extended_Price->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_2_list->RowCount ?>_order_details_extended_2_Extended_Price">
<span<?php echo $order_details_extended_2_list->Extended_Price->viewAttributes() ?>><?php echo $order_details_extended_2_list->Extended_Price->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_2_list->OrderDate->Visible) { // OrderDate ?>
		<td data-name="OrderDate" <?php echo $order_details_extended_2_list->OrderDate->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_2_list->RowCount ?>_order_details_extended_2_OrderDate">
<span<?php echo $order_details_extended_2_list->OrderDate->viewAttributes() ?>><?php echo $order_details_extended_2_list->OrderDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_2_list->ContactName->Visible) { // ContactName ?>
		<td data-name="ContactName" <?php echo $order_details_extended_2_list->ContactName->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_2_list->RowCount ?>_order_details_extended_2_ContactName">
<span<?php echo $order_details_extended_2_list->ContactName->viewAttributes() ?>><?php echo $order_details_extended_2_list->ContactName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_2_list->ContactTitle->Visible) { // ContactTitle ?>
		<td data-name="ContactTitle" <?php echo $order_details_extended_2_list->ContactTitle->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_2_list->RowCount ?>_order_details_extended_2_ContactTitle">
<span<?php echo $order_details_extended_2_list->ContactTitle->viewAttributes() ?>><?php echo $order_details_extended_2_list->ContactTitle->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_2_list->Address->Visible) { // Address ?>
		<td data-name="Address" <?php echo $order_details_extended_2_list->Address->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_2_list->RowCount ?>_order_details_extended_2_Address">
<span<?php echo $order_details_extended_2_list->Address->viewAttributes() ?>><?php echo $order_details_extended_2_list->Address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_2_list->City->Visible) { // City ?>
		<td data-name="City" <?php echo $order_details_extended_2_list->City->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_2_list->RowCount ?>_order_details_extended_2_City">
<span<?php echo $order_details_extended_2_list->City->viewAttributes() ?>><?php echo $order_details_extended_2_list->City->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_2_list->Region->Visible) { // Region ?>
		<td data-name="Region" <?php echo $order_details_extended_2_list->Region->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_2_list->RowCount ?>_order_details_extended_2_Region">
<span<?php echo $order_details_extended_2_list->Region->viewAttributes() ?>><?php echo $order_details_extended_2_list->Region->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_2_list->PostalCode->Visible) { // PostalCode ?>
		<td data-name="PostalCode" <?php echo $order_details_extended_2_list->PostalCode->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_2_list->RowCount ?>_order_details_extended_2_PostalCode">
<span<?php echo $order_details_extended_2_list->PostalCode->viewAttributes() ?>><?php echo $order_details_extended_2_list->PostalCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_2_list->Country->Visible) { // Country ?>
		<td data-name="Country" <?php echo $order_details_extended_2_list->Country->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_2_list->RowCount ?>_order_details_extended_2_Country">
<span<?php echo $order_details_extended_2_list->Country->viewAttributes() ?>><?php echo $order_details_extended_2_list->Country->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order_details_extended_2_list->Phone->Visible) { // Phone ?>
		<td data-name="Phone" <?php echo $order_details_extended_2_list->Phone->cellAttributes() ?>>
<span id="el<?php echo $order_details_extended_2_list->RowCount ?>_order_details_extended_2_Phone">
<span<?php echo $order_details_extended_2_list->Phone->viewAttributes() ?>><?php echo $order_details_extended_2_list->Phone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$order_details_extended_2_list->ListOptions->render("body", "right", $order_details_extended_2_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$order_details_extended_2_list->isGridAdd())
		$order_details_extended_2_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$order_details_extended_2->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($order_details_extended_2_list->Recordset)
	$order_details_extended_2_list->Recordset->Close();
?>
<?php if (!$order_details_extended_2_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$order_details_extended_2_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $order_details_extended_2_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $order_details_extended_2_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($order_details_extended_2_list->TotalRecords == 0 && !$order_details_extended_2->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $order_details_extended_2_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$order_details_extended_2_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$order_details_extended_2_list->isExport()) { ?>
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
$order_details_extended_2_list->terminate();
?>