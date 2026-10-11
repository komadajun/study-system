<?php
for($i=0;$i<100;$i++){
    $i2=$i+1;
    print 'ALTER TABLE `answer`  ADD `a'.$i2.'` TEXT(50) NOT NULL  AFTER `a'.$i.'`;<br>';
}
?>