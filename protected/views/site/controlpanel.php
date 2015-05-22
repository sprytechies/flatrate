<style type="text/css">
    .news{
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px; 
		padding: 20px;
		border: solid 1px #DCDCDC;
		margin: 20px 0;
		-webkit-box-shadow: inset 0px 0px 8px 2px rgba(200, 200, 200, 0.5);
		-moz-box-shadow: inset 0px 0px 8px 2px rgba(200, 200, 200, 0.5);
		box-shadow: inset 0px 0px 8px 2px rgba(200, 200, 200, 0.5); 
	}
        .ctable td{
            text-align: center;
            padding-top: 30px;
        }    
       
</style>

<?php
$this->breadcrumbs=array(
	'controlpanel'=>array('controlpanel'),
);
?>
<hr class="space"/>
<div class="control-panel">
    <h1>Control Panel</h1>
    <div class="news">
        <table class="ctable">
            <?php if(Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()){ ?>
            <tr>
                <?php if(Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()){ ?>
                <td>
                    <br><a href="/index.php/listing/mls/create"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/1.png"></span><br>Create a residential listing</a>
                </td>  
                <?php } ?>
                
                <?php if(Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()){ ?>
                <td>
                    <br><a href="/index.php/listing/mls/admin"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/2.png"></span><br>Make a change to your residential listing</a>
                </td>  
                <?php } ?>
                <?php if(Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()){ ?>
                <td><br><a href="/index.php/listing/mls/managePending"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/3.png"></span><br>Mark your residential listing as pending</a>
                </td>  
                <?php } ?>
                <?php if(Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()){ ?>
                <td><a href="/index.php/listing/land/create"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/4.png"></span><br>Create a vacant lot listing</a>
                </td>  
                <?php } ?>
                <?php if(Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()){ ?>
                <td> <br><a href="/index.php/listing/land/admin"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/5.png"></span><br>Make a change to your vacant lot listing</a>
                </td> 
                <?php } ?>
                <td><a href="/index.php/listing/forms/download"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/6.png"></span><br>Download forms</a>
                </td>  
                <td><br><a href="/index.php/site/contact"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/7.png"></span><br>Report an issue with the website or your listing</a>
                </td> 
                <?php if(Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()){ ?>
                <td><br><a href="/index.php/listing/flyer/flyer"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/8.png"></span><br>Print a flyer</a>
                </td> 
                 <?php } ?>
               
                </tr>   
                <tr>
                     <?php if(Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()){ ?>
                <td><br><br><a href="/index.php/site/broker"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/9.png"></span><br>I have a question about my listing</a>
                 </td>  
                <?php } ?>
                <td><a href="/index.php/faq/index"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/10.png"></span><br>FAQs</a>
                </td>  
                <td><a href="/index.php/testimonials/index"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/11.png"></span><br>Testimonials</a>
                </td>
                <td><br><a href="/index.php/site/broker"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/9.png"></span><br>Need the help of a full service Realtor?</a>
                </td>
                <td><a href="/index.php/site/manageFeedback"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/12.png"></span><br>List All Feedback</a></th>
                <td><br><a href="/index.php/site/jacksonsigns"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/20.png"></span><br>Professional Looking Yard Sign</a></th>
                <td><a href="http://go.mikogo.com"> <span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/13.png"></span><br>Mikogo</a></th>
            </tr>
            <?php } else { ?>
            
                        <tr>
                        <td><a href="/index.php/site/manageFeedback"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/12.png"></span><br>List All Feedback</a></th>
                        <td><a href="/index.php/faq/index"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/10.png"></span><br>FAQs</a>
                        </td>  
                        <td><a href="/index.php/testimonials/index"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/11.png"></span><br>Testimonials</a>
                        </td>
                        <td><a href="/index.php/site/broker"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/9.png"></span><br>Need the help of a full service Realtor?</a>
                        </td>
                       </td> 
                        <td><a href="/index.php/site/contact"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/7.png"></span><br>Report an issue with the website or your listing</a>
                        
                        </tr>   
                        <tr> <td><a href="/index.php/site/jacksonsigns"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/20.png"></span><br>Professional Looking Yard Sign</a></th>
                        <td> <a href="http://go.mikogo.com"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/13.png"></span><br>Mikogo</a></th>
                    
                        </tr>
            
            <?php } ?>
        </table>
       
        <div  style="clear:both;"></div>
        
    </div>
</div>

<?php if(Yii::app()->user->isAdmin()){ ?>
<div class="control-panel">
    <h1>Admin Panel</h1>
    <div class="news">
        <table class="ctable">
            <tr>
                <td><a href="/index.php/listing/forms/upload"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/12.png"></span><br>Upload forms</a></td>
                <td><a href="/index.php/listing/status/admin"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/13.png"></span><br>Update listing status</a></td>
                <td><a href="/index.php/listing/status/sales"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/14.png"></span><br>Track Sales</a></td>
                <td><a href="/index.php/planpromo/plan"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/15.png"></span><br>Plan & Promo</a></td>
                <td><a href="/index.php/listing/survey/admin"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/16.png"></span><br>Manage Surveys</a></td>
                <td><a href="/index.php/faq/admin"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/17.png"></span><br>Manage FAQs</a></td>
                <td><a href="/index.php/testimonials/admin"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/panel-icons/18.png"></span><br>Manage Testimonials</a></td>
            </tr>
        </table>
    </div>
</div>
<?php } ?>
