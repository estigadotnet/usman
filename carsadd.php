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
$cars_add = new cars_add();

// Run the page
$cars_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cars_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcarsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcarsadd = currentForm = new ew.Form("fcarsadd", "add");

	// Validate form
	fcarsadd.validate = function() {
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
			<?php if ($cars_add->Trademark->Required) { ?>
				elm = this.getElements("x" + infix + "_Trademark");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars_add->Trademark->caption(), $cars_add->Trademark->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Trademark");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cars_add->Trademark->errorMessage()) ?>");
			<?php if ($cars_add->Model->Required) { ?>
				elm = this.getElements("x" + infix + "_Model");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars_add->Model->caption(), $cars_add->Model->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Model");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cars_add->Model->errorMessage()) ?>");
			<?php if ($cars_add->HP->Required) { ?>
				elm = this.getElements("x" + infix + "_HP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars_add->HP->caption(), $cars_add->HP->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_HP");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cars_add->HP->errorMessage()) ?>");
			<?php if ($cars_add->Liter->Required) { ?>
				elm = this.getElements("x" + infix + "_Liter");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars_add->Liter->caption(), $cars_add->Liter->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Liter");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cars_add->Liter->errorMessage()) ?>");
			<?php if ($cars_add->Cyl->Required) { ?>
				elm = this.getElements("x" + infix + "_Cyl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars_add->Cyl->caption(), $cars_add->Cyl->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Cyl");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cars_add->Cyl->errorMessage()) ?>");
			<?php if ($cars_add->TransmissSpeedCount->Required) { ?>
				elm = this.getElements("x" + infix + "_TransmissSpeedCount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars_add->TransmissSpeedCount->caption(), $cars_add->TransmissSpeedCount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TransmissSpeedCount");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cars_add->TransmissSpeedCount->errorMessage()) ?>");
			<?php if ($cars_add->TransmissAutomatic->Required) { ?>
				elm = this.getElements("x" + infix + "_TransmissAutomatic");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars_add->TransmissAutomatic->caption(), $cars_add->TransmissAutomatic->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cars_add->MPG_City->Required) { ?>
				elm = this.getElements("x" + infix + "_MPG_City");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars_add->MPG_City->caption(), $cars_add->MPG_City->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MPG_City");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cars_add->MPG_City->errorMessage()) ?>");
			<?php if ($cars_add->MPG_Highway->Required) { ?>
				elm = this.getElements("x" + infix + "_MPG_Highway");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars_add->MPG_Highway->caption(), $cars_add->MPG_Highway->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MPG_Highway");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cars_add->MPG_Highway->errorMessage()) ?>");
			<?php if ($cars_add->Category->Required) { ?>
				elm = this.getElements("x" + infix + "_Category");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars_add->Category->caption(), $cars_add->Category->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cars_add->Description->Required) { ?>
				elm = this.getElements("x" + infix + "_Description");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars_add->Description->caption(), $cars_add->Description->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cars_add->Hyperlink->Required) { ?>
				elm = this.getElements("x" + infix + "_Hyperlink");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars_add->Hyperlink->caption(), $cars_add->Hyperlink->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cars_add->Price->Required) { ?>
				elm = this.getElements("x" + infix + "_Price");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars_add->Price->caption(), $cars_add->Price->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Price");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cars_add->Price->errorMessage()) ?>");
			<?php if ($cars_add->Picture->Required) { ?>
				felm = this.getElements("x" + infix + "_Picture");
				elm = this.getElements("fn_x" + infix + "_Picture");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $cars_add->Picture->caption(), $cars_add->Picture->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cars_add->PictureName->Required) { ?>
				elm = this.getElements("x" + infix + "_PictureName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars_add->PictureName->caption(), $cars_add->PictureName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cars_add->PictureSize->Required) { ?>
				elm = this.getElements("x" + infix + "_PictureSize");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars_add->PictureSize->caption(), $cars_add->PictureSize->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PictureSize");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cars_add->PictureSize->errorMessage()) ?>");
			<?php if ($cars_add->PictureType->Required) { ?>
				elm = this.getElements("x" + infix + "_PictureType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars_add->PictureType->caption(), $cars_add->PictureType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cars_add->PictureWidth->Required) { ?>
				elm = this.getElements("x" + infix + "_PictureWidth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars_add->PictureWidth->caption(), $cars_add->PictureWidth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PictureWidth");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cars_add->PictureWidth->errorMessage()) ?>");
			<?php if ($cars_add->PictureHeight->Required) { ?>
				elm = this.getElements("x" + infix + "_PictureHeight");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars_add->PictureHeight->caption(), $cars_add->PictureHeight->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PictureHeight");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cars_add->PictureHeight->errorMessage()) ?>");
			<?php if ($cars_add->Color->Required) { ?>
				elm = this.getElements("x" + infix + "_Color");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cars_add->Color->caption(), $cars_add->Color->RequiredErrorMessage)) ?>");
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
	fcarsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcarsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcarsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cars_add->showPageHeader(); ?>
<?php
$cars_add->showMessage();
?>
<form name="fcarsadd" id="fcarsadd" class="<?php echo $cars_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cars">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$cars_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($cars_add->Trademark->Visible) { // Trademark ?>
	<div id="r_Trademark" class="form-group row">
		<label id="elh_cars_Trademark" for="x_Trademark" class="<?php echo $cars_add->LeftColumnClass ?>"><?php echo $cars_add->Trademark->caption() ?><?php echo $cars_add->Trademark->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_add->RightColumnClass ?>"><div <?php echo $cars_add->Trademark->cellAttributes() ?>>
<span id="el_cars_Trademark">
<input type="text" data-table="cars" data-field="x_Trademark" name="x_Trademark" id="x_Trademark" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($cars_add->Trademark->getPlaceHolder()) ?>" value="<?php echo $cars_add->Trademark->EditValue ?>"<?php echo $cars_add->Trademark->editAttributes() ?>>
</span>
<?php echo $cars_add->Trademark->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cars_add->Model->Visible) { // Model ?>
	<div id="r_Model" class="form-group row">
		<label id="elh_cars_Model" for="x_Model" class="<?php echo $cars_add->LeftColumnClass ?>"><?php echo $cars_add->Model->caption() ?><?php echo $cars_add->Model->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_add->RightColumnClass ?>"><div <?php echo $cars_add->Model->cellAttributes() ?>>
<span id="el_cars_Model">
<input type="text" data-table="cars" data-field="x_Model" name="x_Model" id="x_Model" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($cars_add->Model->getPlaceHolder()) ?>" value="<?php echo $cars_add->Model->EditValue ?>"<?php echo $cars_add->Model->editAttributes() ?>>
</span>
<?php echo $cars_add->Model->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cars_add->HP->Visible) { // HP ?>
	<div id="r_HP" class="form-group row">
		<label id="elh_cars_HP" for="x_HP" class="<?php echo $cars_add->LeftColumnClass ?>"><?php echo $cars_add->HP->caption() ?><?php echo $cars_add->HP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_add->RightColumnClass ?>"><div <?php echo $cars_add->HP->cellAttributes() ?>>
<span id="el_cars_HP">
<input type="text" data-table="cars" data-field="x_HP" name="x_HP" id="x_HP" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($cars_add->HP->getPlaceHolder()) ?>" value="<?php echo $cars_add->HP->EditValue ?>"<?php echo $cars_add->HP->editAttributes() ?>>
</span>
<?php echo $cars_add->HP->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cars_add->Liter->Visible) { // Liter ?>
	<div id="r_Liter" class="form-group row">
		<label id="elh_cars_Liter" for="x_Liter" class="<?php echo $cars_add->LeftColumnClass ?>"><?php echo $cars_add->Liter->caption() ?><?php echo $cars_add->Liter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_add->RightColumnClass ?>"><div <?php echo $cars_add->Liter->cellAttributes() ?>>
<span id="el_cars_Liter">
<input type="text" data-table="cars" data-field="x_Liter" name="x_Liter" id="x_Liter" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($cars_add->Liter->getPlaceHolder()) ?>" value="<?php echo $cars_add->Liter->EditValue ?>"<?php echo $cars_add->Liter->editAttributes() ?>>
</span>
<?php echo $cars_add->Liter->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cars_add->Cyl->Visible) { // Cyl ?>
	<div id="r_Cyl" class="form-group row">
		<label id="elh_cars_Cyl" for="x_Cyl" class="<?php echo $cars_add->LeftColumnClass ?>"><?php echo $cars_add->Cyl->caption() ?><?php echo $cars_add->Cyl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_add->RightColumnClass ?>"><div <?php echo $cars_add->Cyl->cellAttributes() ?>>
<span id="el_cars_Cyl">
<input type="text" data-table="cars" data-field="x_Cyl" name="x_Cyl" id="x_Cyl" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($cars_add->Cyl->getPlaceHolder()) ?>" value="<?php echo $cars_add->Cyl->EditValue ?>"<?php echo $cars_add->Cyl->editAttributes() ?>>
</span>
<?php echo $cars_add->Cyl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cars_add->TransmissSpeedCount->Visible) { // TransmissSpeedCount ?>
	<div id="r_TransmissSpeedCount" class="form-group row">
		<label id="elh_cars_TransmissSpeedCount" for="x_TransmissSpeedCount" class="<?php echo $cars_add->LeftColumnClass ?>"><?php echo $cars_add->TransmissSpeedCount->caption() ?><?php echo $cars_add->TransmissSpeedCount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_add->RightColumnClass ?>"><div <?php echo $cars_add->TransmissSpeedCount->cellAttributes() ?>>
<span id="el_cars_TransmissSpeedCount">
<input type="text" data-table="cars" data-field="x_TransmissSpeedCount" name="x_TransmissSpeedCount" id="x_TransmissSpeedCount" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($cars_add->TransmissSpeedCount->getPlaceHolder()) ?>" value="<?php echo $cars_add->TransmissSpeedCount->EditValue ?>"<?php echo $cars_add->TransmissSpeedCount->editAttributes() ?>>
</span>
<?php echo $cars_add->TransmissSpeedCount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cars_add->TransmissAutomatic->Visible) { // TransmissAutomatic ?>
	<div id="r_TransmissAutomatic" class="form-group row">
		<label id="elh_cars_TransmissAutomatic" for="x_TransmissAutomatic" class="<?php echo $cars_add->LeftColumnClass ?>"><?php echo $cars_add->TransmissAutomatic->caption() ?><?php echo $cars_add->TransmissAutomatic->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_add->RightColumnClass ?>"><div <?php echo $cars_add->TransmissAutomatic->cellAttributes() ?>>
<span id="el_cars_TransmissAutomatic">
<input type="text" data-table="cars" data-field="x_TransmissAutomatic" name="x_TransmissAutomatic" id="x_TransmissAutomatic" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($cars_add->TransmissAutomatic->getPlaceHolder()) ?>" value="<?php echo $cars_add->TransmissAutomatic->EditValue ?>"<?php echo $cars_add->TransmissAutomatic->editAttributes() ?>>
</span>
<?php echo $cars_add->TransmissAutomatic->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cars_add->MPG_City->Visible) { // MPG_City ?>
	<div id="r_MPG_City" class="form-group row">
		<label id="elh_cars_MPG_City" for="x_MPG_City" class="<?php echo $cars_add->LeftColumnClass ?>"><?php echo $cars_add->MPG_City->caption() ?><?php echo $cars_add->MPG_City->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_add->RightColumnClass ?>"><div <?php echo $cars_add->MPG_City->cellAttributes() ?>>
<span id="el_cars_MPG_City">
<input type="text" data-table="cars" data-field="x_MPG_City" name="x_MPG_City" id="x_MPG_City" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($cars_add->MPG_City->getPlaceHolder()) ?>" value="<?php echo $cars_add->MPG_City->EditValue ?>"<?php echo $cars_add->MPG_City->editAttributes() ?>>
</span>
<?php echo $cars_add->MPG_City->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cars_add->MPG_Highway->Visible) { // MPG_Highway ?>
	<div id="r_MPG_Highway" class="form-group row">
		<label id="elh_cars_MPG_Highway" for="x_MPG_Highway" class="<?php echo $cars_add->LeftColumnClass ?>"><?php echo $cars_add->MPG_Highway->caption() ?><?php echo $cars_add->MPG_Highway->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_add->RightColumnClass ?>"><div <?php echo $cars_add->MPG_Highway->cellAttributes() ?>>
<span id="el_cars_MPG_Highway">
<input type="text" data-table="cars" data-field="x_MPG_Highway" name="x_MPG_Highway" id="x_MPG_Highway" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($cars_add->MPG_Highway->getPlaceHolder()) ?>" value="<?php echo $cars_add->MPG_Highway->EditValue ?>"<?php echo $cars_add->MPG_Highway->editAttributes() ?>>
</span>
<?php echo $cars_add->MPG_Highway->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cars_add->Category->Visible) { // Category ?>
	<div id="r_Category" class="form-group row">
		<label id="elh_cars_Category" for="x_Category" class="<?php echo $cars_add->LeftColumnClass ?>"><?php echo $cars_add->Category->caption() ?><?php echo $cars_add->Category->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_add->RightColumnClass ?>"><div <?php echo $cars_add->Category->cellAttributes() ?>>
<span id="el_cars_Category">
<input type="text" data-table="cars" data-field="x_Category" name="x_Category" id="x_Category" size="30" maxlength="7" placeholder="<?php echo HtmlEncode($cars_add->Category->getPlaceHolder()) ?>" value="<?php echo $cars_add->Category->EditValue ?>"<?php echo $cars_add->Category->editAttributes() ?>>
</span>
<?php echo $cars_add->Category->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cars_add->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_cars_Description" for="x_Description" class="<?php echo $cars_add->LeftColumnClass ?>"><?php echo $cars_add->Description->caption() ?><?php echo $cars_add->Description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_add->RightColumnClass ?>"><div <?php echo $cars_add->Description->cellAttributes() ?>>
<span id="el_cars_Description">
<textarea data-table="cars" data-field="x_Description" name="x_Description" id="x_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($cars_add->Description->getPlaceHolder()) ?>"<?php echo $cars_add->Description->editAttributes() ?>><?php echo $cars_add->Description->EditValue ?></textarea>
</span>
<?php echo $cars_add->Description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cars_add->Hyperlink->Visible) { // Hyperlink ?>
	<div id="r_Hyperlink" class="form-group row">
		<label id="elh_cars_Hyperlink" for="x_Hyperlink" class="<?php echo $cars_add->LeftColumnClass ?>"><?php echo $cars_add->Hyperlink->caption() ?><?php echo $cars_add->Hyperlink->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_add->RightColumnClass ?>"><div <?php echo $cars_add->Hyperlink->cellAttributes() ?>>
<span id="el_cars_Hyperlink">
<input type="text" data-table="cars" data-field="x_Hyperlink" name="x_Hyperlink" id="x_Hyperlink" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($cars_add->Hyperlink->getPlaceHolder()) ?>" value="<?php echo $cars_add->Hyperlink->EditValue ?>"<?php echo $cars_add->Hyperlink->editAttributes() ?>>
</span>
<?php echo $cars_add->Hyperlink->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cars_add->Price->Visible) { // Price ?>
	<div id="r_Price" class="form-group row">
		<label id="elh_cars_Price" for="x_Price" class="<?php echo $cars_add->LeftColumnClass ?>"><?php echo $cars_add->Price->caption() ?><?php echo $cars_add->Price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_add->RightColumnClass ?>"><div <?php echo $cars_add->Price->cellAttributes() ?>>
<span id="el_cars_Price">
<input type="text" data-table="cars" data-field="x_Price" name="x_Price" id="x_Price" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($cars_add->Price->getPlaceHolder()) ?>" value="<?php echo $cars_add->Price->EditValue ?>"<?php echo $cars_add->Price->editAttributes() ?>>
</span>
<?php echo $cars_add->Price->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cars_add->Picture->Visible) { // Picture ?>
	<div id="r_Picture" class="form-group row">
		<label id="elh_cars_Picture" class="<?php echo $cars_add->LeftColumnClass ?>"><?php echo $cars_add->Picture->caption() ?><?php echo $cars_add->Picture->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_add->RightColumnClass ?>"><div <?php echo $cars_add->Picture->cellAttributes() ?>>
<span id="el_cars_Picture">
<div id="fd_x_Picture">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $cars_add->Picture->title() ?>" data-table="cars" data-field="x_Picture" name="x_Picture" id="x_Picture" lang="<?php echo CurrentLanguageID() ?>"<?php echo $cars_add->Picture->editAttributes() ?><?php if ($cars_add->Picture->ReadOnly || $cars_add->Picture->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Picture"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Picture" id= "fn_x_Picture" value="<?php echo $cars_add->Picture->Upload->FileName ?>">
<input type="hidden" name="fa_x_Picture" id= "fa_x_Picture" value="0">
<input type="hidden" name="fs_x_Picture" id= "fs_x_Picture" value="0">
<input type="hidden" name="fx_x_Picture" id= "fx_x_Picture" value="<?php echo $cars_add->Picture->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Picture" id= "fm_x_Picture" value="<?php echo $cars_add->Picture->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Picture" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $cars_add->Picture->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cars_add->PictureName->Visible) { // PictureName ?>
	<div id="r_PictureName" class="form-group row">
		<label id="elh_cars_PictureName" for="x_PictureName" class="<?php echo $cars_add->LeftColumnClass ?>"><?php echo $cars_add->PictureName->caption() ?><?php echo $cars_add->PictureName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_add->RightColumnClass ?>"><div <?php echo $cars_add->PictureName->cellAttributes() ?>>
<span id="el_cars_PictureName">
<input type="text" data-table="cars" data-field="x_PictureName" name="x_PictureName" id="x_PictureName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($cars_add->PictureName->getPlaceHolder()) ?>" value="<?php echo $cars_add->PictureName->EditValue ?>"<?php echo $cars_add->PictureName->editAttributes() ?>>
</span>
<?php echo $cars_add->PictureName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cars_add->PictureSize->Visible) { // PictureSize ?>
	<div id="r_PictureSize" class="form-group row">
		<label id="elh_cars_PictureSize" for="x_PictureSize" class="<?php echo $cars_add->LeftColumnClass ?>"><?php echo $cars_add->PictureSize->caption() ?><?php echo $cars_add->PictureSize->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_add->RightColumnClass ?>"><div <?php echo $cars_add->PictureSize->cellAttributes() ?>>
<span id="el_cars_PictureSize">
<input type="text" data-table="cars" data-field="x_PictureSize" name="x_PictureSize" id="x_PictureSize" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($cars_add->PictureSize->getPlaceHolder()) ?>" value="<?php echo $cars_add->PictureSize->EditValue ?>"<?php echo $cars_add->PictureSize->editAttributes() ?>>
</span>
<?php echo $cars_add->PictureSize->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cars_add->PictureType->Visible) { // PictureType ?>
	<div id="r_PictureType" class="form-group row">
		<label id="elh_cars_PictureType" for="x_PictureType" class="<?php echo $cars_add->LeftColumnClass ?>"><?php echo $cars_add->PictureType->caption() ?><?php echo $cars_add->PictureType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_add->RightColumnClass ?>"><div <?php echo $cars_add->PictureType->cellAttributes() ?>>
<span id="el_cars_PictureType">
<input type="text" data-table="cars" data-field="x_PictureType" name="x_PictureType" id="x_PictureType" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($cars_add->PictureType->getPlaceHolder()) ?>" value="<?php echo $cars_add->PictureType->EditValue ?>"<?php echo $cars_add->PictureType->editAttributes() ?>>
</span>
<?php echo $cars_add->PictureType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cars_add->PictureWidth->Visible) { // PictureWidth ?>
	<div id="r_PictureWidth" class="form-group row">
		<label id="elh_cars_PictureWidth" for="x_PictureWidth" class="<?php echo $cars_add->LeftColumnClass ?>"><?php echo $cars_add->PictureWidth->caption() ?><?php echo $cars_add->PictureWidth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_add->RightColumnClass ?>"><div <?php echo $cars_add->PictureWidth->cellAttributes() ?>>
<span id="el_cars_PictureWidth">
<input type="text" data-table="cars" data-field="x_PictureWidth" name="x_PictureWidth" id="x_PictureWidth" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($cars_add->PictureWidth->getPlaceHolder()) ?>" value="<?php echo $cars_add->PictureWidth->EditValue ?>"<?php echo $cars_add->PictureWidth->editAttributes() ?>>
</span>
<?php echo $cars_add->PictureWidth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cars_add->PictureHeight->Visible) { // PictureHeight ?>
	<div id="r_PictureHeight" class="form-group row">
		<label id="elh_cars_PictureHeight" for="x_PictureHeight" class="<?php echo $cars_add->LeftColumnClass ?>"><?php echo $cars_add->PictureHeight->caption() ?><?php echo $cars_add->PictureHeight->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_add->RightColumnClass ?>"><div <?php echo $cars_add->PictureHeight->cellAttributes() ?>>
<span id="el_cars_PictureHeight">
<input type="text" data-table="cars" data-field="x_PictureHeight" name="x_PictureHeight" id="x_PictureHeight" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($cars_add->PictureHeight->getPlaceHolder()) ?>" value="<?php echo $cars_add->PictureHeight->EditValue ?>"<?php echo $cars_add->PictureHeight->editAttributes() ?>>
</span>
<?php echo $cars_add->PictureHeight->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cars_add->Color->Visible) { // Color ?>
	<div id="r_Color" class="form-group row">
		<label id="elh_cars_Color" for="x_Color" class="<?php echo $cars_add->LeftColumnClass ?>"><?php echo $cars_add->Color->caption() ?><?php echo $cars_add->Color->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cars_add->RightColumnClass ?>"><div <?php echo $cars_add->Color->cellAttributes() ?>>
<span id="el_cars_Color">
<input type="text" data-table="cars" data-field="x_Color" name="x_Color" id="x_Color" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($cars_add->Color->getPlaceHolder()) ?>" value="<?php echo $cars_add->Color->EditValue ?>"<?php echo $cars_add->Color->editAttributes() ?>>
</span>
<?php echo $cars_add->Color->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cars_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cars_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cars_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cars_add->showPageFooter();
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
$cars_add->terminate();
?>