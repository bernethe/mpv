<nav class="text-center">
	<ul class="pagination">
		<?php if($c_p > 1) { ?>
		<li>
			<a href="<?php echo $cp_p.'&p='.($c_p-1); ?>" aria-label="Previous">
				<span aria-hidden="true"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
			</a>
		</li>
		<?php }
			for($i_p = 1; $i_p <= 7; $i_p++) {
				$i_c_p = $i_p-4;
				$point_p = $c_p+$i_c_p;
				if($point_p > 0 && $point_p <= $tot_p) {	
		?>
		<li<?php if($point_p == $c_p){ echo ' class="active"'; } ?>><a href="<?php echo $cp_p; ?>&p=<?php echo $point_p; ?>"><?php echo $point_p; ?></a></li>
		<?php } }
		if($c_p < $tot_p) { ?>
		<li>
			<a href="<?php echo $cp_p.'&p='.($c_p+1); ?>" aria-label="Next">
				<span aria-hidden="true"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
			</a>
		</li>
		<?php } ?>
	</ul>
</nav>
<div class="row">
	<div class="col-sm-12 text-center"><small style="color:#999;">pgn. <?php echo $c_p.'/'.$tot_p; ?> | reg. <?php echo ($c_p*$g_p)-$g_p+1; ?> al <?php $puntero_pagination = $c_p*$g_p; if($puntero_pagination < $tot){ echo $puntero_pagination; } else { echo $tot; } ?> de <?php echo $tot; ?></small></div>
</div>