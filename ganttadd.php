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
$gantt_add = new gantt_add();

// Run the page
$gantt_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gantt_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fganttadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fganttadd = currentForm = new ew.Form("fganttadd", "add");

	// Validate form
	fganttadd.validate = function() {
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
			<?php if ($gantt_add->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gantt_add->id->caption(), $gantt_add->id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gantt_add->id->errorMessage()) ?>");
			<?php if ($gantt_add->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gantt_add->name->caption(), $gantt_add->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gantt_add->start->Required) { ?>
				elm = this.getElements("x" + infix + "_start");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gantt_add->start->caption(), $gantt_add->start->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_start");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gantt_add->start->errorMessage()) ?>");
			<?php if ($gantt_add->end->Required) { ?>
				elm = this.getElements("x" + infix + "_end");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gantt_add->end->caption(), $gantt_add->end->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_end");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gantt_add->end->errorMessage()) ?>");

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
	fganttadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fganttadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fganttadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gantt_add->showPageHeader(); ?>
<?php
$gantt_add->showMessage();
?>
<form name="fganttadd" id="fganttadd" class="<?php echo $gantt_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gantt">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$gantt_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($gantt_add->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_gantt_id" for="x_id" class="<?php echo $gantt_add->LeftColumnClass ?>"><?php echo $gantt_add->id->caption() ?><?php echo $gantt_add->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gantt_add->RightColumnClass ?>"><div <?php echo $gantt_add->id->cellAttributes() ?>>
<span id="el_gantt_id">
<input type="text" data-table="gantt" data-field="x_id" name="x_id" id="x_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gantt_add->id->getPlaceHolder()) ?>" value="<?php echo $gantt_add->id->EditValue ?>"<?php echo $gantt_add->id->editAttributes() ?>>
</span>
<?php echo $gantt_add->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gantt_add->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_gantt_name" for="x_name" class="<?php echo $gantt_add->LeftColumnClass ?>"><?php echo $gantt_add->name->caption() ?><?php echo $gantt_add->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gantt_add->RightColumnClass ?>"><div <?php echo $gantt_add->name->cellAttributes() ?>>
<span id="el_gantt_name">
<input type="text" data-table="gantt" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($gantt_add->name->getPlaceHolder()) ?>" value="<?php echo $gantt_add->name->EditValue ?>"<?php echo $gantt_add->name->editAttributes() ?>>
</span>
<?php echo $gantt_add->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gantt_add->start->Visible) { // start ?>
	<div id="r_start" class="form-group row">
		<label id="elh_gantt_start" for="x_start" class="<?php echo $gantt_add->LeftColumnClass ?>"><?php echo $gantt_add->start->caption() ?><?php echo $gantt_add->start->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gantt_add->RightColumnClass ?>"><div <?php echo $gantt_add->start->cellAttributes() ?>>
<span id="el_gantt_start">
<input type="text" data-table="gantt" data-field="x_start" name="x_start" id="x_start" maxlength="19" placeholder="<?php echo HtmlEncode($gantt_add->start->getPlaceHolder()) ?>" value="<?php echo $gantt_add->start->EditValue ?>"<?php echo $gantt_add->start->editAttributes() ?>>
<?php if (!$gantt_add->start->ReadOnly && !$gantt_add->start->Disabled && !isset($gantt_add->start->EditAttrs["readonly"]) && !isset($gantt_add->start->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fganttadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fganttadd", "x_start", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $gantt_add->start->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gantt_add->end->Visible) { // end ?>
	<div id="r_end" class="form-group row">
		<label id="elh_gantt_end" for="x_end" class="<?php echo $gantt_add->LeftColumnClass ?>"><?php echo $gantt_add->end->caption() ?><?php echo $gantt_add->end->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gantt_add->RightColumnClass ?>"><div <?php echo $gantt_add->end->cellAttributes() ?>>
<span id="el_gantt_end">
<input type="text" data-table="gantt" data-field="x_end" name="x_end" id="x_end" maxlength="19" placeholder="<?php echo HtmlEncode($gantt_add->end->getPlaceHolder()) ?>" value="<?php echo $gantt_add->end->EditValue ?>"<?php echo $gantt_add->end->editAttributes() ?>>
<?php if (!$gantt_add->end->ReadOnly && !$gantt_add->end->Disabled && !isset($gantt_add->end->EditAttrs["readonly"]) && !isset($gantt_add->end->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fganttadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fganttadd", "x_end", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $gantt_add->end->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$gantt_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $gantt_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gantt_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$gantt_add->showPageFooter();
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
$gantt_add->terminate();
?>