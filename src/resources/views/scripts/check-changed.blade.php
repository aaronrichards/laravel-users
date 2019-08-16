<script type="text/javascript">
  $.fn.extend({
        toggleText: function(a, b){
            return this.text(this.text() == b ? a : b);
        }
    });
  $('.btn-change-pw').click(function(event) {
    event.preventDefault();
    $('.pw-change-container').slideToggle(100);
    $(this).find('span').toggleText('', 'cancel');
  });
  $("input").keyup(function() {
    checkChanged();
  });
  $("select").change(function() {
    checkChanged();
  });
  function checkChanged() {
    if(!$('input').val()){
      $(".btn-save").hide();
    }
    else {
      $(".btn-save").show();
    }
  }
</script>
