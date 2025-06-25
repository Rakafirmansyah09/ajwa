<script>
   function formAction(formId, type) {
      let form = document.getElementById(formId);
      console.log(form);
      if (type === 'submit') {
         form.submit();
      } else if (type === 'reset') {
         form.reset();
      }
   }

   // tombol submit di luar form
   document.addEventListener('DOMContentLoaded', function() {
      // ambil semua button
      document.querySelectorAll('button').forEach(function(button) {
         if (button.getAttribute('form')) {
            let formId = button.getAttribute('form');
            let type = button.getAttribute('type');

            button.addEventListener('click', function() {
               formAction(formId, type);
            });
         }
      });
   });
</script>