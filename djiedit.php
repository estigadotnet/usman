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
$dji_edit = new dji_edit();

// Run the page
$dji_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dji_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdjiedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdjiedit = currentForm = new ew.Form("fdjiedit", "edit");

	// Validate form
	fdjiedit.validate = function() {
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
			<?php if ($dji_edit->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji_edit->ID->caption(), $dji_edit->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dji_edit->Date->Required) { ?>
				elm = this.getElements("x" + infix + "_Date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji_edit->Date->caption(), $dji_edit->Date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dji_edit->Date->errorMessage()) ?>");
			<?php if ($dji_edit->Open->Required) { ?>
				elm = this.getElements("x" + infix + "_Open");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji_edit->Open->caption(), $dji_edit->Open->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Open");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dji_edit->Open->errorMessage()) ?>");
			<?php if ($dji_edit->High->Required) { ?>
				elm = this.getElements("x" + infix + "_High");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji_edit->High->caption(), $dji_edit->High->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_High");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dji_edit->High->errorMessage()) ?>");
			<?php if ($dji_edit->Low->Required) { ?>
				elm = this.getElements("x" + infix + "_Low");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji_edit->Low->caption(), $dji_edit->Low->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Low");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dji_edit->Low->errorMessage()) ?>");
			<?php if ($dji_edit->Close->Required) { ?>
				elm = this.getElements("x" + infix + "_Close");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji_edit->Close->caption(), $dji_edit->Close->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Close");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dji_edit->Close->errorMessage()) ?>");
			<?php if ($dji_edit->Volume->Required) { ?>
				elm = this.getElements("x" + infix + "_Volume");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji_edit->Volume->caption(), $dji_edit->Volume->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Volume");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dji_edit->Volume->errorMessage()) ?>");
			<?php if ($dji_edit->Adj_Close->Required) { ?>
				elm = this.getElements("x" + infix + "_Adj_Close");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji_edit->Adj_Close->caption(), $dji_edit->Adj_Close->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Adj_Close");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dji_edit->Adj_Close->errorMessage()) ?>");
			<?php if ($dji_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji_edit->Name->caption(), $dji_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dji_edit->Name->errorMessage()) ?>");
			<?php if ($dji_edit->Name2->Required) { ?>
				elm = this.getElements("x" + infix + "_Name2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji_edit->Name2->caption(), $dji_edit->Name2->RequiredErrorMessage)) ?>");
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
	fdjiedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdjiedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fdjiedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $dji_edit->showPageHeader(); ?>
<?php
$dji_edit->showMessage();
?>
<form name="fdjiedit" id="fdjiedit" class="<?php echo $dji_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dji">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$dji_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($dji_edit->ID->Visible) { // ID ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_dji_ID" class="<?php echo $dji_edit->LeftColumnClass ?>"><?php echo $dji_edit->ID->caption() ?><?php echo $dji_edit->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_edit->RightColumnClass ?>"><div <?php echo $dji_edit->ID->cellAttributes() ?>>
<span id="el_dji_ID">
<span<?php echo $dji_edit->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dji_edit->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="dji" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($dji_edit->ID->CurrentValue) ?>">
<?php echo $dji_edit->ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dji_edit->Date->Visible) { // Date ?>
	<div id="r_Date" class="form-group row">
		<label id="elh_dji_Date" for="x_Date" class="<?php echo $dji_edit->LeftColumnClass ?>"><?php echo $dji_edit->Date->caption() ?><?php echo $dji_edit->Date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_edit->RightColumnClass ?>"><div <?php echo $dji_edit->Date->cellAttributes() ?>>
<span id="el_dji_Date">
<input type="text" data-table="dji" data-field="x_Date" name="x_Date" id="x_Date" maxlength="19" placeholder="<?php echo HtmlEncode($dji_edit->Date->getPlaceHolder()) ?>" value="<?php echo $dji_edit->Date->EditValue ?>"<?php echo $dji_edit->Date->editAttributes() ?>>
<?php if (!$dji_edit->Date->ReadOnly && !$dji_edit->Date->Disabled && !isset($dji_edit->Date->EditAttrs["readonly"]) && !isset($dji_edit->Date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdjiedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fdjiedit", "x_Date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $dji_edit->Date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dji_edit->Open->Visible) { // Open ?>
	<div id="r_Open" class="form-group row">
		<label id="elh_dji_Open" for="x_Open" class="<?php echo $dji_edit->LeftColumnClass ?>"><?php echo $dji_edit->Open->caption() ?><?php echo $dji_edit->Open->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_edit->RightColumnClass ?>"><div <?php echo $dji_edit->Open->cellAttributes() ?>>
<span id="el_dji_Open">
<input type="text" data-table="dji" data-field="x_Open" name="x_Open" id="x_Open" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($dji_edit->Open->getPlaceHolder()) ?>" value="<?php echo $dji_edit->Open->EditValue ?>"<?php echo $dji_edit->Open->editAttributes() ?>>
</span>
<?php echo $dji_edit->Open->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dji_edit->High->Visible) { // High ?>
	<div id="r_High" class="form-group row">
		<label id="elh_dji_High" for="x_High" class="<?php echo $dji_edit->LeftColumnClass ?>"><?php echo $dji_edit->High->caption() ?><?php echo $dji_edit->High->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_edit->RightColumnClass ?>"><div <?php echo $dji_edit->High->cellAttributes() ?>>
<span id="el_dji_High">
<input type="text" data-table="dji" data-field="x_High" name="x_High" id="x_High" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($dji_edit->High->getPlaceHolder()) ?>" value="<?php echo $dji_edit->High->EditValue ?>"<?php echo $dji_edit->High->editAttributes() ?>>
</span>
<?php echo $dji_edit->High->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dji_edit->Low->Visible) { // Low ?>
	<div id="r_Low" class="form-group row">
		<label id="elh_dji_Low" for="x_Low" class="<?php echo $dji_edit->LeftColumnClass ?>"><?php echo $dji_edit->Low->caption() ?><?php echo $dji_edit->Low->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_edit->RightColumnClass ?>"><div <?php echo $dji_edit->Low->cellAttributes() ?>>
<span id="el_dji_Low">
<input type="text" data-table="dji" data-field="x_Low" name="x_Low" id="x_Low" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($dji_edit->Low->getPlaceHolder()) ?>" value="<?php echo $dji_edit->Low->EditValue ?>"<?php echo $dji_edit->Low->editAttributes() ?>>
</span>
<?php echo $dji_edit->Low->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dji_edit->Close->Visible) { // Close ?>
	<div id="r_Close" class="form-group row">
		<label id="elh_dji_Close" for="x_Close" class="<?php echo $dji_edit->LeftColumnClass ?>"><?php echo $dji_edit->Close->caption() ?><?php echo $dji_edit->Close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_edit->RightColumnClass ?>"><div <?php echo $dji_edit->Close->cellAttributes() ?>>
<span id="el_dji_Close">
<input type="text" data-table="dji" data-field="x_Close" name="x_Close" id="x_Close" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($dji_edit->Close->getPlaceHolder()) ?>" value="<?php echo $dji_edit->Close->EditValue ?>"<?php echo $dji_edit->Close->editAttributes() ?>>
</span>
<?php echo $dji_edit->Close->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dji_edit->Volume->Visible) { // Volume ?>
	<div id="r_Volume" class="form-group row">
		<label id="elh_dji_Volume" for="x_Volume" class="<?php echo $dji_edit->LeftColumnClass ?>"><?php echo $dji_edit->Volume->caption() ?><?php echo $dji_edit->Volume->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_edit->RightColumnClass ?>"><div <?php echo $dji_edit->Volume->cellAttributes() ?>>
<span id="el_dji_Volume">
<input type="text" data-table="dji" data-field="x_Volume" name="x_Volume" id="x_Volume" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($dji_edit->Volume->getPlaceHolder()) ?>" value="<?php echo $dji_edit->Volume->EditValue ?>"<?php echo $dji_edit->Volume->editAttributes() ?>>
</span>
<?php echo $dji_edit->Volume->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dji_edit->Adj_Close->Visible) { // Adj Close ?>
	<div id="r_Adj_Close" class="form-group row">
		<label id="elh_dji_Adj_Close" for="x_Adj_Close" class="<?php echo $dji_edit->LeftColumnClass ?>"><?php echo $dji_edit->Adj_Close->caption() ?><?php echo $dji_edit->Adj_Close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_edit->RightColumnClass ?>"><div <?php echo $dji_edit->Adj_Close->cellAttributes() ?>>
<span id="el_dji_Adj_Close">
<input type="text" data-table="dji" data-field="x_Adj_Close" name="x_Adj_Close" id="x_Adj_Close" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($dji_edit->Adj_Close->getPlaceHolder()) ?>" value="<?php echo $dji_edit->Adj_Close->EditValue ?>"<?php echo $dji_edit->Adj_Close->editAttributes() ?>>
</span>
<?php echo $dji_edit->Adj_Close->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dji_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_dji_Name" for="x_Name" class="<?php echo $dji_edit->LeftColumnClass ?>"><?php echo $dji_edit->Name->caption() ?><?php echo $dji_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_edit->RightColumnClass ?>"><div <?php echo $dji_edit->Name->cellAttributes() ?>>
<span id="el_dji_Name">
<input type="text" data-table="dji" data-field="x_Name" name="x_Name" id="x_Name" maxlength="19" placeholder="<?php echo HtmlEncode($dji_edit->Name->getPlaceHolder()) ?>" value="<?php echo $dji_edit->Name->EditValue ?>"<?php echo $dji_edit->Name->editAttributes() ?>>
<?php if (!$dji_edit->Name->ReadOnly && !$dji_edit->Name->Disabled && !isset($dji_edit->Name->EditAttrs["readonly"]) && !isset($dji_edit->Name->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdjiedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fdjiedit", "x_Name", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $dji_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dji_edit->Name2->Visible) { // Name2 ?>
	<div id="r_Name2" class="form-group row">
		<label id="elh_dji_Name2" for="x_Name2" class="<?php echo $dji_edit->LeftColumnClass ?>"><?php echo $dji_edit->Name2->caption() ?><?php echo $dji_edit->Name2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_edit->RightColumnClass ?>"><div <?php echo $dji_edit->Name2->cellAttributes() ?>>
<span id="el_dji_Name2">
<input type="text" data-table="dji" data-field="x_Name2" name="x_Name2" id="x_Name2" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($dji_edit->Name2->getPlaceHolder()) ?>" value="<?php echo $dji_edit->Name2->EditValue ?>"<?php echo $dji_edit->Name2->editAttributes() ?>>
</span>
<?php echo $dji_edit->Name2->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$dji_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $dji_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $dji_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$dji_edit->showPageFooter();
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
$dji_edit->terminate();
?>