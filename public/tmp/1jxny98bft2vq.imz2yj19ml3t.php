<?php echo $this->render('head.html',NULL,get_defined_vars(),0); ?>

<?php if (isset($content)): ?>
    
        <?php echo $this->render($content,NULL,get_defined_vars(),0); ?>
    
    <?php else: ?>
        <div>Není co zobrazit</div>
    
<?php endif; ?>


<?php echo $this->render('footer.html',NULL,get_defined_vars(),0); ?>

