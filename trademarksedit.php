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
$trademarks_edit = new trademarks_edit();

// Run the page
$trademarks_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trademarks_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftrademarksedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftrademarksedit = currentForm = new ew.Form("ftrademarksedit", "edit");

	// Validate form
	ftrademarksedit.validate = function() {
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
			<?php if ($trademarks_edit->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trademarks_edit->ID->caption(), $trademarks_edit->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($trademarks_edit->Trademark->Required) { ?>
				elm = this.getElements("x" + infix + "_Trademark");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trademarks_edit->Trademark->caption(), $trademarks_edit->Trademark->RequiredErrorMessage)) ?>");
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
	ftrademarksedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftrademarksedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftrademarksedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $trademarks_edit->showPageHeader(); ?>
<?php
$trademarks_edit->showMessage();
?>
<form name="ftrademarksedit" id="ftrademarksedit" class="<?php echo $trademarks_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trademarks">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$trademarks_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($trademarks_edit->ID->Visible) { // ID ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_trademarks_ID" class="<?php echo $trademarks_edit->LeftColumnClass ?>"><?php echo $trademarks_edit->ID->caption() ?><?php echo $trademarks_edit->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trademarks_edit->RightColumnClass ?>"><div <?php echo $trademarks_edit->ID->cellAttributes() ?>>
<span id="el_trademarks_ID">
<span<?php echo $trademarks_edit->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($trademarks_edit->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="trademarks" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($trademarks_edit->ID->CurrentValue) ?>">
<?php echo $trademarks_edit->ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trademarks_edit->Trademark->Visible) { // Trademark ?>
	<div id="r_Trademark" class="form-group row">
		<label id="elh_trademarks_Trademark" for="x_Trademark" class="<?php echo $trademarks_edit->LeftColumnClass ?>"><?php echo $trademarks_edit->Trademark->caption() ?><?php echo $trademarks_edit->Trademark->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trademarks_edit->RightColumnClass ?>"><div <?php echo $trademarks_edit->Trademark->cellAttributes() ?>>
<span id="el_trademarks_Trademark">
<input type="text" data-table="trademarks" data-field="x_Trademark" name="x_Trademark" id="x_Trademark" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($trademarks_edit->Trademark->getPlaceHolder()) ?>" value="<?php echo $trademarks_edit->Trademark->EditValue ?>"<?php echo $trademarks_edit->Trademark->editAttributes() ?>>
</span>
<?php echo $trademarks_edit->Trademark->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$trademarks_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $trademarks_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $trademarks_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$trademarks_edit->showPageFooter();
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
$trademarks_edit->terminate();
?>