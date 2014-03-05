<?php

/**
 * Template Name: dashboard
 *
 * @package WordPress
 */
$current_user = wp_get_current_user ();
$user_id = isset($current_user->ID) ? $current_user->ID : 0;

get_header();

$query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "services");
// $results = $wpdb->query($query);
$services = $wpdb->get_results ( $query );

/* Check what services a user has in their dashboard and load them */
$query = $wpdb->prepare ("SELECT * FROM " . $wpdb->prefix . "users_services WHERE user_id=%s", $user_id);
$user_services = $wpdb->get_results ( $query );

$theme = get_template ();
$services_path = site_url ('wp-content/themes/' . $theme . '/services/');
$dashboard_view_path = site_url ('wp-content/themes/' . $theme . '/images/dashboard_view/');

?>
<div id="default_container">
	<div id="dashboard">
		<div id="services_container">
			<?php
			if ($user_services)
			{
				foreach ($user_services as $us)
				{
					foreach ($services as $service)
					{
						if ($us->service_id == $service->id)
						{				
							$service_path = $services_path . $service->key . "/";
							$icon = $service_path . "images/icon.png";
							$service_include = "services/" . $service->key . "/include.php";
							echo $service_include;
							if(file_exists($service_include))
							{
							    echo "included";
							    include $service_include;
							}
							$service_page = $service_path . "page.php";
							?>

			<a href="#" class="dashboard_icon_a" onclick="return load_page('<?php echo $service->key; ?>')">
				<img class="dashboard_icon"	src="<?php echo $icon;?>" alt="<?php echo $service->title;?>" />
			</a>
 			<?php
						}
					}
				}
			}
			?>
		</div>


		<div id="display_view">
			<div id="service_page" height="100%" width="100%"></div>
		</div>
	</div>

    <div id="turn_inside_out">

        <?php
        if (count ( $user_services ) < 4)
        {
            ?>
        <a href="#" onclick="return TurnInsideOut()"><img src="<?php echo $dashboard_view_path;?>turn_into_webpage.png" /></a>
        <?php
        }
        else
        {
            ?>
        <a href="#" onclick="return TurnInsideOutTwice()"><img src="<?php echo $dashboard_view_path;?>turn_into_webpage.png" /></a>
        <?php
        }
        ?>
    </div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>


<script type="text/javascript">

function load_page(service_key)
{
    var url;
    <?php
        if ($user_services)
        {
            foreach ($user_services as $us)
            {
                foreach ($services as $service)
                {
                    if ($us->service_id == $service->id)
                    {
                        $service_path = $services_path . $service->key . "/";
                        $service_page = $service_path . "page.php";
                        ?>
                        if(service_key == '<?php echo $service->key ?>')
                        {
                            url = "<?php echo $service_page ?>";
                        }
                        <?php
                    }
                }
            }
        }
    ?>

    load_url(url);
}

function load_url(url)
{
	document.getElementById("service_page").innerHtml = 'Fetching data...';
    var req;
    if (window.XMLHttpRequest)
    {
        req = new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (req != undefined)
    {
        req.onreadystatechange = function() {load_done(req);};
        req.open("GET", url, true);
        req.send("");
    }
}

function load_done(req)
{
    if (req.readyState == 4)
    {
        // only if req is "loaded"
        if (req.status == 200)
        {
            // only if "OK"
            document.getElementById("service_page").innerHTML = req.responseText;
        }
        else
        {
            document.getElementById("service_page").innerHTML = "Load Error:\n"+ req.status + "\n" +req.statusText;
        }
    }
}

function TurnInsideOut()
{
    load_url("<?php echo $service_path;?>dash-website/dash-website0.html");
}

function TurnInsideOutTwice()
{
    load_url("<?php echo $service_path;?>dash-website/dash-website.html");
}
</script>