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
$cars_list = new cars_list();

// Run the page
$cars_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cars_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cars_list->isExport()) { ?>
<script>
var fcarslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcarslist = currentForm = new ew.Form("fcarslist", "list");
	fcarslist.formKeyCountName = '<?php echo $cars_list->FormKeyCountName ?>';
	loadjs.done("fcarslist");
});
var fcarslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcarslistsrch = currentSearchForm = new ew.Form("fcarslistsrch");

	// Dynamic selection lists
	// Filters

	fcarslistsrch.filterList = <?php echo $cars_list->getFilterList() ?>;
	loadjs.done("fcarslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cars_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cars_list->TotalRecords > 0 && $cars_list->ExportOptions->visible()) { ?>
<?php $cars_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cars_list->ImportOptions->visible()) { ?>
<?php $cars_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($cars_list->SearchOptions->visible()) { ?>
<?php $cars_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($cars_list->FilterOptions->visible()) { ?>
<?php $cars_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cars_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$cars_list->isExport() && !$cars->CurrentAction) { ?>
<form name="fcarslistsrch" id="fcarslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcarslistsrch-search-panel" class="<?php echo $cars_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cars">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $cars_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($cars_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($cars_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $cars_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($cars_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($cars_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($cars_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($cars_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $cars_list->showPageHeader(); ?>
<?php
$cars_list->showMessage();
?>
<?php if ($cars_list->TotalRecords > 0 || $cars->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cars_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cars">
<form name="fcarslist" id="fcarslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cars">
<div id="gmp_cars" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($cars_list->TotalRecords > 0 || $cars_list->isGridEdit()) { ?>
<table id="tbl_carslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cars->RowType = ROWTYPE_HEADER;

// Render list options
$cars_list->renderListOptions();

// Render list options (header, left)
$cars_list->ListOptions->render("header", "left");
?>
<?php if ($cars_list->ID->Visible) { // ID ?>
	<?php if ($cars_list->SortUrl($cars_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $cars_list->ID->headerCellClass() ?>"><div id="elh_cars_ID" class="cars_ID"><div class="ew-table-header-caption"><?php echo $cars_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $cars_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars_list->SortUrl($cars_list->ID) ?>', 1);"><div id="elh_cars_ID" class="cars_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars_list->Trademark->Visible) { // Trademark ?>
	<?php if ($cars_list->SortUrl($cars_list->Trademark) == "") { ?>
		<th data-name="Trademark" class="<?php echo $cars_list->Trademark->headerCellClass() ?>"><div id="elh_cars_Trademark" class="cars_Trademark"><div class="ew-table-header-caption"><?php echo $cars_list->Trademark->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Trademark" class="<?php echo $cars_list->Trademark->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars_list->SortUrl($cars_list->Trademark) ?>', 1);"><div id="elh_cars_Trademark" class="cars_Trademark">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars_list->Trademark->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars_list->Trademark->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars_list->Trademark->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars_list->Model->Visible) { // Model ?>
	<?php if ($cars_list->SortUrl($cars_list->Model) == "") { ?>
		<th data-name="Model" class="<?php echo $cars_list->Model->headerCellClass() ?>"><div id="elh_cars_Model" class="cars_Model"><div class="ew-table-header-caption"><?php echo $cars_list->Model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Model" class="<?php echo $cars_list->Model->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars_list->SortUrl($cars_list->Model) ?>', 1);"><div id="elh_cars_Model" class="cars_Model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars_list->Model->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars_list->Model->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars_list->Model->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars_list->HP->Visible) { // HP ?>
	<?php if ($cars_list->SortUrl($cars_list->HP) == "") { ?>
		<th data-name="HP" class="<?php echo $cars_list->HP->headerCellClass() ?>"><div id="elh_cars_HP" class="cars_HP"><div class="ew-table-header-caption"><?php echo $cars_list->HP->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HP" class="<?php echo $cars_list->HP->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars_list->SortUrl($cars_list->HP) ?>', 1);"><div id="elh_cars_HP" class="cars_HP">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars_list->HP->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars_list->HP->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars_list->HP->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars_list->Liter->Visible) { // Liter ?>
	<?php if ($cars_list->SortUrl($cars_list->Liter) == "") { ?>
		<th data-name="Liter" class="<?php echo $cars_list->Liter->headerCellClass() ?>"><div id="elh_cars_Liter" class="cars_Liter"><div class="ew-table-header-caption"><?php echo $cars_list->Liter->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Liter" class="<?php echo $cars_list->Liter->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars_list->SortUrl($cars_list->Liter) ?>', 1);"><div id="elh_cars_Liter" class="cars_Liter">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars_list->Liter->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars_list->Liter->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars_list->Liter->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars_list->Cyl->Visible) { // Cyl ?>
	<?php if ($cars_list->SortUrl($cars_list->Cyl) == "") { ?>
		<th data-name="Cyl" class="<?php echo $cars_list->Cyl->headerCellClass() ?>"><div id="elh_cars_Cyl" class="cars_Cyl"><div class="ew-table-header-caption"><?php echo $cars_list->Cyl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Cyl" class="<?php echo $cars_list->Cyl->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars_list->SortUrl($cars_list->Cyl) ?>', 1);"><div id="elh_cars_Cyl" class="cars_Cyl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars_list->Cyl->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars_list->Cyl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars_list->Cyl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars_list->TransmissSpeedCount->Visible) { // TransmissSpeedCount ?>
	<?php if ($cars_list->SortUrl($cars_list->TransmissSpeedCount) == "") { ?>
		<th data-name="TransmissSpeedCount" class="<?php echo $cars_list->TransmissSpeedCount->headerCellClass() ?>"><div id="elh_cars_TransmissSpeedCount" class="cars_TransmissSpeedCount"><div class="ew-table-header-caption"><?php echo $cars_list->TransmissSpeedCount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TransmissSpeedCount" class="<?php echo $cars_list->TransmissSpeedCount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars_list->SortUrl($cars_list->TransmissSpeedCount) ?>', 1);"><div id="elh_cars_TransmissSpeedCount" class="cars_TransmissSpeedCount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars_list->TransmissSpeedCount->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars_list->TransmissSpeedCount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars_list->TransmissSpeedCount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars_list->TransmissAutomatic->Visible) { // TransmissAutomatic ?>
	<?php if ($cars_list->SortUrl($cars_list->TransmissAutomatic) == "") { ?>
		<th data-name="TransmissAutomatic" class="<?php echo $cars_list->TransmissAutomatic->headerCellClass() ?>"><div id="elh_cars_TransmissAutomatic" class="cars_TransmissAutomatic"><div class="ew-table-header-caption"><?php echo $cars_list->TransmissAutomatic->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TransmissAutomatic" class="<?php echo $cars_list->TransmissAutomatic->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars_list->SortUrl($cars_list->TransmissAutomatic) ?>', 1);"><div id="elh_cars_TransmissAutomatic" class="cars_TransmissAutomatic">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars_list->TransmissAutomatic->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars_list->TransmissAutomatic->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars_list->TransmissAutomatic->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars_list->MPG_City->Visible) { // MPG_City ?>
	<?php if ($cars_list->SortUrl($cars_list->MPG_City) == "") { ?>
		<th data-name="MPG_City" class="<?php echo $cars_list->MPG_City->headerCellClass() ?>"><div id="elh_cars_MPG_City" class="cars_MPG_City"><div class="ew-table-header-caption"><?php echo $cars_list->MPG_City->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MPG_City" class="<?php echo $cars_list->MPG_City->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars_list->SortUrl($cars_list->MPG_City) ?>', 1);"><div id="elh_cars_MPG_City" class="cars_MPG_City">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars_list->MPG_City->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars_list->MPG_City->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars_list->MPG_City->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars_list->MPG_Highway->Visible) { // MPG_Highway ?>
	<?php if ($cars_list->SortUrl($cars_list->MPG_Highway) == "") { ?>
		<th data-name="MPG_Highway" class="<?php echo $cars_list->MPG_Highway->headerCellClass() ?>"><div id="elh_cars_MPG_Highway" class="cars_MPG_Highway"><div class="ew-table-header-caption"><?php echo $cars_list->MPG_Highway->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MPG_Highway" class="<?php echo $cars_list->MPG_Highway->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars_list->SortUrl($cars_list->MPG_Highway) ?>', 1);"><div id="elh_cars_MPG_Highway" class="cars_MPG_Highway">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars_list->MPG_Highway->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars_list->MPG_Highway->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars_list->MPG_Highway->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars_list->Category->Visible) { // Category ?>
	<?php if ($cars_list->SortUrl($cars_list->Category) == "") { ?>
		<th data-name="Category" class="<?php echo $cars_list->Category->headerCellClass() ?>"><div id="elh_cars_Category" class="cars_Category"><div class="ew-table-header-caption"><?php echo $cars_list->Category->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Category" class="<?php echo $cars_list->Category->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars_list->SortUrl($cars_list->Category) ?>', 1);"><div id="elh_cars_Category" class="cars_Category">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars_list->Category->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars_list->Category->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars_list->Category->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars_list->Hyperlink->Visible) { // Hyperlink ?>
	<?php if ($cars_list->SortUrl($cars_list->Hyperlink) == "") { ?>
		<th data-name="Hyperlink" class="<?php echo $cars_list->Hyperlink->headerCellClass() ?>"><div id="elh_cars_Hyperlink" class="cars_Hyperlink"><div class="ew-table-header-caption"><?php echo $cars_list->Hyperlink->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Hyperlink" class="<?php echo $cars_list->Hyperlink->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars_list->SortUrl($cars_list->Hyperlink) ?>', 1);"><div id="elh_cars_Hyperlink" class="cars_Hyperlink">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars_list->Hyperlink->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars_list->Hyperlink->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars_list->Hyperlink->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars_list->Price->Visible) { // Price ?>
	<?php if ($cars_list->SortUrl($cars_list->Price) == "") { ?>
		<th data-name="Price" class="<?php echo $cars_list->Price->headerCellClass() ?>"><div id="elh_cars_Price" class="cars_Price"><div class="ew-table-header-caption"><?php echo $cars_list->Price->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Price" class="<?php echo $cars_list->Price->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars_list->SortUrl($cars_list->Price) ?>', 1);"><div id="elh_cars_Price" class="cars_Price">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars_list->Price->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars_list->Price->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars_list->Price->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars_list->PictureName->Visible) { // PictureName ?>
	<?php if ($cars_list->SortUrl($cars_list->PictureName) == "") { ?>
		<th data-name="PictureName" class="<?php echo $cars_list->PictureName->headerCellClass() ?>"><div id="elh_cars_PictureName" class="cars_PictureName"><div class="ew-table-header-caption"><?php echo $cars_list->PictureName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PictureName" class="<?php echo $cars_list->PictureName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars_list->SortUrl($cars_list->PictureName) ?>', 1);"><div id="elh_cars_PictureName" class="cars_PictureName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars_list->PictureName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars_list->PictureName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars_list->PictureName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars_list->PictureSize->Visible) { // PictureSize ?>
	<?php if ($cars_list->SortUrl($cars_list->PictureSize) == "") { ?>
		<th data-name="PictureSize" class="<?php echo $cars_list->PictureSize->headerCellClass() ?>"><div id="elh_cars_PictureSize" class="cars_PictureSize"><div class="ew-table-header-caption"><?php echo $cars_list->PictureSize->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PictureSize" class="<?php echo $cars_list->PictureSize->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars_list->SortUrl($cars_list->PictureSize) ?>', 1);"><div id="elh_cars_PictureSize" class="cars_PictureSize">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars_list->PictureSize->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars_list->PictureSize->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars_list->PictureSize->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars_list->PictureType->Visible) { // PictureType ?>
	<?php if ($cars_list->SortUrl($cars_list->PictureType) == "") { ?>
		<th data-name="PictureType" class="<?php echo $cars_list->PictureType->headerCellClass() ?>"><div id="elh_cars_PictureType" class="cars_PictureType"><div class="ew-table-header-caption"><?php echo $cars_list->PictureType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PictureType" class="<?php echo $cars_list->PictureType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars_list->SortUrl($cars_list->PictureType) ?>', 1);"><div id="elh_cars_PictureType" class="cars_PictureType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars_list->PictureType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars_list->PictureType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars_list->PictureType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars_list->PictureWidth->Visible) { // PictureWidth ?>
	<?php if ($cars_list->SortUrl($cars_list->PictureWidth) == "") { ?>
		<th data-name="PictureWidth" class="<?php echo $cars_list->PictureWidth->headerCellClass() ?>"><div id="elh_cars_PictureWidth" class="cars_PictureWidth"><div class="ew-table-header-caption"><?php echo $cars_list->PictureWidth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PictureWidth" class="<?php echo $cars_list->PictureWidth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars_list->SortUrl($cars_list->PictureWidth) ?>', 1);"><div id="elh_cars_PictureWidth" class="cars_PictureWidth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars_list->PictureWidth->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars_list->PictureWidth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars_list->PictureWidth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars_list->PictureHeight->Visible) { // PictureHeight ?>
	<?php if ($cars_list->SortUrl($cars_list->PictureHeight) == "") { ?>
		<th data-name="PictureHeight" class="<?php echo $cars_list->PictureHeight->headerCellClass() ?>"><div id="elh_cars_PictureHeight" class="cars_PictureHeight"><div class="ew-table-header-caption"><?php echo $cars_list->PictureHeight->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PictureHeight" class="<?php echo $cars_list->PictureHeight->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars_list->SortUrl($cars_list->PictureHeight) ?>', 1);"><div id="elh_cars_PictureHeight" class="cars_PictureHeight">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars_list->PictureHeight->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars_list->PictureHeight->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars_list->PictureHeight->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars_list->Color->Visible) { // Color ?>
	<?php if ($cars_list->SortUrl($cars_list->Color) == "") { ?>
		<th data-name="Color" class="<?php echo $cars_list->Color->headerCellClass() ?>"><div id="elh_cars_Color" class="cars_Color"><div class="ew-table-header-caption"><?php echo $cars_list->Color->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Color" class="<?php echo $cars_list->Color->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars_list->SortUrl($cars_list->Color) ?>', 1);"><div id="elh_cars_Color" class="cars_Color">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars_list->Color->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars_list->Color->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars_list->Color->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cars_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cars_list->ExportAll && $cars_list->isExport()) {
	$cars_list->StopRecord = $cars_list->TotalRecords;
} else {

	// Set the last record to display
	if ($cars_list->TotalRecords > $cars_list->StartRecord + $cars_list->DisplayRecords - 1)
		$cars_list->StopRecord = $cars_list->StartRecord + $cars_list->DisplayRecords - 1;
	else
		$cars_list->StopRecord = $cars_list->TotalRecords;
}
$cars_list->RecordCount = $cars_list->StartRecord - 1;
if ($cars_list->Recordset && !$cars_list->Recordset->EOF) {
	$cars_list->Recordset->moveFirst();
	$selectLimit = $cars_list->UseSelectLimit;
	if (!$selectLimit && $cars_list->StartRecord > 1)
		$cars_list->Recordset->move($cars_list->StartRecord - 1);
} elseif (!$cars->AllowAddDeleteRow && $cars_list->StopRecord == 0) {
	$cars_list->StopRecord = $cars->GridAddRowCount;
}

// Initialize aggregate
$cars->RowType = ROWTYPE_AGGREGATEINIT;
$cars->resetAttributes();
$cars_list->renderRow();
while ($cars_list->RecordCount < $cars_list->StopRecord) {
	$cars_list->RecordCount++;
	if ($cars_list->RecordCount >= $cars_list->StartRecord) {
		$cars_list->RowCount++;

		// Set up key count
		$cars_list->KeyCount = $cars_list->RowIndex;

		// Init row class and style
		$cars->resetAttributes();
		$cars->CssClass = "";
		if ($cars_list->isGridAdd()) {
		} else {
			$cars_list->loadRowValues($cars_list->Recordset); // Load row values
		}
		$cars->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cars->RowAttrs->merge(["data-rowindex" => $cars_list->RowCount, "id" => "r" . $cars_list->RowCount . "_cars", "data-rowtype" => $cars->RowType]);

		// Render row
		$cars_list->renderRow();

		// Render list options
		$cars_list->renderListOptions();
?>
	<tr <?php echo $cars->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cars_list->ListOptions->render("body", "left", $cars_list->RowCount);
?>
	<?php if ($cars_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $cars_list->ID->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCount ?>_cars_ID">
<span<?php echo $cars_list->ID->viewAttributes() ?>><?php echo $cars_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars_list->Trademark->Visible) { // Trademark ?>
		<td data-name="Trademark" <?php echo $cars_list->Trademark->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCount ?>_cars_Trademark">
<span<?php echo $cars_list->Trademark->viewAttributes() ?>><?php echo $cars_list->Trademark->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars_list->Model->Visible) { // Model ?>
		<td data-name="Model" <?php echo $cars_list->Model->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCount ?>_cars_Model">
<span<?php echo $cars_list->Model->viewAttributes() ?>><?php echo $cars_list->Model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars_list->HP->Visible) { // HP ?>
		<td data-name="HP" <?php echo $cars_list->HP->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCount ?>_cars_HP">
<span<?php echo $cars_list->HP->viewAttributes() ?>><?php echo $cars_list->HP->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars_list->Liter->Visible) { // Liter ?>
		<td data-name="Liter" <?php echo $cars_list->Liter->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCount ?>_cars_Liter">
<span<?php echo $cars_list->Liter->viewAttributes() ?>><?php echo $cars_list->Liter->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars_list->Cyl->Visible) { // Cyl ?>
		<td data-name="Cyl" <?php echo $cars_list->Cyl->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCount ?>_cars_Cyl">
<span<?php echo $cars_list->Cyl->viewAttributes() ?>><?php echo $cars_list->Cyl->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars_list->TransmissSpeedCount->Visible) { // TransmissSpeedCount ?>
		<td data-name="TransmissSpeedCount" <?php echo $cars_list->TransmissSpeedCount->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCount ?>_cars_TransmissSpeedCount">
<span<?php echo $cars_list->TransmissSpeedCount->viewAttributes() ?>><?php echo $cars_list->TransmissSpeedCount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars_list->TransmissAutomatic->Visible) { // TransmissAutomatic ?>
		<td data-name="TransmissAutomatic" <?php echo $cars_list->TransmissAutomatic->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCount ?>_cars_TransmissAutomatic">
<span<?php echo $cars_list->TransmissAutomatic->viewAttributes() ?>><?php echo $cars_list->TransmissAutomatic->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars_list->MPG_City->Visible) { // MPG_City ?>
		<td data-name="MPG_City" <?php echo $cars_list->MPG_City->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCount ?>_cars_MPG_City">
<span<?php echo $cars_list->MPG_City->viewAttributes() ?>><?php echo $cars_list->MPG_City->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars_list->MPG_Highway->Visible) { // MPG_Highway ?>
		<td data-name="MPG_Highway" <?php echo $cars_list->MPG_Highway->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCount ?>_cars_MPG_Highway">
<span<?php echo $cars_list->MPG_Highway->viewAttributes() ?>><?php echo $cars_list->MPG_Highway->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars_list->Category->Visible) { // Category ?>
		<td data-name="Category" <?php echo $cars_list->Category->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCount ?>_cars_Category">
<span<?php echo $cars_list->Category->viewAttributes() ?>><?php echo $cars_list->Category->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars_list->Hyperlink->Visible) { // Hyperlink ?>
		<td data-name="Hyperlink" <?php echo $cars_list->Hyperlink->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCount ?>_cars_Hyperlink">
<span<?php echo $cars_list->Hyperlink->viewAttributes() ?>><?php echo $cars_list->Hyperlink->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars_list->Price->Visible) { // Price ?>
		<td data-name="Price" <?php echo $cars_list->Price->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCount ?>_cars_Price">
<span<?php echo $cars_list->Price->viewAttributes() ?>><?php echo $cars_list->Price->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars_list->PictureName->Visible) { // PictureName ?>
		<td data-name="PictureName" <?php echo $cars_list->PictureName->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCount ?>_cars_PictureName">
<span<?php echo $cars_list->PictureName->viewAttributes() ?>><?php echo $cars_list->PictureName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars_list->PictureSize->Visible) { // PictureSize ?>
		<td data-name="PictureSize" <?php echo $cars_list->PictureSize->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCount ?>_cars_PictureSize">
<span<?php echo $cars_list->PictureSize->viewAttributes() ?>><?php echo $cars_list->PictureSize->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars_list->PictureType->Visible) { // PictureType ?>
		<td data-name="PictureType" <?php echo $cars_list->PictureType->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCount ?>_cars_PictureType">
<span<?php echo $cars_list->PictureType->viewAttributes() ?>><?php echo $cars_list->PictureType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars_list->PictureWidth->Visible) { // PictureWidth ?>
		<td data-name="PictureWidth" <?php echo $cars_list->PictureWidth->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCount ?>_cars_PictureWidth">
<span<?php echo $cars_list->PictureWidth->viewAttributes() ?>><?php echo $cars_list->PictureWidth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars_list->PictureHeight->Visible) { // PictureHeight ?>
		<td data-name="PictureHeight" <?php echo $cars_list->PictureHeight->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCount ?>_cars_PictureHeight">
<span<?php echo $cars_list->PictureHeight->viewAttributes() ?>><?php echo $cars_list->PictureHeight->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars_list->Color->Visible) { // Color ?>
		<td data-name="Color" <?php echo $cars_list->Color->cellAttributes() ?>>
<span id="el<?php echo $cars_list->RowCount ?>_cars_Color">
<span<?php echo $cars_list->Color->viewAttributes() ?>><?php echo $cars_list->Color->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cars_list->ListOptions->render("body", "right", $cars_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$cars_list->isGridAdd())
		$cars_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$cars->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cars_list->Recordset)
	$cars_list->Recordset->Close();
?>
<?php if (!$cars_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cars_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cars_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cars_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cars_list->TotalRecords == 0 && !$cars->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cars_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cars_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cars_list->isExport()) { ?>
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
$cars_list->terminate();
?>