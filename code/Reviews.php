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
        'comment' => 'Varchar',
        'date' => 'Date',
        'title' => 'Varchar',
        'link' => 'Text',
        'jobNumber' => 'Text'
    );

    //declare parent page
    public static $has_one = array(
        "JobReviews" => "BuildersCrack_Page"
    );

    //create summary fields to be shown on GridField
    public static $summary_fields = array(
        'comment' => 'Customer Comment',
        'date' => 'Date',
        'title' => 'Job Title'
    );

    //update CMS interface and add GridField input fields
    public function getCMSFields()
    {
        return FieldList::create(
            TextField::create('comment', 'Reivew'),
            DateField::create('date', 'Review Date'),
            TextField::create('link', 'Review Link'),
            TextareaField::create('jobNumber', 'Job Number')
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