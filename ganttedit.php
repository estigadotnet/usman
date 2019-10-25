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
$gantt_edit = new gantt_edit();

// Run the page
$gantt_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gantt_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fganttedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fganttedit = currentForm = new ew.Form("fganttedit", "edit");

	// Validate form
	fganttedit.validate = function() {
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
			<?php if ($gantt_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gantt_edit->id->caption(), $gantt_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gantt_edit->id->errorMessage()) ?>");
			<?php if ($gantt_edit->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gantt_edit->name->caption(), $gantt_edit->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gantt_edit->start->Required) { ?>
				elm = this.getElements("x" + infix + "_start");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gantt_edit->start->caption(), $gantt_edit->start->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_start");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gantt_edit->start->errorMessage()) ?>");
			<?php if ($gantt_edit->end->Required) { ?>
				elm = this.getElements("x" + infix + "_end");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gantt_edit->end->caption(), $gantt_edit->end->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_end");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gantt_edit->end->errorMessage()) ?>");

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
	fganttedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fganttedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fganttedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gantt_edit->showPageHeader(); ?>
<?php
$gantt_edit->showMessage();
?>
<form name="fganttedit" id="fganttedit" class="<?php echo $gantt_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gantt">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$gantt_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($gantt_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_gantt_id" for="x_id" class="<?php echo $gantt_edit->LeftColumnClass ?>"><?php echo $gantt_edit->id->caption() ?><?php echo $gantt_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gantt_edit->RightColumnClass ?>"><div <?php echo $gantt_edit->id->cellAttributes() ?>>
<input type="text" data-table="gantt" data-field="x_id" name="x_id" id="x_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gantt_edit->id->getPlaceHolder()) ?>" value="<?php echo $gantt_edit->id->EditValue ?>"<?php echo $gantt_edit->id->editAttributes() ?>>
<input type="hidden" data-table="gantt" data-field="x_id" name="o_id" id="o_id" value="<?php echo HtmlEncode($gantt_edit->id->OldValue != null ? $gantt_edit->id->OldValue : $gantt_edit->id->CurrentValue) ?>">
<?php echo $gantt_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gantt_edit->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_gantt_name" for="x_name" class="<?php echo $gantt_edit->LeftColumnClass ?>"><?php echo $gantt_edit->name->caption() ?><?php echo $gantt_edit->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gantt_edit->RightColumnClass ?>"><div <?php echo $gantt_edit->name->cellAttributes() ?>>
<span id="el_gantt_name">
<input type="text" data-table="gantt" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($gantt_edit->name->getPlaceHolder()) ?>" value="<?php echo $gantt_edit->name->EditValue ?>"<?php echo $gantt_edit->name->editAttributes() ?>>
</span>
<?php echo $gantt_edit->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gantt_edit->start->Visible) { // start ?>
	<div id="r_start" class="form-group row">
		<label id="elh_gantt_start" for="x_start" class="<?php echo $gantt_edit->LeftColumnClass ?>"><?php echo $gantt_edit->start->caption() ?><?php echo $gantt_edit->start->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gantt_edit->RightColumnClass ?>"><div <?php echo $gantt_edit->start->cellAttributes() ?>>
<span id="el_gantt_start">
<input type="text" data-table="gantt" data-field="x_start" name="x_start" id="x_start" maxlength="19" placeholder="<?php echo HtmlEncode($gantt_edit->start->getPlaceHolder()) ?>" value="<?php echo $gantt_edit->start->EditValue ?>"<?php echo $gantt_edit->start->editAttributes() ?>>
<?php if (!$gantt_edit->start->ReadOnly && !$gantt_edit->start->Disabled && !isset($gantt_edit->start->EditAttrs["readonly"]) && !isset($gantt_edit->start->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fganttedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fganttedit", "x_start", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $gantt_edit->start->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gantt_edit->end->Visible) { // end ?>
	<div id="r_end" class="form-group row">
		<label id="elh_gantt_end" for="x_end" class="<?php echo $gantt_edit->LeftColumnClass ?>"><?php echo $gantt_edit->end->caption() ?><?php echo $gantt_edit->end->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gantt_edit->RightColumnClass ?>"><div <?php echo $gantt_edit->end->cellAttributes() ?>>
<span id="el_gantt_end">
<input type="text" data-table="gantt" data-field="x_end" name="x_end" id="x_end" maxlength="19" placeholder="<?php echo HtmlEncode($gantt_edit->end->getPlaceHolder()) ?>" value="<?php echo $gantt_edit->end->EditValue ?>"<?php echo $gantt_edit->end->editAttributes() ?>>
<?php if (!$gantt_edit->end->ReadOnly && !$gantt_edit->end->Disabled && !isset($gantt_edit->end->EditAttrs["readonly"]) && !isset($gantt_edit->end->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fganttedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fganttedit", "x_end", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $gantt_edit->end->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$gantt_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $gantt_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gantt_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$gantt_edit->showPageFooter();
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
$gantt_edit->terminate();
?>