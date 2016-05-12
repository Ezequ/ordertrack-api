@include("adm.links-template.links-js")

<style type="text/css" media="print">

@page
{
    size:  auto;   /* auto is the initial value */
    margin: 0mm;  /* this affects the margin in the printer settings */
}

html {
    background-color: #FFFFFF;
    margin: 0px;  /* this affects the margin on the html before sending to printer */
    width: 100%;
    text-align: center;
}
.header {
    margin: 100px 0px 10px 0px;
}
.header > img {
    width: 120px;
    height: auto;
}
.qr {
    margin: 0 auto;
}
.note {
    width: 80%;
    font-family: sans-serif;
    margin: 0 auto;
    margin-top: 20px;
}
    
</style>

<html moznomarginboxes mozdisallowselectionprint>
    
    <div class="header">
        <img src="{{Config::get('constants.url_imagenes') . 'logo/logo-black.png'}}" alt="Order Tracker logo ">
    </div>

    <img id="qr-{{$id}}" class="qr" src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(300)->generate($id)) }} ">

    <p class="note">Deberá presentar el código QR al vendedor cuando este concurra a realizar un pedido. Dicho código es único e intransferible. Sin el mismo, el vendedor se encontrará imposibilitado de emitir pedido alguno.</p>
</html>
<script>
    $(document).ready(function()
    {
       window.print();
        document.getElementById('header').style.display = 'none';
        document.getElementById('footer').style.display = 'none';
    });
</script>
