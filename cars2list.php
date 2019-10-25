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
$cars2_list = new cars2_list();

// Run the page
$cars2_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cars2_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cars2_list->isExport()) { ?>
<script>
var fcars2list, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcars2list = currentForm = new ew.Form("fcars2list", "list");
	fcars2list.formKeyCountName = '<?php echo $cars2_list->FormKeyCountName ?>';
	loadjs.done("fcars2list");
});
var fcars2listsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcars2listsrch = currentSearchForm = new ew.Form("fcars2listsrch");

	// Dynamic selection lists
	// Filters

	fcars2listsrch.filterList = <?php echo $cars2_list->getFilterList() ?>;
	loadjs.done("fcars2listsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cars2_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cars2_list->TotalRecords > 0 && $cars2_list->ExportOptions->visible()) { ?>
<?php $cars2_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cars2_list->ImportOptions->visible()) { ?>
<?php $cars2_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($cars2_list->SearchOptions->visible()) { ?>
<?php $cars2_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($cars2_list->FilterOptions->visible()) { ?>
<?php $cars2_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cars2_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$cars2_list->isExport() && !$cars2->CurrentAction) { ?>
<form name="fcars2listsrch" id="fcars2listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcars2listsrch-search-panel" class="<?php echo $cars2_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cars2">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $cars2_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($cars2_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($cars2_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $cars2_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($cars2_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($cars2_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($cars2_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($cars2_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $cars2_list->showPageHeader(); ?>
<?php
$cars2_list->showMessage();
?>
<?php if ($cars2_list->TotalRecords > 0 || $cars2->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cars2_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cars2">
<form name="fcars2list" id="fcars2list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cars2">
<div id="gmp_cars2" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($cars2_list->TotalRecords > 0 || $cars2_list->isGridEdit()) { ?>
<table id="tbl_cars2list" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cars2->RowType = ROWTYPE_HEADER;

// Render list options
$cars2_list->renderListOptions();

// Render list options (header, left)
$cars2_list->ListOptions->render("header", "left");
?>
<?php if ($cars2_list->ID->Visible) { // ID ?>
	<?php if ($cars2_list->SortUrl($cars2_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $cars2_list->ID->headerCellClass() ?>"><div id="elh_cars2_ID" class="cars2_ID"><div class="ew-table-header-caption"><?php echo $cars2_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $cars2_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars2_list->SortUrl($cars2_list->ID) ?>', 1);"><div id="elh_cars2_ID" class="cars2_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars2_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2_list->Trademark->Visible) { // Trademark ?>
	<?php if ($cars2_list->SortUrl($cars2_list->Trademark) == "") { ?>
		<th data-name="Trademark" class="<?php echo $cars2_list->Trademark->headerCellClass() ?>"><div id="elh_cars2_Trademark" class="cars2_Trademark"><div class="ew-table-header-caption"><?php echo $cars2_list->Trademark->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Trademark" class="<?php echo $cars2_list->Trademark->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars2_list->SortUrl($cars2_list->Trademark) ?>', 1);"><div id="elh_cars2_Trademark" class="cars2_Trademark">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2_list->Trademark->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2_list->Trademark->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars2_list->Trademark->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2_list->Model->Visible) { // Model ?>
	<?php if ($cars2_list->SortUrl($cars2_list->Model) == "") { ?>
		<th data-name="Model" class="<?php echo $cars2_list->Model->headerCellClass() ?>"><div id="elh_cars2_Model" class="cars2_Model"><div class="ew-table-header-caption"><?php echo $cars2_list->Model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Model" class="<?php echo $cars2_list->Model->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars2_list->SortUrl($cars2_list->Model) ?>', 1);"><div id="elh_cars2_Model" class="cars2_Model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2_list->Model->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2_list->Model->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars2_list->Model->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2_list->HP->Visible) { // HP ?>
	<?php if ($cars2_list->SortUrl($cars2_list->HP) == "") { ?>
		<th data-name="HP" class="<?php echo $cars2_list->HP->headerCellClass() ?>"><div id="elh_cars2_HP" class="cars2_HP"><div class="ew-table-header-caption"><?php echo $cars2_list->HP->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HP" class="<?php echo $cars2_list->HP->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars2_list->SortUrl($cars2_list->HP) ?>', 1);"><div id="elh_cars2_HP" class="cars2_HP">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2_list->HP->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2_list->HP->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars2_list->HP->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2_list->Liter->Visible) { // Liter ?>
	<?php if ($cars2_list->SortUrl($cars2_list->Liter) == "") { ?>
		<th data-name="Liter" class="<?php echo $cars2_list->Liter->headerCellClass() ?>"><div id="elh_cars2_Liter" class="cars2_Liter"><div class="ew-table-header-caption"><?php echo $cars2_list->Liter->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Liter" class="<?php echo $cars2_list->Liter->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars2_list->SortUrl($cars2_list->Liter) ?>', 1);"><div id="elh_cars2_Liter" class="cars2_Liter">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2_list->Liter->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2_list->Liter->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars2_list->Liter->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2_list->Cyl->Visible) { // Cyl ?>
	<?php if ($cars2_list->SortUrl($cars2_list->Cyl) == "") { ?>
		<th data-name="Cyl" class="<?php echo $cars2_list->Cyl->headerCellClass() ?>"><div id="elh_cars2_Cyl" class="cars2_Cyl"><div class="ew-table-header-caption"><?php echo $cars2_list->Cyl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Cyl" class="<?php echo $cars2_list->Cyl->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars2_list->SortUrl($cars2_list->Cyl) ?>', 1);"><div id="elh_cars2_Cyl" class="cars2_Cyl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2_list->Cyl->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2_list->Cyl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars2_list->Cyl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2_list->TransmissSpeedCount->Visible) { // TransmissSpeedCount ?>
	<?php if ($cars2_list->SortUrl($cars2_list->TransmissSpeedCount) == "") { ?>
		<th data-name="TransmissSpeedCount" class="<?php echo $cars2_list->TransmissSpeedCount->headerCellClass() ?>"><div id="elh_cars2_TransmissSpeedCount" class="cars2_TransmissSpeedCount"><div class="ew-table-header-caption"><?php echo $cars2_list->TransmissSpeedCount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TransmissSpeedCount" class="<?php echo $cars2_list->TransmissSpeedCount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars2_list->SortUrl($cars2_list->TransmissSpeedCount) ?>', 1);"><div id="elh_cars2_TransmissSpeedCount" class="cars2_TransmissSpeedCount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2_list->TransmissSpeedCount->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2_list->TransmissSpeedCount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars2_list->TransmissSpeedCount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2_list->TransmissAutomatic->Visible) { // TransmissAutomatic ?>
	<?php if ($cars2_list->SortUrl($cars2_list->TransmissAutomatic) == "") { ?>
		<th data-name="TransmissAutomatic" class="<?php echo $cars2_list->TransmissAutomatic->headerCellClass() ?>"><div id="elh_cars2_TransmissAutomatic" class="cars2_TransmissAutomatic"><div class="ew-table-header-caption"><?php echo $cars2_list->TransmissAutomatic->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TransmissAutomatic" class="<?php echo $cars2_list->TransmissAutomatic->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars2_list->SortUrl($cars2_list->TransmissAutomatic) ?>', 1);"><div id="elh_cars2_TransmissAutomatic" class="cars2_TransmissAutomatic">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2_list->TransmissAutomatic->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars2_list->TransmissAutomatic->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars2_list->TransmissAutomatic->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2_list->MPG_City->Visible) { // MPG_City ?>
	<?php if ($cars2_list->SortUrl($cars2_list->MPG_City) == "") { ?>
		<th data-name="MPG_City" class="<?php echo $cars2_list->MPG_City->headerCellClass() ?>"><div id="elh_cars2_MPG_City" class="cars2_MPG_City"><div class="ew-table-header-caption"><?php echo $cars2_list->MPG_City->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MPG_City" class="<?php echo $cars2_list->MPG_City->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars2_list->SortUrl($cars2_list->MPG_City) ?>', 1);"><div id="elh_cars2_MPG_City" class="cars2_MPG_City">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2_list->MPG_City->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2_list->MPG_City->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars2_list->MPG_City->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2_list->MPG_Highway->Visible) { // MPG_Highway ?>
	<?php if ($cars2_list->SortUrl($cars2_list->MPG_Highway) == "") { ?>
		<th data-name="MPG_Highway" class="<?php echo $cars2_list->MPG_Highway->headerCellClass() ?>"><div id="elh_cars2_MPG_Highway" class="cars2_MPG_Highway"><div class="ew-table-header-caption"><?php echo $cars2_list->MPG_Highway->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MPG_Highway" class="<?php echo $cars2_list->MPG_Highway->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars2_list->SortUrl($cars2_list->MPG_Highway) ?>', 1);"><div id="elh_cars2_MPG_Highway" class="cars2_MPG_Highway">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2_list->MPG_Highway->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2_list->MPG_Highway->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars2_list->MPG_Highway->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2_list->Category->Visible) { // Category ?>
	<?php if ($cars2_list->SortUrl($cars2_list->Category) == "") { ?>
		<th data-name="Category" class="<?php echo $cars2_list->Category->headerCellClass() ?>"><div id="elh_cars2_Category" class="cars2_Category"><div class="ew-table-header-caption"><?php echo $cars2_list->Category->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Category" class="<?php echo $cars2_list->Category->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars2_list->SortUrl($cars2_list->Category) ?>', 1);"><div id="elh_cars2_Category" class="cars2_Category">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2_list->Category->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars2_list->Category->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars2_list->Category->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2_list->Hyperlink->Visible) { // Hyperlink ?>
	<?php if ($cars2_list->SortUrl($cars2_list->Hyperlink) == "") { ?>
		<th data-name="Hyperlink" class="<?php echo $cars2_list->Hyperlink->headerCellClass() ?>"><div id="elh_cars2_Hyperlink" class="cars2_Hyperlink"><div class="ew-table-header-caption"><?php echo $cars2_list->Hyperlink->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Hyperlink" class="<?php echo $cars2_list->Hyperlink->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars2_list->SortUrl($cars2_list->Hyperlink) ?>', 1);"><div id="elh_cars2_Hyperlink" class="cars2_Hyperlink">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2_list->Hyperlink->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars2_list->Hyperlink->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars2_list->Hyperlink->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2_list->Price->Visible) { // Price ?>
	<?php if ($cars2_list->SortUrl($cars2_list->Price) == "") { ?>
		<th data-name="Price" class="<?php echo $cars2_list->Price->headerCellClass() ?>"><div id="elh_cars2_Price" class="cars2_Price"><div class="ew-table-header-caption"><?php echo $cars2_list->Price->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Price" class="<?php echo $cars2_list->Price->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars2_list->SortUrl($cars2_list->Price) ?>', 1);"><div id="elh_cars2_Price" class="cars2_Price">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2_list->Price->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2_list->Price->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars2_list->Price->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2_list->PictureName->Visible) { // PictureName ?>
	<?php if ($cars2_list->SortUrl($cars2_list->PictureName) == "") { ?>
		<th data-name="PictureName" class="<?php echo $cars2_list->PictureName->headerCellClass() ?>"><div id="elh_cars2_PictureName" class="cars2_PictureName"><div class="ew-table-header-caption"><?php echo $cars2_list->PictureName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PictureName" class="<?php echo $cars2_list->PictureName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars2_list->SortUrl($cars2_list->PictureName) ?>', 1);"><div id="elh_cars2_PictureName" class="cars2_PictureName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2_list->PictureName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars2_list->PictureName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars2_list->PictureName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2_list->PictureSize->Visible) { // PictureSize ?>
	<?php if ($cars2_list->SortUrl($cars2_list->PictureSize) == "") { ?>
		<th data-name="PictureSize" class="<?php echo $cars2_list->PictureSize->headerCellClass() ?>"><div id="elh_cars2_PictureSize" class="cars2_PictureSize"><div class="ew-table-header-caption"><?php echo $cars2_list->PictureSize->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PictureSize" class="<?php echo $cars2_list->PictureSize->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars2_list->SortUrl($cars2_list->PictureSize) ?>', 1);"><div id="elh_cars2_PictureSize" class="cars2_PictureSize">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2_list->PictureSize->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2_list->PictureSize->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars2_list->PictureSize->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2_list->PictureType->Visible) { // PictureType ?>
	<?php if ($cars2_list->SortUrl($cars2_list->PictureType) == "") { ?>
		<th data-name="PictureType" class="<?php echo $cars2_list->PictureType->headerCellClass() ?>"><div id="elh_cars2_PictureType" class="cars2_PictureType"><div class="ew-table-header-caption"><?php echo $cars2_list->PictureType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PictureType" class="<?php echo $cars2_list->PictureType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars2_list->SortUrl($cars2_list->PictureType) ?>', 1);"><div id="elh_cars2_PictureType" class="cars2_PictureType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2_list->PictureType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cars2_list->PictureType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars2_list->PictureType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2_list->PictureWidth->Visible) { // PictureWidth ?>
	<?php if ($cars2_list->SortUrl($cars2_list->PictureWidth) == "") { ?>
		<th data-name="PictureWidth" class="<?php echo $cars2_list->PictureWidth->headerCellClass() ?>"><div id="elh_cars2_PictureWidth" class="cars2_PictureWidth"><div class="ew-table-header-caption"><?php echo $cars2_list->PictureWidth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PictureWidth" class="<?php echo $cars2_list->PictureWidth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars2_list->SortUrl($cars2_list->PictureWidth) ?>', 1);"><div id="elh_cars2_PictureWidth" class="cars2_PictureWidth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2_list->PictureWidth->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2_list->PictureWidth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars2_list->PictureWidth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cars2_list->PictureHeight->Visible) { // PictureHeight ?>
	<?php if ($cars2_list->SortUrl($cars2_list->PictureHeight) == "") { ?>
		<th data-name="PictureHeight" class="<?php echo $cars2_list->PictureHeight->headerCellClass() ?>"><div id="elh_cars2_PictureHeight" class="cars2_PictureHeight"><div class="ew-table-header-caption"><?php echo $cars2_list->PictureHeight->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PictureHeight" class="<?php echo $cars2_list->PictureHeight->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cars2_list->SortUrl($cars2_list->PictureHeight) ?>', 1);"><div id="elh_cars2_PictureHeight" class="cars2_PictureHeight">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cars2_list->PictureHeight->caption() ?></span><span class="ew-table-header-sort"><?php if ($cars2_list->PictureHeight->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cars2_list->PictureHeight->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cars2_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cars2_list->ExportAll && $cars2_list->isExport()) {
	$cars2_list->StopRecord = $cars2_list->TotalRecords;
} else {

	// Set the last record to display
	if ($cars2_list->TotalRecords > $cars2_list->StartRecord + $cars2_list->DisplayRecords - 1)
		$cars2_list->StopRecord = $cars2_list->StartRecord + $cars2_list->DisplayRecords - 1;
	else
		$cars2_list->StopRecord = $cars2_list->TotalRecords;
}
$cars2_list->RecordCount = $cars2_list->StartRecord - 1;
if ($cars2_list->Recordset && !$cars2_list->Recordset->EOF) {
	$cars2_list->Recordset->moveFirst();
	$selectLimit = $cars2_list->UseSelectLimit;
	if (!$selectLimit && $cars2_list->StartRecord > 1)
		$cars2_list->Recordset->move($cars2_list->StartRecord - 1);
} elseif (!$cars2->AllowAddDeleteRow && $cars2_list->StopRecord == 0) {
	$cars2_list->StopRecord = $cars2->GridAddRowCount;
}

// Initialize aggregate
$cars2->RowType = ROWTYPE_AGGREGATEINIT;
$cars2->resetAttributes();
$cars2_list->renderRow();
while ($cars2_list->RecordCount < $cars2_list->StopRecord) {
	$cars2_list->RecordCount++;
	if ($cars2_list->RecordCount >= $cars2_list->StartRecord) {
		$cars2_list->RowCount++;

		// Set up key count
		$cars2_list->KeyCount = $cars2_list->RowIndex;

		// Init row class and style
		$cars2->resetAttributes();
		$cars2->CssClass = "";
		if ($cars2_list->isGridAdd()) {
		} else {
			$cars2_list->loadRowValues($cars2_list->Recordset); // Load row values
		}
		$cars2->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cars2->RowAttrs->merge(["data-rowindex" => $cars2_list->RowCount, "id" => "r" . $cars2_list->RowCount . "_cars2", "data-rowtype" => $cars2->RowType]);

		// Render row
		$cars2_list->renderRow();

		// Render list options
		$cars2_list->renderListOptions();
?>
	<tr <?php echo $cars2->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cars2_list->ListOptions->render("body", "left", $cars2_list->RowCount);
?>
	<?php if ($cars2_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $cars2_list->ID->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCount ?>_cars2_ID">
<span<?php echo $cars2_list->ID->viewAttributes() ?>><?php echo $cars2_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2_list->Trademark->Visible) { // Trademark ?>
		<td data-name="Trademark" <?php echo $cars2_list->Trademark->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCount ?>_cars2_Trademark">
<span<?php echo $cars2_list->Trademark->viewAttributes() ?>><?php echo $cars2_list->Trademark->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2_list->Model->Visible) { // Model ?>
		<td data-name="Model" <?php echo $cars2_list->Model->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCount ?>_cars2_Model">
<span<?php echo $cars2_list->Model->viewAttributes() ?>><?php echo $cars2_list->Model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2_list->HP->Visible) { // HP ?>
		<td data-name="HP" <?php echo $cars2_list->HP->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCount ?>_cars2_HP">
<span<?php echo $cars2_list->HP->viewAttributes() ?>><?php echo $cars2_list->HP->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2_list->Liter->Visible) { // Liter ?>
		<td data-name="Liter" <?php echo $cars2_list->Liter->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCount ?>_cars2_Liter">
<span<?php echo $cars2_list->Liter->viewAttributes() ?>><?php echo $cars2_list->Liter->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2_list->Cyl->Visible) { // Cyl ?>
		<td data-name="Cyl" <?php echo $cars2_list->Cyl->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCount ?>_cars2_Cyl">
<span<?php echo $cars2_list->Cyl->viewAttributes() ?>><?php echo $cars2_list->Cyl->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2_list->TransmissSpeedCount->Visible) { // TransmissSpeedCount ?>
		<td data-name="TransmissSpeedCount" <?php echo $cars2_list->TransmissSpeedCount->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCount ?>_cars2_TransmissSpeedCount">
<span<?php echo $cars2_list->TransmissSpeedCount->viewAttributes() ?>><?php echo $cars2_list->TransmissSpeedCount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2_list->TransmissAutomatic->Visible) { // TransmissAutomatic ?>
		<td data-name="TransmissAutomatic" <?php echo $cars2_list->TransmissAutomatic->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCount ?>_cars2_TransmissAutomatic">
<span<?php echo $cars2_list->TransmissAutomatic->viewAttributes() ?>><?php echo $cars2_list->TransmissAutomatic->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2_list->MPG_City->Visible) { // MPG_City ?>
		<td data-name="MPG_City" <?php echo $cars2_list->MPG_City->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCount ?>_cars2_MPG_City">
<span<?php echo $cars2_list->MPG_City->viewAttributes() ?>><?php echo $cars2_list->MPG_City->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2_list->MPG_Highway->Visible) { // MPG_Highway ?>
		<td data-name="MPG_Highway" <?php echo $cars2_list->MPG_Highway->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCount ?>_cars2_MPG_Highway">
<span<?php echo $cars2_list->MPG_Highway->viewAttributes() ?>><?php echo $cars2_list->MPG_Highway->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2_list->Category->Visible) { // Category ?>
		<td data-name="Category" <?php echo $cars2_list->Category->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCount ?>_cars2_Category">
<span<?php echo $cars2_list->Category->viewAttributes() ?>><?php echo $cars2_list->Category->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2_list->Hyperlink->Visible) { // Hyperlink ?>
		<td data-name="Hyperlink" <?php echo $cars2_list->Hyperlink->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCount ?>_cars2_Hyperlink">
<span<?php echo $cars2_list->Hyperlink->viewAttributes() ?>><?php echo $cars2_list->Hyperlink->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2_list->Price->Visible) { // Price ?>
		<td data-name="Price" <?php echo $cars2_list->Price->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCount ?>_cars2_Price">
<span<?php echo $cars2_list->Price->viewAttributes() ?>><?php echo $cars2_list->Price->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2_list->PictureName->Visible) { // PictureName ?>
		<td data-name="PictureName" <?php echo $cars2_list->PictureName->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCount ?>_cars2_PictureName">
<span<?php echo $cars2_list->PictureName->viewAttributes() ?>><?php echo $cars2_list->PictureName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2_list->PictureSize->Visible) { // PictureSize ?>
		<td data-name="PictureSize" <?php echo $cars2_list->PictureSize->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCount ?>_cars2_PictureSize">
<span<?php echo $cars2_list->PictureSize->viewAttributes() ?>><?php echo $cars2_list->PictureSize->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2_list->PictureType->Visible) { // PictureType ?>
		<td data-name="PictureType" <?php echo $cars2_list->PictureType->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCount ?>_cars2_PictureType">
<span<?php echo $cars2_list->PictureType->viewAttributes() ?>><?php echo $cars2_list->PictureType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2_list->PictureWidth->Visible) { // PictureWidth ?>
		<td data-name="PictureWidth" <?php echo $cars2_list->PictureWidth->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCount ?>_cars2_PictureWidth">
<span<?php echo $cars2_list->PictureWidth->viewAttributes() ?>><?php echo $cars2_list->PictureWidth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cars2_list->PictureHeight->Visible) { // PictureHeight ?>
		<td data-name="PictureHeight" <?php echo $cars2_list->PictureHeight->cellAttributes() ?>>
<span id="el<?php echo $cars2_list->RowCount ?>_cars2_PictureHeight">
<span<?php echo $cars2_list->PictureHeight->viewAttributes() ?>><?php echo $cars2_list->PictureHeight->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cars2_list->ListOptions->render("body", "right", $cars2_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$cars2_list->isGridAdd())
		$cars2_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$cars2->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cars2_list->Recordset)
	$cars2_list->Recordset->Close();
?>
<?php if (!$cars2_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cars2_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cars2_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cars2_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cars2_list->TotalRecords == 0 && !$cars2->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cars2_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cars2_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cars2_list->isExport()) { ?>
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
$cars2_list->terminate();
?>