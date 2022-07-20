<?php
class SimpleLinkListWidget extends WP_Widget {	
	public function __construct() {
		$widget_ops = array('classname' => 'widget_link_list', 'description' => __('A link list.'));
		parent::__construct(
			'list_link',
			__('List link đích'),
			$widget_ops
		);
		
		add_action('admin_enqueue_scripts', array($this,'sllw_load_scripts'));
	}

	public function widget( $args, $instance ) {
		$title = apply_filters('widget_title', empty($instance['title']) ? __('List') : $instance['title']);
		$reverse = isset($instance['reverse']) ? $instance['reverse'] : false;
		$amount = empty($instance['amount']) ? 3 : $instance['amount'];
		for ($i = 1; $i <= $amount; $i++) {
			$items[$i-1] = $instance['item'.$i];
			$item_links[$i-1] = $instance['item_link'.$i];
			$item_classes[$i-1] = $instance['item_class'.$i];	
			$item_targets[$i-1] = isset($instance['item_target'.$i]) ? $instance['item_target'.$i] : false;
		}
		
		if($reverse){
			$items = array_reverse($items);
			$item_links = array_reverse($item_links);
			$item_classes = array_reverse($item_classes);
			$item_targets = array_reverse($item_targets);
		}
		
		echo '<div class="col-md-3 col-sm-6 col-6 widget widget-link">';
		echo '<div class="widget-title"><span>';
		if ( ! empty( $instance['title'] ) ) {
			echo  apply_filters( 'widget_title', $instance['title'] ) ;
		}		
		echo '</span></div>';
		echo '<div class="widget-content">';
		echo"<ul class='nav flex-column'>";
		?>
		<?php foreach ($items as $num => $item) : 
			if (!empty($item)) :
				if (empty($item_links[$num])) :
					echo("<li class='nav-item " . $item_classes[$num] . "'>" . $item . "</li>");
				else :
					if($item_targets[$num]) :
						echo("<li class=' nav-item " . $item_classes[$num] . "'><a class='nav-link' href='" . $item_links[$num] . "' target='_blank'>" . $item . "</a></li>");
					else :
						echo("<li class='nav-item " . $item_classes[$num] . "'><a class='nav-link' href='" . $item_links[$num] . "'>" . $item . "</a></li>");
					endif;
				endif;
			endif;
		endforeach;
		echo("</ul>");
		echo '</div>';
		echo '</div>';
	}

	public function update( $new_instance, $old_instance) {
		$instance['title'] = (! empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : "";
		$amount = $new_instance['amount'];
		$new_item = $new_instance['new_item'] ? 1 : 0;

		if ( isset($new_instance['position1'])) {
			for($i=1; $i<= $new_instance['amount']; $i++){
				if($new_instance['position'.$i] != -1){
					$position[$i] = $new_instance['position'.$i];
				}else{
					$amount--;
				}
			}
			if($position){
				asort($position);
				$order = array_keys($position);
				if(strip_tags($new_instance['new_item'])){
					$amount++;
					array_push($order, $amount);
				}
			}

		}else{
			$order = explode(',',$new_instance['order']);
			foreach($order as $key => $order_str){
				$num = strrpos($order_str,'-');
				if($num !== false){
					$order[$key] = substr($order_str,$num+1);
				}
			}
		}

		if($order){
			foreach ($order as $i => $item_num) {
				$instance['item'.($i+1)] = (!empty($new_instance['item'.$item_num])) ? sanitize_text_field($new_instance['item'.$item_num]) : "";
				$instance['item_link'.($i+1)] = (!empty($new_instance['item_link'.$item_num])) ? sanitize_text_field($new_instance['item_link'.$item_num]) : "";
				$instance['item_class'.($i+1)] = (!empty($new_instance['item_class'.$item_num])) ? sanitize_text_field($new_instance['item_class'.$item_num]) : "";
				$instance['item_target'.($i+1)] = $new_instance['item_target'.$item_num] ? 1 : 0;
			}
			
		}

		$instance['amount'] = $amount;

		$instance['reverse'] = $new_instance['reverse'] ? 1 : 0;

		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'title_link' => '' ) );
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Widget title', 'vdl' );
		$amount = empty($instance['amount']) ? 3 : $instance['amount'];
		for ($i = 1; $i <= $amount; $i++) {
			$items[$i] = empty($instance['item'.$i]) ? '' : $instance['item'.$i];
			$item_links[$i] = empty($instance['item_link'.$i]) ? '' : $instance['item_link'.$i];
			$item_classes[$i] = empty($instance['item_class'.$i]) ? '' : $instance['item_class'.$i];				
			$item_targets[$i] = ! empty( $instance['item_target'.$i] ) ? $instance['item_target'.$i] : 0;
		}
		$title_link = $instance['title_link'];
		$reverse = ! empty( $instance['reverse'] ) ? $instance['reverse'] : 0;
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

		<div class="simple-link-list">
			<?php foreach ($items as $num => $item) :
				$item = esc_attr($item);
				$item_link = esc_attr($item_links[$num]);
				$item_class = esc_attr($item_classes[$num]);
				?>

				<div id="<?php echo $this->get_field_id($num); ?>" class="list-item">
					<h5 class="moving-handle"><span class="number"><?php echo $num; ?></span>. <span class="item-title"><?php echo $item; ?></span><a class="sllw-action hide-if-no-js"></a></h5>
					<div class="sllw-edit-item">
						<label for="<?php echo $this->get_field_id('item'.$num); ?>"><?php echo __("Text:"); ?></label>
						<input class="widefat" id="<?php echo $this->get_field_id('item'.$num); ?>" name="<?php echo $this->get_field_name('item'.$num); ?>" type="text" value="<?php echo $item; ?>" />
						<label for="<?php echo $this->get_field_id('item_link'.$num); ?>"><?php echo __("Link:"); ?></label>
						<input class="widefat" id="<?php echo $this->get_field_id('item_link'.$num); ?>" name="<?php echo $this->get_field_name('item_link'.$num); ?>" type="text" value="<?php echo $item_link; ?>" />
						<label for="<?php echo $this->get_field_id('item_class'.$num); ?>"><?php echo __("Custom Style Class:"); ?></label>
						<input class="widefat" id="<?php echo $this->get_field_id('item_class'.$num); ?>" name="<?php echo $this->get_field_name('item_class'.$num); ?>" type="text" value="<?php echo $item_class; ?>" />
						<input type="checkbox" name="<?php echo $this->get_field_name('item_target'.$num); ?>" id="<?php echo $this->get_field_id('item_target'.$num); ?>" <?php checked($item_targets[$num]); ?> /> <label for="<?php echo $this->get_field_id('item_target'.$num); ?>"><?php echo __("Open in new window"); ?></label>
						<a class="sllw-delete hide-if-no-js"><img src="<?php echo get_template_directory_uri();?>/core/modules/widget/simple-link-list/images/delete.png" /> <?php echo __("Remove"); ?></a>
					</div>
				</div>

			<?php endforeach; 

			if ( isset($_GET['editwidget']) && $_GET['editwidget'] ) : ?>
				<table class='widefat'>
					<thead><tr><th><?php echo __("Item"); ?></th><th><?php echo __("Position/Action"); ?></th></tr></thead>
					<tbody>
						<?php foreach ($items as $num => $item) : ?>
							<tr>
								<td><?php echo esc_attr($item); ?></td>
								<td>
									<select id="<?php echo $this->get_field_id('position'.$num); ?>" name="<?php echo $this->get_field_name('position'.$num); ?>">
										<option><?php echo __('&mdash; Select &mdash;'); ?></option>
										<?php for($i=1; $i<=count($items); $i++) {
											if($i==$num){
												echo "<option value='$i' selected>$i</option>";
											}else{
												echo "<option value='$i'>$i</option>";
											}
										} ?>
										<option value="-1"><?php echo __("Delete"); ?></option>
									</select>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>

				<div class="sllw-row">
					<input type="checkbox" name="<?php echo $this->get_field_name('new_item'); ?>" id="<?php echo $this->get_field_id('new_item'); ?>" /> <label for="<?php echo $this->get_field_id('new_item'); ?>"><?php echo __("Add New Item"); ?></label>
				</div>
			<?php endif; ?>

		</div>
		<div class="sllw-row hide-if-no-js">
			<a class="sllw-add button-secondary">
				<img src="<?php echo get_template_directory_uri().'/core/modules/widget/simple-link-list/images/add.png';?>" /> <?php echo __("Add Item"); ?>
			</a>
		</div>

		<input type="hidden" id="<?php echo $this->get_field_id('amount'); ?>" class="amount" name="<?php echo $this->get_field_name('amount'); ?>" value="<?php echo $amount ?>" />
		<input type="hidden" id="<?php echo $this->get_field_id('order'); ?>" class="order" name="<?php echo $this->get_field_name('order'); ?>" value="<?php echo implode(',',range(1,$amount)); ?>" />

		<div class="sllw-row">		
			<input type="checkbox" name="<?php echo $this->get_field_name('reverse'); ?>" id="<?php echo $this->get_field_id('reverse'); ?>" <?php checked($reverse); ?> /> <label for="<?php echo $this->get_field_id('reverse'); ?>"><?php echo __("Reverse output order"); ?></label>
		</div>

		<?php
	}

	public function sllw_load_scripts($hook) {
		if( $hook != 'widgets.php') 
			return;
		if ( !isset($_GET['editwidget'])) {
			wp_enqueue_script( 'sllw-sort-js',get_template_directory_uri().'/core/modules/widget/simple-link-list/js/sllw-sort.js');
		}
		wp_enqueue_style( 'sllw-css',get_template_directory_uri().'/core/modules/widget/simple-link-list/css/sllw.css');
	}

}

function register_sllw() {
	return register_widget("SimpleLinkListWidget");
}
add_action('widgets_init', "register_sllw");

class Widget_Mega_Menu extends WP_Widget {	
	public function __construct() {
		$widget_ops = array('classname' => 'widget_mega_menu', 'description' => __('A link list.'));
		parent::__construct(
			'widget_mega_menu',
			__('Mega Menu'),
			$widget_ops
		);

		add_action('admin_enqueue_scripts', array($this,'sllw_load_scripts'));
	}

	public function widget( $args, $instance ) {
		$title = apply_filters('widget_title', empty($instance['title']) ? __('List') : $instance['title']);
		$parent_link = isset($instance['parent_link']) ? $instance['parent_link'] : '#';
		$reverse = isset($instance['reverse']) ? $instance['reverse'] : false;
		$amount = empty($instance['amount']) ? 3 : $instance['amount'];
		for ($i = 1; $i <= $amount; $i++) {
			$items[$i-1] = $instance['item'.$i];
			$item_links[$i-1] = $instance['item_link'.$i];
			$item_classes[$i-1] = $instance['item_class'.$i];	
			$item_targets[$i-1] = isset($instance['item_target'.$i]) ? $instance['item_target'.$i] : false;
		}

		if($reverse){
			$items = array_reverse($items);
			$item_links = array_reverse($item_links);
			$item_classes = array_reverse($item_classes);
			$item_targets = array_reverse($item_targets);
		}

		echo '<div class="col widget-list-cat">';
		echo '<div class="widget-title"><a href="'.$parent_link.'">'.$title.'</a></div>';
		echo '<div class="widget-content  d-flex flex-wrap">';
		echo"<ul class='nav'>";
		
		?>
		<?php
		foreach ($items as $num => $item) : 
			if (!empty($item)) :
				if (empty($item_links[$num])) :
					echo("<li class='" . $item_classes[$num] . "'>" . $item . "</li>");
				else :
					if($item_targets[$num]) :
						echo("<li class='" . $item_classes[$num] . "'><a href='" . $item_links[$num] . "' target='_blank'>" . $item . "</a></li>");
					else :
						echo("<li class='" . $item_classes[$num] . "'><a href='" . $item_links[$num] . "'>" . $item . "</a></li>");
					endif;
				endif;
			endif;
		endforeach;
		echo("</ul>");
		echo '</div>';
		echo '</div>';
	}

	public function update( $new_instance, $old_instance) {
		$instance['title'] = (! empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : "";
		$instance['parent_link'] = (! empty($new_instance['parent_link'])) ? sanitize_text_field($new_instance['parent_link']) : "#";
		$amount = $new_instance['amount'];
		$new_item = $new_instance['new_item'] ? 1 : 0;

		if ( isset($new_instance['position1'])) {
			for($i=1; $i<= $new_instance['amount']; $i++){
				if($new_instance['position'.$i] != -1){
					$position[$i] = $new_instance['position'.$i];
				}else{
					$amount--;
				}
			}
			if($position){
				asort($position);
				$order = array_keys($position);
				if(strip_tags($new_instance['new_item'])){
					$amount++;
					array_push($order, $amount);
				}
			}

		}else{
			$order = explode(',',$new_instance['order']);
			foreach($order as $key => $order_str){
				$num = strrpos($order_str,'-');
				if($num !== false){
					$order[$key] = substr($order_str,$num+1);
				}
			}
		}

		if($order){
			foreach ($order as $i => $item_num) {
				$instance['item'.($i+1)] = (!empty($new_instance['item'.$item_num])) ? sanitize_text_field($new_instance['item'.$item_num]) : "";
				$instance['item_link'.($i+1)] = (!empty($new_instance['item_link'.$item_num])) ? sanitize_text_field($new_instance['item_link'.$item_num]) : "";
				$instance['item_class'.($i+1)] = (!empty($new_instance['item_class'.$item_num])) ? sanitize_text_field($new_instance['item_class'.$item_num]) : "";
				$instance['item_target'.($i+1)] = $new_instance['item_target'.$item_num] ? 1 : 0;
			}
		}

		$instance['amount'] = $amount;

		$instance['reverse'] = $new_instance['reverse'] ? 1 : 0;

		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'title_link' => '' ) );
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Widget title', 'vdl' );
		$parent_link = ! empty( $instance['parent_link'] ) ? $instance['parent_link'] : esc_html__( '#', 'vdl' );
		$amount = empty($instance['amount']) ? 3 : $instance['amount'];
		for ($i = 1; $i <= $amount; $i++) {
			$items[$i] = empty($instance['item'.$i]) ? '' : $instance['item'.$i];
			$item_links[$i] = empty($instance['item_link'.$i]) ? '' : $instance['item_link'.$i];
			$item_classes[$i] = empty($instance['item_class'.$i]) ? '' : $instance['item_class'.$i];				
			$item_targets[$i] = ! empty( $instance['item_target'.$i] ) ? $instance['item_target'.$i] : 0;
		}
		$title_link = $instance['title_link'];
		$reverse = ! empty( $instance['reverse'] ) ? $instance['reverse'] : 0;
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('parent_link'); ?>"><?php _e('Link chuyên mục:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('parent_link'); ?>" name="<?php echo $this->get_field_name('parent_link'); ?>" type="text" value="<?php echo esc_attr($parent_link); ?>" />
		</p>

		<div class="simple-link-list">
			<?php foreach ($items as $num => $item) :
				$item = esc_attr($item);
				$item_link = esc_attr($item_links[$num]);
				$item_class = esc_attr($item_classes[$num]);
				?>

				<div id="<?php echo $this->get_field_id($num); ?>" class="list-item">
					<h5 class="moving-handle"><span class="number"><?php echo $num; ?></span>. <span class="item-title"><?php echo $item; ?></span><a class="sllw-action hide-if-no-js"></a></h5>
					<div class="sllw-edit-item">
						<label for="<?php echo $this->get_field_id('item'.$num); ?>"><?php echo __("Text:"); ?></label>
						<input class="widefat" id="<?php echo $this->get_field_id('item'.$num); ?>" name="<?php echo $this->get_field_name('item'.$num); ?>" type="text" value="<?php echo $item; ?>" />
						<label for="<?php echo $this->get_field_id('item_link'.$num); ?>"><?php echo __("Link:"); ?></label>
						<input class="widefat" id="<?php echo $this->get_field_id('item_link'.$num); ?>" name="<?php echo $this->get_field_name('item_link'.$num); ?>" type="text" value="<?php echo $item_link; ?>" />
						<label for="<?php echo $this->get_field_id('item_class'.$num); ?>"><?php echo __("Custom Style Class:"); ?></label>
						<input class="widefat" id="<?php echo $this->get_field_id('item_class'.$num); ?>" name="<?php echo $this->get_field_name('item_class'.$num); ?>" type="text" value="<?php echo $item_class; ?>" />
						<input type="checkbox" name="<?php echo $this->get_field_name('item_target'.$num); ?>" id="<?php echo $this->get_field_id('item_target'.$num); ?>" <?php checked($item_targets[$num]); ?> /> <label for="<?php echo $this->get_field_id('item_target'.$num); ?>"><?php echo __("Open in new window"); ?></label>
						<a class="sllw-delete hide-if-no-js"><img src="<?php echo get_template_directory_uri();?>/core/modules/widget/simple-link-list/images/delete.png" /> <?php echo __("Remove"); ?></a>
					</div>
				</div>

			<?php endforeach; 

			if ( isset($_GET['editwidget']) && $_GET['editwidget'] ) : ?>
				<table class='widefat'>
					<thead><tr><th><?php echo __("Item"); ?></th><th><?php echo __("Position/Action"); ?></th></tr></thead>
					<tbody>
						<?php foreach ($items as $num => $item) : ?>
							<tr>
								<td><?php echo esc_attr($item); ?></td>
								<td>
									<select id="<?php echo $this->get_field_id('position'.$num); ?>" name="<?php echo $this->get_field_name('position'.$num); ?>">
										<option><?php echo __('&mdash; Select &mdash;'); ?></option>
										<?php for($i=1; $i<=count($items); $i++) {
											if($i==$num){
												echo "<option value='$i' selected>$i</option>";
											}else{
												echo "<option value='$i'>$i</option>";
											}
										} ?>
										<option value="-1"><?php echo __("Delete"); ?></option>
									</select>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>

				<div class="sllw-row">
					<input type="checkbox" name="<?php echo $this->get_field_name('new_item'); ?>" id="<?php echo $this->get_field_id('new_item'); ?>" /> <label for="<?php echo $this->get_field_id('new_item'); ?>"><?php echo __("Add New Item"); ?></label>
				</div>
			<?php endif; ?>

		</div>
		<div class="sllw-row hide-if-no-js">
			<a class="sllw-add button-secondary">
				<img src="<?php echo get_template_directory_uri().'/core/modules/widget/simple-link-list/images/add.png';?>" /> <?php echo __("Add Item"); ?></a>
			</div>

			<input type="hidden" id="<?php echo $this->get_field_id('amount'); ?>" class="amount" name="<?php echo $this->get_field_name('amount'); ?>" value="<?php echo $amount ?>" />
			<input type="hidden" id="<?php echo $this->get_field_id('order'); ?>" class="order" name="<?php echo $this->get_field_name('order'); ?>" value="<?php echo implode(',',range(1,$amount)); ?>" />

			<div class="sllw-row">		
				<input type="checkbox" name="<?php echo $this->get_field_name('reverse'); ?>" id="<?php echo $this->get_field_id('reverse'); ?>" <?php checked($reverse); ?> /> <label for="<?php echo $this->get_field_id('reverse'); ?>"><?php echo __("Reverse output order"); ?></label>
			</div>

			<?php
		}

		public function sllw_load_scripts($hook) {
			if( $hook != 'widgets.php') 
				return;
			if ( !isset($_GET['editwidget'])) {
				wp_enqueue_script( 'sllw-sort-js',get_template_directory_uri().'/core/modules/widget/simple-link-list/js/sllw-sort.js');
			}
			wp_enqueue_style( 'sllw-css',get_template_directory_uri().'/core/modules/widget/simple-link-list/css/sllw.css');
		}
	}

	function register_mega_menu_widget() {
		return register_widget("Widget_Mega_Menu");
	}
	add_action('widgets_init', "register_mega_menu_widget");
