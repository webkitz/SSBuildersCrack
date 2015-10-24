<?php

/**
 * Created by PhpStorm.
 * User: Luke Hardiman
 * Date: 15/10/2015
 * Time: 10:20 PM
 */
class JobReviews extends DataObject
{

    public static $db = array(
        //db fields for customer reviews section
        'comment' => 'Text',
        'date' => 'Varchar',
        'jobTitle' => 'Text',
        'link' => 'Varchar',
        'jobNumber' => 'Varchar',
        'enabled' => 'Boolean'
    );

    //declare parent page
    public static $has_one = array(
        "JobReviews" => "BuildersCrackPage"
    );

    //create summary fields to be shown on GridField
    public static $summary_fields = array(
        'jobNumber' => 'Job Number',
        'jobTitle' => 'Review Title',
        'date' => 'Date'
    );

    //update CMS interface and add GridField input fields
    public function getCMSFields()
    {
        return FieldList::create(
            TextField::create('jobTitle', 'Review title'),
            TextField::create('date', 'Review Date'),
            TextField::create('link', 'Review Link'),
            TextField::create('jobNumber', 'Job Number'),
            TextareaField::create('comment', 'Review')
        );
    }

    //allow content authors to view
    function canView($member = null)
    {
        return true;
    }

    //allow create
    function canCreate($member = null)
    {
        return true;
    }

    //allow edit
    function canEdit($member = null)
    {
        return true;
    }

    //allow delete
    function canDelete($member = null)
    {
        return true;
    }


}