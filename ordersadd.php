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
$orders_add = new orders_add();

// Run the page
$orders_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fordersadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fordersadd = currentForm = new ew.Form("fordersadd", "add");

	// Validate form
	fordersadd.validate = function() {
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
			<?php if ($orders_add->CustomerID->Required) { ?>
				elm = this.getElements("x" + infix + "_CustomerID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_add->CustomerID->caption(), $orders_add->CustomerID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($orders_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_add->EmployeeID->caption(), $orders_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orders_add->EmployeeID->errorMessage()) ?>");
			<?php if ($orders_add->OrderDate->Required) { ?>
				elm = this.getElements("x" + infix + "_OrderDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_add->OrderDate->caption(), $orders_add->OrderDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OrderDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orders_add->OrderDate->errorMessage()) ?>");
			<?php if ($orders_add->RequiredDate->Required) { ?>
				elm = this.getElements("x" + infix + "_RequiredDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_add->RequiredDate->caption(), $orders_add->RequiredDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RequiredDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orders_add->RequiredDate->errorMessage()) ?>");
			<?php if ($orders_add->ShippedDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ShippedDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_add->ShippedDate->caption(), $orders_add->ShippedDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ShippedDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orders_add->ShippedDate->errorMessage()) ?>");
			<?php if ($orders_add->ShipVia->Required) { ?>
				elm = this.getElements("x" + infix + "_ShipVia");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_add->ShipVia->caption(), $orders_add->ShipVia->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ShipVia");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orders_add->ShipVia->errorMessage()) ?>");
			<?php if ($orders_add->Freight->Required) { ?>
				elm = this.getElements("x" + infix + "_Freight");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_add->Freight->caption(), $orders_add->Freight->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Freight");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orders_add->Freight->errorMessage()) ?>");
			<?php if ($orders_add->ShipName->Required) { ?>
				elm = this.getElements("x" + infix + "_ShipName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_add->ShipName->caption(), $orders_add->ShipName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($orders_add->ShipAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_ShipAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_add->ShipAddress->caption(), $orders_add->ShipAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($orders_add->ShipCity->Required) { ?>
				elm = this.getElements("x" + infix + "_ShipCity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_add->ShipCity->caption(), $orders_add->ShipCity->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($orders_add->ShipRegion->Required) { ?>
				elm = this.getElements("x" + infix + "_ShipRegion");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_add->ShipRegion->caption(), $orders_add->ShipRegion->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($orders_add->ShipPostalCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ShipPostalCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_add->ShipPostalCode->caption(), $orders_add->ShipPostalCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($orders_add->ShipCountry->Required) { ?>
				elm = this.getElements("x" + infix + "_ShipCountry");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_add->ShipCountry->caption(), $orders_add->ShipCountry->RequiredErrorMessage)) ?>");
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
	fordersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fordersadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fordersadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $orders_add->showPageHeader(); ?>
<?php
$orders_add->showMessage();
?>
<form name="fordersadd" id="fordersadd" class="<?php echo $orders_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$orders_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($orders_add->CustomerID->Visible) { // CustomerID ?>
	<div id="r_CustomerID" class="form-group row">
		<label id="elh_orders_CustomerID" for="x_CustomerID" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders_add->CustomerID->caption() ?><?php echo $orders_add->CustomerID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div <?php echo $orders_add->CustomerID->cellAttributes() ?>>
<span id="el_orders_CustomerID">
<input type="text" data-table="orders" data-field="x_CustomerID" name="x_CustomerID" id="x_CustomerID" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($orders_add->CustomerID->getPlaceHolder()) ?>" value="<?php echo $orders_add->CustomerID->EditValue ?>"<?php echo $orders_add->CustomerID->editAttributes() ?>>
</span>
<?php echo $orders_add->CustomerID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_orders_EmployeeID" for="x_EmployeeID" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders_add->EmployeeID->caption() ?><?php echo $orders_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div <?php echo $orders_add->EmployeeID->cellAttributes() ?>>
<span id="el_orders_EmployeeID">
<input type="text" data-table="orders" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($orders_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $orders_add->EmployeeID->EditValue ?>"<?php echo $orders_add->EmployeeID->editAttributes() ?>>
</span>
<?php echo $orders_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_add->OrderDate->Visible) { // OrderDate ?>
	<div id="r_OrderDate" class="form-group row">
		<label id="elh_orders_OrderDate" for="x_OrderDate" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders_add->OrderDate->caption() ?><?php echo $orders_add->OrderDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div <?php echo $orders_add->OrderDate->cellAttributes() ?>>
<span id="el_orders_OrderDate">
<input type="text" data-table="orders" data-field="x_OrderDate" name="x_OrderDate" id="x_OrderDate" maxlength="19" placeholder="<?php echo HtmlEncode($orders_add->OrderDate->getPlaceHolder()) ?>" value="<?php echo $orders_add->OrderDate->EditValue ?>"<?php echo $orders_add->OrderDate->editAttributes() ?>>
<?php if (!$orders_add->OrderDate->ReadOnly && !$orders_add->OrderDate->Disabled && !isset($orders_add->OrderDate->EditAttrs["readonly"]) && !isset($orders_add->OrderDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fordersadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fordersadd", "x_OrderDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $orders_add->OrderDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_add->RequiredDate->Visible) { // RequiredDate ?>
	<div id="r_RequiredDate" class="form-group row">
		<label id="elh_orders_RequiredDate" for="x_RequiredDate" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders_add->RequiredDate->caption() ?><?php echo $orders_add->RequiredDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div <?php echo $orders_add->RequiredDate->cellAttributes() ?>>
<span id="el_orders_RequiredDate">
<input type="text" data-table="orders" data-field="x_RequiredDate" name="x_RequiredDate" id="x_RequiredDate" maxlength="19" placeholder="<?php echo HtmlEncode($orders_add->RequiredDate->getPlaceHolder()) ?>" value="<?php echo $orders_add->RequiredDate->EditValue ?>"<?php echo $orders_add->RequiredDate->editAttributes() ?>>
<?php if (!$orders_add->RequiredDate->ReadOnly && !$orders_add->RequiredDate->Disabled && !isset($orders_add->RequiredDate->EditAttrs["readonly"]) && !isset($orders_add->RequiredDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fordersadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fordersadd", "x_RequiredDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $orders_add->RequiredDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_add->ShippedDate->Visible) { // ShippedDate ?>
	<div id="r_ShippedDate" class="form-group row">
		<label id="elh_orders_ShippedDate" for="x_ShippedDate" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders_add->ShippedDate->caption() ?><?php echo $orders_add->ShippedDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div <?php echo $orders_add->ShippedDate->cellAttributes() ?>>
<span id="el_orders_ShippedDate">
<input type="text" data-table="orders" data-field="x_ShippedDate" name="x_ShippedDate" id="x_ShippedDate" maxlength="19" placeholder="<?php echo HtmlEncode($orders_add->ShippedDate->getPlaceHolder()) ?>" value="<?php echo $orders_add->ShippedDate->EditValue ?>"<?php echo $orders_add->ShippedDate->editAttributes() ?>>
<?php if (!$orders_add->ShippedDate->ReadOnly && !$orders_add->ShippedDate->Disabled && !isset($orders_add->ShippedDate->EditAttrs["readonly"]) && !isset($orders_add->ShippedDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fordersadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fordersadd", "x_ShippedDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $orders_add->ShippedDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_add->ShipVia->Visible) { // ShipVia ?>
	<div id="r_ShipVia" class="form-group row">
		<label id="elh_orders_ShipVia" for="x_ShipVia" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders_add->ShipVia->caption() ?><?php echo $orders_add->ShipVia->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div <?php echo $orders_add->ShipVia->cellAttributes() ?>>
<span id="el_orders_ShipVia">
<input type="text" data-table="orders" data-field="x_ShipVia" name="x_ShipVia" id="x_ShipVia" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($orders_add->ShipVia->getPlaceHolder()) ?>" value="<?php echo $orders_add->ShipVia->EditValue ?>"<?php echo $orders_add->ShipVia->editAttributes() ?>>
</span>
<?php echo $orders_add->ShipVia->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_add->Freight->Visible) { // Freight ?>
	<div id="r_Freight" class="form-group row">
		<label id="elh_orders_Freight" for="x_Freight" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders_add->Freight->caption() ?><?php echo $orders_add->Freight->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div <?php echo $orders_add->Freight->cellAttributes() ?>>
<span id="el_orders_Freight">
<input type="text" data-table="orders" data-field="x_Freight" name="x_Freight" id="x_Freight" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($orders_add->Freight->getPlaceHolder()) ?>" value="<?php echo $orders_add->Freight->EditValue ?>"<?php echo $orders_add->Freight->editAttributes() ?>>
</span>
<?php echo $orders_add->Freight->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_add->ShipName->Visible) { // ShipName ?>
	<div id="r_ShipName" class="form-group row">
		<label id="elh_orders_ShipName" for="x_ShipName" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders_add->ShipName->caption() ?><?php echo $orders_add->ShipName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div <?php echo $orders_add->ShipName->cellAttributes() ?>>
<span id="el_orders_ShipName">
<input type="text" data-table="orders" data-field="x_ShipName" name="x_ShipName" id="x_ShipName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($orders_add->ShipName->getPlaceHolder()) ?>" value="<?php echo $orders_add->ShipName->EditValue ?>"<?php echo $orders_add->ShipName->editAttributes() ?>>
</span>
<?php echo $orders_add->ShipName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_add->ShipAddress->Visible) { // ShipAddress ?>
	<div id="r_ShipAddress" class="form-group row">
		<label id="elh_orders_ShipAddress" for="x_ShipAddress" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders_add->ShipAddress->caption() ?><?php echo $orders_add->ShipAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div <?php echo $orders_add->ShipAddress->cellAttributes() ?>>
<span id="el_orders_ShipAddress">
<input type="text" data-table="orders" data-field="x_ShipAddress" name="x_ShipAddress" id="x_ShipAddress" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($orders_add->ShipAddress->getPlaceHolder()) ?>" value="<?php echo $orders_add->ShipAddress->EditValue ?>"<?php echo $orders_add->ShipAddress->editAttributes() ?>>
</span>
<?php echo $orders_add->ShipAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_add->ShipCity->Visible) { // ShipCity ?>
	<div id="r_ShipCity" class="form-group row">
		<label id="elh_orders_ShipCity" for="x_ShipCity" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders_add->ShipCity->caption() ?><?php echo $orders_add->ShipCity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div <?php echo $orders_add->ShipCity->cellAttributes() ?>>
<span id="el_orders_ShipCity">
<input type="text" data-table="orders" data-field="x_ShipCity" name="x_ShipCity" id="x_ShipCity" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($orders_add->ShipCity->getPlaceHolder()) ?>" value="<?php echo $orders_add->ShipCity->EditValue ?>"<?php echo $orders_add->ShipCity->editAttributes() ?>>
</span>
<?php echo $orders_add->ShipCity->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_add->ShipRegion->Visible) { // ShipRegion ?>
	<div id="r_ShipRegion" class="form-group row">
		<label id="elh_orders_ShipRegion" for="x_ShipRegion" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders_add->ShipRegion->caption() ?><?php echo $orders_add->ShipRegion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div <?php echo $orders_add->ShipRegion->cellAttributes() ?>>
<span id="el_orders_ShipRegion">
<input type="text" data-table="orders" data-field="x_ShipRegion" name="x_ShipRegion" id="x_ShipRegion" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($orders_add->ShipRegion->getPlaceHolder()) ?>" value="<?php echo $orders_add->ShipRegion->EditValue ?>"<?php echo $orders_add->ShipRegion->editAttributes() ?>>
</span>
<?php echo $orders_add->ShipRegion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_add->ShipPostalCode->Visible) { // ShipPostalCode ?>
	<div id="r_ShipPostalCode" class="form-group row">
		<label id="elh_orders_ShipPostalCode" for="x_ShipPostalCode" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders_add->ShipPostalCode->caption() ?><?php echo $orders_add->ShipPostalCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div <?php echo $orders_add->ShipPostalCode->cellAttributes() ?>>
<span id="el_orders_ShipPostalCode">
<input type="text" data-table="orders" data-field="x_ShipPostalCode" name="x_ShipPostalCode" id="x_ShipPostalCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($orders_add->ShipPostalCode->getPlaceHolder()) ?>" value="<?php echo $orders_add->ShipPostalCode->EditValue ?>"<?php echo $orders_add->ShipPostalCode->editAttributes() ?>>
</span>
<?php echo $orders_add->ShipPostalCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_add->ShipCountry->Visible) { // ShipCountry ?>
	<div id="r_ShipCountry" class="form-group row">
		<label id="elh_orders_ShipCountry" for="x_ShipCountry" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders_add->ShipCountry->caption() ?><?php echo $orders_add->ShipCountry->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div <?php echo $orders_add->ShipCountry->cellAttributes() ?>>
<span id="el_orders_ShipCountry">
<input type="text" data-table="orders" data-field="x_ShipCountry" name="x_ShipCountry" id="x_ShipCountry" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($orders_add->ShipCountry->getPlaceHolder()) ?>" value="<?php echo $orders_add->ShipCountry->EditValue ?>"<?php echo $orders_add->ShipCountry->editAttributes() ?>>
</span>
<?php echo $orders_add->ShipCountry->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$orders_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $orders_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $orders_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$orders_add->showPageFooter();
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
$orders_add->terminate();
?>