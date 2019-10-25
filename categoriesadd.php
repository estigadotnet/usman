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
$categories_add = new categories_add();

// Run the page
$categories_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categories_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcategoriesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcategoriesadd = currentForm = new ew.Form("fcategoriesadd", "add");

	// Validate form
	fcategoriesadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "F")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($categories_add->CategoryName->Required) { ?>
				elm = this.getElements("x" + infix + "_CategoryName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categories_add->CategoryName->caption(), $categories_add->CategoryName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($categories_add->Description->Required) { ?>
				elm = this.getElements("x" + infix + "_Description");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categories_add->Description->caption(), $categories_add->Description->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($categories_add->Picture->Required) { ?>
				felm = this.getElements("x" + infix + "_Picture");
				elm = this.getElements("fn_x" + infix + "_Picture");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $categories_add->Picture->caption(), $categories_add->Picture->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fcategoriesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcategoriesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcategoriesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $categories_add->showPageHeader(); ?>
<?php
$categories_add->showMessage();
?>
<form name="fcategoriesadd" id="fcategoriesadd" class="<?php echo $categories_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categories">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$categories_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($categories_add->CategoryName->Visible) { // CategoryName ?>
	<div id="r_CategoryName" class="form-group row">
		<label id="elh_categories_CategoryName" for="x_CategoryName" class="<?php echo $categories_add->LeftColumnClass ?>"><?php echo $categories_add->CategoryName->caption() ?><?php echo $categories_add->CategoryName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categories_add->RightColumnClass ?>"><div <?php echo $categories_add->CategoryName->cellAttributes() ?>>
<span id="el_categories_CategoryName">
<input type="text" data-table="categories" data-field="x_CategoryName" name="x_CategoryName" id="x_CategoryName" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($categories_add->CategoryName->getPlaceHolder()) ?>" value="<?php echo $categories_add->CategoryName->EditValue ?>"<?php echo $categories_add->CategoryName->editAttributes() ?>>
</span>
<?php echo $categories_add->CategoryName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($categories_add->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_categories_Description" for="x_Description" class="<?php echo $categories_add->LeftColumnClass ?>"><?php echo $categories_add->Description->caption() ?><?php echo $categories_add->Description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categories_add->RightColumnClass ?>"><div <?php echo $categories_add->Description->cellAttributes() ?>>
<span id="el_categories_Description">
<textarea data-table="categories" data-field="x_Description" name="x_Description" id="x_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($categories_add->Description->getPlaceHolder()) ?>"<?php echo $categories_add->Description->editAttributes() ?>><?php echo $categories_add->Description->EditValue ?></textarea>
</span>
<?php echo $categories_add->Description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($categories_add->Picture->Visible) { // Picture ?>
	<div id="r_Picture" class="form-group row">
		<label id="elh_categories_Picture" class="<?php echo $categories_add->LeftColumnClass ?>"><?php echo $categories_add->Picture->caption() ?><?php echo $categories_add->Picture->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categories_add->RightColumnClass ?>"><div <?php echo $categories_add->Picture->cellAttributes() ?>>
<span id="el_categories_Picture">
<div id="fd_x_Picture">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $categories_add->Picture->title() ?>" data-table="categories" data-field="x_Picture" name="x_Picture" id="x_Picture" lang="<?php echo CurrentLanguageID() ?>"<?php echo $categories_add->Picture->editAttributes() ?><?php if ($categories_add->Picture->ReadOnly || $categories_add->Picture->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Picture"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Picture" id= "fn_x_Picture" value="<?php echo $categories_add->Picture->Upload->FileName ?>">
<input type="hidden" name="fa_x_Picture" id= "fa_x_Picture" value="0">
<input type="hidden" name="fs_x_Picture" id= "fs_x_Picture" value="0">
<input type="hidden" name="fx_x_Picture" id= "fx_x_Picture" value="<?php echo $categories_add->Picture->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Picture" id= "fm_x_Picture" value="<?php echo $categories_add->Picture->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Picture" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $categories_add->Picture->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$categories_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $categories_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $categories_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$categories_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$categories_add->terminate();
?>