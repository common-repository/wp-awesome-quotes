<?php
/**
 * Merge scripts and styles with page html.
 */
add_action('wp_footer', 'wpaq_merge_scripts');

if (!function_exists("wpaq_merge_scripts")) {
	function wpaq_merge_scripts() { 
	  /* get all quotes from admin via query*/
		
      $titlearray = array();
      $post_title = new WP_Query( array( 
		'post_type' => 'wpaq_quotes',
		'post_status' => 'publish',
		'orderby=title',
		'posts_per_page' => -1 ) 
	  ); 
      global $post;
      if($post_title->have_posts()){
        while ($post_title->have_posts()):$post_title->the_post();
        $titlearray[] = $post->post_title;
        endwhile;
     }
?>
		<div id="wpaq_wrapper">
			<p id="wpaq_desc" class="centered"></p></div>
		<?php if ( !is_admin() ) {

			$wpaq_enabled = get_option('wpaq_enabled');
			if(empty($wpaq_enabled)){
				return;
			}
			?>
			
			<script type="text/javascript">
				var title_content = <?php echo json_encode($titlearray); ?>;
                console.log(title_content);

				//<![CDATA[
				/*
				Pure javascript used in order to avoid conflicts
				will give functionality to add quotes from admin in next version
				*/	
				var awesome_quotes = [
					'“The Best Way To Get Started Is To Quit Talking And Begin Doing.” – Walt Disney',
					'“The Pessimist Sees Difficulty In Every Opportunity. The Optimist Sees Opportunity In Every Difficulty.” – Winston Churchill',
					'“Don’t Let Yesterday Take Up Too Much Of Today.” – Will Rogers',
					'“If You Are Working On Something That You Really Care About, You Don’t Have To Be Pushed. The Vision Pulls You.” – Steve Jobs',
					'“People Who Are Crazy Enough To Think They Can Change The World, Are The Ones Who Do.” – Rob Siltanen',
					'“If something is important enough, even if the odds are against you, you should still do it.” -Elon Musk',
					'“Champions keep playing until they get it right.” -Billie Jean King',
					'“The best time to plant a tree was 20 years ago. The second best time is now.”',
					'“Believe you can and you’re halfway there.” - Theodore Roosevelt',
					'“Strive not to be a success, but rather to be of value.” -- Albert Einstein'			
				];
				if (title_content.length === 0) {   //if no quotes added from admin then display default  quotes
					var quote_array=awesome_quotes.slice();
					var arr_length= quote_array.length; 
				}
				else{
					var quote_array=title_content.slice();
					var arr_length= quote_array.length; 
				}
                       
				var wpaq_i = Math.floor(arr_length*Math.random()); //get a random quote among all of them
			
				document.getElementById("wpaq_desc").innerHTML = quote_array[wpaq_i];
				
				//check if page is loaded or not
				document.onreadystatechange = function() { 
					if (document.readyState !== "complete") { 
						wpaq_fadeIn(document.getElementById("wpaq_wrapper")); 
					} else { 
						setTimeout(function(){
							wpaq_fadeOut(document.getElementById("wpaq_wrapper"),2000); 
						},1000) //timeout added for better user experience
						
					} 
				};
				
				//Thanks to: https://stackoverflow.com/questions/13733912/javascript-fade-in-fade-out-without-jquery-and-css3
				function wpaq_fadeIn( elem, ms )
				{
				if( ! elem )
					return;

				elem.style.opacity = 0;
				elem.style.filter = "alpha(opacity=0)";
				elem.style.display = "inline-block";
				elem.style.visibility = "visible";

				if( ms )
				{
					var opacity = 0;
					var timer = setInterval( function() {
					opacity += 50 / ms;
					if( opacity >= 1 )
					{
						clearInterval(timer);
						opacity = 1;
					}
					elem.style.opacity = opacity;
					elem.style.filter = "alpha(opacity=" + opacity * 100 + ")";
					}, 50 );
				}
				else
				{
					elem.style.opacity = 1;
					elem.style.filter = "alpha(opacity=1)";
				}
				}

				function wpaq_fadeOut( elem, ms )
				{
				if( ! elem )
					return;

				if( ms )
				{
					var opacity = 1;
					var timer = setInterval( function() {
					opacity -= 50 / ms;
					if( opacity <= 0 )
					{
						clearInterval(timer);
						opacity = 0;
						elem.style.display = "none";
						elem.style.visibility = "hidden";
					}
					elem.style.opacity = opacity;
					elem.style.filter = "alpha(opacity=" + opacity * 100 + ")";
					}, 50 );
				}
				else
				{
					elem.style.opacity = 0;
					elem.style.filter = "alpha(opacity=0)";
					elem.style.display = "none";
					elem.style.visibility = "hidden";
				}
				}

			//]]>
			</script>
			<style type="text/css">
				#wpaq_wrapper{position:fixed;display:none;width:100%;height:100%;top:0;left:0;right:0;bottom:0;background:#f2f2f2;cursor:pointer;z-index:99999999999}.centered{position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);-webkit-transform:translate(-50%,-50%);-moz-transform:translate(-50%,-50%);-o-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);font-size:20px;background-color:#3c4858;border:#f44336 5px solid;color:#fff;padding:5px;z-index:100}
			</style>
			<?php
		  
		  
		    //get admin settings and apply
			$wpaq_font_color = get_option('wpaq_font_color');
			$wpaq_background_color = get_option('wpaq_background_color');
			$wpaq_font_size = get_option('wpaq_font_size');
		    $wpaq_border_color = get_option('wpaq_border_color');
		  
		    if(!empty($wpaq_font_color)){
				echo '<style>#wpaq_desc{color:'.$wpaq_font_color.'}</style>';
			}
		  	if(!empty($wpaq_font_color)){
				echo '<style>#wpaq_desc{background-color:'.$wpaq_background_color.'}</style>';
			}
		  	if(!empty($wpaq_font_size)){
				echo '<style>#wpaq_desc{font-size:'.$wpaq_font_size.'px}</style>';
			}
		    if(!empty($wpaq_border_color)){
				echo '<style>#wpaq_desc{border-color:'.$wpaq_border_color.'}</style>';
			}

		  
		}
	} 
}
?>