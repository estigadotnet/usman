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
$employees_add = new employees_add();

// Run the page
$employees_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employees_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployeesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	femployeesadd = currentForm = new ew.Form("femployeesadd", "add");

	// Validate form
	femployeesadd.validate = function() {
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
			<?php if ($employees_add->LastName->Required) { ?>
				elm = this.getElements("x" + infix + "_LastName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->LastName->caption(), $employees_add->LastName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_add->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->FirstName->caption(), $employees_add->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_add->Title->Required) { ?>
				elm = this.getElements("x" + infix + "_Title");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->Title->caption(), $employees_add->Title->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_add->TitleOfCourtesy->Required) { ?>
				elm = this.getElements("x" + infix + "_TitleOfCourtesy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->TitleOfCourtesy->caption(), $employees_add->TitleOfCourtesy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_add->BirthDate->Required) { ?>
				elm = this.getElements("x" + infix + "_BirthDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->BirthDate->caption(), $employees_add->BirthDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BirthDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employees_add->BirthDate->errorMessage()) ?>");
			<?php if ($employees_add->HireDate->Required) { ?>
				elm = this.getElements("x" + infix + "_HireDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->HireDate->caption(), $employees_add->HireDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_HireDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employees_add->HireDate->errorMessage()) ?>");
			<?php if ($employees_add->Address->Required) { ?>
				elm = this.getElements("x" + infix + "_Address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->Address->caption(), $employees_add->Address->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_add->City->Required) { ?>
				elm = this.getElements("x" + infix + "_City");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->City->caption(), $employees_add->City->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_add->Region->Required) { ?>
				elm = this.getElements("x" + infix + "_Region");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->Region->caption(), $employees_add->Region->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_add->PostalCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PostalCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->PostalCode->caption(), $employees_add->PostalCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_add->Country->Required) { ?>
				elm = this.getElements("x" + infix + "_Country");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->Country->caption(), $employees_add->Country->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_add->HomePhone->Required) { ?>
				elm = this.getElements("x" + infix + "_HomePhone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->HomePhone->caption(), $employees_add->HomePhone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_add->Extension->Required) { ?>
				elm = this.getElements("x" + infix + "_Extension");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->Extension->caption(), $employees_add->Extension->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_add->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->_Email->caption(), $employees_add->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_add->Photo->Required) { ?>
				elm = this.getElements("x" + infix + "_Photo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->Photo->caption(), $employees_add->Photo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_add->Notes->Required) { ?>
				elm = this.getElements("x" + infix + "_Notes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->Notes->caption(), $employees_add->Notes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_add->ReportsTo->Required) { ?>
				elm = this.getElements("x" + infix + "_ReportsTo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->ReportsTo->caption(), $employees_add->ReportsTo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ReportsTo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employees_add->ReportsTo->errorMessage()) ?>");
			<?php if ($employees_add->Password->Required) { ?>
				elm = this.getElements("x" + infix + "_Password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->Password->caption(), $employees_add->Password->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_add->UserLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_UserLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->UserLevel->caption(), $employees_add->UserLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_add->Username->Required) { ?>
				elm = this.getElements("x" + infix + "_Username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->Username->caption(), $employees_add->Username->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_add->Activated->Required) { ?>
				elm = this.getElements("x" + infix + "_Activated[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->Activated->caption(), $employees_add->Activated->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employees_add->Profile->Required) { ?>
				elm = this.getElements("x" + infix + "_Profile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees_add->Profile->caption(), $employees_add->Profile->RequiredErrorMessage)) ?>");
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
	femployeesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployeesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployeesadd.lists["x_UserLevel"] = <?php echo $employees_add->UserLevel->Lookup->toClientList($employees_add) ?>;
	femployeesadd.lists["x_UserLevel"].options = <?php echo JsonEncode($employees_add->UserLevel->lookupOptions()) ?>;
	femployeesadd.lists["x_Activated[]"] = <?php echo $employees_add->Activated->Lookup->toClientList($employees_add) ?>;
	femployeesadd.lists["x_Activated[]"].options = <?php echo JsonEncode($employees_add->Activated->options(FALSE, TRUE)) ?>;
	loadjs.done("femployeesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employees_add->showPageHeader(); ?>
<?php
$employees_add->showMessage();
?>
<form name="femployeesadd" id="femployeesadd" class="<?php echo $employees_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employees">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$employees_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($employees_add->LastName->Visible) { // LastName ?>
	<div id="r_LastName" class="form-group row">
		<label id="elh_employees_LastName" for="x_LastName" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->LastName->caption() ?><?php echo $employees_add->LastName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->LastName->cellAttributes() ?>>
<span id="el_employees_LastName">
<input type="text" data-table="employees" data-field="x_LastName" name="x_LastName" id="x_LastName" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($employees_add->LastName->getPlaceHolder()) ?>" value="<?php echo $employees_add->LastName->EditValue ?>"<?php echo $employees_add->LastName->editAttributes() ?>>
</span>
<?php echo $employees_add->LastName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label id="elh_employees_FirstName" for="x_FirstName" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->FirstName->caption() ?><?php echo $employees_add->FirstName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->FirstName->cellAttributes() ?>>
<span id="el_employees_FirstName">
<input type="text" data-table="employees" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employees_add->FirstName->getPlaceHolder()) ?>" value="<?php echo $employees_add->FirstName->EditValue ?>"<?php echo $employees_add->FirstName->editAttributes() ?>>
</span>
<?php echo $employees_add->FirstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->Title->Visible) { // Title ?>
	<div id="r_Title" class="form-group row">
		<label id="elh_employees_Title" for="x_Title" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->Title->caption() ?><?php echo $employees_add->Title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->Title->cellAttributes() ?>>
<span id="el_employees_Title">
<input type="text" data-table="employees" data-field="x_Title" name="x_Title" id="x_Title" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($employees_add->Title->getPlaceHolder()) ?>" value="<?php echo $employees_add->Title->EditValue ?>"<?php echo $employees_add->Title->editAttributes() ?>>
</span>
<?php echo $employees_add->Title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->TitleOfCourtesy->Visible) { // TitleOfCourtesy ?>
	<div id="r_TitleOfCourtesy" class="form-group row">
		<label id="elh_employees_TitleOfCourtesy" for="x_TitleOfCourtesy" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->TitleOfCourtesy->caption() ?><?php echo $employees_add->TitleOfCourtesy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->TitleOfCourtesy->cellAttributes() ?>>
<span id="el_employees_TitleOfCourtesy">
<input type="text" data-table="employees" data-field="x_TitleOfCourtesy" name="x_TitleOfCourtesy" id="x_TitleOfCourtesy" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($employees_add->TitleOfCourtesy->getPlaceHolder()) ?>" value="<?php echo $employees_add->TitleOfCourtesy->EditValue ?>"<?php echo $employees_add->TitleOfCourtesy->editAttributes() ?>>
</span>
<?php echo $employees_add->TitleOfCourtesy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->BirthDate->Visible) { // BirthDate ?>
	<div id="r_BirthDate" class="form-group row">
		<label id="elh_employees_BirthDate" for="x_BirthDate" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->BirthDate->caption() ?><?php echo $employees_add->BirthDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->BirthDate->cellAttributes() ?>>
<span id="el_employees_BirthDate">
<input type="text" data-table="employees" data-field="x_BirthDate" name="x_BirthDate" id="x_BirthDate" maxlength="19" placeholder="<?php echo HtmlEncode($employees_add->BirthDate->getPlaceHolder()) ?>" value="<?php echo $employees_add->BirthDate->EditValue ?>"<?php echo $employees_add->BirthDate->editAttributes() ?>>
<?php if (!$employees_add->BirthDate->ReadOnly && !$employees_add->BirthDate->Disabled && !isset($employees_add->BirthDate->EditAttrs["readonly"]) && !isset($employees_add->BirthDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployeesadd", "datetimepicker"], function() {
	ew.createDateTimePicker("femployeesadd", "x_BirthDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employees_add->BirthDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->HireDate->Visible) { // HireDate ?>
	<div id="r_HireDate" class="form-group row">
		<label id="elh_employees_HireDate" for="x_HireDate" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->HireDate->caption() ?><?php echo $employees_add->HireDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->HireDate->cellAttributes() ?>>
<span id="el_employees_HireDate">
<input type="text" data-table="employees" data-field="x_HireDate" name="x_HireDate" id="x_HireDate" maxlength="19" placeholder="<?php echo HtmlEncode($employees_add->HireDate->getPlaceHolder()) ?>" value="<?php echo $employees_add->HireDate->EditValue ?>"<?php echo $employees_add->HireDate->editAttributes() ?>>
<?php if (!$employees_add->HireDate->ReadOnly && !$employees_add->HireDate->Disabled && !isset($employees_add->HireDate->EditAttrs["readonly"]) && !isset($employees_add->HireDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployeesadd", "datetimepicker"], function() {
	ew.createDateTimePicker("femployeesadd", "x_HireDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employees_add->HireDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->Address->Visible) { // Address ?>
	<div id="r_Address" class="form-group row">
		<label id="elh_employees_Address" for="x_Address" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->Address->caption() ?><?php echo $employees_add->Address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->Address->cellAttributes() ?>>
<span id="el_employees_Address">
<input type="text" data-table="employees" data-field="x_Address" name="x_Address" id="x_Address" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($employees_add->Address->getPlaceHolder()) ?>" value="<?php echo $employees_add->Address->EditValue ?>"<?php echo $employees_add->Address->editAttributes() ?>>
</span>
<?php echo $employees_add->Address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->City->Visible) { // City ?>
	<div id="r_City" class="form-group row">
		<label id="elh_employees_City" for="x_City" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->City->caption() ?><?php echo $employees_add->City->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->City->cellAttributes() ?>>
<span id="el_employees_City">
<input type="text" data-table="employees" data-field="x_City" name="x_City" id="x_City" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employees_add->City->getPlaceHolder()) ?>" value="<?php echo $employees_add->City->EditValue ?>"<?php echo $employees_add->City->editAttributes() ?>>
</span>
<?php echo $employees_add->City->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->Region->Visible) { // Region ?>
	<div id="r_Region" class="form-group row">
		<label id="elh_employees_Region" for="x_Region" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->Region->caption() ?><?php echo $employees_add->Region->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->Region->cellAttributes() ?>>
<span id="el_employees_Region">
<input type="text" data-table="employees" data-field="x_Region" name="x_Region" id="x_Region" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employees_add->Region->getPlaceHolder()) ?>" value="<?php echo $employees_add->Region->EditValue ?>"<?php echo $employees_add->Region->editAttributes() ?>>
</span>
<?php echo $employees_add->Region->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->PostalCode->Visible) { // PostalCode ?>
	<div id="r_PostalCode" class="form-group row">
		<label id="elh_employees_PostalCode" for="x_PostalCode" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->PostalCode->caption() ?><?php echo $employees_add->PostalCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->PostalCode->cellAttributes() ?>>
<span id="el_employees_PostalCode">
<input type="text" data-table="employees" data-field="x_PostalCode" name="x_PostalCode" id="x_PostalCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employees_add->PostalCode->getPlaceHolder()) ?>" value="<?php echo $employees_add->PostalCode->EditValue ?>"<?php echo $employees_add->PostalCode->editAttributes() ?>>
</span>
<?php echo $employees_add->PostalCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->Country->Visible) { // Country ?>
	<div id="r_Country" class="form-group row">
		<label id="elh_employees_Country" for="x_Country" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->Country->caption() ?><?php echo $employees_add->Country->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->Country->cellAttributes() ?>>
<span id="el_employees_Country">
<input type="text" data-table="employees" data-field="x_Country" name="x_Country" id="x_Country" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employees_add->Country->getPlaceHolder()) ?>" value="<?php echo $employees_add->Country->EditValue ?>"<?php echo $employees_add->Country->editAttributes() ?>>
</span>
<?php echo $employees_add->Country->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->HomePhone->Visible) { // HomePhone ?>
	<div id="r_HomePhone" class="form-group row">
		<label id="elh_employees_HomePhone" for="x_HomePhone" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->HomePhone->caption() ?><?php echo $employees_add->HomePhone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->HomePhone->cellAttributes() ?>>
<span id="el_employees_HomePhone">
<input type="text" data-table="employees" data-field="x_HomePhone" name="x_HomePhone" id="x_HomePhone" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($employees_add->HomePhone->getPlaceHolder()) ?>" value="<?php echo $employees_add->HomePhone->EditValue ?>"<?php echo $employees_add->HomePhone->editAttributes() ?>>
</span>
<?php echo $employees_add->HomePhone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->Extension->Visible) { // Extension ?>
	<div id="r_Extension" class="form-group row">
		<label id="elh_employees_Extension" for="x_Extension" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->Extension->caption() ?><?php echo $employees_add->Extension->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->Extension->cellAttributes() ?>>
<span id="el_employees_Extension">
<input type="text" data-table="employees" data-field="x_Extension" name="x_Extension" id="x_Extension" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($employees_add->Extension->getPlaceHolder()) ?>" value="<?php echo $employees_add->Extension->EditValue ?>"<?php echo $employees_add->Extension->editAttributes() ?>>
</span>
<?php echo $employees_add->Extension->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_employees__Email" for="x__Email" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->_Email->caption() ?><?php echo $employees_add->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->_Email->cellAttributes() ?>>
<span id="el_employees__Email">
<input type="text" data-table="employees" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($employees_add->_Email->getPlaceHolder()) ?>" value="<?php echo $employees_add->_Email->EditValue ?>"<?php echo $employees_add->_Email->editAttributes() ?>>
</span>
<?php echo $employees_add->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->Photo->Visible) { // Photo ?>
	<div id="r_Photo" class="form-group row">
		<label id="elh_employees_Photo" for="x_Photo" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->Photo->caption() ?><?php echo $employees_add->Photo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->Photo->cellAttributes() ?>>
<span id="el_employees_Photo">
<input type="text" data-table="employees" data-field="x_Photo" name="x_Photo" id="x_Photo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($employees_add->Photo->getPlaceHolder()) ?>" value="<?php echo $employees_add->Photo->EditValue ?>"<?php echo $employees_add->Photo->editAttributes() ?>>
</span>
<?php echo $employees_add->Photo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->Notes->Visible) { // Notes ?>
	<div id="r_Notes" class="form-group row">
		<label id="elh_employees_Notes" for="x_Notes" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->Notes->caption() ?><?php echo $employees_add->Notes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->Notes->cellAttributes() ?>>
<span id="el_employees_Notes">
<textarea data-table="employees" data-field="x_Notes" name="x_Notes" id="x_Notes" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employees_add->Notes->getPlaceHolder()) ?>"<?php echo $employees_add->Notes->editAttributes() ?>><?php echo $employees_add->Notes->EditValue ?></textarea>
</span>
<?php echo $employees_add->Notes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->ReportsTo->Visible) { // ReportsTo ?>
	<div id="r_ReportsTo" class="form-group row">
		<label id="elh_employees_ReportsTo" for="x_ReportsTo" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->ReportsTo->caption() ?><?php echo $employees_add->ReportsTo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->ReportsTo->cellAttributes() ?>>
<span id="el_employees_ReportsTo">
<input type="text" data-table="employees" data-field="x_ReportsTo" name="x_ReportsTo" id="x_ReportsTo" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($employees_add->ReportsTo->getPlaceHolder()) ?>" value="<?php echo $employees_add->ReportsTo->EditValue ?>"<?php echo $employees_add->ReportsTo->editAttributes() ?>>
</span>
<?php echo $employees_add->ReportsTo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->Password->Visible) { // Password ?>
	<div id="r_Password" class="form-group row">
		<label id="elh_employees_Password" for="x_Password" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->Password->caption() ?><?php echo $employees_add->Password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->Password->cellAttributes() ?>>
<span id="el_employees_Password">
<input type="text" data-table="employees" data-field="x_Password" name="x_Password" id="x_Password" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employees_add->Password->getPlaceHolder()) ?>" value="<?php echo $employees_add->Password->EditValue ?>"<?php echo $employees_add->Password->editAttributes() ?>>
</span>
<?php echo $employees_add->Password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->UserLevel->Visible) { // UserLevel ?>
	<div id="r_UserLevel" class="form-group row">
		<label id="elh_employees_UserLevel" for="x_UserLevel" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->UserLevel->caption() ?><?php echo $employees_add->UserLevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->UserLevel->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_employees_UserLevel">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employees_add->UserLevel->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el_employees_UserLevel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employees" data-field="x_UserLevel" data-value-separator="<?php echo $employees_add->UserLevel->displayValueSeparatorAttribute() ?>" id="x_UserLevel" name="x_UserLevel"<?php echo $employees_add->UserLevel->editAttributes() ?>>
			<?php echo $employees_add->UserLevel->selectOptionListHtml("x_UserLevel") ?>
		</select>
</div>
<?php echo $employees_add->UserLevel->Lookup->getParamTag($employees_add, "p_x_UserLevel") ?>
</span>
<?php } ?>
<?php echo $employees_add->UserLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->Username->Visible) { // Username ?>
	<div id="r_Username" class="form-group row">
		<label id="elh_employees_Username" for="x_Username" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->Username->caption() ?><?php echo $employees_add->Username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->Username->cellAttributes() ?>>
<span id="el_employees_Username">
<input type="text" data-table="employees" data-field="x_Username" name="x_Username" id="x_Username" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($employees_add->Username->getPlaceHolder()) ?>" value="<?php echo $employees_add->Username->EditValue ?>"<?php echo $employees_add->Username->editAttributes() ?>>
</span>
<?php echo $employees_add->Username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->Activated->Visible) { // Activated ?>
	<div id="r_Activated" class="form-group row">
		<label id="elh_employees_Activated" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->Activated->caption() ?><?php echo $employees_add->Activated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->Activated->cellAttributes() ?>>
<span id="el_employees_Activated">
<?php
$selwrk = ConvertToBool($employees_add->Activated->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="employees" data-field="x_Activated" name="x_Activated[]" id="x_Activated[]" value="1"<?php echo $selwrk ?><?php echo $employees_add->Activated->editAttributes() ?>>
	<label class="custom-control-label" for="x_Activated[]"></label>
</div>
</span>
<?php echo $employees_add->Activated->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees_add->Profile->Visible) { // Profile ?>
	<div id="r_Profile" class="form-group row">
		<label id="elh_employees_Profile" for="x_Profile" class="<?php echo $employees_add->LeftColumnClass ?>"><?php echo $employees_add->Profile->caption() ?><?php echo $employees_add->Profile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_add->RightColumnClass ?>"><div <?php echo $employees_add->Profile->cellAttributes() ?>>
<span id="el_employees_Profile">
<textarea data-table="employees" data-field="x_Profile" name="x_Profile" id="x_Profile" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employees_add->Profile->getPlaceHolder()) ?>"<?php echo $employees_add->Profile->editAttributes() ?>><?php echo $employees_add->Profile->EditValue ?></textarea>
</span>
<?php echo $employees_add->Profile->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employees_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employees_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employees_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$employees_add->showPageFooter();
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
$employees_add->terminate();
?>