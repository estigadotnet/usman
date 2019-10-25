<?php
namespace PHPMaker2020\p_usman;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(1, "mi_cars", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "carslist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}cars'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_cars2", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "cars2list.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}cars2'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(3, "mi_categories", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "categorieslist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}categories'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_customers", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "customerslist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}customers'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(5, "mi_employee_sales_by_county_for_1997", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "employee_sales_by_county_for_1997list.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}employee_sales_by_county_for_1997'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(6, "mi_employees", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "employeeslist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}employees'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(7, "mi_list_of_products", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "list_of_productslist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}list_of_products'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(8, "mi_models", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "modelslist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}models'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(9, "mi_order_details_extended", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "order_details_extendedlist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}order details extended'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(10, "mi_order_details_extended_2", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "order_details_extended_2list.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}order details extended 2'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(11, "mi_orderdetails", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "orderdetailslist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}orderdetails'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(12, "mi_orders", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "orderslist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}orders'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(13, "mi_orders2", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "orders2list.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}orders2'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(14, "mi_orders_by_product", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "orders_by_productlist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}orders_by_product'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(15, "mi_product_sales_for_1997", $MenuLanguage->MenuPhrase("15", "MenuText"), $MenuRelativePath . "product_sales_for_1997list.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}product_sales_for_1997'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(16, "mi_products", $MenuLanguage->MenuPhrase("16", "MenuText"), $MenuRelativePath . "productslist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}products'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(17, "mi_products_by_category", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "products_by_categorylist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}products_by_category'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(18, "mi_sales_by_category_for_1997", $MenuLanguage->MenuPhrase("18", "MenuText"), $MenuRelativePath . "sales_by_category_for_1997list.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}sales_by_category_for_1997'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(19, "mi_sales_by_year", $MenuLanguage->MenuPhrase("19", "MenuText"), $MenuRelativePath . "sales_by_yearlist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}sales_by_year'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(20, "mi_shippers", $MenuLanguage->MenuPhrase("20", "MenuText"), $MenuRelativePath . "shipperslist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}shippers'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(21, "mi_suppliers", $MenuLanguage->MenuPhrase("21", "MenuText"), $MenuRelativePath . "supplierslist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}suppliers'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(22, "mi_tasks", $MenuLanguage->MenuPhrase("22", "MenuText"), $MenuRelativePath . "taskslist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}tasks'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(23, "mi_trademarks", $MenuLanguage->MenuPhrase("23", "MenuText"), $MenuRelativePath . "trademarkslist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}trademarks'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(24, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("24", "MenuText"), $MenuRelativePath . "userlevelpermissionslist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}userlevelpermissions'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(25, "mi_userlevels", $MenuLanguage->MenuPhrase("25", "MenuText"), $MenuRelativePath . "userlevelslist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}userlevels'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(26, "mi_dji", $MenuLanguage->MenuPhrase("26", "MenuText"), $MenuRelativePath . "djilist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}dji'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(27, "mi_gantt", $MenuLanguage->MenuPhrase("27", "MenuText"), $MenuRelativePath . "ganttlist.php", -1, "", AllowListMenu('{4DAEC789-5DC2-4A71-96A1-2FF0758C1D39}gantt'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>