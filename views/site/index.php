<?php

use yii\helpers\Html;
use app\models\Post;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="row">

        <div class="slideContainer">

            <div class="slides"></div>

        </div>

    </div>

    <div class="row">

        <legend>

            <h1><em>Welcome, Bloggers!</em></h1>

        </legend>

    </div>

    <div class="row">

        <div class="form-group col-md-3">

            <div class="presentation">

                <h4 class="text-left" style="margin-top: 0;"><strong> Step in: </strong></h4>

                <p>
                    Welcome folks! Here we can talk and discuss everything about Hardware and Software!
                    You can post news feed about all the new technologies! Share ideas! Talk with each other!
                    We are big technology family here! You can take a walk around as guest
                    or register yourself for more benefits!
                </p>

            </div>

        </div>

        <div class="col-md-offset-1 col-md-4">

            <h4 class="text-center"><strong>Latest News</strong></h4>

            <div class="news-feeds">
                <!-- start sw-rss-feed code -->
                <script type="text/javascript">
                    <!--
                    rssfeed_url = new Array();
                    rssfeed_url[0]="http://www.pcworld.com/index.rss";
                    rssfeed_frame_width="300";
                    rssfeed_frame_height="330";
                    rssfeed_scroll="on";
                    rssfeed_scroll_step="6";
                    rssfeed_scroll_bar="off";
                    rssfeed_target="_blank";
                    rssfeed_font_size="12";
                    rssfeed_font_face="";
                    rssfeed_border="on";
                    rssfeed_css_url="http://feed.surfing-waves.com/css/style6.css";
                    rssfeed_title="on";
                    rssfeed_title_name="";
                    rssfeed_title_bgcolor="#3366ff";
                    rssfeed_title_color="#fff";
                    rssfeed_title_bgimage="http://";
                    rssfeed_footer="off";
                    rssfeed_footer_name="rss feed";
                    rssfeed_footer_bgcolor="#fff";
                    rssfeed_footer_color="#333";
                    rssfeed_footer_bgimage="http://";
                    rssfeed_item_title_length="50";
                    rssfeed_item_title_color="#666";
                    rssfeed_item_bgcolor="#fff";
                    rssfeed_item_bgimage="http://";
                    rssfeed_item_border_bottom="on";
                    rssfeed_item_source_icon="off";
                    rssfeed_item_date="off";
                    rssfeed_item_description="on";
                    rssfeed_item_description_length="120";
                    rssfeed_item_description_color="#666";
                    rssfeed_item_description_link_color="#333";
                    rssfeed_item_description_tag="off";
                    rssfeed_no_items="0";
                    rssfeed_cache = "7d1229f6b4f7fbd429e028ee5aa952fc";
                    //-->
                </script>
                <script type="text/javascript" src="http://feed.surfing-waves.com/js/rss-feed.js"></script>
                <!-- The link below helps keep this service FREE, and helps other people find the SW widget. Please be cool and keep it! Thanks. -->
            </div>

        </div>

        <div class="col-md-offset-1 col-md-3">

            <h4 class="text-center"><strong>Latest Posts</strong></h4>

            <div class="latest-posts">
                <div class="row">

                    <?php

                    foreach ($lastPosts as $post)
                    {
                        echo Html::a("<div class='row'>
                                <div class='home-post-show col-md-12'>
                                    <p><em>" . ucfirst($post['title']) . "</em></p>
                                    <p>" . $post['content'] . "</p>    
                                </div>
                              </div>", ['../post/view', 'id' => Html::encode($post->post_id)], ['style-decoration' => 'none']);
                    }

                    ?>

                </div>
            </div>

        </div>

    </div>

</div>
