<!-- nav bar -->
<?php
	$topLink = ['دانستن','خواستن','توانستن'];
?>

<nav class="navbar navbar-default navbar-fixed-top" style="direction: rtl; text-align: right; display: block;">
	<div class="t-header-1">
		<div class="row">
			<div class="col-md-6 t-new-card" style="text-align: right">
				<a href="<?php echo base_url('home/register'); ?>">
					<img src="<?php echo asset_url() . 'images/t-new-card.png'; ?>"
				</a>
			</div>
			<div class="col-md-6 t-topLeft" style="text-align: left">
				<img src="<?php echo asset_url() . 'images/t-topLeft.png'; ?>"
			</div>
		</div>
	</div>

	<div class="t-header-2">
		<a class="navbar-brand" href="<?php echo base_url(); ?>" style="padding-top: 8px;">
			<img src="<?php echo asset_url() . 'images/t-header-logo.png'; ?>" alt="اهدای عضو، اهدای زندگی" style="height: 40px">
		</a>
		<a class="navbar-brand" href="<?php echo base_url(); ?>" style="padding-top: 8px; padding-right: 0px;">
			<img src="<?php echo asset_url() . 'images/t-header-logo-tabriz.png'; ?>" alt="اهدای عضو، اهدای زندگی" style="height: 40px">
		</a>

		<div class="topLinks row">
			<?php for($i=0 ; $i<=2 ; $i++) {
				?>
				<div class="topLink col-md-4" data-toggle="#divTopLink<?=$i?>">
					<div class="topLink-text">
						<?=$topLink[$i]?>
					</div>
				</div>
				<?php
			}
			?>
		</div>

		<?php for($i=0 ; $i<=2 ; $i++ ) {
			?>
			<div id="divTopLink<?=$i?>" class="topLink-dropper" style="display: none">
				<?php $this->view('new/template/navbar2_'.$i); ?>
			</div>
			<?php
		}
		?>

	</div>
</nav>

<!-- nav bar -->

<div style="clear: both; margin-top: 65px;" id="navbarHeightSpace"></div>