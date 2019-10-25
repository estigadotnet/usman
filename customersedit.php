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
$customers_edit = new customers_edit();

// Run the page
$customers_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$customers_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcustomersedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcustomersedit = currentForm = new ew.Form("fcustomersedit", "edit");

	// Validate form
	fcustomersedit.validate = function() {
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
			<?php if ($customers_edit->CustomerID->Required) { ?>
				elm = this.getElements("x" + infix + "_CustomerID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->CustomerID->caption(), $customers_edit->CustomerID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->CompanyName->Required) { ?>
				elm = this.getElements("x" + infix + "_CompanyName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->CompanyName->caption(), $customers_edit->CompanyName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->ContactName->Required) { ?>
				elm = this.getElements("x" + infix + "_ContactName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->ContactName->caption(), $customers_edit->ContactName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->ContactTitle->Required) { ?>
				elm = this.getElements("x" + infix + "_ContactTitle");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->ContactTitle->caption(), $customers_edit->ContactTitle->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->Address->Required) { ?>
				elm = this.getElements("x" + infix + "_Address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->Address->caption(), $customers_edit->Address->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->City->Required) { ?>
				elm = this.getElements("x" + infix + "_City");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->City->caption(), $customers_edit->City->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->Region->Required) { ?>
				elm = this.getElements("x" + infix + "_Region");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->Region->caption(), $customers_edit->Region->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->PostalCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PostalCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->PostalCode->caption(), $customers_edit->PostalCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->Country->Required) { ?>
				elm = this.getElements("x" + infix + "_Country");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->Country->caption(), $customers_edit->Country->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->Phone->Required) { ?>
				elm = this.getElements("x" + infix + "_Phone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->Phone->caption(), $customers_edit->Phone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->Fax->Required) { ?>
				elm = this.getElements("x" + infix + "_Fax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->Fax->caption(), $customers_edit->Fax->RequiredErrorMessage)) ?>");
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
	fcustomersedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcustomersedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcustomersedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $customers_edit->showPageHeader(); ?>
<?php
$customers_edit->showMessage();
?>
<form name="fcustomersedit" id="fcustomersedit" class="<?php echo $customers_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="customers">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$customers_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($customers_edit->CustomerID->Visible) { // CustomerID ?>
	<div id="r_CustomerID" class="form-group row">
		<label id="elh_customers_CustomerID" for="x_CustomerID" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->CustomerID->caption() ?><?php echo $customers_edit->CustomerID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->CustomerID->cellAttributes() ?>>
<input type="text" data-table="customers" data-field="x_CustomerID" name="x_CustomerID" id="x_CustomerID" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($customers_edit->CustomerID->getPlaceHolder()) ?>" value="<?php echo $customers_edit->CustomerID->EditValue ?>"<?php echo $customers_edit->CustomerID->editAttributes() ?>>
<input type="hidden" data-table="customers" data-field="x_CustomerID" name="o_CustomerID" id="o_CustomerID" value="<?php echo HtmlEncode($customers_edit->CustomerID->OldValue != null ? $customers_edit->CustomerID->OldValue : $customers_edit->CustomerID->CurrentValue) ?>">
<?php echo $customers_edit->CustomerID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->CompanyName->Visible) { // CompanyName ?>
	<div id="r_CompanyName" class="form-group row">
		<label id="elh_customers_CompanyName" for="x_CompanyName" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->CompanyName->caption() ?><?php echo $customers_edit->CompanyName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->CompanyName->cellAttributes() ?>>
<span id="el_customers_CompanyName">
<input type="text" data-table="customers" data-field="x_CompanyName" name="x_CompanyName" id="x_CompanyName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($customers_edit->CompanyName->getPlaceHolder()) ?>" value="<?php echo $customers_edit->CompanyName->EditValue ?>"<?php echo $customers_edit->CompanyName->editAttributes() ?>>
</span>
<?php echo $customers_edit->CompanyName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->ContactName->Visible) { // ContactName ?>
	<div id="r_ContactName" class="form-group row">
		<label id="elh_customers_ContactName" for="x_ContactName" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->ContactName->caption() ?><?php echo $customers_edit->ContactName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->ContactName->cellAttributes() ?>>
<span id="el_customers_ContactName">
<input type="text" data-table="customers" data-field="x_ContactName" name="x_ContactName" id="x_ContactName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($customers_edit->ContactName->getPlaceHolder()) ?>" value="<?php echo $customers_edit->ContactName->EditValue ?>"<?php echo $customers_edit->ContactName->editAttributes() ?>>
</span>
<?php echo $customers_edit->ContactName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->ContactTitle->Visible) { // ContactTitle ?>
	<div id="r_ContactTitle" class="form-group row">
		<label id="elh_customers_ContactTitle" for="x_ContactTitle" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->ContactTitle->caption() ?><?php echo $customers_edit->ContactTitle->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->ContactTitle->cellAttributes() ?>>
<span id="el_customers_ContactTitle">
<input type="text" data-table="customers" data-field="x_ContactTitle" name="x_ContactTitle" id="x_ContactTitle" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($customers_edit->ContactTitle->getPlaceHolder()) ?>" value="<?php echo $customers_edit->ContactTitle->EditValue ?>"<?php echo $customers_edit->ContactTitle->editAttributes() ?>>
</span>
<?php echo $customers_edit->ContactTitle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->Address->Visible) { // Address ?>
	<div id="r_Address" class="form-group row">
		<label id="elh_customers_Address" for="x_Address" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->Address->caption() ?><?php echo $customers_edit->Address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->Address->cellAttributes() ?>>
<span id="el_customers_Address">
<input type="text" data-table="customers" data-field="x_Address" name="x_Address" id="x_Address" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($customers_edit->Address->getPlaceHolder()) ?>" value="<?php echo $customers_edit->Address->EditValue ?>"<?php echo $customers_edit->Address->editAttributes() ?>>
</span>
<?php echo $customers_edit->Address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->City->Visible) { // City ?>
	<div id="r_City" class="form-group row">
		<label id="elh_customers_City" for="x_City" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->City->caption() ?><?php echo $customers_edit->City->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->City->cellAttributes() ?>>
<span id="el_customers_City">
<input type="text" data-table="customers" data-field="x_City" name="x_City" id="x_City" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($customers_edit->City->getPlaceHolder()) ?>" value="<?php echo $customers_edit->City->EditValue ?>"<?php echo $customers_edit->City->editAttributes() ?>>
</span>
<?php echo $customers_edit->City->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->Region->Visible) { // Region ?>
	<div id="r_Region" class="form-group row">
		<label id="elh_customers_Region" for="x_Region" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->Region->caption() ?><?php echo $customers_edit->Region->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->Region->cellAttributes() ?>>
<span id="el_customers_Region">
<input type="text" data-table="customers" data-field="x_Region" name="x_Region" id="x_Region" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($customers_edit->Region->getPlaceHolder()) ?>" value="<?php echo $customers_edit->Region->EditValue ?>"<?php echo $customers_edit->Region->editAttributes() ?>>
</span>
<?php echo $customers_edit->Region->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->PostalCode->Visible) { // PostalCode ?>
	<div id="r_PostalCode" class="form-group row">
		<label id="elh_customers_PostalCode" for="x_PostalCode" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->PostalCode->caption() ?><?php echo $customers_edit->PostalCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->PostalCode->cellAttributes() ?>>
<span id="el_customers_PostalCode">
<input type="text" data-table="customers" data-field="x_PostalCode" name="x_PostalCode" id="x_PostalCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($customers_edit->PostalCode->getPlaceHolder()) ?>" value="<?php echo $customers_edit->PostalCode->EditValue ?>"<?php echo $customers_edit->PostalCode->editAttributes() ?>>
</span>
<?php echo $customers_edit->PostalCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->Country->Visible) { // Country ?>
	<div id="r_Country" class="form-group row">
		<label id="elh_customers_Country" for="x_Country" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->Country->caption() ?><?php echo $customers_edit->Country->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->Country->cellAttributes() ?>>
<span id="el_customers_Country">
<input type="text" data-table="customers" data-field="x_Country" name="x_Country" id="x_Country" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($customers_edit->Country->getPlaceHolder()) ?>" value="<?php echo $customers_edit->Country->EditValue ?>"<?php echo $customers_edit->Country->editAttributes() ?>>
</span>
<?php echo $customers_edit->Country->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->Phone->Visible) { // Phone ?>
	<div id="r_Phone" class="form-group row">
		<label id="elh_customers_Phone" for="x_Phone" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->Phone->caption() ?><?php echo $customers_edit->Phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->Phone->cellAttributes() ?>>
<span id="el_customers_Phone">
<input type="text" data-table="customers" data-field="x_Phone" name="x_Phone" id="x_Phone" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($customers_edit->Phone->getPlaceHolder()) ?>" value="<?php echo $customers_edit->Phone->EditValue ?>"<?php echo $customers_edit->Phone->editAttributes() ?>>
</span>
<?php echo $customers_edit->Phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->Fax->Visible) { // Fax ?>
	<div id="r_Fax" class="form-group row">
		<label id="elh_customers_Fax" for="x_Fax" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->Fax->caption() ?><?php echo $customers_edit->Fax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->Fax->cellAttributes() ?>>
<span id="el_customers_Fax">
<input type="text" data-table="customers" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($customers_edit->Fax->getPlaceHolder()) ?>" value="<?php echo $customers_edit->Fax->EditValue ?>"<?php echo $customers_edit->Fax->editAttributes() ?>>
</span>
<?php echo $customers_edit->Fax->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$customers_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $customers_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $customers_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$customers_edit->showPageFooter();
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
$customers_edit->terminate();
?>