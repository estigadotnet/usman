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
$suppliers_add = new suppliers_add();

// Run the page
$suppliers_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$suppliers_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsuppliersadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fsuppliersadd = currentForm = new ew.Form("fsuppliersadd", "add");

	// Validate form
	fsuppliersadd.validate = function() {
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
			<?php if ($suppliers_add->CompanyName->Required) { ?>
				elm = this.getElements("x" + infix + "_CompanyName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_add->CompanyName->caption(), $suppliers_add->CompanyName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_add->ContactName->Required) { ?>
				elm = this.getElements("x" + infix + "_ContactName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_add->ContactName->caption(), $suppliers_add->ContactName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_add->ContactTitle->Required) { ?>
				elm = this.getElements("x" + infix + "_ContactTitle");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_add->ContactTitle->caption(), $suppliers_add->ContactTitle->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_add->Address->Required) { ?>
				elm = this.getElements("x" + infix + "_Address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_add->Address->caption(), $suppliers_add->Address->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_add->City->Required) { ?>
				elm = this.getElements("x" + infix + "_City");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_add->City->caption(), $suppliers_add->City->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_add->Region->Required) { ?>
				elm = this.getElements("x" + infix + "_Region");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_add->Region->caption(), $suppliers_add->Region->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_add->PostalCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PostalCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_add->PostalCode->caption(), $suppliers_add->PostalCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_add->Country->Required) { ?>
				elm = this.getElements("x" + infix + "_Country");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_add->Country->caption(), $suppliers_add->Country->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_add->Phone->Required) { ?>
				elm = this.getElements("x" + infix + "_Phone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_add->Phone->caption(), $suppliers_add->Phone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_add->Fax->Required) { ?>
				elm = this.getElements("x" + infix + "_Fax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_add->Fax->caption(), $suppliers_add->Fax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($suppliers_add->HomePage->Required) { ?>
				elm = this.getElements("x" + infix + "_HomePage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $suppliers_add->HomePage->caption(), $suppliers_add->HomePage->RequiredErrorMessage)) ?>");
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
	fsuppliersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsuppliersadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsuppliersadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $suppliers_add->showPageHeader(); ?>
<?php
$suppliers_add->showMessage();
?>
<form name="fsuppliersadd" id="fsuppliersadd" class="<?php echo $suppliers_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="suppliers">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$suppliers_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($suppliers_add->CompanyName->Visible) { // CompanyName ?>
	<div id="r_CompanyName" class="form-group row">
		<label id="elh_suppliers_CompanyName" for="x_CompanyName" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers_add->CompanyName->caption() ?><?php echo $suppliers_add->CompanyName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div <?php echo $suppliers_add->CompanyName->cellAttributes() ?>>
<span id="el_suppliers_CompanyName">
<input type="text" data-table="suppliers" data-field="x_CompanyName" name="x_CompanyName" id="x_CompanyName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($suppliers_add->CompanyName->getPlaceHolder()) ?>" value="<?php echo $suppliers_add->CompanyName->EditValue ?>"<?php echo $suppliers_add->CompanyName->editAttributes() ?>>
</span>
<?php echo $suppliers_add->CompanyName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_add->ContactName->Visible) { // ContactName ?>
	<div id="r_ContactName" class="form-group row">
		<label id="elh_suppliers_ContactName" for="x_ContactName" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers_add->ContactName->caption() ?><?php echo $suppliers_add->ContactName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div <?php echo $suppliers_add->ContactName->cellAttributes() ?>>
<span id="el_suppliers_ContactName">
<input type="text" data-table="suppliers" data-field="x_ContactName" name="x_ContactName" id="x_ContactName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($suppliers_add->ContactName->getPlaceHolder()) ?>" value="<?php echo $suppliers_add->ContactName->EditValue ?>"<?php echo $suppliers_add->ContactName->editAttributes() ?>>
</span>
<?php echo $suppliers_add->ContactName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_add->ContactTitle->Visible) { // ContactTitle ?>
	<div id="r_ContactTitle" class="form-group row">
		<label id="elh_suppliers_ContactTitle" for="x_ContactTitle" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers_add->ContactTitle->caption() ?><?php echo $suppliers_add->ContactTitle->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div <?php echo $suppliers_add->ContactTitle->cellAttributes() ?>>
<span id="el_suppliers_ContactTitle">
<input type="text" data-table="suppliers" data-field="x_ContactTitle" name="x_ContactTitle" id="x_ContactTitle" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($suppliers_add->ContactTitle->getPlaceHolder()) ?>" value="<?php echo $suppliers_add->ContactTitle->EditValue ?>"<?php echo $suppliers_add->ContactTitle->editAttributes() ?>>
</span>
<?php echo $suppliers_add->ContactTitle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_add->Address->Visible) { // Address ?>
	<div id="r_Address" class="form-group row">
		<label id="elh_suppliers_Address" for="x_Address" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers_add->Address->caption() ?><?php echo $suppliers_add->Address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div <?php echo $suppliers_add->Address->cellAttributes() ?>>
<span id="el_suppliers_Address">
<input type="text" data-table="suppliers" data-field="x_Address" name="x_Address" id="x_Address" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($suppliers_add->Address->getPlaceHolder()) ?>" value="<?php echo $suppliers_add->Address->EditValue ?>"<?php echo $suppliers_add->Address->editAttributes() ?>>
</span>
<?php echo $suppliers_add->Address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_add->City->Visible) { // City ?>
	<div id="r_City" class="form-group row">
		<label id="elh_suppliers_City" for="x_City" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers_add->City->caption() ?><?php echo $suppliers_add->City->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div <?php echo $suppliers_add->City->cellAttributes() ?>>
<span id="el_suppliers_City">
<input type="text" data-table="suppliers" data-field="x_City" name="x_City" id="x_City" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($suppliers_add->City->getPlaceHolder()) ?>" value="<?php echo $suppliers_add->City->EditValue ?>"<?php echo $suppliers_add->City->editAttributes() ?>>
</span>
<?php echo $suppliers_add->City->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_add->Region->Visible) { // Region ?>
	<div id="r_Region" class="form-group row">
		<label id="elh_suppliers_Region" for="x_Region" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers_add->Region->caption() ?><?php echo $suppliers_add->Region->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div <?php echo $suppliers_add->Region->cellAttributes() ?>>
<span id="el_suppliers_Region">
<input type="text" data-table="suppliers" data-field="x_Region" name="x_Region" id="x_Region" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($suppliers_add->Region->getPlaceHolder()) ?>" value="<?php echo $suppliers_add->Region->EditValue ?>"<?php echo $suppliers_add->Region->editAttributes() ?>>
</span>
<?php echo $suppliers_add->Region->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_add->PostalCode->Visible) { // PostalCode ?>
	<div id="r_PostalCode" class="form-group row">
		<label id="elh_suppliers_PostalCode" for="x_PostalCode" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers_add->PostalCode->caption() ?><?php echo $suppliers_add->PostalCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div <?php echo $suppliers_add->PostalCode->cellAttributes() ?>>
<span id="el_suppliers_PostalCode">
<input type="text" data-table="suppliers" data-field="x_PostalCode" name="x_PostalCode" id="x_PostalCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($suppliers_add->PostalCode->getPlaceHolder()) ?>" value="<?php echo $suppliers_add->PostalCode->EditValue ?>"<?php echo $suppliers_add->PostalCode->editAttributes() ?>>
</span>
<?php echo $suppliers_add->PostalCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_add->Country->Visible) { // Country ?>
	<div id="r_Country" class="form-group row">
		<label id="elh_suppliers_Country" for="x_Country" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers_add->Country->caption() ?><?php echo $suppliers_add->Country->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div <?php echo $suppliers_add->Country->cellAttributes() ?>>
<span id="el_suppliers_Country">
<input type="text" data-table="suppliers" data-field="x_Country" name="x_Country" id="x_Country" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($suppliers_add->Country->getPlaceHolder()) ?>" value="<?php echo $suppliers_add->Country->EditValue ?>"<?php echo $suppliers_add->Country->editAttributes() ?>>
</span>
<?php echo $suppliers_add->Country->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_add->Phone->Visible) { // Phone ?>
	<div id="r_Phone" class="form-group row">
		<label id="elh_suppliers_Phone" for="x_Phone" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers_add->Phone->caption() ?><?php echo $suppliers_add->Phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div <?php echo $suppliers_add->Phone->cellAttributes() ?>>
<span id="el_suppliers_Phone">
<input type="text" data-table="suppliers" data-field="x_Phone" name="x_Phone" id="x_Phone" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($suppliers_add->Phone->getPlaceHolder()) ?>" value="<?php echo $suppliers_add->Phone->EditValue ?>"<?php echo $suppliers_add->Phone->editAttributes() ?>>
</span>
<?php echo $suppliers_add->Phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_add->Fax->Visible) { // Fax ?>
	<div id="r_Fax" class="form-group row">
		<label id="elh_suppliers_Fax" for="x_Fax" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers_add->Fax->caption() ?><?php echo $suppliers_add->Fax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div <?php echo $suppliers_add->Fax->cellAttributes() ?>>
<span id="el_suppliers_Fax">
<input type="text" data-table="suppliers" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($suppliers_add->Fax->getPlaceHolder()) ?>" value="<?php echo $suppliers_add->Fax->EditValue ?>"<?php echo $suppliers_add->Fax->editAttributes() ?>>
</span>
<?php echo $suppliers_add->Fax->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($suppliers_add->HomePage->Visible) { // HomePage ?>
	<div id="r_HomePage" class="form-group row">
		<label id="elh_suppliers_HomePage" for="x_HomePage" class="<?php echo $suppliers_add->LeftColumnClass ?>"><?php echo $suppliers_add->HomePage->caption() ?><?php echo $suppliers_add->HomePage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $suppliers_add->RightColumnClass ?>"><div <?php echo $suppliers_add->HomePage->cellAttributes() ?>>
<span id="el_suppliers_HomePage">
<textarea data-table="suppliers" data-field="x_HomePage" name="x_HomePage" id="x_HomePage" cols="35" rows="4" placeholder="<?php echo HtmlEncode($suppliers_add->HomePage->getPlaceHolder()) ?>"<?php echo $suppliers_add->HomePage->editAttributes() ?>><?php echo $suppliers_add->HomePage->EditValue ?></textarea>
</span>
<?php echo $suppliers_add->HomePage->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$suppliers_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $suppliers_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $suppliers_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$suppliers_add->showPageFooter();
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
$suppliers_add->terminate();
?>