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
$models_edit = new models_edit();

// Run the page
$models_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$models_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmodelsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fmodelsedit = currentForm = new ew.Form("fmodelsedit", "edit");

	// Validate form
	fmodelsedit.validate = function() {
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
			<?php if ($models_edit->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $models_edit->ID->caption(), $models_edit->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($models_edit->Trademark->Required) { ?>
				elm = this.getElements("x" + infix + "_Trademark");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $models_edit->Trademark->caption(), $models_edit->Trademark->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Trademark");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($models_edit->Trademark->errorMessage()) ?>");
			<?php if ($models_edit->Model->Required) { ?>
				elm = this.getElements("x" + infix + "_Model");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $models_edit->Model->caption(), $models_edit->Model->RequiredErrorMessage)) ?>");
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
	fmodelsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmodelsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fmodelsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $models_edit->showPageHeader(); ?>
<?php
$models_edit->showMessage();
?>
<form name="fmodelsedit" id="fmodelsedit" class="<?php echo $models_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="models">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$models_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($models_edit->ID->Visible) { // ID ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_models_ID" class="<?php echo $models_edit->LeftColumnClass ?>"><?php echo $models_edit->ID->caption() ?><?php echo $models_edit->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $models_edit->RightColumnClass ?>"><div <?php echo $models_edit->ID->cellAttributes() ?>>
<span id="el_models_ID">
<span<?php echo $models_edit->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($models_edit->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="models" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($models_edit->ID->CurrentValue) ?>">
<?php echo $models_edit->ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($models_edit->Trademark->Visible) { // Trademark ?>
	<div id="r_Trademark" class="form-group row">
		<label id="elh_models_Trademark" for="x_Trademark" class="<?php echo $models_edit->LeftColumnClass ?>"><?php echo $models_edit->Trademark->caption() ?><?php echo $models_edit->Trademark->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $models_edit->RightColumnClass ?>"><div <?php echo $models_edit->Trademark->cellAttributes() ?>>
<span id="el_models_Trademark">
<input type="text" data-table="models" data-field="x_Trademark" name="x_Trademark" id="x_Trademark" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($models_edit->Trademark->getPlaceHolder()) ?>" value="<?php echo $models_edit->Trademark->EditValue ?>"<?php echo $models_edit->Trademark->editAttributes() ?>>
</span>
<?php echo $models_edit->Trademark->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($models_edit->Model->Visible) { // Model ?>
	<div id="r_Model" class="form-group row">
		<label id="elh_models_Model" for="x_Model" class="<?php echo $models_edit->LeftColumnClass ?>"><?php echo $models_edit->Model->caption() ?><?php echo $models_edit->Model->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $models_edit->RightColumnClass ?>"><div <?php echo $models_edit->Model->cellAttributes() ?>>
<span id="el_models_Model">
<input type="text" data-table="models" data-field="x_Model" name="x_Model" id="x_Model" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($models_edit->Model->getPlaceHolder()) ?>" value="<?php echo $models_edit->Model->EditValue ?>"<?php echo $models_edit->Model->editAttributes() ?>>
</span>
<?php echo $models_edit->Model->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$models_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $models_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $models_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$models_edit->showPageFooter();
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
$models_edit->terminate();
?>