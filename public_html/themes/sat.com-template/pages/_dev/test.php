<?php layout('blank') ?>

<h1 id="something">Something</h1>

<script>
  $(function(){

    obj = {
      name: 'sonal',
      getName: function() {
        return this.name;
      }
    }

    // console.log(obj.getName));
  });
</script>
