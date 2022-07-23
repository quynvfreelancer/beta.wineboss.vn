<div class="product-filter-list d-flex align-items-center">

</div>
<?php
$settings = get_option( 'product-options' );
?>
<div class="product-filter">
	<div class="inner-filter">
		<div class="d-flex align-items-center">
			<div class="filter-title">
				<span class="icon">
					<i class="fa fa-filter" aria-hidden="true"></i>
				</span>
				<span class="label">
					Bộ lọc
				</span>
			</div>
			<div class="filter-price filter-item has-child">
				<span class="label">
					Giá
				</span>
				<div class="box-select">
					<a href="/" class="btn-filter">Dưới 500 nghìn</a>
					<a href="/" class="btn-filter">500k - 1triệu</a>
					<a href="/" class="btn-filter">1tr - 2 triệu</a>
					<a href="/" class="btn-filter">2tr - 3 triệu</a>
					<a href="/" class="btn-filter">3tr - 4 triệu</a>
					<a href="/" class="btn-filter">Trên 4 triệu</a>
				</div>
			</div>
			<div class="filter-nho filter-item has-child">
				<span class="label">
					Giống nho
				</span>
				<div class="box-select">
					<?php
					if ( isset( $settings['giong_nho'] ) ) {
						$giong_nho_str =  $settings['giong_nho'];
						$arr_giong_nho = explode(', ', $giong_nho_str);
						foreach ($arr_giong_nho as  $giong_nho) {
							echo '<a href="/" class="btn-filter">'.$giong_nho.'</a>';
						}
					}
					?>
				</div>
			</div>
			<div class="filter-province filter-item has-child">
				<span class="label">
					Vùng sản xuất
				</span>
				<div class="box-select">
					<?php
					if ( isset( $settings['vung_lam_vang'] ) ) {
						$vung_lam_vang_str =  $settings['vung_lam_vang'];
						$arr_vung_lam_vang = explode(', ', $vung_lam_vang_str);
						foreach ($arr_vung_lam_vang as  $vung_lam_vang) {
							echo '<a href="/" class="btn-filter">'.$vung_lam_vang.'</a>';
						}
					}
					?>
				</div>
			</div>
			<div class="filter-country filter-item  has-child">
				<span class="label">
					Xuất xứ
				</span>
				<div class="box-select">
					<?php
					if ( isset( $settings['xuat_xu'] ) ) {
						$xuat_xu_str =  $settings['xuat_xu'];
						$arr_xuat_xu = explode(', ', $xuat_xu_str);
						foreach ($arr_xuat_xu as  $xuat_xu) {
							echo '<a href="/" class="btn-filter">'.$xuat_xu.'</a>';
						}
					}
					?>
				</div>
			</div>
			<div class="filter-brand filter-item  has-child">
				<span class="label">
					Hãng sản xuất
				</span>
				<div class="box-select">
					<?php
					if ( isset( $settings['hang_san_xuat'] ) ) {
						$hang_san_xuat_str =  $settings['hang_san_xuat'];
						$arr_hang_san_xuat = explode(', ', $hang_san_xuat_str);
						foreach ($arr_hang_san_xuat as  $hang_san_xuat) {
							echo '<a href="/" class="btn-filter">'.$hang_san_xuat.'</a>';
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>