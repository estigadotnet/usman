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
$categories_edit = new categories_edit();

// Run the page
$categories_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categories_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcategoriesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcategoriesedit = currentForm = new ew.Form("fcategoriesedit", "edit");

	// Validate form
	fcategoriesedit.validate = function() {
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
			<?php if ($categories_edit->CategoryID->Required) { ?>
				elm = this.getElements("x" + infix + "_CategoryID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categories_edit->CategoryID->caption(), $categories_edit->CategoryID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($categories_edit->CategoryName->Required) { ?>
				elm = this.getElements("x" + infix + "_CategoryName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categories_edit->CategoryName->caption(), $categories_edit->CategoryName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($categories_edit->Description->Required) { ?>
				elm = this.getElements("x" + infix + "_Description");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categories_edit->Description->caption(), $categories_edit->Description->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($categories_edit->Picture->Required) { ?>
				felm = this.getElements("x" + infix + "_Picture");
				elm = this.getElements("fn_x" + infix + "_Picture");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $categories_edit->Picture->caption(), $categories_edit->Picture->RequiredErrorMessage)) ?>");
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
	fcategoriesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcategoriesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcategoriesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $categories_edit->showPageHeader(); ?>
<?php
$categories_edit->showMessage();
?>
<form name="fcategoriesedit" id="fcategoriesedit" class="<?php echo $categories_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categories">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$categories_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($categories_edit->CategoryID->Visible) { // CategoryID ?>
	<div id="r_CategoryID" class="form-group row">
		<label id="elh_categories_CategoryID" class="<?php echo $categories_edit->LeftColumnClass ?>"><?php echo $categories_edit->CategoryID->caption() ?><?php echo $categories_edit->CategoryID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categories_edit->RightColumnClass ?>"><div <?php echo $categories_edit->CategoryID->cellAttributes() ?>>
<span id="el_categories_CategoryID">
<span<?php echo $categories_edit->CategoryID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($categories_edit->CategoryID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="categories" data-field="x_CategoryID" name="x_CategoryID" id="x_CategoryID" value="<?php echo HtmlEncode($categories_edit->CategoryID->CurrentValue) ?>">
<?php echo $categories_edit->CategoryID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($categories_edit->CategoryName->Visible) { // CategoryName ?>
	<div id="r_CategoryName" class="form-group row">
		<label id="elh_categories_CategoryName" for="x_CategoryName" class="<?php echo $categories_edit->LeftColumnClass ?>"><?php echo $categories_edit->CategoryName->caption() ?><?php echo $categories_edit->CategoryName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categories_edit->RightColumnClass ?>"><div <?php echo $categories_edit->CategoryName->cellAttributes() ?>>
<span id="el_categories_CategoryName">
<input type="text" data-table="categories" data-field="x_CategoryName" name="x_CategoryName" id="x_CategoryName" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($categories_edit->CategoryName->getPlaceHolder()) ?>" value="<?php echo $categories_edit->CategoryName->EditValue ?>"<?php echo $categories_edit->CategoryName->editAttributes() ?>>
</span>
<?php echo $categories_edit->CategoryName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($categories_edit->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_categories_Description" for="x_Description" class="<?php echo $categories_edit->LeftColumnClass ?>"><?php echo $categories_edit->Description->caption() ?><?php echo $categories_edit->Description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categories_edit->RightColumnClass ?>"><div <?php echo $categories_edit->Description->cellAttributes() ?>>
<span id="el_categories_Description">
<textarea data-table="categories" data-field="x_Description" name="x_Description" id="x_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($categories_edit->Description->getPlaceHolder()) ?>"<?php echo $categories_edit->Description->editAttributes() ?>><?php echo $categories_edit->Description->EditValue ?></textarea>
</span>
<?php echo $categories_edit->Description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($categories_edit->Picture->Visible) { // Picture ?>
	<div id="r_Picture" class="form-group row">
		<label id="elh_categories_Picture" class="<?php echo $categories_edit->LeftColumnClass ?>"><?php echo $categories_edit->Picture->caption() ?><?php echo $categories_edit->Picture->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categories_edit->RightColumnClass ?>"><div <?php echo $categories_edit->Picture->cellAttributes() ?>>
<span id="el_categories_Picture">
<div id="fd_x_Picture">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $categories_edit->Picture->title() ?>" data-table="categories" data-field="x_Picture" name="x_Picture" id="x_Picture" lang="<?php echo CurrentLanguageID() ?>"<?php echo $categories_edit->Picture->editAttributes() ?><?php if ($categories_edit->Picture->ReadOnly || $categories_edit->Picture->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Picture"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Picture" id= "fn_x_Picture" value="<?php echo $categories_edit->Picture->Upload->FileName ?>">
<input type="hidden" name="fa_x_Picture" id= "fa_x_Picture" value="<?php echo (Post("fa_x_Picture") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_Picture" id= "fs_x_Picture" value="0">
<input type="hidden" name="fx_x_Picture" id= "fx_x_Picture" value="<?php echo $categories_edit->Picture->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Picture" id= "fm_x_Picture" value="<?php echo $categories_edit->Picture->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Picture" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $categories_edit->Picture->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$categories_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $categories_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $categories_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$categories_edit->showPageFooter();
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
$categories_edit->terminate();
?>