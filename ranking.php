<?php
require_once 'config.php';
require_once 'class/rating.php';
require_once 'functions/functions.php';
$renderObj = new rating();
$user_id = ($_SESSION['userinfo']->id != '' ? $_SESSION['userinfo']->id : 0);
require_once 'header.php';

$record = $renderObj->get_profile($user_id);

if ($record != 0) {
    $name = ($record['google_name'] != '' ? $record['google_name'] : 'NA');
    $email = ($record['google_email'] != '' ? $record['google_email'] : 'NA');
    $designation = ($record['designation'] != '' ? $record['designation'] : 'NA');
    $profile_pic = ($record['google_picture_link'] != '') ? $record['google_picture_link'] . "?sz=100" : 'https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100';
}

$ranking_user_list = $renderObj->get_ranking_list($user_id);
$cnt = $renderObj->get_all_members_cnt();
$rank = $renderObj->get_my_rank_position();
$login_user_rank_position = array_search($user_id, array_column($rank, 'user_id'));
$most_recent_ratings = $renderObj->get_recent_ratings();

$get_work_rating = $renderObj->get_work_rating($user_id);
$plus_rating = 0;
$minus_rating = 0;
foreach (@$get_work_rating as $key => $val) {

    if ($val['rating'] == 1) {

        $plus_rating++;
    } else if ($val['rating'] == 0) {
        $minus_rating++;
    }
}


?>
<script src="js/highchart.js"></script>
<script>
   
 $(document).ready(function(){
 var chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'container',
                        marginRight: 80,
                        type: '',
                        
                        events:{
                            load: function(event) {
                            //When is chart ready?
                            $('#container').resize();
                        }
                        },
                         style: {
                            fontFamily: 'Open Sans, Arial, Helvetica, sans-serif',
                            
                        }
                        
                      },
                    credits: {
                        enabled: false  //To hide Highchart Promotion Link at bottom
                    },
                    cursor: 'pointer', //To show hand on hover of bar
                    title: {
                        text: 'Top 10 Rank Holders',
                         style: {
                            color: '#180000',
                            fontSize: '1.7em'
                                              
                        }
                    },
                    xAxis: [{
                             labels: { 
                                style: {
                                    color: '#180000 ',
                                    fontWeight: 'italic',
                                    
                                }
                            },
                            tickWidth: 1,
                            categories: [<?=$ranking_user_list['name'];?>]

                        }],
                    yAxis: {
                         
                         gridLineColor: '#197F07',
                         gridLineWidth: 0,
                         lineWidth:1,
                        title: {
                            text: 'Total <strong>+1</strong> Ratings ',
                              style: {
                                        color: '#180000',
                                                                                 }
                                }
                         },
                   legend: {
                        enabled: false //To hide the bottom legends
                   },
                   plotOptions: {
                        series: {
                            cursor: 'pointer',
                            borderColor: '#303030',
                              marker: {
                                    radius: 5
                                },
                                
                              symbol:{
                                  hover:{
                                      
                                  }
                              }  
                                

                            }
                        },
                        tooltip: {
                             shared: true,
                             useHTML: true,
                             valuePrefix: '',
                             valueSuffix: ''
                        },
                   exporting: { 
                       enabled: false //To hide Print & Export Button From Graph
                   },
                    series: [
                        
                        {
                            name :'<strong>Total + 1 Rating</strong>',
                            color:"#00b13e",
                            type: 'column',
                            data: [<?=$ranking_user_list['ratings'];?>]
                        },
                        {
                            data: [ <?=$ranking_user_list['data'];?>],
                            enableMouseTracking: false, //To hide tooltip on image
                            type: 'scatter'
                        }
                        
                    ]
                    
                });
           });
</script>
<section>
    <div class="wrapper">

        <div class="mid-col-12">
            <div class="profile-wrapper" style="margin-bottom:20px;">
                      
                <?php if ($_SESSION['userinfo']->role_id != 9) { ?>
                    <div class="" style="float:right;position: relative;left: 10px;"><a href="rating_dashboard.php" class="edit-submit-btn">My Team</a></div>
                    
                <?php } ?>
                    
                <div class="profile-lft">

                    <div class="mid-col-img"><a href="javascript:void(0);"><img src="<?= $profile_pic; ?>"></a></div>
                </div>
            <div class="home-profile-rht-other relative">
                <div class="rank-div">R-100</div>
                <p class="name-txt"><?= $name; ?></p>
                <p class="paddingtop5 paddingbot10"><?= $designation ?></p>
                <div class="home-rating-left">
                    <span class="request-positive-green-3"><?php
                        if ($plus_rating > 0) {
                            echo '+';
                        } echo $plus_rating;
                        ?></span>
                </div>
                <div class="home-rating-left">
                    <span class="request-negative-red-3"><?php
                        if ($minus_rating > 0) {
                            echo '-';
                        } echo $minus_rating;
                        ?></span>
                </div>
            </div>
            <?php if ($_SESSION['userinfo']->role_id != 9) { ?>
                <a href="profile.php" class="edit-submit-btn-ranking " >View Profile</a>
            <?php } else {?>
                <a href="profile.php" class="edit-submit-btn-ranking margintop70" >View Profile</a>
            <?php } ?>
        <div class="profile-hr" ></div>
                <div class="profile-wrapper-report">
                    <!-- html graph start -->
                    <div class="ranking-div paddingbot10 marginbot10">
                        <div class="graph-lft" id="container" style="width: 70%; height: 400px">
                            
                        </div>
                        <div class="graph-rht">
                            <div class="total-member">
                                <div class="total-member-top"><?= $cnt['totalusercnt']; ?></div>
                                <div class="total-member-bot">Total Members</div>
                            </div>
                            <div class="your-rank">
                                <?php  if($login_user_rank_position === false) {
                                    ?>
                                    
                                    <a title="You have not yet received +1 rating."><div class="total-member-top"> <strong>-</strong></div></a>
                                <?php } else if($login_user_rank_position == 0) {
                                    ?> 
                                <div class="total-member-top"><a><strong>1</strong></a></div>
                                <?php
                                } else  {
                                    
                                 
                                    ?>
                                <a><div class="total-member-top" title="<?php if($login_user_rank_position + 1 > 10){?>You need <?=$away = $login_user_rank_position + 1 - 10;?> more +1 ratings to be among top 10 rank holders.<?php } ?>"> <strong><?= $login_user_rank_position + 1; ?></strong></div></a>

                                <?php } ?>
                                <div class="your-rank-bot">My Rank</div>
                            </div>
                        </div>
                    </div>
                    <!-- html graph end-->
                    <h3 class="raking-heading">Recent +1 Ratings</h3>

                    <div class="ranking-div" style="padding-top: 0px;">
                    <?php foreach ($most_recent_ratings as $key => $value) {
                        $ratingCount = $renderObj->get_user_total_rating_count($value['user_id']);
                   
                        $profile_pic = ($value['google_picture_link'] != '') ? $value['google_picture_link'] . "?sz=100" : 'https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100';
                        $name = ($value['google_name'] != '' ? $value['google_name'] : 'NA');
                        
                        ?>
                        
                        <div class="ranking-inner">
                            <div class="ranking-lft">
                                <div class="ranking-lft-img">
                                    <a href="javascript:void(0);"><img src="<?=$profile_pic;?>" class="img-circle-border" /></a>
                                    <div class="ranking-notification">+<?=$ratingCount['pluscount']?></div>
                                </div>
                            </div>
                            <div class="ranking-rht">
                                <h2 class="font20"><a href="javascript:void(0);" style="text-decoration: none;color:#515151;"><strong><?=$name?></strong></a></h2>
                                <p class="font12"><b><?=$value['designation'];?></b></p>
                                <p><?=$value['description'];?></p>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
              
                </div>

            </div>
        </div>
    </div>
</section>

<?php require_once 'footer.php'; ?>
