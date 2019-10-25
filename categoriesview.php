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
$categories_view = new categories_view();

// Run the page
$categories_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categories_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$categories_view->isExport()) { ?>
<script>
var fcategoriesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcategoriesview = currentForm = new ew.Form("fcategoriesview", "view");
	loadjs.done("fcategoriesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$categories_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $categories_view->ExportOptions->render("body") ?>
<?php $categories_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $categories_view->showPageHeader(); ?>
<?php
$categories_view->showMessage();
?>
<form name="fcategoriesview" id="fcategoriesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categories">
<input type="hidden" name="modal" value="<?php echo (int)$categories_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($categories_view->CategoryID->Visible) { // CategoryID ?>
	<tr id="r_CategoryID">
		<td class="<?php echo $categories_view->TableLeftColumnClass ?>"><span id="elh_categories_CategoryID"><?php echo $categories_view->CategoryID->caption() ?></span></td>
		<td data-name="CategoryID" <?php echo $categories_view->CategoryID->cellAttributes() ?>>
<span id="el_categories_CategoryID">
<span<?php echo $categories_view->CategoryID->viewAttributes() ?>><?php echo $categories_view->CategoryID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($categories_view->CategoryName->Visible) { // CategoryName ?>
	<tr id="r_CategoryName">
		<td class="<?php echo $categories_view->TableLeftColumnClass ?>"><span id="elh_categories_CategoryName"><?php echo $categories_view->CategoryName->caption() ?></span></td>
		<td data-name="CategoryName" <?php echo $categories_view->CategoryName->cellAttributes() ?>>
<span id="el_categories_CategoryName">
<span<?php echo $categories_view->CategoryName->viewAttributes() ?>><?php echo $categories_view->CategoryName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($categories_view->Description->Visible) { // Description ?>
	<tr id="r_Description">
		<td class="<?php echo $categories_view->TableLeftColumnClass ?>"><span id="elh_categories_Description"><?php echo $categories_view->Description->caption() ?></span></td>
		<td data-name="Description" <?php echo $categories_view->Description->cellAttributes() ?>>
<span id="el_categories_Description">
<span<?php echo $categories_view->Description->viewAttributes() ?>><?php echo $categories_view->Description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($categories_view->Picture->Visible) { // Picture ?>
	<tr id="r_Picture">
		<td class="<?php echo $categories_view->TableLeftColumnClass ?>"><span id="elh_categories_Picture"><?php echo $categories_view->Picture->caption() ?></span></td>
		<td data-name="Picture" <?php echo $categories_view->Picture->cellAttributes() ?>>
<span id="el_categories_Picture">
<span<?php echo $categories_view->Picture->viewAttributes() ?>><?php echo GetFileViewTag($categories_view->Picture, $categories_view->Picture->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$categories_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$categories_view->isExport()) { ?>
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
$categories_view->terminate();
?>