<?php
function schema_career(){
	if( is_singular('career') ){
		add_filter( 'wpseo_json_ld_output', '__return_empty_array' );
		$post_id = get_the_ID();
		$title = get_the_title();
		$salary = rwmb_meta('career_salary');
		$job_type = rwmb_meta('career_ht');
		$location = rwmb_meta('career_location');
		$exprire_date = rwmb_meta('exprire_date');
		$career_desc = rwmb_meta('career_desc');
		if($career_desc ==''){
			$career_desc =  wb_post_excerpt(30);
		}
		if(str_word_count($career_desc) > 30){
			$career_desc = wp_trim_words( $career_desc, 30, '...' );
		}
		
		?>

		<script type="application/ld+json">
			{
				"@context" : "https://schema.org/",
				"@type" : "JobPosting",
				"title" : "<?php echo $title; ?>",
				"description" : "<?php echo $career_desc;?>",
				"identifier": {
					"@type": "PropertyValue",
					"name": "Thiết bị y tế An Phát",
					"value": "1234567"
				},
				"datePosted" : "<?php echo date('Y-m-d')?>",
				"validThrough" : "<?php echo $exprire_date;?>",
				"employmentType" : "<?php echo $job_type;?>",
				"hiringOrganization" : {
					"@type" : "Organization",
					"name" : "Thiết bị y tế An Phát",
					"sameAs" : "http://www.google.com",
					"logo" : "<?php echo THEME_URI;?>/images/logo-header.svg"
				},
				"jobLocation": {
					"@type": "Place",
					"address": {
						"@type": "PostalAddress",
						"streetAddress": "<?php echo $location;?>",
						"addressLocality": "Hà Đông",
						"addressRegion": "HN",
						"postalCode": "100000",
						"addressCountry": "VN"
					}
				},
				"baseSalary": {
					"@type": "MonetaryAmount",
					"currency": "VNĐ",
					"value": {
						"@type": "QuantitativeValue",
						"value": "<?php echo $salary;;?>",
						"unitText": "Tháng"
					}
				}
			}
		</script>


	<?php }
}
add_action('wp_enqueue_scripts', 'schema_career');