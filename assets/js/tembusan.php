<script src='js/jquery.min.js'></script>
<script src='js/jquery-ui.min.js'></script>
<link href='js/jquery-ui.css' rel='stylesheet' type='text/css'/>
<script type="text/javascript">
$(document).ready(function() {
    		var count = 0;

    		$("#add_btn").click(function(){
					count += 1;
					if (count >8){
							alert("Maksimal 8 Tembusan");
							return false;
							}
		   		$('#container').append(
							
						'<tr class="records">'	
						+ '<td>&nbsp;</td>'
					 						
							<?php 
							$connection = mysql_connect("localhost","root","root") or die(mysql_error());
							mysql_select_db("perizinan") or die(mysql_error());
							$query=mysql_query("select * from tembusan");
							?>
						+ '<td><select id="cmb_' + count + '" name="cmb_' + count + '" class="form-control" value="" >'													
							<?php while($a=mysql_fetch_array($query)){
							$id = $a['id_tembusan'];
							$nama = $a['nama_tembusan'];
							?>				
							+ '<option value="<?php echo"$id"; ?>"><?php echo"$nama"; ?></option>'
							<?php } ?>						
						+ '</select></td>'	
						+ '<td><a class="remove_item" href="#" ><input type="button" value="Delete" class="btn btn-primary"></a>'
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

		
		
		
		
		$(document).ready(function() {
    		var count = 0;

    		$("#add_elemen").click(function(){
					count += 1;
		   		$('#containerelemen').append(
							 '<tr class="records">'						 
						 + '<td><label id="'+count+'">' + count + '</label></td>'
						 + '<td><input id="jns_hewan_' + count + '" name="jns_hewan_' + count + '" class="form-control" type="text"></td>'
						 + '<td><input id="umur_' + count + '" name="umur_' + count + '" class="form-control" type="text"></td>'
						 + '<td><input id="jk_hewan_' + count + '" name="jk_hewan_' + count + '" class="form-control" type="text"></td>'
						 + '<td><input id="ciri_' + count + '" name="ciri_' + count + '" class="form-control" type="text"></td>'
						 + '<td><input id="jumlah_' + count + '" name="jumlah_' + count + '" class="form-control" type="text"></td>'
						 + '<td><a class="remove_item" href="#" >Delete</a>'
						 + '<input id="rows_' + count + '" name="rowsE[]" value="'+ count +'" type="hidden"></td></tr>'
					);
				});

				$(".remove_item").live('click', function (ev) {
    			if (ev.type == 'click') {
	        	$(this).parents(".records").fadeOut();
	        	$(this).parents(".records").remove();
        	}
     		});
		});
		
		
		
		$(document).ready(function() {
    		var count = 0;

    		$("#produksi").click(function(){
					count += 1;
		   		$('#containerp').append(
						   '<tr class="records">'						 
						 + '<td><label id="'+count+'">' + count + '</label></td>'
						 + '<td><input id="jenis' + count + '" name="jenis' + count + '" class="form-control" type="text"></td>'
						 + '<td><input id="kapasitas' + count + '" name="kapasitas' + count + '" class="form-control" type="text"></td>'
						 + '<td><input id="keterangan' + count + '" name="keterangan' + count + '" class="form-control" type="text"></td>'						
						 + '<td><a class="remove_item" href="#" >Delete</a>'
						 + '<input id="rowsp' + count + '" name="rowsp[]" value="'+ count +'" type="hidden"></td></tr>'
					);
				});

				$(".remove_item").live('click', function (ev) {
    			if (ev.type == 'click') {
	        	$(this).parents(".records").fadeOut();
	        	$(this).parents(".records").remove();
        	}
     		});
		});
		
		$(document).ready(function() {
    		var count = 0;

    		$("#daftar").click(function(){
					count += 1;
		   		$('#containerd').append(
						   '<tr class="records">'						 
						 + '<td><label id="'+count+'">' + count + '</label></td>'
						 + '<td><input id="jenisM' + count + '" name="jenisM' + count + '" class="form-control" type="text"></td>'
						 + '<td><input id="tipeM' + count + '" name="tipeM' + count + '" class="form-control" type="text"></td>'
						 + '<td><input id="kapasitasM' + count + '" name="kapasitasM' + count + '" class="form-control" type="text"></td>'
						 + '<td><input id="jum' + count + '" name="jum' + count + '" class="form-control" type="text"></td>'
						 + '<td><input id="ket' + count + '" name="ket' + count + '" class="form-control" type="text"></td>'						
						 + '<td><a class="remove_item" href="#" >Delete</a>'
						 + '<input id="rowsd' + count + '" name="rowsd[]" value="'+ count +'" type="hidden"></td></tr>'
					);
				});

				$(".remove_item").live('click', function (ev) {
    			if (ev.type == 'click') {
	        	$(this).parents(".records").fadeOut();
	        	$(this).parents(".records").remove();
        	}
     		});
		});

			$(document).ready(function() {
    		var count = 0;

    		$("#label").click(function(){
					count += 1;
		   		$('#containerl').append(
						   '<tr class="records">'						 
						 + '<td><label id="'+count+'">' + count + '</label></td>'
						 + '<td><input id="label' + count + '" name="label' + count + '" class="form-control" type="text"></td>'
						 + '<td><a class="remove_item" href="#" >Delete</a>'
						 + '<input id="rowsp' + count + '" name="rowsl[]" value="'+ count +'" type="hidden"></td></tr>'
					);
				});

				$(".remove_item").live('click', function (ev) {
    			if (ev.type == 'click') {
	        	$(this).parents(".records").fadeOut();
	        	$(this).parents(".records").remove();
        	}
     		});
		});
</script>
			