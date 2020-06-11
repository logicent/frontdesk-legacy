<?php

class Model_Menu extends \Orm\Model
{
    public const MENU_TOP_NAV = 'top';
    public const MENU_SIDE_NAV = 'side';

    public static function menu_list_items($ugroup, $business)
    {
        return array(
            // Wait(ing) List
            'billing' => array(
                'id' => 1,
                'name' => 'Billing &amp; Payments',
                'icon' => 'fa-money',
                'column' => self::MENU_SIDE_NAV,
                'visible' => true,
                'hide_menu_group_label' => true, // TODO: use general settings for user preferences
                'items' => array(
                    array(
                        'id'     => 'sales-order',
                        'label'  => 'Orders', // TODO: change label depending on modules enabled
                        'route'  => 'accounts/sales-order',
                        'icon' => 'fa-money',
                        'description' => 'Track sales order data records',
                        'visible' => $business->service_hire,
                    ),                    
                    array(
                        'id'     => 'sales-invoice',
                        'label'  => 'Invoices', // TODO: change label depending on modules enabled
                        'route'  => 'accounts/sales-invoice',
                        'icon' => 'fa-money',
                        'description' => 'Track sales invoice data records',
                        'visible' => true,
                    ),
                    array(
                        'id'     => 'sales-receipt',
                        'label'  => 'Payments',
                        'route'  => 'accounts/sales-receipt',
                        'icon' => 'fa-money',
                        'description' => 'Track sales receipt data records',
                        'visible' => true,
                    ),
                    array(
                        'id'     => 'expenses',
                        'label'  => 'Expenses',
                        'route'  => 'accounts/expenses',
                        'icon' => 'fa-book',
                        'description' => 'Track expenses data',
                        'visible' => false,
                    ),
                    array(
                        'id'     => 'deposits',
                        'label'  => 'Bank Deposits',
                        'route'  => 'accounts/bank-deposit',
                        'icon' => 'fa-book',
                        'description' => 'Track bank deposits data',
                        'visible' => false,
                    ),
                ),
            ),            
            'registers' => array(
                'id' => 2,
                'name' => 'Registers',
                'icon' => 'fa-book',
                'column' => self::MENU_SIDE_NAV,
                'visible' => true,
                'hide_menu_group_label' => true, // TODO: use general settings for user preferences
                'items' => array(
                    array(
                        'id'     => 'reservation',
                        'label'  => 'Reservation',
                        'route'  => 'registers/reservation',
                        'icon' => 'fa-book',
                        'description' => 'Track reservation data records',
                        'visible' => $business->service_accommodation,
                    ),
                    array(
                        'id'     => 'booking',
                        'label'  => 'Booking',
                        'route'  => 'registers/booking',
                        'icon' => 'fa-book',
                        'description' => 'Track booking data records',
                        'visible' => $business->service_accommodation,
                    ),
                    array(
                        'id'     => 'lease',
                        'label'  => 'Leases',
                        'route'  => 'registers/lease',
                        'icon' => 'fa-book',
                        'description' => 'Track lease data records',
                        'visible' => $business->service_rental,
                    ),
                    array(
                        'id'     => 'tenant',
                        'label'  => 'Tenants',
                        'route'  => 'registers/tenant',
                        'icon' => 'fa-book',
                        'description' => 'Track tenant data records',
                        'visible' => $business->service_rental,
                    ),
                    array(
                        'id'     => 'landlord',
                        'label'  => 'Landlords',
                        'route'  => 'registers/landlord',
                        'icon' => 'fa-book',
                        'description' => 'Track landlord data records',
                        'visible' => $business->service_rental && ($business->business_type != Model_Business::BUSINESS_TYPE_PROPERTY_OWNER),
                    ),
                    array(
                        'id'     => 'customer',
                        'label'  => 'Customer',
                        'route'  => 'registers/customer',
                        'icon' => 'fa-book',
                        'description' => 'Track customer data records',
                        'visible' => $business->service_accommodation,
                    ),
                    array(
                        'id'     => 'partner',
                        'label'  => 'Partner',
                        'route'  => 'registers/partner',
                        'icon' => 'fa-book',
                        'description' => 'Track partner data records',
                        'visible' => $business->service_accommodation,
                    ),
                ),
            ),
            'payroll' => array(
                'id' => 3,
                'name' => 'Payroll',
                'icon' => 'fa-users',
                'column' => self::MENU_SIDE_NAV,
                'visible' => false, // $ugroup->id == 5 || $ugroup->id == 6, // Admin group
                'hide_menu_group_label' => true, // TODO: use general settings for user preferences
                'items' => array(
                    array(
                        'id'     => 'payslip',
                        'label'  => 'Payslip',
                        'route'  => 'hr/payslip',
                        // 'icon' => 'fa-users',
                        'description' => 'Manage employee salary payments detail',
                        'visible' => true,
                    ),
                    array(
                        'id'     => 'employee_attendance',
                        'label'  => 'Employee Attendance',
                        'route'  => 'hr/employee-attendance',
                        // 'icon' => 'fa-users',
                        'description' => 'Capture employee attendance virtually or remotely',
                        'visible' => false,
                    ),
                    array(
                        'id'     => 'timesheets',
                        'label'  => 'Timesheets',
                        'route'  => 'hr/timesheets',
                        // 'icon' => 'fa-users',
                        'description' => 'Time tracking for employee tasks',
                        'visible' => false,
                    ),                    
                    array(
                        'id'     => 'employee',
                        'label'  => 'Employee',
                        'route'  => 'hr/employee',
                        // 'icon' => 'fa-users',
                        'description' => 'Manage employee master data',
                        'visible' => true,
                    ),
                    array(
                        'id'     => 'salary_structure',
                        'label'  => 'Salary Structure',
                        'route'  => 'hr/salary-structure',
                        // 'icon' => 'fa-users',
                        'description' => 'Create/update salary structures to make payslips',
                        'visible' => false,
                    ),
                    array(
                        'id'     => 'salary_component',
                        'label'  => 'Salary Component',
                        'route'  => 'hr/salary-component',
                        // 'icon' => 'fa-users',
                        'description' => 'Create/update salary components to make payslips or structures',
                        'visible' => true,
                    ),
                )
            ),
            'facilities' => array(
                'id' => 4,
                'name' => 'Facilities',
                'icon' => 'fa-building',
                'column' => self::MENU_SIDE_NAV,
                'visible' => $ugroup->id == 5 || $ugroup->id == 6, // Admin group
                'hide_menu_group_label' => false, // TODO: use general settings for user preferences
                'items' => array(
                    array(
                        'id'     => 'rate',
                        'label'  => 'Rates',
                        'route'  => 'facilities/rates',
                        // 'icon' => 'fa-users',
                        'description' => 'Create property rates by designated use case',
                        'visible' =>  $business->service_accommodation,
                    ),
                    array(
                        'id'     => 'rate_type',
                        'label'  => 'Rate Type',
                        'route'  => 'facilities/rate-type',
                        // 'icon' => 'fa-users',
                        'description' => 'Create property rate type by designated use case',
                        'visible' =>  $business->service_accommodation,
                    ),
                    array(
                        'id'     => 'unit',
                        'label'  => 'Units',
                        'route'  => 'facilities/units',
                        // 'icon' => 'fa-users',
                        'description' => 'Create property units available for sale',
                        'visible' => true,
                    ),
                    array(
                        'id'     => 'unit_type',
                        'label'  => 'Unit Type',
                        'route'  => 'facilities/unit-type',
                        // 'icon' => 'fa-users',
                        'description' => 'Create property unit type by functional use',
                        'visible' => true,
                    ), 
                    array(
                        'id'     => 'property',
                        'label'  => 'Property',
                        'route'  => 'facilities/property',
                        // 'icon' => 'fa-users',
                        'description' => 'Manage property detail and related data',
                        'visible' =>  true,
                    ),
                    array(
                        'id'     => 'services',
                        'label'  => 'Services',
                        'route'  => 'facilities/services',
                        // 'icon' => 'fa-users',
                        'description' => 'List services offered and/or applicable rates',
                        'visible' => true,
                    ),
                )
            ),
            'users' => array(
                'id' => 5,
                'name' => 'Users',
                'icon' => 'fa-money',
                'column' => self::MENU_SIDE_NAV,
                'visible' => $ugroup->id == 5 || $ugroup->id == 6, // Admin group
                'hide_menu_group_label' => true, // TODO: use general settings for user preferences
                'items' => array(
                    array(
                        'id'    => 'users',
                        'label' => 'Users',
                        'route' => 'users',
                        'description' => 'Create/update and remove system users',
                        'visible' => true,
                    ),
                ),
            ),
            'settings' => array(
                'id' => 6,
                'name' => 'Settings',
                'icon' => 'fa-cog',
                'column' => self::MENU_SIDE_NAV,
                'visible' => $ugroup->id == 5 || $ugroup->id == 6, // Admin group
                'hide_menu_group_label' => true, // TODO: use general settings for user preferences
                'items' => array(
                    array(
                        'id'    => 'settings',
                        'label' => 'Settings',
                        'route' => 'settings',
                        'description' => 'Change predefined settings values',
                        'visible' => true,
                    ),
                ),
            ),
        );
    }
}
