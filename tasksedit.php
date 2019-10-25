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
$tasks_edit = new tasks_edit();

// Run the page
$tasks_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tasks_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftasksedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftasksedit = currentForm = new ew.Form("ftasksedit", "edit");

	// Validate form
	ftasksedit.validate = function() {
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
			<?php if ($tasks_edit->TaskID->Required) { ?>
				elm = this.getElements("x" + infix + "_TaskID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tasks_edit->TaskID->caption(), $tasks_edit->TaskID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tasks_edit->TaskName->Required) { ?>
				elm = this.getElements("x" + infix + "_TaskName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tasks_edit->TaskName->caption(), $tasks_edit->TaskName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tasks_edit->ResourceID->Required) { ?>
				elm = this.getElements("x" + infix + "_ResourceID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tasks_edit->ResourceID->caption(), $tasks_edit->ResourceID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tasks_edit->Start->Required) { ?>
				elm = this.getElements("x" + infix + "_Start");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tasks_edit->Start->caption(), $tasks_edit->Start->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Start");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tasks_edit->Start->errorMessage()) ?>");
			<?php if ($tasks_edit->End->Required) { ?>
				elm = this.getElements("x" + infix + "_End");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tasks_edit->End->caption(), $tasks_edit->End->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_End");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tasks_edit->End->errorMessage()) ?>");
			<?php if ($tasks_edit->Description->Required) { ?>
				elm = this.getElements("x" + infix + "_Description");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tasks_edit->Description->caption(), $tasks_edit->Description->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tasks_edit->Milestone->Required) { ?>
				elm = this.getElements("x" + infix + "_Milestone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tasks_edit->Milestone->caption(), $tasks_edit->Milestone->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Milestone");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tasks_edit->Milestone->errorMessage()) ?>");
			<?php if ($tasks_edit->Duration->Required) { ?>
				elm = this.getElements("x" + infix + "_Duration");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tasks_edit->Duration->caption(), $tasks_edit->Duration->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Duration");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tasks_edit->Duration->errorMessage()) ?>");
			<?php if ($tasks_edit->PercentComplete->Required) { ?>
				elm = this.getElements("x" + infix + "_PercentComplete");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tasks_edit->PercentComplete->caption(), $tasks_edit->PercentComplete->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PercentComplete");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tasks_edit->PercentComplete->errorMessage()) ?>");
			<?php if ($tasks_edit->Dependencies->Required) { ?>
				elm = this.getElements("x" + infix + "_Dependencies");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tasks_edit->Dependencies->caption(), $tasks_edit->Dependencies->RequiredErrorMessage)) ?>");
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
	ftasksedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftasksedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftasksedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tasks_edit->showPageHeader(); ?>
<?php
$tasks_edit->showMessage();
?>
<form name="ftasksedit" id="ftasksedit" class="<?php echo $tasks_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tasks">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tasks_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tasks_edit->TaskID->Visible) { // TaskID ?>
	<div id="r_TaskID" class="form-group row">
		<label id="elh_tasks_TaskID" for="x_TaskID" class="<?php echo $tasks_edit->LeftColumnClass ?>"><?php echo $tasks_edit->TaskID->caption() ?><?php echo $tasks_edit->TaskID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tasks_edit->RightColumnClass ?>"><div <?php echo $tasks_edit->TaskID->cellAttributes() ?>>
<input type="text" data-table="tasks" data-field="x_TaskID" name="x_TaskID" id="x_TaskID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tasks_edit->TaskID->getPlaceHolder()) ?>" value="<?php echo $tasks_edit->TaskID->EditValue ?>"<?php echo $tasks_edit->TaskID->editAttributes() ?>>
<input type="hidden" data-table="tasks" data-field="x_TaskID" name="o_TaskID" id="o_TaskID" value="<?php echo HtmlEncode($tasks_edit->TaskID->OldValue != null ? $tasks_edit->TaskID->OldValue : $tasks_edit->TaskID->CurrentValue) ?>">
<?php echo $tasks_edit->TaskID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tasks_edit->TaskName->Visible) { // TaskName ?>
	<div id="r_TaskName" class="form-group row">
		<label id="elh_tasks_TaskName" for="x_TaskName" class="<?php echo $tasks_edit->LeftColumnClass ?>"><?php echo $tasks_edit->TaskName->caption() ?><?php echo $tasks_edit->TaskName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tasks_edit->RightColumnClass ?>"><div <?php echo $tasks_edit->TaskName->cellAttributes() ?>>
<span id="el_tasks_TaskName">
<input type="text" data-table="tasks" data-field="x_TaskName" name="x_TaskName" id="x_TaskName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tasks_edit->TaskName->getPlaceHolder()) ?>" value="<?php echo $tasks_edit->TaskName->EditValue ?>"<?php echo $tasks_edit->TaskName->editAttributes() ?>>
</span>
<?php echo $tasks_edit->TaskName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tasks_edit->ResourceID->Visible) { // ResourceID ?>
	<div id="r_ResourceID" class="form-group row">
		<label id="elh_tasks_ResourceID" for="x_ResourceID" class="<?php echo $tasks_edit->LeftColumnClass ?>"><?php echo $tasks_edit->ResourceID->caption() ?><?php echo $tasks_edit->ResourceID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tasks_edit->RightColumnClass ?>"><div <?php echo $tasks_edit->ResourceID->cellAttributes() ?>>
<span id="el_tasks_ResourceID">
<input type="text" data-table="tasks" data-field="x_ResourceID" name="x_ResourceID" id="x_ResourceID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tasks_edit->ResourceID->getPlaceHolder()) ?>" value="<?php echo $tasks_edit->ResourceID->EditValue ?>"<?php echo $tasks_edit->ResourceID->editAttributes() ?>>
</span>
<?php echo $tasks_edit->ResourceID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tasks_edit->Start->Visible) { // Start ?>
	<div id="r_Start" class="form-group row">
		<label id="elh_tasks_Start" for="x_Start" class="<?php echo $tasks_edit->LeftColumnClass ?>"><?php echo $tasks_edit->Start->caption() ?><?php echo $tasks_edit->Start->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tasks_edit->RightColumnClass ?>"><div <?php echo $tasks_edit->Start->cellAttributes() ?>>
<span id="el_tasks_Start">
<input type="text" data-table="tasks" data-field="x_Start" name="x_Start" id="x_Start" maxlength="10" placeholder="<?php echo HtmlEncode($tasks_edit->Start->getPlaceHolder()) ?>" value="<?php echo $tasks_edit->Start->EditValue ?>"<?php echo $tasks_edit->Start->editAttributes() ?>>
<?php if (!$tasks_edit->Start->ReadOnly && !$tasks_edit->Start->Disabled && !isset($tasks_edit->Start->EditAttrs["readonly"]) && !isset($tasks_edit->Start->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftasksedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ftasksedit", "x_Start", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $tasks_edit->Start->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tasks_edit->End->Visible) { // End ?>
	<div id="r_End" class="form-group row">
		<label id="elh_tasks_End" for="x_End" class="<?php echo $tasks_edit->LeftColumnClass ?>"><?php echo $tasks_edit->End->caption() ?><?php echo $tasks_edit->End->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tasks_edit->RightColumnClass ?>"><div <?php echo $tasks_edit->End->cellAttributes() ?>>
<span id="el_tasks_End">
<input type="text" data-table="tasks" data-field="x_End" name="x_End" id="x_End" maxlength="10" placeholder="<?php echo HtmlEncode($tasks_edit->End->getPlaceHolder()) ?>" value="<?php echo $tasks_edit->End->EditValue ?>"<?php echo $tasks_edit->End->editAttributes() ?>>
<?php if (!$tasks_edit->End->ReadOnly && !$tasks_edit->End->Disabled && !isset($tasks_edit->End->EditAttrs["readonly"]) && !isset($tasks_edit->End->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftasksedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ftasksedit", "x_End", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $tasks_edit->End->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tasks_edit->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_tasks_Description" for="x_Description" class="<?php echo $tasks_edit->LeftColumnClass ?>"><?php echo $tasks_edit->Description->caption() ?><?php echo $tasks_edit->Description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tasks_edit->RightColumnClass ?>"><div <?php echo $tasks_edit->Description->cellAttributes() ?>>
<span id="el_tasks_Description">
<input type="text" data-table="tasks" data-field="x_Description" name="x_Description" id="x_Description" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tasks_edit->Description->getPlaceHolder()) ?>" value="<?php echo $tasks_edit->Description->EditValue ?>"<?php echo $tasks_edit->Description->editAttributes() ?>>
</span>
<?php echo $tasks_edit->Description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tasks_edit->Milestone->Visible) { // Milestone ?>
	<div id="r_Milestone" class="form-group row">
		<label id="elh_tasks_Milestone" for="x_Milestone" class="<?php echo $tasks_edit->LeftColumnClass ?>"><?php echo $tasks_edit->Milestone->caption() ?><?php echo $tasks_edit->Milestone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tasks_edit->RightColumnClass ?>"><div <?php echo $tasks_edit->Milestone->cellAttributes() ?>>
<span id="el_tasks_Milestone">
<input type="text" data-table="tasks" data-field="x_Milestone" name="x_Milestone" id="x_Milestone" maxlength="10" placeholder="<?php echo HtmlEncode($tasks_edit->Milestone->getPlaceHolder()) ?>" value="<?php echo $tasks_edit->Milestone->EditValue ?>"<?php echo $tasks_edit->Milestone->editAttributes() ?>>
<?php if (!$tasks_edit->Milestone->ReadOnly && !$tasks_edit->Milestone->Disabled && !isset($tasks_edit->Milestone->EditAttrs["readonly"]) && !isset($tasks_edit->Milestone->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftasksedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ftasksedit", "x_Milestone", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $tasks_edit->Milestone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tasks_edit->Duration->Visible) { // Duration ?>
	<div id="r_Duration" class="form-group row">
		<label id="elh_tasks_Duration" for="x_Duration" class="<?php echo $tasks_edit->LeftColumnClass ?>"><?php echo $tasks_edit->Duration->caption() ?><?php echo $tasks_edit->Duration->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tasks_edit->RightColumnClass ?>"><div <?php echo $tasks_edit->Duration->cellAttributes() ?>>
<span id="el_tasks_Duration">
<input type="text" data-table="tasks" data-field="x_Duration" name="x_Duration" id="x_Duration" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($tasks_edit->Duration->getPlaceHolder()) ?>" value="<?php echo $tasks_edit->Duration->EditValue ?>"<?php echo $tasks_edit->Duration->editAttributes() ?>>
</span>
<?php echo $tasks_edit->Duration->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tasks_edit->PercentComplete->Visible) { // PercentComplete ?>
	<div id="r_PercentComplete" class="form-group row">
		<label id="elh_tasks_PercentComplete" for="x_PercentComplete" class="<?php echo $tasks_edit->LeftColumnClass ?>"><?php echo $tasks_edit->PercentComplete->caption() ?><?php echo $tasks_edit->PercentComplete->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tasks_edit->RightColumnClass ?>"><div <?php echo $tasks_edit->PercentComplete->cellAttributes() ?>>
<span id="el_tasks_PercentComplete">
<input type="text" data-table="tasks" data-field="x_PercentComplete" name="x_PercentComplete" id="x_PercentComplete" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($tasks_edit->PercentComplete->getPlaceHolder()) ?>" value="<?php echo $tasks_edit->PercentComplete->EditValue ?>"<?php echo $tasks_edit->PercentComplete->editAttributes() ?>>
</span>
<?php echo $tasks_edit->PercentComplete->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tasks_edit->Dependencies->Visible) { // Dependencies ?>
	<div id="r_Dependencies" class="form-group row">
		<label id="elh_tasks_Dependencies" for="x_Dependencies" class="<?php echo $tasks_edit->LeftColumnClass ?>"><?php echo $tasks_edit->Dependencies->caption() ?><?php echo $tasks_edit->Dependencies->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tasks_edit->RightColumnClass ?>"><div <?php echo $tasks_edit->Dependencies->cellAttributes() ?>>
<span id="el_tasks_Dependencies">
<input type="text" data-table="tasks" data-field="x_Dependencies" name="x_Dependencies" id="x_Dependencies" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tasks_edit->Dependencies->getPlaceHolder()) ?>" value="<?php echo $tasks_edit->Dependencies->EditValue ?>"<?php echo $tasks_edit->Dependencies->editAttributes() ?>>
</span>
<?php echo $tasks_edit->Dependencies->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tasks_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tasks_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tasks_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tasks_edit->showPageFooter();
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
$tasks_edit->terminate();
?>