$(document).ready(function() {
    		var count = 0;

    		$("#add_elemen").click(function(){
					count += 1;
		   		$('#containerelemen').append(
							 '<tr class="records">'						 
						 + '<td><label id="'+count+'">' + count + '</label></td>'
						 + '<td><input id="nim_' + count + '" name="nim_' + count + '" class="form-control" type="text"></td>'
						 + '<td><input id="nama_depan_' + count + '" name="nama_depan_' + count + '" class="form-control" type="text"></td>'
						 + '<td><input id="nama_belakang_' + count + '" name="nama_belakang_' + count + '" class="form-control" type="text"></td>'
						 + '<td><input id="jns_klmn_' + count + '" name="jns_klmn_' + count + '" class="form-control" type="text"></td>'
						 + '<td><input id="umur_' + count + '" name="umur_' + count + '" class="form-control" type="text"></td>'
						 + '<td><input id="ciri_' + count + '" name="ciri_' + count + '" class="form-control" type="text"></td>'
						 + '<td><input id="jumlah_' + count + '" name="jumlah_' + count + '" class="form-control" type="text"></td>'
						 + '<td><a class="remove_item" href="#" >Delete</a>'
						 + '<input id="rows_' + count + '" name="rows[]" value="'+ count +'" type="hidden"></td></tr>'
					);
				});

				$(".remove_item").live('click', function (ev) {
    			if (ev.type == 'click') {
	        	$(this).parents(".records").fadeOut();
	        	$(this).parents(".records").remove();
        	}
     		});
		});

