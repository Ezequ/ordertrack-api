@include("adm.links-template.links-js")
<html moznomarginboxes mozdisallowselectionprint>
    <img id="qr-{{$id}}" src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(500)->generate($id)) }} ">
</html>
<script>
    $(document).ready(function()
    {
       window.print();
        document.getElementById('header').style.display = 'none';
        document.getElementById('footer').style.display = 'none';
    });
</script>
<style type="text/css" media="print">
    @page
    {
        size:  auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }

    html
    {
        background-color: #FFFFFF;
        margin: 0px;  /* this affects the margin on the html before sending to printer */
    }

    body
    {
    }
</style>