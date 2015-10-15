<?php

//Basics of config file
define('MODULE_BUILDERSCRACK_DIR', basename(dirname(__FILE__)));

DataObject::add_extension('SiteTree', 'BuildersCrack');
