<script src='../assets/js/jquery.min.js'></script>
<script src='../assets/js/jquery-ui.min.js'></script>
<link href='../assets/js/jquery-ui.css' rel='stylesheet' type='text/css'/>

<script>
    $(function() {
        var dates = $( "#tglf, #tglt, #tgls, #tgld, #tgle, #tglf, #tglg, #tglh, #tgli, #tglj, #tglk").datepicker({
            defaultDate: "+1w",
            dateFormat:'yy-mm-dd',
            onSelect: function( selectedDate ) {
                var option = this.id == "tglf",
                    instance = $( this ).data( "datepicker" ),
                    date = $.datepicker.parseDate(
                        instance.settings.dateFormat ||
                        $.datepicker._defaults.dateFormat,
                        selectedDate, instance.settings );
                dates.not( this ).datepicker( "option", option, date );
            }
        });
    });
</script>