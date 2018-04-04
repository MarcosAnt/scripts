<p id="lblCopyright">Copyright [[ano]] &copy; Company - Todos os direitos reservados</p>
<script type="text/javascript">
$(document).ready(function(){ 
  var date = new Date();
  var element = $('#lblCopyright');
  var str = element.html();
  element.html( str.replace('[[ano]]', date.getFullYear()) );
});
</script>
