<?php

/**
 * Created by PhpStorm.
 * User: Luke Hardiman
 * Date: 18/10/2015
 * Time: 10:00 PM
 */
class BuildersCrackAdmin extends ModelAdmin
{
    private static $managed_models = array('JobReviews');
    private static $url_segment = 'BuildersCrack';
    private $menu_title = 'BuildersCrack';

    public function canEdit($member = null)
    {
        return true;
    }

    public function canDelete($member = null)
    {
        return true;
    }

    public function canCreate($member = null)
    {
        return true;
    }
}
