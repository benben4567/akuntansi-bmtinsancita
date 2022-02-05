/*
 * Aplikasi AKSIOMA (Aplikasi Keuangan Mikro Masyarakat Ekonomi Syariah) ver. 1.0
 * Copyright (c) 2014
 *
 * file   : tool/shu.js
 * author : Edi Suwoto S.Komp
 * email  : edi.suwoto@gmail.com
 */
 /*----------------------------------------------------------*/
 $(document).ready(function(){

    $('#generate_shu').on('click', function(){

        var start_date = $('#start_date').val();
        var end_date   = $('#end_date').val();

        $.ajax({
            url: 'tool/shu/getdata',
            type: 'POST',
            dataType: 'JSON',
            data: 
            {
                start_date:start_date, 
                end_date:end_date 
            },
            success: function(data){
                let data_now = data;
                $('#val_date').html(revDate(start_date,"-")+ ' sampai ' +revDate(end_date,"-"));
                $('#val_shu_before_tax').html(data_now);
                $('#val_shu_tax').html(data_now*5/100);
                $('#val_shu_after_tax').html(data_now - (data_now*5/100));

                var new_shu ='';
                var xx = 100;
                $('#add_shu').click(function(){

                    var data_after_tax = data_now - (data_now*5/100);
                    var title_shu      = $('#title_shu').val();
                    var val_shu        = $('#val_shu').val();

                    if(parseInt(val_shu)>xx){
                        alert('Value SHU terlalu  besar');
                        $('#val_shu').val('');
                    } else {
                        xx               = xx - parseInt(val_shu);
                        var val_sisa_shu = $('#val_sisa_shu').html(xx);
                        new_shu+='<tr>'
                        +'<td style="padding: 5px;" id="title_shu_add">'+title_shu+'</td>'
                        +'<td width="10%" align="right" style="padding: 5px;" value="'+val_shu+'" id="val_shu_add">'+val_shu+'% </td>'
                        +'<td width="10%" align="right" style="padding: 5px;" id="val2_shu_add">'+ (val_shu/100)*data_after_tax+'</td>'
                        +'</tr>';

                        $('#new_shu').append(new_shu);

                        $('#title_shu').val('');
                        $('#val_shu').val('');
                        $('#title_shu_add').val('');
                        $('#val_shu_add').val('');
                        $('#val2_shu_add').val('');
                        new_shu='';
                    }
                });
            }
        });

    });

});

 function printDiv(divName) {
    $('#form_add_shu').hide();
    var printContents    = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;


    document.body.innerHTML = printContents;

    window.print();
    document.body.innerHTML = originalContents;
    $('#form_add_shu').show();
}