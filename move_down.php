<?php
/**
 * WebsiteBaker CMS module: mpForm
 * ===============================
 * This module allows you to create customised online forms, such as a feedback form with file upload and customizable email notifications. mpForm allows forms over one or more pages, loops of forms, conditionally displayed sections within a single page, and many more things.  User input for the same session_id will become a single row in the submitted table.  Since Version 1.1.0 many ajax helpers enable you to speed up the process of creating forms with this module. Since 1.2.0 forms can be imported and exported directly in the module.
 *  
 * @category            page
 * @module              mpform
 * @version             1.2.3
 * @authors             Frank Heyne, NorHei(heimsath.org), Christian M. Stefan (Stefek), Martin Hecht (mrbaseman) and others
 * @copyright           (c) 2009 - 2016, Website Baker Org. e.V.
 * @url                 http://forum.websitebaker.org/index.php/topic,28496.0.html
 * @url                 https://github.com/WebsiteBaker-modules/mpform
 * @license             GNU General Public License
 * @platform            2.8.x
 * @requirements        probably php >= 5.3 ?
 *
 **/
/* This backend file changes the ordering of the fields in the form. */
require('../../config.php');

// Get id
if(!isset($_GET['field_id']) OR !is_numeric($_GET['field_id'])) {
    header("Location: index.php");
    exit(0);
} else {
    $field_id = $_GET['field_id'];
}

require_once(dirname(__FILE__).'/constants.php');


// Include WB admin wrapper script
require(WB_PATH.'/modules/admin.php');

// Include the ordering class
require(WB_PATH.'/framework/class.order.php');

// Create new order object an reorder
$order = new order(
    TP_MPFORM.'fields', 
    'position', 
    'field_id', 
    'section_id'
);

if($order->move_down($field_id)) {
    $admin->print_success($TEXT['SUCCESS'],    
    ADMIN_URL.'/pages/modify.php?page_id='.(int)$page_id);
} else {
    $admin->print_error($TEXT['ERROR'],
    ADMIN_URL.'/pages/modify.php?page_id='.(int)$page_id);
}

// Print admin footer
$admin->print_footer();

