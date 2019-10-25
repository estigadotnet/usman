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
$tasks_add = new tasks_add();

// Run the page
$tasks_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tasks_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftasksadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ftasksadd = currentForm = new ew.Form("ftasksadd", "add");

	// Validate form
	ftasksadd.validate = function() {
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
			<?php if ($tasks_add->TaskID->Required) { ?>
				elm = this.getElements("x" + infix + "_TaskID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tasks_add->TaskID->caption(), $tasks_add->TaskID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tasks_add->TaskName->Required) { ?>
				elm = this.getElements("x" + infix + "_TaskName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tasks_add->TaskName->caption(), $tasks_add->TaskName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tasks_add->ResourceID->Required) { ?>
				elm = this.getElements("x" + infix + "_ResourceID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tasks_add->ResourceID->caption(), $tasks_add->ResourceID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tasks_add->Start->Required) { ?>
				elm = this.getElements("x" + infix + "_Start");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tasks_add->Start->caption(), $tasks_add->Start->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Start");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tasks_add->Start->errorMessage()) ?>");
			<?php if ($tasks_add->End->Required) { ?>
				elm = this.getElements("x" + infix + "_End");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tasks_add->End->caption(), $tasks_add->End->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_End");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tasks_add->End->errorMessage()) ?>");
			<?php if ($tasks_add->Description->Required) { ?>
				elm = this.getElements("x" + infix + "_Description");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tasks_add->Description->caption(), $tasks_add->Description->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tasks_add->Milestone->Required) { ?>
				elm = this.getElements("x" + infix + "_Milestone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tasks_add->Milestone->caption(), $tasks_add->Milestone->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Milestone");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tasks_add->Milestone->errorMessage()) ?>");
			<?php if ($tasks_add->Duration->Required) { ?>
				elm = this.getElements("x" + infix + "_Duration");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tasks_add->Duration->caption(), $tasks_add->Duration->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Duration");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tasks_add->Duration->errorMessage()) ?>");
			<?php if ($tasks_add->PercentComplete->Required) { ?>
				elm = this.getElements("x" + infix + "_PercentComplete");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tasks_add->PercentComplete->caption(), $tasks_add->PercentComplete->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PercentComplete");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tasks_add->PercentComplete->errorMessage()) ?>");
			<?php if ($tasks_add->Dependencies->Required) { ?>
				elm = this.getElements("x" + infix + "_Dependencies");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tasks_add->Dependencies->caption(), $tasks_add->Dependencies->RequiredErrorMessage)) ?>");
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
	ftasksadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftasksadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftasksadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tasks_add->showPageHeader(); ?>
<?php
$tasks_add->showMessage();
?>
<form name="ftasksadd" id="ftasksadd" class="<?php echo $tasks_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tasks">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tasks_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tasks_add->TaskID->Visible) { // TaskID ?>
	<div id="r_TaskID" class="form-group row">
		<label id="elh_tasks_TaskID" for="x_TaskID" class="<?php echo $tasks_add->LeftColumnClass ?>"><?php echo $tasks_add->TaskID->caption() ?><?php echo $tasks_add->TaskID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tasks_add->RightColumnClass ?>"><div <?php echo $tasks_add->TaskID->cellAttributes() ?>>
<span id="el_tasks_TaskID">
<input type="text" data-table="tasks" data-field="x_TaskID" name="x_TaskID" id="x_TaskID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tasks_add->TaskID->getPlaceHolder()) ?>" value="<?php echo $tasks_add->TaskID->EditValue ?>"<?php echo $tasks_add->TaskID->editAttributes() ?>>
</span>
<?php echo $tasks_add->TaskID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tasks_add->TaskName->Visible) { // TaskName ?>
	<div id="r_TaskName" class="form-group row">
		<label id="elh_tasks_TaskName" for="x_TaskName" class="<?php echo $tasks_add->LeftColumnClass ?>"><?php echo $tasks_add->TaskName->caption() ?><?php echo $tasks_add->TaskName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tasks_add->RightColumnClass ?>"><div <?php echo $tasks_add->TaskName->cellAttributes() ?>>
<span id="el_tasks_TaskName">
<input type="text" data-table="tasks" data-field="x_TaskName" name="x_TaskName" id="x_TaskName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tasks_add->TaskName->getPlaceHolder()) ?>" value="<?php echo $tasks_add->TaskName->EditValue ?>"<?php echo $tasks_add->TaskName->editAttributes() ?>>
</span>
<?php echo $tasks_add->TaskName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tasks_add->ResourceID->Visible) { // ResourceID ?>
	<div id="r_ResourceID" class="form-group row">
		<label id="elh_tasks_ResourceID" for="x_ResourceID" class="<?php echo $tasks_add->LeftColumnClass ?>"><?php echo $tasks_add->ResourceID->caption() ?><?php echo $tasks_add->ResourceID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tasks_add->RightColumnClass ?>"><div <?php echo $tasks_add->ResourceID->cellAttributes() ?>>
<span id="el_tasks_ResourceID">
<input type="text" data-table="tasks" data-field="x_ResourceID" name="x_ResourceID" id="x_ResourceID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tasks_add->ResourceID->getPlaceHolder()) ?>" value="<?php echo $tasks_add->ResourceID->EditValue ?>"<?php echo $tasks_add->ResourceID->editAttributes() ?>>
</span>
<?php echo $tasks_add->ResourceID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tasks_add->Start->Visible) { // Start ?>
	<div id="r_Start" class="form-group row">
		<label id="elh_tasks_Start" for="x_Start" class="<?php echo $tasks_add->LeftColumnClass ?>"><?php echo $tasks_add->Start->caption() ?><?php echo $tasks_add->Start->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tasks_add->RightColumnClass ?>"><div <?php echo $tasks_add->Start->cellAttributes() ?>>
<span id="el_tasks_Start">
<input type="text" data-table="tasks" data-field="x_Start" name="x_Start" id="x_Start" maxlength="10" placeholder="<?php echo HtmlEncode($tasks_add->Start->getPlaceHolder()) ?>" value="<?php echo $tasks_add->Start->EditValue ?>"<?php echo $tasks_add->Start->editAttributes() ?>>
<?php if (!$tasks_add->Start->ReadOnly && !$tasks_add->Start->Disabled && !isset($tasks_add->Start->EditAttrs["readonly"]) && !isset($tasks_add->Start->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftasksadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ftasksadd", "x_Start", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $tasks_add->Start->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tasks_add->End->Visible) { // End ?>
	<div id="r_End" class="form-group row">
		<label id="elh_tasks_End" for="x_End" class="<?php echo $tasks_add->LeftColumnClass ?>"><?php echo $tasks_add->End->caption() ?><?php echo $tasks_add->End->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tasks_add->RightColumnClass ?>"><div <?php echo $tasks_add->End->cellAttributes() ?>>
<span id="el_tasks_End">
<input type="text" data-table="tasks" data-field="x_End" name="x_End" id="x_End" maxlength="10" placeholder="<?php echo HtmlEncode($tasks_add->End->getPlaceHolder()) ?>" value="<?php echo $tasks_add->End->EditValue ?>"<?php echo $tasks_add->End->editAttributes() ?>>
<?php if (!$tasks_add->End->ReadOnly && !$tasks_add->End->Disabled && !isset($tasks_add->End->EditAttrs["readonly"]) && !isset($tasks_add->End->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftasksadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ftasksadd", "x_End", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $tasks_add->End->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tasks_add->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_tasks_Description" for="x_Description" class="<?php echo $tasks_add->LeftColumnClass ?>"><?php echo $tasks_add->Description->caption() ?><?php echo $tasks_add->Description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tasks_add->RightColumnClass ?>"><div <?php echo $tasks_add->Description->cellAttributes() ?>>
<span id="el_tasks_Description">
<input type="text" data-table="tasks" data-field="x_Description" name="x_Description" id="x_Description" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tasks_add->Description->getPlaceHolder()) ?>" value="<?php echo $tasks_add->Description->EditValue ?>"<?php echo $tasks_add->Description->editAttributes() ?>>
</span>
<?php echo $tasks_add->Description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tasks_add->Milestone->Visible) { // Milestone ?>
	<div id="r_Milestone" class="form-group row">
		<label id="elh_tasks_Milestone" for="x_Milestone" class="<?php echo $tasks_add->LeftColumnClass ?>"><?php echo $tasks_add->Milestone->caption() ?><?php echo $tasks_add->Milestone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tasks_add->RightColumnClass ?>"><div <?php echo $tasks_add->Milestone->cellAttributes() ?>>
<span id="el_tasks_Milestone">
<input type="text" data-table="tasks" data-field="x_Milestone" name="x_Milestone" id="x_Milestone" maxlength="10" placeholder="<?php echo HtmlEncode($tasks_add->Milestone->getPlaceHolder()) ?>" value="<?php echo $tasks_add->Milestone->EditValue ?>"<?php echo $tasks_add->Milestone->editAttributes() ?>>
<?php if (!$tasks_add->Milestone->ReadOnly && !$tasks_add->Milestone->Disabled && !isset($tasks_add->Milestone->EditAttrs["readonly"]) && !isset($tasks_add->Milestone->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftasksadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ftasksadd", "x_Milestone", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $tasks_add->Milestone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tasks_add->Duration->Visible) { // Duration ?>
	<div id="r_Duration" class="form-group row">
		<label id="elh_tasks_Duration" for="x_Duration" class="<?php echo $tasks_add->LeftColumnClass ?>"><?php echo $tasks_add->Duration->caption() ?><?php echo $tasks_add->Duration->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tasks_add->RightColumnClass ?>"><div <?php echo $tasks_add->Duration->cellAttributes() ?>>
<span id="el_tasks_Duration">
<input type="text" data-table="tasks" data-field="x_Duration" name="x_Duration" id="x_Duration" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($tasks_add->Duration->getPlaceHolder()) ?>" value="<?php echo $tasks_add->Duration->EditValue ?>"<?php echo $tasks_add->Duration->editAttributes() ?>>
</span>
<?php echo $tasks_add->Duration->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tasks_add->PercentComplete->Visible) { // PercentComplete ?>
	<div id="r_PercentComplete" class="form-group row">
		<label id="elh_tasks_PercentComplete" for="x_PercentComplete" class="<?php echo $tasks_add->LeftColumnClass ?>"><?php echo $tasks_add->PercentComplete->caption() ?><?php echo $tasks_add->PercentComplete->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tasks_add->RightColumnClass ?>"><div <?php echo $tasks_add->PercentComplete->cellAttributes() ?>>
<span id="el_tasks_PercentComplete">
<input type="text" data-table="tasks" data-field="x_PercentComplete" name="x_PercentComplete" id="x_PercentComplete" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($tasks_add->PercentComplete->getPlaceHolder()) ?>" value="<?php echo $tasks_add->PercentComplete->EditValue ?>"<?php echo $tasks_add->PercentComplete->editAttributes() ?>>
</span>
<?php echo $tasks_add->PercentComplete->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tasks_add->Dependencies->Visible) { // Dependencies ?>
	<div id="r_Dependencies" class="form-group row">
		<label id="elh_tasks_Dependencies" for="x_Dependencies" class="<?php echo $tasks_add->LeftColumnClass ?>"><?php echo $tasks_add->Dependencies->caption() ?><?php echo $tasks_add->Dependencies->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tasks_add->RightColumnClass ?>"><div <?php echo $tasks_add->Dependencies->cellAttributes() ?>>
<span id="el_tasks_Dependencies">
<input type="text" data-table="tasks" data-field="x_Dependencies" name="x_Dependencies" id="x_Dependencies" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tasks_add->Dependencies->getPlaceHolder()) ?>" value="<?php echo $tasks_add->Dependencies->EditValue ?>"<?php echo $tasks_add->Dependencies->editAttributes() ?>>
</span>
<?php echo $tasks_add->Dependencies->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tasks_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tasks_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tasks_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tasks_add->showPageFooter();
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
$tasks_add->terminate();
?>