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
$orders_edit = new orders_edit();

// Run the page
$orders_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fordersedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fordersedit = currentForm = new ew.Form("fordersedit", "edit");

	// Validate form
	fordersedit.validate = function() {
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
			<?php if ($orders_edit->OrderID->Required) { ?>
				elm = this.getElements("x" + infix + "_OrderID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_edit->OrderID->caption(), $orders_edit->OrderID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($orders_edit->CustomerID->Required) { ?>
				elm = this.getElements("x" + infix + "_CustomerID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_edit->CustomerID->caption(), $orders_edit->CustomerID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($orders_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_edit->EmployeeID->caption(), $orders_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orders_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($orders_edit->OrderDate->Required) { ?>
				elm = this.getElements("x" + infix + "_OrderDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_edit->OrderDate->caption(), $orders_edit->OrderDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OrderDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orders_edit->OrderDate->errorMessage()) ?>");
			<?php if ($orders_edit->RequiredDate->Required) { ?>
				elm = this.getElements("x" + infix + "_RequiredDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_edit->RequiredDate->caption(), $orders_edit->RequiredDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RequiredDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orders_edit->RequiredDate->errorMessage()) ?>");
			<?php if ($orders_edit->ShippedDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ShippedDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_edit->ShippedDate->caption(), $orders_edit->ShippedDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ShippedDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orders_edit->ShippedDate->errorMessage()) ?>");
			<?php if ($orders_edit->ShipVia->Required) { ?>
				elm = this.getElements("x" + infix + "_ShipVia");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_edit->ShipVia->caption(), $orders_edit->ShipVia->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ShipVia");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orders_edit->ShipVia->errorMessage()) ?>");
			<?php if ($orders_edit->Freight->Required) { ?>
				elm = this.getElements("x" + infix + "_Freight");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_edit->Freight->caption(), $orders_edit->Freight->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Freight");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orders_edit->Freight->errorMessage()) ?>");
			<?php if ($orders_edit->ShipName->Required) { ?>
				elm = this.getElements("x" + infix + "_ShipName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_edit->ShipName->caption(), $orders_edit->ShipName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($orders_edit->ShipAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_ShipAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_edit->ShipAddress->caption(), $orders_edit->ShipAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($orders_edit->ShipCity->Required) { ?>
				elm = this.getElements("x" + infix + "_ShipCity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_edit->ShipCity->caption(), $orders_edit->ShipCity->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($orders_edit->ShipRegion->Required) { ?>
				elm = this.getElements("x" + infix + "_ShipRegion");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_edit->ShipRegion->caption(), $orders_edit->ShipRegion->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($orders_edit->ShipPostalCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ShipPostalCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_edit->ShipPostalCode->caption(), $orders_edit->ShipPostalCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($orders_edit->ShipCountry->Required) { ?>
				elm = this.getElements("x" + infix + "_ShipCountry");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_edit->ShipCountry->caption(), $orders_edit->ShipCountry->RequiredErrorMessage)) ?>");
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
	fordersedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fordersedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fordersedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $orders_edit->showPageHeader(); ?>
<?php
$orders_edit->showMessage();
?>
<form name="fordersedit" id="fordersedit" class="<?php echo $orders_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$orders_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($orders_edit->OrderID->Visible) { // OrderID ?>
	<div id="r_OrderID" class="form-group row">
		<label id="elh_orders_OrderID" class="<?php echo $orders_edit->LeftColumnClass ?>"><?php echo $orders_edit->OrderID->caption() ?><?php echo $orders_edit->OrderID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_edit->RightColumnClass ?>"><div <?php echo $orders_edit->OrderID->cellAttributes() ?>>
<span id="el_orders_OrderID">
<span<?php echo $orders_edit->OrderID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($orders_edit->OrderID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="orders" data-field="x_OrderID" name="x_OrderID" id="x_OrderID" value="<?php echo HtmlEncode($orders_edit->OrderID->CurrentValue) ?>">
<?php echo $orders_edit->OrderID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_edit->CustomerID->Visible) { // CustomerID ?>
	<div id="r_CustomerID" class="form-group row">
		<label id="elh_orders_CustomerID" for="x_CustomerID" class="<?php echo $orders_edit->LeftColumnClass ?>"><?php echo $orders_edit->CustomerID->caption() ?><?php echo $orders_edit->CustomerID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_edit->RightColumnClass ?>"><div <?php echo $orders_edit->CustomerID->cellAttributes() ?>>
<span id="el_orders_CustomerID">
<input type="text" data-table="orders" data-field="x_CustomerID" name="x_CustomerID" id="x_CustomerID" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($orders_edit->CustomerID->getPlaceHolder()) ?>" value="<?php echo $orders_edit->CustomerID->EditValue ?>"<?php echo $orders_edit->CustomerID->editAttributes() ?>>
</span>
<?php echo $orders_edit->CustomerID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_orders_EmployeeID" for="x_EmployeeID" class="<?php echo $orders_edit->LeftColumnClass ?>"><?php echo $orders_edit->EmployeeID->caption() ?><?php echo $orders_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_edit->RightColumnClass ?>"><div <?php echo $orders_edit->EmployeeID->cellAttributes() ?>>
<span id="el_orders_EmployeeID">
<input type="text" data-table="orders" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($orders_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $orders_edit->EmployeeID->EditValue ?>"<?php echo $orders_edit->EmployeeID->editAttributes() ?>>
</span>
<?php echo $orders_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_edit->OrderDate->Visible) { // OrderDate ?>
	<div id="r_OrderDate" class="form-group row">
		<label id="elh_orders_OrderDate" for="x_OrderDate" class="<?php echo $orders_edit->LeftColumnClass ?>"><?php echo $orders_edit->OrderDate->caption() ?><?php echo $orders_edit->OrderDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_edit->RightColumnClass ?>"><div <?php echo $orders_edit->OrderDate->cellAttributes() ?>>
<span id="el_orders_OrderDate">
<input type="text" data-table="orders" data-field="x_OrderDate" name="x_OrderDate" id="x_OrderDate" maxlength="19" placeholder="<?php echo HtmlEncode($orders_edit->OrderDate->getPlaceHolder()) ?>" value="<?php echo $orders_edit->OrderDate->EditValue ?>"<?php echo $orders_edit->OrderDate->editAttributes() ?>>
<?php if (!$orders_edit->OrderDate->ReadOnly && !$orders_edit->OrderDate->Disabled && !isset($orders_edit->OrderDate->EditAttrs["readonly"]) && !isset($orders_edit->OrderDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fordersedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fordersedit", "x_OrderDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $orders_edit->OrderDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_edit->RequiredDate->Visible) { // RequiredDate ?>
	<div id="r_RequiredDate" class="form-group row">
		<label id="elh_orders_RequiredDate" for="x_RequiredDate" class="<?php echo $orders_edit->LeftColumnClass ?>"><?php echo $orders_edit->RequiredDate->caption() ?><?php echo $orders_edit->RequiredDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_edit->RightColumnClass ?>"><div <?php echo $orders_edit->RequiredDate->cellAttributes() ?>>
<span id="el_orders_RequiredDate">
<input type="text" data-table="orders" data-field="x_RequiredDate" name="x_RequiredDate" id="x_RequiredDate" maxlength="19" placeholder="<?php echo HtmlEncode($orders_edit->RequiredDate->getPlaceHolder()) ?>" value="<?php echo $orders_edit->RequiredDate->EditValue ?>"<?php echo $orders_edit->RequiredDate->editAttributes() ?>>
<?php if (!$orders_edit->RequiredDate->ReadOnly && !$orders_edit->RequiredDate->Disabled && !isset($orders_edit->RequiredDate->EditAttrs["readonly"]) && !isset($orders_edit->RequiredDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fordersedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fordersedit", "x_RequiredDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $orders_edit->RequiredDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_edit->ShippedDate->Visible) { // ShippedDate ?>
	<div id="r_ShippedDate" class="form-group row">
		<label id="elh_orders_ShippedDate" for="x_ShippedDate" class="<?php echo $orders_edit->LeftColumnClass ?>"><?php echo $orders_edit->ShippedDate->caption() ?><?php echo $orders_edit->ShippedDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_edit->RightColumnClass ?>"><div <?php echo $orders_edit->ShippedDate->cellAttributes() ?>>
<span id="el_orders_ShippedDate">
<input type="text" data-table="orders" data-field="x_ShippedDate" name="x_ShippedDate" id="x_ShippedDate" maxlength="19" placeholder="<?php echo HtmlEncode($orders_edit->ShippedDate->getPlaceHolder()) ?>" value="<?php echo $orders_edit->ShippedDate->EditValue ?>"<?php echo $orders_edit->ShippedDate->editAttributes() ?>>
<?php if (!$orders_edit->ShippedDate->ReadOnly && !$orders_edit->ShippedDate->Disabled && !isset($orders_edit->ShippedDate->EditAttrs["readonly"]) && !isset($orders_edit->ShippedDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fordersedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fordersedit", "x_ShippedDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $orders_edit->ShippedDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_edit->ShipVia->Visible) { // ShipVia ?>
	<div id="r_ShipVia" class="form-group row">
		<label id="elh_orders_ShipVia" for="x_ShipVia" class="<?php echo $orders_edit->LeftColumnClass ?>"><?php echo $orders_edit->ShipVia->caption() ?><?php echo $orders_edit->ShipVia->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_edit->RightColumnClass ?>"><div <?php echo $orders_edit->ShipVia->cellAttributes() ?>>
<span id="el_orders_ShipVia">
<input type="text" data-table="orders" data-field="x_ShipVia" name="x_ShipVia" id="x_ShipVia" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($orders_edit->ShipVia->getPlaceHolder()) ?>" value="<?php echo $orders_edit->ShipVia->EditValue ?>"<?php echo $orders_edit->ShipVia->editAttributes() ?>>
</span>
<?php echo $orders_edit->ShipVia->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_edit->Freight->Visible) { // Freight ?>
	<div id="r_Freight" class="form-group row">
		<label id="elh_orders_Freight" for="x_Freight" class="<?php echo $orders_edit->LeftColumnClass ?>"><?php echo $orders_edit->Freight->caption() ?><?php echo $orders_edit->Freight->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_edit->RightColumnClass ?>"><div <?php echo $orders_edit->Freight->cellAttributes() ?>>
<span id="el_orders_Freight">
<input type="text" data-table="orders" data-field="x_Freight" name="x_Freight" id="x_Freight" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($orders_edit->Freight->getPlaceHolder()) ?>" value="<?php echo $orders_edit->Freight->EditValue ?>"<?php echo $orders_edit->Freight->editAttributes() ?>>
</span>
<?php echo $orders_edit->Freight->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_edit->ShipName->Visible) { // ShipName ?>
	<div id="r_ShipName" class="form-group row">
		<label id="elh_orders_ShipName" for="x_ShipName" class="<?php echo $orders_edit->LeftColumnClass ?>"><?php echo $orders_edit->ShipName->caption() ?><?php echo $orders_edit->ShipName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_edit->RightColumnClass ?>"><div <?php echo $orders_edit->ShipName->cellAttributes() ?>>
<span id="el_orders_ShipName">
<input type="text" data-table="orders" data-field="x_ShipName" name="x_ShipName" id="x_ShipName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($orders_edit->ShipName->getPlaceHolder()) ?>" value="<?php echo $orders_edit->ShipName->EditValue ?>"<?php echo $orders_edit->ShipName->editAttributes() ?>>
</span>
<?php echo $orders_edit->ShipName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_edit->ShipAddress->Visible) { // ShipAddress ?>
	<div id="r_ShipAddress" class="form-group row">
		<label id="elh_orders_ShipAddress" for="x_ShipAddress" class="<?php echo $orders_edit->LeftColumnClass ?>"><?php echo $orders_edit->ShipAddress->caption() ?><?php echo $orders_edit->ShipAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_edit->RightColumnClass ?>"><div <?php echo $orders_edit->ShipAddress->cellAttributes() ?>>
<span id="el_orders_ShipAddress">
<input type="text" data-table="orders" data-field="x_ShipAddress" name="x_ShipAddress" id="x_ShipAddress" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($orders_edit->ShipAddress->getPlaceHolder()) ?>" value="<?php echo $orders_edit->ShipAddress->EditValue ?>"<?php echo $orders_edit->ShipAddress->editAttributes() ?>>
</span>
<?php echo $orders_edit->ShipAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_edit->ShipCity->Visible) { // ShipCity ?>
	<div id="r_ShipCity" class="form-group row">
		<label id="elh_orders_ShipCity" for="x_ShipCity" class="<?php echo $orders_edit->LeftColumnClass ?>"><?php echo $orders_edit->ShipCity->caption() ?><?php echo $orders_edit->ShipCity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_edit->RightColumnClass ?>"><div <?php echo $orders_edit->ShipCity->cellAttributes() ?>>
<span id="el_orders_ShipCity">
<input type="text" data-table="orders" data-field="x_ShipCity" name="x_ShipCity" id="x_ShipCity" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($orders_edit->ShipCity->getPlaceHolder()) ?>" value="<?php echo $orders_edit->ShipCity->EditValue ?>"<?php echo $orders_edit->ShipCity->editAttributes() ?>>
</span>
<?php echo $orders_edit->ShipCity->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_edit->ShipRegion->Visible) { // ShipRegion ?>
	<div id="r_ShipRegion" class="form-group row">
		<label id="elh_orders_ShipRegion" for="x_ShipRegion" class="<?php echo $orders_edit->LeftColumnClass ?>"><?php echo $orders_edit->ShipRegion->caption() ?><?php echo $orders_edit->ShipRegion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_edit->RightColumnClass ?>"><div <?php echo $orders_edit->ShipRegion->cellAttributes() ?>>
<span id="el_orders_ShipRegion">
<input type="text" data-table="orders" data-field="x_ShipRegion" name="x_ShipRegion" id="x_ShipRegion" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($orders_edit->ShipRegion->getPlaceHolder()) ?>" value="<?php echo $orders_edit->ShipRegion->EditValue ?>"<?php echo $orders_edit->ShipRegion->editAttributes() ?>>
</span>
<?php echo $orders_edit->ShipRegion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_edit->ShipPostalCode->Visible) { // ShipPostalCode ?>
	<div id="r_ShipPostalCode" class="form-group row">
		<label id="elh_orders_ShipPostalCode" for="x_ShipPostalCode" class="<?php echo $orders_edit->LeftColumnClass ?>"><?php echo $orders_edit->ShipPostalCode->caption() ?><?php echo $orders_edit->ShipPostalCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_edit->RightColumnClass ?>"><div <?php echo $orders_edit->ShipPostalCode->cellAttributes() ?>>
<span id="el_orders_ShipPostalCode">
<input type="text" data-table="orders" data-field="x_ShipPostalCode" name="x_ShipPostalCode" id="x_ShipPostalCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($orders_edit->ShipPostalCode->getPlaceHolder()) ?>" value="<?php echo $orders_edit->ShipPostalCode->EditValue ?>"<?php echo $orders_edit->ShipPostalCode->editAttributes() ?>>
</span>
<?php echo $orders_edit->ShipPostalCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_edit->ShipCountry->Visible) { // ShipCountry ?>
	<div id="r_ShipCountry" class="form-group row">
		<label id="elh_orders_ShipCountry" for="x_ShipCountry" class="<?php echo $orders_edit->LeftColumnClass ?>"><?php echo $orders_edit->ShipCountry->caption() ?><?php echo $orders_edit->ShipCountry->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_edit->RightColumnClass ?>"><div <?php echo $orders_edit->ShipCountry->cellAttributes() ?>>
<span id="el_orders_ShipCountry">
<input type="text" data-table="orders" data-field="x_ShipCountry" name="x_ShipCountry" id="x_ShipCountry" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($orders_edit->ShipCountry->getPlaceHolder()) ?>" value="<?php echo $orders_edit->ShipCountry->EditValue ?>"<?php echo $orders_edit->ShipCountry->editAttributes() ?>>
</span>
<?php echo $orders_edit->ShipCountry->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$orders_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $orders_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $orders_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$orders_edit->showPageFooter();
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
$orders_edit->terminate();
?>