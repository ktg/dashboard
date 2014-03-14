<?php
/**
 * Template Name: discover
 *
 * @package WordPress
 */
$theme = get_template();
$title_path = site_url('wp-content/themes/' . $theme . '/images/discover/');

$services = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "services");

get_header();
?>
	<div id="steps_container">
		<div id="step">
			<a href="<?php bloginfo('url'); ?>/discover/market-your-business">
				<img width='365px' height='53px' src="<?php echo $title_path; ?>1.png">
			</a>

			<div id="step_detail">
				<img width='112px' height='112px' src="<?php echo $title_path; ?>10.png">

				<div>
					<div>Market your business on the web and reach out to more customers. A business website can
						help you get noticed more. It is like having a shop
						window on the Internet, where customers can find you every day of the year. Also, if you are
						locally based, having a web presence will open your
						business up to new markets and customers outside your local area.
					</div>
					<a class="findmore" href="<?php bloginfo('url'); ?>/discover/market-your-business">Find out
						more</a>
				</div>
			</div>
		</div>


		<div id="step">
			<a href=""><img width='365px' height='53px' src="<?php echo $title_path; ?>4.png"></a>

			<div id="step_detail">
				<img width='112px' height='112px' src="<?php echo $title_path; ?>40.png">

				<div>
					<div>Your business might be a part of a community or under a head organisation, institute or
						company. It might even be sponsored, labelled or
						badged, which can give your business a higher quality of genuineness and professionalism.
						Learn about some of the online badging and branding
						services, which can give your business for customers to see.
					</div>
					<a class="findmore" href="<?php bloginfo('url'); ?>/discover/business-community">Find out
						more</a>
				</div>
			</div>
		</div>


		<div id="step">
			<a href=""><img width='365px' height='53px' src="<?php echo $title_path; ?>2.png"></a>

			<div id="step_detail">
				<img width='112px' height='112px' src="<?php echo $title_path; ?>20.png">

				<div>
					<div>Communication with customers is important for your business. The Internet has a range of
						website services, which makes communication with
						customers simpler. These services can help you deliver news to your customers, allow you to
						listen to what customers have to say and let you
						answer customer questions.
					</div>
					<a class="findmore" href="<?php bloginfo('url'); ?>/discover/communicate-with-customers">Find
						out more</a>
				</div>
			</div>
		</div>


		<div id="step">
			<a href=""><img width='365px' height='53px' src="<?php echo $title_path; ?>3.png"></a>

			<div id="step_detail">
				<img width='112px' height='112px' src="<?php echo $title_path; ?>30.png">

				<div>
					<div>Would you like to know who visits your website? or what your customers are most interested
						in? Understanding your customer base can help you
						run a better business and can allow you to see what areas gain you the most amount of
						profit. You can also get customer statistics on the
						website services you use.
					</div>
					<a class="findmore" href="<?php bloginfo('url'); ?>/discover/know-who-your-customers-are">Find
						out more</a>
				</div>
			</div>
		</div>


		<div id="step">
			<a href=""><img width='365px' height='53px' src="<?php echo $title_path; ?>5.png"></a>

			<div id="step_detail">
				<img width='112px' height='112px' src="<?php echo $title_path; ?>50.png">

				<div>
					<div>If your business sells items or products, you could expand your reach and have a 24-7 shop
						on the Internet. Popular websites such as Ebay
						and Etsy allow anyone to sell items on the Internet.
					</div>
					<a class="findmore" href="<?php bloginfo('url'); ?>/discover/sell-online">Find out more</a>
				</div>
			</div>
		</div>


		<div id="step">
			<a href=""><img width='365px' height='53px' src="<?php echo $title_path; ?>6.png"></a>

			<div id="step_detail">
				<img width='112px' height='112px' src="<?php echo $title_path; ?>60.png">

				<div>
					<div>If you sell items online or want to send packages to destinations on a regular basis, you
						might want to take a look at some of the services
						that can help you do this. There are delivery services that can make it sending/receiving
						parcels easy.
					</div>
					<a class="findmore" href="<?php bloginfo('url'); ?>/discover/send-packages">Find out more</a>
				</div>
			</div>
		</div>


		<div id="step">
			<a href=""><img width='365px' height='53px' src="<?php echo $title_path; ?>7.png"></a>

			<div id="step_detail">
				<img width='112px' height='112px' src="<?php echo $title_path; ?>70.png">

				<div>
					<div>If you buy or sell on the Internet, you might want to think of online payment. This can be
						external to your bank account and can manage all
						of your online business transactions.
					</div>
					<a class="findmore" href="<?php bloginfo('url'); ?>/discover/online-payment">Find out more</a>
				</div>
			</div>
		</div>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>