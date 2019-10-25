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
$models_add = new models_add();

// Run the page
$models_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$models_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmodelsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fmodelsadd = currentForm = new ew.Form("fmodelsadd", "add");

	// Validate form
	fmodelsadd.validate = function() {
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
			<?php if ($models_add->Trademark->Required) { ?>
				elm = this.getElements("x" + infix + "_Trademark");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $models_add->Trademark->caption(), $models_add->Trademark->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Trademark");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($models_add->Trademark->errorMessage()) ?>");
			<?php if ($models_add->Model->Required) { ?>
				elm = this.getElements("x" + infix + "_Model");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $models_add->Model->caption(), $models_add->Model->RequiredErrorMessage)) ?>");
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
	fmodelsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmodelsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fmodelsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $models_add->showPageHeader(); ?>
<?php
$models_add->showMessage();
?>
<form name="fmodelsadd" id="fmodelsadd" class="<?php echo $models_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="models">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$models_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($models_add->Trademark->Visible) { // Trademark ?>
	<div id="r_Trademark" class="form-group row">
		<label id="elh_models_Trademark" for="x_Trademark" class="<?php echo $models_add->LeftColumnClass ?>"><?php echo $models_add->Trademark->caption() ?><?php echo $models_add->Trademark->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $models_add->RightColumnClass ?>"><div <?php echo $models_add->Trademark->cellAttributes() ?>>
<span id="el_models_Trademark">
<input type="text" data-table="models" data-field="x_Trademark" name="x_Trademark" id="x_Trademark" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($models_add->Trademark->getPlaceHolder()) ?>" value="<?php echo $models_add->Trademark->EditValue ?>"<?php echo $models_add->Trademark->editAttributes() ?>>
</span>
<?php echo $models_add->Trademark->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($models_add->Model->Visible) { // Model ?>
	<div id="r_Model" class="form-group row">
		<label id="elh_models_Model" for="x_Model" class="<?php echo $models_add->LeftColumnClass ?>"><?php echo $models_add->Model->caption() ?><?php echo $models_add->Model->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $models_add->RightColumnClass ?>"><div <?php echo $models_add->Model->cellAttributes() ?>>
<span id="el_models_Model">
<input type="text" data-table="models" data-field="x_Model" name="x_Model" id="x_Model" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($models_add->Model->getPlaceHolder()) ?>" value="<?php echo $models_add->Model->EditValue ?>"<?php echo $models_add->Model->editAttributes() ?>>
</span>
<?php echo $models_add->Model->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$models_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $models_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $models_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$models_add->showPageFooter();
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
$models_add->terminate();
?>