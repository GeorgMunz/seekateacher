<div class="clearfix p-r p-b-30">
  <div style="width:90%;float:right;" data-module="Comment" data-action="initComment">
    <?= form_open($url, 'class="comment-form"') ?>
      <h3 class="">Write your comment</h3>
      <div class="mar-t-10 mar-b-10">
        <?= form_textarea('comment', '', 'class="form-control"') ?>
      </div>
      <button class="btn btn-pink r-a-0 m-t" type="submit">Add Comment</button>
    </form>
  </div>
</div>
