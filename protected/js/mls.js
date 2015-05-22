$('.tt').tooltip();
$('.dragImage').draggable({ revert: true }); 
$('#droppable').droppable({
	drop: function( event, ui ) {
		var oid = $(ui.draggable).attr('id');
		var sid = oid.replace('zImage_','');
		$(ui.draggable).attr('src','');
		$('#Mls_photo_'+ sid).val('');

		$('.dragImage').each(function(index) {
			if(index < 11 && $(this).attr('src') == '' && $('#zImage_'+ (index+2)).attr('src') !== '')
			{
				$('#Mls_photo_' + (index+1)).val( $('#Mls_photo_' + (index+2)).val() );
				$(this).attr( 'src', $('#zImage_'+ (index+2)).attr('src') );
				$('#Mls_photo_' + (index+2)).val('');
				$('#zImage_'+ (index+2)).attr('src','');
			}
		});
	},
});