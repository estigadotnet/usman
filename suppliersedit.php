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
$suppliers_edit = new suppliers_edit();

// Run the page
$suppliers_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$suppliers_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsuppliersedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fsuppliersedit = currentForm = new ew.Form("fsuppliersedit", "edit");

	// Validate form
	fsuppliersedit.validate = function() {
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
			<?php if ($suppliers_edit->SupplierID->Required) { ?>
				elm = this.getElements("x" + infix + "_SupplierID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_edit->SupplierID->caption(), $suppliers_edit->SupplierID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_edit->CompanyName->Required) { ?>
				elm = this.getElements("x" + infix + "_CompanyName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_edit->CompanyName->caption(), $suppliers_edit->CompanyName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_edit->ContactName->Required) { ?>
				elm = this.getElements("x" + infix + "_ContactName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_edit->ContactName->caption(), $suppliers_edit->ContactName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_edit->ContactTitle->Required) { ?>
				elm = this.getElements("x" + infix + "_ContactTitle");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_edit->ContactTitle->caption(), $suppliers_edit->ContactTitle->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_edit->Address->Required) { ?>
				elm = this.getElements("x" + infix + "_Address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_edit->Address->caption(), $suppliers_edit->Address->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_edit->City->Required) { ?>
				elm = this.getElements("x" + infix + "_City");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_edit->City->caption(), $suppliers_edit->City->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_edit->Region->Required) { ?>
				elm = this.getElements("x" + infix + "_Region");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_edit->Region->caption(), $suppliers_edit->Region->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_edit->PostalCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PostalCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_edit->PostalCode->caption(), $suppliers_edit->PostalCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_edit->Country->Required) { ?>
				elm = this.getElements("x" + infix + "_Country");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_edit->Country->caption(), $suppliers_edit->Country->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_edit->Phone->Required) { ?>
				elm = this.getElements("x" + infix + "_Phone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_edit->Phone->caption(), $suppliers_edit->Phone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_edit->Fax->Required) { ?>
				elm = this.getElements("x" + infix + "_Fax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_edit->Fax->caption(), $suppliers_edit->Fax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_edit->HomePage->Required) { ?>
				elm = this.getElements("x" + infix + "_HomePage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_edit->HomePage->caption(), $suppliers_edit->HomePage->RequiredErrorMessage)) ?>");
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
	fsuppliersedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsuppliersedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsuppliersedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $suppliers_edit->showPageHeader(); ?>
<?php
$suppliers_edit->showMessage();
?>
<form name="fsuppliersedit" id="fsuppliersedit" class="<?php echo $suppliers_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="suppliers">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$suppliers_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($suppliers_edit->SupplierID->Visible) { // SupplierID ?>
	<div id="r_SupplierID" class="form-group row">
		<label id="elh_suppliers_SupplierID" class="<?php echo $suppliers_edit->LeftColumnClass ?>"><?php echo $suppliers_edit->SupplierID->caption() ?><?php echo $suppliers_edit->SupplierID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_edit->RightColumnClass ?>"><div <?php echo $suppliers_edit->SupplierID->cellAttributes() ?>>
<span id="el_suppliers_SupplierID">
<span<?php echo $suppliers_edit->SupplierID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($suppliers_edit->SupplierID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="suppliers" data-field="x_SupplierID" name="x_SupplierID" id="x_SupplierID" value="<?php echo HtmlEncode($suppliers_edit->SupplierID->CurrentValue) ?>">
<?php echo $suppliers_edit->SupplierID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_edit->CompanyName->Visible) { // CompanyName ?>
	<div id="r_CompanyName" class="form-group row">
		<label id="elh_suppliers_CompanyName" for="x_CompanyName" class="<?php echo $suppliers_edit->LeftColumnClass ?>"><?php echo $suppliers_edit->CompanyName->caption() ?><?php echo $suppliers_edit->CompanyName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_edit->RightColumnClass ?>"><div <?php echo $suppliers_edit->CompanyName->cellAttributes() ?>>
<span id="el_suppliers_CompanyName">
<input type="text" data-table="suppliers" data-field="x_CompanyName" name="x_CompanyName" id="x_CompanyName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($suppliers_edit->CompanyName->getPlaceHolder()) ?>" value="<?php echo $suppliers_edit->CompanyName->EditValue ?>"<?php echo $suppliers_edit->CompanyName->editAttributes() ?>>
</span>
<?php echo $suppliers_edit->CompanyName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_edit->ContactName->Visible) { // ContactName ?>
	<div id="r_ContactName" class="form-group row">
		<label id="elh_suppliers_ContactName" for="x_ContactName" class="<?php echo $suppliers_edit->LeftColumnClass ?>"><?php echo $suppliers_edit->ContactName->caption() ?><?php echo $suppliers_edit->ContactName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_edit->RightColumnClass ?>"><div <?php echo $suppliers_edit->ContactName->cellAttributes() ?>>
<span id="el_suppliers_ContactName">
<input type="text" data-table="suppliers" data-field="x_ContactName" name="x_ContactName" id="x_ContactName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($suppliers_edit->ContactName->getPlaceHolder()) ?>" value="<?php echo $suppliers_edit->ContactName->EditValue ?>"<?php echo $suppliers_edit->ContactName->editAttributes() ?>>
</span>
<?php echo $suppliers_edit->ContactName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_edit->ContactTitle->Visible) { // ContactTitle ?>
	<div id="r_ContactTitle" class="form-group row">
		<label id="elh_suppliers_ContactTitle" for="x_ContactTitle" class="<?php echo $suppliers_edit->LeftColumnClass ?>"><?php echo $suppliers_edit->ContactTitle->caption() ?><?php echo $suppliers_edit->ContactTitle->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_edit->RightColumnClass ?>"><div <?php echo $suppliers_edit->ContactTitle->cellAttributes() ?>>
<span id="el_suppliers_ContactTitle">
<input type="text" data-table="suppliers" data-field="x_ContactTitle" name="x_ContactTitle" id="x_ContactTitle" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($suppliers_edit->ContactTitle->getPlaceHolder()) ?>" value="<?php echo $suppliers_edit->ContactTitle->EditValue ?>"<?php echo $suppliers_edit->ContactTitle->editAttributes() ?>>
</span>
<?php echo $suppliers_edit->ContactTitle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_edit->Address->Visible) { // Address ?>
	<div id="r_Address" class="form-group row">
		<label id="elh_suppliers_Address" for="x_Address" class="<?php echo $suppliers_edit->LeftColumnClass ?>"><?php echo $suppliers_edit->Address->caption() ?><?php echo $suppliers_edit->Address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_edit->RightColumnClass ?>"><div <?php echo $suppliers_edit->Address->cellAttributes() ?>>
<span id="el_suppliers_Address">
<input type="text" data-table="suppliers" data-field="x_Address" name="x_Address" id="x_Address" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($suppliers_edit->Address->getPlaceHolder()) ?>" value="<?php echo $suppliers_edit->Address->EditValue ?>"<?php echo $suppliers_edit->Address->editAttributes() ?>>
</span>
<?php echo $suppliers_edit->Address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_edit->City->Visible) { // City ?>
	<div id="r_City" class="form-group row">
		<label id="elh_suppliers_City" for="x_City" class="<?php echo $suppliers_edit->LeftColumnClass ?>"><?php echo $suppliers_edit->City->caption() ?><?php echo $suppliers_edit->City->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_edit->RightColumnClass ?>"><div <?php echo $suppliers_edit->City->cellAttributes() ?>>
<span id="el_suppliers_City">
<input type="text" data-table="suppliers" data-field="x_City" name="x_City" id="x_City" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($suppliers_edit->City->getPlaceHolder()) ?>" value="<?php echo $suppliers_edit->City->EditValue ?>"<?php echo $suppliers_edit->City->editAttributes() ?>>
</span>
<?php echo $suppliers_edit->City->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_edit->Region->Visible) { // Region ?>
	<div id="r_Region" class="form-group row">
		<label id="elh_suppliers_Region" for="x_Region" class="<?php echo $suppliers_edit->LeftColumnClass ?>"><?php echo $suppliers_edit->Region->caption() ?><?php echo $suppliers_edit->Region->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_edit->RightColumnClass ?>"><div <?php echo $suppliers_edit->Region->cellAttributes() ?>>
<span id="el_suppliers_Region">
<input type="text" data-table="suppliers" data-field="x_Region" name="x_Region" id="x_Region" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($suppliers_edit->Region->getPlaceHolder()) ?>" value="<?php echo $suppliers_edit->Region->EditValue ?>"<?php echo $suppliers_edit->Region->editAttributes() ?>>
</span>
<?php echo $suppliers_edit->Region->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_edit->PostalCode->Visible) { // PostalCode ?>
	<div id="r_PostalCode" class="form-group row">
		<label id="elh_suppliers_PostalCode" for="x_PostalCode" class="<?php echo $suppliers_edit->LeftColumnClass ?>"><?php echo $suppliers_edit->PostalCode->caption() ?><?php echo $suppliers_edit->PostalCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_edit->RightColumnClass ?>"><div <?php echo $suppliers_edit->PostalCode->cellAttributes() ?>>
<span id="el_suppliers_PostalCode">
<input type="text" data-table="suppliers" data-field="x_PostalCode" name="x_PostalCode" id="x_PostalCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($suppliers_edit->PostalCode->getPlaceHolder()) ?>" value="<?php echo $suppliers_edit->PostalCode->EditValue ?>"<?php echo $suppliers_edit->PostalCode->editAttributes() ?>>
</span>
<?php echo $suppliers_edit->PostalCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_edit->Country->Visible) { // Country ?>
	<div id="r_Country" class="form-group row">
		<label id="elh_suppliers_Country" for="x_Country" class="<?php echo $suppliers_edit->LeftColumnClass ?>"><?php echo $suppliers_edit->Country->caption() ?><?php echo $suppliers_edit->Country->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_edit->RightColumnClass ?>"><div <?php echo $suppliers_edit->Country->cellAttributes() ?>>
<span id="el_suppliers_Country">
<input type="text" data-table="suppliers" data-field="x_Country" name="x_Country" id="x_Country" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($suppliers_edit->Country->getPlaceHolder()) ?>" value="<?php echo $suppliers_edit->Country->EditValue ?>"<?php echo $suppliers_edit->Country->editAttributes() ?>>
</span>
<?php echo $suppliers_edit->Country->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_edit->Phone->Visible) { // Phone ?>
	<div id="r_Phone" class="form-group row">
		<label id="elh_suppliers_Phone" for="x_Phone" class="<?php echo $suppliers_edit->LeftColumnClass ?>"><?php echo $suppliers_edit->Phone->caption() ?><?php echo $suppliers_edit->Phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_edit->RightColumnClass ?>"><div <?php echo $suppliers_edit->Phone->cellAttributes() ?>>
<span id="el_suppliers_Phone">
<input type="text" data-table="suppliers" data-field="x_Phone" name="x_Phone" id="x_Phone" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($suppliers_edit->Phone->getPlaceHolder()) ?>" value="<?php echo $suppliers_edit->Phone->EditValue ?>"<?php echo $suppliers_edit->Phone->editAttributes() ?>>
</span>
<?php echo $suppliers_edit->Phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_edit->Fax->Visible) { // Fax ?>
	<div id="r_Fax" class="form-group row">
		<label id="elh_suppliers_Fax" for="x_Fax" class="<?php echo $suppliers_edit->LeftColumnClass ?>"><?php echo $suppliers_edit->Fax->caption() ?><?php echo $suppliers_edit->Fax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_edit->RightColumnClass ?>"><div <?php echo $suppliers_edit->Fax->cellAttributes() ?>>
<span id="el_suppliers_Fax">
<input type="text" data-table="suppliers" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($suppliers_edit->Fax->getPlaceHolder()) ?>" value="<?php echo $suppliers_edit->Fax->EditValue ?>"<?php echo $suppliers_edit->Fax->editAttributes() ?>>
</span>
<?php echo $suppliers_edit->Fax->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_edit->HomePage->Visible) { // HomePage ?>
	<div id="r_HomePage" class="form-group row">
		<label id="elh_suppliers_HomePage" for="x_HomePage" class="<?php echo $suppliers_edit->LeftColumnClass ?>"><?php echo $suppliers_edit->HomePage->caption() ?><?php echo $suppliers_edit->HomePage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_edit->RightColumnClass ?>"><div <?php echo $suppliers_edit->HomePage->cellAttributes() ?>>
<span id="el_suppliers_HomePage">
<textarea data-table="suppliers" data-field="x_HomePage" name="x_HomePage" id="x_HomePage" cols="35" rows="4" placeholder="<?php echo HtmlEncode($suppliers_edit->HomePage->getPlaceHolder()) ?>"<?php echo $suppliers_edit->HomePage->editAttributes() ?>><?php echo $suppliers_edit->HomePage->EditValue ?></textarea>
</span>
<?php echo $suppliers_edit->HomePage->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$suppliers_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $suppliers_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $suppliers_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$suppliers_edit->showPageFooter();
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
$suppliers_edit->terminate();
?>