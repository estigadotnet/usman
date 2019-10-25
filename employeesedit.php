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
$employees_edit = new employees_edit();

// Run the page
$employees_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employees_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployeesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	femployeesedit = currentForm = new ew.Form("femployeesedit", "edit");

	// Validate form
	femployeesedit.validate = function() {
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
			<?php if ($employees_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->EmployeeID->caption(), $employees_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->LastName->Required) { ?>
				elm = this.getElements("x" + infix + "_LastName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->LastName->caption(), $employees_edit->LastName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->FirstName->caption(), $employees_edit->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->Title->Required) { ?>
				elm = this.getElements("x" + infix + "_Title");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->Title->caption(), $employees_edit->Title->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->TitleOfCourtesy->Required) { ?>
				elm = this.getElements("x" + infix + "_TitleOfCourtesy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->TitleOfCourtesy->caption(), $employees_edit->TitleOfCourtesy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->BirthDate->Required) { ?>
				elm = this.getElements("x" + infix + "_BirthDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->BirthDate->caption(), $employees_edit->BirthDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BirthDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employees_edit->BirthDate->errorMessage()) ?>");
			<?php if ($employees_edit->HireDate->Required) { ?>
				elm = this.getElements("x" + infix + "_HireDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->HireDate->caption(), $employees_edit->HireDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_HireDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employees_edit->HireDate->errorMessage()) ?>");
			<?php if ($employees_edit->Address->Required) { ?>
				elm = this.getElements("x" + infix + "_Address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->Address->caption(), $employees_edit->Address->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->City->Required) { ?>
				elm = this.getElements("x" + infix + "_City");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->City->caption(), $employees_edit->City->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->Region->Required) { ?>
				elm = this.getElements("x" + infix + "_Region");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->Region->caption(), $employees_edit->Region->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->PostalCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PostalCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->PostalCode->caption(), $employees_edit->PostalCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->Country->Required) { ?>
				elm = this.getElements("x" + infix + "_Country");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->Country->caption(), $employees_edit->Country->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->HomePhone->Required) { ?>
				elm = this.getElements("x" + infix + "_HomePhone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->HomePhone->caption(), $employees_edit->HomePhone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->Extension->Required) { ?>
				elm = this.getElements("x" + infix + "_Extension");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->Extension->caption(), $employees_edit->Extension->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->_Email->caption(), $employees_edit->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->Photo->Required) { ?>
				elm = this.getElements("x" + infix + "_Photo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->Photo->caption(), $employees_edit->Photo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->Notes->Required) { ?>
				elm = this.getElements("x" + infix + "_Notes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->Notes->caption(), $employees_edit->Notes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->ReportsTo->Required) { ?>
				elm = this.getElements("x" + infix + "_ReportsTo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->ReportsTo->caption(), $employees_edit->ReportsTo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ReportsTo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employees_edit->ReportsTo->errorMessage()) ?>");
			<?php if ($employees_edit->Password->Required) { ?>
				elm = this.getElements("x" + infix + "_Password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->Password->caption(), $employees_edit->Password->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->UserLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_UserLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->UserLevel->caption(), $employees_edit->UserLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->Username->Required) { ?>
				elm = this.getElements("x" + infix + "_Username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->Username->caption(), $employees_edit->Username->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->Activated->Required) { ?>
				elm = this.getElements("x" + infix + "_Activated[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->Activated->caption(), $employees_edit->Activated->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_edit->Profile->Required) { ?>
				elm = this.getElements("x" + infix + "_Profile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_edit->Profile->caption(), $employees_edit->Profile->RequiredErrorMessage)) ?>");
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
	femployeesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployeesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployeesedit.lists["x_UserLevel"] = <?php echo $employees_edit->UserLevel->Lookup->toClientList($employees_edit) ?>;
	femployeesedit.lists["x_UserLevel"].options = <?php echo JsonEncode($employees_edit->UserLevel->lookupOptions()) ?>;
	femployeesedit.lists["x_Activated[]"] = <?php echo $employees_edit->Activated->Lookup->toClientList($employees_edit) ?>;
	femployeesedit.lists["x_Activated[]"].options = <?php echo JsonEncode($employees_edit->Activated->options(FALSE, TRUE)) ?>;
	loadjs.done("femployeesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employees_edit->showPageHeader(); ?>
<?php
$employees_edit->showMessage();
?>
<form name="femployeesedit" id="femployeesedit" class="<?php echo $employees_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employees">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$employees_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($employees_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_employees_EmployeeID" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->EmployeeID->caption() ?><?php echo $employees_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->EmployeeID->cellAttributes() ?>>
<span id="el_employees_EmployeeID">
<span<?php echo $employees_edit->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employees_edit->EmployeeID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="employees" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" value="<?php echo HtmlEncode($employees_edit->EmployeeID->CurrentValue) ?>">
<?php echo $employees_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->LastName->Visible) { // LastName ?>
	<div id="r_LastName" class="form-group row">
		<label id="elh_employees_LastName" for="x_LastName" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->LastName->caption() ?><?php echo $employees_edit->LastName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->LastName->cellAttributes() ?>>
<span id="el_employees_LastName">
<input type="text" data-table="employees" data-field="x_LastName" name="x_LastName" id="x_LastName" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($employees_edit->LastName->getPlaceHolder()) ?>" value="<?php echo $employees_edit->LastName->EditValue ?>"<?php echo $employees_edit->LastName->editAttributes() ?>>
</span>
<?php echo $employees_edit->LastName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label id="elh_employees_FirstName" for="x_FirstName" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->FirstName->caption() ?><?php echo $employees_edit->FirstName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->FirstName->cellAttributes() ?>>
<span id="el_employees_FirstName">
<input type="text" data-table="employees" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employees_edit->FirstName->getPlaceHolder()) ?>" value="<?php echo $employees_edit->FirstName->EditValue ?>"<?php echo $employees_edit->FirstName->editAttributes() ?>>
</span>
<?php echo $employees_edit->FirstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->Title->Visible) { // Title ?>
	<div id="r_Title" class="form-group row">
		<label id="elh_employees_Title" for="x_Title" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->Title->caption() ?><?php echo $employees_edit->Title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->Title->cellAttributes() ?>>
<span id="el_employees_Title">
<input type="text" data-table="employees" data-field="x_Title" name="x_Title" id="x_Title" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($employees_edit->Title->getPlaceHolder()) ?>" value="<?php echo $employees_edit->Title->EditValue ?>"<?php echo $employees_edit->Title->editAttributes() ?>>
</span>
<?php echo $employees_edit->Title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->TitleOfCourtesy->Visible) { // TitleOfCourtesy ?>
	<div id="r_TitleOfCourtesy" class="form-group row">
		<label id="elh_employees_TitleOfCourtesy" for="x_TitleOfCourtesy" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->TitleOfCourtesy->caption() ?><?php echo $employees_edit->TitleOfCourtesy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->TitleOfCourtesy->cellAttributes() ?>>
<span id="el_employees_TitleOfCourtesy">
<input type="text" data-table="employees" data-field="x_TitleOfCourtesy" name="x_TitleOfCourtesy" id="x_TitleOfCourtesy" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($employees_edit->TitleOfCourtesy->getPlaceHolder()) ?>" value="<?php echo $employees_edit->TitleOfCourtesy->EditValue ?>"<?php echo $employees_edit->TitleOfCourtesy->editAttributes() ?>>
</span>
<?php echo $employees_edit->TitleOfCourtesy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->BirthDate->Visible) { // BirthDate ?>
	<div id="r_BirthDate" class="form-group row">
		<label id="elh_employees_BirthDate" for="x_BirthDate" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->BirthDate->caption() ?><?php echo $employees_edit->BirthDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->BirthDate->cellAttributes() ?>>
<span id="el_employees_BirthDate">
<input type="text" data-table="employees" data-field="x_BirthDate" name="x_BirthDate" id="x_BirthDate" maxlength="19" placeholder="<?php echo HtmlEncode($employees_edit->BirthDate->getPlaceHolder()) ?>" value="<?php echo $employees_edit->BirthDate->EditValue ?>"<?php echo $employees_edit->BirthDate->editAttributes() ?>>
<?php if (!$employees_edit->BirthDate->ReadOnly && !$employees_edit->BirthDate->Disabled && !isset($employees_edit->BirthDate->EditAttrs["readonly"]) && !isset($employees_edit->BirthDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployeesedit", "datetimepicker"], function() {
	ew.createDateTimePicker("femployeesedit", "x_BirthDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employees_edit->BirthDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->HireDate->Visible) { // HireDate ?>
	<div id="r_HireDate" class="form-group row">
		<label id="elh_employees_HireDate" for="x_HireDate" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->HireDate->caption() ?><?php echo $employees_edit->HireDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->HireDate->cellAttributes() ?>>
<span id="el_employees_HireDate">
<input type="text" data-table="employees" data-field="x_HireDate" name="x_HireDate" id="x_HireDate" maxlength="19" placeholder="<?php echo HtmlEncode($employees_edit->HireDate->getPlaceHolder()) ?>" value="<?php echo $employees_edit->HireDate->EditValue ?>"<?php echo $employees_edit->HireDate->editAttributes() ?>>
<?php if (!$employees_edit->HireDate->ReadOnly && !$employees_edit->HireDate->Disabled && !isset($employees_edit->HireDate->EditAttrs["readonly"]) && !isset($employees_edit->HireDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployeesedit", "datetimepicker"], function() {
	ew.createDateTimePicker("femployeesedit", "x_HireDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employees_edit->HireDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->Address->Visible) { // Address ?>
	<div id="r_Address" class="form-group row">
		<label id="elh_employees_Address" for="x_Address" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->Address->caption() ?><?php echo $employees_edit->Address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->Address->cellAttributes() ?>>
<span id="el_employees_Address">
<input type="text" data-table="employees" data-field="x_Address" name="x_Address" id="x_Address" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($employees_edit->Address->getPlaceHolder()) ?>" value="<?php echo $employees_edit->Address->EditValue ?>"<?php echo $employees_edit->Address->editAttributes() ?>>
</span>
<?php echo $employees_edit->Address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->City->Visible) { // City ?>
	<div id="r_City" class="form-group row">
		<label id="elh_employees_City" for="x_City" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->City->caption() ?><?php echo $employees_edit->City->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->City->cellAttributes() ?>>
<span id="el_employees_City">
<input type="text" data-table="employees" data-field="x_City" name="x_City" id="x_City" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employees_edit->City->getPlaceHolder()) ?>" value="<?php echo $employees_edit->City->EditValue ?>"<?php echo $employees_edit->City->editAttributes() ?>>
</span>
<?php echo $employees_edit->City->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->Region->Visible) { // Region ?>
	<div id="r_Region" class="form-group row">
		<label id="elh_employees_Region" for="x_Region" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->Region->caption() ?><?php echo $employees_edit->Region->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->Region->cellAttributes() ?>>
<span id="el_employees_Region">
<input type="text" data-table="employees" data-field="x_Region" name="x_Region" id="x_Region" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employees_edit->Region->getPlaceHolder()) ?>" value="<?php echo $employees_edit->Region->EditValue ?>"<?php echo $employees_edit->Region->editAttributes() ?>>
</span>
<?php echo $employees_edit->Region->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->PostalCode->Visible) { // PostalCode ?>
	<div id="r_PostalCode" class="form-group row">
		<label id="elh_employees_PostalCode" for="x_PostalCode" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->PostalCode->caption() ?><?php echo $employees_edit->PostalCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->PostalCode->cellAttributes() ?>>
<span id="el_employees_PostalCode">
<input type="text" data-table="employees" data-field="x_PostalCode" name="x_PostalCode" id="x_PostalCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employees_edit->PostalCode->getPlaceHolder()) ?>" value="<?php echo $employees_edit->PostalCode->EditValue ?>"<?php echo $employees_edit->PostalCode->editAttributes() ?>>
</span>
<?php echo $employees_edit->PostalCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->Country->Visible) { // Country ?>
	<div id="r_Country" class="form-group row">
		<label id="elh_employees_Country" for="x_Country" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->Country->caption() ?><?php echo $employees_edit->Country->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->Country->cellAttributes() ?>>
<span id="el_employees_Country">
<input type="text" data-table="employees" data-field="x_Country" name="x_Country" id="x_Country" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employees_edit->Country->getPlaceHolder()) ?>" value="<?php echo $employees_edit->Country->EditValue ?>"<?php echo $employees_edit->Country->editAttributes() ?>>
</span>
<?php echo $employees_edit->Country->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->HomePhone->Visible) { // HomePhone ?>
	<div id="r_HomePhone" class="form-group row">
		<label id="elh_employees_HomePhone" for="x_HomePhone" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->HomePhone->caption() ?><?php echo $employees_edit->HomePhone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->HomePhone->cellAttributes() ?>>
<span id="el_employees_HomePhone">
<input type="text" data-table="employees" data-field="x_HomePhone" name="x_HomePhone" id="x_HomePhone" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($employees_edit->HomePhone->getPlaceHolder()) ?>" value="<?php echo $employees_edit->HomePhone->EditValue ?>"<?php echo $employees_edit->HomePhone->editAttributes() ?>>
</span>
<?php echo $employees_edit->HomePhone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->Extension->Visible) { // Extension ?>
	<div id="r_Extension" class="form-group row">
		<label id="elh_employees_Extension" for="x_Extension" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->Extension->caption() ?><?php echo $employees_edit->Extension->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->Extension->cellAttributes() ?>>
<span id="el_employees_Extension">
<input type="text" data-table="employees" data-field="x_Extension" name="x_Extension" id="x_Extension" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($employees_edit->Extension->getPlaceHolder()) ?>" value="<?php echo $employees_edit->Extension->EditValue ?>"<?php echo $employees_edit->Extension->editAttributes() ?>>
</span>
<?php echo $employees_edit->Extension->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_employees__Email" for="x__Email" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->_Email->caption() ?><?php echo $employees_edit->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->_Email->cellAttributes() ?>>
<span id="el_employees__Email">
<input type="text" data-table="employees" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($employees_edit->_Email->getPlaceHolder()) ?>" value="<?php echo $employees_edit->_Email->EditValue ?>"<?php echo $employees_edit->_Email->editAttributes() ?>>
</span>
<?php echo $employees_edit->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->Photo->Visible) { // Photo ?>
	<div id="r_Photo" class="form-group row">
		<label id="elh_employees_Photo" for="x_Photo" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->Photo->caption() ?><?php echo $employees_edit->Photo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->Photo->cellAttributes() ?>>
<span id="el_employees_Photo">
<input type="text" data-table="employees" data-field="x_Photo" name="x_Photo" id="x_Photo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($employees_edit->Photo->getPlaceHolder()) ?>" value="<?php echo $employees_edit->Photo->EditValue ?>"<?php echo $employees_edit->Photo->editAttributes() ?>>
</span>
<?php echo $employees_edit->Photo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->Notes->Visible) { // Notes ?>
	<div id="r_Notes" class="form-group row">
		<label id="elh_employees_Notes" for="x_Notes" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->Notes->caption() ?><?php echo $employees_edit->Notes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->Notes->cellAttributes() ?>>
<span id="el_employees_Notes">
<textarea data-table="employees" data-field="x_Notes" name="x_Notes" id="x_Notes" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employees_edit->Notes->getPlaceHolder()) ?>"<?php echo $employees_edit->Notes->editAttributes() ?>><?php echo $employees_edit->Notes->EditValue ?></textarea>
</span>
<?php echo $employees_edit->Notes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->ReportsTo->Visible) { // ReportsTo ?>
	<div id="r_ReportsTo" class="form-group row">
		<label id="elh_employees_ReportsTo" for="x_ReportsTo" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->ReportsTo->caption() ?><?php echo $employees_edit->ReportsTo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->ReportsTo->cellAttributes() ?>>
<span id="el_employees_ReportsTo">
<input type="text" data-table="employees" data-field="x_ReportsTo" name="x_ReportsTo" id="x_ReportsTo" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($employees_edit->ReportsTo->getPlaceHolder()) ?>" value="<?php echo $employees_edit->ReportsTo->EditValue ?>"<?php echo $employees_edit->ReportsTo->editAttributes() ?>>
</span>
<?php echo $employees_edit->ReportsTo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->Password->Visible) { // Password ?>
	<div id="r_Password" class="form-group row">
		<label id="elh_employees_Password" for="x_Password" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->Password->caption() ?><?php echo $employees_edit->Password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->Password->cellAttributes() ?>>
<span id="el_employees_Password">
<input type="text" data-table="employees" data-field="x_Password" name="x_Password" id="x_Password" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employees_edit->Password->getPlaceHolder()) ?>" value="<?php echo $employees_edit->Password->EditValue ?>"<?php echo $employees_edit->Password->editAttributes() ?>>
</span>
<?php echo $employees_edit->Password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->UserLevel->Visible) { // UserLevel ?>
	<div id="r_UserLevel" class="form-group row">
		<label id="elh_employees_UserLevel" for="x_UserLevel" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->UserLevel->caption() ?><?php echo $employees_edit->UserLevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->UserLevel->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_employees_UserLevel">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employees_edit->UserLevel->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el_employees_UserLevel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employees" data-field="x_UserLevel" data-value-separator="<?php echo $employees_edit->UserLevel->displayValueSeparatorAttribute() ?>" id="x_UserLevel" name="x_UserLevel"<?php echo $employees_edit->UserLevel->editAttributes() ?>>
			<?php echo $employees_edit->UserLevel->selectOptionListHtml("x_UserLevel") ?>
		</select>
</div>
<?php echo $employees_edit->UserLevel->Lookup->getParamTag($employees_edit, "p_x_UserLevel") ?>
</span>
<?php } ?>
<?php echo $employees_edit->UserLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->Username->Visible) { // Username ?>
	<div id="r_Username" class="form-group row">
		<label id="elh_employees_Username" for="x_Username" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->Username->caption() ?><?php echo $employees_edit->Username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->Username->cellAttributes() ?>>
<span id="el_employees_Username">
<input type="text" data-table="employees" data-field="x_Username" name="x_Username" id="x_Username" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($employees_edit->Username->getPlaceHolder()) ?>" value="<?php echo $employees_edit->Username->EditValue ?>"<?php echo $employees_edit->Username->editAttributes() ?>>
</span>
<?php echo $employees_edit->Username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->Activated->Visible) { // Activated ?>
	<div id="r_Activated" class="form-group row">
		<label id="elh_employees_Activated" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->Activated->caption() ?><?php echo $employees_edit->Activated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->Activated->cellAttributes() ?>>
<span id="el_employees_Activated">
<?php
$selwrk = ConvertToBool($employees_edit->Activated->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="employees" data-field="x_Activated" name="x_Activated[]" id="x_Activated[]" value="1"<?php echo $selwrk ?><?php echo $employees_edit->Activated->editAttributes() ?>>
	<label class="custom-control-label" for="x_Activated[]"></label>
</div>
</span>
<?php echo $employees_edit->Activated->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_edit->Profile->Visible) { // Profile ?>
	<div id="r_Profile" class="form-group row">
		<label id="elh_employees_Profile" for="x_Profile" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees_edit->Profile->caption() ?><?php echo $employees_edit->Profile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div <?php echo $employees_edit->Profile->cellAttributes() ?>>
<span id="el_employees_Profile">
<textarea data-table="employees" data-field="x_Profile" name="x_Profile" id="x_Profile" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employees_edit->Profile->getPlaceHolder()) ?>"<?php echo $employees_edit->Profile->editAttributes() ?>><?php echo $employees_edit->Profile->EditValue ?></textarea>
</span>
<?php echo $employees_edit->Profile->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employees_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employees_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employees_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$employees_edit->showPageFooter();
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
$employees_edit->terminate();
?>