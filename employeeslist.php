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
$employees_list = new employees_list();

// Run the page
$employees_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employees_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employees_list->isExport()) { ?>
<script>
var femployeeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	femployeeslist = currentForm = new ew.Form("femployeeslist", "list");
	femployeeslist.formKeyCountName = '<?php echo $employees_list->FormKeyCountName ?>';
	loadjs.done("femployeeslist");
});
var femployeeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	femployeeslistsrch = currentSearchForm = new ew.Form("femployeeslistsrch");

	// Dynamic selection lists
	// Filters

	femployeeslistsrch.filterList = <?php echo $employees_list->getFilterList() ?>;
	loadjs.done("femployeeslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$employees_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($employees_list->TotalRecords > 0 && $employees_list->ExportOptions->visible()) { ?>
<?php $employees_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($employees_list->ImportOptions->visible()) { ?>
<?php $employees_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($employees_list->SearchOptions->visible()) { ?>
<?php $employees_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($employees_list->FilterOptions->visible()) { ?>
<?php $employees_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$employees_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$employees_list->isExport() && !$employees->CurrentAction) { ?>
<form name="femployeeslistsrch" id="femployeeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="femployeeslistsrch-search-panel" class="<?php echo $employees_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="employees">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $employees_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($employees_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($employees_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $employees_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($employees_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($employees_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($employees_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($employees_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $employees_list->showPageHeader(); ?>
<?php
$employees_list->showMessage();
?>
<?php if ($employees_list->TotalRecords > 0 || $employees->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($employees_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> employees">
<form name="femployeeslist" id="femployeeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employees">
<div id="gmp_employees" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($employees_list->TotalRecords > 0 || $employees_list->isGridEdit()) { ?>
<table id="tbl_employeeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$employees->RowType = ROWTYPE_HEADER;

// Render list options
$employees_list->renderListOptions();

// Render list options (header, left)
$employees_list->ListOptions->render("header", "left");
?>
<?php if ($employees_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($employees_list->SortUrl($employees_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $employees_list->EmployeeID->headerCellClass() ?>"><div id="elh_employees_EmployeeID" class="employees_EmployeeID"><div class="ew-table-header-caption"><?php echo $employees_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $employees_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->EmployeeID) ?>', 1);"><div id="elh_employees_EmployeeID" class="employees_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($employees_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->LastName->Visible) { // LastName ?>
	<?php if ($employees_list->SortUrl($employees_list->LastName) == "") { ?>
		<th data-name="LastName" class="<?php echo $employees_list->LastName->headerCellClass() ?>"><div id="elh_employees_LastName" class="employees_LastName"><div class="ew-table-header-caption"><?php echo $employees_list->LastName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastName" class="<?php echo $employees_list->LastName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->LastName) ?>', 1);"><div id="elh_employees_LastName" class="employees_LastName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->LastName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->LastName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->LastName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->FirstName->Visible) { // FirstName ?>
	<?php if ($employees_list->SortUrl($employees_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $employees_list->FirstName->headerCellClass() ?>"><div id="elh_employees_FirstName" class="employees_FirstName"><div class="ew-table-header-caption"><?php echo $employees_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $employees_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->FirstName) ?>', 1);"><div id="elh_employees_FirstName" class="employees_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->Title->Visible) { // Title ?>
	<?php if ($employees_list->SortUrl($employees_list->Title) == "") { ?>
		<th data-name="Title" class="<?php echo $employees_list->Title->headerCellClass() ?>"><div id="elh_employees_Title" class="employees_Title"><div class="ew-table-header-caption"><?php echo $employees_list->Title->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Title" class="<?php echo $employees_list->Title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->Title) ?>', 1);"><div id="elh_employees_Title" class="employees_Title">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->Title->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->Title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->Title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->TitleOfCourtesy->Visible) { // TitleOfCourtesy ?>
	<?php if ($employees_list->SortUrl($employees_list->TitleOfCourtesy) == "") { ?>
		<th data-name="TitleOfCourtesy" class="<?php echo $employees_list->TitleOfCourtesy->headerCellClass() ?>"><div id="elh_employees_TitleOfCourtesy" class="employees_TitleOfCourtesy"><div class="ew-table-header-caption"><?php echo $employees_list->TitleOfCourtesy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TitleOfCourtesy" class="<?php echo $employees_list->TitleOfCourtesy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->TitleOfCourtesy) ?>', 1);"><div id="elh_employees_TitleOfCourtesy" class="employees_TitleOfCourtesy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->TitleOfCourtesy->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->TitleOfCourtesy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->TitleOfCourtesy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->BirthDate->Visible) { // BirthDate ?>
	<?php if ($employees_list->SortUrl($employees_list->BirthDate) == "") { ?>
		<th data-name="BirthDate" class="<?php echo $employees_list->BirthDate->headerCellClass() ?>"><div id="elh_employees_BirthDate" class="employees_BirthDate"><div class="ew-table-header-caption"><?php echo $employees_list->BirthDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BirthDate" class="<?php echo $employees_list->BirthDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->BirthDate) ?>', 1);"><div id="elh_employees_BirthDate" class="employees_BirthDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->BirthDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employees_list->BirthDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->BirthDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->HireDate->Visible) { // HireDate ?>
	<?php if ($employees_list->SortUrl($employees_list->HireDate) == "") { ?>
		<th data-name="HireDate" class="<?php echo $employees_list->HireDate->headerCellClass() ?>"><div id="elh_employees_HireDate" class="employees_HireDate"><div class="ew-table-header-caption"><?php echo $employees_list->HireDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HireDate" class="<?php echo $employees_list->HireDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->HireDate) ?>', 1);"><div id="elh_employees_HireDate" class="employees_HireDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->HireDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employees_list->HireDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->HireDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->Address->Visible) { // Address ?>
	<?php if ($employees_list->SortUrl($employees_list->Address) == "") { ?>
		<th data-name="Address" class="<?php echo $employees_list->Address->headerCellClass() ?>"><div id="elh_employees_Address" class="employees_Address"><div class="ew-table-header-caption"><?php echo $employees_list->Address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Address" class="<?php echo $employees_list->Address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->Address) ?>', 1);"><div id="elh_employees_Address" class="employees_Address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->Address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->Address->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->Address->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->City->Visible) { // City ?>
	<?php if ($employees_list->SortUrl($employees_list->City) == "") { ?>
		<th data-name="City" class="<?php echo $employees_list->City->headerCellClass() ?>"><div id="elh_employees_City" class="employees_City"><div class="ew-table-header-caption"><?php echo $employees_list->City->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="City" class="<?php echo $employees_list->City->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->City) ?>', 1);"><div id="elh_employees_City" class="employees_City">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->City->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->City->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->City->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->Region->Visible) { // Region ?>
	<?php if ($employees_list->SortUrl($employees_list->Region) == "") { ?>
		<th data-name="Region" class="<?php echo $employees_list->Region->headerCellClass() ?>"><div id="elh_employees_Region" class="employees_Region"><div class="ew-table-header-caption"><?php echo $employees_list->Region->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Region" class="<?php echo $employees_list->Region->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->Region) ?>', 1);"><div id="elh_employees_Region" class="employees_Region">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->Region->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->Region->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->Region->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->PostalCode->Visible) { // PostalCode ?>
	<?php if ($employees_list->SortUrl($employees_list->PostalCode) == "") { ?>
		<th data-name="PostalCode" class="<?php echo $employees_list->PostalCode->headerCellClass() ?>"><div id="elh_employees_PostalCode" class="employees_PostalCode"><div class="ew-table-header-caption"><?php echo $employees_list->PostalCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PostalCode" class="<?php echo $employees_list->PostalCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->PostalCode) ?>', 1);"><div id="elh_employees_PostalCode" class="employees_PostalCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->PostalCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->PostalCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->PostalCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->Country->Visible) { // Country ?>
	<?php if ($employees_list->SortUrl($employees_list->Country) == "") { ?>
		<th data-name="Country" class="<?php echo $employees_list->Country->headerCellClass() ?>"><div id="elh_employees_Country" class="employees_Country"><div class="ew-table-header-caption"><?php echo $employees_list->Country->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Country" class="<?php echo $employees_list->Country->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->Country) ?>', 1);"><div id="elh_employees_Country" class="employees_Country">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->Country->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->Country->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->Country->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->HomePhone->Visible) { // HomePhone ?>
	<?php if ($employees_list->SortUrl($employees_list->HomePhone) == "") { ?>
		<th data-name="HomePhone" class="<?php echo $employees_list->HomePhone->headerCellClass() ?>"><div id="elh_employees_HomePhone" class="employees_HomePhone"><div class="ew-table-header-caption"><?php echo $employees_list->HomePhone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HomePhone" class="<?php echo $employees_list->HomePhone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->HomePhone) ?>', 1);"><div id="elh_employees_HomePhone" class="employees_HomePhone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->HomePhone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->HomePhone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->HomePhone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->Extension->Visible) { // Extension ?>
	<?php if ($employees_list->SortUrl($employees_list->Extension) == "") { ?>
		<th data-name="Extension" class="<?php echo $employees_list->Extension->headerCellClass() ?>"><div id="elh_employees_Extension" class="employees_Extension"><div class="ew-table-header-caption"><?php echo $employees_list->Extension->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Extension" class="<?php echo $employees_list->Extension->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->Extension) ?>', 1);"><div id="elh_employees_Extension" class="employees_Extension">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->Extension->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->Extension->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->Extension->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->_Email->Visible) { // Email ?>
	<?php if ($employees_list->SortUrl($employees_list->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $employees_list->_Email->headerCellClass() ?>"><div id="elh_employees__Email" class="employees__Email"><div class="ew-table-header-caption"><?php echo $employees_list->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $employees_list->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->_Email) ?>', 1);"><div id="elh_employees__Email" class="employees__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->Photo->Visible) { // Photo ?>
	<?php if ($employees_list->SortUrl($employees_list->Photo) == "") { ?>
		<th data-name="Photo" class="<?php echo $employees_list->Photo->headerCellClass() ?>"><div id="elh_employees_Photo" class="employees_Photo"><div class="ew-table-header-caption"><?php echo $employees_list->Photo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Photo" class="<?php echo $employees_list->Photo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->Photo) ?>', 1);"><div id="elh_employees_Photo" class="employees_Photo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->Photo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->Photo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->Photo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->ReportsTo->Visible) { // ReportsTo ?>
	<?php if ($employees_list->SortUrl($employees_list->ReportsTo) == "") { ?>
		<th data-name="ReportsTo" class="<?php echo $employees_list->ReportsTo->headerCellClass() ?>"><div id="elh_employees_ReportsTo" class="employees_ReportsTo"><div class="ew-table-header-caption"><?php echo $employees_list->ReportsTo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReportsTo" class="<?php echo $employees_list->ReportsTo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->ReportsTo) ?>', 1);"><div id="elh_employees_ReportsTo" class="employees_ReportsTo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->ReportsTo->caption() ?></span><span class="ew-table-header-sort"><?php if ($employees_list->ReportsTo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->ReportsTo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->Password->Visible) { // Password ?>
	<?php if ($employees_list->SortUrl($employees_list->Password) == "") { ?>
		<th data-name="Password" class="<?php echo $employees_list->Password->headerCellClass() ?>"><div id="elh_employees_Password" class="employees_Password"><div class="ew-table-header-caption"><?php echo $employees_list->Password->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Password" class="<?php echo $employees_list->Password->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->Password) ?>', 1);"><div id="elh_employees_Password" class="employees_Password">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->Password->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->Password->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->Password->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->UserLevel->Visible) { // UserLevel ?>
	<?php if ($employees_list->SortUrl($employees_list->UserLevel) == "") { ?>
		<th data-name="UserLevel" class="<?php echo $employees_list->UserLevel->headerCellClass() ?>"><div id="elh_employees_UserLevel" class="employees_UserLevel"><div class="ew-table-header-caption"><?php echo $employees_list->UserLevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UserLevel" class="<?php echo $employees_list->UserLevel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->UserLevel) ?>', 1);"><div id="elh_employees_UserLevel" class="employees_UserLevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->UserLevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($employees_list->UserLevel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->UserLevel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->Username->Visible) { // Username ?>
	<?php if ($employees_list->SortUrl($employees_list->Username) == "") { ?>
		<th data-name="Username" class="<?php echo $employees_list->Username->headerCellClass() ?>"><div id="elh_employees_Username" class="employees_Username"><div class="ew-table-header-caption"><?php echo $employees_list->Username->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Username" class="<?php echo $employees_list->Username->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->Username) ?>', 1);"><div id="elh_employees_Username" class="employees_Username">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->Username->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees_list->Username->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->Username->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees_list->Activated->Visible) { // Activated ?>
	<?php if ($employees_list->SortUrl($employees_list->Activated) == "") { ?>
		<th data-name="Activated" class="<?php echo $employees_list->Activated->headerCellClass() ?>"><div id="elh_employees_Activated" class="employees_Activated"><div class="ew-table-header-caption"><?php echo $employees_list->Activated->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Activated" class="<?php echo $employees_list->Activated->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employees_list->SortUrl($employees_list->Activated) ?>', 1);"><div id="elh_employees_Activated" class="employees_Activated">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees_list->Activated->caption() ?></span><span class="ew-table-header-sort"><?php if ($employees_list->Activated->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employees_list->Activated->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employees_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($employees_list->ExportAll && $employees_list->isExport()) {
	$employees_list->StopRecord = $employees_list->TotalRecords;
} else {

	// Set the last record to display
	if ($employees_list->TotalRecords > $employees_list->StartRecord + $employees_list->DisplayRecords - 1)
		$employees_list->StopRecord = $employees_list->StartRecord + $employees_list->DisplayRecords - 1;
	else
		$employees_list->StopRecord = $employees_list->TotalRecords;
}
$employees_list->RecordCount = $employees_list->StartRecord - 1;
if ($employees_list->Recordset && !$employees_list->Recordset->EOF) {
	$employees_list->Recordset->moveFirst();
	$selectLimit = $employees_list->UseSelectLimit;
	if (!$selectLimit && $employees_list->StartRecord > 1)
		$employees_list->Recordset->move($employees_list->StartRecord - 1);
} elseif (!$employees->AllowAddDeleteRow && $employees_list->StopRecord == 0) {
	$employees_list->StopRecord = $employees->GridAddRowCount;
}

// Initialize aggregate
$employees->RowType = ROWTYPE_AGGREGATEINIT;
$employees->resetAttributes();
$employees_list->renderRow();
while ($employees_list->RecordCount < $employees_list->StopRecord) {
	$employees_list->RecordCount++;
	if ($employees_list->RecordCount >= $employees_list->StartRecord) {
		$employees_list->RowCount++;

		// Set up key count
		$employees_list->KeyCount = $employees_list->RowIndex;

		// Init row class and style
		$employees->resetAttributes();
		$employees->CssClass = "";
		if ($employees_list->isGridAdd()) {
		} else {
			$employees_list->loadRowValues($employees_list->Recordset); // Load row values
		}
		$employees->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$employees->RowAttrs->merge(["data-rowindex" => $employees_list->RowCount, "id" => "r" . $employees_list->RowCount . "_employees", "data-rowtype" => $employees->RowType]);

		// Render row
		$employees_list->renderRow();

		// Render list options
		$employees_list->renderListOptions();
?>
	<tr <?php echo $employees->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employees_list->ListOptions->render("body", "left", $employees_list->RowCount);
?>
	<?php if ($employees_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $employees_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_EmployeeID">
<span<?php echo $employees_list->EmployeeID->viewAttributes() ?>><?php echo $employees_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->LastName->Visible) { // LastName ?>
		<td data-name="LastName" <?php echo $employees_list->LastName->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_LastName">
<span<?php echo $employees_list->LastName->viewAttributes() ?>><?php echo $employees_list->LastName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $employees_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_FirstName">
<span<?php echo $employees_list->FirstName->viewAttributes() ?>><?php echo $employees_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->Title->Visible) { // Title ?>
		<td data-name="Title" <?php echo $employees_list->Title->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_Title">
<span<?php echo $employees_list->Title->viewAttributes() ?>><?php echo $employees_list->Title->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->TitleOfCourtesy->Visible) { // TitleOfCourtesy ?>
		<td data-name="TitleOfCourtesy" <?php echo $employees_list->TitleOfCourtesy->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_TitleOfCourtesy">
<span<?php echo $employees_list->TitleOfCourtesy->viewAttributes() ?>><?php echo $employees_list->TitleOfCourtesy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->BirthDate->Visible) { // BirthDate ?>
		<td data-name="BirthDate" <?php echo $employees_list->BirthDate->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_BirthDate">
<span<?php echo $employees_list->BirthDate->viewAttributes() ?>><?php echo $employees_list->BirthDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->HireDate->Visible) { // HireDate ?>
		<td data-name="HireDate" <?php echo $employees_list->HireDate->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_HireDate">
<span<?php echo $employees_list->HireDate->viewAttributes() ?>><?php echo $employees_list->HireDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->Address->Visible) { // Address ?>
		<td data-name="Address" <?php echo $employees_list->Address->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_Address">
<span<?php echo $employees_list->Address->viewAttributes() ?>><?php echo $employees_list->Address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->City->Visible) { // City ?>
		<td data-name="City" <?php echo $employees_list->City->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_City">
<span<?php echo $employees_list->City->viewAttributes() ?>><?php echo $employees_list->City->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->Region->Visible) { // Region ?>
		<td data-name="Region" <?php echo $employees_list->Region->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_Region">
<span<?php echo $employees_list->Region->viewAttributes() ?>><?php echo $employees_list->Region->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->PostalCode->Visible) { // PostalCode ?>
		<td data-name="PostalCode" <?php echo $employees_list->PostalCode->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_PostalCode">
<span<?php echo $employees_list->PostalCode->viewAttributes() ?>><?php echo $employees_list->PostalCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->Country->Visible) { // Country ?>
		<td data-name="Country" <?php echo $employees_list->Country->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_Country">
<span<?php echo $employees_list->Country->viewAttributes() ?>><?php echo $employees_list->Country->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->HomePhone->Visible) { // HomePhone ?>
		<td data-name="HomePhone" <?php echo $employees_list->HomePhone->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_HomePhone">
<span<?php echo $employees_list->HomePhone->viewAttributes() ?>><?php echo $employees_list->HomePhone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->Extension->Visible) { // Extension ?>
		<td data-name="Extension" <?php echo $employees_list->Extension->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_Extension">
<span<?php echo $employees_list->Extension->viewAttributes() ?>><?php echo $employees_list->Extension->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $employees_list->_Email->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees__Email">
<span<?php echo $employees_list->_Email->viewAttributes() ?>><?php echo $employees_list->_Email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->Photo->Visible) { // Photo ?>
		<td data-name="Photo" <?php echo $employees_list->Photo->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_Photo">
<span<?php echo $employees_list->Photo->viewAttributes() ?>><?php echo $employees_list->Photo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->ReportsTo->Visible) { // ReportsTo ?>
		<td data-name="ReportsTo" <?php echo $employees_list->ReportsTo->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_ReportsTo">
<span<?php echo $employees_list->ReportsTo->viewAttributes() ?>><?php echo $employees_list->ReportsTo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->Password->Visible) { // Password ?>
		<td data-name="Password" <?php echo $employees_list->Password->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_Password">
<span<?php echo $employees_list->Password->viewAttributes() ?>><?php echo $employees_list->Password->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->UserLevel->Visible) { // UserLevel ?>
		<td data-name="UserLevel" <?php echo $employees_list->UserLevel->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_UserLevel">
<span<?php echo $employees_list->UserLevel->viewAttributes() ?>><?php echo $employees_list->UserLevel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->Username->Visible) { // Username ?>
		<td data-name="Username" <?php echo $employees_list->Username->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_Username">
<span<?php echo $employees_list->Username->viewAttributes() ?>><?php echo $employees_list->Username->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees_list->Activated->Visible) { // Activated ?>
		<td data-name="Activated" <?php echo $employees_list->Activated->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCount ?>_employees_Activated">
<span<?php echo $employees_list->Activated->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_Activated" class="custom-control-input" value="<?php echo $employees_list->Activated->getViewValue() ?>" disabled<?php if (ConvertToBool($employees_list->Activated->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_Activated"></label></div></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employees_list->ListOptions->render("body", "right", $employees_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$employees_list->isGridAdd())
		$employees_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$employees->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($employees_list->Recordset)
	$employees_list->Recordset->Close();
?>
<?php if (!$employees_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$employees_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employees_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employees_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($employees_list->TotalRecords == 0 && !$employees->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $employees_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$employees_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employees_list->isExport()) { ?>
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
$employees_list->terminate();
?>