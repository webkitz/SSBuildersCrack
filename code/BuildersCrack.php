<?php

class BuildersCrack extends DataExtension
{

    protected static $url = "https://builderscrack.co.nz/";    //url of the review to be scrapped
    protected static $sandBox = false;

    /**
     * @param $url URL of builders crack review to be scrapped
     */
    public static function setUrl($url)
    {
        self::$url = $url;
    }

    /**
     * @param $sandbox bool sets sandbox mode
     */
    public static function set_sandbox($sandbox)
    {
        self::$sandBox = $sandbox;
    }

    public static function BuildersCrackItemHandler($attributes, $content = null, $parser = null)
    {

    }

    public function getReviews($name = 'testing')
    {
        $html = new simple_html_dom();

        //get page source load into simplehtml
        $source = $this->downloadReview();
        $html->load($source);

        //setup our reviews array
        $reviewsArray = ArrayList::create();


        //loop all reviews
        foreach ($html->find('div[class=review-row]') as $review) {
            //check we have a comment element
            if ($theReview['comment'] = $review->find('div[class=col-md-3]', 2)) {
                //date
                $theReview['date'] = $review->find('p[class=text-muted]', 0)->plaintext;

                //check review length
                if (strlen($theReview['comment']) > 2)
                    $reviewsArray->push($theReview);
            }

        }
        print_r($reviewsArray);
        //pass the data to the buildersReview
        $data = new ArrayData(
            array(
                'Reviews' => $reviewsArray
            )
        );

        return $data->renderWith('buildersReview');
    }

    /**
     * @return string contain contents of review
     */
    public function downloadReview()
    {
        return file_get_contents(self::$url);
    }

}

class BuildersCrackPage extends Page
{

    private static $db = array();

    //set $has_many relationship
    private static $has_many = array(
        'Reviews' => 'JobReviews'
    );

    //updating the CMS interface
    public function getCMSFields()
    {
        //declare var $fields
        $fields = parent::getCMSFields();
        //create Reviews Section GridField
        $fields->addFieldToTab('Root.Reviews', GridField::create(
            'Reviews',
            'Client Reviews',
            $this->Reviews(),
            GridFieldConfig_RecordEditor::create()
        ));

        return $fields;
    }
}

class BuildersCrack_Controller extends Page_Controller
{

}