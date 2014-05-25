<?php
  $line= $posts[0]['Tile'];


$this->CSV->addRow(array_keys($line));
 foreach ($posts as $post)
 {
       $line.=$posts['Tile']['in_date'];
	   $line.=$posts['Job']['company_name'];
       $this->CSV->addRow($line);
 }
 $filename='posts';
 echo  $this->CSV->render($filename);
?>