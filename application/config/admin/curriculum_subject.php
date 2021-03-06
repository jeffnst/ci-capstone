<?php

defined('BASEPATH') OR exit('No direct script allowed');

$config['first_semester_max_unit_limit']  = 15;
$config['second_semester_max_unit_limit'] = 15;
$config['summer_semester_max_unit_limit'] = 9;

$config['first_semester_min_unit_limit']  = 10;
$config['second_semester_min_unit_limit'] = 10;
$config['summer_semester_min_unit_limit'] = 6;

/**
 * in one curriculum checking for enabling
 */
$config['minimum_total_gen_ed_units'] = 23;

/**
 * limit in multiple form in  create-curriculum-subject
 */
$config['limit_multiple_form_add_curriculum_subject'] = 10;
