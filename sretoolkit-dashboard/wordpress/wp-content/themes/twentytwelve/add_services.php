<?php 
/*
 Template Name:  Add Services
 */
$current_user = wp_get_current_user();
$user_id = isset($current_user->ID)?$current_user->ID:0;
$theame=get_template();
$icon_path=site_url('wp-content/themes/'.$theame.'/images/icons/');
if(!$user_id >0){
	wp_redirect(esc_url( site_url()));
}
require( dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php' );
global $wpdb, $current_site, $current_user;


if(isset($_POST['ajax_set']) && $_POST['ajax_set']==1 && $_POST['Action']=='delete' && $_POST['service_id']>0 && $user_id >0){
	$service_id=$_POST['service_id'];
	echo $query = $wpdb->prepare("DELETE FROM ".$wpdb->prefix."services  WHERE user_id= $user_id AND service_id = $service_id LIMIT 1 ");
	$wpdb->query($query);
	exit;
	die;
}

get_header(); ?>
<?php
 

wp_enqueue_script("jquery");
wp_head();

 if(isset($_POST['wp-submit']) && $_POST['wp-submit']=='Set' && $user_id > 0){
		$service_id=$_POST['service_id'];
		$link=$_POST['link'];
		
		$checkServices = $wpdb->prepare("Select service_id From ".$wpdb->prefix."services WHERE user_id= $user_id AND service_id = $service_id LIMIT 1");
		$checkServices = $wpdb->query($checkServices);
		if($checkServices){
			$query = $wpdb->prepare("UPDATE ".$wpdb->prefix."services SET link = '".$link."' WHERE user_id= $user_id AND service_id = $service_id LIMIT 1 ");
		}else{
			$query = $wpdb->prepare("
			INSERT INTO ".$wpdb->prefix."services 
			(service_id, user_id, link)
			VALUES ($service_id,$user_id,'".$link."')
			");
		}	
		$results = $wpdb->query($query);
 }
 
 
	
	$query = $wpdb->prepare("Select * From ".$wpdb->prefix."services_master");
	//$results = $wpdb->query($query);
	$services = $wpdb->get_results($query);
	
	$query = $wpdb->prepare("Select * From ".$wpdb->prefix."services WHERE user_id= $user_id");
	//$results = $wpdb->query($query);
	$user_services = $wpdb->get_results($query);

			
 ?>


<div class="addSevicesContainer">
	<div class="row">
		<div class="cell fl addSevicesHeading">
			My Services
		</div>
		
		<div class="cell fr addSevicesLink">
			<a href="javascript:AnythingPopup_OpenForm('seleectServices','seleectServicesBody','seleectServicesFooter','380','260');">+ add service</a>
		</div>
	</div>
	<div class="row addSevicesInfo">
		<div class="cell fl">
			Information:
		</div>
		
		<div class="cell fl pl100">
			Click &quot;+add service&quot; to add a service to your service page
		</div>
	</div>
	
	<div class="row pt20">
		<?php
			if($services){
				foreach($services as $service){
					$link='';
					$dn='dn';
					
					$icon=trim($service->icon_offline);
					$delColor='grey';
					$jsFunction="addServicesPopup('".$service->title."','".$service->id."','".$link."');";
					if($user_services){
						foreach($user_services as $us){
							if($us->service_id==$service->id){
								$link=$us->link;
								$icon=trim($service->icon_online);
								$dn='';
								$jsFunction="window.open('".$link."','_blank');";
								$delColor='white';
								break;
							}
						}
					}
					$icon=$icon_path.$icon;
					?>
					<div id="sevicesBox<?php echo $service->id?>" class="cell pr ml35 sevicesBox <?php echo $dn;?>">
						<div class="deleteServices <?php echo $delColor;?>" onclick="deleteServices('<?php echo $service->id;?>');">x</div>
						<!--
						<div class="row pt15 ptr" onclick="addServicesPopup('<?php echo $service->title;?>','<?php echo $service->id;?>','<?php echo $link;?>');">
							<?php echo $service->title;?>
						</div>-->
						<img class="ptr" src="<?php echo $icon;?>" alt="<?php echo $service->title;?>" onclick="<?php echo $jsFunction;?>" />
					</div>
					<?php
				}
			}
		?>
		
	</div>
	
</div>	
	
  


<div class="dn" id="AddServicesInfo">
	<div class="f16">Link Facebook</div>
	<div class="ptr pt20"> - My website </div>
</div>


<div id="seleectServices" class="AnythingPopup_BoxContainer">
	<div class="AnythingPopup_BoxContainerBody" id="seleectServicesBody">
		<div class="f16">Select the service that you&acute;d like to add..</div>
		<?php
			if($services){
				foreach($services as $service){?>
					<div class="ptr pt20" onclick="showServices('#sevicesBox<?php echo $service->id?>');"> - <?php echo $service->title;?> </div>
					<?php
				}
			}
		?>
	</div>
	<div  class="AnythingPopup_BoxContainerHeader1">
		<div class="AnythingPopup_BoxClose"><a href="javascript:AnythingPopup_HideForm('seleectServices','seleectServicesFooter');">Close</a></div>
	</div>
</div>
<div id="seleectServicesFooter" class="AnythingPopup_BoxContainerFooter dn"></div>

<div id="addServicesInfo" class="AnythingPopup_BoxContainer">
	<div class="AnythingPopup_BoxContainerBody" id="addServicesBody">
		<div class="f16 f16">Link <span id="serviceHadingPoup">Facebook</span></div>
		<div class="ptr pt50 pl35">Link your <span id="accounteHadingPoup">Facebook</span> account </div>
		<form name="loginform" id="loginform" action="<?php echo esc_url( site_url( 'add-services', 'services_post' ) ); ?>" method="post">
			<div class="row pt20">
				<div class="cell pl67 pt5">url:</div>
				<div class="cell pl10">
					<input type="text" name="link" id="link" class="input" value="" size="32" />
				</div>
			</div>
			<div class="row pt20">
				<div class="cell width100px">&nbsp;</div>
				<div class="cell">
					<input type="hidden" name="service_id" id="service_id"  value="" />
					<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Set" />
				</div>
			</div>
		</form>
		<div class="row pt50 pl35">Or if you don&acute;t have an account for this service, learn how to <a href="<?php echo esc_url( site_url('add-services-setup'));?>">set one up.</a></div>
	</div>
	<div  class="AnythingPopup_BoxContainerHeader1">
		<div class="AnythingPopup_BoxClose"><a href="javascript:AnythingPopup_HideForm('addServicesInfo','addServicesFooter');">Close</a></div>
	</div>
</div>
<div id="addServicesFooter" class="AnythingPopup_BoxContainerFooter dn"></div>
<div id="test">
	
</div>
<?php get_footer(); ?> 
<script>
var $ = jQuery.noConflict();

	function addServicesPopup(title,service_id,url){
		$('#service_id').val(service_id);
		$('#link').val(url);
		$('#serviceHadingPoup').html(title);
		$('#accounteHadingPoup').html(title);
		AnythingPopup_OpenForm('addServicesInfo','addServicesBody','addServicesFooter','100','400');
	}
	function showServices(divId){
		$(divId).show();
		AnythingPopup_HideForm('seleectServices','seleectServicesFooter');
	}
	function deleteServices(id){
		if(confirm('Are you sure you want to delete this services')){
			var divId = '#sevicesBox'+id
			$.ajax({
			type: "POST",
			url: "<?php echo site_url( 'add-services', 'services_post' )?>",
			data: { service_id: id, Action: "delete", ajax_set:1 }
			}).done(function( data ) {
				window.location.href='<?php echo site_url( 'add-services')?>';
			});
			
		}
	} 
</script>