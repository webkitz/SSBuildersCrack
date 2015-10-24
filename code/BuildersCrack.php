<?php

class BuildersCrack extends DataExtension
{

    protected static $url = "https://builderscrack.co.nz/";    //url of the review to be scrapped
    protected static $sandBox = false;
    protected static $trader = false;
    protected static $workmanship = 3;

    /**
     * @param $url URL of builders crack review to be scrapped
     */
    public static function setUrl($url)
    {
        self::$url = $url;
    }

    /**
     * @param $trader | Trader ID
     */
    public static function setTrader($trader)
    {
        self::$trader = $trader;
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

    /**
     * @return DataList | JobReviews
     */
    public function JobReviews()
    {

        return JobReviews::get();

    }

    /**
     * @return HTMLText | Just render Template only
     */
    public function JobReviewsTemplate()
    {

        $reviewsArray = JobReviews::get();

        $data = new ArrayData(
            array(
                'Reviews' => $reviewsArray
            )
        );

        return $data->renderWith('buildersReview');
    }

    public static function cronJob()
    {

        $html = new simple_html_dom();

        //get page source load into simplehtml
        $source = self::downloadReview();
        $html->load($source);

        //setup our reviews array
        $reviewsArray = ArrayList::create();


        //loop all reviews
        foreach ($html->find('div[class=review-row]') as $review) {

            //check we have a comment element
            if ($review->find('div[class=comment]', 0)) {

                //->plaintext;

                //date
                if ($review->find('p[class=text-muted]', 0))
                    $theReview['date'] = $review->find('p[class=text-muted]', 0)->plaintext;
                else {   //this is silly front end designers using text warning than
                    //try grab date
                    if ($review->find('p[class=text-warning bold]', 0))
                        $theReview['date'] = $review->find('p[class=text-warning bold]', 0)->plaintext;
                    else
                        $theReview['date'] = 'Couldn\'t locate';

                }

                //get the first a link its the title
                $reviewObj = $review->find('a', 0);

                //title
                $theReview['title'] = $reviewObj->plaintext;
                //get the href link to job
                $theReview['href'] = $reviewObj->href;

                //get the job_number jobs\/(\d+)
                if (preg_match('/jobs\/(\d+)/i', $theReview['href'], $job_number)) {
                    $theReview['jobNumber'] = $job_number[1];
                }

                //comment
                $theReview['comment'] = trim(str_replace(array("\r", "\n", "\s", "&ndash;"), '', strip_tags($review->find('div[class=comment]', 0)->plaintext)));

                //check review length
                if (strlen($theReview['comment']) > 2)
                    $reviewsArray->push($theReview);

                $jbNo = $theReview['jobNumber'];
                if (!$newReview = JobReviews::get_one('JobReviews', "jobNumber = '$jbNo'")) {
                    $newReview = new JobReviews();
                }
                    $newReview->jobNumber = $jbNo;
                $newReview->date = $theReview['date'];
                $newReview->link = $reviewObj->href;
                    $newReview->comment = $theReview['comment'];
                $newReview->jobTitle = $theReview['title'];
                    $newReview->Write();

            }

        }
        die("Cron job completed");


    }

    /**
     * @return string contain contents of review
     */
    public static function downloadReview()
    {
        if (self::$sandBox)
            return file_get_contents('../sandbox.html'); //file need to be in root

        if (!self::$trader)
        return file_get_contents(self::$url);

        return file_get_contents("https://builderscrack.co.nz/reviews/" . self::$trader);
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


class BuildersCrackController extends Controller
{
    static $allowed_actions = array(
        'cronjob'
    );

    public function index()
    {
        if (Permission::check('ADMIN'))
            BuildersCrack::cronJob();
        else
            return "Need to be logged on as admin";
    }

    public function cronjob()
    {
        if (!Director::is_cli() && $_SERVER['REMOTE_ADDR'] != $_SERVER['SERVER_ADDR'])
            die("cron job needs to run locally");

        BuildersCrack::cronJob();
    }


}