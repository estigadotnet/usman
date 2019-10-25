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
$products_edit = new products_edit();

// Run the page
$products_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$products_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproductsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fproductsedit = currentForm = new ew.Form("fproductsedit", "edit");

	// Validate form
	fproductsedit.validate = function() {
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
			<?php if ($products_edit->ProductID->Required) { ?>
				elm = this.getElements("x" + infix + "_ProductID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_edit->ProductID->caption(), $products_edit->ProductID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($products_edit->ProductName->Required) { ?>
				elm = this.getElements("x" + infix + "_ProductName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_edit->ProductName->caption(), $products_edit->ProductName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($products_edit->SupplierID->Required) { ?>
				elm = this.getElements("x" + infix + "_SupplierID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_edit->SupplierID->caption(), $products_edit->SupplierID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SupplierID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($products_edit->SupplierID->errorMessage()) ?>");
			<?php if ($products_edit->CategoryID->Required) { ?>
				elm = this.getElements("x" + infix + "_CategoryID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_edit->CategoryID->caption(), $products_edit->CategoryID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CategoryID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($products_edit->CategoryID->errorMessage()) ?>");
			<?php if ($products_edit->QuantityPerUnit->Required) { ?>
				elm = this.getElements("x" + infix + "_QuantityPerUnit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_edit->QuantityPerUnit->caption(), $products_edit->QuantityPerUnit->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($products_edit->UnitPrice->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitPrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_edit->UnitPrice->caption(), $products_edit->UnitPrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_UnitPrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($products_edit->UnitPrice->errorMessage()) ?>");
			<?php if ($products_edit->UnitsInStock->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitsInStock");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_edit->UnitsInStock->caption(), $products_edit->UnitsInStock->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_UnitsInStock");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($products_edit->UnitsInStock->errorMessage()) ?>");
			<?php if ($products_edit->UnitsOnOrder->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitsOnOrder");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_edit->UnitsOnOrder->caption(), $products_edit->UnitsOnOrder->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_UnitsOnOrder");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($products_edit->UnitsOnOrder->errorMessage()) ?>");
			<?php if ($products_edit->ReorderLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_ReorderLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_edit->ReorderLevel->caption(), $products_edit->ReorderLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ReorderLevel");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($products_edit->ReorderLevel->errorMessage()) ?>");
			<?php if ($products_edit->Discontinued->Required) { ?>
				elm = this.getElements("x" + infix + "_Discontinued[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_edit->Discontinued->caption(), $products_edit->Discontinued->RequiredErrorMessage)) ?>");
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
	fproductsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproductsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fproductsedit.lists["x_Discontinued[]"] = <?php echo $products_edit->Discontinued->Lookup->toClientList($products_edit) ?>;
	fproductsedit.lists["x_Discontinued[]"].options = <?php echo JsonEncode($products_edit->Discontinued->options(FALSE, TRUE)) ?>;
	loadjs.done("fproductsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $products_edit->showPageHeader(); ?>
<?php
$products_edit->showMessage();
?>
<form name="fproductsedit" id="fproductsedit" class="<?php echo $products_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="products">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$products_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($products_edit->ProductID->Visible) { // ProductID ?>
	<div id="r_ProductID" class="form-group row">
		<label id="elh_products_ProductID" class="<?php echo $products_edit->LeftColumnClass ?>"><?php echo $products_edit->ProductID->caption() ?><?php echo $products_edit->ProductID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_edit->RightColumnClass ?>"><div <?php echo $products_edit->ProductID->cellAttributes() ?>>
<span id="el_products_ProductID">
<span<?php echo $products_edit->ProductID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($products_edit->ProductID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="products" data-field="x_ProductID" name="x_ProductID" id="x_ProductID" value="<?php echo HtmlEncode($products_edit->ProductID->CurrentValue) ?>">
<?php echo $products_edit->ProductID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($products_edit->ProductName->Visible) { // ProductName ?>
	<div id="r_ProductName" class="form-group row">
		<label id="elh_products_ProductName" for="x_ProductName" class="<?php echo $products_edit->LeftColumnClass ?>"><?php echo $products_edit->ProductName->caption() ?><?php echo $products_edit->ProductName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_edit->RightColumnClass ?>"><div <?php echo $products_edit->ProductName->cellAttributes() ?>>
<span id="el_products_ProductName">
<input type="text" data-table="products" data-field="x_ProductName" name="x_ProductName" id="x_ProductName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($products_edit->ProductName->getPlaceHolder()) ?>" value="<?php echo $products_edit->ProductName->EditValue ?>"<?php echo $products_edit->ProductName->editAttributes() ?>>
</span>
<?php echo $products_edit->ProductName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($products_edit->SupplierID->Visible) { // SupplierID ?>
	<div id="r_SupplierID" class="form-group row">
		<label id="elh_products_SupplierID" for="x_SupplierID" class="<?php echo $products_edit->LeftColumnClass ?>"><?php echo $products_edit->SupplierID->caption() ?><?php echo $products_edit->SupplierID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_edit->RightColumnClass ?>"><div <?php echo $products_edit->SupplierID->cellAttributes() ?>>
<span id="el_products_SupplierID">
<input type="text" data-table="products" data-field="x_SupplierID" name="x_SupplierID" id="x_SupplierID" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($products_edit->SupplierID->getPlaceHolder()) ?>" value="<?php echo $products_edit->SupplierID->EditValue ?>"<?php echo $products_edit->SupplierID->editAttributes() ?>>
</span>
<?php echo $products_edit->SupplierID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($products_edit->CategoryID->Visible) { // CategoryID ?>
	<div id="r_CategoryID" class="form-group row">
		<label id="elh_products_CategoryID" for="x_CategoryID" class="<?php echo $products_edit->LeftColumnClass ?>"><?php echo $products_edit->CategoryID->caption() ?><?php echo $products_edit->CategoryID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_edit->RightColumnClass ?>"><div <?php echo $products_edit->CategoryID->cellAttributes() ?>>
<span id="el_products_CategoryID">
<input type="text" data-table="products" data-field="x_CategoryID" name="x_CategoryID" id="x_CategoryID" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($products_edit->CategoryID->getPlaceHolder()) ?>" value="<?php echo $products_edit->CategoryID->EditValue ?>"<?php echo $products_edit->CategoryID->editAttributes() ?>>
</span>
<?php echo $products_edit->CategoryID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($products_edit->QuantityPerUnit->Visible) { // QuantityPerUnit ?>
	<div id="r_QuantityPerUnit" class="form-group row">
		<label id="elh_products_QuantityPerUnit" for="x_QuantityPerUnit" class="<?php echo $products_edit->LeftColumnClass ?>"><?php echo $products_edit->QuantityPerUnit->caption() ?><?php echo $products_edit->QuantityPerUnit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_edit->RightColumnClass ?>"><div <?php echo $products_edit->QuantityPerUnit->cellAttributes() ?>>
<span id="el_products_QuantityPerUnit">
<input type="text" data-table="products" data-field="x_QuantityPerUnit" name="x_QuantityPerUnit" id="x_QuantityPerUnit" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($products_edit->QuantityPerUnit->getPlaceHolder()) ?>" value="<?php echo $products_edit->QuantityPerUnit->EditValue ?>"<?php echo $products_edit->QuantityPerUnit->editAttributes() ?>>
</span>
<?php echo $products_edit->QuantityPerUnit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($products_edit->UnitPrice->Visible) { // UnitPrice ?>
	<div id="r_UnitPrice" class="form-group row">
		<label id="elh_products_UnitPrice" for="x_UnitPrice" class="<?php echo $products_edit->LeftColumnClass ?>"><?php echo $products_edit->UnitPrice->caption() ?><?php echo $products_edit->UnitPrice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_edit->RightColumnClass ?>"><div <?php echo $products_edit->UnitPrice->cellAttributes() ?>>
<span id="el_products_UnitPrice">
<input type="text" data-table="products" data-field="x_UnitPrice" name="x_UnitPrice" id="x_UnitPrice" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($products_edit->UnitPrice->getPlaceHolder()) ?>" value="<?php echo $products_edit->UnitPrice->EditValue ?>"<?php echo $products_edit->UnitPrice->editAttributes() ?>>
</span>
<?php echo $products_edit->UnitPrice->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($products_edit->UnitsInStock->Visible) { // UnitsInStock ?>
	<div id="r_UnitsInStock" class="form-group row">
		<label id="elh_products_UnitsInStock" for="x_UnitsInStock" class="<?php echo $products_edit->LeftColumnClass ?>"><?php echo $products_edit->UnitsInStock->caption() ?><?php echo $products_edit->UnitsInStock->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_edit->RightColumnClass ?>"><div <?php echo $products_edit->UnitsInStock->cellAttributes() ?>>
<span id="el_products_UnitsInStock">
<input type="text" data-table="products" data-field="x_UnitsInStock" name="x_UnitsInStock" id="x_UnitsInStock" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($products_edit->UnitsInStock->getPlaceHolder()) ?>" value="<?php echo $products_edit->UnitsInStock->EditValue ?>"<?php echo $products_edit->UnitsInStock->editAttributes() ?>>
</span>
<?php echo $products_edit->UnitsInStock->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($products_edit->UnitsOnOrder->Visible) { // UnitsOnOrder ?>
	<div id="r_UnitsOnOrder" class="form-group row">
		<label id="elh_products_UnitsOnOrder" for="x_UnitsOnOrder" class="<?php echo $products_edit->LeftColumnClass ?>"><?php echo $products_edit->UnitsOnOrder->caption() ?><?php echo $products_edit->UnitsOnOrder->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_edit->RightColumnClass ?>"><div <?php echo $products_edit->UnitsOnOrder->cellAttributes() ?>>
<span id="el_products_UnitsOnOrder">
<input type="text" data-table="products" data-field="x_UnitsOnOrder" name="x_UnitsOnOrder" id="x_UnitsOnOrder" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($products_edit->UnitsOnOrder->getPlaceHolder()) ?>" value="<?php echo $products_edit->UnitsOnOrder->EditValue ?>"<?php echo $products_edit->UnitsOnOrder->editAttributes() ?>>
</span>
<?php echo $products_edit->UnitsOnOrder->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($products_edit->ReorderLevel->Visible) { // ReorderLevel ?>
	<div id="r_ReorderLevel" class="form-group row">
		<label id="elh_products_ReorderLevel" for="x_ReorderLevel" class="<?php echo $products_edit->LeftColumnClass ?>"><?php echo $products_edit->ReorderLevel->caption() ?><?php echo $products_edit->ReorderLevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_edit->RightColumnClass ?>"><div <?php echo $products_edit->ReorderLevel->cellAttributes() ?>>
<span id="el_products_ReorderLevel">
<input type="text" data-table="products" data-field="x_ReorderLevel" name="x_ReorderLevel" id="x_ReorderLevel" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($products_edit->ReorderLevel->getPlaceHolder()) ?>" value="<?php echo $products_edit->ReorderLevel->EditValue ?>"<?php echo $products_edit->ReorderLevel->editAttributes() ?>>
</span>
<?php echo $products_edit->ReorderLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($products_edit->Discontinued->Visible) { // Discontinued ?>
	<div id="r_Discontinued" class="form-group row">
		<label id="elh_products_Discontinued" class="<?php echo $products_edit->LeftColumnClass ?>"><?php echo $products_edit->Discontinued->caption() ?><?php echo $products_edit->Discontinued->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_edit->RightColumnClass ?>"><div <?php echo $products_edit->Discontinued->cellAttributes() ?>>
<span id="el_products_Discontinued">
<?php
$selwrk = ConvertToBool($products_edit->Discontinued->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="products" data-field="x_Discontinued" name="x_Discontinued[]" id="x_Discontinued[]" value="1"<?php echo $selwrk ?><?php echo $products_edit->Discontinued->editAttributes() ?>>
	<label class="custom-control-label" for="x_Discontinued[]"></label>
</div>
</span>
<?php echo $products_edit->Discontinued->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$products_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $products_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $products_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$products_edit->showPageFooter();
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
$products_edit->terminate();
?>