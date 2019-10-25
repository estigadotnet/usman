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
$shippers_edit = new shippers_edit();

// Run the page
$shippers_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$shippers_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fshippersedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fshippersedit = currentForm = new ew.Form("fshippersedit", "edit");

	// Validate form
	fshippersedit.validate = function() {
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
			<?php if ($shippers_edit->ShipperID->Required) { ?>
				elm = this.getElements("x" + infix + "_ShipperID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $shippers_edit->ShipperID->caption(), $shippers_edit->ShipperID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($shippers_edit->CompanyName->Required) { ?>
				elm = this.getElements("x" + infix + "_CompanyName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $shippers_edit->CompanyName->caption(), $shippers_edit->CompanyName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($shippers_edit->Phone->Required) { ?>
				elm = this.getElements("x" + infix + "_Phone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $shippers_edit->Phone->caption(), $shippers_edit->Phone->RequiredErrorMessage)) ?>");
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
	fshippersedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fshippersedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fshippersedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $shippers_edit->showPageHeader(); ?>
<?php
$shippers_edit->showMessage();
?>
<form name="fshippersedit" id="fshippersedit" class="<?php echo $shippers_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="shippers">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$shippers_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($shippers_edit->ShipperID->Visible) { // ShipperID ?>
	<div id="r_ShipperID" class="form-group row">
		<label id="elh_shippers_ShipperID" class="<?php echo $shippers_edit->LeftColumnClass ?>"><?php echo $shippers_edit->ShipperID->caption() ?><?php echo $shippers_edit->ShipperID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $shippers_edit->RightColumnClass ?>"><div <?php echo $shippers_edit->ShipperID->cellAttributes() ?>>
<span id="el_shippers_ShipperID">
<span<?php echo $shippers_edit->ShipperID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($shippers_edit->ShipperID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="shippers" data-field="x_ShipperID" name="x_ShipperID" id="x_ShipperID" value="<?php echo HtmlEncode($shippers_edit->ShipperID->CurrentValue) ?>">
<?php echo $shippers_edit->ShipperID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($shippers_edit->CompanyName->Visible) { // CompanyName ?>
	<div id="r_CompanyName" class="form-group row">
		<label id="elh_shippers_CompanyName" for="x_CompanyName" class="<?php echo $shippers_edit->LeftColumnClass ?>"><?php echo $shippers_edit->CompanyName->caption() ?><?php echo $shippers_edit->CompanyName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $shippers_edit->RightColumnClass ?>"><div <?php echo $shippers_edit->CompanyName->cellAttributes() ?>>
<span id="el_shippers_CompanyName">
<input type="text" data-table="shippers" data-field="x_CompanyName" name="x_CompanyName" id="x_CompanyName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($shippers_edit->CompanyName->getPlaceHolder()) ?>" value="<?php echo $shippers_edit->CompanyName->EditValue ?>"<?php echo $shippers_edit->CompanyName->editAttributes() ?>>
</span>
<?php echo $shippers_edit->CompanyName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($shippers_edit->Phone->Visible) { // Phone ?>
	<div id="r_Phone" class="form-group row">
		<label id="elh_shippers_Phone" for="x_Phone" class="<?php echo $shippers_edit->LeftColumnClass ?>"><?php echo $shippers_edit->Phone->caption() ?><?php echo $shippers_edit->Phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $shippers_edit->RightColumnClass ?>"><div <?php echo $shippers_edit->Phone->cellAttributes() ?>>
<span id="el_shippers_Phone">
<input type="text" data-table="shippers" data-field="x_Phone" name="x_Phone" id="x_Phone" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($shippers_edit->Phone->getPlaceHolder()) ?>" value="<?php echo $shippers_edit->Phone->EditValue ?>"<?php echo $shippers_edit->Phone->editAttributes() ?>>
</span>
<?php echo $shippers_edit->Phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$shippers_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $shippers_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $shippers_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$shippers_edit->showPageFooter();
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
$shippers_edit->terminate();
?>