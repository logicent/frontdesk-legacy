<?php
/**
 * Fuel is a fast, lightweight, community driven PHP 5.4+ framework.
 *
 * @package    Fuel
 * @version    1.8.2
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2019 Fuel Development Team
 * @link       https://fuelphp.com
 */

return array(
	'_root_'  => 'dashboard/index',  // The default route
	'_404_'   => 'dashboard/404',    // The main 404 route

	'login' 				=> 'login/login',
	'login/forgot-password' => 'login/lostpassword',
	'logout' 				=> 'login/logout',
	
	'users/change-pwd' => 'users/change_password',

	'registers/reservation' => 'facility/reservation',
	'registers/booking'     => 'facility/booking',
	'registers/customer'    => 'customer',
	'registers/member'    	=> 'member',
	'registers/tenant'    	=> 'tenant',
	'registers/landlord'    => 'landlord',
	'registers/lease'     	=> 'lease',
	'registers/partner'     => 'partner',
	// 'registers/folios'     		=> 'sales/invoice',
	// 'registers/stayover/:date'   => 'facility/stayover/$1',
    // 'registers/nightaudit/:date' => 'facility/nightaudit/$1',

    'lease/get-property-list-options' 	=> 'lease/get_property_list_options',
    'lease/get-owner-list-options' 		=> 'lease/get_owner_list_options',
    'lease/get-unit-list-options' 		=> 'lease/get_unit_list_options',

	'accounts/sales-invoice/get-source-list-options' 		=> 'sales/invoice/get_source_list_options',
	'accounts/sales-invoice/get-source-info' 		=> 'sales/invoice/get_source_info',
	
	'accounts/bank-account'    => 'accounts/bank/account',
	'accounts/bank-deposit'    => 'accounts/bank/deposit',
	'accounts/sales-order'   	=> 'sales/order',
	'accounts/sales-invoice'   => 'sales/invoice',
	'accounts/sales-receipt'   => 'accounts/payment/receipt',
	'accounts/gift-voucher'    => 'gift/voucher',
	'accounts/expenses'        => 'accounts/payment/expense',
	'accounts/taxes'           => 'accounts/tax',
	'accounts/payment-method'  => 'accounts/payment/method',

	'accounts/sales-order/add-item'   => 'sales/order/item/create',
	'accounts/sales-order/get-item'   => 'sales/order/item/read',
	'accounts/sales-order/del-item'   => 'sales/order/item/delete',
	
	'accounts/sales-invoice/add-item'   => 'sales/invoice/item/create',
	'accounts/sales-invoice/get-item'   => 'sales/invoice/item/read',
	'accounts/sales-invoice/del-item'   => 'sales/invoice/item/delete',
	
    'accounts/payment/receipt/to-print/:id' => 'accounts/payment/receipt/to_print/$1',

	'hr/employee'     			=> 'hr/employee',
	'hr/payslip'     			=> 'hr/salary/slip',
	'hr/salary-structure'     	=> 'hr/salary/structure',
	'hr/salary-component'     	=> 'hr/salary/component',
	
	'facilities/rates'      	=> 'rate',
	'facilities/rate-type' 		=> 'rate/type',
	'facilities/units'      	=> 'unit',
    'facilities/unit-type' 		=> 'unit/type',
    'facilities/property' 		=> 'property',
    'facilities/property-type' 	=> 'property/type',
	'facilities/services'   	=> 'service/item',
	'facilities/service-type'   => 'service/type',
	'facilities/amenities'  	=> 'facility/amenity',
    
	'settings/business-detail'  => 'business',
	'settings/email-settings'   => 'email/settings',
	'settings/employee-type'	=> 'hr/employment/type',
	'settings/department'		=> 'hr/department',
	'settings/designation'		=> 'hr/designation',

	// 'settings/email-settings/edit/:id' => 'email/settings/edit/$1',
	// 'settings/email-templates'  => 'email/template',
	// 'settings/bank-accounts'    => 'bank/account',
	// 'settings/admin-policies'   => 'admin_policy',
	// 'settings/admin-checklists' => 'admin_checklist',
	// 'settings/admin-templates'  => 'admin_template',
	// 'settings/permissions'      => 'permission',
	// 'settings/roles'            => 'role',

    'calendar/show-bookings'    	=> 'calendar/show_bookings',
    'calendar/show-reservations'    => 'calendar/show_reservations',

    'report-builder' => 'report/builder',

	//'reports/:slug' => 'reports/$1',
	'reports/show-daily-report' 	=> 'reports/show_daily',
	'reports/show-monthly-report'	=> 'reports/show_monthly',
);
