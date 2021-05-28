<?php
//https://gist.github.com/jakebellacera/635416
include 'classes/ICS.php';

if(!empty($_POST)){
    header('Content-Type: text/calendar; charset=utf-8');
    header('Content-Disposition: attachment; filename=invite.ics');

    $ics = new ICS(array(
        'location' => $_POST['location'],
        'description' => $_POST['description'],
        'dtstart' => $_POST['date_start'],
        'dtend' => $_POST['date_end'],
        'summary' => $_POST['summary'],
        'url' => $_POST['url']
      ));

      echo $ics->to_string();
}
?>

<html>
<form method="post">
  <input type="hidden" name="date_start" value="2017-1-16 9:00AM">
  <input type="hidden" name="date_end" value="2017-1-16 10:00AM">
  <input type="hidden" name="location" value="123 Fake St, New York, NY">
  <input type="hidden" name="description" value="This is my description">
  <input type="hidden" name="summary" value="This is my summary">
  <input type="hidden" name="url" value="http://example.com">
  <input type="submit" value="Add to Calendar">
</form>
</html>