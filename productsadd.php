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
$products_add = new products_add();

// Run the page
$products_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$products_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproductsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fproductsadd = currentForm = new ew.Form("fproductsadd", "add");

	// Validate form
	fproductsadd.validate = function() {
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
			<?php if ($products_add->ProductName->Required) { ?>
				elm = this.getElements("x" + infix + "_ProductName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_add->ProductName->caption(), $products_add->ProductName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($products_add->SupplierID->Required) { ?>
				elm = this.getElements("x" + infix + "_SupplierID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_add->SupplierID->caption(), $products_add->SupplierID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SupplierID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($products_add->SupplierID->errorMessage()) ?>");
			<?php if ($products_add->CategoryID->Required) { ?>
				elm = this.getElements("x" + infix + "_CategoryID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_add->CategoryID->caption(), $products_add->CategoryID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CategoryID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($products_add->CategoryID->errorMessage()) ?>");
			<?php if ($products_add->QuantityPerUnit->Required) { ?>
				elm = this.getElements("x" + infix + "_QuantityPerUnit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_add->QuantityPerUnit->caption(), $products_add->QuantityPerUnit->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($products_add->UnitPrice->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitPrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_add->UnitPrice->caption(), $products_add->UnitPrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_UnitPrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($products_add->UnitPrice->errorMessage()) ?>");
			<?php if ($products_add->UnitsInStock->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitsInStock");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_add->UnitsInStock->caption(), $products_add->UnitsInStock->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_UnitsInStock");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($products_add->UnitsInStock->errorMessage()) ?>");
			<?php if ($products_add->UnitsOnOrder->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitsOnOrder");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_add->UnitsOnOrder->caption(), $products_add->UnitsOnOrder->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_UnitsOnOrder");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($products_add->UnitsOnOrder->errorMessage()) ?>");
			<?php if ($products_add->ReorderLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_ReorderLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_add->ReorderLevel->caption(), $products_add->ReorderLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ReorderLevel");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($products_add->ReorderLevel->errorMessage()) ?>");
			<?php if ($products_add->Discontinued->Required) { ?>
				elm = this.getElements("x" + infix + "_Discontinued[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_add->Discontinued->caption(), $products_add->Discontinued->RequiredErrorMessage)) ?>");
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
	fproductsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproductsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fproductsadd.lists["x_Discontinued[]"] = <?php echo $products_add->Discontinued->Lookup->toClientList($products_add) ?>;
	fproductsadd.lists["x_Discontinued[]"].options = <?php echo JsonEncode($products_add->Discontinued->options(FALSE, TRUE)) ?>;
	loadjs.done("fproductsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $products_add->showPageHeader(); ?>
<?php
$products_add->showMessage();
?>
<form name="fproductsadd" id="fproductsadd" class="<?php echo $products_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="products">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$products_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($products_add->ProductName->Visible) { // ProductName ?>
	<div id="r_ProductName" class="form-group row">
		<label id="elh_products_ProductName" for="x_ProductName" class="<?php echo $products_add->LeftColumnClass ?>"><?php echo $products_add->ProductName->caption() ?><?php echo $products_add->ProductName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_add->RightColumnClass ?>"><div <?php echo $products_add->ProductName->cellAttributes() ?>>
<span id="el_products_ProductName">
<input type="text" data-table="products" data-field="x_ProductName" name="x_ProductName" id="x_ProductName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($products_add->ProductName->getPlaceHolder()) ?>" value="<?php echo $products_add->ProductName->EditValue ?>"<?php echo $products_add->ProductName->editAttributes() ?>>
</span>
<?php echo $products_add->ProductName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($products_add->SupplierID->Visible) { // SupplierID ?>
	<div id="r_SupplierID" class="form-group row">
		<label id="elh_products_SupplierID" for="x_SupplierID" class="<?php echo $products_add->LeftColumnClass ?>"><?php echo $products_add->SupplierID->caption() ?><?php echo $products_add->SupplierID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_add->RightColumnClass ?>"><div <?php echo $products_add->SupplierID->cellAttributes() ?>>
<span id="el_products_SupplierID">
<input type="text" data-table="products" data-field="x_SupplierID" name="x_SupplierID" id="x_SupplierID" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($products_add->SupplierID->getPlaceHolder()) ?>" value="<?php echo $products_add->SupplierID->EditValue ?>"<?php echo $products_add->SupplierID->editAttributes() ?>>
</span>
<?php echo $products_add->SupplierID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($products_add->CategoryID->Visible) { // CategoryID ?>
	<div id="r_CategoryID" class="form-group row">
		<label id="elh_products_CategoryID" for="x_CategoryID" class="<?php echo $products_add->LeftColumnClass ?>"><?php echo $products_add->CategoryID->caption() ?><?php echo $products_add->CategoryID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_add->RightColumnClass ?>"><div <?php echo $products_add->CategoryID->cellAttributes() ?>>
<span id="el_products_CategoryID">
<input type="text" data-table="products" data-field="x_CategoryID" name="x_CategoryID" id="x_CategoryID" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($products_add->CategoryID->getPlaceHolder()) ?>" value="<?php echo $products_add->CategoryID->EditValue ?>"<?php echo $products_add->CategoryID->editAttributes() ?>>
</span>
<?php echo $products_add->CategoryID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($products_add->QuantityPerUnit->Visible) { // QuantityPerUnit ?>
	<div id="r_QuantityPerUnit" class="form-group row">
		<label id="elh_products_QuantityPerUnit" for="x_QuantityPerUnit" class="<?php echo $products_add->LeftColumnClass ?>"><?php echo $products_add->QuantityPerUnit->caption() ?><?php echo $products_add->QuantityPerUnit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_add->RightColumnClass ?>"><div <?php echo $products_add->QuantityPerUnit->cellAttributes() ?>>
<span id="el_products_QuantityPerUnit">
<input type="text" data-table="products" data-field="x_QuantityPerUnit" name="x_QuantityPerUnit" id="x_QuantityPerUnit" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($products_add->QuantityPerUnit->getPlaceHolder()) ?>" value="<?php echo $products_add->QuantityPerUnit->EditValue ?>"<?php echo $products_add->QuantityPerUnit->editAttributes() ?>>
</span>
<?php echo $products_add->QuantityPerUnit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($products_add->UnitPrice->Visible) { // UnitPrice ?>
	<div id="r_UnitPrice" class="form-group row">
		<label id="elh_products_UnitPrice" for="x_UnitPrice" class="<?php echo $products_add->LeftColumnClass ?>"><?php echo $products_add->UnitPrice->caption() ?><?php echo $products_add->UnitPrice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_add->RightColumnClass ?>"><div <?php echo $products_add->UnitPrice->cellAttributes() ?>>
<span id="el_products_UnitPrice">
<input type="text" data-table="products" data-field="x_UnitPrice" name="x_UnitPrice" id="x_UnitPrice" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($products_add->UnitPrice->getPlaceHolder()) ?>" value="<?php echo $products_add->UnitPrice->EditValue ?>"<?php echo $products_add->UnitPrice->editAttributes() ?>>
</span>
<?php echo $products_add->UnitPrice->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($products_add->UnitsInStock->Visible) { // UnitsInStock ?>
	<div id="r_UnitsInStock" class="form-group row">
		<label id="elh_products_UnitsInStock" for="x_UnitsInStock" class="<?php echo $products_add->LeftColumnClass ?>"><?php echo $products_add->UnitsInStock->caption() ?><?php echo $products_add->UnitsInStock->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_add->RightColumnClass ?>"><div <?php echo $products_add->UnitsInStock->cellAttributes() ?>>
<span id="el_products_UnitsInStock">
<input type="text" data-table="products" data-field="x_UnitsInStock" name="x_UnitsInStock" id="x_UnitsInStock" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($products_add->UnitsInStock->getPlaceHolder()) ?>" value="<?php echo $products_add->UnitsInStock->EditValue ?>"<?php echo $products_add->UnitsInStock->editAttributes() ?>>
</span>
<?php echo $products_add->UnitsInStock->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($products_add->UnitsOnOrder->Visible) { // UnitsOnOrder ?>
	<div id="r_UnitsOnOrder" class="form-group row">
		<label id="elh_products_UnitsOnOrder" for="x_UnitsOnOrder" class="<?php echo $products_add->LeftColumnClass ?>"><?php echo $products_add->UnitsOnOrder->caption() ?><?php echo $products_add->UnitsOnOrder->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_add->RightColumnClass ?>"><div <?php echo $products_add->UnitsOnOrder->cellAttributes() ?>>
<span id="el_products_UnitsOnOrder">
<input type="text" data-table="products" data-field="x_UnitsOnOrder" name="x_UnitsOnOrder" id="x_UnitsOnOrder" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($products_add->UnitsOnOrder->getPlaceHolder()) ?>" value="<?php echo $products_add->UnitsOnOrder->EditValue ?>"<?php echo $products_add->UnitsOnOrder->editAttributes() ?>>
</span>
<?php echo $products_add->UnitsOnOrder->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($products_add->ReorderLevel->Visible) { // ReorderLevel ?>
	<div id="r_ReorderLevel" class="form-group row">
		<label id="elh_products_ReorderLevel" for="x_ReorderLevel" class="<?php echo $products_add->LeftColumnClass ?>"><?php echo $products_add->ReorderLevel->caption() ?><?php echo $products_add->ReorderLevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_add->RightColumnClass ?>"><div <?php echo $products_add->ReorderLevel->cellAttributes() ?>>
<span id="el_products_ReorderLevel">
<input type="text" data-table="products" data-field="x_ReorderLevel" name="x_ReorderLevel" id="x_ReorderLevel" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($products_add->ReorderLevel->getPlaceHolder()) ?>" value="<?php echo $products_add->ReorderLevel->EditValue ?>"<?php echo $products_add->ReorderLevel->editAttributes() ?>>
</span>
<?php echo $products_add->ReorderLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($products_add->Discontinued->Visible) { // Discontinued ?>
	<div id="r_Discontinued" class="form-group row">
		<label id="elh_products_Discontinued" class="<?php echo $products_add->LeftColumnClass ?>"><?php echo $products_add->Discontinued->caption() ?><?php echo $products_add->Discontinued->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_add->RightColumnClass ?>"><div <?php echo $products_add->Discontinued->cellAttributes() ?>>
<span id="el_products_Discontinued">
<?php
$selwrk = ConvertToBool($products_add->Discontinued->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="products" data-field="x_Discontinued" name="x_Discontinued[]" id="x_Discontinued[]" value="1"<?php echo $selwrk ?><?php echo $products_add->Discontinued->editAttributes() ?>>
	<label class="custom-control-label" for="x_Discontinued[]"></label>
</div>
</span>
<?php echo $products_add->Discontinued->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$products_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $products_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $products_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$products_add->showPageFooter();
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
$products_add->terminate();
?>