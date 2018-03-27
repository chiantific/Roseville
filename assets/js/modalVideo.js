$(document).ready(function(){
  /* Get iframe src attribute value i.e. YouTube video url and store it in a variable */
  var url = $("#teaserVideo").attr('vid_src');

  /* Assign empty url value to the iframe src attribute when modal hide, which stop the video playing */
  $("#myYoutubeModal").on('hide.bs.modal', function(){
      $("#teaserVideo").attr('src', null);
  });

  /* Assign the initially stored url back to the iframe src
  attribute when modal is displayed again */
  $("#myYoutubeModal").on('show.bs.modal', function(){
      $("#teaserVideo").attr('src', url + "?autoplay=1");
  });
});
