<div class="view">
	<table>
		<tr>
			<td width="100px">
				<?php 
					$img = !empty($data->photo_1) ? "http://flatratelist.com/upload/thumb_" . $data->photo_1 : "http://flatratelist.com/themes/custom/css/images/photo_not_available.png"; 
					$link = "/index.php/listing/flyer/viewList/id/" . $data->id;
				?>
				<a href="<?php echo $link; ?>">
					<img src="<?php echo $img; ?>" height="82px" width="110px" style="margin-right: 10px; padding: 3px; border: solid 1px rgba(220,220,220,0.5);" align="left" border="0"/>
				</a>
			</td>
			<td>			
				<b><?php echo CHtml::encode("{$data->zip_code}, {$data->address}, {$data->state}, {$data->city}"); ?></b>
				<br/>
				<b>Beds : </b><?php echo CHtml::encode($data->bedrooms); ?>
				<br/>
				<b>Baths : </b><?php echo CHtml::encode("{$data->full_baths}/{$data->half_baths}"); ?>
				<br/>
				<b>Sq.Ft. : </b><?php echo CHtml::encode($data->sq_ft_heated); ?>
				<br/>
				<b>Price : </b>$<?php echo CHtml::encode(number_format($data->list_price,2)); ?>
			</td>
		</tr>
	</table>
</div>