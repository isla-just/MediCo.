<?php if(count($errors2) > 0 ) : ?>
    <!--loop through each error-->
    <div>
        <?php foreach($errors2 as $error2) : ?>
        <p><?php echo $error2; ?></p> 
        
        <?php endforeach ?>
    </div>
<?php endif ?>