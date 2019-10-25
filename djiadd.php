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
$dji_add = new dji_add();

// Run the page
$dji_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dji_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdjiadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdjiadd = currentForm = new ew.Form("fdjiadd", "add");

	// Validate form
	fdjiadd.validate = function() {
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
			<?php if ($dji_add->Date->Required) { ?>
				elm = this.getElements("x" + infix + "_Date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji_add->Date->caption(), $dji_add->Date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dji_add->Date->errorMessage()) ?>");
			<?php if ($dji_add->Open->Required) { ?>
				elm = this.getElements("x" + infix + "_Open");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji_add->Open->caption(), $dji_add->Open->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Open");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dji_add->Open->errorMessage()) ?>");
			<?php if ($dji_add->High->Required) { ?>
				elm = this.getElements("x" + infix + "_High");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji_add->High->caption(), $dji_add->High->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_High");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dji_add->High->errorMessage()) ?>");
			<?php if ($dji_add->Low->Required) { ?>
				elm = this.getElements("x" + infix + "_Low");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji_add->Low->caption(), $dji_add->Low->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Low");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dji_add->Low->errorMessage()) ?>");
			<?php if ($dji_add->Close->Required) { ?>
				elm = this.getElements("x" + infix + "_Close");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji_add->Close->caption(), $dji_add->Close->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Close");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dji_add->Close->errorMessage()) ?>");
			<?php if ($dji_add->Volume->Required) { ?>
				elm = this.getElements("x" + infix + "_Volume");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji_add->Volume->caption(), $dji_add->Volume->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Volume");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dji_add->Volume->errorMessage()) ?>");
			<?php if ($dji_add->Adj_Close->Required) { ?>
				elm = this.getElements("x" + infix + "_Adj_Close");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji_add->Adj_Close->caption(), $dji_add->Adj_Close->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Adj_Close");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dji_add->Adj_Close->errorMessage()) ?>");
			<?php if ($dji_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji_add->Name->caption(), $dji_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dji_add->Name->errorMessage()) ?>");
			<?php if ($dji_add->Name2->Required) { ?>
				elm = this.getElements("x" + infix + "_Name2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dji_add->Name2->caption(), $dji_add->Name2->RequiredErrorMessage)) ?>");
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
	fdjiadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdjiadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fdjiadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $dji_add->showPageHeader(); ?>
<?php
$dji_add->showMessage();
?>
<form name="fdjiadd" id="fdjiadd" class="<?php echo $dji_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dji">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$dji_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($dji_add->Date->Visible) { // Date ?>
	<div id="r_Date" class="form-group row">
		<label id="elh_dji_Date" for="x_Date" class="<?php echo $dji_add->LeftColumnClass ?>"><?php echo $dji_add->Date->caption() ?><?php echo $dji_add->Date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_add->RightColumnClass ?>"><div <?php echo $dji_add->Date->cellAttributes() ?>>
<span id="el_dji_Date">
<input type="text" data-table="dji" data-field="x_Date" name="x_Date" id="x_Date" maxlength="19" placeholder="<?php echo HtmlEncode($dji_add->Date->getPlaceHolder()) ?>" value="<?php echo $dji_add->Date->EditValue ?>"<?php echo $dji_add->Date->editAttributes() ?>>
<?php if (!$dji_add->Date->ReadOnly && !$dji_add->Date->Disabled && !isset($dji_add->Date->EditAttrs["readonly"]) && !isset($dji_add->Date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdjiadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fdjiadd", "x_Date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $dji_add->Date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dji_add->Open->Visible) { // Open ?>
	<div id="r_Open" class="form-group row">
		<label id="elh_dji_Open" for="x_Open" class="<?php echo $dji_add->LeftColumnClass ?>"><?php echo $dji_add->Open->caption() ?><?php echo $dji_add->Open->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_add->RightColumnClass ?>"><div <?php echo $dji_add->Open->cellAttributes() ?>>
<span id="el_dji_Open">
<input type="text" data-table="dji" data-field="x_Open" name="x_Open" id="x_Open" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($dji_add->Open->getPlaceHolder()) ?>" value="<?php echo $dji_add->Open->EditValue ?>"<?php echo $dji_add->Open->editAttributes() ?>>
</span>
<?php echo $dji_add->Open->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dji_add->High->Visible) { // High ?>
	<div id="r_High" class="form-group row">
		<label id="elh_dji_High" for="x_High" class="<?php echo $dji_add->LeftColumnClass ?>"><?php echo $dji_add->High->caption() ?><?php echo $dji_add->High->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_add->RightColumnClass ?>"><div <?php echo $dji_add->High->cellAttributes() ?>>
<span id="el_dji_High">
<input type="text" data-table="dji" data-field="x_High" name="x_High" id="x_High" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($dji_add->High->getPlaceHolder()) ?>" value="<?php echo $dji_add->High->EditValue ?>"<?php echo $dji_add->High->editAttributes() ?>>
</span>
<?php echo $dji_add->High->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dji_add->Low->Visible) { // Low ?>
	<div id="r_Low" class="form-group row">
		<label id="elh_dji_Low" for="x_Low" class="<?php echo $dji_add->LeftColumnClass ?>"><?php echo $dji_add->Low->caption() ?><?php echo $dji_add->Low->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_add->RightColumnClass ?>"><div <?php echo $dji_add->Low->cellAttributes() ?>>
<span id="el_dji_Low">
<input type="text" data-table="dji" data-field="x_Low" name="x_Low" id="x_Low" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($dji_add->Low->getPlaceHolder()) ?>" value="<?php echo $dji_add->Low->EditValue ?>"<?php echo $dji_add->Low->editAttributes() ?>>
</span>
<?php echo $dji_add->Low->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dji_add->Close->Visible) { // Close ?>
	<div id="r_Close" class="form-group row">
		<label id="elh_dji_Close" for="x_Close" class="<?php echo $dji_add->LeftColumnClass ?>"><?php echo $dji_add->Close->caption() ?><?php echo $dji_add->Close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_add->RightColumnClass ?>"><div <?php echo $dji_add->Close->cellAttributes() ?>>
<span id="el_dji_Close">
<input type="text" data-table="dji" data-field="x_Close" name="x_Close" id="x_Close" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($dji_add->Close->getPlaceHolder()) ?>" value="<?php echo $dji_add->Close->EditValue ?>"<?php echo $dji_add->Close->editAttributes() ?>>
</span>
<?php echo $dji_add->Close->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dji_add->Volume->Visible) { // Volume ?>
	<div id="r_Volume" class="form-group row">
		<label id="elh_dji_Volume" for="x_Volume" class="<?php echo $dji_add->LeftColumnClass ?>"><?php echo $dji_add->Volume->caption() ?><?php echo $dji_add->Volume->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_add->RightColumnClass ?>"><div <?php echo $dji_add->Volume->cellAttributes() ?>>
<span id="el_dji_Volume">
<input type="text" data-table="dji" data-field="x_Volume" name="x_Volume" id="x_Volume" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($dji_add->Volume->getPlaceHolder()) ?>" value="<?php echo $dji_add->Volume->EditValue ?>"<?php echo $dji_add->Volume->editAttributes() ?>>
</span>
<?php echo $dji_add->Volume->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dji_add->Adj_Close->Visible) { // Adj Close ?>
	<div id="r_Adj_Close" class="form-group row">
		<label id="elh_dji_Adj_Close" for="x_Adj_Close" class="<?php echo $dji_add->LeftColumnClass ?>"><?php echo $dji_add->Adj_Close->caption() ?><?php echo $dji_add->Adj_Close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_add->RightColumnClass ?>"><div <?php echo $dji_add->Adj_Close->cellAttributes() ?>>
<span id="el_dji_Adj_Close">
<input type="text" data-table="dji" data-field="x_Adj_Close" name="x_Adj_Close" id="x_Adj_Close" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($dji_add->Adj_Close->getPlaceHolder()) ?>" value="<?php echo $dji_add->Adj_Close->EditValue ?>"<?php echo $dji_add->Adj_Close->editAttributes() ?>>
</span>
<?php echo $dji_add->Adj_Close->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dji_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_dji_Name" for="x_Name" class="<?php echo $dji_add->LeftColumnClass ?>"><?php echo $dji_add->Name->caption() ?><?php echo $dji_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_add->RightColumnClass ?>"><div <?php echo $dji_add->Name->cellAttributes() ?>>
<span id="el_dji_Name">
<input type="text" data-table="dji" data-field="x_Name" name="x_Name" id="x_Name" maxlength="19" placeholder="<?php echo HtmlEncode($dji_add->Name->getPlaceHolder()) ?>" value="<?php echo $dji_add->Name->EditValue ?>"<?php echo $dji_add->Name->editAttributes() ?>>
<?php if (!$dji_add->Name->ReadOnly && !$dji_add->Name->Disabled && !isset($dji_add->Name->EditAttrs["readonly"]) && !isset($dji_add->Name->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdjiadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fdjiadd", "x_Name", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $dji_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dji_add->Name2->Visible) { // Name2 ?>
	<div id="r_Name2" class="form-group row">
		<label id="elh_dji_Name2" for="x_Name2" class="<?php echo $dji_add->LeftColumnClass ?>"><?php echo $dji_add->Name2->caption() ?><?php echo $dji_add->Name2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dji_add->RightColumnClass ?>"><div <?php echo $dji_add->Name2->cellAttributes() ?>>
<span id="el_dji_Name2">
<input type="text" data-table="dji" data-field="x_Name2" name="x_Name2" id="x_Name2" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($dji_add->Name2->getPlaceHolder()) ?>" value="<?php echo $dji_add->Name2->EditValue ?>"<?php echo $dji_add->Name2->editAttributes() ?>>
</span>
<?php echo $dji_add->Name2->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$dji_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $dji_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $dji_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$dji_add->showPageFooter();
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
$dji_add->terminate();
?>