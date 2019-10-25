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
$customers_add = new customers_add();

// Run the page
$customers_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$customers_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcustomersadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcustomersadd = currentForm = new ew.Form("fcustomersadd", "add");

	// Validate form
	fcustomersadd.validate = function() {
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
			<?php if ($customers_add->CustomerID->Required) { ?>
				elm = this.getElements("x" + infix + "_CustomerID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_add->CustomerID->caption(), $customers_add->CustomerID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_add->CompanyName->Required) { ?>
				elm = this.getElements("x" + infix + "_CompanyName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_add->CompanyName->caption(), $customers_add->CompanyName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_add->ContactName->Required) { ?>
				elm = this.getElements("x" + infix + "_ContactName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_add->ContactName->caption(), $customers_add->ContactName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_add->ContactTitle->Required) { ?>
				elm = this.getElements("x" + infix + "_ContactTitle");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_add->ContactTitle->caption(), $customers_add->ContactTitle->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_add->Address->Required) { ?>
				elm = this.getElements("x" + infix + "_Address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_add->Address->caption(), $customers_add->Address->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_add->City->Required) { ?>
				elm = this.getElements("x" + infix + "_City");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_add->City->caption(), $customers_add->City->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_add->Region->Required) { ?>
				elm = this.getElements("x" + infix + "_Region");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_add->Region->caption(), $customers_add->Region->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_add->PostalCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PostalCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_add->PostalCode->caption(), $customers_add->PostalCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_add->Country->Required) { ?>
				elm = this.getElements("x" + infix + "_Country");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_add->Country->caption(), $customers_add->Country->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_add->Phone->Required) { ?>
				elm = this.getElements("x" + infix + "_Phone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_add->Phone->caption(), $customers_add->Phone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_add->Fax->Required) { ?>
				elm = this.getElements("x" + infix + "_Fax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_add->Fax->caption(), $customers_add->Fax->RequiredErrorMessage)) ?>");
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
	fcustomersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcustomersadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcustomersadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $customers_add->showPageHeader(); ?>
<?php
$customers_add->showMessage();
?>
<form name="fcustomersadd" id="fcustomersadd" class="<?php echo $customers_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="customers">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$customers_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($customers_add->CustomerID->Visible) { // CustomerID ?>
	<div id="r_CustomerID" class="form-group row">
		<label id="elh_customers_CustomerID" for="x_CustomerID" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers_add->CustomerID->caption() ?><?php echo $customers_add->CustomerID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div <?php echo $customers_add->CustomerID->cellAttributes() ?>>
<span id="el_customers_CustomerID">
<input type="text" data-table="customers" data-field="x_CustomerID" name="x_CustomerID" id="x_CustomerID" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($customers_add->CustomerID->getPlaceHolder()) ?>" value="<?php echo $customers_add->CustomerID->EditValue ?>"<?php echo $customers_add->CustomerID->editAttributes() ?>>
</span>
<?php echo $customers_add->CustomerID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_add->CompanyName->Visible) { // CompanyName ?>
	<div id="r_CompanyName" class="form-group row">
		<label id="elh_customers_CompanyName" for="x_CompanyName" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers_add->CompanyName->caption() ?><?php echo $customers_add->CompanyName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div <?php echo $customers_add->CompanyName->cellAttributes() ?>>
<span id="el_customers_CompanyName">
<input type="text" data-table="customers" data-field="x_CompanyName" name="x_CompanyName" id="x_CompanyName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($customers_add->CompanyName->getPlaceHolder()) ?>" value="<?php echo $customers_add->CompanyName->EditValue ?>"<?php echo $customers_add->CompanyName->editAttributes() ?>>
</span>
<?php echo $customers_add->CompanyName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_add->ContactName->Visible) { // ContactName ?>
	<div id="r_ContactName" class="form-group row">
		<label id="elh_customers_ContactName" for="x_ContactName" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers_add->ContactName->caption() ?><?php echo $customers_add->ContactName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div <?php echo $customers_add->ContactName->cellAttributes() ?>>
<span id="el_customers_ContactName">
<input type="text" data-table="customers" data-field="x_ContactName" name="x_ContactName" id="x_ContactName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($customers_add->ContactName->getPlaceHolder()) ?>" value="<?php echo $customers_add->ContactName->EditValue ?>"<?php echo $customers_add->ContactName->editAttributes() ?>>
</span>
<?php echo $customers_add->ContactName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_add->ContactTitle->Visible) { // ContactTitle ?>
	<div id="r_ContactTitle" class="form-group row">
		<label id="elh_customers_ContactTitle" for="x_ContactTitle" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers_add->ContactTitle->caption() ?><?php echo $customers_add->ContactTitle->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div <?php echo $customers_add->ContactTitle->cellAttributes() ?>>
<span id="el_customers_ContactTitle">
<input type="text" data-table="customers" data-field="x_ContactTitle" name="x_ContactTitle" id="x_ContactTitle" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($customers_add->ContactTitle->getPlaceHolder()) ?>" value="<?php echo $customers_add->ContactTitle->EditValue ?>"<?php echo $customers_add->ContactTitle->editAttributes() ?>>
</span>
<?php echo $customers_add->ContactTitle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_add->Address->Visible) { // Address ?>
	<div id="r_Address" class="form-group row">
		<label id="elh_customers_Address" for="x_Address" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers_add->Address->caption() ?><?php echo $customers_add->Address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div <?php echo $customers_add->Address->cellAttributes() ?>>
<span id="el_customers_Address">
<input type="text" data-table="customers" data-field="x_Address" name="x_Address" id="x_Address" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($customers_add->Address->getPlaceHolder()) ?>" value="<?php echo $customers_add->Address->EditValue ?>"<?php echo $customers_add->Address->editAttributes() ?>>
</span>
<?php echo $customers_add->Address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_add->City->Visible) { // City ?>
	<div id="r_City" class="form-group row">
		<label id="elh_customers_City" for="x_City" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers_add->City->caption() ?><?php echo $customers_add->City->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div <?php echo $customers_add->City->cellAttributes() ?>>
<span id="el_customers_City">
<input type="text" data-table="customers" data-field="x_City" name="x_City" id="x_City" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($customers_add->City->getPlaceHolder()) ?>" value="<?php echo $customers_add->City->EditValue ?>"<?php echo $customers_add->City->editAttributes() ?>>
</span>
<?php echo $customers_add->City->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_add->Region->Visible) { // Region ?>
	<div id="r_Region" class="form-group row">
		<label id="elh_customers_Region" for="x_Region" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers_add->Region->caption() ?><?php echo $customers_add->Region->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div <?php echo $customers_add->Region->cellAttributes() ?>>
<span id="el_customers_Region">
<input type="text" data-table="customers" data-field="x_Region" name="x_Region" id="x_Region" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($customers_add->Region->getPlaceHolder()) ?>" value="<?php echo $customers_add->Region->EditValue ?>"<?php echo $customers_add->Region->editAttributes() ?>>
</span>
<?php echo $customers_add->Region->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_add->PostalCode->Visible) { // PostalCode ?>
	<div id="r_PostalCode" class="form-group row">
		<label id="elh_customers_PostalCode" for="x_PostalCode" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers_add->PostalCode->caption() ?><?php echo $customers_add->PostalCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div <?php echo $customers_add->PostalCode->cellAttributes() ?>>
<span id="el_customers_PostalCode">
<input type="text" data-table="customers" data-field="x_PostalCode" name="x_PostalCode" id="x_PostalCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($customers_add->PostalCode->getPlaceHolder()) ?>" value="<?php echo $customers_add->PostalCode->EditValue ?>"<?php echo $customers_add->PostalCode->editAttributes() ?>>
</span>
<?php echo $customers_add->PostalCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_add->Country->Visible) { // Country ?>
	<div id="r_Country" class="form-group row">
		<label id="elh_customers_Country" for="x_Country" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers_add->Country->caption() ?><?php echo $customers_add->Country->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div <?php echo $customers_add->Country->cellAttributes() ?>>
<span id="el_customers_Country">
<input type="text" data-table="customers" data-field="x_Country" name="x_Country" id="x_Country" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($customers_add->Country->getPlaceHolder()) ?>" value="<?php echo $customers_add->Country->EditValue ?>"<?php echo $customers_add->Country->editAttributes() ?>>
</span>
<?php echo $customers_add->Country->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_add->Phone->Visible) { // Phone ?>
	<div id="r_Phone" class="form-group row">
		<label id="elh_customers_Phone" for="x_Phone" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers_add->Phone->caption() ?><?php echo $customers_add->Phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div <?php echo $customers_add->Phone->cellAttributes() ?>>
<span id="el_customers_Phone">
<input type="text" data-table="customers" data-field="x_Phone" name="x_Phone" id="x_Phone" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($customers_add->Phone->getPlaceHolder()) ?>" value="<?php echo $customers_add->Phone->EditValue ?>"<?php echo $customers_add->Phone->editAttributes() ?>>
</span>
<?php echo $customers_add->Phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_add->Fax->Visible) { // Fax ?>
	<div id="r_Fax" class="form-group row">
		<label id="elh_customers_Fax" for="x_Fax" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers_add->Fax->caption() ?><?php echo $customers_add->Fax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div <?php echo $customers_add->Fax->cellAttributes() ?>>
<span id="el_customers_Fax">
<input type="text" data-table="customers" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($customers_add->Fax->getPlaceHolder()) ?>" value="<?php echo $customers_add->Fax->EditValue ?>"<?php echo $customers_add->Fax->editAttributes() ?>>
</span>
<?php echo $customers_add->Fax->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$customers_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $customers_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $customers_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$customers_add->showPageFooter();
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
$customers_add->terminate();
?>