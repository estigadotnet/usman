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
$orderdetails_edit = new orderdetails_edit();

// Run the page
$orderdetails_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orderdetails_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var forderdetailsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	forderdetailsedit = currentForm = new ew.Form("forderdetailsedit", "edit");

	// Validate form
	forderdetailsedit.validate = function() {
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
			<?php if ($orderdetails_edit->OrderID->Required) { ?>
				elm = this.getElements("x" + infix + "_OrderID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orderdetails_edit->OrderID->caption(), $orderdetails_edit->OrderID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OrderID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orderdetails_edit->OrderID->errorMessage()) ?>");
			<?php if ($orderdetails_edit->ProductID->Required) { ?>
				elm = this.getElements("x" + infix + "_ProductID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orderdetails_edit->ProductID->caption(), $orderdetails_edit->ProductID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProductID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orderdetails_edit->ProductID->errorMessage()) ?>");
			<?php if ($orderdetails_edit->UnitPrice->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitPrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orderdetails_edit->UnitPrice->caption(), $orderdetails_edit->UnitPrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_UnitPrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orderdetails_edit->UnitPrice->errorMessage()) ?>");
			<?php if ($orderdetails_edit->Quantity->Required) { ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orderdetails_edit->Quantity->caption(), $orderdetails_edit->Quantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orderdetails_edit->Quantity->errorMessage()) ?>");
			<?php if ($orderdetails_edit->Discount->Required) { ?>
				elm = this.getElements("x" + infix + "_Discount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orderdetails_edit->Discount->caption(), $orderdetails_edit->Discount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Discount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orderdetails_edit->Discount->errorMessage()) ?>");

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
	forderdetailsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	forderdetailsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("forderdetailsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $orderdetails_edit->showPageHeader(); ?>
<?php
$orderdetails_edit->showMessage();
?>
<form name="forderdetailsedit" id="forderdetailsedit" class="<?php echo $orderdetails_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orderdetails">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$orderdetails_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($orderdetails_edit->OrderID->Visible) { // OrderID ?>
	<div id="r_OrderID" class="form-group row">
		<label id="elh_orderdetails_OrderID" for="x_OrderID" class="<?php echo $orderdetails_edit->LeftColumnClass ?>"><?php echo $orderdetails_edit->OrderID->caption() ?><?php echo $orderdetails_edit->OrderID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orderdetails_edit->RightColumnClass ?>"><div <?php echo $orderdetails_edit->OrderID->cellAttributes() ?>>
<input type="text" data-table="orderdetails" data-field="x_OrderID" name="x_OrderID" id="x_OrderID" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($orderdetails_edit->OrderID->getPlaceHolder()) ?>" value="<?php echo $orderdetails_edit->OrderID->EditValue ?>"<?php echo $orderdetails_edit->OrderID->editAttributes() ?>>
<input type="hidden" data-table="orderdetails" data-field="x_OrderID" name="o_OrderID" id="o_OrderID" value="<?php echo HtmlEncode($orderdetails_edit->OrderID->OldValue != null ? $orderdetails_edit->OrderID->OldValue : $orderdetails_edit->OrderID->CurrentValue) ?>">
<?php echo $orderdetails_edit->OrderID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orderdetails_edit->ProductID->Visible) { // ProductID ?>
	<div id="r_ProductID" class="form-group row">
		<label id="elh_orderdetails_ProductID" for="x_ProductID" class="<?php echo $orderdetails_edit->LeftColumnClass ?>"><?php echo $orderdetails_edit->ProductID->caption() ?><?php echo $orderdetails_edit->ProductID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orderdetails_edit->RightColumnClass ?>"><div <?php echo $orderdetails_edit->ProductID->cellAttributes() ?>>
<input type="text" data-table="orderdetails" data-field="x_ProductID" name="x_ProductID" id="x_ProductID" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($orderdetails_edit->ProductID->getPlaceHolder()) ?>" value="<?php echo $orderdetails_edit->ProductID->EditValue ?>"<?php echo $orderdetails_edit->ProductID->editAttributes() ?>>
<input type="hidden" data-table="orderdetails" data-field="x_ProductID" name="o_ProductID" id="o_ProductID" value="<?php echo HtmlEncode($orderdetails_edit->ProductID->OldValue != null ? $orderdetails_edit->ProductID->OldValue : $orderdetails_edit->ProductID->CurrentValue) ?>">
<?php echo $orderdetails_edit->ProductID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orderdetails_edit->UnitPrice->Visible) { // UnitPrice ?>
	<div id="r_UnitPrice" class="form-group row">
		<label id="elh_orderdetails_UnitPrice" for="x_UnitPrice" class="<?php echo $orderdetails_edit->LeftColumnClass ?>"><?php echo $orderdetails_edit->UnitPrice->caption() ?><?php echo $orderdetails_edit->UnitPrice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orderdetails_edit->RightColumnClass ?>"><div <?php echo $orderdetails_edit->UnitPrice->cellAttributes() ?>>
<span id="el_orderdetails_UnitPrice">
<input type="text" data-table="orderdetails" data-field="x_UnitPrice" name="x_UnitPrice" id="x_UnitPrice" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($orderdetails_edit->UnitPrice->getPlaceHolder()) ?>" value="<?php echo $orderdetails_edit->UnitPrice->EditValue ?>"<?php echo $orderdetails_edit->UnitPrice->editAttributes() ?>>
</span>
<?php echo $orderdetails_edit->UnitPrice->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orderdetails_edit->Quantity->Visible) { // Quantity ?>
	<div id="r_Quantity" class="form-group row">
		<label id="elh_orderdetails_Quantity" for="x_Quantity" class="<?php echo $orderdetails_edit->LeftColumnClass ?>"><?php echo $orderdetails_edit->Quantity->caption() ?><?php echo $orderdetails_edit->Quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orderdetails_edit->RightColumnClass ?>"><div <?php echo $orderdetails_edit->Quantity->cellAttributes() ?>>
<span id="el_orderdetails_Quantity">
<input type="text" data-table="orderdetails" data-field="x_Quantity" name="x_Quantity" id="x_Quantity" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($orderdetails_edit->Quantity->getPlaceHolder()) ?>" value="<?php echo $orderdetails_edit->Quantity->EditValue ?>"<?php echo $orderdetails_edit->Quantity->editAttributes() ?>>
</span>
<?php echo $orderdetails_edit->Quantity->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orderdetails_edit->Discount->Visible) { // Discount ?>
	<div id="r_Discount" class="form-group row">
		<label id="elh_orderdetails_Discount" for="x_Discount" class="<?php echo $orderdetails_edit->LeftColumnClass ?>"><?php echo $orderdetails_edit->Discount->caption() ?><?php echo $orderdetails_edit->Discount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orderdetails_edit->RightColumnClass ?>"><div <?php echo $orderdetails_edit->Discount->cellAttributes() ?>>
<span id="el_orderdetails_Discount">
<input type="text" data-table="orderdetails" data-field="x_Discount" name="x_Discount" id="x_Discount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($orderdetails_edit->Discount->getPlaceHolder()) ?>" value="<?php echo $orderdetails_edit->Discount->EditValue ?>"<?php echo $orderdetails_edit->Discount->editAttributes() ?>>
</span>
<?php echo $orderdetails_edit->Discount->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$orderdetails_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $orderdetails_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $orderdetails_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$orderdetails_edit->showPageFooter();
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
$orderdetails_edit->terminate();
?>